<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cases;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Services\GraphService;

class Ivrreporttop10Controller extends Controller
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

        $numberOfRows = 50; // Change this to the desired number of rows
        $simulatedDatas = [];

        $rivrname = ['welcom', 'opd', 'callcenter'];
        $rivrno = ['1', '2', '3', '4', '5'];

        for ($i = 1; $i <= $numberOfRows; $i++) {

            $ivrno  = $rivrno[array_rand($rivrno)];
            $ivrname = $rivrname[array_rand($rivrname)];
            $ivrsum = rand(1, 1000);


            $simulatedDatas[] = (object) [
                'id' => $i,
                'ivrname' => $ivrname,
                'ivrno' => $ivrno,
                'ivrsum' => $ivrsum,
                // Simulate other fields as needed
            ];
        }
        if ($request->ajax()) {
            return datatables()->of($simulatedDatas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="" class="flat" name="table_records[]" value="" >';
                })->rawColumns(['checkbox', 'action'])->toJson();
        }
        //graph data
        $chart_data = array();
        foreach ($simulatedDatas as $data) {
            $chart_data[$data->ivrname] = $data->ivrsum;
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

        return view('ivrreporttop10.index', compact('chart1', 'chart2', 'chart3'));
    }

}
