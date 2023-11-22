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
        $this->middleware('permission:agent-outbound|outbound-create|outbound-edit|outbound-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:outbound-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:outbound-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:outbound-delete', ['only' => ['destroy']]);
    }



    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $uid = Auth::user()->id;
        $datass = ProjectJobNumber::orderBy("job_number_id", "desc")
            ->where('dial_agent', $uid);
        if ($request->ajax()) {

            if (!empty($request->get('sdate'))) {
                $dateRange = $request->input('sdate');
                if ($dateRange) {
                    $dateRangeArray = explode(' - ', $dateRange);

                    if (!empty($dateRangeArray) && count($dateRangeArray) == 2) {
                        $startDate = $dateRangeArray[0];
                        $endDate = $dateRangeArray[1];
                        //dd($startDate . ' - ' . $endDate);
                        $datass->whereBetween('create_date', [$startDate, $endDate]);
                    }
                }
            }

            if (!empty($request->get('searchtype'))) {
                $searchtype = $request->input('searchtype');
                dd($searchtype);
                if ($searchtype) {
                    $datass->where(function ($query) use ($searchtype) {
                        $query->where('call_status', '=', $searchtype);
                    });
                }
            }

            /*if (!empty($request->get('ctype'))) {
                $ctype = $request->input('ctype');
                if ($ctype == 1) {
                    $datass->where('asteriskcdrdb.cdr.accountcode', '')
                        ->where('asteriskcdrdb.cdr.userfield', '=', '')
                        ->where('asteriskcdrdb.cdr.dst_userfield', '!=', NULL);
                } else if ($ctype == 2) {
                    $datass->where('asteriskcdrdb.cdr.accountcode', '!=', '')
                        ->where('asteriskcdrdb.cdr.userfield', '!=', '')
                        ->where('asteriskcdrdb.cdr.dst_userfield', '=', NULL);
                } else if ($ctype == 3) {
                    $datass->where('asteriskcdrdb.cdr.accountcode', '!=', '')
                        ->where('asteriskcdrdb.cdr.userfield', '!=', '')
                        ->where('asteriskcdrdb.cdr.dst_userfield', '!=', NULL);
                }
            }

            if (!empty($request->get('agent'))) {
                $agent = $request->input('agent');
                if ($agent) {
                    $datass->where(function ($query) use ($agent) {
                        $query->where('asteriskcdrdb.cdr.userfield', $agent)
                            ->orWhere('dst_userfield', $agent);
                    });
                }
            }

            if (!Gate::allows('voice-record-supervisor')) {
                $uid = Auth::user()->id;

                $datass->where(function ($query) use ($uid) {
                    $query->where('asteriskcdrdb.cdr.userfield', $uid)
                        ->orWhere('dst_userfield', $uid);
                });
            } */

            $datas = $datass->get();

            $state_text = ['All', 'รอคิว', 'กำลังทำงาน', 'Export เสร็จแล้ว'];
            $ctype_text = ['All', 'สายเข้า', 'โทรออก', 'ภายใน'];

            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->job_number_id . '" class="flat" name="table_records[]" value="' . $row->job_number_id . '" >';
                })
                ->addColumn('action', function ($row) {
                    if (Gate::allows('agent-outbound')) {
                        $html = '<button type="button" class="btn btn-sm btn-warning btn-call" id="getEditData" data-id="' . $row->job_number_id . '"><i class="fa-solid fa-phone-volume"></i> โทรออก</button> ';
                    } else {
                        $html = '<button type="button" class="btn btn-sm btn-warning disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa-solid fa-phone-volume"></i> โทรออก</button> ';
                    }
                    /* if (Gate::allows('voice-export-delete')) {
                        if ($row->export_status == 3) {
                            $html .= '<button type="button" data-rowid="' . $row->job_number_id . '" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i> ลบรายการ</button>';
                        } else {
                            $html .= '<button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="bottom" title="ยัง Export ไม่เสร็จ"><i class="fa fa-trash"></i> ลบรายการ</button> ';
                        }
                    } else {
                        $html .= '<button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-trash"></i> ลบรายการ</button> ';
                    } */
                    return $html;
                })
                ->addColumn('more', function ($row) {
                    return '';
                })
                ->rawColumns(['checkbox', 'action'])->toJson();
        }



        return view('agentoutbound.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function call($id)
    {
        $data = ProjectJobNumber::find($id);

        return response()->json([
            'data' => $data,
        ]);
    }
}
