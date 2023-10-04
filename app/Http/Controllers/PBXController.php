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
            $user->phone_status = "Ready";
            $user->save();

            return ['success' => true, 'message' => 'เข้าระบบรับสาย เรียบร้อยแล้ว'];
        } else {
            return ['error' => false, 'message' => 'error'];
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
            $user->phone_status = "Not Ready";
            $user->save();

            return ['success' => true, 'message' => 'ออกจากระบบรับสาย เรียบร้อยแล้ว'];
        } else {
            return ['error' => false, 'message' => 'error'];
        }
    }
}
