<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class VoicerecordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('permission:contact-list|contact-create|contact-edit|contact-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:contact-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:contact-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:contact-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $remoteData = DB::connection('remote_connection')->table('asteriskcdrdb.cdr')->get();
        $remoteData2 = DB::connection('remote_connection')->table('call_center.call_recording')->orderBy('id', 'desc')->get();
        // dd($datas);
        $datass = DB::connection('remote_connection')
            ->table('asteriskcdrdb.cdr')
            ->join('call_center.call_recording', 'asteriskcdrdb.cdr.uniqueid', '=', 'call_center.call_recording.uniqueid')
            ->orderBy('id', 'desc');

        // $agens = User::all();
        $agens = DB::connection('remote_connection')->table('asterisk.devices')->get();

        // foreach ($agens as $data) {
        //     $user = $data->user;
        //     // Now you can use $user in your code
        //     // For example, you can echo it to display it
        //     echo "User: $user";
        // }
        // dd($agens);

        if ($request->ajax()) {

            if (!empty($request->get('sdate'))) {
                $dateRange = $request->input('sdate');
                if ($dateRange) {
                    $dateRangeArray = explode(' - ', $dateRange);

                    if (!empty($dateRangeArray) && count($dateRangeArray) == 2) {
                        $startDate = $dateRangeArray[0];
                        $endDate = $dateRangeArray[1];
                        $datass->whereBetween('datetime_entry', [$startDate, $endDate]);
                    }
                }
            }

            $datas = $datass->get();
            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->id . '" >';
                })
                ->editColumn('cdate', function ($row) {
                    $calldate = $row->datetime_entry;
                    list($date, $time) = explode(' ', $calldate);
                    return $date;
                })
                ->editColumn('ctime', function ($row) {
                    $calldate = $row->datetime_entry;
                    list($date, $time) = explode(' ', $calldate);
                    return $time;
                })
                ->editColumn('telno', function ($row) {
                    return $row->src;
                })
                ->editColumn('agent', function ($row) {
                    $dst = $row->dstchannel;
                    if ($dst !== null && strpos($dst, 'SIP/') === 0) {
                        list($sip, $no) = explode('/', $dst);
                        list($telp, $lear) = explode('-', $no);
                        return $telp;
                    } else {
                        return 'ไม่พบเบอร์โทรศัพท์';
                    }
                })
                ->editColumn('duration', function ($row) {
                    $durationInSeconds = $row->billsec;
                    $hours = floor($durationInSeconds / 3600);
                    $minutes = floor(($durationInSeconds % 3600) / 60);
                    $seconds = $durationInSeconds % 60;

                    $duration = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
                    return $duration;
                })
                ->addColumn('action', function ($row) {

                    if (Gate::allows('contact-edit')) {
                        $html = '<button type="button" class="changeUrlButton btn btn-sm btn-success btn-edit" id="changeUrlButtonw" data-id="' . $row->id . '"><i class="fa-solid fa-volume-high"></i> Play</button> ';
                        // $html .= '<a href="#" class="btn btn-success changeUrlButton" onclick="formModal(\'' . route('voicerecord.edit', $row->id) . '\')" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="vioc1">vioc1</a>';
                        // $html .= '<a href="#" class="btn btn-success vioc" onclick="formModal(\'' . route('voicerecord.edit', $row->id) . '\')" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="vioc2">vioc2</a>';
                    } else {
                        $html = '<button type="button" class="btn btn-sm btn-success disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa-solid fa-volume-high"></i> Play</button> ';
                    }

                    return $html;
                })
                ->addColumn('more', function ($row) {
                    return '';
                })->rawColumns(['checkbox', 'action'])->toJson();
        }

        return view('voicerecord.index',[

            'datas' => $datass,
            'agens'=> $agens,

        ]);
    }
    public function edit($id)
    {
        $remoteData2 = DB::connection('remote_connection')->table('call_center.call_recording')
            ->where('id', $id)
            ->first();
        $voic = $remoteData2->recordingfile;
        $voic_name = substr($voic, 14);
        $tooltips = Comment::where('call_recording_id', $id)->get();
        return response()->json(['voic' => $voic, 'remoteData2' => $remoteData2, 'voic_name' => $voic_name, 'tooltips' => $tooltips]);
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
        $call_recording_id = $request->call_recording_id;
        $uniqueid = $request->uniqueid;
        $start = $request->start;
        $end = $request->end;

        $check_data = Comment::where([
            ['call_recording_id', $call_recording_id],
            ['uniqueid', $uniqueid],
            ['start', $start],
            ['end', $end]
        ])->get();

        if (count($check_data) > 0) {
            return response()->json(['message' => 'ข้อมูลซ้ำ']);
        } else {
            $input = $request->all();
            Comment::create($input);
            return response()->json(['message' => 'Comment saved successfully']);
        }
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
