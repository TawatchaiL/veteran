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

            $datas = ProjectJob::orderBy("id", "desc")->get();
            $state_text = ['All', 'รอคิว', 'กำลังทำงาน', 'Export เสร็จแล้ว'];
            $ctype_text = ['All', 'สายเข้า', 'โทรออก', 'ภายใน'];

            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->id . '" >';
                })
                ->addColumn('export_date', function ($row) {
                    $export_date = $row->export_start . " - " . $row->export_end;
                    return $export_date;
                })
                ->editColumn('export_src', function ($row) {
                    if ($row->export_src !== '' && $row->export_src !== NULL) {
                        return $row->export_src;
                    }
                    return 'All';
                })
                ->editColumn('export_dst', function ($row) use ($agentArray) {
                    if ($row->export_dst !== '' && $row->export_dst !== NULL) {
                        return $agentArray[$row->export_dst]['name'];
                    }
                    return 'All';
                })
                ->editColumn('export_ctype', function ($row) use ($ctype_text) {
                    if ($row->export_ctype !== '' && $row->export_ctype !== NULL) {
                        return $ctype_text[$row->export_ctype];
                    }
                    return 'All';
                })
                ->editColumn('status', function ($row) use ($state_text) {
                    $state = $state_text[$row->export_status];
                    return $state;
                })
                ->editColumn('export_progress', function ($row) {
                    $progress = ' <div class="progress progress-sm active">
                    <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="' . $row->export_progress . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $row->export_progress . '%">
                    <span class="sr-only">' . $row->export_progress . '% Complete</span>
                    </div>
                    </div><small>' . $row->export_progress . '% Complete</small>';
                    return $progress;
                })
                ->addColumn('action', function ($row) {
                    if (Gate::allows('voice-export-download')) {
                        if ($row->export_status == 3) {
                            $html = '<button type="button" class="btn btn-sm btn-warning btn-download" id="getEditData" data-id="' . $row->export_filename . '"><i class="fa fa-download"></i> Download</button> ';
                        } else {
                            $html = '<button type="button" class="btn btn-sm btn-warning disabled" data-toggle="tooltip" data-placement="bottom" title="ยัง Export ไม่เสร็จ"><i class="fa fa-download"></i> Download</button> ';
                        }
                    } else {
                        $html = '<button type="button" class="btn btn-sm btn-warning disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-download"></i> Download</button> ';
                    }
                    if (Gate::allows('voice-export-delete')) {
                        if ($row->export_status == 3) {
                            $html .= '<button type="button" data-rowid="' . $row->id . '" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i> ลบรายการ</button>';
                        } else {
                            $html .= '<button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="bottom" title="ยัง Export ไม่เสร็จ"><i class="fa fa-trash"></i> ลบรายการ</button> ';
                        }
                    } else {
                        $html .= '<button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-trash"></i> ลบรายการ</button> ';
                    }
                    return $html;
                })
                ->addColumn('more', function ($row) {
                    return '';
                })
                ->rawColumns(['checkbox', 'export_progress', 'action'])->toJson();
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
        if ($request->hasFile('job_file')) {
            $file = $request->file('job_file');
            $fileExtension = $file->getClientOriginalExtension();

            if ($fileExtension !== 'csv') {
                return "กรุณาอัพโหลดไฟล์ CSV";
            }

            $realn = str_replace(" ", "", pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $remoteFilename = str_replace(" ", "_", $realn) . '.' . $fileExtension;

            $file->move(public_path('csv'), $remoteFilename);

            // Set file permissions
            chmod(public_path("csv/$remoteFilename"), 0777);

            $NRow = ProjectJob::where('job_file', $realn)->count();

            if ($NRow === 0) {
                $datea = date("YmdHis");
                $cdate = date("Y-m-d H:i:s");

                $user = Auth::user();

                $projectJob = new ProjectJob([
                    'job_project_id' => $request->input('project_id'),
                    'job_code_id' => $datea,
                    'job_create_date' => $cdate,
                    'job_file' => $realn,
                    'job_admin' => $user->id,
                    'job_status' => 1,
                ]);

                $projectJob->save();

                $lastId = $projectJob->id;

                $objCSV = fopen(public_path("csv/$remoteFilename"), "r");

                $i = 0;
                while (($objArr = fgetcsv($objCSV, 100000, ",")) !== false) {
                    if (is_numeric($objArr[0])) {
                        $projectJobNumber = new ProjectJobNumber([
                            'create_date' => $cdate,
                            'call_number' => $objArr[0],
                            'project_job_id' => $lastId,
                            'dial_agent' => '',
                        ]);

                        $projectJobNumber->save();

                        $i++;
                    }
                }

                fclose($objCSV);
            }

            return "File uploaded successfully";
        }

        return "No file uploaded";
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project_job $project_job)
    {
        //
    }
}
