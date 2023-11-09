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

class IvrreportController extends Controller
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

            $rivrname = ['welcom', 'opd', 'callcenter'];
            $rivrno = ['1', '2', '3', '4', '5'];

            for ($i = 1; $i <= $numberOfRows; $i++) {

                $ivrno  = $rivrno[array_rand($rivrno)];
                $ivrname = $rivrname[array_rand($rivrname)];
                $createDate = now()->subDays(rand(1, 365))->subHours(rand(0, 23))->subMinutes(rand(0, 59));


                $simulatedDatas[] = (object) [
                    'id' => $i,
                    'cdate' => $createDate->format('Y-m-d'),
                    'ctime' => $createDate->format('H:i:s'),
                    'telno' => '08' . rand(10000000, 99999999),
                    'ivrname' => $ivrname,
                    'ivrno' => $ivrno,
                    // Simulate other fields as needed
                ];
            }


            return datatables()->of($simulatedDatas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="" class="flat" name="table_records[]" value="" >';
                })->rawColumns(['checkbox', 'action'])
                ->toJson();
        }

        return view('ivrreport.index');
    }

}
