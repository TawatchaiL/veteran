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
                    $startDate = date("Y-m-d");
                    $endDate = date("Y-m-t", strtotime($startDate));  
        }
        $datas = DB::connection('remote_connection')
            ->table('call_center.ivr_report')
            ->select('asterisk.ivr_details.name as ivrname','call_center.ivr_report.digit as ivrno', DB::raw('count(asterisk.ivr_details.name) as sumhn'))
            ->join('asterisk.ivr_details', 'call_center.ivr_report.ivr_id', '=', 'asterisk.ivr_details.id')
            ->whereRaw('call_center.ivr_report.datetime between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"')
            ->groupBy('ivrname')
            ->orderBy("call_center.ivr_report.datetime", "desc")
            ->get();

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
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="" class="flat" name="table_records[]" value="" >';
                })->rawColumns(['checkbox', 'action'])->toJson();
        }

        return view('ivrreporttop10.index');
    }

}
