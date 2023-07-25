<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Priority;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PrioritiesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('permission:master-data-list|master-data-create|master-data-edit|master-data-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:master-data-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:master-data-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:master-data-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            //sleep(2);

            $datas = Priority::orderBy("id", "desc")->get();
            $state_text = array('ไม่เปิดใช้งาน', 'เปิดใช้งาน');
            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->id . '" >';
                })
                ->editColumn('status', function ($row) use ($state_text) {
                    $state = $state_text[$row->status];
                    return $state;
                })
                ->addColumn('action', function ($row) {
                    if (Gate::allows('master-data-edit')) {
                        $html = '<button type="button" class="btn btn-sm btn-warning btn-edit" id="getEditData" data-id="' . $row->id . '"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    } else {
                        $html = '<button type="button" class="btn btn-sm btn-warning disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    }
                    if (Gate::allows('master-data-delete')) {
                        $html .= '<button type="button" data-rowid="' . $row->id . '" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i> ลบ</button>';
                    } else {
                        $html .= '<button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-trash"></i> ลบ</button> ';
                    }
                    return $html;
                })->rawColumns(['checkbox', 'action'])->toJson();
        }

        return view('priorities.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator =  Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:priorities',
            'status' => 'required',
            /* 'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
            'postcode' => 'required|string|max:10',
            'telephone' => 'required|string|max:20',*/
        ], [
            'name.required' => 'ชื่อระดับชั้นความเร็วต้องไม่เป็นค่าว่าง!',
            'name.unique' => 'ชื่อระดับชั้นความเร็วนี้มีอยู่แล้วในฐานข้อมูล!',
            'status.required' => 'กรุณาเลือกสถานะ!',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $input = $request->all();
        $priorities = Priority::create($input);
        $select_list_priorities = '<option value="' . $priorities->id . '" > ' . $priorities->name . '</option>';
        return response()->json(['success' => 'เพิ่ม ระดับชั้นความเร็ว เรียบร้อยแล้ว', 'priorities' => $select_list_priorities, 'pid' => $priorities->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data =  Priority::find($id);
        return response()->json(['data' => $data]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string|max:255|unique:priorities,name,' . $id,
            'status' => 'required|max:10',

        ];


        $validator =  Validator::make($request->all(), $rules, [
            'name.required' => 'ชื่อระดับชั้นความเร็วต้องไม่เป็นค่าว่าง!',
            'name.unique' => 'ชื่อระดับชั้นความเร็วนี้มีอยู่แล้วในฐานข้อมูล!',
            'status.required' => 'กรุณาเลือกสถานะ!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $contactd = [
            'name' => $request->get('name'),
            'status' => $request->get('status'),
        ];

        $contact = Priority::find($id);
        $contact->update($contactd);

        return response()->json(['success' => 'แก้ไข ระดับชั้นความเร็ว เรียบร้อยแล้ว']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        Priority::find($id)->delete();
        return ['success' => true, 'message' => 'ลบ ระดับชั้นความเร็ว เรียบร้อยแล้ว'];
    }

    public function destroy_all(Request $request)
    {

        $arr_del  = $request->get('table_records'); //$arr_ans is Array MacAddress

        for ($xx = 0; $xx < count($arr_del); $xx++) {
            Priority::find($arr_del[$xx])->delete();
        }

        return redirect('/priorities')->with('success', 'ลบ ระดับชั้นความเร็ว เรียบร้อยแล้ว');
    }
}
