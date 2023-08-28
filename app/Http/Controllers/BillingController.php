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
use Illuminate\Support\Facades\Gate;

class BillingController extends Controller
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
        if ($request->ajax()) {
            //sleep(2);

            //$datas = Cases::orderBy("id", "desc")->get();
            $numberOfRows = 50; // Change this to the desired number of rows
            $simulatedDatas = [];

            $rivrname = ['02:00', '05:30', '04:00','08:12'];
            

            for ($i = 1; $i <= $numberOfRows; $i++) {
                $rivrno = mt_rand(0, 2000) / 100;
                $ivrno  =  number_format($rivrno, 2, '.', '')." บาท";
                $ivrname = $rivrname[array_rand($rivrname)];
                $createDate = now()->subDays(rand(1, 365))->subHours(rand(0, 23))->subMinutes(rand(0, 59));


                $simulatedDatas[] = (object) [
                    'id' => $i,
                    'cdate' => $createDate->format('Y-m-d'),
                    'ctime' => $createDate->format('H:i:s'),
                    'telno' => '08' . rand(10000000, 99999999),
                    'telin' => rand(1000, 1020),
                    'calltime' => $ivrname,
                    'callprice' => $ivrno,
                    'callfile' => 'Play'
                    // Simulate other fields as needed
                ];
            }


            return datatables()->of($simulatedDatas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="" class="flat" name="table_records[]" value="" >';
                })
                ->addColumn('action', function ($row) {

                    if (Gate::allows('contact-edit')) {
                        $html = '<button type="button" class="btn btn-sm btn-success btn-edit" id="CreateButton" data-id="' . $row->id . '"><i class="fa-solid fa-volume-high"></i> Play</button> ';
                    } else {
                        $html = '<button type="button" class="btn btn-sm btn-success disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa-solid fa-volume-high"></i> Play</button> ';
                    }

                    return $html;
                })->rawColumns(['checkbox', 'action'])
                ->toJson();
        }

        return view('billing.index');
    }

}
