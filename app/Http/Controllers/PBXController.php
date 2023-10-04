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



        return ['success' => true, 'message' => 'เข้าระบบรับสาย เรียบร้อยแล้ว'];
    }
}
