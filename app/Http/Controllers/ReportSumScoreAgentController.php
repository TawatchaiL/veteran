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

class ReportSumScoreAgentController extends Controller
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

        $datas = DB::connection('remote_connection')
        ->table(DB::raw('(SELECT @rownumber:=@rownumber + 1 AS rownumber, t.* FROM (SELECT crm_id, sum(score) as sumscore FROM call_center.agent_score WHERE call_center.agent_score.datetime BETWEEN "' . $startDate . '" AND "' . $endDate . '" GROUP BY crm_id ORDER BY sumscore DESC LIMIT 3) t, (SELECT @rownumber:=0) r) AS temp'))
        ->select('rownumber', 'crm_id', 'sumscore')
        ->get();
/*
        $datas = DB::connection('remote_connection')
            ->table(DB::raw('(SELECT @rownumber:=0) AS temp, call_center.agent_score'))
            ->select(DB::raw('(@rownumber:=@rownumber + 1) AS rownumber'), 'crm_id',  DB::raw('sum(score) as sumscore'))
            ->whereRaw('call_center.agent_score.datetime between "' . $startDate . '" and "' . $endDate . '"')
            ->groupBy('crm_id')
            ->orderBy("sumscore", "desc")
            ->limit(3)
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
                    if (array_key_exists($data->crm_id, $agent_data)) {
                        $chart_data[] = $data->sumscore;
                        $chart_label[] = $agent_data[$data->crm_id];
                    }else{
                        $chart_data[] = $data->sumscore;
                        $chart_label[] = 'Agent not found';
                    }
                }
                $chart_label = [1,2,3];
                return response()->json(['datag' => $chart_data,'datal' => $chart_label]);
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
        return view('reportsumscoreagent.index');
    }

}
