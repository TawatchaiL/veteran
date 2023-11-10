<?php

namespace App\Http\Controllers;

use App\Models\NotifyGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class NotifyGroupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('permission:holiday-list|holiday-create|holiday-edit|holiday-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:holiday-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:holiday-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:holiday-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            //sleep(2);

            $datas = NotifyGroup::orderBy("id", "desc")->get();
            $state_text = array('ไม่เปิดใช้งาน', 'เปิดใช้งาน');
            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->id . '" >';
                })
                ->addColumn('notifydate', function ($row) {
                    $holiday = $row->group_start . " - " . $row->group_end;
                    return $holiday;
                })
                ->editColumn('status', function ($row) use ($state_text) {
                    $state = $state_text[$row->status];
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

        $extension = DB::connection('remote_connection')
            ->table('call_center.agent')
            ->orderBy("number", "asc")->get();

        return view('notify.index')->with(['sound' => $extension]);
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
    public function show(NotifyGroup $missCallAlert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NotifyGroup $missCallAlert)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NotifyGroup $missCallAlert)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NotifyGroup $missCallAlert)
    {
        //
    }
}
