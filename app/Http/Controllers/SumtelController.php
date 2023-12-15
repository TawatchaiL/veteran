<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Services\GraphService;

class SumtelController extends Controller
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
            ->table(DB::raw('(SELECT @rownumber:=@rownumber + 1 AS row_number, t.* FROM (SELECT DATE(datetime_init) as cdate, SUM(if(status = "terminada",1,0)) as terminada, SUM(if(status = "abandonada",1,0)) as abandonada FROM call_center.call_entry WHERE datetime_init BETWEEN "' . $startDate . '" AND "' . $endDate . '" GROUP BY DATE(datetime_init) ORDER BY DATE(datetime_init) ASC) t, (SELECT @rownumber:=0) r) AS temp order by temp.cdate'))
            ->select('row_number', 'cdate', 'terminada', 'abandonada')
            ->get();
/*
        $datas = DB::connection('remote_connection')
            ->table(DB::raw('(SELECT @rownumber:=0) AS temp, call_center.call_entry'))
            ->select(DB::raw('(@rownumber:=@rownumber + 1) AS row_number'), DB::raw('DATE(datetime_init) as cdate'), DB::raw('SUM(if(status = "terminada",1,0)) as terminada'), DB::raw('SUM(if(status = "abandonada",1,0)) as abandonada'))
            ->whereRaw('datetime_init between "' . $startDate . '" and "' . $endDate . '"');
        //if(!empty($request->get('agent'))){
        //$datas->whereRaw('crm_id = "'. $request->input('agent') .'"');  
        //}    
        $datas->groupBy('cdate')
            ->orderBy("cdate", "asc")
            ->get();
*/
        if ($request->ajax()) {

            return datatables()->of($datas)
            ->editColumn('cdate', function ($row) {
                //$adddate = Carbon::parse($row->adddate)->addYears(543)->format('d/m/Y');
                $adddate = Carbon::parse($row->cdate)->format('Y-m-d');
                return $adddate;
            })
                //->editColumn('checkbox', function ($row) {
                //    return '<input type="checkbox" id="" class="flat" name="table_records[]" value="" >';
                //})->rawColumns(['checkbox', 'action'])
                ->toJson();
        }

        //$agents = User::orderBy("id", "asc")->get();

        //return view('sumtel.index')->with(['agents' => $agents]);
        return view('sumtel.index');
    }

}
