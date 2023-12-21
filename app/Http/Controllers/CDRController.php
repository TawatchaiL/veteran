<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;

class CDRController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('permission:agent-outbound|outbound-create|outbound-edit|outbound-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:outbound-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:outbound-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:outbound-delete', ['only' => ['destroy']]);
    }

    public function formatDuration($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $startDate = '';
            $endDate = '';
            if (!empty($request->get('sdate'))) {
                $dateRange = $request->input('sdate');
                if ($dateRange) {
                    $dateRangeArray = explode(' - ', $dateRange);

                    if (!empty($dateRangeArray) && count($dateRangeArray) == 2) {
                        $startDate = $dateRangeArray[0];
                        $endDate = $dateRangeArray[1];
                    }
                }
            }


            $searchtext = '';
            if (!empty($request->get('searchtext'))) {
                $searchtext = $request->input('searchtext');
            }

            $response = Http::withOptions(['verify' => false])->get('https://192.168.1.91/cdr-api.php', [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'caller_number' => $searchtext,
            ]);

            $datas = $response->json();

            //dd($datas);
            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row['uniqueid'] . '" class="flat" name="table_records[]" value="' . $row['uniqueid'] . '" >';
                })
                ->editColumn('billsec', function ($row) {
                    return $this->formatDuration($row['billsec']);
                })->rawColumns(['checkbox'])->toJson();
        }


        return view('pbxcdr.index');
    }
}
