<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CrmContact;
use App\Models\CrmPhoneEmergency;
use App\Models\CrmPhoneEmergencyLog;
use App\Models\CrmContactLog;
use App\Models\Department;
use App\Models\CrmCase;
use App\Models\User;
use App\Models\CrmCaseslog;
use Carbon\Carbon;
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
                $datas = DB::table('crm_contacts')->whereRaw('adddate between "' . $startDate . '" and "' . $endDate . '"');
                //->get();
            } else if ($request->input('seachtype') === "1") {
                $datas = DB::table('crm_contacts')
                    ->join('crm_phone_emergencies', 'crm_contacts.id', '=', 'crm_phone_emergencies.contact_id')
                    ->where('emerphone', '=', $request->input('seachtext'))
                    ->whereRaw('adddate between "' . $startDate . '" and "' . $endDate . '"');
                //->get();
            } else if ($request->input('seachtype') === "2") {
                $datas = DB::table('crm_contacts')->where('telhome', 'like', $request->input('seachtext') . '%')
                    ->whereRaw('adddate between "' . $startDate . '" and "' . $endDate . '"');
                //->get();
            } else if ($request->input('seachtype') === "3") {
                $datas = DB::table('crm_contacts')->where('phoneno', 'like', $request->input('seachtext') . '%')
                    ->whereRaw('adddate between "' . $startDate . '" and "' . $endDate . '"');
                //->get();
            } else if ($request->input('seachtype') === "4") {
                $datas = DB::table('crm_contacts')->where('workno', 'like', $request->input('seachtext') . '%')
                    ->whereRaw('adddate between "' . $startDate . '" and "' . $endDate . '"');
                //->get();
            } else if ($request->input('seachtype') === "5") {
                $datas = DB::table('crm_contacts')->where('hn', 'like', '%' . $request->input('seachtext') . '%')
                    ->whereRaw('adddate between "' . $startDate . '" and "' . $endDate . '"');
                //->get();
            } else if ($request->input('seachtype') === "6") {
                $datas = DB::table('crm_contacts')->where('fname', 'like', '%' . $request->input('seachtext') . '%')
                    ->whereRaw('adddate between "' . $startDate . '" and "' . $endDate . '"');
                //->get();
            }
            $datas->orderBy("created_at", "desc")->get();

            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->id . '" >';
                })
                ->editColumn('fname', function ($row) {
                    return $row->fname . ' ' . $row->lname;
                })
                ->editColumn('adddate', function ($row) {
                    //$adddate = Carbon::parse($row->adddate)->addYears(543)->format('d/m/Y');
                    $adddate = Carbon::parse($row->created_at)->format('Y-m-d H:i:s');
                    return $adddate;
                })
                ->addColumn('action', function ($row) {
                    //if (Gate::allows('contact-edit')) {
                    //    $html = '<button type="button" class="btn btn-sm btn-success btn-success" id="getCases" data-id="' . $row->id . '"><i class="fa fa-edit"></i> เรื่องที่ติดต่อ</button> ';
                    //} else {
                    //    $html = '<button type="button" class="btn btn-sm btn-success disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    //}
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
        return view('contacts.index')->with(['centre' => $centre]);
    }

    public function popup_content(Request $request)
    {

        //$con = $request->input('cardId');

        $cid = $request->input('cardId');

        $datau = DB::table('crm_incoming')
            ->where('id', '=', $cid)
            ->get();
        $con = $datau[0]->telno;

        $datap = DB::table('crm_contacts')
            ->select('crm_contacts.*')
            ->leftjoin('crm_phone_emergencies', 'crm_contacts.id', '=', 'crm_phone_emergencies.contact_id')
            ->where('crm_contacts.phoneno', '=', $con)
            ->orWhere('crm_contacts.telhome', '=', $con)
            ->orWhere('crm_contacts.workno', '=', $con)
            ->orWhere('crm_phone_emergencies.emerphone', '=', $con)
            //->groupBy('crm_contacts.id')
            ->get();
        $contactcount = count($datap);
        if ($contactcount > 1) {
            $template = 'casescontract.contactpop';
            $htmlContent = View::make($template, [
                'cardid' => $cid, 'telephone' => $con, 'contactd' => $datap
            ])->render();
        } elseif ($contactcount == 1) {
            $template = 'contacts.contact-create';
            $htmlContent = View::make($template, [
                'cardid' => $cid, 'telephone' => $con, 'contactd' => $datap[0]->id
            ])->render();
        } else {
            $template = 'contacts.contact-create';
            $htmlContent = View::make($template, [
                'cardid' => $cid, 'telephone' => $con, 'contactd' => 0
            ])->render();
        }
        return response()->json(['html' =>  $htmlContent,]);
    }
    ////edit
    public function popupcontact(Request $request)
    {
        $con = $request->get('contactid');
        $cards = $request->get('cardid');
        $telephoneno = $request->get('telephoneno');
        $datap = DB::table('crm_contacts')
            ->where('id', '=', $con)
            ->get();
        $template = 'contacts.contact-create';
        $htmlContent = View::make($template, [
            'cardid' => $cards, 'telephone' => $telephoneno, 'contactd' => $datap
        ])->render();
        return response()->json([
            'html' =>  $htmlContent,
        ]);
    }

    public function popupedit($telnop)
    {
        $datac = DB::table('crm_contacts')
            ->where('id', '=', $telnop)
            //->where('phoneno', '=', $telnop)
            //->orWhere('telhome', '=', $telnop)
            //->orWhere('workno', '=', $telnop)
            ->get();
        $cases = DB::table('crm_cases')
            ->where('contact_id', '=', $datac[0]->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $emer = DB::table('crm_phone_emergencies')
            ->where('contact_id', '=', $datac[0]->id)
            ->orderBy('created_at', 'desc')
            ->skip(0)
            ->take(5)
            ->get();

        $data = [
            'datac' => $datac[0],
            'cases' => $cases,
            'emer' => $emer,
        ];
        return response()->json(['datax' => $data]);
    }

    public function popupeditphone($telnop)
    {
        $datac = DB::table('crm_contacts')
            ->where('phoneno', '=', $telnop)
            ->orWhere('telhome', '=', $telnop)
            ->orWhere('workno', '=', $telnop)
            ->get();
        $contactcount = count($datac);
        if ($contactcount > 0) {
            $cases = DB::table('crm_cases')
                ->where('contact_id', '=', $datac[0]->id)
                ->orderBy('created_at', 'desc')
                ->get();
            $emer = DB::table('crm_phone_emergencies')
                ->where('contact_id', '=', $datac[0]->id)
                ->get();
            $data = [
                'datac' => $datac[0],
                'cases' => $cases,
                'emer' => $emer
            ];
            return response()->json(['datax' => $data]);
        } else {
            return response()->json(['datax' => []]);
        }
    }

    public function popup()
    {
        $user = Auth::user();

        $datac = DB::table('crm_incoming')
            ->orderBy('id', 'desc')
            //->where('agentno', '=', $user->phone)
            ->where('agent_id', '=', $user->id)
            ->where(function ($query) {
                $query->orWhere('status', '=', '0')
                    ->orWhere('status', '=', '1');
            })->get();

        $html = '';
        $tab_link = '';
        $tab_content = '';
        $tab_hold = "";
        $active_id = '';
        $i = 1;
        if (!$datac->isEmpty()) {
            foreach ($datac as $item) {
                $datap = DB::table('crm_contacts')
                    ->where('phoneno', '=', $item->telno)
                    ->orWhere('telhome', '=', $item->telno)
                    ->orWhere('workno', '=', $item->telno)
                    ->count();
                if ($datap > 0) {
                    $statusText = "(ผู้ติดต่อที่เคยบันทึกข้อมูลไว้)";
                } else {
                    $statusText = "(ผู้ติดต่อใหม่)";
                }
                /* style="width: 300px; height: 150px;"  */


                if ($i == 1) {
                    $tab_link_active = 'active';
                    $tab_content_active = 'show active';
                    $tab_active = 'card-danger';
                    $active_id = $item->id;
                } else {
                    $tab_link_active = '';
                    $tab_content_active = '';
                    $tab_active = 'card-secondary';
                }

                $html = '<div class="col-md-12">
                <div class=" pop_content" id="pop_' . $item->id . '">' . $statusText . '</div></div>';
                $tab_link .= '<li class="nav-item">
                <a class="popup-tab-font-size nav-link ' . $tab_link_active . '" id="custom-tabs-pop-' . $item->id . '-tab" data-toggle="pill" data-id="' . $item->id . '" data-tel="' . $item->telno . '"
                    href="#custom-tabs-pop-' . $item->id . '" role="tab" aria-controls="custom-tabs-pop-' . $item->id . '"
                    aria-selected="false">' . $item->telno . '</a>
                </li>';
                $tab_content .= '<div class="tab-pane fade ' . $tab_content_active . '" id="custom-tabs-pop-' . $item->id . '" data-tick="' . $item->uniqid . '" role="tabpanel"
                aria-labelledby="custom-tabs-pop-' . $item->id . '-tab">
                <div class="row" id="dpopup_' . $item->id . '">
                ' . $html . '
                </div>
            </div>';

                $tab_hold .= ' <a href="#" class="dropdown-item hold_tab_a" data-id="' . $item->id . '" data-tick="' . $item->uniqid . '">
                    <div class="media ">
                        <img src="' . asset('images/user.png') . '" alt="..." class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                            ' . $item->telno . '
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">' . $statusText . '</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>' . $item->calltime . '</p>
                        </div>
                    </div>

                </a>
                <div class="dropdown-divider"></div>';

                $i++;
            }
        } else {
            $tab_hold .= ' <a href="#" class="dropdown-item hold_tab_em">
                    <div class="media ">
                        <img src="' . asset('images/user.png') . '" alt="..." class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                            ยังไม่มีรายการผู้ติดต่อที่ค้างอยู่
                            </h3>
                        </div>
                    </div>

                </a>
                <div class="dropdown-divider"></div>';
            $i = 1;
        }


        $tab_hold .= '<a href="#" class="dropdown-item dropdown-footer" id="hold_tab_list">ดูรายการคอมเม้น</a>';

        $cstartDate = date("Y-m-d");
        $datacomment = DB::table('crm_case_comments')
        ->select('crm_case_comments.comment', 'crm_case_comments.agent', 'crm_case_comments.created_at', 'crm_case_comments.id')
        ->join('crm_cases', 'crm_case_comments.case_id', '=', 'crm_cases.id')
        ->where('crm_cases.agent', '=', $user->id)
        ->whereRaw('crm_case_comments.created_at between "' . $cstartDate . ' 00:00:00" and "' . $cstartDate . ' 23:59:59"')
        ->get();
        $countcomment = $datacomment->count();
        $ctab_hold = '';
        $c = 0;
        if ($countcomment > 0) {
            foreach ($datacomment as $citem) {
                $ctab_hold .= ' <a href="#" class="dropdown-item hold_tab_a" data-id="' . $citem->id . '">
                    <div class="media ">
                        <img src="' . asset('images/user.png') . '" alt="..." class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                            ' . $citem->telno . '
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">' . $citem->telno . '</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>' . $citem->calltime . '</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>';
                $c++;
            }
        } else {
            $ctab_hold = ' <a href="#" class="dropdown-item hold_tab_em">
                    <div class="media ">
                        <img src="' . asset('images/user.png') . '" alt="..." class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                            ไม่มีรายการคอมเม้น
                            </h3>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>';
            $c = 1;
        }

        return response()->json([
            'tab_link' => $tab_link,
            'tab_content' => $tab_content,
            'active_id' => $active_id,
            'hold_tab' => $i - 1,
            'hold_tab_content' => $tab_hold,
            'chold_tab' => $c - 1,
            'chold_tab_content' => $ctab_hold
        ]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $valifield = [
        /*    'hn' => 'required|string|max:10',
            'tname' => 'required|string|max:50',
            'fname' => 'required|string|max:50',
            'lname' => 'required|string|max:50',
            'sex' => 'required|string|max:50',
            'birthday' => 'required|string|max:50',
            'bloodgroup' => 'required|string|max:50',
            'homeno' => 'required|string|max:10',
            'city' => 'required|string|max:8',
            'district' => 'required|string|max:8',
            'subdistrict' => 'required|string|max:8', */
        ];
        $valimess = [
        /*    'hn.required' => 'กรุณากรอกรหัสผู้ติดต่อ',
            'tname.required' => 'กรุณาเลือกคำนำหน้าชื่อ',
            'fname.required' => 'กรุณากรอกชื่อ',
            'lname.required' => 'กรุณากรอกนามสกุล',
            'sex.required' => 'กรุณาเลือกเพศ',
            'birthday.required' => 'กรุณาเลือกวันที่',
            'bloodgroup.required' => 'กรุณาเลือกกรุ๊ปเลือด',
            'homeno.required' => 'กรุณากรอกบ้านเลขที่',
            'city.required' => 'กรุณาเลือกจังหวัด',
            'district.required' => 'กรุณาเลือกอำเภอ',
            'subdistrict.required' => 'กรุณาเลือกตำบล', */
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
        $input = array_merge($input, ['agent' => $user->id]);
        $contact = CrmContact::create($input);
        $insertedId = $contact->id;
        if (!empty($request->emergencyData)) {
            foreach ($request->emergencyData as $edata) {
                $Crmemergency = new CrmPhoneEmergency();
                $Crmemergency->contact_id = $insertedId;
                $Crmemergency->emergencyname = $edata['emergencyname'];
                $Crmemergency->emerrelation = $edata['emerrelation'];
                $Crmemergency->emerphone = $edata['emerphone'];
                $Crmemergency->agent = $user->id;
                $Crmemergency->save();
            }
        }
        return response()->json(['success' => 'เพิ่ม รายผู้ติดต่อ เรียบร้อยแล้ว']);
    }

    public function show(string $id)
    {
    }

    public function edit($id)
    {
        $datac = CrmContact::find($id);
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

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $valifield = [
           /* 'tname' => 'required|string|max:50',
            'fname' => 'required|string|max:50',
            'lname' => 'required|string|max:50',
            'sex' => 'required|string|max:50',
            'birthday' => 'required|string|max:50',
            'bloodgroup' => 'required|string|max:50',
            'homeno' => 'required|string|max:50',
            'city' => 'required|string|max:8',
            'district' => 'required|string|max:8',
            'subdistrict' => 'required|string|max:8', */
        ];
        $valimess = [
           /* 'tname.required' => 'กรุณาเลือกคำนำหน้าชื่อ',
            'fname.required' => 'กรุณากรอกชื่อ',
            'lname.required' => 'กรุณากรอกนามสกุล',
            'sex.required' => 'กรุณาเลือกเพศ',
            'birthday.required' => 'กรุณาเลือกวันเกิด',
            'bloodgroup.required' => 'กรุณาเลือกกรุ๊ปเลือด',
            'homeno.required' => 'กรุณากรอกบ้านเลขที่',
            'city.required' => 'กรุณาเลือกจังหวัด',
            'district.required' => 'กรุณาเลือกอำเภอ',
            'subdistrict.required' => 'กรุณาเลือกตำบล', */
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
            'tname' => $request->get('tname'),
            'fname' => $request->get('fname'),
            'lname' => $request->get('lname'),
            'sex' => $request->get('sex'),
            'birthday' => $request->get('birthday'),
            'age' => $request->get('age'),
            'bloodgroup' => $request->get('bloodgroup'),
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
            'agent' => $user->id,
        ];

        $contact = CrmContact::find($id);

        $contactlog = [
            'id' => $contact->id,
            'hn' => $contact->hn,
            'adddate' => $contact->adddate,
            'tname' => $contact->tname,
            'fname' => $contact->fname,
            'lname' => $contact->lname,
            'sex' => $contact->sex,
            'birthday' => $contact->birthday,
            'age' => $contact->age,
            'bloodgroup' => $contact->bloodgroup,
            'homeno' => $contact->homeno,
            'moo' => $contact->moo,
            'soi' => $contact->soi,
            'road' => $contact->road,
            'city' => $contact->city,
            'district' => $contact->district,
            'subdistrict' => $contact->subdistrict,
            'postcode' => $contact->postcode,
            'telhome' => $contact->telhome,
            'phoneno' => $contact->phoneno,
            'workno' => $contact->workno,
            'agent' => $contact->agent,
            'created_at' => $contact->created_at,
            'updated_at' => $contact->updated_at,
            'modifyaction' => 'edit',
            'modifyagent' => $user->id,
        ];
        if ($contact->birthday == "0000-00-00") {
            $contactlog['birthday'] = null;
        }
        //$bindings = $contact->getBindings();
        //DB::table('crm_contact_logs')->insert($contact);
        //$bindings = $contact->getBindings();

        CrmContactLog::create($contactlog);

        $contact->update($contactd);

        if (!empty($request->eemergencyData)) {
            foreach ($request->eemergencyData as $edata) {
                if ($edata['eemertype'] == '') {
                    $Crmemergency = new CrmPhoneEmergency();
                    $Crmemergency->contact_id = $id;
                    $Crmemergency->emergencyname = $edata['emergencyname'];
                    $Crmemergency->emerrelation = $edata['emerrelation'];
                    $Crmemergency->emerphone = $edata['emerphone'];
                    $Crmemergency->agent = $user->id;
                    $Crmemergency->save();
                } else {
                    $emerd = [
                        'emergencyname' => $edata['emergencyname'],
                        'emerrelation' => $edata['emerrelation'],
                        'emerphone' => $edata['emerphone'],
                        'agent' => $user->id,
                    ];

                    $emer = CrmPhoneEmergency::find($edata['eemertype']);
                    $emerlog = [
                        'id' => $emer->id,
                        'contact_id' => $emer->contact_id,
                        'emergencyname' => $emer->emergencyname,
                        'emerrelation' => $emer->emerrelation,
                        'emerphone' => $emer->emerphone,
                        'agent' => $emer->agent,
                        'created_at' => $emer->created_at,
                        'updated_at' => $emer->updated_at,
                        'modifyaction' => 'edit',
                        'modifyagent' => $user->id,
                    ];
                    CrmPhoneEmergencyLog::create($emerlog);
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
            /*
            'hn' => 'required|string|max:10',
            'tname' => 'required|string|max:50',
            'fname' => 'required|string|max:50',
            'lname' => 'required|string|max:50',
            'sex' => 'required|string|max:50',
            'birthday' => 'required|string|max:50',
            'bloodgroup' => 'required|string|max:50',
            'homeno' => 'required|string|max:10',
            'city' => 'required|string|max:8',
            'district' => 'required|string|max:8',
            'subdistrict' => 'required|string|max:8',
            */
            'caseid1' => 'required|string|max:100',
            //'casedetail' => 'required|string|max:200',
        ];
        $valimess = [
            /*
            'hn.required' => 'กรุณากรอกรหัสผู้ติดต่อ',
            'tname.required' => 'กรุณาเลือกคำนำหน้าชื่อ',
            'fname.required' => 'กรุณากรอกชื่อ',
            'lname.required' => 'กรุณากรอกนามสกุล',
            'sex.required' => 'กรุณาเลือกเพศ',
            'birthday.required' => 'กรุณาเลือกวันเกิด',
            'bloodgroup.required' => 'กรุณาเลือกกรุ๊ปเลือด',
            'homeno.required' => 'กรุณากรอกบ้านเลขที่',
            'city.required' => 'กรุณาเลือกจังหวัด',
            'district.required' => 'กรุณาเลือกอำเภอ',
            'subdistrict.required' => 'กรุณาเลือกตำบล',
            */
            'caseid1.required' => 'กรุณาเลือกประเภทการติดต่อ',
            //'casedetail.required' => 'กรุณากรอกรายละเอียดที่ติดต่อ',
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
        $input = array_merge($input, ['agent' => $user->id]);
        $contact = CrmContact::create($input);
        $insertedId = $contact->id;
        if (!empty($request->emergencyData)) {
            foreach ($request->emergencyData as $edata) {
                $Crmemergency = new CrmPhoneEmergency();
                $Crmemergency->contact_id = $insertedId;
                $Crmemergency->emergencyname = $edata['emergencyname'];
                $Crmemergency->emerrelation = $edata['emerrelation'];
                $Crmemergency->emerphone = $edata['emerphone'];
                $Crmemergency->agent = $user->id;
                $Crmemergency->save();
            }
        }
        $Crmcsae = new CrmCase();
        $Crmcsae->contact_id = $insertedId;
        $Crmcsae->adddate = $request->input('adddate');
        $Crmcsae->uniqid = $request->input('uniqid');
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
        $Crmcsae->agent = $user->id;
        $Crmcsae->save();

        //CrmIncoming::where('telno', $request->input('telno'))->update('status' => '2');uniqid
        //DB::table('crm_incoming')->where('telno', $request->input('telno'))->update(['status' => '2']);
        DB::table('crm_incoming')->where('uniqid', $request->input('uniqid'))->update(['status' => '2']);
        //$income = CrmIncoming::find($edata['emertype']);
        //$income->update($incomea);
        //DB::table('crm_incoming')->where('telno',  $request->input('telno'))->delete();

        return response()->json(['success' => 'เพิ่ม รายผู้ติดต่อ เรียบร้อยแล้ว']);
    }

    public function casescontractupdate(Request $request, $id)
    {
        $user = Auth::user();
        $valifield = [
            /*
            'tname' => 'required|string|max:50',
            'fname' => 'required|string|max:50',
            'lname' => 'required|string|max:50',
            'sex' => 'required|string|max:50',
            'birthday' => 'required|string|max:50',
            'bloodgroup' => 'required|string|max:50',
            'homeno' => 'required|string|max:10',
            'city' => 'required|string|max:8',
            'district' => 'required|string|max:8',
            'subdistrict' => 'required|string|max:8',
            */
            'caseid1' => 'required|string|max:100',
            //'casedetail' => 'required|string|max:200',
        ];
        $valimess = [
            /*
            'tname.required' => 'กรุณาเลือกคำนำหน้าชื่อ',
            'fname.required' => 'กรุณากรอกชื่อ',
            'lname.required' => 'กรุณากรอกนามสกุล',
            'sex.required' => 'กรุณาเลือกเพศ',
            'birthday.required' => 'กรุณาเลือกวันเกิด',
            'bloodgroup.required' => 'กรุณาเลือกกรุ๊ปเลือด',
            'homeno.required' => 'กรุณากรอกบ้านเลขที่',
            'city.required' => 'กรุณาเลือกจังหวัด',
            'district.required' => 'กรุณาเลือกอำเภอ',
            'subdistrict.required' => 'กรุณาเลือกตำบล',
            */
            'caseid1.required' => 'กรุณาเลือกประเภทการติดต่อ',
            //'casedetail.required' => 'กรุณากรอกรายละเอียดที่ติดต่อ',
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
            'tname' => $request->get('tname'),
            'fname' => $request->get('fname'),
            'lname' => $request->get('lname'),
            'sex' => $request->get('sex'),
            'birthday' => $request->get('birthday'),
            'age' => $request->get('age'),
            'bloodgroup' => $request->get('bloodgroup'),
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
            'agent' => $user->id,
        ];

        $contact = CrmContact::find($id);

        $contactlog = [
            'id' => $contact->id,
            'hn' => $contact->hn,
            'adddate' => $contact->adddate,
            'tname' => $contact->tname,
            'fname' => $contact->fname,
            'lname' => $contact->lname,
            'sex' => $contact->sex,
            'birthday' => $contact->birthday,
            'age' => $contact->age,
            'bloodgroup' => $contact->bloodgroup,
            'homeno' => $contact->homeno,
            'moo' => $contact->moo,
            'soi' => $contact->soi,
            'road' => $contact->road,
            'city' => $contact->city,
            'district' => $contact->district,
            'subdistrict' => $contact->subdistrict,
            'postcode' => $contact->postcode,
            'telhome' => $contact->telhome,
            'phoneno' => $contact->phoneno,
            'workno' => $contact->workno,
            'agent' => $contact->agent,
            'created_at' => $contact->created_at,
            'updated_at' => $contact->updated_at,
            'modifyaction' => 'edit',
            'modifyagent' => $user->id,
        ];
        if ($contact->birthday == "0000-00-00") {
            $contactlog['birthday'] = null;
        }
        CrmContactLog::create($contactlog);

        $contact->update($contactd);
        if (!empty($request->emergencyData)) {
            foreach ($request->emergencyData as $edata) {
                if ($edata['emertype'] == '') {
                    $Crmemergency = new CrmPhoneEmergency();
                    $Crmemergency->contact_id = $id;
                    $Crmemergency->emergencyname = $edata['emergencyname'];
                    $Crmemergency->emerrelation = $edata['emerrelation'];
                    $Crmemergency->emerphone = $edata['emerphone'];
                    $Crmemergency->agent = $user->id;
                    $Crmemergency->save();
                } else {
                    $emerd = [
                        'emergencyname' => $edata['emergencyname'],
                        'emerrelation' => $edata['emerrelation'],
                        'emerphone' => $edata['emerphone'],
                        'agent' => $user->id,
                    ];

                    $emer = CrmPhoneEmergency::find($edata['emertype']);
                    $emerlog = [
                        'id' => $emer->id,
                        'contact_id' => $emer->contact_id,
                        'emergencyname' => $emer->emergencyname,
                        'emerrelation' => $emer->emerrelation,
                        'emerphone' => $emer->emerphone,
                        'agent' => $emer->agent,
                        'created_at' => $emer->created_at,
                        'updated_at' => $emer->updated_at,
                        'modifyaction' => 'edit',
                        'modifyagent' => $user->id,
                    ];
                    CrmPhoneEmergencyLog::create($emerlog);
                    $emer->update($emerd);
                }
            }
        }

        $Crmcsae = new CrmCase();
        $Crmcsae->contact_id = $id;
        $Crmcsae->adddate = $request->input('adddate');
        $Crmcsae->uniqid = $request->input('uniqid');
        $Crmcsae->telno = $request->get('telno');
        $Crmcsae->casetype1 = $request->get('casetype1');
        $Crmcsae->caseid1 = $request->get('caseid1');
        if ($request->get('casetype2') != "") {
            $Crmcsae->casetype2 = $request->get('casetype2');
            $Crmcsae->caseid2 = $request->get('caseid2');
        }
        if ($request->get('casetype3') != "") {
            $Crmcsae->casetype3 = $request->get('casetype3');
            $Crmcsae->caseid3 = $request->get('caseid3');
        }
        if ($request->get('casetype4') != "") {
            $Crmcsae->casetype4 = $request->get('casetype4');
            $Crmcsae->caseid4 = $request->get('caseid4');
        }
        if ($request->get('casetype5') != "") {
            $Crmcsae->casetype5 = $request->get('casetype5');
            $Crmcsae->caseid5 = $request->get('caseid5');
        }
        if ($request->get('casetype6') != "") {
            $Crmcsae->casetype6 = $request->get('casetype6');
            $Crmcsae->caseid6 = $request->get('caseid6');
        }
        $Crmcsae->tranferstatus = $request->get('tranferstatus');
        $Crmcsae->casedetail = $request->get('casedetail');
        $Crmcsae->casestatus = $request->get('casestatus');
        $Crmcsae->agent = $user->id;
        $Crmcsae->save();

        //CrmIncoming::where('telno', $request->input('telno'))->update('status' => '2');
        //DB::table('crm_incoming')->where('telno', $request->input('telno'))->update(['status' => '2']);
        DB::table('crm_incoming')->where('uniqid', $request->input('uniqid'))->update(['status' => '2']);
        //$income = CrmIncoming::find($edata['emertype']);
        //$income->update($incomea);
        //DB::table('crm_incoming')->where('telno',  $request->input('telno'))->delete();
        return response()->json(['success' => 'บันทึกข้อมูล เรียบร้อยแล้ว']);
    }

    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $user = Auth::user();
        $contact = CrmContact::find($id);

        $contactlog = [
            'id' => $contact->id,
            'hn' => $contact->hn,
            'adddate' => $contact->adddate,
            'tname' => $contact->tname,
            'fname' => $contact->fname,
            'lname' => $contact->lname,
            'sex' => $contact->sex,
            'birthday' => $contact->birthday,
            'age' => $contact->age,
            'bloodgroup' => $contact->bloodgroup,
            'homeno' => $contact->homeno,
            'moo' => $contact->moo,
            'soi' => $contact->soi,
            'road' => $contact->road,
            'city' => $contact->city,
            'district' => $contact->district,
            'subdistrict' => $contact->subdistrict,
            'postcode' => $contact->postcode,
            'telhome' => $contact->telhome,
            'phoneno' => $contact->phoneno,
            'workno' => $contact->workno,
            'agent' => $contact->agent,
            'created_at' => $contact->created_at,
            'updated_at' => $contact->updated_at,
            'modifyaction' => 'delete',
            'modifyagent' => $user->id,
        ];
        if ($contact->birthday == "0000-00-00") {
            $contactlog['birthday'] = null;
        }
        CrmContactLog::create($contactlog);

        $contact->delete();

        $emerdelete = CrmPhoneEmergency::where('contact_id', $id)->get();

        foreach ($emerdelete as $emer) {
            $emerlog = [
                'id' => $emer->id,
                'contact_id' => $emer->contact_id,
                'emergencyname' => $emer->emergencyname,
                'emerrelation' => $emer->emerrelation,
                'emerphone' => $emer->emerphone,
                'agent' => $emer->agent,
                'created_at' => $emer->created_at,
                'updated_at' => $emer->updated_at,
                'modifyaction' => 'delete',
                'modifyagent' => $user->id,
            ];
            CrmPhoneEmergencyLog::create($emerlog);
            CrmPhoneEmergency::where('contact_id', $emer->id)->delete();
        }

        $casesdelete = CrmCase::where('contact_id', $id)->get();

        foreach ($casesdelete as $cases) {
            $caseslog = [
                'id' => $cases->id,
                'contact_id' => $cases->contact_id,
                'adddate' => $cases->adddate,
                'uniqid' => $cases->uniqid,
                'telno' => $cases->telno,
                'casetype1' => $cases->casetype1,
                'caseid1' => $cases->caseid1,
                'casetype2' => $cases->casetype2,
                'caseid2' => $cases->caseid2,
                'casetype3' => $cases->casetype3,
                'caseid3' => $cases->caseid3,
                'casetype4' => $cases->casetype4,
                'caseid4' => $cases->caseid4,
                'casetype5' => $cases->casetype5,
                'caseid5' => $cases->caseid5,
                'casetype6' => $cases->casetype6,
                'caseid6' => $cases->caseid6,
                'tranferstatus' => $cases->tranferstatus,
                'casedetail' => $cases->casedetail,
                'casestatus' => $cases->casestatus,
                'agent' => $cases->agent,
                'created_at' => $cases->created_at,
                'updated_at' => $cases->updated_at,
                'modifyaction' => 'delete',
                'modifyagent' => $user->id,
            ];
            CrmCaseslog::create($caseslog);
            CrmCase::where('contact_id', $cases->id)->delete();
        }

        return ['success' => true, 'message' => 'ลบ ผู้ติดต่อ เรียบร้อยแล้ว'];
    }

    public function destroy_all(Request $request)
    {
        $user = Auth::user();
        $arr_del  = $request->get('table_records');

        for ($xx = 0; $xx < count($arr_del); $xx++) {
            $contact = CrmContact::find($arr_del[$xx]);

            $contactlog = [
                'id' => $contact->id,
                'hn' => $contact->hn,
                'adddate' => $contact->adddate,
                'tname' => $contact->tname,
                'fname' => $contact->fname,
                'lname' => $contact->lname,
                'sex' => $contact->sex,
                'birthday' => $contact->birthday,
                'age' => $contact->age,
                'bloodgroup' => $contact->bloodgroup,
                'homeno' => $contact->homeno,
                'moo' => $contact->moo,
                'soi' => $contact->soi,
                'road' => $contact->road,
                'city' => $contact->city,
                'district' => $contact->district,
                'subdistrict' => $contact->subdistrict,
                'postcode' => $contact->postcode,
                'telhome' => $contact->telhome,
                'phoneno' => $contact->phoneno,
                'workno' => $contact->workno,
                'agent' => $contact->agent,
                'created_at' => $contact->created_at,
                'updated_at' => $contact->updated_at,
                'modifyaction' => 'delete',
                'modifyagent' => $user->id,
            ];
            if ($contact->birthday == "0000-00-00") {
                $contactlog['birthday'] = null;
            }
            CrmContactLog::create($contactlog);

            $contact->delete();

            $emerdelete = CrmPhoneEmergency::where('contact_id', $contact->id)->get();

            foreach ($emerdelete as $emer) {
                $emerlog = [
                    'id' => $emer->id,
                    'contact_id' => $emer->contact_id,
                    'emergencyname' => $emer->emergencyname,
                    'emerrelation' => $emer->emerrelation,
                    'emerphone' => $emer->emerphone,
                    'agent' => $emer->agent,
                    'created_at' => $emer->created_at,
                    'updated_at' => $emer->updated_at,
                    'modifyaction' => 'delete',
                    'modifyagent' => $user->id,
                ];
                CrmPhoneEmergencyLog::create($emerlog);
                CrmPhoneEmergency::where('contact_id', $emer->id)->delete();
            }

            $casesdelete = CrmCase::where('contact_id', $contact->id)->get();

            foreach ($casesdelete as $cases) {
                $caseslog = [
                    'id' => $cases->id,
                    'contact_id' => $cases->contact_id,
                    'adddate' => $cases->adddate,
                    'uniqid' => $cases->uniqid,
                    'telno' => $cases->telno,
                    'casetype1' => $cases->casetype1,
                    'caseid1' => $cases->caseid1,
                    'casetype2' => $cases->casetype2,
                    'caseid2' => $cases->caseid2,
                    'casetype3' => $cases->casetype3,
                    'caseid3' => $cases->caseid3,
                    'casetype4' => $cases->casetype4,
                    'caseid4' => $cases->caseid4,
                    'casetype5' => $cases->casetype5,
                    'caseid5' => $cases->caseid5,
                    'casetype6' => $cases->casetype6,
                    'caseid6' => $cases->caseid6,
                    'tranferstatus' => $cases->tranferstatus,
                    'casedetail' => $cases->casedetail,
                    'casestatus' => $cases->casestatus,
                    'agent' => $cases->agent,
                    'created_at' => $cases->created_at,
                    'updated_at' => $cases->updated_at,
                    'modifyaction' => 'delete',
                    'modifyagent' => $user->id,
                ];
                CrmCaseslog::create($caseslog);
                CrmCase::where('contact_id', $cases->id)->delete();
            }

            //CrmContact::find($arr_del[$xx])->delete();
            //DB::table('crm_phone_emergencies')->where('contact_id',  $arr_del[$xx])->delete();
        }

        return redirect('/contacts')->with('success', 'ลบ ผู้ติดต่อ เรียบร้อยแล้ว');
    }

    public function caseslist(Request $request)
    {
        $id = $request->input('id');

        $data = CrmCase::where('contact_id', $id)
            ->orderBy("id", "desc")
            ->limit(10)
            ->get();

        $agens = User::orderBy('name', 'asc')->get();
        $agentArray = [];
        $agentArray[0]['name'] = 'All';
        foreach ($agens as $agen) {
            $agentArray[$agen->id]['name'] = $agen->name;
        }


        $template = 'contacts.caseslist';
        $htmlContent = View::make($template, ['caselist' => $data, 'agent' => $agentArray])->render();
        return response()->json(['html' =>  $htmlContent,]);

        //return response()->json(['data' => $data]);

    }

    public function casesview(Request $request)
    {
        $casesid = $request->input('id');
        $datac = CrmCase::where('id', $casesid)->first();
        $datact = CrmContact::where('id', $datac->contact_id)->first();

        $template = 'contacts.casesdetail';
        $htmlContent = View::make($template, ['cases' => $datac, 'datact' => $datact])->render();
        //$htmlContent = View::make($template, ['casecomment' => $data])->render();
        return response()->json(['html' =>  $htmlContent,]);

        //return response()->json(['data' => $data]);

    }
}
