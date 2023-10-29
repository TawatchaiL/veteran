<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Exception;

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

    function formatDuration($sec)
    {
        /*  $HH = '00'; $MM = '00'; $SS = '00';

		if($sec >= 3600){
			$HH = (int)($sec/3600);
			$sec = $sec%3600;
			if( $HH < 10 ) $HH = "0$HH";
		}

		if( $sec >= 60 ){
			$MM = (int)($sec/60);
			$sec = $sec%60;
			if( $MM < 10 ) $MM = "0$MM";
		}

		$SS = $sec;
		if( $SS < 10 ) $SS = "0$SS";

		return $HH.":".$MM.":".$SS.""; */
        $t = round($sec);
        return sprintf('%02d:%02d:%02d', ($t / 3600), ($t / 60 % 60), $t % 60);
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

    public function dashboard_avg_data(Request $request)
    {
        $queue = DB::connection('remote_connection')
            ->table('call_center.call_entry_today')
            ->select(
                'queue_number',
                DB::raw('AVG(duration) as avg_talk_time'),
                DB::raw('AVG(duration_wait) as avg_hold_time'),
                DB::raw('SUM(duration) as total_talk_time'),
                DB::raw('MAX(duration_wait) as max_hold_time')
            )
            ->where('queue_number', $request->get('queue'))
            ->groupBy('queue_number')
            ->get();


        $formattedQueue = [];

        foreach ($queue as $item) {
            $formattedItem = new \stdClass();
            $formattedItem->queue_number = $item->queue_number;
            $formattedItem->avg_talk_time = $this->formatDuration($item->avg_talk_time);
            $formattedItem->avg_hold_time = $this->formatDuration($item->avg_hold_time);
            $formattedItem->total_talk_time = $this->formatDuration($item->total_talk_time);
            $formattedItem->max_hold_time = $this->formatDuration($item->max_hold_time);

            $formattedQueue[] = $formattedItem;
        }

        return response()->json([
            'avg_data' => $formattedQueue,
        ]);
    }

    public function dashboard_sla_data(Request $request)
    {
        $sla = $request->get('sla');
        $queue = DB::connection('remote_connection')
            ->table('call_center.call_entry_today')
            ->select(
                'queue_number',
                DB::raw('(COUNT(*) / (SELECT COUNT(*) FROM call_entry_today)) * 100 AS percentage'),
            )
            ->where('duration_wait', '<=', $sla) // Use the <= operator
            ->where('queue_number', $request->get('queue'))
            ->groupBy('queue_number')
            ->get();


        $formattedQueue = $queue->map(function ($item) {
            $item->percentage = number_format($item->percentage, 2);
            return $item;
        });

        return response()->json([
            'sla_data' => $formattedQueue,
        ]);
    }

    public function getAgentList(Request $request)
    {
        $queue_names = DB::connection('remote_connection')
            ->table('asterisk.queues_config')
            ->select('extension', 'descr')
            ->get();

        $queue_name_array = [];

        foreach ($queue_names as $queue) {
            $queue_name_array[$queue->extension] = $queue->descr;
        }

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
                    $button = '<div class="btn-group">
                    <button type="button" class="btn btn-default">Action</button>
                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                    <a class="dropdown-item btn-pause" href="#" data-rowid="' . $agent->phone . '"><i class="fa-solid fa-user-clock"></i> พัก</a>
                    <a class="dropdown-item btn-unpause" href="#" data-rowid="' . $agent->phone . '"><i class="fa-solid fa-user-check"></i> รับสายต่อ</a>
                    <a class="dropdown-item btn-spy" href="#" data-rowid="' . $agent->phone . '"><i class="fa-solid fa-user-secret"></i> แทรกสาย</a>
                    <a class="dropdown-item btn-insert" href="#" data-rowid="' . $agent->phone . '"><i class="fa-solid fa-user-group"></i> ดักฟัง</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item btn-logoff" href="#" data-rowid="' . $agent->phone . '"><i class="fa-solid fa-user-xmark"></i> เตะออกจากระบบ</a>
                    </div>
                    </div>';
                }

                $html .= '<tr id="' . $div . '">
                    <td>' . $x . '<input type="hidden" id="' . $div . '_login" value="' . $agent->login_time . '">
                    <input type="hidden" id="' . $div . '_logoff" value="' . $agent->logoff_time . '">
                    </td>
                    <td><i class="fa-solid fa-user"></i> ' . $agent->name . '</td>
                    <td style="text-align: center;" id="' . $div . '_phone">' . $agent->phone . '</td>
                    <td id="' . $div . '_status"><i class="fa-solid fa-user-xmark status-icon offline"></i>
                        <font class="offline">ไม่พร้อมรับสาย</font>
                    </td>
                    <td style="text-align: center;" id="' . $div . '_duration">00:00:00</td>
                    <td style="text-align: center;" id="' . $div . '_src"></td>
                    <td style="text-align: center;" id="' . $div . '_queue"></td>
                    <td width="10%">' . $button . '</td>
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
            'queue_arr' => $queue_name_array,
            'agent_offline' => $agent_offline,
            'offline' => $offline
        ]);
    }
}
