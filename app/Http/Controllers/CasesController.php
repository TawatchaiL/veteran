<?php

namespace App\Http\Controllers;

use App\Models\CrmContact;
use App\Models\CrmCase;
use App\Models\User;
use App\Models\CrmCaseComment;
use App\Models\CrmCaseslog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
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
    public function index(Request $request)
    {

        if ($request->ajax()) {
            //dd($request->input('seachtype').$request->input('seachtext'));
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
                    ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"');
                //->where('crm_cases.contact_id', '=', request('id'))
                //->get();
            } else if ($request->input('seachtype') === "1") {
                $datas = DB::table('crm_cases')
                    ->select('crm_cases.id as id', 'hn', DB::raw("concat(fname, ' ', lname) as name"), 'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'users.name as agent')
                    ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                    ->join('users', 'crm_cases.agent', '=', 'users.id')
                    //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                    ->where('casestatus', '=', 'กำลังดำเนินการ')
                    ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"');
                //->where('crm_cases.contact_id', '=', request('id'))
                //->get();
            } else if ($request->input('seachtype') === "2") {
                $datas = DB::table('crm_cases')
                    ->select('crm_cases.id as id', 'hn', DB::raw("concat(fname, ' ', lname) as name"), 'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'users.name as agent')
                    ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                    ->join('users', 'crm_cases.agent', '=', 'users.id')
                    //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                    ->where('casestatus', '=', 'ปิดเคส')
                    ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"');
                //->where('crm_cases.contact_id', '=', request('id'))
                //->get();
            } else if ($request->input('seachtype') === "3") {
                $datas = DB::table('crm_cases')
                    ->select('crm_cases.id as id', 'hn', DB::raw("concat(fname, ' ', lname) as name"), 'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'users.name as agent')
                    ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                    ->join('users', 'crm_cases.agent', '=', 'users.id')
                    //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                    ->where('crm_contacts.hn', 'like', '%' . $request->input('seachtext') . '%')
                    ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"');
                //->where('crm_cases.contact_id', '=', request('id'))
                //->get();
            } else if ($request->input('seachtype') === "4") {
                $datas = DB::table('crm_cases')
                    ->select('crm_cases.id as id', 'hn', DB::raw("concat(fname, ' ', lname) as name"), 'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'users.name as agent')
                    ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                    ->join('users', 'crm_cases.agent', '=', 'users.id');
                //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                //manon fix
                if (strpos($request->input('seachtext'), ' ') !== false) {
                    $aname = explode(' ', $request->input('seachtext'));
                    $datas->where('crm_contacts.fname', 'like', $aname[0] . '%')
                        ->orWhere('crm_contacts.lname', 'like', $aname[1] . '%');
                } else {
                    $aname = $request->input('seachtext');
                    $datas->where('crm_contacts.fname', 'like', $aname . '%')
                        ->orWhere('crm_contacts.lname', 'like', $aname . '%');
                }
                $datas->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"');
                //->get();
            } else if ($request->input('seachtype') === "5") {
                $datas = DB::table('crm_cases')
                    ->select('crm_cases.id as id', 'hn', DB::raw("concat(fname, ' ', lname) as name"), 'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'users.name as agent')
                    ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                    ->join('users', 'crm_cases.agent', '=', 'users.id')
                    //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                    ->where('crm_contacts.phoneno', 'like', '%' . $request->input('seachtext') . '%')
                    ->orWhere('crm_contacts.telhome', 'like', '%' . $request->input('seachtext') . '%')
                    ->orWhere('crm_contacts.workno', 'like', '%' . $request->input('seachtext') . '%')
                    ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"');
                //->where('crm_cases.contact_id', '=', request('id'))
                //->get();
            }

            $datas->orderBy("created_at", "desc")->get();


            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->id . '" >';
                })
                ->editColumn('created_at', function ($row) {
                    //$adddate = Carbon::parse($row->created_at)->addYears(543)->format('d/m/Y H:i:s');
                    $adddate = Carbon::parse($row->created_at)->format('Y-m-d H:i:s');
                    return $adddate;
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
        $contacts = DB::table('crm_contacts')->orderBy('id', 'asc')->get();
        return view('cases.index')->with(['contacts' => $contacts]);
    }

    public function create()
    {
    }

    public function seachcontact($id)
    {
        //$data = CrmContact::select('crm_contacts.hn as hn')
        //$data = DB::table('crm_contacts')->get();
        // $data = CrmContact::find($id);
        $data = CrmContact::select("id", "hn", "fname", "lname")
            ->where('hn', 'LIKE', '%' . $id . '%')
            ->get();
        return response()->json($data);
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

        $input = $request->all();
        $input = array_merge($input, ['agent' => $user->id]);
        $contract = CrmCase::create($input);
        return response()->json(['success' => 'เพิ่ม เรื่องที่ติดต่อ เรียบร้อยแล้ว']);
    }

    public function edit($id)
    {
        $data = CrmCase::join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
            ->select('crm_cases.*', 'crm_contacts.hn as hn', DB::raw("concat(crm_contacts.fname, ' ', crm_contacts.lname) as name"))
            ->where('crm_cases.id', $id)
            ->first();

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

    public function casecomment(Request $request, $id)
    {
        $user = Auth::user();

        $valifield =  [
            'comment' => 'required|string|max:100',
        ];
        $valimess = [
            'comment.required' => 'กรุณาแสดงความคิดเห็น',
        ];
        $validator =  Validator::make($request->all(), $valifield, $valimess);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $input = $request->all();
        $input = array_merge($input, ['agent' => $user->id]);
        $contract = CrmCaseComment::create($input);

        //$case_id = $request->input('case_id');
        //$comment = $request->input('comment');
        //$agent = $user->phone;
        //$data=array('case_id'=>$case_id,'comment'=>$comment,'agent'=>$agent);
        //DB::table('crm_case_comments')->insert($data);

        return response()->json(['success' => 'แสดงความคิดเห็น เรียบร้อยแล้ว']);
        //return response()->json(['success' => $user->id]);
    }

    public function commentlist(Request $request)
    {
        $id = $request->input('id');
        //$data = CrmCaseComment::where('case_id', $id)->get();

        $data = CrmCaseComment::select('crm_case_comments.*', 'users.name as agentname')
            ->join('users', 'crm_case_comments.agent', '=', 'users.id')
            ->where('crm_case_comments.case_id', $id)
            ->orderBy("id", "desc")
            ->limit(20)
            ->get();

        $template = 'cases.commentlist';
        $htmlContent = View::make($template, ['casecomment' => $data])->render();
        return response()->json(['html' =>  $htmlContent,]);

        //return response()->json(['data' => $data]);

    }
    public function commentview(Request $request)
    {
        $commentid = $request->input('commentid');
        $data = CrmCaseComment::where('id', $commentid)->first();
        $datac = CrmCase::where('id', $data->case_id)->first();
        $datact = CrmContact::where('id', $datac->contact_id)->first();

        $template = 'cases.commentdetail';
        $htmlContent = View::make($template, ['casecomment' => $data, 'cases' => $datac, 'datact' => $datact])->render();
        //$htmlContent = View::make($template, ['casecomment' => $data])->render();
        return response()->json(['html' =>  $htmlContent,]);

        //return response()->json(['data' => $data]);

    }

    public function caseslist(Request $request)
    {
        $id = $request->input('id');
        if (!empty($request->get('tabid'))) {
            $tabid = $request->input('tabid');
        } else {
            $tabid = '';
        }

        $data = CrmCase::where('contact_id', $id)
            ->orderBy("id", "desc")
            ->limit(10)
            ->get();

        $agens = User::orderBy('name', 'asc')->get();
        $agentArray = [];
        $agentArray[0]['name'] = 'All';
        foreach ($agens as $agen) {
            $agentArray[$agen->id]['name'] = $agen->name;
        }


        $template = 'cases.caseslist';
        $htmlContent = View::make($template, ['caselist' => $data, 'cardid' => $tabid, 'agent' => $agentArray])->render();
        return response()->json(['html' =>  $htmlContent,]);

        //return response()->json(['data' => $data]);

    }

    public function casesview(Request $request)
    {
        $casesid = $request->input('id');
        $tabid = $request->input('tabid');
        $datac = CrmCase::where('id', $casesid)->first();
        $datact = CrmContact::where('id', $datac->contact_id)->first();

        $template = 'cases.casesdetail';
        $htmlContent = View::make($template, ['cases' => $datac, 'datact' => $datact, 'cardid' => $tabid])->render();
        //$htmlContent = View::make($template, ['casecomment' => $data])->render();
        return response()->json(['html' =>  $htmlContent,]);

        //return response()->json(['data' => $data]);

    }

    public function caseslistlog(Request $request)
    {
        $id = $request->input('id');
        //$data = CrmCaseslog::where('id', $id)->get();

        $data = CrmCaseslog::select('crm_caseslogs.*', 'users.name as agentname')
            ->join('users', 'crm_caseslogs.modifyagent', '=', 'users.id')
            ->where('crm_caseslogs.id', $id)
            ->orderBy("id", "desc")
            ->limit(20)
            ->get();

        $template = 'cases.casesloglist';
        $htmlContent = View::make($template, ['caselog' => $data])->render();
        return response()->json(['html' =>  $htmlContent,]);
    }
    public function casesviewlog(Request $request)
    {
        $id = $request->input('id');
        $data = CrmCaseslog::where('lid', $id)->first();
        $datac = CrmCase::where('id', $data->id)->first();
        $datact = CrmContact::where('id', $datac->contact_id)->first();

        $template = 'cases.caseslogdetail';
        $htmlContent = View::make($template, ['caselog' => $data, 'cases' => $datac, 'datact' => $datact])->render();
        //$htmlContent = View::make($template, ['casecomment' => $data])->render();
        return response()->json(['html' =>  $htmlContent,]);
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        $id = $request->get('id');
        //CrmCase::find($id)->delete();
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
            // CrmCase::find($arr_del[$xx])->delete();
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

        return redirect('cases')->with('success', 'ลบ เรื่องที่ติดต่อ เรียบร้อยแล้ว');
    }
}
