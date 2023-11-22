<?php

namespace App\Http\Controllers;

use App\Models\Project_job_number as ProjectJobNumber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectJobNumberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('permission:agent-outbound-list|outbound-create|outbound-edit|outbound-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:outbound-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:outbound-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:outbound-delete', ['only' => ['destroy']]);
    }



    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       
        if ($request->ajax()) {

            $datas = ProjectJobNumber::orderBy("job_number_id", "desc")->get();
            $state_text = ['All', 'รอคิว', 'กำลังทำงาน', 'Export เสร็จแล้ว'];
            $ctype_text = ['All', 'สายเข้า', 'โทรออก', 'ภายใน'];

            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->id . '" >';
                })
                ->addColumn('action', function ($row) {
                    if (Gate::allows('voice-export-download')) {
                        if ($row->export_status == 3) {
                            $html = '<button type="button" class="btn btn-sm btn-warning btn-download" id="getEditData" data-id="' . $row->export_filename . '"><i class="fa fa-download"></i> Download</button> ';
                        } else {
                            $html = '<button type="button" class="btn btn-sm btn-warning disabled" data-toggle="tooltip" data-placement="bottom" title="ยัง Export ไม่เสร็จ"><i class="fa fa-download"></i> Download</button> ';
                        }
                    } else {
                        $html = '<button type="button" class="btn btn-sm btn-warning disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-download"></i> Download</button> ';
                    }
                    if (Gate::allows('voice-export-delete')) {
                        if ($row->export_status == 3) {
                            $html .= '<button type="button" data-rowid="' . $row->id . '" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i> ลบรายการ</button>';
                        } else {
                            $html .= '<button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="bottom" title="ยัง Export ไม่เสร็จ"><i class="fa fa-trash"></i> ลบรายการ</button> ';
                        }
                    } else {
                        $html .= '<button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-trash"></i> ลบรายการ</button> ';
                    }
                    return $html;
                })
                ->addColumn('more', function ($row) {
                    return '';
                })
                ->rawColumns(['checkbox', 'action'])->toJson();
        }



        return view('agentoutbound.index');
    }
}
