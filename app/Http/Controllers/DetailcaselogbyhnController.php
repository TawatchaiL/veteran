<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Services\GraphService;

class DetailcaselogbyhnController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('permission:contact-list|contact-create|contact-edit|contact-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:contact-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:contact-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:contact-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!empty($request->get('sdate'))) {
            $dateRange = $request->input('sdate');
            if ($dateRange) {
                $dateRangeArray = explode(' - ', $dateRange);
                if (!empty($dateRangeArray) && count($dateRangeArray) == 2) {
                    $startDate = $dateRangeArray[0];
                    $endDate = $dateRangeArray[1];
                }
            }
        }else{
            $startDate = date("Y-m-d H:i:s");
            $endDate = date("Y-m-t H:i:s", strtotime($startDate));  
        }

        if (!empty($request->get('agent'))) {
            $agentseachc = ' and crm_case_comments.agent = ' . $request->input('agent') . '';
            $agentseachl = ' and crm_caseslogs.modifyagent = ' . $request->input('agent') . '';
        }else{
            $agentseachc = '';
            $agentseachl = '';
        }
        $datac = DB::table('crm_case_comments')
        ->select('crm_cases.agent as cagent','crm_cases.id as cid','crm_cases.contact_id as contact_id', DB::raw('CONCAT("comment") as caction'), 'users.name as magent', 'crm_case_comments.created_at as mdate')
        ->join('crm_cases', 'crm_case_comments.case_id', '=', 'crm_cases.id')
        ->join('users', 'crm_case_comments.agent', '=', 'users.id')
        ->whereRaw('crm_case_comments.created_at between "' . $startDate . '" and "' . $endDate . '"'.$agentseachc)
        ->toSql();

        $getData = DB::table('crm_contacts')
        ->join(DB::raw("({$datac}) as services"), 'services.contact_id', '=', 'crm_contacts.id')
        ->select('cagent', 'cid', 'crm_contacts.hn','caction', 'magent', 'mdate');

        $datas = DB::table('crm_caseslogs')
        ->select('crm_caseslogs.agent as cagent','crm_caseslogs.id as cid','crm_contacts.hn as chn', 'crm_caseslogs.modifyaction as caction', 'users.name as magent', 'crm_caseslogs.modifydate as mdate')
        ->join('crm_contacts', 'crm_caseslogs.contact_id', '=', 'crm_contacts.id')
        ->join('users', 'crm_caseslogs.modifyagent', '=', 'users.id')
        ->whereRaw('crm_caseslogs.modifydate between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"'.$agentseachl)
        ->union($getData)
        ->get();

        $agents = User::orderBy("id", "asc")->get();

        if ($request->ajax()) {
            $agent_data = array();
            foreach ($agents as $agent) {
                $agent_data[$agent->id] = $agent->name;
            }
            return datatables()->of($datas)
                //->editColumn('checkbox', function ($row) {
                //    return '<input type="checkbox" id="" class="flat" name="table_records[]" value="" >';
                //})->rawColumns(['checkbox', 'action'])
                ->editColumn('mdate', function ($row) {
                    $adddate = Carbon::parse($row->mdate)->addYears(543)->format('d/m/Y H:i:s');
                    return $adddate;
                })
                ->addColumn('agent', function ($row) use ($agent_data){
                    if (isset($agent_data[$row->cagent])) {
                        return $agent_data[$row->cagent];
                    } else {
                        return 'Agent not found';
                    }
                })
                ->toJson();
        }

        return view('detailcaselogbyhn.index')->with(['agents' => $agents]);
    }

}
