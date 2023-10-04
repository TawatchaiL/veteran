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
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AsteriskAmiService $asteriskAmiService, IssableService $issableService)
    {
        $this->remote = $asteriskAmiService;
        $this->issable = $issableService;
        $this->user = Auth::user();
    }

    public function loginAgentToQueue() {

        // Perform agent login action using IssableService
        $this->issable->agent_login($this->user->phone);

        // Update user's phone_status
        $this->user->phone_status = "Ready";
        $this->user->save();

        return ['success' => true, 'message' => 'เข้าระบบรับสาย เรียบร้อยแล้ว'];
    }

    public function logoffAgentFromQueue()
    {
        // Perform agent login action using IssableService
        $this->issable->agent_login($this->user->phone);

        // Update user's phone_status
        $this->user->phone_status = "Not Ready";
        $this->user->save();

        return ['success' => true, 'message' => 'ออกจากระบบรับสาย เรียบร้อยแล้ว'];
    }
}
