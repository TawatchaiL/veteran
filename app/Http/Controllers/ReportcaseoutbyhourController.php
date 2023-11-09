<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\JoinClause;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Services\GraphService;

class ReportcaseoutbyhourController extends Controller
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
            //sleep(2);
                $datas = DB::table('timeslot')
                    ->selectRaw("timeslot.timeslot as timelabel, c.numberhour, if(c.numberhour IS NULL,0,c.total_cases) as sumt")
                    ->leftJoin(DB::raw("(SELECT
                        CASE
                            WHEN TIME(created_at) < '01:00:00' THEN '00:00-01:00'
                            WHEN TIME(created_at) < '02:00:00' THEN '01:00-02:00'
                            WHEN TIME(created_at) < '03:00:00' THEN '02:00-03:00'
                            WHEN TIME(created_at) < '04:00:00' THEN '03:00-04:00'
                            WHEN TIME(created_at) < '05:00:00' THEN '04:00-05:00'
                            WHEN TIME(created_at) < '06:00:00' THEN '05:00-06:00'
                            WHEN TIME(created_at) < '07:00:00' THEN '06:00-07:00'
                            WHEN TIME(created_at) < '08:00:00' THEN '07:00-08:00'
                            WHEN TIME(created_at) < '09:00:00' THEN '08:00-09:00'
                            WHEN TIME(created_at) < '10:00:00' THEN '09:00-10:00'
                            WHEN TIME(created_at) < '11:00:00' THEN '10:00-11:00'
                            WHEN TIME(created_at) < '12:00:00' THEN '11:00-12:00'
                            WHEN TIME(created_at) < '13:00:00' THEN '12:00-13:00'
                            WHEN TIME(created_at) < '14:00:00' THEN '13:00-14:00'
                            WHEN TIME(created_at) < '15:00:00' THEN '14:00-15:00'
                            WHEN TIME(created_at) < '16:00:00' THEN '15:00-16:00'
                            WHEN TIME(created_at) < '17:00:00' THEN '16:00-17:00'
                            WHEN TIME(created_at) < '18:00:00' THEN '17:00-18:00'
                            WHEN TIME(created_at) < '19:00:00' THEN '18:00-19:00'
                            WHEN TIME(created_at) < '20:00:00' THEN '19:00-20:00'
                            WHEN TIME(created_at) < '21:00:00' THEN '20:00-21:00'
                            WHEN TIME(created_at) < '22:00:00' THEN '21:00-22:00'
                            WHEN TIME(created_at) < '23:00:00' THEN '22:00-23:00'
                            ELSE '23:00-24:00'
                        END as numberhour,
                        SUM(CASE
                            WHEN TIME(created_at) < '01:00:00' THEN 1
                            WHEN TIME(created_at) < '02:00:00' THEN 1
                            WHEN TIME(created_at) < '03:00:00' THEN 1
                            WHEN TIME(created_at) < '04:00:00' THEN 1
                            WHEN TIME(created_at) < '05:00:00' THEN 1
                            WHEN TIME(created_at) < '06:00:00' THEN 1
                            WHEN TIME(created_at) < '07:00:00' THEN 1
                            WHEN TIME(created_at) < '08:00:00' THEN 1
                            WHEN TIME(created_at) < '09:00:00' THEN 1
                            WHEN TIME(created_at) < '10:00:00' THEN 1
                            WHEN TIME(created_at) < '11:00:00' THEN 1
                            WHEN TIME(created_at) < '12:00:00' THEN 1
                            WHEN TIME(created_at) < '13:00:00' THEN 1
                            WHEN TIME(created_at) < '14:00:00' THEN 1
                            WHEN TIME(created_at) < '15:00:00' THEN 1
                            WHEN TIME(created_at) < '16:00:00' THEN 1
                            WHEN TIME(created_at) < '17:00:00' THEN 1
                            WHEN TIME(created_at) < '18:00:00' THEN 1
                            WHEN TIME(created_at) < '19:00:00' THEN 1
                            WHEN TIME(created_at) < '20:00:00' THEN 1
                            WHEN TIME(created_at) < '21:00:00' THEN 1
                            WHEN TIME(created_at) < '22:00:00' THEN 1
                            WHEN TIME(created_at) < '23:00:00' THEN 1
                            WHEN TIME(created_at) < '24:00:00' THEN 1
                            ELSE 0
                        END) as total_cases
                    FROM cases WHERE LENGTH(telno) > 4 GROUP BY numberhour) as c"), 'timeslot.timeslot', '=', 'c.numberhour')
                    ->orderBy("timelabel", "asc")
                    ->get();
            //$datas = DB::table('timeslot')
            //    ->select(DB::raw("timeslot as numberhour, 1 as sumt"))
            //    ->groupBy('numberhour')
            //    ->orderBy("numberhour", "asc")
            //    ->get();

            //$datas = DB::table('cases')
            //    ->select(DB::raw("CASE WHEN TIME(created_at) < '01:00:00' THEN '00:00-01:00' WHEN TIME(created_at) < '02:00:00' THEN '01:00-02:00' WHEN TIME(created_at) < '03:00:00' THEN '02:00-03:00' WHEN TIME(created_at) < '04:00:00' THEN '03:00-04:00' WHEN TIME(created_at) < '05:00:00' THEN '04:00-05:00' WHEN TIME(created_at) < '06:00:00' THEN '05:00-06:00' WHEN TIME(created_at) < '07:00:00' THEN '06:00-07:00' WHEN TIME(created_at) < '08:00:00' THEN '07:00-08:00' WHEN TIME(created_at) < '09:00:00' THEN '08:00-09:00' WHEN TIME(created_at) < '10:00:00' THEN '09:00-10:00' WHEN TIME(created_at) < '11:00:00' THEN '10:00-11:00' WHEN TIME(created_at) < '12:00:00' THEN '11:00-12:00' WHEN TIME(created_at) < '13:00:00' THEN '12:00-13:00' WHEN TIME(created_at) < '14:00:00' THEN '13:00-14:00' WHEN TIME(created_at) < '15:00:00' THEN '14:00-15:00' WHEN TIME(created_at) < '16:00:00' THEN '15:00-16:00' WHEN TIME(created_at) < '17:00:00' THEN '16:00-17:00' WHEN TIME(created_at) < '18:00:00' THEN '17:00-18:00' WHEN TIME(created_at) < '19:00:00' THEN '18:00-19:00' WHEN TIME(created_at) < '20:00:00' THEN '19:00-20:00' WHEN TIME(created_at) < '21:00:00' THEN '20:00-21:00' WHEN TIME(created_at) < '22:00:00' THEN '21:00-22:00' WHEN TIME(created_at) < '23:00:00' THEN '22:00-23:00' ELSE '23:00-24:00' END as numberhour"), DB::raw("SUM(CASE WHEN TIME(created_at) < '01:00:00' THEN 1 WHEN TIME(created_at) < '02:00:00' THEN 1 WHEN TIME(created_at) < '03:00:00' THEN 1 WHEN TIME(created_at) < '04:00:00' THEN 1 WHEN TIME(created_at) < '05:00:00' THEN 1 WHEN TIME(created_at) < '06:00:00' THEN 1 WHEN TIME(created_at) < '07:00:00' THEN 1 WHEN TIME(created_at) < '08:00:00' THEN 1 WHEN TIME(created_at) < '09:00:00' THEN 1 WHEN TIME(created_at) < '10:00:00' THEN 1 WHEN TIME(created_at) < '11:00:00' THEN 1 WHEN TIME(created_at) < '12:00:00' THEN 1 WHEN TIME(created_at) < '13:00:00' THEN 1 WHEN TIME(created_at) < '14:00:00' THEN 1 WHEN TIME(created_at) < '15:00:00' THEN 1 WHEN TIME(created_at) < '16:00:00' THEN 1 WHEN TIME(created_at) < '17:00:00' THEN 1 WHEN TIME(created_at) < '18:00:00' THEN 1 WHEN TIME(created_at) < '19:00:00' THEN 1 WHEN TIME(created_at) < '20:00:00' THEN 1 WHEN TIME(created_at) < '21:00:00' THEN 1 WHEN TIME(created_at) < '22:00:00' THEN 1 WHEN TIME(created_at) < '23:00:00' THEN 1 WHEN TIME(created_at) < '24:00:00' THEN 1 ELSE 0 END) as sumt"))
            //    ->groupBy('numberhour')
            //    ->orderBy("numberhour", "asc")
            //    ->get();
        if ($request->ajax()) {
            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="" class="flat" name="table_records[]" value="" >';
                })->rawColumns(['checkbox', 'action'])->toJson();
        }

        //graph data
        $chart_data = array();
        foreach ($datas as $data) {
            $chart_data[$data->timelabel] = $data->sumt;
        }

        $graph_color = array(
            '#E91E63', '#2E93fA', '#546E7A', '#66DA26', '#FF9800',  '#4ECDC4', '#C7F464', '#81D4FA',
            '#A5978B', '#FD6A6A'
        );

        $chart_title = "ผลรวมสายเข้าภายนอกแยกตามช่วงเวลา";

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

        return view('reportcaseoutbyhour.index', compact('chart1', 'chart2', 'chart3'));
    }
}
