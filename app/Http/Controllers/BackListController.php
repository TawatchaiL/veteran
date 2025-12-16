<?php

namespace App\Http\Controllers;

use App\Models\BackList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use App\Services\AsteriskAmiService;

class BackListController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('permission:holiday-list|holiday-create|holiday-edit|holiday-delete', ['only' => ['index']]);
        $this->middleware('permission:holiday-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:holiday-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:holiday-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            //sleep(2);

            //$datas = BackList::orderBy("id", "desc")->get();
            $datas = BackList::query()->orderByDesc('id');
            $state_text = array('ไม่เปิดใช้งาน', 'เปิดใช้งาน');
            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->id . '" >';
                })
                ->addColumn('action', function ($row) {
                    if (Gate::allows('holiday-delete')) {
                        $html = '<button type="button" data-rowid="' . $row->id . '" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i> ลบ</button>';
                    } else {
                        $html = '<button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-trash"></i> ลบ</button> ';
                    }
                    return $html;
                })->rawColumns(['checkbox', 'action'])->toJson();
        }

        return view('backlist.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request, AsteriskAmiService $ami)
    {
        /*
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'description' => 'required',
        ], [
            'phone.required' => 'กรุณาระบุเบอร์โทร',
            'description.required' => 'กรุณาระบุรายละเอียด',
        ]);
        */
        $validator = Validator::make($request->all(), [
            'phone' => 'required|unique:back_lists,phone',
            'description' => 'required',
        ], [
            'phone.required' => 'กรุณาระบุเบอร์โทร',
            'phone.unique'   => 'เบอร์โทรนี้มีอยู่ในระบบแล้ว',
            'description.required' => 'กรุณาระบุรายละเอียด',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ]);
        }

        // 2) เตรียมข้อมูล
        $data = [
            'phone'        => $request->phone,
            'description'  => $request->description,
            'created_by'   => auth()->id(),
            'updated_by'   => auth()->id(),
        ];

        // 3) DB → AMI (transaction)
        DB::beginTransaction();

        try {
            // บันทึก CRM ก่อน (source of truth)
            $blacklist = BackList::create($data);

            // ใส่ AstDB
            $ami->blacklist_add($request->phone);

            DB::commit();

            return response()->json([
                'success' => 'เพิ่ม เบอร์โทรศัพท์แบล็กลิสต์ เรียบร้อยแล้ว'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            // (แนะนำ) log error ไว้ดูย้อนหลัง
            //\Log::error('Blacklist store failed', [
            //    'error' => $e->getMessage(),
            //    'phone' => $request->phone,
            //]);

            return response()->json([
                'error' => 'ไม่สามารถเพิ่ม เบอร์โทรศัพท์แบล็กลิสต์ ได้'
            ], 500);
        }
    }
/*
    public function edit($id)
    {
        $data =  BackList::find($id);
        return response()->json([
            'phone' => $data->phone,
            'description' => $data->description
        ]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'phone' => 'required',
            'description' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, [
            'phone.required' => 'กรุณาระบุเบอร์โทร!',
            'description.required' => 'กรุณาระบุรายละเอียด',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }


        $holiday = [
            'phone' => $request->get('phone'),
            'description' => $request->get('description'),
            //'updated_by' => auth()->id(),
        ];


        $update = BackList::find($id);
        $update->update($holiday);

        return response()->json(['success' => 'แก้ไข เบอร์โทรศัพท์แบล็กลิสต์ เรียบร้อยแล้ว']);
    }
*/
    public function destroy(Request $request, AsteriskAmiService $ami)
    {
        $id = $request->get('id');
        $blacklist = BackList::findOrFail($id);

        DB::beginTransaction();

        try {
            $ami->blacklist_remove($blacklist->phone);
            $blacklist->delete();

            DB::commit();

            return ['success' => true, 'message' => 'ลบ เบอร์โทรศัพท์แบล็กลิสต์ เรียบร้อยแล้ว'];

        } catch (\Exception $e) {
            DB::rollBack();
            return ['success' => false, 'message' => 'ลบ เบอร์โทรศัพท์แบล็กลิสต์ ไม่สำเร็จ'];
        }
    }

    public function destroy_all(Request $request, AsteriskAmiService $ami)
    {
        $ids = $request->get('table_records'); // ผ่านการเช็คมาแล้ว

        DB::beginTransaction();

        try {
            // ดึงรายการที่จะลบ
            $blacklists = BackList::whereIn('id', $ids)->get();

            // ลบออกจาก AstDB
            foreach ($blacklists as $item) {
                $ami->blacklist_remove($item->phone);
            }

            // ลบจาก DB
            BackList::whereIn('id', $ids)->delete();

            DB::commit();

            return redirect('/backlist')
                ->with('success', 'ลบ เบอร์โทรศัพท์แบล็กลิสต์ เรียบร้อยแล้ว');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect('/backlist')
                ->with('error', 'ลบ เบอร์โทรศัพท์แบล็กลิสต์ ไม่สำเร็จ');
        }
    }
}
