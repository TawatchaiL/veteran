<?php

namespace App\Http\Controllers;

use App\Models\Callsurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CallsurveyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('permission:call-survey-list|call-survey-create|call-survey-edit|call-survey-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:call-survey-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:call-survey-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:call-survey-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            //sleep(2);

            $datas = Callsurvey::orderBy("id", "desc")->get();
            $state_text = array('ไม่เปิดใช้งาน', 'ตั้งเป็น Call Survey');
            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->id . '" >';
                })
                ->editColumn('set_default', function ($row) use ($state_text) {
                    $state = $state_text[$row->set_default];
                    return $state;
                })
                ->addColumn('action', function ($row) {
                    if (Gate::allows('call-survey-edit')) {
                        $html = '<button type="button" class="btn btn-sm btn-warning btn-edit" id="getEditData" data-id="' . $row->id . '"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    } else {
                        $html = '<button type="button" class="btn btn-sm btn-warning disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    }
                    if (Gate::allows('call-survey-delete')) {
                        $html .= '<button type="button" data-rowid="' . $row->id . '" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i> ลบ</button>';
                    } else {
                        $html .= '<button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-trash"></i> ลบ</button> ';
                    }
                    return $html;
                })->rawColumns(['checkbox', 'action'])->toJson();
        }

        $sound = DB::connection('remote_connection')
            ->table('asterisk.recordings')
            ->orderBy("displayname", "asc")->get();

        return view('callsurvey.index')->with(['sound' => $sound]);
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
        $validator =  Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:positions',
            'max_score' => 'required',
            'wellcome_sound' => 'required',
            'thankyou_sound' => 'required',
            'timeout_sound' => 'required',
            'invalid_sound' => 'required',
            'max_sound' => 'required',
        ], [
            'name.required' => 'ชื่อต้องไม่เป็นค่าว่าง!',
            'name.unique' => 'ชื่อนี้มีอยู่แล้วในฐานข้อมูล!',
            'max_score.required' => 'กรุณาระบุคะแนนสูงสุด!',
            'wellcome_sound.required' => 'กรุณาระบุเสียงต้อนรับ!',
            'thankyou_sound.required' => 'กรุณาระบุเสียงขอบคุณ!',
            'timeout_sound.required' => 'กรุณาเะบุเสียงไม่ทำรายการถายในระยะเวลา!',
            'invalid_sound.required' => 'กรุณาเะบุเสียงกดเมนูไม่ถูกต้อง!',
            'max_sound.required' => 'กรุณาะบุเสียงทำรายการเกินจำนวนครั้งที่กำหนด!',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $input = $request->all();

        $hasSetDefaultOne = Callsurvey::where('set_default', 1);

        if ($hasSetDefaultOne->exists()) {
            $hasSetDefaultOne->update(['set_default' => 0]);
        }
        Callsurvey::create($input);
        return response()->json(['success' => 'เพิ่ม Call Survey เรียบร้อยแล้ว']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Callsurvey $callsurvey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data =  Callsurvey::find($id);
        return response()->json(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Callsurvey $callsurvey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        Callsurvey::find($id)->delete();
        return ['success' => true, 'message' => 'ลบ Call Survey เรียบร้อยแล้ว'];
    }

    public function destroy_all(Request $request)
    {

        $arr_del  = $request->get('table_records'); //$arr_ans is Array MacAddress

        for ($xx = 0; $xx < count($arr_del); $xx++) {
            Callsurvey::find($arr_del[$xx])->delete();
        }

        return redirect('/callsurvey')->with('success', 'ลบ Call Survey เรียบร้อยแล้ว');
    }
}
