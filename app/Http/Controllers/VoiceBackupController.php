<?php

namespace App\Http\Controllers;

use App\Models\VoiceBackup;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class VoiceBackupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
                $startDate = $dateRangeArray[0] . ' 00:00:00';
                $endDate = $dateRangeArray[1] . ' 23:59:59';
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

        VoiceBackup::create($holiday);

        return response()->json(['success' => 'เพิ่มรายการ Export Voice Record เรียบร้อยแล้ว']);
    }

    public function gent_export_list()
    {
        $datass = DB::connection('remote_connection')
            ->table('asteriskcdrdb.cdr')
            ->select('asteriskcdrdb.cdr.*')
            //->join('call_center.call_recording', 'asteriskcdrdb.cdr.uniqueid', '=', 'call_center.call_recording.uniqueid')
            ->where('asteriskcdrdb.cdr.dstchannel', '!=', '')
            ->where('asteriskcdrdb.cdr.recordingfile', '!=', '')
            ->where('asteriskcdrdb.cdr.disposition', '=', 'ANSWERED')
            ->orderBy('asteriskcdrdb.cdr.calldate', 'desc');

        if (!empty($request->get('sdate'))) {
            $dateRange = $request->input('sdate');
            if ($dateRange) {
                $dateRangeArray = explode(' - ', $dateRange);

                if (!empty($dateRangeArray) && count($dateRangeArray) == 2) {
                    $startDate = $dateRangeArray[0] . ' 00:00:00';
                    $endDate = $dateRangeArray[1] . ' 23:59:59';
                    //dd($startDate . ' - ' . $endDate);

                    $datass->whereBetween('asteriskcdrdb.cdr.calldate', [$startDate, $endDate]);
                }
            }
        }

        if (!empty($request->get('telp'))) {
            $telp = $request->input('telp');
            if ($telp) {
                $datass->where(function ($query) use ($telp) {
                    $query->where('asteriskcdrdb.cdr.src', 'like', "$telp%")
                        ->orWhere('dst', 'like', "$telp%");
                });
            }
        }

        if (!empty($request->get('ctype'))) {
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VoiceBackup $voiceBackup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VoiceBackup $voiceBackup)
    {
        //
    }
}
