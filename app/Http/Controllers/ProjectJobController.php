<?php

namespace App\Http\Controllers;

use App\Models\Project_job as ProjectJob;
use App\Models\Project_job_number as ProjectJobNumber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


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

            $datas = ProjectJob::orderBy("job_id", "desc")->get();
            $state_text = ['Stop', 'Start', 'Pause'];

            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->job_id . '" >';
                })
                ->editColumn('job_status', function ($row) use ($state_text) {
                    $state = $state_text[$row->job_status];
                    return $state;
                })
                ->editColumn('job_admin', function ($row) use ($agentArray) {
                    $state = $agentArray[$row->job_admin]['name'];
                    return $state;
                })
                ->editColumn('job_process', function ($row) {
                    $progress = ' <div class="progress progress-sm active">
                    <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="' . $row->job_process . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $row->export_progress . '%">
                    <span class="sr-only">' . $row->job_process . '% Complete</span>
                    </div>
                    </div><small>' . $row->job_process . '% Complete</small>';
                    return $progress;
                })
                ->addColumn('action', function ($row) {
                    if (Gate::allows('outbound-delete')) {
                        $html = '<button type="button" data-rowid="' . $row->job_id . '" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i> ลบรายการ</button>';
                    } else {
                        $html = '<button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-trash"></i> ลบรายการ</button> ';
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
                'job_code_id' => $datea,
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
     * Display the specified resource.
     */
    public function show(Project_job $project_job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project_job $project_job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project_job $project_job)
    {
        //
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
