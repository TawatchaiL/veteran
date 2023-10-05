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

    public function loginAgentToQueue()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        if ($user) {
            // Perform agent login action using IssableService
            $this->issable->agent_login($user->phone);

            // Update user's phone_status
            $user->phone_status_id = 1;
            $user->phone_status = "พร้อมรับสาย";
            $user->phone_status_icon = '<i class="fa-solid fa-lg fa-user-check"></i>';
            $user->save();

            return [
                'success' => true,
                'id' => $user->phone_status_id,
                'message' => $user->phone_status,
                'icon' => $user->phone_status_icon
            ];
        } else {
            return ['success' => false, 'message' => 'error'];
        }
    }

    public function logoffAgentFromQueue()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        if ($user) {
            // Perform agent login action using IssableService
            $this->issable->agent_logoff($user->phone);

            // Update user's phone_status
            $user->phone_status_id = 0;
            $user->phone_status = "ไม่พร้อมรับสาย";
            $user->phone_status_icon = '<i class="fa-solid fa-lg fa-user-xmark"></i>';
            $user->save();

            return [
                'success' => true,
                'id' => $user->phone_status_id,
                'message' => $user->phone_status,
                'icon' => $user->phone_status_icon
            ];
        } else {
            return ['success' => false, 'message' => 'error'];
        }
    }

    public function logoffAgentFromQueueAndLogout()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        if ($user) {
            // Perform agent login action using IssableService
            $this->issable->agent_logoff($user->phone);

            // Update user's phone_status
            $user->phone = '';
            $user->phone_status_id = 0;
            $user->phone_status = "ไม่พร้อมรับสาย";
            $user->phone_status_icon = '<i class="fa-solid fa-lg fa-user-xmark"></i>';
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
            $break = $this->issable->agent_break($user->phone, $request->get('id_break'));
            dd($request);

            // Update user's phone_status
            $user->phone_status_id = 2;
            $user->phone_status = "พักเบรค";
            $user->phone_status_icon = '<i class="fa-solid fa-lg fa-user-clock"></i>';
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

    public function AgentUnBreak(Request $request)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        if ($user) {
            // Perform agent login action using IssableService
            $this->issable->agent_unbreak($user->phone);

            // Update user's phone_status
            $user->phone_status_id = 1;
            $user->phone_status = "พร้อมรับสาย";
            $user->phone_status_icon = '<i class="fa-solid fa-lg fa-user-check"></i>';
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
