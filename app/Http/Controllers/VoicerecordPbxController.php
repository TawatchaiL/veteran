<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class VoicerecordPbxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('permission:voice-record-list|voice-record-supervisor', ['only' => ['index', 'show']]);
        $this->middleware('permission:contact-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:contact-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:contact-delete', ['only' => ['destroy']]);
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
    $datass = DB::connection('remote_connection_pbx')
        ->table('asteriskcdrdb.cdr')
        ->select('asteriskcdrdb.cdr.*')
        //->where('asteriskcdrdb.cdr.dstchannel', '!=', '')   // ❌ REMOVED
        ->where('asteriskcdrdb.cdr.recordingfile', '!=', '')
        ->orderBy('asteriskcdrdb.cdr.calldate', 'desc');

    $agens = User::orderBy('name', 'asc')->get();
    $agentArray = [];

    foreach ($agens as $agen) {
        $agentArray[$agen->id]['name'] = explode(' ', $agen->name)[0];
    }

    if ($request->ajax()) {

        // --- FILTER วันที่ (ใช้งานได้) ---
        if (!empty($request->get('sdate'))) {
            $dateRange = $request->input('sdate');
            if ($dateRange) {
                $dateRangeArray = explode(' - ', $dateRange);

                if (!empty($dateRangeArray) && count($dateRangeArray) == 2) {
                    $startDate = $dateRangeArray[0];
                    $endDate = $dateRangeArray[1];
                    $datass->whereBetween('asteriskcdrdb.cdr.calldate', [$startDate, $endDate]);
                }
            }
        }

        // --- FILTER เบอร์โทร (ใช้งานได้) ---
        if (!empty($request->get('telp'))) {
            $telp = $request->input('telp');
            if ($telp) {
                $datass->where(function ($query) use ($telp) {
                    $query->where('asteriskcdrdb.cdr.src', 'like', "$telp%")
                        ->orWhere('asteriskcdrdb.cdr.dst', 'like', "$telp%");
                });
            }
        }

        // --- FILTER ctype (❌ ตัดทั้งหมดที่ใช้ฟิลด์ผิดออก) ---
        if (!empty($request->get('ctype'))) {
            $ctype = $request->input('ctype');

            if ($ctype == 2) {
                // สายออก — ใช้ recordingfile ได้
                $datass->where('asteriskcdrdb.cdr.recordingfile', 'like', 'out-%');
            } else if ($ctype == 3) {
                // สายภายใน — ใช้ recordingfile ได้
                $datass->where('asteriskcdrdb.cdr.recordingfile', 'like', 'exten-%');
            }

            // ❌ ลบเงื่อนไขที่อ้าง dst_exten, dst_userfield, dcontext ออกทั้งหมด
        }

        // --- FILTER Agent (❌ ตัด dst_userfield ออก) ---
        if (!empty($request->get('agent'))) {
            $agent = $request->input('agent');
            if ($agent) {
                $datass->where('asteriskcdrdb.cdr.userfield', $agent);
                // ->orWhere('dst_userfield', $agent); // ❌ REMOVED
            }
        }

        // --- Supervisor Filter (❌ ตัด dst_userfield ออก) ---
        if (!Gate::allows('voice-record-supervisor')) {
            $uid = Auth::user()->id;

            $datass->where('asteriskcdrdb.cdr.userfield', $uid);
            // ->orWhere('dst_userfield', $uid); // ❌ REMOVED
        }

        $datas = $datass->get();

        return datatables()->of($datas)
            ->editColumn('checkbox', function ($row) {
                return '<input disabled type="checkbox" id="' . $row->uniqueid . '" class="flat" name="table_records[]" value="' . $row->uniqueid . '" >';
            })
            ->editColumn('cdate', function ($row) {
                return explode(' ', $row->calldate)[0];
            })
            ->editColumn('ctime', function ($row) {
                return explode(' ', $row->calldate)[1];
            })
            ->editColumn('telno', function ($row) use ($agentArray) {
                if ($row->accountcode !== '') {
                    if (!empty($row->userfield)) {
                        return $agentArray[str_replace(';', '', $row->userfield)]['name'] . " ( " . $row->src . " ) ";
                    } else {
                        return $row->src;
                    }
                } else {
                    return $row->src;
                }
            })

            // --- Agent Column (❌ ลบ logic ที่ใช้ dst_exten, dst_userfield, dstchannel) ---
            ->editColumn('agent', function ($row) use ($agentArray) {

                // วิธีใหม่แบบง่าย ไม่ใช้ฟิลด์ที่หายไป
                if (!empty($row->userfield) && isset($agentArray[$row->userfield])) {
                    return $agentArray[$row->userfield]['name'] . " ( " . $row->dst . " ) ";
                }

                return $row->dst;
            })

            ->editColumn('duration', function ($row) {
                $durationInSeconds = $row->duration;
                $hours = floor($durationInSeconds / 3600);
                $minutes = floor(($durationInSeconds % 3600) / 60);
                $seconds = $durationInSeconds % 60;
                return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
            })
            ->addColumn('action', function ($row) {

                if (Gate::allows('contact-edit')) {
                    return '<button type="button" class="changeUrlButton btn btn-sm btn-success btn-edit" id="changeUrlButtonw" data-id="' . $row->uniqueid . '"><i class="fa-solid fa-volume-high"></i> Play</button> ';
                }

                return '<button type="button" class="btn btn-sm btn-success disabled" title="คุณไม่มีสิทธิ์"><i class="fa-solid fa-volume-high"></i> Play</button> ';
            })
            ->rawColumns(['checkbox', 'action'])
            ->toJson();
    }

    return view('voicerecordpbx.index', [
        'datas' => $datass,
        'agens' => $agens,
    ]);
}

