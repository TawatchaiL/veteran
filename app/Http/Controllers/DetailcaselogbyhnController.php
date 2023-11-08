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
        ->select('crm_caseslogs.agent','crm_caseslogs.id as id','hn', 'crm_caseslogs.modifyaction', 'crm_caseslogs.modifyagent', 'crm_caseslogs.modifydate')
        ->join('crm_contacts', 'crm_caseslogs.contact_id', '=', 'crm_contacts.id')
        ->whereRaw('crm_caseslogs.modifydate between "' . $startDate . ' 00:00:00" and "' . $endDate . ' 23:59:59"');

        $datac = DB::table('crm_case_comments')
        ->select('crm_case.agent','crm_cases.id as id','hn', 'comment', 'crm_case_comments.agent', 'crm_case_comments.created_at')
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
