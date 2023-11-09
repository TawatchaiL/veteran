<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Billing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

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
        $this->middleware('permission:billing-list|billing-create|billing-edit|billing-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:billing-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:billing-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:billing-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            //sleep(2);

            $datas = billing::orderBy("id", "desc")->get();
            $state_text = array('Minute', 'Call');
            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->id . '" >';
                })
                ->editColumn('per', function ($row) use ($state_text) {
                    $state = $state_text[$row->per];
                    return $state;
                })
                ->addColumn('action', function ($row) {
                    if (Gate::allows('holiday-edit')) {
                        $html = '<button type="button" class="btn btn-sm btn-warning btn-edit" id="getEditData" data-id="' . $row->id . '"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    } else {
                        $html = '<button type="button" class="btn btn-sm btn-warning disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    }
                    if (Gate::allows('holiday-delete')) {
                        $html .= '<button type="button" data-rowid="' . $row->id . '" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i> ลบ</button>';
                    } else {
                        $html .= '<button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-trash"></i> ลบ</button> ';
                    }
                    return $html;
                })->rawColumns(['checkbox', 'action'])->toJson();
        }

        $trunk = DB::connection('remote_connection')
            ->table('asterisk.trunks')
            ->orderBy("trunkid", "asc")->get();

        return view('billing.index')->with(['trunk' => $trunk]);
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
        $validator =  Validator::make($request->all(), [
            'note' => 'required|string|max:100',
            'trunk' => 'required',
            'prefix' => 'required',
            'price' => 'required',
            'per' => 'required',
        ], [
            'note.required' => ' Note ต้องไม่เป็นค่าว่าง!',
            'trunk.required' => 'กรุณาระบุ Trunk!',
            'prefix.required' => 'กรุณาระบุ Prefix!',
            'price.required' => 'กรุณาระบุ Price!',
            'per.required' => 'กรุณาระบุ Per!',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }


        $billing = [
            'note' => $request->get('note'),
            'trunk' => $request->get('trunk'),
            'prefix' => $request->get('prefix'),
            'price' =>  $request->get('price'),
            'per' => $request->get('per'),
        ];

        Billing::create($billing);

        return response()->json(['success' => 'เพิ่ม อัตราค่าใช้จ่ายการโทร เรียบร้อยแล้ว']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Billing $billing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data =  Billing::find($id);
        return response()->json(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'note' => 'required|string|max:100',
            'trunk' => 'required',
            'prefix' => 'required',
            'price' => 'required',
            'per' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, [
            'note.required' => ' Note ต้องไม่เป็นค่าว่าง!',
            'trunk.required' => 'กรุณาระบุ Trunk!',
            'prefix.required' => 'กรุณาระบุ Prefix!',
            'price.required' => 'กรุณาระบุ Price!',
            'per.required' => 'กรุณาระบุ Per!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }



        $billing = [
            'note' => $request->get('note'),
            'trunk' => $request->get('trunk'),
            'prefix' => $request->get('prefix'),
            'price' =>  $request->get('price'),
            'per' => $request->get('per'),
        ];

        $update = Billing::find($id);
        $update->update($billing);

        return response()->json(['success' => 'แก้ไข อัตราค่าใช้จ่ายการโทร เรียบร้อยแล้ว']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        Billing::find($id)->delete();
        return ['success' => true, 'message' => 'ลบ อัตราค่าใช้จ่ายการโทร เรียบร้อยแล้ว'];
    }

    public function destroy_all(Request $request)
    {

        $arr_del  = $request->get('table_records'); //$arr_ans is Array MacAddress

        for ($xx = 0; $xx < count($arr_del); $xx++) {
            Billing::find($arr_del[$xx])->delete();
        }

        return redirect('/billing')->with('success', 'ลบ อัตราค่าใช้จ่ายการโทร เรียบร้อยแล้ว');
    }
}
