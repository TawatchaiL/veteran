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

class DetailscoreagentController extends Controller
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
        ->table(DB::raw('(SELECT @rownumber:=@rownumber + 1 AS rownumber, t.* FROM (SELECT crm_id, score, count(id) as sumscore FROM call_center.agent_score WHERE call_center.agent_score.datetime BETWEEN "' . $startDate . '" AND "' . $endDate . '"'.$sqlagent. 'GROUP BY crm_id, score ORDER BY call_center.agent_score.score DESC) t, (SELECT @rownumber:=0) r) AS temp'))
        ->select('rownumber', 'crm_id', 'score', 'sumscore')
        ->get();
/*
        $datas = DB::connection('remote_connection')
            ->table(DB::raw('(SELECT @rownumber:=0) AS temp, call_center.agent_score'))
            //->select('call_center.agent_score.score as score',  DB::raw('count(call_center.agent_score.score) as sumscore'))
            ->select(DB::raw('(@rownumber:=@rownumber + 1) AS rownumber'), 'score',  DB::raw('count(id) as sumscore'))
            ->whereRaw('call_center.agent_score.datetime between "' . $startDate . '" and "' . $endDate . '"'.$agentseachc)
            ->groupBy('score')
            ->orderBy("score", "desc")
            ->get();
*/
            $agents = User::orderBy("id", "asc")->get();
            $agent_data = array();
            foreach ($agents as $agent) {
                $agent_data[$agent->id] = $agent->name;
            }

            if (!empty($request->get('rstatus'))) {
                $chart_data = array();
                $chart_label = array();
                foreach ($datas as $data) {
                   //$chart_data[] = $data->sumscore;
                   //$chart_data['data'][$data->score] = $data->sumscore;
                   //$chart_label[] = $data->score;
                   $datatt[$data->crm_id][$data->score] = $data->sumscore;

                   //if (isset($agent_data[$data->crm_id])) {
                   //     $chart_label[] = $agent_data[$data->crm_id];
                   // } else {
                   //     $chart_label[] = 'Agent not found';
                   // }
                }

                
                $a = 0;
                foreach ($datatt as $keys => $values) {
                        $datat[$a]['name'] = 'test'.$a;
                        $datat[$a]['data'] = array(10, 15, 23, 5, 9);
                        //$datat[$a]['data'][1] = 2;
                        //$datat[$a]['data'][2] = 3;
                        //$datat[$a]['data'][3] = 4;
                        //$datat[$a]['data'][4] = 5;

                        $a++;
                }
                
                //$datat = [
                //    ['name'=>'line 1', 'data'=> [10, 15, 23, 5, 9]],
                //    ['name'=>'line 2', 'data'=> [5, 2, 3, 6, 7]],
                //];
                $chart_label = ['5 คะแนน','4 คะแนน','3 คะแนน','2 คะแนน','1 คะแนน'];
                //return response()->json(['datag' => $datat,'datal' => $chart_label]);
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

        return view('detailscoreagent.index')->with(['agents' => $agents]);
    }

}
