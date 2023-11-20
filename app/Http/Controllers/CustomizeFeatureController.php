<?php

namespace App\Http\Controllers;

use App\Models\CustomizeFeature;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomizeFeatureController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('permission:customize-list|customize-create|customize-edit|customize-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:customize-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:customize-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:customize-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            //sleep(2);

            $datas = CustomizeFeature::orderBy("id", "desc")->get();
            $state_text = array('ไม่เปิดใช้งาน', 'เปิดใช้งาน');
            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->id . '" >';
                })
                ->editColumn('status', function ($row) use ($state_text) {
                    $state = $state_text[$row->status];
                    return $state;
                })
                ->addColumn('action', function ($row) {
                    if (Gate::allows('customize-edit')) {
                        $html = '<button type="button" class="btn btn-sm btn-warning btn-edit" id="getEditData" data-id="' . $row->id . '"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    } else {
                        $html = '<button type="button" class="btn btn-sm btn-warning disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    }
                    return $html;
                })->rawColumns(['checkbox', 'action'])->toJson();
        }

        return view('customize.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data =  CustomizeFeature::find($id);
        return response()->json(['data' => $data]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $config = [
            'name' => $request->get('name'),
            'config' => $request->get('config'),
            'value' => $request->get('value'),
            'status' => $request->get('status'),
        ];


        $update = CustomizeFeature::find($id);
        $update->update($config);

        return response()->json(['success' => 'แก้ไขค่า Customize เรียบร้อยแล้ว']);
    }
}
