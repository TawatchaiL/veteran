<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Services\GraphService;

class CallstatusController extends Controller
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
                    $startDate = date("Y-m-d");
                    $endDate = date("Y-m-t", strtotime($startDate));  
        }
        //$datas = DB::connection('remote_connection')
        //    ->table('call_center.call_entry')
        //    ->select('crm_id', DB::raw('count(crm_id) as agentcall'), DB::raw('SUM(if(status = "terminada",1,0)) as terminada') ,DB::raw('SEC_TO_TIME(ROUND(AVG(duration_wait), 0)) as avgwait'), DB::raw('SEC_TO_TIME(SUM(duration)) as duration') , DB::raw('SEC_TO_TIME(ROUND(AVG(duration), 0)) as avgduration'))
        //    ->whereRaw('datetime_init between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59" and crm_id is not null')
        //    ->groupBy('crm_id')
        //    ->get();
        $datac = DB::connection('remote_connection')
            ->table('call_center.call_entry')
            ->select('crm_id', DB::raw('count(crm_id) as agentcall'), DB::raw('SUM(if(status = "terminada",1,0)) as terminada') ,DB::raw('SEC_TO_TIME(ROUND(AVG(duration_wait), 0)) as avgwait'), DB::raw('SEC_TO_TIME(SUM(duration)) as duration') , DB::raw('SEC_TO_TIME(ROUND(AVG(duration), 0)) as avgduration'),'logintime','breaktime')
            ->whereRaw('datetime_init between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59" and crm_id is not null')
            ->groupBy('crm_id');
            //->toSql();
            
        $dataa = DB::connection('remote_connection')
            ->table('call_center.audit')
            ->select('crm_id as crmid', DB::raw('SEC_TO_TIME(SUM(if(id_break is null,duration,0))) as logintime'), DB::raw('SEC_TO_TIME(SUM(if(id_break is not null,duration,0))) as breaktime'))
            ->whereRaw('datetime_init between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59" and crm_id is not null')
            ->groupBy('crm_id');
            //->get();

        $datas = $datac
            ->leftJoinSub($dataa, 'dataa', function ($join) {
                $join->on('call_entry.crm_id', '=', 'dataa.crmid');
            })
            ->get();

        $agents = User::orderBy("id", "asc")->get();
            
            if ($request->ajax()) {
                $agent_data = array();
                foreach ($agents as $agent) {
                    $agent_data[$agent->id] = $agent->name;
                }
                return datatables()->of($datas)
                    ->editColumn('checkbox', function ($row) {
                        return '<input type="checkbox" id="" class="flat" name="table_records[]" value="" >';
                    })
                    ->addColumn('agent', function ($row) use ($agent_data){
                        if (isset($agent_data[$row->crm_id])) {
                            return $agent_data[$row->crm_id];
                        } else {
                            return 'Agent not found';
                        }
                    })
                    ->rawColumns(['checkbox', 'action', 'agent'])->toJson();
            }

        return view('callstatus.index');
    }

}
