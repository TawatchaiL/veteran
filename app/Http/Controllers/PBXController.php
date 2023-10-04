<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Services\AsteriskAmiService;
use App\Services\IssableService;

use App\Models\User;

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
        $this->middleware('guest')->except('logout');
        $this->remote = $asteriskAmiService;
        $this->issable = $issableService;
    }

    public function loginAgentToQueue()
    {
        $user = Auth::user();

        // Perform agent login action using IssableService
        $this->issable->agent_login($user->phone);

        // Update user's phone_status
        $user->phone_status = "Ready";
        $user->save();

        // Update 'number' in the 'call_center.agent' table
        DB::connection('remote_connection')
            ->table('call_center.agent')
            ->where('id', $user->agent_id)
            ->update(['number' => $user->phone]);

        return ['success' => true, 'message' => 'เข้าระบบรับสาย เรียบร้อยแล้ว'];
    }
}
