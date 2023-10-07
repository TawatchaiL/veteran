<?php

namespace App\Http\Controllers;

use App\Models\CrmCase;
use App\Models\Cases;
use App\Models\Case_type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CasesContractController extends Controller
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
        //$id = request('id');
        //$request->get('id');
        if ($request->ajax()) {
            if (!empty($request->get('sdate'))) {
                $dateRange = $request->input('sdate');
                if ($dateRange) {
                    $dateRangeArray = explode(' - ', $dateRange);
                    if (!empty($dateRangeArray) && count($dateRangeArray) == 2) {
                        $startDate = $dateRangeArray[0];
                        $endDate = $dateRangeArray[1];
                    }
                }
            }
            if ($request->input('seachtype') === "0") {
                $datas = DB::table('crm_cases')
                ->select('crm_cases.id as id','hn', DB::raw("concat(fname, ' ', lname) as name"),'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'agent')
                ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"')
                ->where('crm_cases.contact_id', '=', request('id'))
                ->get();
            }else if ($request->input('seachtype') === "1") {
                $datas = DB::table('crm_cases')
                ->select('crm_cases.id as id','hn', DB::raw("concat(fname, ' ', lname) as name"),'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'agent')
                ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                ->where('casestatus', '=', 'กำลังดำเนินการ')
                ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"')
                ->where('crm_cases.contact_id', '=', request('id'))
                ->get();
            }else if ($request->input('seachtype') === "2") {
                $datas = DB::table('crm_cases')
                ->select('crm_cases.id as id','hn', DB::raw("concat(fname, ' ', lname) as name"),'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'agent')
                ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                ->where('casestatus', '=', 'ปิดเคส')
                ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"')
                ->where('crm_cases.contact_id', '=', request('id'))
                ->get();
            }else if ($request->input('seachtype') === "3") {
                $datas = DB::table('crm_cases')
                ->select('crm_cases.id as id','hn', DB::raw("concat(fname, ' ', lname) as name"),'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'agent')
                ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                ->where('crm_contacts.hn', 'like', '%' . $request->input('seachtext') . '%')
                ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"')
                ->where('crm_cases.contact_id', '=', request('id'))
                ->get();
            }else if ($request->input('seachtype') === "4") {
                $datas = DB::table('crm_cases')
                ->select('crm_cases.id as id','hn', DB::raw("concat(fname, ' ', lname) as name"),'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'agent')
                ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                ->where('crm_contacts.fname', 'like', '%' . $request->input('seachtext') . '%')
                ->orWhere('crm_contacts.lname', 'like', '%' . $request->input('seachtext') . '%')
                ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"')
                ->where('crm_cases.contact_id', '=', request('id'))
                ->get();
            }else if ($request->input('seachtype') === "5") {
                $datas = DB::table('crm_cases')
                ->select('crm_cases.id as id','hn', DB::raw("concat(fname, ' ', lname) as name"),'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'agent')
                ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                ->where('crm_contacts.phoneno', 'like', '%' . $request->input('seachtext') . '%')
                ->orWhere('crm_contacts.telhome', 'like', '%' . $request->input('seachtext') . '%')
                ->orWhere('crm_contacts.workno', 'like', '%' . $request->input('seachtext') . '%')
                ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"')
                ->where('crm_cases.contact_id', '=', request('id'))
                ->get();
            }
            //sleep(2);
            //$datas = Cases::orderBy("id", "desc")->get();


            return datatables()->of($datas)
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
        $contacts = DB::table('crm_contacts')->whereRaw('id = '.request('id').'')->get();
        return view('casescontract.index')->with(['casetype' => $company,'contacts' => $contacts]);
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
            'casetype1' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $input = $request->all();
        $contract = CrmCase::create($input);
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

        $data = CrmCase::find($id);
        return response()->json(['data' => $data]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'casetype1' => 'required|string|max:20',
            //'postcode' => 'integer|max:10',

        ];


        $validator =  Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $companyd = [
            'casetype1' => $request->get('casetype1'),
            'tranferstatus' => $request->get('tranferstatus'),
            'casedetail' => $request->get('casedetail'),
            'casestatus' => $request->get('casestatus'),
        ];

       $company = CrmCase::find($id);
       $company->update($companyd);

        return response()->json(['success' => 'แก้ไข เรื่องที่ติดต่อ เรียบร้อยแล้ว']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        CrmCase::find($id)->delete();
        return ['success' => true, 'message' => 'ลบ เรื่องที่ติดต่อ เรียบร้อยแล้ว'];
    }

    public function destroy_all(Request $request)
    {

        $arr_del  = $request->get('table_records'); //$arr_ans is Array MacAddress

        for ($xx = 0; $xx < count($arr_del); $xx++) {
            CrmCase::find($arr_del[$xx])->delete();
        }

        return redirect('casescontract?id='.$request->get('Delcontact_id'))->with('success', 'ลบ เรื่องที่ติดต่อ เรียบร้อยแล้ว');
    }
}
