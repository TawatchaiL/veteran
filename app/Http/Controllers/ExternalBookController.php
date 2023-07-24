<?php

namespace App\Http\Controllers;

use App\Models\ExternalBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookRunningNumber;
use App\Models\Department;
use App\Models\Position;
use App\Models\Priority;
use App\Models\Contact;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ExternalBookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('permission:external-doc-list|external-doc-create|external-doc-edit|external-doc-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:external-doc-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:external-doc-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:external-doc-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            //sleep(2);

            $datas = ExternalBook::/* select(
                "positions.*",
                "departments.name as dname",
            )
            ->join("departments", "departments.id", "=", "positions.department_id") */orderBy("external_books.id", "desc")->get();

            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->id . '" >';
                })
                ->addColumn('action', function ($row) {
                    if (Gate::allows('external-doc-edit')) {
                        $html = '<button type="button" class="btn btn-sm btn-warning btn-edit" id="getEditData" data-id="' . $row->id . '"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    } else {
                        $html = '<button type="button" class="btn btn-sm btn-warning disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    }
                    if (Gate::allows('external-doc-delete')) {
                        $html .= '<button type="button" data-rowid="' . $row->id . '" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i> ลบ</button>';
                    } else {
                        $html .= '<button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-trash"></i> ลบ</button> ';
                    }
                    return $html;
                })->rawColumns(['checkbox', 'action'])->toJson();
        }

        $priorities = Priority::where([['status', '1']])
            ->orderBy("name", "asc")->get();
        $contacts = Contact::orderBy("name", "asc")->get();
        return view('external-docs.index')->with(['priorities' => $priorities])
            ->with(['contacts' => $contacts]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $rnumber = BookRunningNumber::pre_generate();
        return response()->json([
            'running' =>  $rnumber
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ExternalBook $externalBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExternalBook $externalBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExternalBook $externalBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExternalBook $externalBook)
    {
        //
    }
}
