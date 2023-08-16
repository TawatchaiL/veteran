<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Department;
use App\Models\studentRunningNumber;
use App\Models\term;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('permission:contact-list|contact-create|contact-edit|contact-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:contact-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:contact-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:contact-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            //sleep(2);

            $datas = Contact::where('ctype', 0)
                ->orderBy("id", "desc")->get();
            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->id . '" >';
                })
                ->addColumn('action', function ($row) {
                    if (Gate::allows('contact-edit')) {
                        $html = '<button type="button" class="btn btn-sm btn-warning btn-edit" id="getEditData" data-id="' . $row->id . '"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    } else {
                        $html = '<button type="button" class="btn btn-sm btn-warning disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    }
                    if (Gate::allows('contact-delete')) {
                        $html .= '<button type="button" data-rowid="' . $row->id . '" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i> ลบ</button>';
                    } else {
                        $html .= '<button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-trash"></i> ลบ</button> ';
                    }
                    return $html;
                })->rawColumns(['checkbox', 'action'])->toJson();
        }

        $centre = Department::where([['status', '1']])
            ->orderBy("name", "asc")->get();
       /*  $term = term::where([['status', '1']])
            ->orderBy("name", "asc")->get(); */
            //dd($term);

        return view('contacts.index')->with(['centre' => $centre])
           /*  ->with(['term' => $term]) */;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$rnumber = studentRunningNumber::pre_generate(Auth::user()->department->code);
        //dd($rnumber);
        /* return response()->json([
            'running' =>  $rnumber
        ]); */
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator =  Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:contacts',
            //'postcode' => 'int|max:10',
            /* 'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
            'postcode' => 'required|string|max:10',
            'telephone' => 'required|string|max:20',*/
        ], [
            'name.required' => 'ชื่อนักเรียนต้องไม่เป็นค่าว่าง!',
            'name.unique' => 'ชื่อนักเรียนนี้มีอยู่แล้วในฐานข้อมูล!',
            /*  'status.required' => 'กรุณาเลือกสถานะ!', */
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $input = $request->all();
        $contact = Contact::create($input);
        $select_list_contact = '<option value="' . $contact->id . '" > ' . $contact->name . '</option>';
        return response()->json(['success' => 'เพิ่ม รายชื่อนักเรียน เรียบร้อยแล้ว', 'contact' => $select_list_contact, 'cid' => $contact->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = Contact::find($id);
        return response()->json(['data' => $data]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string|max:255|unique:contacts,name,' . $id,
            //'postcode' => 'integer|max:10',

        ];


        $validator =  Validator::make($request->all(), $rules, [
            'name.required' => 'ชื่อนักเรียนต้องไม่เป็นค่าว่าง!',
            'name.unique' => 'ชื่อนักเรียนนี้มีอยู่แล้วในฐานข้อมูล!',
            'status.required' => 'กรุณาเลือกสถานะ!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $contactd = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'postcode' => $request->get('postcode'),
            'telephone' => $request->get('telephone'),
        ];

        $contact = Contact::find($id);
        $contact->update($contactd);

        return response()->json(['success' => 'แก้ไข นักเรียน เรียบร้อยแล้ว']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        Contact::find($id)->delete();
        return ['success' => true, 'message' => 'ลบ นักเรียน เรียบร้อยแล้ว'];
    }

    public function destroy_all(Request $request)
    {

        $arr_del  = $request->get('table_records'); //$arr_ans is Array MacAddress

        for ($xx = 0; $xx < count($arr_del); $xx++) {
            Contact::find($arr_del[$xx])->delete();
        }

        return redirect('/contacts')->with('success', 'ลบ นักเรียน เรียบร้อยแล้ว');
    }
}
