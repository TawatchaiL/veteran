@extends('layouts.app_top')
@section('style')
    <style>
        .alignment {
            text-align: center;
        }

        p.font {
            font-size: 36px;
            font-weight: normal;
            margin: 0;
            color: #4b7ef5
        }

        .info-box-number {
            font-size: 24px;
            font-weight: normal;
            margin: 0;
            color: #4b7ef5
        }

        .status-icon {
            font-size: 1.2em;
            /* Adjust the size of the icon */
            margin-right: 5px;
            /* Add some spacing between the icon and text */
        }

        .offline {
            color: gray;
        }

        .online {
            color: green;
        }
    </style>
@endsection

@section('content')
    {{-- <div class="container-fluid">
        <h1 class="text-black-50">You are logged in!</h1>
        <canvas id="signature-pad" width="400" height="200"></canvas>
        <button id="save-signature">Save Signature</button>
        <button id="clear-signature">Clear Signature</button>
        <img id="signature-image" src="" alt="Signature Image">
    </div> --}}

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">

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
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-square-phone"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">สายทั้งหมด</span>
                                    <span class="info-box-number">0 ครั้ง</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fa-regular fa-thumbs-up"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">สายที่ได้รับ</span>
                                    <span class="info-box-number">0 ครั้ง</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fa-solid fa-phone-slash"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">สายที่พลาด</span>
                                    <span class="info-box-number">0 ครั้ง</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-solid fa-percent"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> เปอร์เซ็นต์
                                        สายที่พลาด</span>
                                    <span class="info-box-number">0.0 %</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-regular fa-hourglass"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">เวลารอสายเฉลี่ย</span>
                                    <span class="info-box-number">00:00:12</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-headset"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เวลาที่สนทนาทั้งหมด</span>
                                    <span class="info-box-number">00:38:43</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fa-solid fa-phone-volume"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เวลาสนทนาเฉลี่ยต่อสาย</span>
                                    <span class="info-box-number"> 00:05:12</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fa-solid fa-clock"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เวลารอสายที่นานที่สุด</span>
                                    <span class="info-box-number"> 00:06:12</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fa-solid fa-clipboard"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เคสที่รับแจ้ง</span>
                                    <span class="info-box-number">10 เคส</span>
                                </div>

                            </div>

                        </div>


                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-laptop-medical"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เคสที่ปิดเคสแล้ว</span>
                                    <span class="info-box-number">4 เคส</span>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-solid fa-shuffle"></i></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เคสที่โอนสาย</span>
                                    <span class="info-box-number">6 เคส</span>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fa-solid fa-star"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">คะแนนความพึงพอใจ</span>
                                    <span class="info-box-number">10 คะแนน</span>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4">

                            <div class="card card-primary">
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
                                            <h6>สายที่รับภายใน
                                                <a tabindex="0" title="Dismissible popover" data-toggle="popover"
                                                    data-trigger="focus" data-placement="bottom"
                                                    data-content="สายที่รับภายใน 20 วินาที"><i
                                                        class="fa fa-info-circle"></i></a>&emsp;
                                                20 วินาที <i class="fa fa-edit" data-toggle="modal"
                                                    data-target="#configModal4071"></i>
                                            </h6>
                                            <div id="mainbc2_4071" style="height:200px;"></div>
                                            <div class="float-right "><i class="fa fa-refresh fa-spin "></i> <span
                                                    class="c" id="30"></span> sec</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa-solid fa-gauge"></i> สถานะการรับสาย ( Queue
                                        Summary )
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
                                    <div class="chart">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <div class="alignment info-box-number" id="">
                                                        <p class="font" id="aban_4075">0</p>
                                                    </div>
                                                    <p class="alignment"><i class="fa-solid fa-phone-slash"></i>
                                                        สายที่พลาด</p>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <div class="alignment info-box-number" id="ahtd">
                                                        <p class="font" id="aht_4075">00:00</p>
                                                    </div>
                                                    <p class="alignment"><i class="fa-solid fa-phone-volume"></i>
                                                        เวลาสนทนาเฉลี่ย<br>ต่อสาย</p>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <div class="alignment info-box-number" id="asad">
                                                        <p class="font" id="asa_4075">00:00</p>
                                                    </div>
                                                    <p class="alignment"><i class="fa-regular fa-hourglass"></i>
                                                        เวลารอสายเฉลี่ย<br>ต่อสาย</p>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <div class="alignment info-box-number" id="">
                                                        <p class="font" id="abanrate_4075">0.0%</p>
                                                    </div>
                                                    <p class="alignment"><i class="fa-solid fa-percent"></i>
                                                        เปอร์เซ็นต์<br />สายที่พลาด</p>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <div class="alignment info-box-number" id="">
                                                        <p class="font" id="total_4075">0</p>
                                                    </div>
                                                    <p class="alignment"><i class="fa-solid fa-square-phone"></i>
                                                        สายทั้งหมด</p>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <div class="alignment info-box-number" id="">
                                                        <p class="font" id="ans_4075">0</p>
                                                    </div>
                                                    <p class="alignment"><i class="fa-regular fa-thumbs-up"></i>
                                                        สายที่่ได้รับ</p>
                                                </div>
                                            </div>
                                            <div class="" style="visibility: collapse;">block</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa-solid fa-gauge"></i> สถานะเรียลไทม์ ( Queue Status
                                        )
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
                                    <div class="chart">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <!-- class alignment ไว้ทำ css -->
                                                    <div class="alignment info-box-number" id="">
                                                        <p class="font" id="waiting_4071">0</p>
                                                    </div>
                                                    <p class="alignment"><i class="fa-solid fa-user-clock"></i>
                                                        สายที่กำลังรอสาย</p>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <div class="alignment info-box-number" id="">
                                                        <p class="font" id="maxwl_4071">00:00</p>
                                                    </div>
                                                    <p class="alignment"><i class="fa-regular fa-clock"></i>
                                                        เวลารอสายที่นานที่สุด</p>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <div class="alignment info-box-number" id="">
                                                        <p class="font" id="outw_4071">0</p>
                                                    </div>
                                                    <p class="alignment"><i class="fa-solid fa-pause"></i> จำนวน Agent
                                                        ที่พัก</p>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <div class="alignment info-box-number">
                                                        <p class="font" id="active_4071">0</p>
                                                    </div>
                                                    <p class="alignment"><i class="fa-solid fa-microphone"></i>
                                                        สายที่กำลัง<br />สนทนา</p>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <div class="alignment info-box-number" id="">
                                                        <p class="font" id="agents_4071">0/0</p>
                                                    </div>
                                                    <p class="alignment"><i class="fa-solid fa-users"></i> จำนวน Agent
                                                        <br>Online/Ready
                                                    </p>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <div class="alignment info-box-number" id="">
                                                        <p class="font" id="outa_4071">00:00</p>
                                                    </div>
                                                    <p class="alignment"><i class="fa-solid fa-clock-rotate-left"></i>
                                                        เวลาพักสายรวม</p>
                                                </div>
                                            </div>
                                            <div class="" style="visibility: collapse;">block</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">

                            <div class="card card-primary">
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
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title"></h3>
                                                    <div class="card-tools">
                                                        <div class="input-group input-group-sm" style="width: 150px;">
                                                            <input type="text" name="table_search"
                                                                class="form-control float-right" placeholder="Search">
                                                            <div class="input-group-append">
                                                                <button type="submit" class="btn btn-default">
                                                                    <i class="fas fa-search"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body table-responsive p-0">
                                                    <table class="table table-striped table-bordered table-hover text-nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>หมายเลข Agent</th>
                                                                <th>ชื่อ Agent</th>
                                                                <th>สถานะ</th>
                                                                <th>หมายเลขผู้โทร</th>
                                                                <th>ระยะเวลา</th>
                                                                <th>Queue</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>1234</td>
                                                                <td><i class="fa-solid fa-user"></i> Agent1</td>
                                                                <td><i class="fas fa-power-off status-icon offline"></i> <font class="offline">Offline</font></td>
                                                                <td></td>
                                                                <td>00:00:00</td>
                                                                <td></td>
                                                                <td><img src="{{ asset('images/pauseagent.gif') }}"><img src="{{ asset('images/logout-icon.png') }}"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>1235</td>
                                                                <td><i class="fa-solid fa-user"></i> Agent2</td>
                                                                <td> <i class="fas fa-power-off status-icon offline"></i> <font class="offline">Offline</font>
                                                                </td>
                                                                <td></td>
                                                                <td>00:00:00</td>
                                                                <td></td>
                                                                <td><img src="{{ asset('images/pauseagent.gif') }}"><img src="{{ asset('images/logout-icon.png') }}"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td>1236</td>
                                                                <td><i class="fa-solid fa-user"></i> Agent3</td>
                                                                <td><i class="fa-solid fa-plug status-icon online"></i> <font class="online">Online</font>
                                                                </td>
                                                                <td></td>
                                                                <td>00:00:00</td>
                                                                <td></td>
                                                                <td><img src="{{ asset('images/pauseagent.gif') }}"><img src="{{ asset('images/logout-icon.png') }}"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>4</td>
                                                                <td>1237</td>
                                                                <td><i class="fa-solid fa-user"></i> Agent4</td>
                                                                <td> <i class="fas fa-power-off status-icon offline"></i> <font class="offline">Offline</font>
                                                                </td>
                                                                <td></td>
                                                                <td>00:00:00</td>
                                                                <td></td>
                                                                <td><img src="{{ asset('images/pauseagent.gif') }}"><img src="{{ asset('images/logout-icon.png') }}"></td>
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

                            <div class="card card-primary">
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
                                                    <div class="card-tools">
                                                        <div class="input-group input-group-sm" style="width: 150px;">
                                                            <input type="text" name="table_search"
                                                                class="form-control float-right" placeholder="Search">
                                                            <div class="input-group-append">
                                                                <button type="submit" class="btn btn-default">
                                                                    <i class="fas fa-search"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body table-responsive p-0">
                                                    <table class="table table-striped table-bordered table-hover text-nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>หมายเลขผู้โทร</th>
                                                                <th>ระยะเวลา</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td><i class="fa-solid fa-user-clock"></i> 0819152998</td>
                                                                <td>00:02:00</td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td><i class="fa-solid fa-user-clock"></i> 0819162778</td>
                                                                <td>00:01:15</td>
                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td><i class="fa-solid fa-user-clock"></i> 0813152898</td>
                                                                <td>00:01:00</td>
                                                            </tr>
                                                            <tr>
                                                                <td>4</td>
                                                                <td><i class="fa-solid fa-user-clock"></i> 0813482977</td>
                                                                <td>00:00:20</td>
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
                    </div>

                </div>

            </div>

        </div>

    </section>

    <div class="modal fade" id="configModal4071" tabindex="-1" role="dialog" aria-labelledby="configModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success" style="padding-bottom: 2em;">
                    <h4 class="modal-title"><i class="fa-solid fa-gauge-high"></i> SLA Setting</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="4071">
                    <div class="modal-body">
                        <label for="sla">เลือกระดับเวลาการให้บริการที่ต้องการแสดงผล :</label>
                        <select class="form-control" name="modal_sla" name="modal_sla">
                            <option value="5">5s</option>
                            <option value="10">10s</option>
                            <option value="15">15s</option>
                            <option value="20" selected>20s</option>
                            <option value="25">25s</option>
                            <option value="30">30s</option>
                        </select>
                        <input type="hidden" name="queuesla" value="4071">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-door-closed"></i> ปิดหน้าต่าง</button>
                        <button type="submit" class="btn btn-primary" id="save"><i class="fas fa-download"></i>
                            บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script language="javascript" type="text/javascript">
        function generateRandomData(length) {
            const data = [];
            for (let i = 0; i < length; i++) {
                const entered = Math.floor(Math.random() * 100) +
                    1; // Generate a random value between 1 and 50 (greater than 0)
                const received = entered + Math.floor(Math.random() * (100 -
                    entered)); // Generate a random value less than or equal to 'สายเข้า'
                data.push([entered, received]);
            }
            return data;
        }

        function generateTimeLabels(count) {
            const labels = [];
            for (let i = 0; i < count; i++) {
                const startHour = i * 2;
                const endHour = startHour + 1;
                const label = `${startHour.toString().padStart(2, '0')}:00-${endHour.toString().padStart(2, '0')}:59`;
                labels.push(label);
            }
            return labels;
        }

        $(document).ready(function() {
            var pie4071 = echarts.init(document.getElementById("mainbc2_4071"));

            option4071 = {
                series: [{
                        type: 'gauge',
                        center: ["50%", "60%"],
                        startAngle: 200,
                        endAngle: -20,
                        min: 0,
                        max: 100,
                        splitNumber: 5,
                        itemStyle: {
                            color: '#FFAB91'
                        },
                        progress: {
                            show: true,
                            width: 20
                        },

                        pointer: {
                            show: false,
                        },
                        axisLine: {
                            lineStyle: {
                                width: 20
                            }
                        },
                        axisTick: {
                            distance: -45,
                            splitNumber: 5,
                            lineStyle: {
                                width: 2,
                                color: '#999'
                            }
                        },
                        splitLine: {
                            distance: -45,
                            length: 14,
                            lineStyle: {
                                width: 2,
                                color: '#999'
                            }
                        },
                        axisLabel: {
                            distance: -20,
                            color: '#999',
                            fontSize: 12
                        },
                        anchor: {
                            show: false
                        },
                        title: {
                            show: false
                        },
                        detail: {
                            valueAnimation: true,
                            width: '60%',
                            lineHeight: 40,
                            height: '15%',
                            borderRadius: 8,
                            offsetCenter: [0, '-15%'],
                            fontSize: 20,
                            fontWeight: 'bolder',
                            formatter: '{value} %',
                            color: 'auto'
                        },
                        data: [{
                            value: 73
                        }]
                    },

                    {
                        type: 'gauge',
                        center: ["50%", "60%"],
                        startAngle: 200,
                        endAngle: -20,
                        min: 0,
                        max: 100,
                        itemStyle: {
                            color: '#FD7347',
                        },
                        progress: {
                            show: true,
                            width: 8
                        },

                        pointer: {
                            show: false
                        },
                        axisLine: {
                            show: false
                        },
                        axisTick: {
                            show: false
                        },
                        splitLine: {
                            show: false
                        },
                        axisLabel: {
                            show: false
                        },
                        detail: {
                            show: false
                        },
                        data: [{
                            value: 73,
                        }]

                    }
                ],
            };

            pie4071.setOption(option4071);
        })

        function c() {
            var n = $('.c').attr('id');
            var c = n;
            $('.c').text(c);
            setInterval(function() {
                c--;
                if (c >= 0) {
                    $('.c').text(c);
                }
                if (c == 0) {
                    $('.c').text(n);
                }
            }, 1000);
        }

        // Start
        c();

        // Loop
        setInterval(function() {
            c();
        }, 30000);
    </script>
@endsection
