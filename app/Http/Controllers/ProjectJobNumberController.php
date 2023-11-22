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
        $agens = User::orderBy('name', 'asc')->get();
        $agentArray = [];

        foreach ($agens as $agen) {
            $agentArray[$agen->id]['name'] = $agen->name;
        }

        $datass = ProjectJobNumber::orderBy("job_number_id", "desc")
            ->where('dial_agent', $uid);
        if ($request->ajax()) {

            if (!empty($request->get('sdate'))) {
                $dateRange = $request->input('sdate');
                if ($dateRange) {
                    $dateRangeArray = explode(' - ', $dateRange);
                    $search_array = ['create_date', 'create_date', 'call_date'];
                    if (!empty($request->get('searchtype'))) {
                        $search_field = $search_array[$request->get('searchtype')];
                    } else {
                        $search_field = 'create_date';
                    }
                    if (!empty($dateRangeArray) && count($dateRangeArray) == 2) {
                        $startDate = $dateRangeArray[0];
                        $endDate = $dateRangeArray[1];
                        //dd($startDate . ' - ' . $endDate);
                        $datass->whereBetween($search_field, [$startDate, $endDate]);
                    }
                }
            }

            if (!empty($request->get('calltype'))) {
                $searchtype = $request->input('calltype');
                $search_array = [0, 0, 1];
                if ($searchtype) {
                    $datass->where(function ($query) use ($searchtype, $search_array) {
                        $query->where('call_status', '=', $search_array[$searchtype]);
                    });
                }
            } else {
                $datass->where('call_status', 0);
            }


            if (!empty($request->get('searchtext'))) {
                $searchtext = $request->input('searchtext');
                if ($searchtext) {
                    $datass->where(function ($query) use ($searchtext) {
                        $query->where('call_number', 'like', "$searchtext%");
                    });
                }
            }


            $datas = $datass->get();

            $state_text = ['All', 'รอคิว', 'กำลังทำงาน', 'Export เสร็จแล้ว'];
            $ctype_text = ['ยังไม่ได้โทรออก', 'โทรออกแล้ว'];

            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->job_number_id . '" class="flat" name="table_records[]" value="' . $row->job_number_id . '" >';
                })
                ->editColumn('call_date', function ($row) {
                    $cdate = $row->call_date !== null ? $row->call_date : ' - ';
                    return $cdate;
                })
                ->editColumn('call_status', function ($row) use ($ctype_text) {
                    return $ctype_text[$row->call_status];
                })
                ->editColumn('dial', function ($row) use ($ctype_text) {
                    return $ctype_text[$row->call_status];
                })
                ->editColumn('dial_number', function ($row) use ($agentArray) {
                    $dnumber = $row->dial_number !== null ? $row->dial_number : ' - ';
                    return $agentArray[$row->dial_agent]['name'] . ' (' . $dnumber . ')';
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
        $data->update(['call_status' => 1]);
        return response()->json([
            'data' => $data,
        ]);
    }
}
