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

        $remoteData = DB::connection('remote_connection')->table('asteriskcdrdb.cdr')->get();
        // $remoteData2 = DB::connection('remote_connection2')->table('call_center.call_recording')->get();

        $datas = DB::connection('remote_connection')
            ->table('call_center.call_recording')
            ->join('remote_connection.asteriskcdrdb.cdr', 'call_recording.uniqueid', '=', 'cdr.uniqueid')
            ->select('*') // Use * to select all columns, or specify the columns you want explicitly
            ->get();


        if ($request->ajax()) {
            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->id . '" >';
                })
                ->addColumn('duration', function ($row) {
                    $hours = str_pad(mt_rand(0, 23), 2, "0", STR_PAD_LEFT);
                    $minutes = str_pad(mt_rand(0, 59), 2, "0", STR_PAD_LEFT);
                    $seconds = str_pad(mt_rand(0, 59), 2, "0", STR_PAD_LEFT);

                    $duration = "$hours:$minutes:$seconds";
                    return $duration;
                })
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
