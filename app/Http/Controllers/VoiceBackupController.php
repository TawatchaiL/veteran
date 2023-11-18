<?php

namespace App\Http\Controllers;

use App\Models\VoiceBackup;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class VoiceBackupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('permission:voice-export-list|voice-export-create|notify-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:voice-export-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:voice-export-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $agens = User::orderBy('name', 'asc')->get();
        $agentArray = [];

        foreach ($agens as $agen) {
            $agentArray[$agen->id]['name'] = $agen->name;
        }


        if ($request->ajax()) {

            $datas = VoiceBackup::orderBy("id", "desc")->get();
            $state_text = array('', 'รอคิว', 'กำลังทำงาน', 'Export เสร็จแล้ว');
            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->id . '" >';
                })
                ->addColumn('export_date', function ($row) {
                    $export_date = $row->export_start . " - " . $row->export_end;
                    return $export_date;
                })
                ->editColumn('status', function ($row) use ($state_text) {
                    $state = $state_text[$row->export_status];
                    return $state;
                })
                ->editColumn('export_progress', function ($row) {
                    $progress = ' <div class="progress progress-sm active">
                    <div class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuenow="' . $row->export_progress . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $row->export_progress . '%">
                    <span class="sr-only">' . $row->export_progress . '% Complete</span>
                    </div>
                    </div>';
                    return $progress;
                })
                ->addColumn('action', function ($row) {
                    if (Gate::allows('voice-export-download')) {
                        $html = '<button type="button" class="btn btn-sm btn-warning btn-edit" id="getEditData" data-id="' . $row->id . '"><i class="fa fa-download"></i> Download</button> ';
                    } else {
                        $html = '<button type="button" class="btn btn-sm btn-warning disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-download"></i> Download</button> ';
                    }
                    if (Gate::allows('voice-export-delete')) {
                        $html .= '<button type="button" data-rowid="' . $row->id . '" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i> ลบรายการ</button>';
                    } else {
                        $html .= '<button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-trash"></i> ลบรายการ</button> ';
                    }
                    return $html;
                })->rawColumns(['checkbox', 'export_progress', 'action'])->toJson();
        }



        return view('voicebackup.index')->with(['agent' => $agens]);
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
            'export_date' => 'required',
        ], [
            'export_date.required' => 'กรุณาระบุวันที่จะ export!',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $dateRange = $request->input('export_date');
        if ($dateRange) {
            $dateRangeArray = explode(' - ', $dateRange);

            if (!empty($dateRangeArray) && count($dateRangeArray) == 2) {
                $startDate = $dateRangeArray[0];
                $endDate = $dateRangeArray[1];
            }
        }

        $holiday = [
            'export_name' => "Export Voice Recording" . date("Y-m-d H:i:s"),
            'export_start' =>  $startDate,
            'export_end' => $endDate,
            'export_src' =>  $request->get('src'),
            'export_dst' => $request->get('dst'),
            'export_ctype' => $request->get('ctype'),
            'export_status' => 1,
        ];

        $vid = VoiceBackup::create($holiday);

        $this->gent_export_list($vid->id, $startDate, $endDate, $request->get('src'), $request->get('dst'), $request->get('ctype'));

        return response()->json(['success' => 'เพิ่มรายการ Export VoiceRecord เรียบร้อยแล้ว']);
    }

    public function gent_export_list($id, $sdate, $edate, $telp, $agent, $ctype)
    {

        $agens = User::orderBy('name', 'asc')->get();
        $agentArray = [];

        foreach ($agens as $agen) {
            $agentArray[$agen->id]['name'] = $agen->name;
        }


        $datass = DB::connection('remote_connection')
            ->table('asteriskcdrdb.cdr')
            ->select('asteriskcdrdb.cdr.*')
            ->where('asteriskcdrdb.cdr.dstchannel', '!=', '')
            ->where('asteriskcdrdb.cdr.recordingfile', '!=', '')
            ->where('asteriskcdrdb.cdr.disposition', '=', 'ANSWERED')
            ->orderBy('asteriskcdrdb.cdr.calldate', 'desc');

        $datass->whereBetween('asteriskcdrdb.cdr.calldate', [$sdate,  $edate]);


        if (!empty($telp)) {
            if ($telp) {
                $datass->where(function ($query) use ($telp) {
                    $query->where('asteriskcdrdb.cdr.src', 'like', "$telp%")
                        ->orWhere('dst', 'like', "$telp%");
                });
            }
        }

        if (!empty($ctype)) {
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

        if (!empty($agent)) {
            if ($agent) {
                $datass->where(function ($query) use ($agent) {
                    $query->where('asteriskcdrdb.cdr.userfield', $agent)
                        ->orWhere('dst_userfield', $agent);
                });
            }
        }

        $datas = $datass->get();

        $filenames = $datas->map(function ($item) use ($agentArray) {
            $datep = explode("-", explode(" ", $item->calldate)[0]);
            $original = $datep[0] . "/" . $datep[1] . "/" . $datep[2] . "/" . basename($item->recordingfile);

            $agentname = '';

            if ($item->dst_userfield !== null) {
                $agentname = $agentArray[$item->dst_userfield]['name'];
            } elseif ($item->accountcode !== '' && $item->userfield !== '') {
                $agentname = $agentArray[$item->userfield]['name'];
            }

            $agentname = $agentname ?: 'NoAgent';

            $newname = $agentname . "-" . basename($item->recordingfile);

            return $original . ',' . $newname;
        })->toArray();

        $fileContent = implode("\n", $filenames);
        $filePath = 'download/' . $id . '.txt';
        $fullPath = public_path($filePath);
        file_put_contents($fullPath, $fileContent);
    }

    /**
     * Display the specified resource.
     */
    public function show(VoiceBackup $voiceBackup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VoiceBackup $voiceBackup)
    {
        //
    }

    public function destroy(Request $request)
    {
        $id = $request->get('id');
        VoiceBackup::find($id)->delete();
        return ['success' => true, 'message' => 'ลบรายการ Export VoiceRecord เรียบร้อยแล้ว'];
    }

    public function destroy_all(Request $request)
    {

        $arr_del  = $request->get('table_records');
        for ($xx = 0; $xx < count($arr_del); $xx++) {
            VoiceBackup::find($arr_del[$xx])->delete();
        }

        return redirect('/voicebackup')->with('success', 'ลบรายการ Export VoiceRecord เรียบร้อยแล้ว');
    }
}
