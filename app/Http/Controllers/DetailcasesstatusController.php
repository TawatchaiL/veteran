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

class DetailcasesstatusController extends Controller
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
        } else {
            $startDate = date("Y-m-d H:i:s");
            $endDate = date("Y-m-t H:i:s", strtotime($startDate));  
        }

        $datas = DB::table('crm_cases')
            ->select(DB::raw('ROW_NUMBER() OVER (ORDER BY cdate ASC) as row_number'),DB::raw('DATE(crm_cases.created_at) as cdate'), DB::raw('TIME(crm_cases.created_at) as ctime'), 'telno', 'casetype1', 'casedetail', 'casestatus', 'tranferstatus', 'users.name as agent')
            ->join('users', 'crm_cases.agent', '=', 'users.id')
            ->whereRaw('adddate between "' . $startDate . '" and "' . $endDate . '" and casestatus = "' . $request->input('casesstatus') . '"')
            ->get();

        if ($request->ajax()) {

            return datatables()->of($datas)
                //->editColumn('checkbox', function ($row) {
                //    return '<input type="checkbox" id="" class="flat" name="table_records[]" value="" >';
                //})->rawColumns(['checkbox', 'action'])
                ->toJson();
        }

        return view('detailcasesstatus.index');
    }
}
