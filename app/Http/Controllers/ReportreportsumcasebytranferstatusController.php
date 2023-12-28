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

class ReportreportsumcasebytranferstatusController extends Controller
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
        $datas = DB::table('crm_cases')
            ->select(DB::raw('ROW_NUMBER() OVER (ORDER BY sumcases DESC) as rownumber'),DB::raw('if(tranferstatus != "",tranferstatus,"ไม่ระบุ") as name1'), DB::raw('count(*) as sumcases'))
            ->whereRaw('adddate between "' . $startDate . '" and "' . $endDate . '"')
            ->groupBy('tranferstatus')
            ->orderBy("sumcases", "desc")
            ->get();

        if (!empty($request->get('rstatus'))) {
            $chart_data = array();
            $chart_label = array();
            foreach ($datas as $data) {
                $chart_data[] = $data->sumcases;
                $chart_label[] = $data->name1;
            }
            return response()->json(['datag' => $chart_data,'datal' => $chart_label]);
        }

        if ($request->ajax()) {
            return datatables()->of($datas)
                //->editColumn('checkbox', function ($row) {
                //    return '<input type="checkbox" id="" class="flat" name="table_records[]" value="" >';
                //})->rawColumns(['checkbox', 'action'])
                ->toJson();
        }

        return view('reportsumcasebytranferstatus.index');
    }
}
