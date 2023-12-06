<?php

namespace App\Http\Controllers;

use App\Models\Holidays;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class HolidaysController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('permission:holiday-list|holiday-create|holiday-edit|holiday-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:holiday-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:holiday-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:holiday-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            //sleep(2);

            $datas = Holidays::orderBy("id", "desc")->get();
            $state_text = array('ไม่เปิดใช้งาน', 'เปิดใช้งาน');
            return datatables()->of($datas)
                ->editColumn('checkbox', function ($row) {
                    return '<input type="checkbox" id="' . $row->id . '" class="flat" name="table_records[]" value="' . $row->id . '" >';
                })
                ->addColumn('holidaydate', function ($row) {
                    $holiday = $row->start_datetime_th . " - " . $row->end_datetime_th;
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

        $sound = DB::connection('remote_connection')
            ->table('asterisk.recordings')
            ->orderBy("displayname", "asc")->get();

        return view('holiday.index')->with(['sound' => $sound]);
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
        $validator =  Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'holiday_sound' => 'required',
            'thankyou_sound' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ], [
            'name.required' => 'ชื่อต้องไม่เป็นค่าว่าง!',
            'holiday_sound.required' => 'กรุณาระบุเสียงวันหยุด!',
            'thankyou_sound.required' => 'กรุณาระบุเสียงขอบคุณ!',
            'start_date.required' => 'กรุณาระบุวันเริ่มต้น!',
            'end_date.required' => 'กรุณาระบุวันสิ้นสุด!',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $start_array = explode(" ", $request->get('start_date'));
        // Manually adjust the year from Buddhist to Gregorian calendar
        $sgregorianYear = intval(substr($start_array[0], 6)) - 543;
        $sgregorianDate = $sgregorianYear . substr($start_array[0], 2, 3) . "/" . substr($start_array[0], 0, 2);
        $start_date_convert = Carbon::createFromFormat('Y/m/d', $sgregorianDate, 'Asia/Bangkok');
        $startutcDate = $start_date_convert->setTimezone('UTC');
        $startutcFormattedDate = $startutcDate->format('Y-m-d');


        $end_array = explode(" ", $request->get('end_date'));
        $egregorianYear = intval(substr($end_array[0], 6)) - 543;
        $egregorianDate = $egregorianYear . substr($end_array[0], 2, 3) . "/" . substr($end_array[0], 0, 2);
        $end_date_convert = Carbon::createFromFormat('Y/m/d', $egregorianDate, 'Asia/Bangkok');
        $endutcDate = $end_date_convert->setTimezone('UTC');
        $endutcFormattedDate = $endutcDate->format('Y-m-d');

        $holiday = [
            'name' => $request->get('name'),
            'holiday_sound' => $request->get('holiday_sound'),
            'thankyou_sound' => $request->get('thankyou_sound'),
            'start_datetime' =>  $startutcFormattedDate . " " . $start_array[1] . ":00",
            'end_datetime' => $endutcFormattedDate . " " . $end_array[1] . ":00",
            'start_datetime_th' =>  $request->get('start_date'),
            'end_datetime_th' => $request->get('end_date'),
            'status' => $request->get('status'),
        ];

        Holidays::create($holiday);

        return response()->json(['success' => 'เพิ่ม วันหยุดประจำปี เรียบร้อยแล้ว']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Holidays $holidays)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data =  Holidays::find($id);
        $datasdate = explode(' ', $data->start_datetime_th);
        $dataedate = explode(' ', $data->end_datetime_th);
        return response()->json([
            'data' => $data,
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
            'name' => 'required|string|max:100',
            'holiday_sound' => 'required',
            'thankyou_sound' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, [
            'name.required' => 'ชื่อต้องไม่เป็นค่าว่าง!',
            'holiday_sound.required' => 'กรุณาระบุเสียงวันหยุด!',
            'thankyou_sound.required' => 'กรุณาระบุเสียงขอบคุณ!',
            'start_date.required' => 'กรุณาระบุวันเริ่มต้น!',
            'end_date.required' => 'กรุณาระบุวันสิ้นสุด!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $start_array = explode(" ", $request->get('start_date'));
        // Manually adjust the year from Buddhist to Gregorian calendar
        $sgregorianYear = intval(substr($start_array[0], 6)) - 543;
        $sgregorianDate = $sgregorianYear . substr($start_array[0], 2, 3) . "/" . substr($start_array[0], 0, 2);
        $start_date_convert = Carbon::createFromFormat('Y/m/d', $sgregorianDate, 'Asia/Bangkok');
        $startutcDate = $start_date_convert->setTimezone('UTC');
        $startutcFormattedDate = $startutcDate->format('Y-m-d');


        $end_array = explode(" ", $request->get('end_date'));
        $egregorianYear = intval(substr($end_array[0], 6)) - 543;
        $egregorianDate = $egregorianYear . substr($end_array[0], 2, 3) . "/" . substr($end_array[0], 0, 2);
        $end_date_convert = Carbon::createFromFormat('Y/m/d', $egregorianDate, 'Asia/Bangkok');
        $endutcDate = $end_date_convert->setTimezone('UTC');
        $endutcFormattedDate = $endutcDate->format('Y-m-d');

        $holiday = [
            'name' => $request->get('name'),
            'holiday_sound' => $request->get('holiday_sound'),
            'thankyou_sound' => $request->get('thankyou_sound'),
            'start_datetime' =>  $startutcFormattedDate . " " . $start_array[1] . ":00",
            'end_datetime' => $endutcFormattedDate . " " . $end_array[1] . ":00",
            'start_datetime_th' =>  $request->get('start_date'),
            'end_datetime_th' => $request->get('end_date'),
            'status' => $request->get('status'),
        ];


        $update = Holidays::find($id);
        $update->update($holiday);

        return response()->json(['success' => 'แก้ไข วันหยุดประจำปี เรียบร้อยแล้ว']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        Holidays::find($id)->delete();
        return ['success' => true, 'message' => 'ลบ วันหยุดประจำปี เรียบร้อยแล้ว'];
    }

    public function destroy_all(Request $request)
    {

        $arr_del  = $request->get('table_records'); //$arr_ans is Array MacAddress

        for ($xx = 0; $xx < count($arr_del); $xx++) {
            Holidays::find($arr_del[$xx])->delete();
        }

        return redirect('/holiday')->with('success', 'ลบ วันหยุดประจำปี เรียบร้อยแล้ว');
    }
}
