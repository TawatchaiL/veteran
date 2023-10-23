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
        $agent_name = DB::connection('remote_connection')->table('call_center.agent')->select('id', 'name')->get();
        $agent_name_array[$agent_name->id] = $agent_name->name;
        $agents = User::where('queue', 'LIKE', '%' . $request->get('queue') . '%')->get();

        if (!$agents->isEmpty()) {
            foreach ($agents as $agent) {
               dd($agent_name_array[$agent->agent_id]);
            }
        }
    }
}
