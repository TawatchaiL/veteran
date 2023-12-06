<?php

namespace App\Http\Controllers;

use App\Models\NotifyGroup;
use App\Models\Notify2Group;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class NotifyGroupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('permission:notify-list|notify-create|notify-edit|notify-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:notify-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:notify-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:notify-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            //sleep(2);

            $datas = NotifyGroup::orderBy("id", "desc")->get();
            $state_text = array('ไม่เปิดใช้งาน', 'เปิดใช้งาน');
            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->id . '" >';
                })
                ->addColumn('notifydate', function ($row) {
                    $holiday = $row->group_start_th . " - " . $row->group_end_th;
                    return $holiday;
                })
                ->editColumn('status', function ($row) use ($state_text) {
                    $state = $state_text[$row->status];
                    return $state;
                })
                ->addColumn('action', function ($row) {
                    if (Gate::allows('holiday-edit')) {
                        $html = '<button type="button" class="btn btn-sm btn-warning btn-edit" id="getEditData" data-id="' . $row->id . '"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    } else {
                        $html = '<button type="button" class="btn btn-sm btn-warning disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-edit"></i> แก้ไข</button> ';
                    }
                    if (Gate::allows('holiday-delete')) {
                        $html .= '<button type="button" data-rowid="' . $row->id . '" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i> ลบ</button>';
                    } else {
                        $html .= '<button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="bottom" title="คุณไม่มีสิทธิ์ในส่วนนี้"><i class="fa fa-trash"></i> ลบ</button> ';
                    }
                    return $html;
                })->rawColumns(['checkbox', 'action'])->toJson();
        }

        $extension = DB::connection('remote_connection')
            ->table('call_center.agent')
            ->orderBy("number", "asc")->get();

        return view('notify.index')->with(['sound' => $extension]);
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
        $validator = Validator::make($request->all(), [
            'group_name' => 'required|string|max:100',
            'group_start' => 'required',
            'group_end' => 'required',
            'group_extension' => 'required',
            'line_token' => 'required',
            'misscall' => 'required',
            'email' => 'nullable|email',
        ], [
            'group_name.required' => 'ชื่อกลุ่มต้องไม่เป็นค่าว่าง!',
            'group_extension.required' => 'กรุณาระบุ หมายเลข Agent!',
            'line_token.required' => 'กรุณาระบุ Line Token!',
            'misscall.required' => 'กรุณาระบุ Misscall!',
            'group_start.required' => 'กรุณาระบุวันเริ่มต้น!',
            'group_end.required' => 'กรุณาระบุวันสิ้นสุด!',
            'email' => 'กรุณาระบุ Email  ให้ถูกต้อง',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $start_array = explode(" ", $request->get('group_start'));
        // Manually adjust the year from Buddhist to Gregorian calendar
        $sgregorianYear = intval(substr($start_array[0], 6)) - 543;
        $sgregorianDate = $sgregorianYear . substr($start_array[0], 2, 3) . "/" . substr($start_array[0], 0, 2);
        $start_date_convert = Carbon::createFromFormat('Y/m/d', $sgregorianDate, 'Asia/Bangkok');
        $startutcDate = $start_date_convert->setTimezone('UTC');
        $startutcFormattedDate = $startutcDate->format('Y-m-d');


        $end_array = explode(" ", $request->get('group_end'));
        $egregorianYear = intval(substr($end_array[0], 6)) - 543;
        $egregorianDate = $egregorianYear . substr($end_array[0], 2, 3) . "/" . substr($end_array[0], 0, 2);
        $end_date_convert = Carbon::createFromFormat('Y/m/d', $egregorianDate, 'Asia/Bangkok');
        $endutcDate = $end_date_convert->setTimezone('UTC');
        $endutcFormattedDate = $endutcDate->format('Y-m-d');

        $groupExtensionCount = count($request->get('group_extension'));

        $notify = [
            'group_name' => $request->get('group_name'),
            'line_token' => $request->get('line_token'),
            'email' => $request->get('email'),
            'group_extension' => $groupExtensionCount,
            'group_start' =>  $startutcFormattedDate . " " . $start_array[1],
            'group_end' => $endutcFormattedDate . " " . $end_array[1],
            'group_start_th' =>  $request->get('group_start'),
            'group_end_th' => $request->get('group_end'),
            'group_sat' => $request->get('sat'),
            'group_sun' => $request->get('sun'),
            'misscall' => $request->get('misscall'),
            'status' => $request->get('status'),
        ];

        $notify = NotifyGroup::create($notify);

        $extenData = [];


        foreach ($request->get('group_extension') as $ea) {
            $extenData[] = [
                'gid' => $notify->id,
                'extension' => $ea,
            ];
        }

        Notify2Group::insert($extenData);

        return response()->json(['success' => 'เพิ่ม กลุ่มการแจ้งเตือน เรียบร้อยแล้ว']);
    }

    /**
     * Display the specified resource.
     */
    public function show(NotifyGroup $missCallAlert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = NotifyGroup::find($id);
        $datasdate = explode(' ', $data->group_start_th);
        $dataedate = explode(' ', $data->group_end_th);

        $extena = DB::connection('remote_connection')->table('call_center.agent')->orderBy("number", "asc")->get();
        $extens = Notify2Group::where('gid', $data->id)->get();

        $select_list_exten = $extena->map(function ($exten) use ($extens) {
            $selected = $extens->contains('extension', $exten->number) ? 'selected' : '';
            return '<option value="' . $exten->number . '" ' . $selected . '> ' . $exten->number . '</option>';
        })->implode('');

        return response()->json([
            'data' => $data,
            'select_list_exten' => $select_list_exten,
            'datasdate' => $datasdate[0],
            'datastime' => $datasdate[1],
            'dataedate' => $dataedate[0],
            'dataetime' => $dataedate[1]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'group_name' => 'required|string|max:100',
            'group_start' => 'required',
            'group_end' => 'required',
            'group_extension' => 'required',
            'line_token' => 'required',
            'misscall' => 'required',
            'email' => 'nullable|email',
        ];

        $validator = Validator::make($request->all(), $rules, [
            'group_name.required' => 'ชื่อกลุ่มต้องไม่เป็นค่าว่าง!',
            'group_extension.required' => 'กรุณาระบุ หมายเลข Agent!',
            'line_token.required' => 'กรุณาระบุ Line Token!',
            'misscall.required' => 'กรุณาระบุ Misscall!',
            'group_start.required' => 'กรุณาระบุวันเริ่มต้น!',
            'group_end.required' => 'กรุณาระบุวันสิ้นสุด!',
            'email' => 'กรุณาระบุ Email  ให้ถูกต้อง',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $start_array = explode(" ", $request->get('group_start'));
        $sgregorianYear = intval(substr($start_array[0], 6)) - 543;
        $sgregorianDate = $sgregorianYear . substr($start_array[0], 2, 3) . "/" . substr($start_array[0], 0, 2);
        $start_date_convert = Carbon::createFromFormat('Y/m/d', $sgregorianDate, 'Asia/Bangkok');
        $startutcDate = $start_date_convert->setTimezone('UTC');
        $startutcFormattedDate = $startutcDate->format('Y-m-d');


        $end_array = explode(" ", $request->get('group_end'));
        $egregorianYear = intval(substr($end_array[0], 6)) - 543;
        $egregorianDate = $egregorianYear . substr($end_array[0], 2, 3) . "/" . substr($end_array[0], 0, 2);
        $end_date_convert = Carbon::createFromFormat('Y/m/d', $egregorianDate, 'Asia/Bangkok');
        $endutcDate = $end_date_convert->setTimezone('UTC');
        $endutcFormattedDate = $endutcDate->format('Y-m-d');

        $groupExtensionCount = count($request->get('group_extension'));

        $notify = [
            'group_name' => $request->get('group_name'),
            'line_token' => $request->get('line_token'),
            'email' => $request->get('email'),
            'group_extension' => $groupExtensionCount,
            'group_start' =>  $startutcFormattedDate . " " . $start_array[1],
            'group_end' => $endutcFormattedDate . " " . $end_array[1],
            'group_start_th' =>  $request->get('group_start'),
            'group_end_th' => $request->get('group_end'),
            'group_sat' => $request->get('sat'),
            'group_sun' => $request->get('sun'),
            'misscall' => $request->get('misscall'),
            'status' => $request->get('status'),
        ];


        $update = NotifyGroup::find($id);
        $update->update($notify);

        Notify2Group::where('gid', $id)->delete();

        foreach ($request->get('group_extension') as $ea) {
            $extenData[] = [
                'gid' => $id,
                'extension' => $ea,
            ];
        }

        Notify2Group::insert($extenData);

        return response()->json(['success' => 'แก้ไข กลุ่มการแจ้งเตือน เรียบร้อยแล้ว']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        Notify2Group::where('gid', $id)->delete();
        NotifyGroup::find($id)->delete();
        return ['success' => true, 'message' => 'ลบ กลุ่มการแจ้งเตือน เรียบร้อยแล้ว'];
    }

    public function destroy_all(Request $request)
    {

        $arr_del  = $request->get('table_records'); //$arr_ans is Array MacAddress

        for ($xx = 0; $xx < count($arr_del); $xx++) {
            Notify2Group::where('gid', $arr_del[$xx])->delete();
            NotifyGroup::find($arr_del[$xx])->delete();
        }

        return redirect('/notify')->with('success', 'ลบ กลุ่มการแจ้งเตือน เรียบร้อยแล้ว');
    }
}
