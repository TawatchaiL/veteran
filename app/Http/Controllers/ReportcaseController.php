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
/*
        $datas = DB::connection('remote_connection')
            ->table('call_center.call_entry')
            ->select('crm_id', DB::raw('count(crm_id) as sumcases'))
            ->whereRaw('datetime_init between "' . $startDate . '" and "' . $endDate . '"')
            ->groupBy('crm_id')
            ->having('sumcases', '>', 0)
            ->orderBy("crm_id", "asc")
            ->get();
*/
        $datas = DB::connection('remote_connection')
            ->select(DB::raw('temp.rownumber, t.crm_id, t.sumcases'))
            ->from(DB::raw('(SELECT @rownumber:=@rownumber + 1 AS rownumber, t.* FROM (SELECT crm_id, COUNT(crm_id) AS sumcases FROM call_center.call_entry WHERE datetime_init BETWEEN "' . $startDate . '" AND "' . $endDate . '" GROUP BY crm_id HAVING sumcases > 0 ORDER BY crm_id ASC) t, (SELECT @rownumber:=0) r) AS temp'))
            //->orderBy('temp.rownumber', 'asc')
            ->get();

            $agents = User::orderBy("id", "asc")->get();
            $agent_data = array();
            foreach ($agents as $agent) {
                $agent_data[$agent->id] = $agent->name;
            }

            if (!empty($request->get('rstatus'))) {
                $chart_data = array();
                $chart_label = array();
                foreach ($datas as $data) {
                    if (array_key_exists($data->crm_id, $agent_data)) {
                        $chart_data[] = $data->sumcases;
                        $chart_label[] = $agent_data[$data->crm_id];
                    }else{
                        $chart_data[] = $data->sumcases;
                        $chart_label[] = 'Agent not found';
                    }
                }
                return response()->json(['datag' => $chart_data,'datal' => $chart_label]);
            }

        if ($request->ajax()) {
            $colnumber = 0;
            return datatables()->of($datas)
                //->editColumn('checkbox', function ($row) {
                //    return '<input type="checkbox" id="" class="flat" name="table_records[]" value="" >';
                //})->rawColumns(['checkbox', 'action'])
                ->addColumn('agent', function ($row) use ($agent_data){
                    if (isset($agent_data[$row->crm_id])) {
                        return $agent_data[$row->crm_id];
                    } else {
                        return 'Agent not found';
                    }
                })
                ->toJson();
        }
        return view('reportcase.index');
    }
}
