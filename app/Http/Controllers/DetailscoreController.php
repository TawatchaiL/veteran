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

class DetailscoreController extends Controller
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

        $datas = DB::connection('remote_connection')
            ->table(DB::raw('(SELECT @rownumber:=@rownumber + 1 AS rownumber, t.* FROM (SELECT datetime, DATE(datetime) as cdate, TIME(datetime) as ctime, clid, queue, crm_id, score FROM call_center.agent_score WHERE call_center.agent_score.datetime BETWEEN "' . $startDate . '" AND "' . $endDate . '"' .$sqlagent. ' ORDER BY call_center.agent_score.datetime DESC) t, (SELECT @rownumber:=0) r) AS temp'))
            ->select('rownumber', 'cdate', 'ctime', 'clid', 'queue', 'crm_id', 'score')
            ->orderBy('datetime', 'desc')
            ->get();
/*
        $datas = DB::connection('remote_connection')
            ->table(DB::raw('(SELECT @rownumber:=0) AS temp, call_center.agent_score'))
            ->select(DB::raw('(@rownumber:=@rownumber + 1) AS rownumber'), DB::raw('DATE(datetime) as cdate'), DB::raw('TIME(datetime) as ctime'),'clid','queue','crm_id','score' )
            ->whereRaw('call_center.agent_score.datetime between "' . $startDate . '" and "' . $endDate . '"');
            if(!empty($request->get('agent')) && $request->get('agent') != "0"){
                $datas->whereRaw('crm_id = "'. $request->input('agent') .'"');  
            }   
            $datas->orderBy("call_center.agent_score.datetime", "desc")
            ->get();
*/
        $agents = User::orderBy("id", "asc")->get();
            $agent_data = array();
            foreach ($agents as $agent) {
                $agent_data[$agent->id] = $agent->name;
            }

        if ($request->ajax()) {

            return datatables()->of($datas)
                ->addColumn('agent', function ($row) use ($agent_data){
                    if (isset($agent_data[$row->crm_id])) {
                        return $agent_data[$row->crm_id];
                    } else {
                        return 'Agent not found';
                    }
                })
                ->toJson();
        }

        return view('detailscore.index')->with(['agents' => $agents]);
    }

}
