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
    public function __construct(AsteriskAmiService $asteriskAmiService) // Inject AsteriskAmiService
    {
        $this->middleware('guest')->except('logout');
        $this->remote = $asteriskAmiService; // Initialize $remote
        $this->issable = new IssableService();
    }

    public function agent_login()
    {
        $user = Auth::user();
        $this->issable->agent_login($user->phone);

        $user->phone_status = "Ready";
        $user->save();

        DB::connection('remote_connection')
            ->table('call_center.agent')
            ->where('id', $user->agent_id)
            ->update(['number' => $user->phone]);

        return 'success';
    }
}