public function edit($id)
{
    // ------------------------------------------------------------------
    // ❌ โค้ดเดิมแบบใช้ call_center.call_recording (ขอคอมเมนต์ไว้ก่อน)
    // ------------------------------------------------------------------
    /*
    $remoteData = DB::connection('remote_connection_pbx')->table('call_center.call_recording')
        ->where('uniqueid', $id)
        ->first();

    ...
    */

    // ------------------------------------------------------------------
    // ✔ โค้ดใหม่: ดึงข้อมูลจาก CDR เท่านั้น
    // ------------------------------------------------------------------
    $remoteData = DB::connection('remote_connection_pbx')->table('asteriskcdrdb.cdr')
        ->where('uniqueid', $id)
        ->orderBy('calldate', 'asc')
        ->first();

    if (!$remoteData) {
        return response()->json(['error' => 'Record not found'], 404);
    }

    // ------------------------------------------------------------------
    // ✔ เตรียม Agent Array (จำเป็นต้องใช้)
    // ------------------------------------------------------------------
    $agens = User::orderBy('name', 'asc')->get();
    $agentArray = [];
    foreach ($agens as $agen) {
        $agentArray[$agen->id]['name'] = explode(' ', $agen->name)[0];
    }

    // ------------------------------------------------------------------
    // ✔ เตรียมพาธไฟล์เสียงตามวันที่
    // ------------------------------------------------------------------
    $avoic = explode("/", $remoteData->recordingfile);
    $datep = explode("-", explode(" ", $remoteData->calldate)[0]);
    $voic = $datep[0] . "/" . $datep[1] . "/" . $datep[2] . "/" . end($avoic);

    // ------------------------------------------------------------------
    // ✔ หา Agent Name จาก userfield (เพราะ CDR มีฟิลด์นี้จริง)
    // ------------------------------------------------------------------

    /*
    // ❌ เดิม: ใช้ dst_userfield ซึ่งไม่มีใน CDR
    if ($remoteData->dst_userfield !== null) {
        $agentname = $agentArray[$remoteData->dst_userfield]['name'];
    }
    */

    $agentname = '';

    // ✔ ใช้ userfield แทน dst_userfield
    if (!empty($remoteData->userfield) && isset($agentArray[$remoteData->userfield])) {
        $agentname = $agentArray[$remoteData->userfield]['name'];
    }

    // ถ้าไม่พบ agent เลย → ตั้งชื่อ “NoAgent”
    $agentname = $agentname ?: 'NoAgent';

    // ------------------------------------------------------------------
    // ✔ ตั้งชื่อไฟล์สำหรับแสดงบน Modal
    // ------------------------------------------------------------------
    $voic_name = $agentname . "-" . end($avoic);

    // ------------------------------------------------------------------
    // ✔ โหลดคอมเมนต์ (Tooltip)
    // ------------------------------------------------------------------
    $tooltips = Comment::where('uniqueid', $id)->get();

    return response()->json([
        'voic' => $voic,
        'remoteData2' => $remoteData,
        'voic_name' => $voic_name,
        'tooltips' => $tooltips
    ]);
}

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'comment' => 'required|string|max:255',
        // ]);
        $comment = Comment::findOrFail($id);
        $input = $request->all();
        $comment->update($input);

        return response()->json(['message' => 'Comment updated successfully']);
    }

    public function comment(Request $request)
    {
        //$call_recording_id = $request->call_recording_id;
        $uniqueid = $request->uniqueid;
        $start = $request->start;
        $end = $request->end;

        $check_data = Comment::where('uniqueid', $uniqueid)
            ->where('start', $start)
            ->where('end', $end)
            ->get();

        if (count($check_data) > 0) {
            return response()->json(['message' => 'ข้อมูลซ้ำ']);
        } else {
            $input = $request->all();
            $comment = Comment::create($input);
            return response()->json(['message' => 'Comment saved successfully', 'id' => $comment->id]);
        }
    }


    public function downloadAndDelete($id)
    {

        $remoteData = DB::connection('remote_connection')->table('call_center.call_recording')
            ->where('uniqueid', $id)
            ->first();

        $agens = User::orderBy('name', 'asc')->get();
        $agentArray = [];

        foreach ($agens as $agen) {
            $agentArray[$agen->id]['name'] = explode(' ', $agen->name)[0];
        }

        if (!empty($remoteData)) {
            $voic = $remoteData->recordingfile;
            $avoic_name = explode("/", $voic);
            $voic_name = $agentArray[$remoteData->crm_id]['name'] . "-" . end($avoic_name);
        } else {
            $remoteData = DB::connection('remote_connection')->table('asteriskcdrdb.cdr')
                ->where('uniqueid', $id)
                ->orderBy('calldate', 'asc')
                ->first();

            $avoic = explode("/", $remoteData->recordingfile);
            $datep = explode("-", explode(" ", $remoteData->calldate)[0]);
            $voic = $datep[0] . "/" . $datep[1] . "/" . $datep[2] . "/" . end($avoic);

            $agentname = '';

            if ($remoteData->dst_userfield !== null) {
                $agentname = $agentArray[$remoteData->dst_userfield]['name'];
            } elseif ($remoteData->accountcode !== '' && $remoteData->userfield !== '') {
                $agentname = $agentArray[$remoteData->userfield]['name'];
            }

            $agentname = $agentname ?: 'NoAgent';

            $voic_name = $agentname . "-" . end($avoic);
        }

        $originalFilePath = public_path('wav/' . $voic);

        if (!file_exists($originalFilePath)) {
            abort(404);
        }

        $fileContent = file_get_contents($originalFilePath);

        if ($fileContent === false) {
            return response()->json(['error' => 'Failed to retrieve file content'], 500);
        }

        return response($fileContent)
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', 'attachment; filename="' . $voic_name . '"');
    }

    public function destroy($id)
    {
        // Code to delete the comment with the given ID
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
