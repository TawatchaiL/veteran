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
                    $startDate = date("Y-m-d");
                    $endDate = date("Y-m-t", strtotime($startDate));  
        }
        $datas = DB::connection('remote_connection')
            ->table('call_center.agent_score')
            ->select('call_center.agent_score.score as score',  DB::raw('count(call_center.agent_score.id) as sumscore'))
            ->whereRaw('call_center.agent_score.datetime between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"');
 
            $datas->groupBy('call_center.agent_score.score')
            ->orderBy("call_center.agent_score.score", "desc")
            ->get();

            if (!empty($request->get('rstatus'))) {
                $chart_data = array();
                $chart_label = array();
                $i=1;
                foreach ($datas as $data) {
                    $chart_data[] = $data->sumscore;
                    $chart_label[] = $data->score.' ';
                }
                return response()->json(['datag' => $chart_data,'datal' => $chart_label]);
            }

        if ($request->ajax()) {

            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="" class="flat" name="table_records[]" value="" >';
                })->rawColumns(['checkbox', 'action'])->toJson();
        }
        $agents = User::orderBy("id", "asc")->get();
        $agent_data = array();
        foreach ($agents as $agent) {
            $agent_data[$agent->id] = $agent->name;
        }
        return view('detailscoreagent.index')->with(['agents' => $agents]);
    }

}
