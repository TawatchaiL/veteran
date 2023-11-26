<?php

namespace App\Http\Controllers;

use App\Models\CrmCase;
use App\Models\CrmCaseslog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
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

    public function index(Request $request)
    {
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
                    ->select('crm_cases.id as id', 'hn', DB::raw("concat(fname, ' ', lname) as name"), 'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'users.name as agent')
                    ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                    ->join('users', 'crm_cases.agent', '=', 'users.id')
                    //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                    ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"')
                    ->where('crm_cases.contact_id', '=', request('id'))
                    ->get();
            } else if ($request->input('seachtype') === "1") {
                $datas = DB::table('crm_cases')
                    ->select('crm_cases.id as id', 'hn', DB::raw("concat(fname, ' ', lname) as name"), 'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'users.name as agent')
                    ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                    ->join('users', 'crm_cases.agent', '=', 'users.id')
                    //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                    ->where('casestatus', '=', 'กำลังดำเนินการ')
                    ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"')
                    ->where('crm_cases.contact_id', '=', request('id'))
                    ->get();
            } else if ($request->input('seachtype') === "2") {
                $datas = DB::table('crm_cases')
                    ->select('crm_cases.id as id', 'hn', DB::raw("concat(fname, ' ', lname) as name"), 'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'users.name as agent')
                    ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                    ->join('users', 'crm_cases.agent', '=', 'users.id')
                    //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                    ->where('casestatus', '=', 'ปิดเคส')
                    ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"')
                    ->where('crm_cases.contact_id', '=', request('id'))
                    ->get();
            } else if ($request->input('seachtype') === "3") {
                $datas = DB::table('crm_cases')
                    ->select('crm_cases.id as id', 'hn', DB::raw("concat(fname, ' ', lname) as name"), 'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'users.name as agent')
                    ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                    ->join('users', 'crm_cases.agent', '=', 'users.id')
                    //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                    ->where('crm_contacts.hn', 'like', '%' . $request->input('seachtext') . '%')
                    ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"')
                    ->where('crm_cases.contact_id', '=', request('id'))
                    ->get();
            } else if ($request->input('seachtype') === "4") {
                $datas = DB::table('crm_cases')
                    ->select('crm_cases.id as id', 'hn', DB::raw("concat(fname, ' ', lname) as name"), 'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'users.name as agent')
                    ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                    ->join('users', 'crm_cases.agent', '=', 'users.id')
                    //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                    ->where('crm_contacts.fname', 'like', '%' . $request->input('seachtext') . '%')
                    ->orWhere('crm_contacts.lname', 'like', '%' . $request->input('seachtext') . '%')
                    ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"')
                    ->where('crm_cases.contact_id', '=', request('id'))
                    ->get();
            } else if ($request->input('seachtype') === "5") {
                $datas = DB::table('crm_cases')
                    ->select('crm_cases.id as id', 'hn', DB::raw("concat(fname, ' ', lname) as name"), 'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'users.name as agent')
                    ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                    ->join('users', 'crm_cases.agent', '=', 'users.id')
                    //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                    ->where('crm_contacts.phoneno', 'like', '%' . $request->input('seachtext') . '%')
                    ->orWhere('crm_contacts.telhome', 'like', '%' . $request->input('seachtext') . '%')
                    ->orWhere('crm_contacts.workno', 'like', '%' . $request->input('seachtext') . '%')
                    ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"')
                    ->where('crm_cases.contact_id', '=', request('id'))
                    ->get();
            }


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
        $contacts = DB::table('crm_contacts')->whereRaw('id = ' . request('id') . '')->get();
        return view('casescontract.index')->with(['contacts' => $contacts]);
    }
    public function create()
    {
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $valifield =  [
            'contact_id' => 'required',
            'caseid1' => 'required|string|max:100',
            'casedetail' => 'required|string|max:200',
        ];
        $valimess = [
            'contact_id.required' => 'กรุณาระบุผู้ติดต่อ',
            'caseid1.required' => 'กรุณาเลือกประเภทการติดต่อ',
            'casedetail.required' => 'กรุณากรอกรายละเอียดที่ติดต่อ',
        ];
        $validator =  Validator::make($request->all(), $valifield, $valimess);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $input = $request->all();
        $input = array_merge($input, ['agent' => $user->id]);
        $contract = CrmCase::create($input);
        return response()->json(['success' => 'เพิ่ม เรื่องที่ติดต่อ เรียบร้อยแล้ว']);
    }

    public function edit($id)
    {

        $data = CrmCase::find($id);
        return response()->json(['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $valifield =  [
            'caseid1' => 'required|string|max:100',
            'casedetail' => 'required|string|max:200',
        ];
        $valimess = [
            'caseid1.required' => 'กรุณาเลือกประเภทการติดต่อ',
            'casedetail.required' => 'กรุณากรอกรายละเอียดที่ติดต่อ',
        ];
        $validator =  Validator::make($request->all(), $valifield, $valimess);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $companyd = [
            'adddate' => $request->get('adddate'),
            'casetype1' => $request->get('casetype1'),
            'caseid1' => $request->get('caseid1'),
            'tranferstatus' => $request->get('tranferstatus'),
            'casedetail' => $request->get('casedetail'),
            'casestatus' => $request->get('casestatus'),
            'agent' => $user->id,
        ];

        if (!empty($request->get('casetype2'))) {
            $companyd = array_merge($companyd, ['casetype2' => $request->get('casetype2'), 'caseid2' => $request->get('caseid2')]);
        } else {
            $companyd = array_merge($companyd, ['casetype2' => '', 'caseid2' => 0]);
        }
        if (!empty($request->get('casetype3'))) {
            $companyd = array_merge($companyd, ['casetype3' => $request->get('casetype3'), 'caseid3' => $request->get('caseid3')]);
        } else {
            $companyd = array_merge($companyd, ['casetype3' => '', 'caseid3' => 0]);
        }
        if (!empty($request->get('casetype4'))) {
            $companyd = array_merge($companyd, ['casetype4' => $request->get('casetype4'), 'caseid4' => $request->get('caseid4')]);
        } else {
            $companyd = array_merge($companyd, ['casetype4' => '', 'caseid4' => 0]);
        }
        if (!empty($request->get('casetype5'))) {
            $companyd = array_merge($companyd, ['casetype5' => $request->get('casetype5'), 'caseid5' => $request->get('caseid5')]);
        } else {
            $companyd = array_merge($companyd, ['casetype5' => '', 'caseid5' => 0]);
        }
        if (!empty($request->get('casetype6'))) {
            $companyd = array_merge($companyd, ['casetype6' => $request->get('casetype6'), 'caseid6' => $request->get('caseid6')]);
        } else {
            $companyd = array_merge($companyd, ['casetype6' => '', 'caseid6' => 0]);
        }

        $company = CrmCase::find($id);

        $caseslog = [
            'id' => $company->id,
            'contact_id' => $company->contact_id,
            'adddate' => $company->adddate,
            'uniqid' => $company->uniqid,
            'telno' => $company->telno,
            'casetype1' => $company->casetype1,
            'caseid1' => $company->caseid1,
            'casetype2' => $company->casetype2,
            'caseid2' => $company->caseid2,
            'casetype3' => $company->casetype3,
            'caseid3' => $company->caseid3,
            'casetype4' => $company->casetype4,
            'caseid4' => $company->caseid4,
            'casetype5' => $company->casetype5,
            'caseid5' => $company->caseid5,
            'casetype6' => $company->casetype6,
            'caseid6' => $company->caseid6,
            'tranferstatus' => $company->tranferstatus,
            'casedetail' => $company->casedetail,
            'casestatus' => $company->casestatus,
            'agent' => $company->agent,
            'created_at' => $company->created_at,
            'updated_at' => $company->updated_at,
            'modifyaction' => 'edit',
            'modifyagent' => $user->id,
        ];

        CrmCaseslog::create($caseslog);
        $company->update($companyd);

        return response()->json(['success' => 'แก้ไข เรื่องที่ติดต่อ เรียบร้อยแล้ว']);
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        $id = $request->get('id');
        $company = CrmCase::find($id);

        $caseslog = [
            'id' => $company->id,
            'contact_id' => $company->contact_id,
            'adddate' => $company->adddate,
            'uniqid' => $company->uniqid,
            'telno' => $company->telno,
            'casetype1' => $company->casetype1,
            'caseid1' => $company->caseid1,
            'casetype2' => $company->casetype2,
            'caseid2' => $company->caseid2,
            'casetype3' => $company->casetype3,
            'caseid3' => $company->caseid3,
            'casetype4' => $company->casetype4,
            'caseid4' => $company->caseid4,
            'casetype5' => $company->casetype5,
            'caseid5' => $company->caseid5,
            'casetype6' => $company->casetype6,
            'caseid6' => $company->caseid6,
            'tranferstatus' => $company->tranferstatus,
            'casedetail' => $company->casedetail,
            'casestatus' => $company->casestatus,
            'agent' => $company->agent,
            'created_at' => $company->created_at,
            'updated_at' => $company->updated_at,
            'modifyaction' => 'delete',
            'modifyagent' => $user->id,
        ];

        CrmCaseslog::create($caseslog);
        $company->delete();
        return ['success' => true, 'message' => 'ลบ เรื่องที่ติดต่อ เรียบร้อยแล้ว'];
    }

    public function destroy_all(Request $request)
    {
        $user = Auth::user();
        $arr_del  = $request->get('table_records');

        for ($xx = 0; $xx < count($arr_del); $xx++) {
            //CrmCase::find($arr_del[$xx])->delete();
            $company = CrmCase::find($arr_del[$xx]);


            $caseslog = [
                'id' => $company->id,
                'contact_id' => $company->contact_id,
                'adddate' => $company->adddate,
                'uniqid' => $company->uniqid,
                'telno' => $company->telno,
                'casetype1' => $company->casetype1,
                'caseid1' => $company->caseid1,
                'casetype2' => $company->casetype2,
                'caseid2' => $company->caseid2,
                'casetype3' => $company->casetype3,
                'caseid3' => $company->caseid3,
                'casetype4' => $company->casetype4,
                'caseid4' => $company->caseid4,
                'casetype5' => $company->casetype5,
                'caseid5' => $company->caseid5,
                'casetype6' => $company->casetype6,
                'caseid6' => $company->caseid6,
                'tranferstatus' => $company->tranferstatus,
                'casedetail' => $company->casedetail,
                'casestatus' => $company->casestatus,
                'agent' => $company->agent,
                'created_at' => $company->created_at,
                'updated_at' => $company->updated_at,
                'modifyaction' => 'delete',
                'modifyagent' => $user->id,
            ];

            CrmCaseslog::create($caseslog);
            $company->delete();
        }

        return redirect('casescontract?id=' . $request->get('Delcontact_id'))->with('success', 'ลบ เรื่องที่ติดต่อ เรียบร้อยแล้ว');
    }
}
