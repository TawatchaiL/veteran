<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CrmCaseType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CaseTypeController extends Controller
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

            $datas = CrmCaseType::orderBy("id", "desc")->get();
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

        return view('casetype6.index');
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
            'name' => 'required|string|max:70',
            //'code' => 'required|string|max:10',
            'status' => 'required',
        ], [
            'name.required' => 'ชื่อประเภทการติดต่อ ต้องไม่เป็นค่าว่าง!',
            //'name.unique' => 'ชื่อประเภทการติดต่อ นี้มีอยู่แล้วในฐานข้อมูล!',
            //'code.required' => 'รหัสแผนกต้องไม่เป็นค่าว่าง!',
            //'code.max' => 'รหัสแผนกต้องห้ามเกิน10ตัวอักษร!',
            'status.required' => 'กรุณาเลือกสถานะ!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $input = $request->all();
        $contract = CrmCaseType::create($input);
        return response()->json(['success' => 'เพิ่ม ประเภทการติดต่อ เรียบร้อยแล้ว']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = CrmCaseType::find($id);
        return response()->json(['data' => $data]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string|max:255|unique:case_types,name,' . $id,
            'status' => 'required|max:10',
        ];

        $validator = Validator::make($request->all(), $rules, [
            'name.required' => 'ชื่อประเภทการติดต่อ ต้องไม่เป็นค่าว่าง!',
            'name.unique' => 'ชื่อประเภทการติดต่อ นี้มีอยู่แล้วในฐานข้อมูล!',
            'status.required' => 'กรุณาเลือกสถานะ!',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $companyd = [
            'name' => $request->get('name'),
            'status' => $request->get('status'),
        ];

        $company = CrmCaseType::find($id);
        $company->update($companyd);

        return response()->json(['success' => 'แก้ไข ประเภทการติดต่อ เรียบร้อยแล้ว']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        CrmCaseType::find($id)->delete();
        return ['success' => true, 'message' => 'ลบ ประเภทการติดต่อ เรียบร้อยแล้ว'];
    }

    public function destroy_all(Request $request)
    {

        $arr_del  = $request->get('table_records'); //$arr_ans is Array MacAddress

        for ($xx = 0; $xx < count($arr_del); $xx++) {
            CrmCaseType::find($arr_del[$xx])->delete();
        }

        return redirect('casetype6')->with('success', 'ลบ ประเภทการติดต่อ เรียบร้อยแล้ว');
    } //
    public function casetype($id)
    {
        $data = DB::table('crm_case_types')
        ->whereRaw('parent_id = ' . $id . '')
        ->get();
        return response()->json(['data' => $data]);
    }
}
