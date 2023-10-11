<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Services\AsteriskAmiService;
use App\Services\IssableService;

class PBXController extends Controller
{
    protected $remote;
    protected $issable;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AsteriskAmiService $asteriskAmiService, IssableService $issableService)
    {
        $this->remote = $asteriskAmiService;
        $this->issable = $issableService;
    }

    public function call_tranfer(Request $request)
    {
        // Retrieve the authenticated user

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
        // Retrieve the authenticated user
        $user = Auth::user();

        if ($user) {
            // Perform agent login action using IssableService
            $ret = $this->issable->agent_login($user->phone);

            // Update user's phone_status
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
            return ['success' => false, 'message' => 'login error'];
        }
    }

    public function logoffAgentFromQueue()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        if ($user) {
            // Perform agent login action using IssableService
            $ret = $this->issable->agent_logoff($user->phone);

            // Update user's phone_status
            $user->phone_status_id = 0;
            $user->phone_status = "ไม่พร้อมรับสาย";
            $user->phone_status_icon = '<i class="fa-solid fa-xl fa-user-xmark"></i>';
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
            return ['success' => false, 'message' => 'logoff error'];
        }
    }

    public function logoffAgentFromQueueAndLogout()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        if ($user) {
            // Perform agent login action using IssableService
            $ret = $this->issable->agent_logoff($user->phone);

            // Update user's phone_status
            $user->phone = '';
            $user->phone_status_id = 0;
            $user->phone_status = "ไม่พร้อมรับสาย";
            $user->phone_status_icon = '<i class="fa-solid fa-xl fa-user-xmark"></i>';
            $user->save();

            DB::connection('remote_connection')
                ->table('call_center.agent')
                ->where('id', $user->agent_id)
                ->update(['number' => 0]);

            Auth::logout();
        } else {
            return ['error' => false, 'message' => 'error'];
        }
    }


    public function AgentBreak(Request $request)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        if ($user) {
            // Perform agent login action using IssableService
            $ret = $this->issable->agent_break($user->phone, $request->get('id_break'));

            // Update user's phone_status

            $resultb = DB::connection('remote_connection')
                ->table('call_center.break')
                ->where('id', $request->get('id_break'))
                ->first();

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
        // Retrieve the authenticated user
        $user = Auth::user();

        if ($user) {
            // Perform agent login action using IssableService
            $ret = $this->issable->agent_unbreak($user->phone);

            // Update user's phone_status
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
        // Retrieve the authenticated user
        $user = Auth::user();

        if ($user) {
            // Update user's phone_status
            if ($request->input('context') == 'ext-queues') {
                DB::table('crm_incoming')
                    ->where('telno', $request->input('telno'))
                    ->where('agentno', $request->input('agentno'))
                    ->delete();
                DB::table('crm_incoming')->insert([
                    'uniqid' => $request->input('uniqid'),
                    'telno' => $request->input('telno'),
                    'agentno' => $request->input('agentno'),
                    'calltime' => date("Y-m-d H:i:s"),
                    'status' => 1
                ]);
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
        // Retrieve the authenticated user
        $user = Auth::user();

        if ($user) {
            // Update user's phone_status

            DB::table('crm_incoming')
                ->where('uniqid', $request->input('uniqid'))
                ->update([
                    'status' => 0
                ]);

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

    public function AgentHang(Request $request)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        if ($user) {

            DB::table('crm_incoming')
                ->where('agentno', $request->input('extension'))
                ->where('status', 1)
                ->delete();

            $inqueue = DB::connection('remote_connection')
                ->table('call_center.audit')
                ->where('id_agent', $user->agent_id)
                ->whereNull('datetime_end')
                ->get();
            if (count($inqueue) > 0) {
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
                        ->first(); // Use first() instead of get() to get a single object

                    $user->phone_status_id = 2;
                    $user->phone_status =  $resultb->name; // Use object notation
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

    public function AgentStatus(Request $request)
    {
        // Retrieve the authenticated user
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
}
