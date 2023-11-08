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
use App\Services\GraphService;

class DetailcaselogbyhnController extends Controller
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

        $datas = DB::table('crm_caseslogs')
        ->select('crm_caseslogs.agent as cagent','crm_caseslogs.id as id','crm_contacts.hn as chn', 'crm_caseslogs.modifyaction as caction', 'crm_caseslogs.modifyagent as magent', 'crm_caseslogs.modifydate as mdate')
        ->join('crm_contacts', 'crm_caseslogs.contact_id', '=', 'crm_contacts.id')
        ->whereRaw('crm_caseslogs.modifydate between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"');

        $datac = DB::table('crm_case_comments')
        ->select('crm_cases.agent as cagent','crm_cases.id as id','crm_contacts.hn as chn ', DB::raw('CONCAT("comment") as caction'), 'crm_case_comments.agent as magent', 'crm_case_comments.created_at as mdate')
        ->join('crm_cases', 'crm_case_comments.case_id', '=', 'crm_cases.id')
        ->join('crm_contacts', 'crm_cases.contact_id', '=', 'crm_contacts.id')
        ->whereRaw('crm_case_comments.created_at between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"')
        ->union($datas)
        ->get();

        if ($request->ajax()) {
            return datatables()->of($datac)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="" class="flat" name="table_records[]" value="" >';
                })->rawColumns(['checkbox', 'action'])
                ->toJson();
        }

        return view('detailcaselogbyhn.index');
    }

}
