<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CrmContact;
use App\Models\CrmPhoneEmergency;
use App\Models\Department;
use App\Models\Case_type;
use App\Models\CrmCase;
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

            if ($request->input('seachtype') === "0") {
                $datas = DB::table('crm_contacts')->whereRaw('adddate between "' . $startDate . '" and "' . $endDate . '"')
                    ->get();
            } else if ($request->input('seachtype') === "1") {
                $datas = DB::table('crm_contacts')
                    ->join('crm_phone_emergencies', 'crm_contacts.id', '=', 'crm_phone_emergencies.contact_id')
                    ->where('emerphone', '=', $request->input('seachtext'))
                    ->whereRaw('adddate between "' . $startDate . '" and "' . $endDate . '"')
                    ->get();
            } else if ($request->input('seachtype') === "2") {
                $datas = DB::table('crm_contacts')->where('telhome', '=', $request->input('seachtext'))
                    ->whereRaw('adddate between "' . $startDate . '" and "' . $endDate . '"')
                    //->whereBetween('adddate', [$startDate, $endDate])
                    ->get();
            } else if ($request->input('seachtype') === "3") {
                $datas = DB::table('crm_contacts')->where('phoneno', '=', $request->input('seachtext'))
                    ->whereRaw('adddate between "' . $startDate . '" and "' . $endDate . '"')
                    ->get();
            } else if ($request->input('seachtype') === "4") {
                $datas = DB::table('crm_contacts')->where('workno', '=', $request->input('seachtext'))
                    ->whereRaw('adddate between "' . $startDate . '" and "' . $endDate . '"')
                    ->get();
            } else if ($request->input('seachtype') === "5") {
                $datas = DB::table('crm_contacts')->where('hn', 'like', '%' . $request->input('seachtext') . '%')
                    ->whereRaw('adddate between "' . $startDate . '" and "' . $endDate . '"')
                    ->get();
            } else if ($request->input('seachtype') === "6") {
                $datas = DB::table('crm_contacts')->where('fname', 'like', '%' . $request->input('seachtext') . '%')
                    ->whereRaw('adddate between "' . $startDate . '" and "' . $endDate . '"')
                    ->get();
            }

            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->id . '" >';
                })
                ->editColumn('fname', function ($row) {
                    return $row->fname . ' ' . $row->lname;
                })
                ->addColumn('action', function ($row) {
                    if (Gate::allows('contact-edit')) {
                        $html = '<button type="button" class="btn btn-sm btn-success btn-success" id="getCases" data-id="' . $row->id . '"><i class="fa fa-edit"></i> เรื่องที่ติดต่อ</button> ';
                    } else {
                        $html = '<button type="button" class="btn btn-sm btn-success disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    }
                    if (Gate::allows('contact-edit')) {
                        $html .= '<button type="button" class="btn btn-sm btn-warning btn-edit" id="getEditData" data-id="' . $row->id . '"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    } else {
                        $html .= '<button type="button" class="btn btn-sm btn-warning disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-edit"></i> แก้ไข</button> ';
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
        $datap = DB::table('crm_contacts')
            ->where('phoneno', '=', $con)
            ->orWhere('telhome', '=', $con)
            ->orWhere('workno', '=', $con)
            ->get();
        $case_type = Case_type::orderBy("id", "asc")->get();
        $template = 'contacts.contact-create';
        $htmlContent = View::make($template, [
            'cardid' => $con, 'telephone' => $con, 'contact_name' => $contact_name, 'contact_lname' => $contact_lname, 'casetype' => $case_type
        ])->render();
        return response()->json([
            'html' =>  $htmlContent,
        ]);
    }

    public function popup()
    {
        $user = Auth::user();
        $datac = DB::table('crm_incoming')
            ->where('agentno', '=', $user->phone)
            ->orWhere('status', '=', "0")
            ->orWhere('status', '=', "1")
            ->orderBy('id', 'desc')
            ->get();
        $html = '';
        $tab_link = '';
        $tab_content = '';
        $i = 1;
        foreach ($datac as $item) {
            $datap = DB::table('crm_contacts')
                ->where('phoneno', '=', $item->telno)
                ->orWhere('telhome', '=', $item->telno)
                ->orWhere('workno', '=', $item->telno)
                ->count();
            if ($datap > 0) {
                $statusText = "(ผู้ติดต่อที่เคยบันทึกข้อมูลไว้แล้ว)";
            } else {
                $statusText = "(ผู้ติดต่อใหม่)&nbsp;&nbsp;&nbsp;";
            }
            /* style="width: 300px; height: 150px;"  */

            if ($i == 1) {
                $tab_link_active = 'active';
                $tab_content_active = 'show active';
                $tab_active = 'card-danger';
                $active_id = $item->telno;
            } else {
                $tab_link_active = '';
                $tab_content_active = '';
                $tab_active = 'card-secondary';
            }

            $html = '<div class="col-md-12">
            <div class=" pop_content" id="pop_' . $item->telno . '">
            ' . $statusText . '
            </div></div>';
            $tab_link .= '<li class="nav-item">
            <a class="popup-tab-font-size nav-link ' . $tab_link_active . '" id="custom-tabs-pop-' . $item->telno . '-tab" data-toggle="pill" data-id="' . $item->telno . '"
                href="#custom-tabs-pop-' . $item->telno . '" role="tab" aria-controls="custom-tabs-pop-' . $item->telno . '"
                aria-selected="false">' . $item->telno . '</a>
            </li>';
            $tab_content .= '<div class="tab-pane fade ' . $tab_content_active . '" id="custom-tabs-pop-' . $item->telno . '" role="tabpanel"
            aria-labelledby="custom-tabs-pop-' . $item->telno . '-tab">
            <div class="row" id="dpopup_' . $item->telno . '">
            ' . $html . '
            </div>
        </div>';
            $i++;
        }

        return response()->json([
            'tab_link' => $tab_link,
            'tab_content' => $tab_content,
            'active_id' => $active_id
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
    public function store(Request $request)
    {
        //
        $valifield = [
            'hn' => 'required|string|max:10',
            'fname' => 'required|string|max:50',
            'lname' => 'required|string|max:50',
            'homeno' => 'required|string|max:10',
            'city' => 'required|string|max:8',
            'district' => 'required|string|max:8',
            'subdistrict' => 'required|string|max:8',
        ];
        $valimess = [
            'hn.required' => 'กรุณากรอกรหัสผู้ติดต่อ',
            'fname.required' => 'กรุณากรอกชื่อ',
            'lname.required' => 'กรุณากรอกนามสกุล',
            'homeno.required' => 'กรุณากรอกบ้านเลขที่',
            'city.required' => 'กรุณาเลือกจังหวัด',
            'district.required' => 'กรุณาเลือกอำเภอ',
            'subdistrict.required' => 'กรุณาเลือกตำบล',
        ];
        if ($request->input('telhome') == "" && $request->input('phoneno') == "" && $request->input('workno') == "") {
            $valifield = array_merge($valifield, ['telhome' => 'required|string|max:25']);
            $valimess = array_merge($valimess, ['telhome.required' => 'กรุณากรอกเบอร์โทรศัพท์บ้าน หรือ เบอร์โทรศัทพ์มือถือ หรือ เบอร์โทรศัพท์ทีทำงาน']);
        }
        if (!empty($request->emergencyData)) {
            foreach ($request->emergencyData as $edata) {
                if ($edata['emergencyname'] == "" || $edata['emerrelation'] == "" || $edata['emerphone'] == "") {
                    $valifield = array_merge($valifield, ['checkemer' => 'required|string|max:50']);
                    $valimess = array_merge($valimess, ['checkemer.required' => 'กรุณาตรวจสอบข้อมูล ชื่อบุคคลที่ติดต่อได้ในกรณีฉุกเฉิน']);
                    break;
                }
            }
        }
        $validator =  Validator::make($request->all(), $valifield, $valimess);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $input = $request->all();
        $contact = CrmContact::create($input);
        $insertedId = $contact->id;
        if (!empty($request->emergencyData)) {
            foreach ($request->emergencyData as $edata) {
                $Crmemergency = new CrmPhoneEmergency();
                $Crmemergency->contact_id = $insertedId;
                $Crmemergency->emergencyname = $edata['emergencyname'];
                $Crmemergency->emerrelation = $edata['emerrelation'];
                $Crmemergency->emerphone = $edata['emerphone'];
                $Crmemergency->save();
            }
        }
        //DB::table('crm_phone_emergencies')->insert([
        //    ['contact_id' => $insertedId, 'emergencyname' => '1', 'emerrelation' => '2', 'emerphone' => '3'],
        //    ['contact_id' => $insertedId, 'emergencyname' => '4', 'emerrelation' => '5', 'emerphone' => '6'],
        //]);
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
            ->whereRaw('contact_id = ' . $id . '')
            ->get();
        $data = [
            'datac' => $datac,
            'emer' => $emer,
        ];
        return response()->json(['datax' => $data]);
    }

    public function incoming(Request $request)
    {
        DB::table('crm_incoming')->insert([
            'telno' => $request->input('telno'),
            'agentno' => $request->input('agentno'),
            'calltime' => date("Y-m-d H:i:s"),
            'status' => 0
        ]);
        return response()->json(['success' => 'บันทักข้อมูลเรียบร้อยแล้ว']);
    }

    public function popupedit($telnop)
    {
        //$datac = CrmContact::find('20');
        $datac = DB::table('crm_contacts')
            ->where('phoneno', '=', $telnop)
            ->orWhere('telhome', '=', $telnop)
            ->orWhere('workno', '=', $telnop)
            ->get();
        //$data = CrmPhoneEmergency::find($id);
        $emer = DB::table('crm_phone_emergencies')
            //->whereRaw('contact_id = 20')
            ->where('contact_id', '=', $datac['0']->id)
            ->get();

        $data = [
            'datac' => $datac['0'],
            'emer' => $emer,
        ];
        return response()->json(['datax' => $data]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $valifield = [
            'fname' => 'required|string|max:50',
            'lname' => 'required|string|max:50',
            'homeno' => 'required|string|max:10',
            'city' => 'required|string|max:8',
            'district' => 'required|string|max:8',
            'subdistrict' => 'required|string|max:8',
        ];
        $valimess = [
            'fname.required' => 'กรุณากรอกชื่อ',
            'lname.required' => 'กรุณากรอกนามสกุล',
            'homeno.required' => 'กรุณากรอกบ้านเลขที่',
            'city.required' => 'กรุณาเลือกจังหวัด',
            'district.required' => 'กรุณาเลือกอำเภอ',
            'subdistrict.required' => 'กรุณาเลือกตำบล',
        ];
        if ($request->input('telhome') == "" && $request->input('phoneno') == "" && $request->input('workno') == "") {
            $valifield = array_merge($valifield, ['telhome' => 'required|string|max:25']);
            $valimess = array_merge($valimess, ['telhome.required' => 'กรุณากรอกเบอร์โทรศัพท์บ้าน หรือ เบอร์โทรศัทพ์มือถือ หรือ เบอร์โทรศัพท์ทีทำงาน']);
        }
        if (!empty($request->eemergencyData)) {
            foreach ($request->eemergencyData as $edata) {
                if ($edata['emergencyname'] == "" || $edata['emerrelation'] == "" || $edata['emerphone'] == "") {
                    $valifield = array_merge($valifield, ['checkemer' => 'required|string|max:50']);
                    $valimess = array_merge($valimess, ['checkemer.required' => 'กรุณาตรวจสอบข้อมูล ชื่อบุคคลที่ติดต่อได้ในกรณีฉุกเฉิน']);
                    break;
                }
            }
        }
        $validator =  Validator::make($request->all(), $valifield, $valimess);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $contactd = [
            'hn' => $request->get('hn'),
            'adddate' => $request->get('adddate'),
            'fname' => $request->get('fname'),
            'lname' => $request->get('lname'),
            'homeno' => $request->get('homeno'),
            'moo' => $request->get('moo'),
            'soi' => $request->get('soi'),
            'road' => $request->get('road'),
            'city' => $request->get('city'),
            'district' => $request->get('district'),
            'subdistrict' => $request->get('subdistrict'),
            'postcode' => $request->get('postcode'),
            'telhome' => $request->get('telhome'),
            'phoneno' => $request->get('phoneno'),
            'workno' => $request->get('workno'),
        ];

        $contact = CrmContact::find($id);
        $contact->update($contactd);
        if (!empty($request->eemergencyData)) {
            foreach ($request->eemergencyData as $edata) {
                if ($edata['eemertype'] == '') {
                    $Crmemergency = new CrmPhoneEmergency();
                    $Crmemergency->contact_id = $id;
                    $Crmemergency->emergencyname = $edata['emergencyname'];
                    $Crmemergency->emerrelation = $edata['emerrelation'];
                    $Crmemergency->emerphone = $edata['emerphone'];
                    $Crmemergency->save();
                } else {
                    $emerd = [
                        'emergencyname' => $edata['emergencyname'],
                        'emerrelation' => $edata['emerrelation'],
                        'emerphone' => $edata['emerphone'],
                    ];

                    $emer = CrmPhoneEmergency::find($edata['eemertype']);
                    $emer->update($emerd);
                }
            }
        }

        return response()->json(['success' => 'แก้ไข ผู้ติดต่อ เรียบร้อยแล้ว']);
    }

    public function casescontract(Request $request)
    {
        $user = Auth::user();


        $valifield = [
            'hn' => 'required|string|max:10',
            'fname' => 'required|string|max:50',
            'lname' => 'required|string|max:50',
            'homeno' => 'required|string|max:10',
            'city' => 'required|string|max:8',
            'district' => 'required|string|max:8',
            'subdistrict' => 'required|string|max:8',
            'casetype1' => 'required|string|max:50',
        ];
        $valimess = [
            'hn.required' => 'กรุณากรอกรหัสผู้ติดต่อ',
            'fname.required' => 'กรุณากรอกชื่อ',
            'lname.required' => 'กรุณากรอกนามสกุล',
            'homeno.required' => 'กรุณากรอกบ้านเลขที่',
            'city.required' => 'กรุณาเลือกจังหวัด',
            'district.required' => 'กรุณาเลือกอำเภอ',
            'subdistrict.required' => 'กรุณาเลือกตำบล',
            'casetype1.required' => 'กรุณาเลือกประเภทการติดต่อ',
        ];
        if ($request->input('telhome') == "" && $request->input('phoneno') == "" && $request->input('workno') == "") {
            $valifield = array_merge($valifield, ['telhome' => 'required|string|max:25']);
            $valimess = array_merge($valimess, ['telhome.required' => 'กรุณากรอกเบอร์โทรศัพท์บ้าน หรือ เบอร์โทรศัทพ์มือถือ หรือ เบอร์โทรศัพท์ทีทำงาน']);
        }
        if (!empty($request->emergencyData)) {
            foreach ($request->emergencyData as $edata) {
                if ($edata['emergencyname'] == "" || $edata['emerrelation'] == "" || $edata['emerphone'] == "") {
                    $valifield = array_merge($valifield, ['checkemer' => 'required|string|max:50']);
                    $valimess = array_merge($valimess, ['checkemer.required' => 'กรุณาตรวจสอบข้อมูล ชื่อบุคคลที่ติดต่อได้ในกรณีฉุกเฉิน']);
                    break;
                }
            }
        }
        $validator =  Validator::make($request->all(), $valifield, $valimess);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        //
        $input = $request->all();
        $contact = CrmContact::create($input);
        $insertedId = $contact->id;
        if (!empty($request->emergencyData)) {
            foreach ($request->emergencyData as $edata) {
                $Crmemergency = new CrmPhoneEmergency();
                $Crmemergency->contact_id = $insertedId;
                $Crmemergency->emergencyname = $edata['emergencyname'];
                $Crmemergency->emerrelation = $edata['emerrelation'];
                $Crmemergency->emerphone = $edata['emerphone'];
                $Crmemergency->save();
            }
        }
        $Crmcsae = new CrmCase();
        $Crmcsae->contact_id = $insertedId;
        $Crmcsae->telno = $request->input('telno');
        $Crmcsae->casetype1 = $request->input('casetype1');
        $Crmcsae->caseid1 = $request->input('caseid1');
        if ($request->input('casetype2') != "") {
            $Crmcsae->casetype2 = $request->input('casetype2');
            $Crmcsae->caseid2 = $request->input('caseid2');
        }
        if ($request->input('casetype3') != "") {
            $Crmcsae->casetype3 = $request->input('casetype3');
            $Crmcsae->caseid3 = $request->input('caseid3');
        }
        if ($request->input('casetype4') != "") {
            $Crmcsae->casetype4 = $request->input('casetype4');
            $Crmcsae->caseid4 = $request->input('caseid4');
        }
        if ($request->input('casetype5') != "") {
            $Crmcsae->casetype5 = $request->input('casetype5');
            $Crmcsae->caseid5 = $request->input('caseid5');
        }
        if ($request->input('casetype6') != "") {
            $Crmcsae->casetype6 = $request->input('casetype6');
            $Crmcsae->caseid6 = $request->input('caseid6');
        }
        $Crmcsae->tranferstatus = $request->input('tranferstatus');
        $Crmcsae->casedetail = $request->input('casedetail');
        $Crmcsae->casestatus = $request->input('casestatus');
        $Crmcsae->agent = $user->phone;
        $Crmcsae->save();

        DB::table('crm_incoming')->where('telno',  $request->input('telno'))->delete();
        //DB::table('crm_incoming')
        //->where('telno', $request->input('telno'))
        //->update(['status' => '1']);
        return response()->json(['success' => 'เพิ่ม รายผู้ติดต่อ เรียบร้อยแล้ว']);
    }

    public function casescontractupdate(Request $request, $id)
    {
        $user = Auth::user();
        $valifield = [
            'hn' => 'required|string|max:10',
            'fname' => 'required|string|max:50',
            'lname' => 'required|string|max:50',
            'homeno' => 'required|string|max:10',
            'city' => 'required|string|max:8',
            'district' => 'required|string|max:8',
            'subdistrict' => 'required|string|max:8',
            'caseid1' => 'required|string|max:5',
        ];
        $valimess = [
            'hn.required' => 'กรุณากรอกรหัสผู้ติดต่อ',
            'fname.required' => 'กรุณากรอกชื่อ',
            'lname.required' => 'กรุณากรอกนามสกุล',
            'homeno.required' => 'กรุณากรอกบ้านเลขที่',
            'city.required' => 'กรุณาเลือกจังหวัด',
            'district.required' => 'กรุณาเลือกอำเภอ',
            'subdistrict.required' => 'กรุณาเลือกตำบล',
            'caseid1.required' => 'กรุณาเลือกประเภทการติดต่อ',
        ];
        if ($request->input('telhome') == "" && $request->input('phoneno') == "" && $request->input('workno') == "") {
            $valifield = array_merge($valifield, ['telhome' => 'required|string|max:25']);
            $valimess = array_merge($valimess, ['telhome.required' => 'กรุณากรอกเบอร์โทรศัพท์บ้าน หรือ เบอร์โทรศัทพ์มือถือ หรือ เบอร์โทรศัพท์ทีทำงาน']);
        }
        if (!empty($request->emergencyData)) {
            foreach ($request->emergencyData as $edata) {
                if ($edata['emergencyname'] == "" || $edata['emerrelation'] == "" || $edata['emerphone'] == "") {
                    $valifield = array_merge($valifield, ['checkemer' => 'required|string|max:50']);
                    $valimess = array_merge($valimess, ['checkemer.required' => 'กรุณาตรวจสอบข้อมูล ชื่อบุคคลที่ติดต่อได้ในกรณีฉุกเฉิน']);
                    break;
                }
            }
        }
        $validator =  Validator::make($request->all(), $valifield, $valimess);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $contactd = [
            'hn' => $request->get('hn'),
            'adddate' => $request->get('adddate'),
            'fname' => $request->get('fname'),
            'lname' => $request->get('lname'),
            'homeno' => $request->get('homeno'),
            'moo' => $request->get('moo'),
            'soi' => $request->get('soi'),
            'road' => $request->get('road'),
            'city' => $request->get('city'),
            'district' => $request->get('district'),
            'subdistrict' => $request->get('subdistrict'),
            'postcode' => $request->get('postcode'),
            'telhome' => $request->get('telhome'),
            'phoneno' => $request->get('phoneno'),
            'workno' => $request->get('workno'),
        ];

        $contact = CrmContact::find($id);
        $contact->update($contactd);
        if (!empty($request->emergencyData)) {
            foreach ($request->emergencyData as $edata) {
                if ($edata['emertype'] == '') {
                    $Crmemergency = new CrmPhoneEmergency();
                    $Crmemergency->contact_id = $id;
                    $Crmemergency->emergencyname = $edata['emergencyname'];
                    $Crmemergency->emerrelation = $edata['emerrelation'];
                    $Crmemergency->emerphone = $edata['emerphone'];
                    $Crmemergency->save();
                } else {
                    $emerd = [
                        'emergencyname' => $edata['emergencyname'],
                        'emerrelation' => $edata['emerrelation'],
                        'emerphone' => $edata['emerphone'],
                    ];

                    $emer = CrmPhoneEmergency::find($edata['emertype']);
                    $emer->update($emerd);
                }
            }
        }

        $Crmcsae = new CrmCase();
        $Crmcsae->contact_id = $id;
        $Crmcsae->telno = $request->get('telno');
        $Crmcsae->casetype1 = $request->input('casetype1');
        $Crmcsae->caseid1 = $request->input('caseid1');
        if ($request->input('casetype2') != "") {
            $Crmcsae->casetype2 = $request->input('casetype2');
            $Crmcsae->caseid2 = $request->input('caseid2');
        }
        if ($request->input('casetype3') != "") {
            $Crmcsae->casetype3 = $request->input('casetype3');
            $Crmcsae->caseid3 = $request->input('caseid3');
        }
        if ($request->input('casetype4') != "") {
            $Crmcsae->casetype4 = $request->input('casetype4');
            $Crmcsae->caseid4 = $request->input('caseid4');
        }
        if ($request->input('casetype5') != "") {
            $Crmcsae->casetype5 = $request->input('casetype5');
            $Crmcsae->caseid5 = $request->input('caseid5');
        }
        if ($request->input('casetype6') != "") {
            $Crmcsae->casetype6 = $request->input('casetype6');
            $Crmcsae->caseid6 = $request->input('caseid6');
        }
        $Crmcsae->tranferstatus = $request->get('tranferstatus');
        $Crmcsae->casedetail = $request->get('casedetail');
        $Crmcsae->casestatus = $request->get('casestatus');
        $Crmcsae->agent = $user->phone;
        $Crmcsae->save();

        DB::table('crm_incoming')->where('telno',  $request->input('telno'))->delete();
        return response()->json(['success' => 'แก้ไข ผู้ติดต่อ เรียบร้อยแล้ว']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        CrmContact::find($id)->delete();
        DB::table('crm_phone_emergencies')->where('contact_id',  $id)->delete();
        return ['success' => true, 'message' => 'ลบ ผู้ติดต่อ เรียบร้อยแล้ว'];
    }

    public function destroy_all(Request $request)
    {

        $arr_del  = $request->get('table_records'); //$arr_ans is Array MacAddress

        for ($xx = 0; $xx < count($arr_del); $xx++) {
            CrmContact::find($arr_del[$xx])->delete();
            DB::table('crm_phone_emergencies')->where('contact_id',  $arr_del[$xx])->delete();
        }

        return redirect('/contacts')->with('success', 'ลบ ผู้ติดต่อ เรียบร้อยแล้ว');
    }
}
