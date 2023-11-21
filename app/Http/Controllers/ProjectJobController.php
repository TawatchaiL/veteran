<?php

namespace App\Http\Controllers;

use App\Models\Project_job as ProjectJob;
use App\Models\Project_job_number as ProjectJobNumber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProjectJobController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('permission:outbound-list|outbound-create|outbound-edit|outbound-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:outbound-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:outbound-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:outbound-delete', ['only' => ['destroy']]);
    }



    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $agens = User::orderBy('name', 'asc')->get();
        $agentArray = [];

        $agentArray[0]['name'] = 'All';
        foreach ($agens as $agen) {
            $agentArray[$agen->id]['name'] = $agen->name;
        }


        if ($request->ajax()) {

            //$datas = ProjectJob::orderBy("job_id", "desc")->get();
            $datas = ProjectJob::select(
                'project_jobs.job_id as job_id',
                'project_jobs.job_code_id as job_code_id',
                'project_jobs.job_create_date as job_create_date',
                'project_jobs.job_admin as job_admin',
                'project_jobs.job_status as job_status',
                'project_jobs.job_file as jfile',
                DB::raw('SUM(CASE WHEN project_job_numbers.call_status = 1 THEN 1 ELSE 0 END) AS a_call'),
                DB::raw('SUM(CASE WHEN project_job_numbers.call_status = 0 THEN 1 ELSE 0 END) AS an_call'),
                DB::raw('SUM(CASE WHEN project_job_numbers.dial_status = 1 THEN 1 ELSE 0 END) AS call_success'),
                DB::raw('SUM(CASE WHEN project_job_numbers.dial_status = 2 OR project_job_numbers.dial_status = 3 OR project_job_numbers.dial_status = 4 OR project_job_numbers.dial_status = 0 THEN 1 ELSE 0 END) AS call_failed'),
            )
                ->join('project_job_numbers', 'project_jobs.job_id', '=', 'project_job_numbers.project_job_id')
                //->whereRaw($ssql)
                ->groupBy(
                    'project_jobs.job_id',
                    'project_jobs.job_code_id',
                    'project_jobs.job_create_date',
                    'project_jobs.job_admin',
                    'project_jobs.job_status',
                    'project_jobs.job_file'
                )
                ->orderByDesc('project_jobs.job_id')
                //->limit(200)
                ->get();

            $state_text = ['Stop', 'Start', 'Pause'];

            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->job_id . '" class="flat" name="table_records[]" value="' . $row->job_id . '" >';
                })
                ->editColumn('job_status', function ($row) use ($state_text) {
                    $state = $state_text[$row->job_status];
                    return $state;
                })
                ->editColumn('job_admin', function ($row) use ($agentArray) {
                    $state = $agentArray[$row->job_admin]['name'];
                    return $state;
                })
                ->editColumn('job_call', function ($row) {
                    return $row->a_call + $row->an_call . ' เบอร์';
                })
                ->editColumn('job_process', function ($row) {
                    $perp = 0; // Default value in case of division by zero

                    if ($row->a_call + $row->an_call != 0) {
                        $perp = ($row->a_call / ($row->a_call + $row->an_call)) * 100;
                    }
                    $progress = ' <div class="progress progress-sm active">
                    <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="' . $perp . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $perp . '%">
                    <span class="sr-only">' . $perp . '% Complete</span>
                    </div>
                    </div><small>' . $row->a_call . ' เบอร์ ' . $perp . '% Complete</small>';
                    return $progress;
                })
                ->addColumn('action', function ($row) {
                    if ($row->job_status == 0) {
                        $button_txt = "Start/Resume";
                    } else if ($row->job_status == 1) {
                        $button_txt = "Stop/Pause";
                    }
                    if (Gate::allows('outbound-edit')) {
                        $html = '<button type="button" class="btn btn-sm btn-warning btn-edit"  data-id="' . $row->job_id . '"><i class="fa fa-edit"></i> ' . $button_txt . '</button> ';
                    } else {
                        $html = '<button type="button" class="btn btn-sm btn-warning disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-edit"></i> Pause</button> ';
                    }
                    if (Gate::allows('outbound-delete')) {
                        $html .= '<button type="button" data-rowid="' . $row->job_id . '" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i> ลบรายการ</button>';
                    } else {
                        $html .= '<button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-trash"></i> ลบรายการ</button> ';
                    }
                    return $html;
                })
                ->addColumn('more', function ($row) {
                    return '';
                })
                ->rawColumns(['checkbox', 'job_process', 'action'])->toJson();
        }



        return view('outbound.index')->with(['agent' => $agens]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');
            $fileExtension = $file->getClientOriginalExtension();

            if ($fileExtension !== 'csv') {
                return response()->json(['errors' => ['กรุณาอัพโหลดไฟล์ CSV']]);
            }

            $realn = str_replace(" ", "", pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $remoteFilename = str_replace(" ", "_", $realn) . '.' . $fileExtension;

            $file->move(public_path('csv'), $remoteFilename);

            // Set file permissions
            //chmod(public_path("csv/$remoteFilename"), 0777);

            $NRow = ProjectJob::where('job_file', $realn)->count();

            //if ($NRow === 0) {
            $datea = date("YmdHis");
            $cdate = date("Y-m-d H:i:s");

            $user = Auth::user();

            $projectJob = new ProjectJob([
                'job_code_id' => $datea . '_' . $realn,
                'job_create_date' => $cdate,
                'job_file' => $realn,
                'job_admin' => $user->id,
                'job_status' => 0,
                'job_process' => 0,
            ]);

            $projectJob->save();

            $lastId = $projectJob->job_id;

            $objCSV = fopen(public_path("csv/$remoteFilename"), "r");

            $i = 0;
            $addzero = '';
            while (($objArr = fgetcsv($objCSV, 100000, ",")) !== false) {
                //dd($objArr[0]);
                if ($objArr[0]) {
                    if (strlen($objArr[0]) < 10) {
                        $addzero = '0';
                    }
                    $projectJobNumber = new ProjectJobNumber([
                        'create_date' => $cdate,
                        'call_number' => $addzero . $objArr[0],
                        'project_job_id' => $lastId,
                        'dial_agent' => $request->input('agent') !== 'undefined' ? $request->input('agent') : 0,
                    ]);

                    $projectJobNumber->save();

                    $i++;
                }
            }

            fclose($objCSV);
            //} 

            return response()->json(['success' => 'เพิ่มรายการ โทรออกเรียบร้อยแล้ว']);
        }

        return response()->json(['errors' => ['กรุณาอัพโหลดไฟล์']]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->get('id');
        $update = ProjectJob::find($id);

        if ($update->job_status == 0) {
            $status = 1;
        } elseif ($update->job_status == 1) {
            $status = 0;
        }

        $data = [
            'job_status' => $status
        ];


        $update->update($data);

        return response()->json(['success' => true, 'message' => 'แก้ไข สถานะรายการโทรออก เรียบร้อยแล้ว']);
    }

    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $data = ProjectJob::find($id);

        if ($data && $data->job_status == 0) {
            ProjectJobNumber::where('project_job_id', $data->job_id)->delete();
            $dataFilePath = public_path('csv/' . $data->job_file . '.csv');
            if (file_exists($dataFilePath)) {
                unlink($dataFilePath);
            }

            $data->delete();

            return ['success' => true, 'message' => 'ลบรายการ โทรออก เรียบร้อยแล้ว'];
        }

        return ['errors' => true, 'message' => 'ไม่สามารถลบรายการ โทรออก ได้'];
    }

    public function destroy_all(Request $request)
    {
        $arr_del = $request->get('table_records');

        foreach ($arr_del as $recordId) {
            $data = ProjectJob::find($recordId);

            if ($data && $data->job_status == 0) {
                ProjectJobNumber::where('project_job_id', $data->job_id)->delete();
                $dataFilePath = public_path('csv/' . $data->job_file . '.csv');
                if (file_exists($dataFilePath)) {
                    unlink($dataFilePath);
                }

                $data->delete();
            }
        }

        return redirect('/outbound')->with('success', 'ลบรายการ โทรออก เรียบร้อยแล้ว');
    }
}
