<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        // $remoteData = DB::connection('remote_connection')->table('asteriskcdrdb.cdr')->get();

        // $datas = DB::table('cases')
        //     ->select(DB::raw('DATE(created_at) as cdate'), DB::raw('TIME(created_at) as ctime'), 'telno', 'agent', 'id')
        //     ->get();
        // $datas = DB::table('cases')
        //     ->join('remote_connection.asteriskcdrdb.cdr', 'cases.uniqueid', '=', 'cdr.uniqueid')
        //     ->select(DB::raw('DATE(cases.created_at) as cdate'), DB::raw('TIME(cases.created_at) as ctime'), 'cases.telno', 'cases.agent', 'cases.id')
        //     ->get();


        // $remoteData = DB::connection('remote_connection')->table('asteriskcdrdb.cdr')->get();
        // // $remoteData2 = DB::connection('remote_connection2')->table('call_center.call_recording')->get();

        // $datas = DB::connection('remote_connection')
        //     ->table('call_center.call_recording')
        //     ->join('remote_connection.asteriskcdrdb.cdr', 'call_recording.uniqueid', '=', 'cdr.uniqueid')
        //     ->select('call_recording.*', 'cdr.*') // Use * to select all columns, or specify the columns you want explicitly
        //     ->get();


        $remoteData = DB::connection('remote_connection')->table('asteriskcdrdb.cdr')->get();
        $remoteData2 = DB::connection('remote_connection')->table('call_center.call_recording')->get();

        $datas = [];

        foreach ($remoteData2 as $record) {
            foreach ($remoteData as $cdrRecord) {
                if ($record->uniqueid === $cdrRecord->uniqueid) {

                    $calldate = $record->datetime_entry;
                    list($date, $time) = explode(' ', $calldate);

                    $dst = $cdrRecord->dstchannel;
                    list($sip, $telp) = explode('/', $dst);

                    $durationInSeconds = $cdrRecord->billsec;
                    $hours = floor($durationInSeconds / 3600);
                    $minutes = floor(($durationInSeconds % 3600) / 60);
                    $seconds = $durationInSeconds % 60;

                    $durationFormatted = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
                    $combinedData = [
                        'id' => $record->id,
                        'datetime_entry' => $record->datetime_entry,
                        'uniqueid' => $record->uniqueid,
                        'cdate' => $date,
                        'ctime' => $time,
                        'telno' => $cdrRecord->src,
                        'agent' => $telp,
                        'duration' => $durationFormatted,
                        'action' => $record->recordingfile,
                    ];
                    $datas[] = (object)$combinedData;
                }
            }
        }


        // dd($datas);



        if ($request->ajax()) {
            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->id . '" >';
                })
                // ->addColumn('duration', function ($row) {
                //     $hours = str_pad(mt_rand(0, 23), 2, "0", STR_PAD_LEFT);
                //     $minutes = str_pad(mt_rand(0, 59), 2, "0", STR_PAD_LEFT);
                //     $seconds = str_pad(mt_rand(0, 59), 2, "0", STR_PAD_LEFT);

                //     $duration = "$hours:$minutes:$seconds";
                //     return $duration;
                // })
                // ->addColumn('duration', function ($row) {
                //     $durationInSeconds = $row->billsec;

                //     $hours = floor($durationInSeconds / 3600);
                //     $minutes = floor(($durationInSeconds % 3600) / 60);
                //     $seconds = $durationInSeconds % 60;

                //     $duration = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
                //     return $duration;
                // })
                ->addColumn('action', function ($row) {

                    if (Gate::allows('contact-edit')) {
                        $html = '<button type="button" class="changeUrlButtonw btn btn-sm btn-success btn-edit" id="changeUrlButtonw" data-id="' . $row->id . '"><i class="fa-solid fa-volume-high"></i> Play</button> ';
                    } else {
                        $html = '<button type="button" class="btn btn-sm btn-success disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa-solid fa-volume-high"></i> Play</button> ';
                    }

                    return $html;
                })
                ->addColumn('more', function ($row) {
                    return '';
                })->rawColumns(['checkbox', 'action'])->toJson();
        }

        return view('voicerecord.index');
    }
}
