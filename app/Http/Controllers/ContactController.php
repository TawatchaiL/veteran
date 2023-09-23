<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CrmContact;
use App\Models\CrmPhoneEmergency;
use App\Models\Department;
use App\Models\studentRunningNumber;
use App\Models\term;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
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

            $datas = CrmContact::orderBy("id", "desc")->get();

            //$numberOfRows = 50; // Change this to the desired number of rows
            //$simulatedDatas = [];

            //$thaiNames = ['สมชาย', 'สมหญิง', 'วิชัย', 'วิไล', 'จริงใจ', 'เปรมชัย', 'สุดใจ', 'นฤมล', 'กมลชนก', 'ศุภัทรา', 'กิจวรรณ', 'อรวรรณ', 'ธนพงศ์', 'ประทุม', 'วิทยา', 'พรชัย'];
            //$thaiLastNames = ['ใจดี', 'เสมอ', 'รักชาติ', 'พร้อม', 'ชำนาญ', 'มีเสน่ห์', 'สุขใจ', 'เรียบง่าย', 'สุดหล่อ', 'หวานใจ', 'เก่ง', 'สนุก', 'ร่ำรวย', 'สายเครื่อง', 'ยอดมาก', 'คง', 'ละเอียด'];


            //for ($i = 1; $i <= $numberOfRows; $i++) {
            //    $hn = str_pad($i, 6, '0', STR_PAD_LEFT);
             //   $fullName = $thaiNames[array_rand($thaiNames)] . ' ' . $thaiLastNames[array_rand($thaiLastNames)];
             //   $createDate = now()->subDays(rand(1, 365))->subHours(rand(0, 23))->subMinutes(rand(0, 59));


             //   $simulatedDatas[] = (object) [
            //        'id' => $i,
            //        'code' => $hn,
             //       'telephone' => '055' . rand(100000, 999999),
            //        'mobile' => '08' . rand(10000000, 99999999),
            //        'name' => $fullName,
            //        'create_at' => $createDate->format('Y-m-d H:i:s'),
                    // Simulate other fields as needed
            //    ];
           //}

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
                })
                ->addColumn('more', function ($row) {
                    return '';
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

    public function popup_content(Request $request)
    {
        $con = $request->get('cardId');
        $contact_name = "";
        $contact_lname = "";
        if ($con == "0877777777") {
            $contact_name = "กิจวรรณ";
            $contact_lname = "ละเอียด";
        }
        $case_type = Case_type::orderBy("id", "asc")->get();
        $template = 'contacts.contact-create';
        $htmlContent = View::make($template, [
            'telephone' => $con, 'contact_name' => $contact_name, 'contact_lname' => $contact_lname, 'casetype' => $case_type
        ])->render();
        return response()->json([
            'html' =>  $htmlContent,
        ]);
    }

    public function popup()
    {

        $html = '<div class="card card-danger custom-bottom-right-card d-none d-md-block" data-id="0804190099" id="0804190099">
        <div class="card-header">
        <h4 class="card-title"> <i class="fa-solid fa-triangle-exclamation fa-beat" style="--fa-beat-scale: 1.5;"></i> 0804190099 (ผู้ติดต่อใหม่)</h4>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                <i class="fas fa-expand"></i>
            </button>

            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
        </div>
        <div class="card-body card-content pop_content" id="pop_0804190099">
        <!-- Card content goes here -->
        </div>
        <div class="card-footer text-muted bclose">
        <button type="button" class="btn btn-success bopen" data-card-widget="maximize"><i class="fa-solid fa-up-right-from-square"></i> เปิด</button>
        </div>
        </div>
        <div class="card card-danger custom-bottom-right-card d-none d-md-block" data-id="0822846414" id="0822846414">
        <div class="card-header">
        <h3 class="card-title"> <i class="fa-solid fa-triangle-exclamation fa-beat" style="--fa-beat-scale: 1.5;"></i> 0822846414 (ผู้ติดต่อใหม่)</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                <i class="fas fa-expand"></i>
            </button>

            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
        </div>
        <div class="card-body card-content pop_content" id="pop_0822846414">
        <!-- Card content goes here -->
        </div>
        <div class="card-footer text-muted bclose">
        <button type="button" class="btn btn-success bopen" data-card-widget="maximize"><i class="fa-solid fa-up-right-from-square"></i> เปิด</button>
        </div>
        </div>
        <div class="card card-danger custom-bottom-right-card d-none d-md-block" data-id="0877777777" id="0877777777">
        <div class="card-header">
        <h3 class="card-title"> <i class="fa-solid fa-triangle-exclamation fa-beat" style="--fa-beat-scale: 1.5;"></i> 0877777777 (ผู้ติดต่อในระบบ)</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                <i class="fas fa-expand"></i>
            </button>

            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
        </div>
        <div class="card-body card-content pop_content" id="pop_0877777777">
        <!-- Card content goes here -->
        </div>
        <div class="card-footer text-muted bclose">
        <button type="button" class="btn btn-success bopen" data-card-widget="maximize"><i class="fa-solid fa-up-right-from-square"></i> เปิด</button>
        </div>
        </div>';
        return response()->json([
            'html' =>  $html
        ]);
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
            'hn' => 'required|string|max:255',
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'homeno' => 'required|string|max:255',
            'moo' => 'required|string|max:255',
            'soi' => 'required|string|max:255',
            'road' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'subdistrict' => 'required|string|max:255',
            'telhome' => 'required|string|max:255',
            'phoneno' => 'required|string|max:255',
            'workno' => 'required|string|max:255',
        ], [
            'hn.required' => 'กรุณากรอกรหัสผู้ติดต่อ',
            'fname.required' => 'กรุณากรอกชื่อ',
            'lname.required' => 'กรุณากรอกนามสกุล',
            'homeno.required' => 'กรุณากรอกบ้านเลขที่',
            'moo.required' => 'กรุณากรอกหมู่',
            'soi.required' => 'กรุณากรอกซอย',
            'road.required' => 'กรุณากรอกถนน',
            'city.required' => 'กรุณาเลือกจังหวัด',
            'district.required' => 'กรุณาเลือกอำเภอ',
            'subdistrict.required' => 'กรุณาเลือกตำบล',
            'telhome.required' => 'กรุณากรอกเบอร์โทรศัพท์บ้าน',
            'phoneno.required' => 'กรุณากรอกเบอร์โทรศัทพ์มือถือ',
            'workno.required' => 'กรุณากรอกเบอร์ทีทำงาน',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        
        $input = $request->all();
        $contact = CrmContact::create($input);
        $insertedId = $contact->id;
    foreach ($request->emergencyData as $edata) {
        //$test = $edata['emergencyname'];

        $Crmemergency = new CrmPhoneEmergency();
        $Crmemergency->contact_id = $insertedId;
        $Crmemergency->emergencyname = $edata['emergencyname'];
        $Crmemergency->emerrelation = $edata['emerrelation'];
        $Crmemergency->emerphone = $edata['emerphone'];
        $Crmemergency->save();

    }
        return response()->json(['success' => 'เพิ่ม รายผู้ติดต่อ เรียบร้อยแล้ว']);
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

        $datac = CrmContact::find($id);
        //$data = CrmPhoneEmergency::find($id);
        $emer = DB::table('crm_phone_emergencies')
        ->whereRaw('contact_id = '.$id.'')
        ->get();
        $data = [
            'datac' => $datac,
            'emer' => $emer,
        ];
        return response()->json(['datax' => $data]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       //$rules = [
       //     'name' => 'required|string|max:255|unique:contacts,name,' . $id,
       //     //'postcode' => 'integer|max:10',

        //];


       // $validator =  Validator::make($request->all(), $rules, [
       //     'name.required' => 'ชื่อนักเรียนต้องไม่เป็นค่าว่าง!',
       //     'name.unique' => 'ชื่อนักเรียนนี้มีอยู่แล้วในฐานข้อมูล!',
       //     'status.required' => 'กรุณาเลือกสถานะ!',
       // ]);

       // if ($validator->fails()) {
       //     return response()->json(['errors' => $validator->errors()->all()]);
       // }

        $contactd = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'postcode' => $request->get('postcode'),
            'telephone' => $request->get('telephone'),
        ];

        $contact = Contact::find($id);
        $contact->update($contactd);

        return response()->json(['success' => 'แก้ไข ผู้ติดต่อ เรียบร้อยแล้ว']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        CrmContact::find($id)->delete();
        return ['success' => true, 'message' => 'ลบ ผู้ติดต่อ เรียบร้อยแล้ว'];
    }

    public function destroy_all(Request $request)
    {

        $arr_del  = $request->get('table_records'); //$arr_ans is Array MacAddress

        for ($xx = 0; $xx < count($arr_del); $xx++) {
            CrmContact::find($arr_del[$xx])->delete();
        }

        return redirect('/contacts')->with('success', 'ลบ ผู้ติดต่อ เรียบร้อยแล้ว');
    }
}
