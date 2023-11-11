<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CrmCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/* use Carbon\Carbon;
use DateInterval;
use DateTime;
use Exception; */

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
                DB::raw('MAX(duration_wait) as max_hold_time'),
                DB::raw('(SELECT sum(score) FROM agent_score_today WHERE queue = ' . $request->get('queue') . ') as total_score')
            )
            ->where('queue_number', $request->get('queue'))
            ->groupBy('queue_number')
            ->get();


        $formattedQueue = [];

        foreach ($queue as $item) {
            $formattedItem = new \stdClass();
            $formattedItem->queue_number = $item->queue_number;
            $formattedItem->total_score = $item->total_score;
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

    public function dashboard_agent_avg_data()
    {
        $user = Auth::user();
        $queue = DB::connection('remote_connection')
            ->table('call_center.call_entry_today')
            ->select(
                DB::raw('count(*) as total_call'),
                DB::raw('AVG(duration) as avg_talk_time'),
                DB::raw('AVG(duration_wait) as avg_hold_time'),
                DB::raw('SUM(duration) as total_talk_time'),
                DB::raw('MAX(duration_wait) as max_hold_time'),
                DB::raw('(SELECT sum(score) FROM agent_score_today WHERE crm_id = ' . $user->id . ') as total_score')
            )
            ->where('crm_id', $user->id)
            ->get();


        $formattedQueue = [];

        foreach ($queue as $item) {
            $formattedItem = new \stdClass();
            $formattedItem->total_call = $item->total_call;
            $formattedItem->total_score = $item->total_score;
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
                DB::raw('(COUNT(*) / (SELECT COUNT(*) FROM call_entry_today where queue_number = ' . $request->get('queue') . ')) * 100 AS percentage'),
            )
            ->where('duration_wait', '<=', $sla) // Use the <= operator
            //->where('queue_number', $request->get('queue'))
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


    public function dashboard_agent_call_by_hour()
    {
        $user = Auth::user();
        $allHours = range(0, 23);

        $results =  DB::connection('remote_connection')
            ->table('call_center.call_entry_today')
            ->select(
                DB::raw('HOUR(datetime_init) as hour'),
                DB::raw('COUNT(*) as count')
            )
            ->where('crm_id', $user->id)
            ->groupBy('hour')
            ->get();


        $hourCounts = [];
        foreach ($results as $result) {
            $hourCounts[$result->hour] = $result->count;
        }


        foreach ($allHours as $hour) {
            if (!isset($hourCounts[$hour])) {
                $hourCounts[$hour] = 0;
            }
        }

        ksort($hourCounts);

        return response()->json([
            'hour_data' => $hourCounts,
        ]);
    }

    public function dashboard_agent_call_survey()
    {
        $user = Auth::user();

        $results = DB::connection('remote_connection')
            ->table('agent_score_today')
            ->select(
                'score',
                DB::raw('COUNT(*) as count')
            )
            ->where('crm_id', $user->id)
            ->groupBy('score')
            ->get();

        $scoreCounts = $results->pluck('count', 'score')->all();

        // Check if $scoreCounts is not empty before finding the max score
        if (!empty($scoreCounts)) {
            $maxScore = max(array_keys($scoreCounts));
        } else {
            // Handle the case where $scoreCounts is empty
            $maxScore = 0; // or any default value you prefer
        }

        $allscore = range(1, $maxScore);

        $scoreCounts = [];
        foreach ($results as $result) {
            $scoreCounts[$result->score] = $result->count;
        }

        foreach ($allscore as $score) {
            if (!isset($scoreCounts[$score])) {
                $scoreCounts[$score] = 0;
            }
        }

        ksort($scoreCounts);

        return response()->json([
            'score_data' => $scoreCounts,
        ]);
    }


    public function dashboard_agent_call_by_date()
    {
        $user = Auth::user();
        $currentMonth = now()->startOfMonth();
        $lastDayOfMonth = now()->endOfMonth();
        $dateCounts = [];

        $results = DB::connection('remote_connection')
            ->table('call_center.call_entry')
            ->select(
                DB::raw('DAY(datetime_init) as day'),
                DB::raw('COUNT(*) as count')
            )
            ->where('crm_id', $user->id)
            ->whereDate('datetime_init', '>=', $currentMonth)
            ->whereDate('datetime_init', '<=', $lastDayOfMonth)
            ->groupBy('day')
            ->get();

        foreach ($results as $result) {
            $dateCounts[$result->day] = $result->count;
        }

        // Create an array with days from 1 to 31
        $allDays = range(1, $lastDayOfMonth->day);

        // Fill in missing days with a count of 0
        foreach ($allDays as $day) {
            if (!isset($dateCounts[$day])) {
                $dateCounts[$day] = 0;
            }
        }

        ksort($dateCounts);

        return response()->json([
            'date_data' => $dateCounts,
        ]);
    }

    public function dashboard_agent_case_by_date()
    {
        $user = Auth::user();
        $currentMonth = now()->startOfMonth();
        $lastDayOfMonth = now()->endOfMonth();
        $dateCounts = [];

        $results = CrmCase::select(
            DB::raw('DAY(created_at) as day'),
            DB::raw('COUNT(*) as total_count'),
            DB::raw('SUM(CASE
            WHEN tranferstatus = "รับสาย" OR tranferstatus = "ไม่รับสาย" OR tranferstatus = "สายไม่ว่าง"
            THEN 1
            ELSE 0
            END) as transferstatus_count')
        )
            ->where('agent', $user->id)
            ->whereDate('created_at', '>=', $currentMonth)
            ->whereDate('created_at', '<=', $lastDayOfMonth)
            ->groupBy('day')
            ->get();

        foreach ($results as $result) {
            $dateCounts[$result->day]['all'] = $result->total_count;
            $dateCounts[$result->day]['tranfer'] = $result->transferstatus_count;
        }

        // Create an array with days from 1 to 31
        $allDays = range(1, $lastDayOfMonth->day);

        // Fill in missing days with a count of 0
        foreach ($allDays as $day) {
            if (!isset($dateCounts[$day])) {
                $dateCounts[$day] = ['all' => 0, 'tranfer' => 0];
            }
        }

        ksort($dateCounts);

        return response()->json([
            'date_data' => $dateCounts,
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
        $agent_arr = [];
        $agent_offline = [];
        $offline = 0;
        if (!$agents->isEmpty()) {
            foreach ($agents as $agent) {
                //$agentName = $agent_name_array[$agent->agent_id] ?? 'Unknown';
                if ($agent->phone_status_id == 0) {
                    $agent_offline[] = $agent->id;
                    $offline++;
                    $div = $agent->id;
                    $button = '<div class="btn-group">
                    <button type="button" class="btn btn-default" disabled>Action</button>
                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                    <span class="sr-only">Toggle Dropdown</span>
                    </button></div>';
                } else {
                    $div = $agent->phone;
                    $button = '<div class="btn-group">
                    <button type="button" class="btn btn-default">Action</button>
                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                    <button class="btn dropdown-item btn-pause"  data-id="' . $agent->id . '"><i class="fa-solid fa-user-clock"></i> พัก</button>
                    <button class="btn dropdown-item btn-unpause"  data-id="' . $agent->id . '"><i class="fa-solid fa-user-check"></i> รับสายต่อ</button>
                    <button class="btn dropdown-item btn-spy"  data-id="' . $agent->phone . '"><i class="fa-solid fa-user-secret"></i> ดักฟัง</button>
                    <button class="btn dropdown-item btn-whis"  data-id="' . $agent->phone . '"><i class="fa-solid fa-user-group"></i> กระซิบ</button>
                    <button class="btn dropdown-item btn-barge"  data-id="' . $agent->phone . '"><i class="fa-solid fa-users"></i> แทรกสาย</button>
                    <button class="btn dropdown-item btn-logoff"  data-id="' . $agent->id . '"><i class="fa-solid fa-user-xmark"></i> ออกจากระบบรับสาย</button>
                    <div class="dropdown-divider"></div>
                    <button class="btn dropdown-item btn-logout"  data-id="' . $agent->id . '"><i class="fa-solid fa-power-off"></i> เตะออกจากระบบ</button>
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
