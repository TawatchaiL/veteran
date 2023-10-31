<?php

namespace App\Http\Controllers;

use App\Models\CrmContact;
use App\Models\CrmCase;
use App\Models\Case_type;
use App\Models\CrmCaseComment;
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
                ->select('crm_cases.id as id','hn', DB::raw("concat(fname, ' ', lname) as name"),'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'crm_cases.agent')
                ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"')
                //->where('crm_cases.contact_id', '=', request('id'))
                ->get();
            }else if ($request->input('seachtype') === "1") {
                $datas = DB::table('crm_cases')
                ->select('crm_cases.id as id','hn', DB::raw("concat(fname, ' ', lname) as name"),'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'crm_cases.agent')
                ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                ->where('casestatus', '=', 'กำลังดำเนินการ')
                ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"')
                //->where('crm_cases.contact_id', '=', request('id'))
                ->get();
            }else if ($request->input('seachtype') === "2") {
                $datas = DB::table('crm_cases')
                ->select('crm_cases.id as id','hn', DB::raw("concat(fname, ' ', lname) as name"),'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'crm_cases.agent')
                ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                ->where('casestatus', '=', 'ปิดเคส')
                ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"')
                //->where('crm_cases.contact_id', '=', request('id'))
                ->get();
            }else if ($request->input('seachtype') === "3") {
                $datas = DB::table('crm_cases')
                ->select('crm_cases.id as id','hn', DB::raw("concat(fname, ' ', lname) as name"),'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'crm_cases.agent')
                ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                ->where('crm_contacts.hn', 'like', '%' . $request->input('seachtext') . '%')
                ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"')
                //->where('crm_cases.contact_id', '=', request('id'))
                ->get();
            }else if ($request->input('seachtype') === "4") {
                $datas = DB::table('crm_cases')
                ->select('crm_cases.id as id','hn', DB::raw("concat(fname, ' ', lname) as name"),'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'crm_cases.agent')
                ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                ->where('crm_contacts.fname', 'like', '%' . $request->input('seachtext') . '%')
                ->orWhere('crm_contacts.lname', 'like', '%' . $request->input('seachtext') . '%')
                ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"')
                ->get();
            }else if ($request->input('seachtype') === "5") {
                $datas = DB::table('crm_cases')
                ->select('crm_cases.id as id','hn', DB::raw("concat(fname, ' ', lname) as name"),'phoneno', 'crm_cases.created_at', 'crm_cases.casetype1 as casename', 'casestatus', 'tranferstatus', 'crm_cases.agent')
                ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
                //->join('case_types', 'crm_cases.casetype1', '=', 'case_types.id')
                ->where('crm_contacts.phoneno', 'like', '%' . $request->input('seachtext') . '%')
                ->orWhere('crm_contacts.telhome', 'like', '%' . $request->input('seachtext') . '%')
                ->orWhere('crm_contacts.workno', 'like', '%' . $request->input('seachtext') . '%')
                ->whereRaw('crm_cases.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"')
                //->where('crm_cases.contact_id', '=', request('id'))
                ->get();
            }
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
        //$contacts = DB::table('crm_contacts')->whereRaw('id = '.request('id').'')->get();
        return view('cases.index')->with(['casetype' => $company]);
    }

    public function create()
    {
        
    }

    public function seachcontact($id)
    {
        //$data = CrmContact::select('crm_contacts.hn as hn')
        //$data = DB::table('crm_contacts')->get();
       // $data = CrmContact::find($id);
       $data = CrmContact::select("id","hn", "fname", "lname")
       ->where('hn', 'LIKE', '%'. $id. '%')
       ->get();
       return response()->json($data);
    }

    public function store(Request $request)
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

        $input = $request->all();
        $input = array_merge($input, ['agent' => $user->phone]);
        $contract = CrmCase::create($input);
        return response()->json(['success' => 'เพิ่ม เรื่องที่ติดต่อ เรียบร้อยแล้ว']);
    }

    public function edit($id)
    {
        $data = CrmCase::join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
        ->select('crm_cases.*','crm_contacts.hn as hn', DB::raw("concat(crm_contacts.fname, ' ', crm_contacts.lname) as name"))
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
            'casetype1' => $request->get('casetype1'),
            'caseid1' => $request->get('caseid1'),
            'tranferstatus' => $request->get('tranferstatus'),
            'casedetail' => $request->get('casedetail'),
            'casestatus' => $request->get('casestatus'),
            'agent' => $user->phone,
        ];

        if (!empty($request->get('casetype2'))) {
            $companyd = array_merge($companyd, ['casetype2' => $request->get('casetype2'), 'caseid2' => $request->get('caseid2')]);
        }else{
            $companyd = array_merge($companyd, ['casetype2' => '', 'caseid2' => 0]);
        }
        if (!empty($request->get('casetype3'))) {
            $companyd = array_merge($companyd, ['casetype3' => $request->get('casetype3'), 'caseid3' => $request->get('caseid3')]);
        }else{
            $companyd = array_merge($companyd, ['casetype3' => '', 'caseid3' => 0]);
        }
        if (!empty($request->get('casetype4'))) {
            $companyd = array_merge($companyd, ['casetype4' => $request->get('casetype4'), 'caseid4' => $request->get('caseid4')]);
        }else{
            $companyd = array_merge($companyd, ['casetype4' => '', 'caseid4' => 0]);
        }
        if (!empty($request->get('casetype5'))) {
            $companyd = array_merge($companyd, ['casetype5' => $request->get('casetype5'), 'caseid5' => $request->get('caseid5')]);
        }else{
            $companyd = array_merge($companyd, ['casetype5' => '', 'caseid5' => 0]);
        }
        if (!empty($request->get('casetype6'))) {
            $companyd = array_merge($companyd, ['casetype6' => $request->get('casetype6'), 'caseid6' => $request->get('caseid6')]);
        }else{
            $companyd = array_merge($companyd, ['casetype6' => '', 'caseid6' => 0]);
        }

       $company = CrmCase::find($id);
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
        $input = array_merge($input, ['agent' => $user->phone]);
        $contract = CrmCaseComment::create($input);

        //$case_id = $request->input('case_id');
        //$comment = $request->input('comment');
        //$agent = $user->phone;
        //$data=array('case_id'=>$case_id,'comment'=>$comment,'agent'=>$agent);
        //DB::table('crm_case_comments')->insert($data);

        return response()->json(['success' => 'แสดงความคิดเห็น เรื่องที่ติดต่อ เรียบร้อยแล้ว']);
        //return response()->json(['success' => $user->id]);
    }

    public function commentlist(Request $request)
    {
        $id = $request->input('id');
        $data = CrmCaseComment::where('case_id', $id)->get();

        $template = 'cases.commentlist';
        $htmlContent = View::make($template, ['casecomment' => $data])->render();
        return response()->json(['html' =>  $htmlContent,]);

        //return response()->json(['data' => $data]);

    }
    public function commentview(Request $request)
    {
        $commentid = $request->input('commentid');
        $data = CrmCaseComment::where('id', $commentid)->get();
        $datac = CrmCase::where('id', $data->id)->get();

        $template = 'cases.commentdetail';
        $htmlContent = View::make($template, ['casecomment' => $data, 'cases' => $datac])->render();
        return response()->json(['html' =>  $htmlContent,]);

        //return response()->json(['data' => $data]);

    }
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        CrmCase::find($id)->delete();
        return ['success' => true, 'message' => 'ลบ เรื่องที่ติดต่อ เรียบร้อยแล้ว'];
    }

    public function destroy_all(Request $request)
    {

        $arr_del  = $request->get('table_records');

        for ($xx = 0; $xx < count($arr_del); $xx++) {
            CrmCase::find($arr_del[$xx])->delete();
        }

        return redirect('casescontract')->with('success', 'ลบ เรื่องที่ติดต่อ เรียบร้อยแล้ว');
    }
}
