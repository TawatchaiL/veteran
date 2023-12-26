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

class DetailcaseexternalnumberController extends Controller
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
        if(!empty($request->get('agent')) && $request->get('agent') != "0"){
            $sqlagent = " and crm_id = '".$request->input('agent')."'";
        }else{
            $sqlagent = "";
        }    
        //$datas = DB::connection('remote_connection')
        //->table(DB::raw('(SELECT @rownumber:=@rownumber + 1 AS rownumber, t.* FROM (SELECT DATE(datetime_init) as cdate, TIME(datetime_init) as ctime, callerid as telno, crm_id as agentid, SEC_TO_TIME(duration) as duration, SEC_TO_TIME(duration_wait) as duration_wait FROM call_center.call_entry WHERE LENGTH(callerid) > 5 AND datetime_init BETWEEN "' . $startDate . '" AND "' . $endDate . '"' .$sqlagent. ' ORDER BY datetime_init) t, (SELECT @rownumber:=0) r) AS temp'))
        //->select('rownumber', 'cdate', 'ctime', 'telno', 'agentid', 'duration', 'duration_wait');

        $datas = DB::connection('remote_connection')
        ->table(DB::raw('(SELECT @rownumber:=0) AS temp, call_center.call_entry'))
        ->select(DB::raw('(@rownumber:=@rownumber + 1) AS rownumber'), 'datetime_init as cdate', DB::raw('TIME(datetime_init) as ctime'),'callerid as telno','crm_id as agentid', DB::raw('SEC_TO_TIME(duration) as duration'), DB::raw('SEC_TO_TIME(duration_wait) as duration_wait'))
        ->whereRaw('LENGTH(callerid) > 5 and datetime_init between "' . $startDate . '" and "' . $endDate . '"'.$sqlagent.' ORDER BY datetime_init DESC')
        ->get();

            $agents = User::orderBy("id", "asc")->get();
            if ($request->ajax()) {
                $agent_data = array();
                foreach ($agents as $agent) {
                    $agent_data[$agent->id] = $agent->name;
                }
                return datatables()->of($datas)
                    ->addColumn('agent', function ($row) use ($agent_data){
                        if (isset($agent_data[$row->agentid])) {
                            return $agent_data[$row->agentid];
                        } else {
                            return 'Agent not found';
                        }
                    })
                    ->rawColumns(['checkbox', 'action', 'agent'])->toJson();
            }

        return view('detailcaseexternalnumber.index')->with(['agents' => $agents]);
    }


}
