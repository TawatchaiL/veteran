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

class LoginstatusController extends Controller
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

        if(!empty($request->get('agent')) && $request->get('agent') != "0"){
            $sqlagent = " and crm_id = '".$request->input('agent')."'";
        }else{
            $sqlagent = "";
        }    
/*
        $datas = DB::connection('remote_connection')
            ->table(DB::raw('(SELECT @rownumber:=@rownumber + 1 AS rownumber, t.* FROM (SELECT crm_id, datetime_init, datetime_end, duration FROM call_center.audit WHERE datetime_init BETWEEN "' . $startDate . '" AND "' . $endDate . '" AND id_break is null' .$sqlagent. ' ORDER BY datetime_init DESC) t, (SELECT @rownumber:=0) r) AS temp'))
            ->select('rownumber', 'crm_id', 'datetime_init', 'datetime_end', 'duration')
            ->get();
*/
        $datas = DB::connection('remote_connection')
            ->table(DB::raw('(SELECT @rownumber:=0) AS temp, call_center.audit'))
            ->select(DB::raw('(@rownumber:=@rownumber + 1) AS rownumber'), 'crm_id','datetime_init', 'datetime_end','duration')
            ->whereRaw('datetime_init between "' . $startDate . '" and "' . $endDate . '" order by datetime_init desc')
            ->whereNull('id_break'); 
        if(!empty($request->get('agent')) && $request->get('agent') != "0"){
            $datas->whereRaw('crm_id = "'. $request->input('agent') .'"');  
        }    
        //$datas->orderBy("datetime_init", "asc")->get();
        $datas->get();

        $agents = User::orderBy("id", "asc")->get();
        $agent_data = array();
        foreach ($agents as $agent) {
            $agent_data[$agent->id] = $agent->name;
        }
        if ($request->ajax()) {

            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="" class="flat" name="table_records[]" value="" >';
                })
                ->addColumn('agent', function ($row) use ($agent_data){
                    if (isset($agent_data[$row->crm_id])) {
                        return $agent_data[$row->crm_id];
                    } else {
                        return 'Agent not found';
                    }
                })
                ->rawColumns(['checkbox', 'action'])->toJson();
        }
        
        return view('loginstatus.index')->with(['agents' => $agents]);
    }

}
