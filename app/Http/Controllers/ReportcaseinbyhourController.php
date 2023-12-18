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

class ReportcaseinbyhourController extends Controller
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
            ->table('call_center.timeslot, (SELECT @rownumber:=0) AS temp')
                    ->selectRaw("@rownumber:=@rownumber + 1 AS rownumber, timeslot.timeslot as timelabel, c.numberhour, if(c.numberhour IS NULL,0,c.total_cases) as sumt")
                    ->leftJoin(DB::raw("(SELECT
                        CASE
                            WHEN TIME(datetime_init) < '01:00:00' THEN '00:00-01:00'
                            WHEN TIME(datetime_init) < '02:00:00' THEN '01:00-02:00'
                            WHEN TIME(datetime_init) < '03:00:00' THEN '02:00-03:00' 
                            WHEN TIME(datetime_init) < '04:00:00' THEN '03:00-04:00' 
                            WHEN TIME(datetime_init) < '05:00:00' THEN '04:00-05:00' 
                            WHEN TIME(datetime_init) < '06:00:00' THEN '05:00-06:00' 
                            WHEN TIME(datetime_init) < '07:00:00' THEN '06:00-07:00' 
                            WHEN TIME(datetime_init) < '08:00:00' THEN '07:00-08:00' 
                            WHEN TIME(datetime_init) < '09:00:00' THEN '08:00-09:00' 
                            WHEN TIME(datetime_init) < '10:00:00' THEN '09:00-10:00' 
                            WHEN TIME(datetime_init) < '11:00:00' THEN '10:00-11:00' 
                            WHEN TIME(datetime_init) < '12:00:00' THEN '11:00-12:00' 
                            WHEN TIME(datetime_init) < '13:00:00' THEN '12:00-13:00' 
                            WHEN TIME(datetime_init) < '14:00:00' THEN '13:00-14:00' 
                            WHEN TIME(datetime_init) < '15:00:00' THEN '14:00-15:00' 
                            WHEN TIME(datetime_init) < '16:00:00' THEN '15:00-16:00' 
                            WHEN TIME(datetime_init) < '17:00:00' THEN '16:00-17:00' 
                            WHEN TIME(datetime_init) < '18:00:00' THEN '17:00-18:00' 
                            WHEN TIME(datetime_init) < '19:00:00' THEN '18:00-19:00' 
                            WHEN TIME(datetime_init) < '20:00:00' THEN '19:00-20:00' 
                            WHEN TIME(datetime_init) < '21:00:00' THEN '20:00-21:00' 
                            WHEN TIME(datetime_init) < '22:00:00' THEN '21:00-22:00' 
                            WHEN TIME(datetime_init) < '23:00:00' THEN '22:00-23:00'
                            ELSE '23:00-24:00'
                        END as numberhour,
                        SUM(CASE
                            WHEN TIME(datetime_init) < '01:00:00' THEN 1
                            WHEN TIME(datetime_init) < '02:00:00' THEN 1
                            WHEN TIME(datetime_init) < '03:00:00' THEN 1 
                            WHEN TIME(datetime_init) < '04:00:00' THEN 1 
                            WHEN TIME(datetime_init) < '05:00:00' THEN 1 
                            WHEN TIME(datetime_init) < '06:00:00' THEN 1 
                            WHEN TIME(datetime_init) < '07:00:00' THEN 1 
                            WHEN TIME(datetime_init) < '08:00:00' THEN 1 
                            WHEN TIME(datetime_init) < '09:00:00' THEN 1 
                            WHEN TIME(datetime_init) < '10:00:00' THEN 1 
                            WHEN TIME(datetime_init) < '11:00:00' THEN 1 
                            WHEN TIME(datetime_init) < '12:00:00' THEN 1 
                            WHEN TIME(datetime_init) < '13:00:00' THEN 1 
                            WHEN TIME(datetime_init) < '14:00:00' THEN 1 
                            WHEN TIME(datetime_init) < '15:00:00' THEN 1 
                            WHEN TIME(datetime_init) < '16:00:00' THEN 1 
                            WHEN TIME(datetime_init) < '17:00:00' THEN 1 
                            WHEN TIME(datetime_init) < '18:00:00' THEN 1 
                            WHEN TIME(datetime_init) < '19:00:00' THEN 1 
                            WHEN TIME(datetime_init) < '20:00:00' THEN 1 
                            WHEN TIME(datetime_init) < '21:00:00' THEN 1 
                            WHEN TIME(datetime_init) < '22:00:00' THEN 1 
                            WHEN TIME(datetime_init) < '23:00:00' THEN 1 
                            WHEN TIME(datetime_init) < '24:00:00' THEN 1 
                            ELSE 0
                        END) as total_cases
                    FROM call_center.call_entry WHERE LENGTH(callerid) < 5 AND datetime_init between '". $startDate ." 00:00:00' and '". $endDate ." 23:59:59' GROUP BY numberhour) as c"), 'timeslot.timeslot', '=', 'c.numberhour')
                    ->orderBy("timelabel", "asc")
                    ->get();
            
                        if (!empty($request->get('rstatus'))) {
                            $chart_data = array();
                            $chart_label = array();
                            foreach ($datas as $data) {
                                $chart_data[] = $data->sumt;
                                $chart_label[] = $data->timelabel;
                            }
                            return response()->json(['datag' => $chart_data,'datal' => $chart_label]);
                        }

        if ($request->ajax()) {
            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="" class="flat" name="table_records[]" value="" >';
                })->rawColumns(['checkbox', 'action'])->toJson();
        }

        return view('reportcaseinbyhour.index');
    }
}
