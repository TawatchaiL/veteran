<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\Case_type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CasesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:case-list|case-create|case-edit|case-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:case-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:case-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:case-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            //sleep(2);

            //$datas = Cases::orderBy("id", "desc")->get();
            $numberOfRows = 50; // Change this to the desired number of rows
            $simulatedDatas = [];

            $thaiCaseTypes = ['บาดเจ็บ', 'อุบัติเหตุ', 'โรคเรื้อรัง', 'ไข้หวัด', 'ผ่าตัด', 'สูตินรีเวช', 'การวินิจฉัยโรค', 'จัดกระบวนการ', 'สัมผัสไข้หวัด', 'พิษสุนัขบ้า'];
            $thaiNames = ['สมชาย', 'สมหญิง', 'วิชัย', 'วิไล', 'จริงใจ', 'เปรมชัย', 'สุดใจ', 'นฤมล', 'กมลชนก', 'ศุภัทรา', 'กิจวรรณ', 'อรวรรณ', 'ธนพงศ์', 'ประทุม', 'วิทยา', 'พรชัย'];
            $thaiLastNames = ['ใจดี', 'เสมอ', 'รักชาติ', 'พร้อม', 'ชำนาญ', 'มีเสน่ห์', 'สุขใจ', 'เรียบง่าย', 'สุดหล่อ', 'หวานใจ', 'เก่ง', 'สนุก', 'ร่ำรวย', 'สายเครื่อง', 'ยอดมาก', 'คง', 'ละเอียด'];
            
            $thaiCaseStatuses = ['กำลังดำเนินการ', 'ปิดเคส', 'เคสใหม่'];
            $thaiTransferStatuses = ['รับสาย', 'ไม่รับสาย', '-'];
            $agents = ['Agent1', 'Agent2', 'Agent3', 'Agent4', 'Agent5'];

            for ($i = 1; $i <= $numberOfRows; $i++) {
                $hn = str_pad($i, 6, '0', STR_PAD_LEFT);
                $fullName = $thaiNames[array_rand($thaiNames)] . ' ' . $thaiLastNames[array_rand($thaiLastNames)];
                $caseType = $thaiCaseTypes[array_rand($thaiCaseTypes)];
                $caseStatus = $thaiCaseStatuses[array_rand($thaiCaseStatuses)];
                $transferStatus = $thaiTransferStatuses[array_rand($thaiTransferStatuses)];
                $agent = $agents[array_rand($agents)];
                $createDate = now()->subDays(rand(1, 365))->subHours(rand(0, 23))->subMinutes(rand(0, 59));


                $simulatedDatas[] = (object) [
                    'id' => $i,
                    'telephone' => '08' . rand(10000000, 99999999),
                    'hn' => $hn,
                    'contact_id' => $fullName,
                    'case_type' => $caseType,
                    'create_date' => $createDate->format('Y-m-d H:i:s'),
                    'case_status' => $caseStatus,
                    'transfer_status' => $transferStatus,
                    'agent' => $agent,
                    // Simulate other fields as needed
                ];
            }


            return datatables()->of($simulatedDatas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->id . '" >';
                })
                ->addColumn('action', function ($row) {
                    if (Gate::allows('case-edit')) {
                        $html = '<button type="button" class="btn btn-sm btn-warning btn-edit" id="getEditData" data-id="' . $row->id . '"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    } else {
                        $html = '<button type="button" class="btn btn-sm btn-warning disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    }
                    if (Gate::allows('case-delete')) {
                        $html .= '<button type="button" data-rowid="' . $row->id . '" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i> ลบ</button>';
                    } else {
                        $html .= '<button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-trash"></i> ลบ</button> ';
                    }
                    return $html;
                    
                })
                ->addColumn('more', function ($row) {
                    return '';
                })->rawColumns(['checkbox', 'action'])->toJson();
        }
        $company = Case_type::orderBy("id", "asc")->get();
        return view('cases.index')->with(['casetype' => $company]);
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
            //'code' => 'required|string|max:10',
            'casetype1' => 'required|string|max:255',
            //'postcode' => 'int|max:10',
            /* 'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
            'postcode' => 'required|string|max:10',
            'telephone' => 'required|string|max:20',*/
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $input = $request->all();
        $contract = Cases::create($input);
        return response()->json(['success' => 'เพิ่ม เรื่องที่ติดต่อ เรียบร้อยแล้ว']);
    }

    /**
     * Display the specified resource.
     */
    //public function show(Order $order)
    //{
    //
    //}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $data = Cases::find($id);
        return response()->json(['data' => $data]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string|max:255',
            //'postcode' => 'integer|max:10',

        ];


        $validator =  Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $companyd = [
            'name' => $request->get('name'),
        ];

        $company = Cases::find($id);
        $company->update($companyd);

        return response()->json(['success' => 'แก้ไข เรื่องที่ติดต่อ เรียบร้อยแล้ว']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        Cases::find($id)->delete();
        return ['success' => true, 'message' => 'ลบ เรื่องที่ติดต่อ เรียบร้อยแล้ว'];
    }

    public function destroy_all(Request $request)
    {

        $arr_del  = $request->get('table_records'); //$arr_ans is Array MacAddress

        for ($xx = 0; $xx < count($arr_del); $xx++) {
            Cases::find($arr_del[$xx])->delete();
        }

        return redirect('/cases')->with('success', 'ลบ เรื่องที่ติดต่อ เรียบร้อยแล้ว');
    }
}
