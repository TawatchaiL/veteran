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
                ->editColumn('status', function ($row) use ($state_text) {
                    $state = $state_text[$row->set_default];
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
        $start_date_convert = Carbon::createFromFormat('d/m/Y', $start_array[0], 'Asia/Bangkok');
        $startutcDate = $start_date_convert->setTimezone('UTC');
        $startutcFormattedDate = $startutcDate->format('Y-m-d');


        $end_array = explode(" ", $request->get('end_date'));
        $end_date_convert = Carbon::createFromFormat('d/m/Y', $end_array[0], 'Asia/Bangkok');
        $endutcDate = $end_date_convert->setTimezone('UTC');
        $endutcFormattedDate = $endutcDate->format('Y-m-d');

        $holiday = [
            'name' => $request->get('name'),
            'holiday_sound' => $request->get('holiday_sound'),
            'thankyou_sound' => $request->get('thankyou_sound'),
            'start_datetime' =>  $startutcFormattedDate . " " . $start_array[1] . ":00",
            'end_datetime' => $endutcFormattedDate . " " . $end_array[1] . ":00",
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
    public function edit(Holidays $holidays)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Holidays $holidays)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Holidays $holidays)
    {
        //
    }
}
