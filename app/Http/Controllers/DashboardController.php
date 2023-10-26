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

        $html = '';

        $x = 1;
        $offline = 0;
        if (!$agents->isEmpty()) {
            foreach ($agents as $agent) {
                //$agentName = $agent_name_array[$agent->agent_id] ?? 'Unknown';
                if ($agent->phone_status_id == 0) {
                    $agent_offline[] = $agent->id;
                    $offline++;
                    $div = $agent->id;
                } else {
                    $div = $agent->phone;
                }

                $html .= '<tr id="' . $div . '">
                    <td>' . $x . '<input type="hidden" id="' . $div . '_login" value="' . $agent->login_time . '">
                    <input type="hidden" id="' . $div . '_logoff" value="' . $agent->logoff_time . '">
                    </td>
                    <td><i class="fa-solid fa-user"></i> ' . $agent->name . '</td>
                    <td style="text-align: center;" id="' . $div . '_phone">' . $div . '</td>
                    <td id="' . $div . '_status"><i class="fa-solid fa-user-xmark status-icon offline"></i>
                        <font class="offline">ไม่พร้อมรับสาย</font>
                    </td>
                    <td style="text-align: center;" id="' . $div . '_duration">00:00:00</td>
                    <td style="text-align: center;" id="' . $div . '_src"></td>
                    <td style="text-align: center;" id="' . $div . '_queue"></td>
                    <td><img src="' . asset('images/pauseagent.gif') . '"><img src="' . asset('images/logout-icon.png') . '"></td>
                </tr>';
                $x++;

                if ($agent->phone) {
                    $agent_arr[] = $agent->phone;
                }
            }
        }
        return response()->json([
            'html' => $html,
            'agent_arr' => $agent_arr,
            'agent_offline' => $agent_offline,
            'offline' => $offline
        ]);
    }
}
