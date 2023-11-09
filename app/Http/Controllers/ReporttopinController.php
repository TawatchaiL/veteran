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

class ReporttopinController extends Controller
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
        $resultb = DB::connection('remote_connection')
            ->table('call_center.call_entry')
            ->where('tipo', 'B')
            ->where('id', '!=', $this->warp_id)
            ->where('id', '!=', $this->sup_break_id)
            ->get();

        if ($request->ajax()) {

            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="" class="flat" name="table_records[]" value="" >';
                })->rawColumns(['checkbox', 'action'])->toJson();
        }

        //graph data
        $chart_data = array();
        foreach ($datas as $data) {
            $chart_data[$data->telno] = $data->sumcases;
        }

        $graph_color = array(
            '#E91E63', '#2E93fA', '#546E7A', '#66DA26', '#FF9800',  '#4ECDC4', '#C7F464', '#81D4FA',
            '#A5978B', '#FD6A6A'
        );

        $chart_title = "10 อันดับเบอร์ภายใน";

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

        return view('reporttop10in.index', compact('chart1', 'chart2', 'chart3'));
    }

}
