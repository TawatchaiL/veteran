<?php

namespace App\Http\Controllers;

use App\Models\Callsurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CallsurveyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('permission:call-survey-list|call-survey-create|call-survey-edit|call-survey-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:call-survey-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:call-survey-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:call-survey-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            //sleep(2);

            $datas = Callsurvey::orderBy("id", "desc")->get();
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
                    if (Gate::allows('call-survey-edit')) {
                        $html = '<button type="button" class="btn btn-sm btn-warning btn-edit" id="getEditData" data-id="' . $row->id . '"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    } else {
                        $html = '<button type="button" class="btn btn-sm btn-warning disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    }
                    if (Gate::allows('call-survey-delete')) {
                        $html .= '<button type="button" data-rowid="' . $row->id . '" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i> ลบ</button>';
                    } else {
                        $html .= '<button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-trash"></i> ลบ</button> ';
                    }
                    return $html;
                })->rawColumns(['checkbox', 'action'])->toJson();
        }

        $sound = DB::connection('remote_connection')
            ->table('asterisk.recordings')
            ->orderBy("displayname", "asc")->get();

        return view('callsurvey.index')->with(['sound' => $sound]);
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Callsurvey $callsurvey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Callsurvey $callsurvey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Callsurvey $callsurvey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Callsurvey $callsurvey)
    {
        //
    }
}
