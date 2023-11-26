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

class HitcallController extends Controller
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
            ->table('call_center.call_entry')
            ->select('crm_id',DB::raw('DATE(datetime_init) as cdate'), DB::raw('TIME(datetime_init) as ctime'), 'callerid as telno', DB::raw('SEC_TO_TIME(duration_wait) as durationwait'), DB::raw('SEC_TO_TIME(duration) as duration'))
            ->whereRaw('datetime_init between "' . $startDate . '" and "' . $endDate . '" AND status = "terminada" AND  crm_id is not null');
        if(!empty($request->get('agent'))){
            $datas->whereRaw('crm_id = "'. $request->input('agent') .'"');  
        }    
        $datas->orderBy("datetime_init", "asc")
            ->get();

        $agents = User::orderBy("id", "asc")->get();

        if ($request->ajax()) {
            $agent_data = array();
            foreach ($agents as $agent) {
                $agent_data[$agent->id] = $agent->name;
            }
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
        
        return view('hitcall.index')->with(['agents' => $agents]);
    }

}
