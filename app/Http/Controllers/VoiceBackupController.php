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

    public function getTelpFromDstChannel($dstChannel)
    {
        if ($dstChannel !== null && strpos($dstChannel, 'SIP/') === 0) {
            list($sip, $no) = explode('/', $dstChannel);
            list($telp, $lear) = explode('-', $no);
            return $telp;
        }

        return null;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $agens = User::orderBy('name', 'asc')->get();
        $agentArray = [];

        $agentArray[0]['name'] = 'All';
        foreach ($agens as $agen) {
            $agentArray[$agen->id]['name'] = $agen->name;
        }


        if ($request->ajax()) {

            $datas = VoiceBackup::orderBy("id", "desc")->get();
            $state_text = ['All', 'รอคิว', 'กำลังทำงาน', 'Export เสร็จแล้ว'];
            $ctype_text = ['All', 'สายเข้า', 'โทรออก', 'ภายใน'];

            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->id . '" >';
                })
                ->addColumn('export_date', function ($row) {
                    $export_date = $row->export_start . " - " . $row->export_end;
                    return $export_date;
                })
                ->editColumn('export_src', function ($row) {
                    if ($row->export_src !== '' && $row->export_src !== NULL) {
                        return $row->export_src;
                    }
                    return 'All';
                })
                ->editColumn('export_dst', function ($row) use ($agentArray) {
                    if ($row->export_dst !== '' && $row->export_dst !== NULL) {
                        return $agentArray[$row->export_dst]['name'];
                    }
                    return 'All';
                })
                ->editColumn('export_ctype', function ($row) use ($ctype_text) {
                    if ($row->export_ctype !== '' && $row->export_ctype !== NULL) {
                        return $ctype_text[$row->export_ctype];
                    }
                    return 'All';
                })
                ->editColumn('status', function ($row) use ($state_text) {
                    $state = $state_text[$row->export_status];
                    return $state;
                })
                ->editColumn('export_progress', function ($row) {
                    $progress = ' <div class="progress progress-sm active">
                    <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="' . $row->export_progress . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $row->export_progress . '%">
                    <span class="sr-only">' . $row->export_progress . '% Complete</span>
                    </div>
                    </div><small>' . $row->export_progress . '% Complete</small>';
                    return $progress;
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
                ->rawColumns(['checkbox', 'export_progress', 'action'])->toJson();
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
                list($startDate, $startTime) = explode(' ', $dateRangeArray[0]);
                list($endDate, $endTime) = explode(' ', $dateRangeArray[1]);

                [$startDay, $startMonth, $startYear] = explode('/', $startDate);
                [$endDay, $endMonth, $endYear] = explode('/', $endDate);

                $startDate = ($startYear - 543) . "-$startMonth-$startDay $startTime";
                $endDate = ($endYear - 543) . "-$endMonth-$endDay $endTime";
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

        $ret = $this->gent_export_list($vid->id, $startDate, $endDate, $request->get('src'), $request->get('dst'), $request->get('ctype'));
        if ($ret == 1) {
            return response()->json(['success' => 'เพิ่มรายการ Export VoiceRecord เรียบร้อยแล้ว <br> กรุณาเช็คในหน้า Voice Export']);
        } else {
            VoiceBackup::find($vid->id)->delete();
            return response()->json(['errors' => ['ไม่พบรายการไฟล์ตามช่วงเวลาที่ท่านระบุ']]);
        }
    }

    public function gent_export_list($id, $sdate, $edate, $telp, $agent, $ctype)
    {

        $agens = User::orderBy('name', 'asc')->get();
        $agentArray = [];

        foreach ($agens as $agen) {
            $agentArray[$agen->id]['name'] = $agen->name;
        }

        $ctype_text = ['', 'Incoming', 'Outgoing', 'Local'];


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
            if ($agent !== 0) {
                $datass->where(function ($query) use ($agent) {
                    $query->where('asteriskcdrdb.cdr.userfield', $agent)
                        ->orWhere('dst_userfield', $agent);
                });
            }
        }

        $datas = $datass->get();

        if ($datas->isEmpty()) {
            return 0;
        }

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

        $csvs = $datas->map(function ($item) use ($agentArray, $ctype_text, $ctype) {
            $agentname = '';

            if ($item->dst_userfield !== null) {
                $agentname = $agentArray[$item->dst_userfield]['name'];
            } elseif ($item->accountcode !== '' && $item->userfield !== '') {
                $agentname = $agentArray[$item->userfield]['name'];
            }

            $agentname = $agentname ?: 'NoAgent';

            $newname = $agentname . "-" . basename($item->recordingfile);

            if ($item->accountcode !== '') {
                if (!empty($item->userfield)) {
                    $src = $agentArray[$item->userfield]['name'] . " ( " . $item->src . " ) ";
                } else {
                    $src = $item->src;
                }
            } else {
                $src = $item->src;
            }

            $telp = $item->accountcode == '' ? $this->getTelpFromDstChannel($item->dstchannel) : $item->dst;

            if (!empty($item->dst_userfield) && isset($agentArray[$item->dst_userfield])) {
                $agentName = $agentArray[$item->dst_userfield]['name'];
                $dst =  "$agentName ( $telp ) ";
            } else {
                $dst = $telp;
            }

            $durationInSeconds = $item->billsec;
            $hours = floor($durationInSeconds / 3600);
            $minutes = floor(($durationInSeconds % 3600) / 60);
            $seconds = $durationInSeconds % 60;

            $duration = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
            $ctypeIndex = isset($ctype_text[$ctype]) ? $ctype : 0;
            // Create an array to store each row's values
            $rowValues = [
                $item->calldate,
                $src,
                $dst,
                $ctype_text[$ctypeIndex],
                $duration,
                $newname,
            ];

            // Join the array values into a CSV formatted string
            return implode(',', $rowValues);
        })->toArray();

        // Combine header and data
        $csvContent = "Calldate,Source,Destination,Calltype,Duration,VoiceFileName\n" . implode("\n", $csvs);

        //$csvContent = implode("\n", $csvs);
        $csvfilePath = 'download/' . $id . '.csv';
        $csvfullPath = public_path($csvfilePath);
        file_put_contents($csvfullPath, $csvContent);

        $fileContent = implode("\n", $filenames);
        $filePath = 'download/' . $id . '.txt';
        $fullPath = public_path($filePath);
        file_put_contents($fullPath, $fileContent);

        return 1;
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
        $voice = VoiceBackup::find($id);

        if ($voice && $voice->export_status == 3) {
            $exportFilePath = public_path('zip/' . $voice->export_filename);
            if (file_exists($exportFilePath)) {
                unlink($exportFilePath);
            }

            $voice->delete();

            return ['success' => true, 'message' => 'ลบรายการ Export VoiceRecord เรียบร้อยแล้ว'];
        }

        return ['success' => false, 'message' => 'ไม่สามารถลบรายการ Export VoiceRecord ได้'];
    }

    public function destroy_all(Request $request)
    {
        $arr_del = $request->get('table_records');

        foreach ($arr_del as $recordId) {
            $voice = VoiceBackup::find($recordId);

            if ($voice && $voice->export_status == 3) {
                $exportFilePath = public_path('zip/' . $voice->export_filename);

                if (file_exists($exportFilePath) && unlink($exportFilePath)) {
                    $voice->delete();
                }
            }
        }

        return redirect('/voicebackup')->with('success', 'ลบรายการ Export VoiceRecord เรียบร้อยแล้ว');
    }
}
