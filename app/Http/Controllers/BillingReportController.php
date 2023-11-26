<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Billing;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class BillingReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('permission:billing-list|billing-supervisor', ['only' => ['index', 'show']]);
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

        $datass = DB::connection('remote_connection')
            ->table('asteriskcdrdb.cdr')
            ->select('asteriskcdrdb.cdr.*')
            //->join('call_center.call_recording', 'asteriskcdrdb.cdr.uniqueid', '=', 'call_center.call_recording.uniqueid')
            ->where('asteriskcdrdb.cdr.dstchannel', '!=', '')
            ->where('asteriskcdrdb.cdr.recordingfile', '!=', '')
            ->where('asteriskcdrdb.cdr.disposition', '=', 'ANSWERED')
            ->orderBy('asteriskcdrdb.cdr.calldate', 'desc');

        $agens = User::orderBy('name', 'asc')->get();
        $agentArray = [];

        foreach ($agens as $agen) {
            $agentArray[$agen->id]['name'] = $agen->name;
        }
        
        $department = Department::orderBy('id', 'asc')->get();
        
        if ($request->ajax()) {

            if (!empty($request->get('sdate'))) {
                $dateRange = $request->input('sdate');
                if ($dateRange) {
                    $dateRangeArray = explode(' - ', $dateRange);

                    if (!empty($dateRangeArray) && count($dateRangeArray) == 2) {
                        $startDate = $dateRangeArray[0];
                        $endDate = $dateRangeArray[1];
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

            if (!empty($request->get('cdepartment'))) {
                $department = $request->input('cdepartment');
                if ($department) {

                    $users = User::where('department_id', $department)->get();
                    foreach ($users as $user) {
                        $idd[] = $user->id;
                    }
                    $datass->where(function ($query) use ($idd) {
                        $query->wherein('asteriskcdrdb.cdr.userfield',$ids);
                    });
                }
            }else{
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

            if (!Gate::allows('billing-list')) {
                $uid = Auth::user()->id;

                $datass->where(function ($query) use ($uid) {
                    $query->where('asteriskcdrdb.cdr.userfield', $uid)
                        ->orWhere('dst_userfield', $uid);
                });
            }

            $datas = $datass->get();
            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input disabled type="checkbox" id="' . $row->uniqueid . '" class="flat" name="table_records[]" value="' . $row->uniqueid . '" >';
                })
                ->editColumn('cdate', function ($row) {
                    $calldate = $row->calldate;
                    list($date, $time) = explode(' ', $calldate);
                    return $date;
                })
                ->editColumn('ctime', function ($row) {
                    $calldate = $row->calldate;
                    list($date, $time) = explode(' ', $calldate);
                    return $time;
                })
                ->editColumn('telno', function ($row) use ($agentArray) {
                    if ($row->accountcode !== '') {
                        if (!empty($row->userfield)) {
                            return $agentArray[$row->userfield]['name'] . " ( " . $row->src . " ) ";
                        } else {
                            return $row->src;
                        }
                    } else {
                        return $row->src;
                    }
                })
                ->editColumn('agent', function ($row) use ($agentArray) {
                    $telp = $row->accountcode == '' ? $this->getTelpFromDstChannel($row->dstchannel) : $row->dst;

                    if (!empty($row->dst_userfield) && isset($agentArray[$row->dst_userfield])) {
                        $agentName = $agentArray[$row->dst_userfield]['name'];
                        return "$agentName ( $telp ) ";
                    } else {
                        return $telp;
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
                ->addColumn('more', function ($row) {
                    return '';
                })->rawColumns(['checkbox', 'action'])->toJson();
        }

        return view('billingreport.index', [
            'datas' => $datass,
            'agens' => $agens,
            'departments' => $department,
        ]);
    }

    public function edit($id)
    {
        $remoteData = DB::connection('remote_connection')->table('call_center.call_recording')
            ->where('uniqueid', $id)
            ->first();

        $agens = User::orderBy('name', 'asc')->get();
        $agentArray = [];

        foreach ($agens as $agen) {
            $agentArray[$agen->id]['name'] = $agen->name;
        }

        if (!empty($remoteData)) {
            $voic = $remoteData->recordingfile;
            $avoic_name = explode("/", $voic);
            $voic_name = $agentArray[$remoteData->crm_id]['name'] . "-" . end($avoic_name);
            /* $avoic_name = explode("-", $voic_name_ori);
            $voic_name = $avoic_name[0] . "-" . $avoic_name[1]
                . "-" . $avoic_name[2] . "-" . $remoteData->crm_id . "-" . $avoic_name[3]
                . "-" . $avoic_name[4] . "-" . $avoic_name[5]; */
            $tooltips = Comment::where('uniqueid', $id)->get();
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
            $tooltips = Comment::where('uniqueid', $id)->get();
        }

        return response()->json(['voic' => $voic, 'remoteData2' => $remoteData, 'voic_name' => $voic_name, 'tooltips' => $tooltips]);
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
        $billing = $request->billing;

        $rules = [
            'billing' => 'required|max:10',
        ];

        //$validator = Validator::make($request->all(), $rules, [
        //    'billing.required' => 'กรุณากรอกค่าใช้จ่าย',
        //]);


        //if ($validator->fails()) {
        //    return response()->json(['errors' => $validator->errors()->all()]);
        //}

        $companyd = [
            'cost' => $billing,
        ];

        $datas = DB::connection('remote_connection')->table('asteriskcdrdb.cdr')
        ->where('uniqueid', $uniqueid);

        $datas->update($companyd);

        return response()->json(['success' => 'แก้ไข ค่าใช้จ่าย เรียบร้อยแล้ว']);
    }

    public function downloadAndDelete($id)
    {

        $remoteData = DB::connection('remote_connection')->table('call_center.call_recording')
            ->where('uniqueid', $id)
            ->first();

        $agens = User::orderBy('name', 'asc')->get();
        $agentArray = [];

        foreach ($agens as $agen) {
            $agentArray[$agen->id]['name'] = $agen->name;
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
/*
    public function updatebilling(Request $request, $id)
    {
        $rules = [
            'billing' => 'required|max:10',
        ];

        $validator = Validator::make($request->all(), $rules, [
            'billing.required' => 'กรุณากรอกค่าใช้จ่าย',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $companyd = [
            'price' => $request->input('billing'),
        ];

        $datas = DB::connection('remote_connection')->table('call_center.call_recording')
        ->where('uniqueid', $id);

        $datas->update($companyd);

        return response()->json(['success' => 'แก้ไข ค่าใช้จ่าย เรียบร้อยแล้ว']);
    }
    */
}
