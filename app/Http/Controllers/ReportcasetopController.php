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

class ReportcasetopController extends Controller
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

            $datas = DB::table('cases')
                ->select('agent', DB::raw('count(*) as sumcases'))
                ->groupBy('agent')
                ->orderBy("sumcases", "desc")
                ->get();

            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="" class="flat" name="table_records[]" value="" >';
                })->rawColumns(['checkbox', 'action'])->toJson();
        }

        $chart_options = [
            'chart_title' => 'Bar Graph',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Cases',
            'group_by_field' => 'agent',
            'chart_type' => 'bar',
        ];
        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Line Graph',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Cases',
            'group_by_field' => 'agent',
            'chart_type' => 'line',
        ];
        $chart2 = new LaravelChart($chart_options);
        $chart_options = [
            'chart_title' => 'Pie Graph',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Cases',
            'group_by_field' => 'agent',
            'chart_type' => 'pie',
        ];
        $chart3 = new LaravelChart($chart_options);

        return view('reportcasetop10.index', compact('chart1', 'chart2', 'chart3'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator =  Validator::make($request->all(), [
            //'code' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            //'postcode' => 'int|max:10',
            /* 'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
            'postcode' => 'required|string|max:10',
            'telephone' => 'required|string|max:20',*/
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $input = $request->all();
        $contract = Case_type::create($input);
        return response()->json(['success' => 'เพิ่ม ประเภทการติดต่อ เรียบร้อยแล้ว']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = Case_type::find($id);
        return response()->json(['data' => $data]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string|max:255',
            //'postcode' => 'integer|max:10',

        ];


        $validator =  Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $companyd = [
            'name' => $request->get('name'),
        ];

        $company = Case_type::find($id);
        $company->update($companyd);

        return response()->json(['success' => 'แก้ไข ประเภทการติดต่อ เรียบร้อยแล้ว']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        Case_type::find($id)->delete();
        return ['success' => true, 'message' => 'ลบ ประเภทการติดต่อ เรียบร้อยแล้ว'];
    }

    public function destroy_all(Request $request)
    {

        $arr_del  = $request->get('table_records'); //$arr_ans is Array MacAddress

        for ($xx = 0; $xx < count($arr_del); $xx++) {
            Case_type::find($arr_del[$xx])->delete();
        }

        return redirect('casetype')->with('success', 'ลบ ประเภทการติดต่อ เรียบร้อยแล้ว');
    } //
}
