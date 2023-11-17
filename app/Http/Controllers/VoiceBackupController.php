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

        $vid = VoiceBackup::create($holiday);

        $this->gent_export_list($vid->id, $startDate, $endDate, $request->get('src'), $request->get('dst'), $request->get('ctype'));

        return response()->json(['success' => 'เพิ่มรายการ Export Voice Record เรียบร้อยแล้ว']);
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
