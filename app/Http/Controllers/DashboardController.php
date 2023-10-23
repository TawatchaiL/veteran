<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sidebarc = "sidebar-collapse";
        $queue = DB::connection('remote_connection')->table('asterisk.queues_config')->get();
        return view('dashboard.index')->with(['sidebarc' => $sidebarc])
            ->with(['queue' => $queue]);
    }


    public function getAgentList(Request $request)
    {
        $agents = DB::connection('mysql')
            ->table('users')
            ->join('remote_connection.call_center.agent', 'users.agent_id', '=', 'agent.id')
            ->select('users.*', 'callcenter.agent.*') // Use the table alias 'callcenter.agent' to avoid column name conflicts
            ->where('users.queue', 'LIKE', '%' . $request->get('queue') . '%')
            ->get();

        // Now, $agents contains the result of the join across local and remote databases.
        dd($agents);

        if (!$agents->isEmpty()) {
            foreach ($agents as $agent) {
                // Process the $agent data as needed
            }
        }
    }
}
