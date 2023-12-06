@extends('layouts.app_top')
@section('style')
    @include('dashboard.style')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3" style="text-align: right;">

                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i
                                        class="fa-solid fa-arrow-right-to-bracket"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">สายทั้งหมด</span>
                                    <span class="info-box-number"><span id="allcall">0</span> ครั้ง</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-regular fa-thumbs-up"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">สายที่ได้รับ</span>
                                    <span class="info-box-number"><span id="completed">0</span> ครั้ง</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-solid fa-phone-slash"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">สายที่พลาด</span>
                                    <span class="info-box-number"><span id="abandoned">0</span> ครั้ง</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-solid fa-percent"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> เปอร์เซ็นต์
                                        สายที่พลาด</span>
                                    <span class="info-box-number"><span id="abandoned_percent">0.0</span> %</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-regular fa-hourglass"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">เวลารอสายเฉลี่ย
                                        ต่อสาย</span>
                                    <span class="info-box-number"><span id="avg_wait">00:00:00</span></span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-solid fa-headset"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เวลาที่สนทนาทั้งหมด</span>
                                    <span class="info-box-number"><span id="total_talk">00:00:00</span></span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-solid fa-phone-volume"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เวลาสนทนาเฉลี่ยต่อสาย</span>
                                    <span class="info-box-number"><span id="avg_talk">00:00:00</span></span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-solid fa-clock"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เวลารอสายที่นานที่สุด</span>
                                    <span class="info-box-number"><span id="max_wait">00:00:00</span></span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-solid fa-clipboard-question"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เคสที่รับแจ้ง</span>
                                    <span class="info-box-number"><span id="total_case">0</span> เคส</span>
                                </div>

                            </div>

                        </div>


                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-solid fa-clipboard-check"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เคสที่ปิดเคสแล้ว</span>
                                    <span class="info-box-number"><span id="total_close_case">0</span> เคส</span>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-solid fa-shuffle"></i></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เคสที่โอนสาย</span>
                                    <span class="info-box-number"><span id="total_tranfer_case">0</span> เคส</span>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-solid fa-star"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">คะแนนความพึงพอใจ</span>
                                    <span class="info-box-number">ล่าสุด <span id="latest_score">0</span> / ทั้งหมด
                                        <span id="total_score">0</span></span>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">

                            <div class="card card-primary" style="min-height: 440px">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa-solid fa-gauge"></i> สายที่กำลังรอสาย
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                            <i class="fas fa-expand"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row chart">
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-center align-items-center"
                                                id="queue_status_chart" style="height:350px;"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="card card-primary" style="min-height: 440px">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa-solid fa-gauge"></i> สายที่กำลังสนทนา
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                            <i class="fas fa-expand"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="row chart">
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-center align-items-center"
                                                id="queue_status_chart_talk" style="height:350px;"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="col-md-4">

                            <div class="card card-primary" style="max-height: 440px">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa-solid fa-gauge"></i> สถานะพนักงานรับสาย ( Agent
                                        Status )
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                            <i class="fas fa-expand"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-center align-items-center"
                                            id="agent_status_chart" style="height:350px;"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">

                            <div class="card card-primary" style="min-height: 440px">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa-solid fa-gauge"></i> สายที่รออยู่ในคิว ( Call
                                        Waiting ) </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                            <i class="fas fa-expand"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title"></h3>
                                                    {{--  <div class="card-tools">
                                                        <div class="input-group input-group-sm" style="width: 150px;">
                                                            <input type="text" name="table_search"
                                                                class="form-control float-right" placeholder="Search">
                                                            <div class="input-group-append">
                                                                <button type="submit" class="btn btn-default">
                                                                    <i class="fas fa-search"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>

                                                <div class="card-body table-responsive p-0">
                                                    <table id="waiting_list"
                                                        class="table table-striped table-bordered table-hover text-nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>หมายเลขผู้โทร</th>
                                                                <th>ระยะเวลารอสาย</th>
                                                                <th>Queue</th>
                                                                <th>Agent</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="5" style="text-align: center;">
                                                                    ยังไม่มีสายรอในคิว</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="card card-primary" style="max-height: 440px">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa-solid fa-gauge"></i> ระดับการให้บริการ ( Service
                                        Level )</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                            <i class="fas fa-expand"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <div class="col-md-12 text-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <h6 class="mb-0 mr-3">สายที่รับภายใน</h6>
                                                <select style="width: 75px" class="form-control" name="modal_sla"
                                                    id="modal_sla">
                                                    <option value="5">5</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="30">30</option>
                                                    <option value="35">35</option>
                                                    <option value="40">40</option>
                                                    <option value="45">45</option>
                                                    <option value="50">50</option>
                                                    <option value="55">55</option>
                                                    <option value="60">60</option>
                                                </select>
                                                <h6 class="ml-3 mb-0">วินาที</h6>
                                            </div>
                                            <!-- {{-- <i class="fa fa-edit" data-toggle="modal" data-target="#configModal"></i> --}} -->
                                            <div class="d-flex justify-content-center align-items-center"
                                                id="agent_sla_chart" style="height:300px;"></div>
                                            <div class="float-right "><i class="fa fa-refresh fa-spin "></i> <span
                                                    class="c" id="30"></span> sec</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="card card-primary" style="min-height: 405px">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa-solid fa-gauge"></i> รายชื่อพนักงานรับสาย ( Agent
                                        List )
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                            <i class="fas fa-expand"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title"></h3>
                                                    {{--  <div class="card-tools">
                                                        <div class="input-group input-group-sm" style="width: 150px;">
                                                            <input type="text" name="table_search"
                                                                class="form-control float-right" placeholder="Search">
                                                            <div class="input-group-append">
                                                                <button type="submit" class="btn btn-default">
                                                                    <i class="fas fa-search"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>

                                                <div class="card-body">
                                                    <table id="agent_list"
                                                        class="table table-striped table-bordered table-hover text-nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>ชื่อ Agent</th>
                                                                <th style="text-align: center;">หมายเลข Agent</th>
                                                                <th>สถานะ</th>
                                                                <th style="text-align: center;">ระยะเวลา</th>
                                                                <th style="text-align: center;">หมายเลขผู้โทร</th>
                                                                <th style="text-align: center;">Queue</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>



                    </div>

                </div>

            </div>

        </div>

    </section>

    <div class="modal fade" id="configModal" tabindex="-1" role="dialog" aria-labelledby="configModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning" style="padding-bottom: 2em;">
                    <h4 class="modal-title"><i class="fa-solid fa-gauge-high"></i> SLA Setting</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="4071">
                    <div class="modal-body">
                        {{--  <label for="sla">เลือกระดับเวลาการให้บริการที่ต้องการแสดงผล :</label>
                        <select class="form-control" name="modal_sla" id="modal_sla">
                            <option value="5">5s</option>
                            <option value="10">10s</option>
                            <option value="15">15s</option>
                            <option value="20">20s</option>
                            <option value="25">25s</option>
                            <option value="30">30s</option>
                        </select>
                        <input type="hidden" name="queuesla" value="4071"> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-door-closed"></i> ปิดหน้าต่าง</button>
                        {{--  <button type="submit" class="btn btn-primary" id="set_sla"><i class="fas fa-download"></i>
                            บันทึก</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('dashboard.script')
@endsection
