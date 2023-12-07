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

class ReportcasetopController extends Controller
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
            $datas = DB::table(DB::raw('crm_cases, (SELECT @rownumber:=0) AS temp'))
                ->select(DB::raw('(@rownumber:=@rownumber + 1) AS row_number'), 'casetype1', DB::raw('count(casetype1) as sumcases'))
                ->whereRaw('adddate between "' . $startDate . '" and "' . $endDate . '"')
                ->groupBy('casetype1')
                ->orderBy("sumcases", "desc")
                ->limit(10)
                ->get();
        if (!empty($request->get('rstatus'))) {
            $chart_data = array();
            $chart_label = array();
            foreach ($datas as $data) {
                $chart_data[] = $data->sumcases;
                $chart_label[] = $data->casetype1;
            }
            return response()->json(['datag' => $chart_data,'datal' => $chart_label]);
        }
        if ($request->ajax()) {
            return datatables()->of($datas)
            //    ->editColumn('checkbox', function ($row) {
            //        return '<input type="checkbox" id="" class="flat" name="table_records[]" value="" >';
            //})->rawColumns(['checkbox', 'action'])
            ->toJson();
        }

        //graph data
        /*$chart_data = array();
        foreach ($datas as $data) {
            $chart_data[$data->casetype1] = $data->sumcases;
        }

        $graph_color = array(
            '#E91E63', '#2E93fA', '#546E7A', '#66DA26', '#FF9800',  '#4ECDC4', '#C7F464', '#81D4FA',
            '#A5978B', '#FD6A6A'
        );

        $chart_title = "10 อันดับเรื่องที่ติดต่อมากที่สุด";

        $chart_options = [
            'chart_id' => 'bar_graph',
            'chart_title' => $chart_title,
            'chart_type' => 'bar',
            'color' => $graph_color,
            'data' => $chart_data
        ];

        $chart1 = new GraphService($chart_options);

        $chart_options = [
            'chart_id' => 'line_graph',
            'chart_title' => $chart_title,
            'chart_type' => 'line',
            'color' => $graph_color,
            'data' => $chart_data
        ];

        $chart2 = new GraphService($chart_options);

        $chart_options = [
            'chart_id' => 'pie_graph',
            'chart_title' => $chart_title,
            'chart_type' => 'pie',
            'color' => $graph_color,
            'data' => $chart_data
        ];

        $chart3 = new GraphService($chart_options);

        return view('reportcasetop10.index', compact('chart1', 'chart2', 'chart3'));
        */
        return view('reportcasetop10.index');
    }
    public function report(Request $request)
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
            $datas = DB::table('crm_cases')
                ->select('casetype1', DB::raw('count(casetype1) as sumcases'))
                ->whereRaw('adddate between "' . $startDate . '" and "' . $endDate . '"')
                ->groupBy('casetype1')
                ->orderBy("sumcases", "desc")
                ->get();
                $chart_data = array();
                $chart_label = array();
                foreach ($datas as $data) {
                    $chart_data[] = $data->sumcases;
                    $chart_label[] = $data->casetype1;
                }
        return response()->json(['datag' => $chart_data,'datal' => $chart_label]);
    }

}
