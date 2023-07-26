<?php

namespace App\Http\Controllers;

use App\Models\ExternalBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookRunningNumber;
use App\Models\Department;
use App\Models\FileUpload;
use App\Models\FileStore;
use App\Models\Position;
use App\Models\Priority;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Bootstrap\BootProviders;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

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

            $datas = ExternalBook::select(
                "external_books.id as id",
                "external_books.doc_receive_number as doc_receive_number",
                "external_books.subject as subject",
                "external_books.signdate as signdate",
                "contacts.name as cname",
                "users.name as uname",
                "priorities.name as priorities",

            )
                ->join("contacts", "contacts.id", "=", "external_books.doc_from")
                ->join("users", "users.id", "=", "external_books.doc_receive")
                ->join("priorities", "priorities.id", "=", "external_books.priorities_id")
                ->orderBy("external_books.id", "desc")->get();

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
        $department = Department::where([['status', '1']])
            ->orderBy("name", "asc")->get();
        return view('external-docs.index')->with(['priorities' => $priorities])
            ->with(['departments' => $department])
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
        $validator =  Validator::make($request->all(), [
            //'doc_receive_number' => 'required|string|max:255|unique:external_books',
            'priorities_id' => 'required',
            'doc_number' => 'required|string|max:255',
            'signdate' => 'required|string|max:255',
            'doc_to' => 'required|string|max:255',
            'doc_from' => 'required',
            'subject' => 'required|string|max:255',
            'doc_receive' => 'required',
            /* 'img.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:10240' */
        ], [
            //'doc_receive_number.required' => 'เลขที่ทะเบียนรับต้องไม่เป็นค่าว่าง!',
            'priorities_id.required' => 'ระดับชั้นความเร็วของหนังสือต้องไม่เป็นค่าว่าง!',
            'doc_number.required' => 'หนังสือเลขที่ต้องไม่เป็นค่าว่าง!',
            'doc_to.required' => 'ถึงต้องไม่เป็นค่าว่าง!',
            'doc_from.required' => 'จากต้องไม่เป็นค่าว่าง!',
            'subject.required' => 'เรื่องต้องไม่เป็นค่าว่าง!',
            'doc_receive.required' => 'ผู้รับต้องไม่เป็นค่าว่าง!',
            'signdate.required' => 'ต้องไม่เป็นค่าว่าง!',
            /* 'img.required' => 'กรุณาอัพโหลดไฟล์',
            //'img.array' => 'หลักฐานการชำระเงินต้องเป็นอาเรย์',
            'img.*.nullable' => 'กรุณาเลือกไฟล์ภาพหรือ PDF',
            'img.*.image' => 'กรุณาเลือกไฟล์ภาพที่ถูกต้อง (jpeg, png, jpg, gif)',
            'img.*.mimes' => 'สกุลไฟล์ที่ยอมรับคือ jpeg, png, jpg, gif, pdf',
            'img.*.max' => 'ขนาดไฟล์ภาพหรือ PDF ต้องไม่เกิน 10MB', */

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $input = $request->all();
        $input['doc_receive_number'] = BookRunningNumber::generate();
        //dd($input);
        $ex = ExternalBook::create($input);

        //file att

        $filesa = $request->get('img');

        foreach ($filesa as $filea) {
            //echo $filea;
            $oldfile = FileUpload::where('oldname', $filea)->get();
            $filestore = new FileStore();
            $filestore->module = 'external-book';
            $filestore->module_id = $ex->id;
            $filestore->filename = $oldfile[0]->filename;
            $filestore->save();

            File::move(public_path() . '/file_upload/' . $oldfile[0]->filename, public_path() . '/file_store/' . $oldfile[0]->filename);
            FileUpload::where('filename', $oldfile[0]->filename)->delete();
        }



        return response()->json(['success' => 'ลงรับหนังสือ เรียบร้อยแล้ว']);
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
    public function edit($id)
    {
        $data = ExternalBook::find($id);

        $user = User::where([['id', $data->doc_receive]])->get();
        $select_list_receive = '<option value="' . $user[0]->id . '" > ' . $user[0]->name . '</option>';

        $img = $this->getfileatt($id);

        return response()->json(['data' => $data, 'select_list_receive' => $select_list_receive, 'imgs' => $img]);
    }

    public function getfileatt($id)
    {
        $filestore = FileStore::where([['module', 'external-book']])
            ->where([['module_id', $id]])
            ->orderBy("id", "asc")->get();

        $img = "";
        if (!$filestore->isEmpty()) {
            foreach ($filestore as $pics) {
                $imgf = url('/') . '/file_store/' . $pics->filename;

                $fileInfo = pathinfo($imgf);
                $fileType = $fileInfo['extension'];
                if ($fileType == "pdf") {
                    $preview = url('/') . '/images/pdf.jpg';
                } else {
                    $preview = urldecode($imgf);
                }

                $img .= "<div id='img_" . $pics->id . "' class='col-md-4 text-center mb-3'><img src=\"" . $preview . "\" height=\"150\"><br>
                <a class='btn btn-sm btn-info btn-view' href=\"" . urldecode($imgf) . "\" target=\"blank\"><i class='fa fa-search'></i> เปิดดู</a>
                <a href='#' class='btn btn-sm btn-danger btn-edit' id='getDeleteData' data-id2='" . $pics->id . "' data-id='" . $id . "'><i class='fa fa-trash'></i> ลบ</a>
                </div>
                <br><br>";
            }
        } else {
            $img = "";
        }

        return $img;
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'priorities_id' => 'required',
            'doc_number' => 'required|string|max:255',
            'signdate' => 'required|string|max:255',
            'doc_to' => 'required|string|max:255',
            'doc_from' => 'required',
            'subject' => 'required|string|max:255',
            'doc_receive' => 'required',
        ];


        $validator =  Validator::make($request->all(), $rules,[
            //'doc_receive_number.required' => 'เลขที่ทะเบียนรับต้องไม่เป็นค่าว่าง!',
            'priorities_id.required' => 'ระดับชั้นความเร็วของหนังสือต้องไม่เป็นค่าว่าง!',
            'doc_number.required' => 'หนังสือเลขที่ต้องไม่เป็นค่าว่าง!',
            'doc_to.required' => 'ถึงต้องไม่เป็นค่าว่าง!',
            'doc_from.required' => 'จากต้องไม่เป็นค่าว่าง!',
            'subject.required' => 'เรื่องต้องไม่เป็นค่าว่าง!',
            'doc_receive.required' => 'ผู้รับต้องไม่เป็นค่าว่าง!',
            'signdate.required' => 'ต้องไม่เป็นค่าว่าง!',
            /* 'img.required' => 'กรุณาอัพโหลดไฟล์',
            //'img.array' => 'หลักฐานการชำระเงินต้องเป็นอาเรย์',
            'img.*.nullable' => 'กรุณาเลือกไฟล์ภาพหรือ PDF',
            'img.*.image' => 'กรุณาเลือกไฟล์ภาพที่ถูกต้อง (jpeg, png, jpg, gif)',
            'img.*.mimes' => 'สกุลไฟล์ที่ยอมรับคือ jpeg, png, jpg, gif, pdf',
            'img.*.max' => 'ขนาดไฟล์ภาพหรือ PDF ต้องไม่เกิน 10MB', */

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $data = [
            'priorities_id' => $request->get('priorities_id'),
            'doc_receive_number' => $request->get('doc_receive_number'),
            'doc_number' => $request->get('doc_number'),
            'doc_to' => $request->get('doc_to'),
            'signdate' => $request->get('signdate'),
            'doc_from' => $request->get('doc_from'),
            'subject' => $request->get('subject'),
            'doc_receive' => $request->get('doc_receive'),
        ];

        $expen = ExternalBook::find($id);
        $expen->update($data);


        //file att

        $filesa = $request->get('img');

        if (!empty($filesa)) {
            foreach ($filesa as $filea) {
                //echo $filea;
                $oldfile = FileUpload::where('oldname', $filea)->get();
                $filestore = new FileStore();
                $filestore->module = 'external-book';
                $filestore->module_id = $id;
                $filestore->filename = $oldfile[0]->filename;
                $filestore->save();

                File::move(public_path() . '/file_upload/' . $oldfile[0]->filename, public_path() . '/file_store/' . $oldfile[0]->filename);
                FileUpload::where('filename', $oldfile[0]->filename)->delete();
            }
        }



        return response()->json(['success' => 'แก้ไขข้อมูล ลงรับหนังสือ เรียบร้อยแล้ว']);
    }

    public function deleteImg($id, $id2)
    {
        $dataimg = FileStore::find($id2)->delete();;

        $html = $this->getfileatt($id);

        return response()->json(['imgs' => $html]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        ExternalBook::find($id)->delete();

        $dataimg = FileStore::where([
            'module_id' => $id,
            'module' => 'external-book',
        ])->get();

        // Delete the found records
        if (!$dataimg->isEmpty()) {
            $dataimg->each(function ($item) {
                $filename = $item->filename;

                // Build the full path to the file within the 'public/file_store' directory
                $filePath = public_path('file_store/' . $filename);

                // Delete the file if it exists
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $item->delete();
            });
        }

        return ['success' => true, 'message' => 'ลบ หนังสือ เรียบร้อยแล้ว'];
    }

    public function destroy_all(Request $request)
    {

        $arr_del  = $request->get('table_records'); //$arr_ans is Array MacAddress

        for ($xx = 0; $xx < count($arr_del); $xx++) {
            ExternalBook::find($arr_del[$xx])->delete();
            $dataimg = FileStore::where([
                'module_id' => $arr_del[$xx],
                'module' => 'external-book',
            ])->get();

            // Delete the found records
            if (!$dataimg->isEmpty()) {
                $dataimg->each(function ($item) {
                    $filename = $item->filename;

                    // Build the full path to the file within the 'public/file_store' directory
                    $filePath = public_path('file_store/' . $filename);

                    // Delete the file if it exists
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                    $item->delete();
                });
            }
        }

        return redirect('/external-docs')->with('success', 'ลบ หนังสือ  เรียบร้อยแล้ว');
    }
}
