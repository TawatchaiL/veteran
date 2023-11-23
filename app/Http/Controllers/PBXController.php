<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project_job_number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Services\AsteriskAmiService;
use App\Services\IssableService;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use GuzzleHttp\Client;

class PBXController extends Controller
{
    protected $remote;
    protected $issable;
    protected $warp_id;
    protected $sup_break_id;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AsteriskAmiService $asteriskAmiService, IssableService $issableService)
    {
        $this->remote = $asteriskAmiService;
        $this->issable = $issableService;
        $this->warp_id = config('asterisk.manager.warp_id');
        $this->sup_break_id = config('asterisk.manager.sup_break_id');
    }

    public function pause_list()
    {
        $resultb = DB::connection('remote_connection')
            ->table('call_center.break')
            ->where('tipo', 'B')
            ->where('id', '!=', $this->warp_id)
            ->where('id', '!=', $this->sup_break_id)
            ->get();

        return response()->json($resultb);
    }

    public function call_answer(Request $request)
    {

        $user = Auth::user();

        if ($user) {
            $client = new Client();

            /* $api_url = config('asterisk.api_serv.address');

            $response = $client->request('GET', $api_url . '/peer/' . $user->phone);

            $responseBody = $response->getBody()->getContents();
            $data = json_decode($responseBody, true);

            if (json_last_error() === JSON_ERROR_NONE && isset($data['address-ip'])) {
                $addressIp = $data['address-ip'];
            } else {
                dd("Error parsing JSON or 'address-ip' not found in the response");
            }
 */
            $addressIp = $user->phone_ip;

            $response = $client->request('GET', 'http://admin:admin@' . $addressIp . '/servlet?key=ANSWER');

            $responseBody = $response->getBody();
            $status = $response->getStatusCode();

            if ($status) {
                return [
                    'success' => $status,
                ];
            } else {
                return ['success' => false, 'message' => 'error'];
            }
        } else {
            return ['error' => false, 'message' => 'error'];
        }
    }

    public function call_hold(Request $request)
    {

        $user = Auth::user();

        if ($user) {
            $client = new Client();

            /* $api_url = config('asterisk.api_serv.address');

            $response = $client->request('GET', $api_url . '/peer/' . $user->phone);

            $responseBody = $response->getBody()->getContents();
            $data = json_decode($responseBody, true);

            if (json_last_error() === JSON_ERROR_NONE && isset($data['address-ip'])) {
                $addressIp = $data['address-ip'];
            } else {
                dd("Error parsing JSON or 'address-ip' not found in the response");
            } */

            $addressIp = $user->phone_ip;

            $response = $client->request('GET', 'http://admin:admin@' . $addressIp . '/servlet?key=F_HOLD');
            //$response = $client->request('GET', 'http://admin:admin@' . $addressIp . '/servlet?key=SWAP');

            $responseBody = $response->getBody();
            $status = $response->getStatusCode();

            if ($status) {
                return [
                    'success' => $status,
                ];
            } else {
                return ['success' => false, 'message' => 'error'];
            }
        } else {
            return ['error' => false, 'message' => 'error'];
        }
    }

    public function call_swap(Request $request)
    {

        $user = Auth::user();

        if ($user) {
            $client = new Client();

            /* $api_url = config('asterisk.api_serv.address');

            $response = $client->request('GET', $api_url . '/peer/' . $user->phone);

            $responseBody = $response->getBody()->getContents();
            $data = json_decode($responseBody, true);

            if (json_last_error() === JSON_ERROR_NONE && isset($data['address-ip'])) {
                $addressIp = $data['address-ip'];
            } else {
                dd("Error parsing JSON or 'address-ip' not found in the response");
            } */

            $addressIp = $user->phone_ip;

            //$response = $client->request('GET', 'http://admin:admin@' . $addressIp . '/servlet?key=F_HOLD');
            $response = $client->request('GET', 'http://admin:admin@' . $addressIp . '/servlet?key=SWAP');

            $responseBody = $response->getBody();
            $status = $response->getStatusCode();

            if ($status) {
                return [
                    'success' => $status,
                ];
            } else {
                return ['success' => false, 'message' => 'error'];
            }
        } else {
            return ['error' => false, 'message' => 'error'];
        }
    }

    public function call_tranfer(Request $request)
    {

        $user = Auth::user();

        if ($user) {
            if ($request->get('atxfer') == 1) {
                $ret = $this->issable->atx_transfer($user->phone, $request->get('number'));
            } else {
                $ret = $this->issable->transfer($user->phone, $request->get('number'));
            }


            if ($ret == true) {
                return [
                    'success' => true,
                ];
            } else {
                return ['success' => false, 'message' => 'error'];
            }
        } else {
            return ['error' => false, 'message' => 'error'];
        }
    }

    public function loginAgentToQueue()
    {

        $user = Auth::user();

        if ($user) {

            $ret = $this->issable->agent_login($user->phone);

            DB::connection('remote_connection')
                ->table('call_center.audit')
                ->where('id_agent', $user->agent_id)
                ->whereNull('datetime_end')
                ->update(['crm_id' => $user->id]);

            $user->phone_status_id = 1;
            $user->agent_type = 'Inbound';
            //$user->agent_id = $user->id;
            $user->phone_status = "พร้อมรับสาย" . " " . $user->agent_type;
            $user->phone_status_icon = '<i class="fa-solid fa-xl fa-user-check"></i>';
            $user->save();

            if ($ret == true) {
                return [
                    'success' => true,
                    'id' => $user->phone_status_id,
                    'message' => $user->phone_status,
                    'icon' => $user->phone_status_icon
                ];
            } else {
                return ['success' => false, 'message' => 'login error'];
            }
        } else {
            return ['success' => false, 'message' => 'login error'];
        }
    }

    public function loginAgentToQueueOutbound()
    {
        $user = Auth::user();

        if ($user) {

            $ret = $this->remote->queue_log_in('6789', $user->phone);
            $user->agent_type = 'Outbound';
            $user->phone_status_id = 1;
            //$user->agent_id = $user->id;
            $user->phone_status = "พร้อมรับสาย" . " " . $user->agent_type;
            $user->phone_status_icon = '<i class="fa-solid fa-xl fa-user-check"></i>';
            $user->save();

            if ($ret == true) {
                return [
                    'success' => true,
                    'id' => $user->phone_status_id,
                    'message' => $user->phone_status,
                    'icon' => $user->phone_status_icon
                ];
            } else {
                return ['success' => false, 'message' => 'login error'];
            }
        } else {
            return ['success' => false, 'message' => 'login error'];
        }
    }

    public function logoffAgentFromQueue()
    {

        $user = Auth::user();

        if ($user) {

            //check if not already logoff
            if ($user->phone_status_id !== 0) {
                $user->phone_status_id = 0;
                $user->phone_status = "ไม่พร้อมรับสาย";
                $user->phone_status_icon = '<i class="fa-solid fa-xl fa-user-xmark"></i>';
                $user->logoff_time = Carbon::now();
                $user->save();

                $ret = $this->issable->agent_logoff($user->phone);

                if ($ret == true) {
                    return [
                        'success' => true,
                        'id' => $user->phone_status_id,
                        'message' => $user->phone_status,
                        'icon' => $user->phone_status_icon
                    ];
                } else {
                    return ['success' => false, 'message' => 'login error'];
                }
            } else {
                return ['success' => false, 'message' => 'logoff error'];
            }
        }
    }

    public function logoffAgentFromQueueAndLogout()
    {

        $user = Auth::user();

        if ($user) {

            $this->issable->agent_logoff($user->phone);

            $user->phone = '';
            //$user->agent_id = '';
            $user->phone_status_id = 0;
            $user->phone_status = "ไม่พร้อมรับสาย";
            $user->phone_status_icon = '<i class="fa-solid fa-xl fa-user-xmark"></i>';
            $user->logoff_time = Carbon::now();
            $user->save();

            /* DB::connection('remote_connection')
                ->table('call_center.agent')
                ->where('id', $user->agent_id)
                ->update(['number' => 0]); */

            Auth::logout();
        } else {
            return ['error' => false, 'message' => 'error'];
        }
    }


    public function AgentBreak(Request $request)
    {

        $user = Auth::user();

        if ($user) {

            if ($user->agent_type == "Inbound") {
                $ret = $this->issable->agent_break($user->phone, $request->get('id_break'));

                DB::connection('remote_connection')
                    ->table('call_center.audit')
                    ->where('id_agent', $user->agent_id)
                    ->whereNotNull('id_break')
                    ->whereNull('datetime_end')
                    ->update(['crm_id' => $user->id]);

                $resultb = DB::connection('remote_connection')
                    ->table('call_center.break')
                    ->where('id', $request->get('id_break'))
                    ->first();
            } else {
                $ret = $this->remote->queue_pause('6789', $user->phone);
                $resultb = DB::connection('remote_connection')
                    ->table('call_center.break')
                    ->where('id', $request->get('id_break'))
                    ->first();
            }

            $user->phone_status_id = 2;
            $user->phone_status =  $resultb->name;
            $user->phone_status_icon = '<i class="fa-solid fa-xl fa-user-clock"></i>';
            $user->save();

            if ($ret == true) {
                return [
                    'success' => true,
                    'id' => $user->phone_status_id,
                    'message' => $user->phone_status,
                    'icon' => $user->phone_status_icon
                ];
            } else {
                return ['success' => false, 'message' => 'login error'];
            }
        } else {
            return ['error' => false, 'message' => 'error'];
        }
    }

    public function AgentUnBreak(Request $request)
    {

        $user = Auth::user();

        if ($user) {

            $ret = $this->issable->agent_unbreak($user->phone);

            $user->phone_status_id = 1;
            $user->phone_status = "พร้อมรับสาย";
            $user->phone_status_icon = '<i class="fa-solid fa-xl fa-user-check"></i>';
            $user->save();

            if ($ret == true) {
                return [
                    'success' => true,
                    'id' => $user->phone_status_id,
                    'message' => $user->phone_status,
                    'icon' => $user->phone_status_icon
                ];
            } else {
                return ['success' => false, 'message' => 'login error'];
            }
        } else {
            return ['error' => false, 'message' => 'error'];
        }
    }

    public function AgentRing(Request $request)
    {

        $user = Auth::user();

        if ($user) {
            //check if queue call send to popup record
            if ($request->input('context') == 'ext-queues') {
                DB::table('crm_incoming')
                    ->where('telno', $request->input('telno'))
                    ->where('agent_id', $user->id)
                    ->delete();
                DB::table('crm_incoming')->insert([
                    'agent_id' => $user->id,
                    'uniqid' => $request->input('uniqid'),
                    'context' => $request->input('context'),
                    'telno' => $request->input('telno'),
                    'agentno' => $request->input('agentno'),
                    'calltime' => date("Y-m-d H:i:s"),
                    'status' => 1
                ]);
                //outbound
            } elseif ($request->input('context') == 'macro-dialout-trunk') {
                $outbound = Project_job_number::where('call_number', $request->input('telno'))
                    ->where('dial_agent', $user->id)
                    ->orderByDesc('job_number_id')
                    ->first();
                if (!empty($outbound)) {
                    DB::table('crm_incoming')
                        ->where('telno', $request->input('telno'))
                        ->where('agent_id', $user->id)
                        ->delete();
                    DB::table('crm_incoming')->insert([
                        'agent_id' => $user->id,
                        'uniqid' => $request->input('uniqid'),
                        'context' => 'ext-queues',
                        'telno' => $request->input('telno'),
                        'agentno' => $user->phone,
                        'calltime' => date("Y-m-d H:i:s"),
                        'status' => 1
                    ]);

                    $outbound->update([
                        'cdr_uniqueid' => $request->input('uniqid'),
                        'dial_number' => $user->phone,
                        'call_status' => 1,
                        'call_date' => date("Y-m-d H:i:s"),
                    ]);
                }
            }


            $user->phone_status_id = 4;
            $user->phone_status = "กำลังรอสาย < " . $request->input('telno') . " >";
            $user->phone_status_icon = '<i class="fa-solid fa-bell fa-bounce" style=" --fa-bounce-start-scale-x: 1; --fa-bounce-start-scale-y: 1; --fa-bounce-jump-scale-x: 1; --fa-bounce-jump-scale-y: 1; --fa-bounce-land-scale-x: 1; --fa-bounce-land-scale-y: 1; "></i>';
            $user->save();
            return [
                'success' => true,
                'id' => $user->phone_status_id,
                'message' => $user->phone_status,
                'icon' => $user->phone_status_icon
            ];
        } else {
            return ['error' => false, 'message' => 'error'];
        }
    }

    public function AgentTalk(Request $request)
    {

        $user = Auth::user();

        if ($user) {

            DB::table('crm_incoming')
                ->where('uniqid', $request->input('uniqid'))
                ->update([
                    'agentno' => $request->input('agentno'),
                    'status' => 0
                ]);

            //outbound
            if ($request->input('context') == 'macro-dialout-trunk') {
                $outbound = Project_job_number::where('call_number', $request->input('telno'))
                    ->where('dial_agent', $user->id)
                    ->orderByDesc('job_number_id')
                    ->first();
                if (!empty($outbound)) {
                    $outbound->update([
                        'dial_status' => 1,
                    ]);
                }
            }

            $user->phone_status_id = 5;
            $user->phone_status = "กำลังสนทนากับ < " . $request->input('telno') . " >";
            $user->phone_status_icon = '<i class="fa-solid fa-phone-volume fa-bounce" style=" --fa-bounce-start-scale-x: 1; --fa-bounce-start-scale-y: 1; --fa-bounce-jump-scale-x: 1; --fa-bounce-jump-scale-y: 1; --fa-bounce-land-scale-x: 1; --fa-bounce-land-scale-y: 1; "></i>';
            $user->save();
            return [
                'success' => true,
                'id' => $user->phone_status_id,
                'message' => $user->phone_status,
                'icon' => $user->phone_status_icon
            ];
        } else {
            return ['error' => false, 'message' => 'error'];
        }
    }


    public function AgentSpy(Request $request)
    {

        $user = Auth::user();

        if ($user) {

            $user->phone_status_id = 5;
            $user->phone_status = "กำลัง " . $request->input('mode') . " < " . $request->input('telno') . " >";
            $user->phone_status_icon = '<i class="fa-solid fa-phone-volume fa-bounce" style=" --fa-bounce-start-scale-x: 1; --fa-bounce-start-scale-y: 1; --fa-bounce-jump-scale-x: 1; --fa-bounce-jump-scale-y: 1; --fa-bounce-land-scale-x: 1; --fa-bounce-land-scale-y: 1; "></i>';
            $user->save();
            return [
                'success' => true,
            ];
        } else {
            return ['error' => false, 'message' => 'error'];
        }
    }

    public function AgentHold(Request $request)
    {

        $user = Auth::user();

        if ($user) {

            $uniqid = $request->input('uniqid');

            if (DB::table('crm_incoming')->where('uniqid', $uniqid)->exists()) {
                DB::table('crm_incoming')
                    ->where('uniqid', $uniqid)
                    ->update([
                        'start_hold' => date("Y-m-d H:i:s"),
                    ]);

                return [
                    'success' => true,
                ];
            } else {
                return [
                    'success' => true, 'message' => 'Record not found'
                ];
            }
        } else {
            return ['error' => false, 'message' => 'error'];
        }
    }

    public function AgentUNHold(Request $request)
    {

        $user = Auth::user();

        if ($user) {

            $resultb =  DB::table('crm_incoming')
                ->where('uniqid', $request->input('uniqid'))
                ->first();
            if ($resultb) {
                $unhold = Carbon::now();
                $hold_start = Carbon::parse($resultb->start_hold);

                $duration = $resultb->holdtime + $hold_start->diffInSeconds($unhold);

                DB::table('crm_incoming')
                    ->where('uniqid', $request->input('uniqid'))
                    ->update([
                        'holdtime' => $duration,
                    ]);

                return [
                    'success' => true,
                ];
            } else {
                return [
                    'success' => true, 'message' => 'Record not found'
                ];
            }
        } else {
            return ['error' => false, 'message' => 'error'];
        }
    }

    public function AgentHang(Request $request)
    {
        $user = Auth::user();

        if ($user) {

            DB::table('crm_incoming')
                //->where('agentno', $request->input('extension'))
                ->where('agent_id', $user->id)
                ->where('status', 1)
                ->delete();

            $inqueue = DB::connection('remote_connection')
                ->table('call_center.audit')
                ->where('id_agent', $user->agent_id)
                ->whereNull('id_break')
                ->whereNull('datetime_end')
                ->whereNull('duration')
                ->get();
            if ($inqueue) {
                $inbreak = DB::connection('remote_connection')
                    ->table('call_center.audit')
                    ->where('id_agent', $user->agent_id)
                    ->whereNotNull('id_break')
                    ->whereNull('datetime_end')
                    ->get();
                if (count($inbreak) > 0) {
                    $resultb = DB::connection('remote_connection')
                        ->table('call_center.break')
                        ->where('id', $inbreak[0]->id_break)
                        ->first();

                    if ($inbreak[0]->id_break == $this->warp_id) {
                        $user->phone_status_id = 3;
                    } else {
                        $user->phone_status_id = 2;
                    }

                    $user->phone_status =  $resultb->name;
                    $user->phone_status_icon = '<i class="fa-solid fa-xl fa-user-clock"></i>';
                } else {
                    $user->phone_status_id = 1;
                    $user->phone_status = "พร้อมรับสาย";
                    $user->phone_status_icon = '<i class="fa-solid fa-xl fa-user-check"></i>';
                }
            } else {
                $user->phone_status_id = 0;
                $user->phone_status = "ไม่พร้อมรับสาย";
                $user->phone_status_icon = '<i class="fa-solid fa-xl fa-user-xmark"></i>';
                $user->logoff_time = Carbon::now();
            }

            $user->save();
            return [
                'success' => true,
                'id' => $user->phone_status_id,
                'message' => $user->phone_status,
                'icon' => $user->phone_status_icon
            ];
        } else {
            return ['error' => false, 'message' => 'error'];
        }
    }

    public function AgentWarp(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            /*  DB::table('crm_incoming')
            ->where('agentno', $user->phone)
            ->where('status', 1)
            ->delete(); */

            $uniqid = $request->input('uniqid');
            $exten = $request->input('exten');

            if (isset($uniqid) && $uniqid !== '') {
                $condition = ['uniqid', '=', $uniqid];
            } else {
                $condition = ['agentno', '=', $exten];
            }

            $context = DB::table('crm_incoming')
                ->where([$condition])
                ->orderBy('calltime', 'DESC')
                ->limit(1)
                ->first();


            if ($context !== null && $context->context == "ext-queues") {
                $indb = DB::connection('remote_connection')
                    ->table('call_center.wrap_data')
                    ->where('uniqid', $context->uniqid)
                    ->get();
                if (count($indb) == 0) {
                    $dataToInsert = [
                        'id_agent' => $user->agent_id,
                        'crm_id' => $user->id,
                        'phone' => $user->phone,
                        'uniqid' => $context->uniqid,
                        'wrap_start' => date("Y-m-d H:i:s"),
                    ];

                    $resulth = DB::table('crm_incoming')->where('uniqid', $context->uniqid)->first();
                    $hold_duration = $resulth ? $resulth->holdtime : 0;

                    DB::connection('remote_connection')->table('wrap_data')->insert($dataToInsert);
                    DB::connection('remote_connection')
                        ->table('call_center.call_entry')
                        ->where('uniqueid', $context->uniqid)
                        ->update([
                            'crm_id' => $user->id,
                            'duration_hold' => $hold_duration
                        ]);
                    DB::connection('remote_connection')
                        ->table('call_center.call_entry_today')
                        ->where('uniqueid', $context->uniqid)
                        ->update([
                            'crm_id' => $user->id,
                            'duration_hold' => $hold_duration
                        ]);

                    DB::connection('remote_connection')
                        ->table('call_center.call_recording')
                        ->where('uniqueid', $context->uniqid)
                        ->update([
                            'crm_id' => $user->id,
                        ]);

                    DB::connection('remote_connection')
                        ->table('asteriskcdrdb.cdr')
                        ->where('uniqueid', $context->uniqid)
                        ->update([
                            'dst_userfield' => $user->id,
                        ]);
                }

                $this->issable->agent_break($user->phone, $this->warp_id);
                DB::connection('remote_connection')
                    ->table('call_center.audit')
                    ->where('id_agent', $user->agent_id)
                    ->whereNotNull('id_break')
                    ->whereNull('datetime_end')
                    ->update(['crm_id' => $user->id]);

                $user->phone_status_id = 3;
                $user->phone_status =  'Wrap UP';
                $user->phone_status_icon = '<i class="fa-solid fa-xl fa-user-clock"></i>';
                $user->save();

                return [
                    'success' => true,
                    'id' => $user->phone_status_id,
                    'message' => $user->phone_status,
                    'icon' => $user->phone_status_icon
                ];
            } else {
                /* $user->phone_status_id = 1;
                $user->phone_status = "พร้อมรับสาย";
                $user->phone_status_icon = '<i class="fa-solid fa-xl fa-user-check"></i>';
                $user->save(); */
                //in not queue get status from pbx and db
                return [
                    'success' => true,
                    'id' => $user->phone_status_id,
                    'message' => $user->phone_status,
                    'icon' => $user->phone_status_icon
                ];
            }
        }
    }

    public function AgentUnWarp(Request $request)
    {

        $user = Auth::user();

        if ($user) {

            $resultb = DB::connection('remote_connection')
                ->table('call_center.wrap_data')
                ->where('id_agent', $user->agent_id)
                ->whereNull('wrap_end')
                ->first();

            $wrap_end = Carbon::now();
            $wrap_start = Carbon::parse($resultb->wrap_start);

            $duration = $wrap_start->diffInSeconds($wrap_end);

            /* $resulth = DB::table('crm_incoming')->where('uniqid', $request->get('uniqid'))->first();
            $hold_duration = $resulth ? $resulth->holdtime : 0; */

            DB::connection('remote_connection')
                ->table('call_center.wrap_data')
                ->where('id_agent', $user->agent_id)
                ->whereNull('wrap_end')
                ->update([
                    'wrap_end' => $wrap_end,
                    'duration' => $duration,
                ]);

            DB::connection('remote_connection')
                ->table('call_center.call_entry')
                ->where('uniqueid', $resultb->uniqid)
                ->update([
                    'crm_id' => $user->id,
                    //'duration_hold' => $hold_duration,
                    'duration_warp' => $duration
                ]);

            DB::connection('remote_connection')
                ->table('call_center.call_entry_today')
                ->where('uniqueid', $resultb->uniqid)
                ->update([
                    'crm_id' => $user->id,
                    //'duration_hold' => $hold_duration,
                    'duration_warp' => $duration
                ]);

            DB::connection('remote_connection')
                ->table('call_center.call_recording')
                ->where('uniqueid', $resultb->uniqid)
                ->update([
                    'crm_id' => $user->id,
                ]);

            /* DB::connection('remote_connection')
                ->table('call_center.call_recording')
                ->where('uniqueid', $resultb->uniqid)
                ->update([
                    'crm_id' => $user->id,
                ]); */



            $ret = $this->issable->agent_unbreak($user->phone);

            $user->phone_status_id = 1;
            $user->phone_status = "พร้อมรับสาย";
            $user->phone_status_icon = '<i class="fa-solid fa-xl fa-user-check"></i>';
            $user->save();

            if ($ret == true) {
                return [
                    'success' => true,
                    'id' => $user->phone_status_id,
                    'message' => $user->phone_status,
                    'icon' => $user->phone_status_icon
                ];
            } else {
                return ['success' => false, 'message' => 'login error'];
            }
        } else {
            return ['error' => false, 'message' => 'error'];
        }
    }


    public function TranferStatus(Request $request)
    {

        $user = Auth::user();

        if ($user) {
            $uniqid = $request->input('uniqid');
            $exten = $request->input('exten');

            if (isset($uniqid) && $uniqid !== '') {
                $condition = ['uniqid', '=', $uniqid];
            } else {
                $condition = ['agentno', '=', $user->phone];
            }

            $context = DB::table('crm_incoming')
                ->where([$condition])
                ->orderBy('calltime', 'DESC')
                ->limit(1)
                ->first();

            DB::connection('remote_connection')
                ->table('call_center.call_entry')
                ->where('uniqueid', $context->uniqid)
                ->update([
                    'transfer' => $exten,
                ]);
            DB::connection('remote_connection')
                ->table('call_center.call_entry_today')
                ->where('uniqueid', $context->uniqid)
                ->update([
                    'transfer' => $exten,
                ]);

            return [
                'success' => true,
            ];
        } else {
            return ['error' => false, 'message' => 'error'];
        }
    }



    public function AgentStatus()
    {

        $user = Auth::user();

        if ($user) {
            return [
                'success' => true,
                'id' => $user->phone_status_id,
                'message' => $user->phone_status,
                'icon' => $user->phone_status_icon
            ];
        } else {
            return ['error' => false, 'message' => 'error'];
        }
    }

    public function AgentKick(Request $request)
    {
        $loginTimeSession = Session::get('login_time');
        $user = Auth::user();

        if ($user && $loginTimeSession->format('Y-m-d H:i:s') !== $user->login_time) {
            Auth::logout();
            return 1;
        } else {
            return [
                'success' => true,
                'id' => $user->phone_status_id,
                'message' => $user->phone_status,
                'icon' => $user->phone_status_icon
            ];
        }
    }

    public function AgentPhoneUnregis(Request $request)
    {
        $user = Auth::user();

        if ($user) {

            $user->phone_status_id = -1;
            $user->phone_status = "โทรศัพท์ไม่พร้อมใช้งาน";
            $user->phone_status_icon = '<i class="fa-solid fa-xl fa-plug-circle-exclamation fa-bounce" style=" --fa-bounce-start-scale-x: 1; --fa-bounce-start-scale-y: 1; --fa-bounce-jump-scale-x: 1; --fa-bounce-jump-scale-y: 1; --fa-bounce-land-scale-x: 1; --fa-bounce-land-scale-y: 1;"></i>';
            $user->save();

            return [
                'success' => true,
                'id' => $user->phone_status_id,
                'message' => $user->phone_status,
                'icon' => $user->phone_status_icon
            ];
        } else {
            return ['error' => false, 'message' => 'error'];
        }
    }


    public function logoffAgentFromQueuebySup(Request $request)
    {
        $id = $request->get('id');
        $logout = $request->get('logout');
        $user = User::find($id);

        if ($user) {

            //check if not already logoff
            if ($user->phone_status_id !== 0) {
                $ret = $this->issable->agent_logoff($user->phone);

                $user->phone_status_id = 0;
                $user->phone_status = "ไม่พร้อมรับสาย";
                $user->phone_status_icon = '<i class="fa-solid fa-xl fa-user-xmark"></i>';
                $user->logoff_time = Carbon::now();
                if ($logout == 1) {
                    $user->agent_id = 0;
                    $user->phone = '';
                    $user->login_time = Carbon::now();
                }
                $user->save();

                if ($ret == true) {
                    return [
                        'success' => true,
                    ];
                } else {
                    return ['success' => false, 'message' => 'login error'];
                }
            } else {
                return ['success' => false, 'message' => 'logoff error'];
            }
        }
    }

    public function AgentBreakbySup(Request $request)
    {

        $id = $request->get('id');
        $user = User::find($id);

        if ($user) {

            $ret = $this->issable->agent_break($user->phone, $this->sup_break_id);

            DB::connection('remote_connection')
                ->table('call_center.audit')
                ->where('id_agent', $user->agent_id)
                ->whereNotNull('id_break')
                ->whereNull('datetime_end')
                ->update(['crm_id' => $user->id]);

            $resultb = DB::connection('remote_connection')
                ->table('call_center.break')
                ->where('id', $this->sup_break_id)
                ->first();

            $user->phone_status_id = 2;
            $user->phone_status =  $resultb->name;
            $user->phone_status_icon = '<i class="fa-solid fa-xl fa-user-clock"></i>';
            $user->save();

            if ($ret == true) {
                return [
                    'success' => true,
                ];
            } else {
                return ['success' => false, 'message' => 'login error'];
            }
        } else {
            return ['error' => false, 'message' => 'error'];
        }
    }

    public function AgentUnBreakbySup(Request $request)
    {

        $id = $request->get('id');
        $user = User::find($id);

        if ($user) {


            if ($user->phone_status == "Warp UP") {
                $resultb = DB::connection('remote_connection')
                    ->table('call_center.wrap_data')
                    ->where('id_agent', $user->agent_id)
                    ->whereNull('wrap_end')
                    ->first();

                $wrap_end = Carbon::now();
                $wrap_start = Carbon::parse($resultb->wrap_start);

                $duration = $wrap_start->diffInSeconds($wrap_end);

                DB::connection('remote_connection')
                    ->table('call_center.wrap_data')
                    ->where('id_agent', $user->agent_id)
                    ->whereNull('wrap_end')
                    ->update([
                        'wrap_end' => $wrap_end,
                        'duration' => $duration,
                    ]);

                DB::connection('remote_connection')
                    ->table('call_center.call_entry')
                    ->where('uniqueid', $resultb->uniqid)
                    ->update([
                        'crm_id' => $user->id,
                        //'duration_hold' => $hold_duration,
                        'duration_warp' => $duration
                    ]);

                DB::connection('remote_connection')
                    ->table('call_center.call_entry_today')
                    ->where('uniqueid', $resultb->uniqid)
                    ->update([
                        'crm_id' => $user->id,
                        //'duration_hold' => $hold_duration,
                        'duration_warp' => $duration
                    ]);
            }

            $ret = $this->issable->agent_unbreak($user->phone);
            $user->phone_status_id = 1;
            $user->phone_status = "พร้อมรับสาย";
            $user->phone_status_icon = '<i class="fa-solid fa-xl fa-user-check"></i>';
            $user->save();

            if ($ret == true) {
                return [
                    'success' => true,
                ];
            } else {
                return ['success' => false, 'message' => 'login error'];
            }
        } else {
            return ['error' => false, 'message' => 'error'];
        }
    }
}
