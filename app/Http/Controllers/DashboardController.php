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
        $agent_names = DB::connection('remote_connection')
            ->table('call_center.agent')
            ->select('id', 'name')
            ->get();

        $agent_name_array = [];

        foreach ($agent_names as $agent) {
            $agent_name_array[$agent->id] = $agent->name;
        }

        $agents = User::where('queue', 'LIKE', '%' . $request->get('queue') . '%')
            ->orderBy('id', 'asc')
            ->get();

        $html = ''; // Initialize an empty string to store the HTML

        $x = 1;
        if (!$agents->isEmpty()) {
            foreach ($agents as $agent) {
                // Assuming you have access to the relevant agent data like $agent_name_array

                $agentName = $agent_name_array[$agent->agent_id] ?? 'Unknown'; // Replace 'Unknown' with a default value if needed

                $html .= '<tr id="' . $agentName . '">
                    <td>' . $x . '</td>
                    <td>' . $agent->phone . '</td>
                    <td><i class="fa-solid fa-user"></i> ' . $agent->name . '</td>
                    <td><i class="fas fa-power-off status-icon offline"></i>
                        <font class="offline">Offline</font>
                    </td>
                    <td></td>
                    <td>00:00:00</td>
                    <td></td>
                    <td><img src="' . asset('images/pauseagent.gif') . '"><img src="' . asset('images/logout-icon.png') . '"></td>
                </tr>';
                $x++;
            }
        }
    }
}
