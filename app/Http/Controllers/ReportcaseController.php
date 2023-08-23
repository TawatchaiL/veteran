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

class ReportcaseController extends Controller
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

        if ($request->ajax()) {
            //sleep(2);

            //$datas = Cases::orderBy("id", "desc")->get();

            $datas = DB::table('cases')
                ->select('agent', DB::raw('count(*) as sumcases'))
                ->groupBy('agent')
                ->orderBy("sumcases", "desc")
                ->get();

            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="" class="flat" name="table_records[]" value="" >';
                })->rawColumns(['checkbox', 'action'])->toJson();
        }

        $chart_options = [
            'chart_title' => 'Bar Graph',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Cases',
            'group_by_field' => 'agent',
            'chart_color' => '255,160,122',
            'chart_type' => 'bar',
            'colors' => ['#ff0000', '#00ff00', '#0000ff'],
            'options' => [
                'animation' => [
                    'duration' => 1000, // Animation duration in milliseconds
                    'easing' => 'easeOutQuart', // Easing function for animation
                ],
            ],
        ];
        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Line Graph',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Cases',
            'group_by_field' => 'agent',
            'chart_color' => '136, 8, 8',
            'chart_type' => 'line',
            'colors' => ['#ff0000', '#00ff00', '#0000ff'],
            'options' => [
                'animation' => [
                    'duration' => 1000, // Animation duration in milliseconds
                    'easing' => 'easeOutQuart', // Easing function for animation
                ],
            ],
        ];
        $chart2 = new LaravelChart($chart_options);
        $chart_options = [
            'chart_title' => 'Pie Graph',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Cases',
            'group_by_field' => 'agent',
            'chart_color' => '176,224,230',
            'chart_type' => 'pie',
            'colors' => ['#ff0000', '#00ff00', '#0000ff'],
            'options' => [
                'animation' => [
                    'duration' => 1000, // Animation duration in milliseconds
                    'easing' => 'easeOutQuart', // Easing function for animation
                ],
            ],

        ];
        $chart3 = new LaravelChart($chart_options);

        return view('reportcase.index', compact('chart1', 'chart2', 'chart3'));
    }
}
