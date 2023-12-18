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
                ->table(DB::raw('(SELECT @rownumber:=@rownumber + 1 AS rownumber, t.* FROM (SELECT asterisk.ivr_details.name as ivrname, call_center.ivr_report.digit as ivrno, count(asterisk.ivr_details.name) as sumhn FROM call_center.ivr_report left join asterisk.ivr_details on call_center.ivr_report.ivr_id = asterisk.ivr_details.id WHERE call_center.ivr_report.datetime BETWEEN "' . $startDate . '" AND "' . $endDate . '" GROUP BY ivrname, ivrno ORDER BY sumhn DESC LIMIT 10) t, (SELECT @rownumber:=0) r) AS temp'))
                ->select('rownumber', 'ivrname', 'ivrno', 'sumhn')
                ->get();
/*
        $datas = DB::connection('remote_connection')
            ->table(DB::raw('(SELECT @rownumber:=0) AS temp, call_center.ivr_report'))
            ->select(DB::raw('(@rownumber:=@rownumber + 1) AS rownumber'), 'asterisk.ivr_details.name as ivrname','call_center.ivr_report.digit as ivrno', DB::raw('count(asterisk.ivr_details.name) as sumhn'))
            ->join('asterisk.ivr_details', 'call_center.ivr_report.ivr_id', '=', 'asterisk.ivr_details.id')
            ->whereRaw('call_center.ivr_report.datetime between "' . $startDate . '" and "' . $endDate . '"')
            ->groupBy('ivrname', 'ivrno')
            ->orderBy("sumhn", "desc")
            ->limit(10)
            ->get();
*/
            if (!empty($request->get('rstatus'))) {
                $chart_data = array();
                $chart_label = array();
                foreach ($datas as $data) {
                    $chart_data[] = $data->sumhn;
                    $chart_label[] = $data->ivrname;
                }
                return response()->json(['datag' => $chart_data,'datal' => $chart_label]);
            }

        if ($request->ajax()) {

            return datatables()->of($datas)
                ->toJson();
        }

        return view('ivrreporttop10.index');
    }

}
