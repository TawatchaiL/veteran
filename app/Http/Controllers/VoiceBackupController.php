<?php

namespace App\Http\Controllers;

use App\Models\VoiceBackup;
use Illuminate\Support\Facades\Gate;
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
