@extends('layouts.app_top')
@section('style')
    @include('dashboard.style')
@endsection

@section('content')
    {{-- <div class="container-fluid">
        <h1 class="text-black-50">You are logged in!</h1>
        <canvas id="signature-pad" width="400" height="200"></canvas>
        <button id="save-signature">Save Signature</button>
        <button id="clear-signature">Clear Signature</button>
        <img id="signature-image" src="" alt="Signature Image">
    </div> --}}

    {{--  <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3" style="text-align: right;">
                    <div class="form-group">
                        <label for="redirectSelect">Queue:</label>
                        <select id="redirectSelect" class="custom-select form-control-border">
                            @foreach ($queue as $queueItem)
                                <option value="{{ $queueItem->extension }}">{{ $queueItem->descr }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <label for="redirectSelect">Queue:</label>
                            <select id="redirectSelect"
                                class="custom-select form-control-border">
                                @foreach ($queue as $queueItem)
                                    <option value="{{ $queueItem->extension }}">{{ $queueItem->descr }}</option>
                                @endforeach
                            </select></li>
                    </ol>
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
                                <span class="info-box-icon bg-success"><i
                                        class="fa-solid fa-arrow-right-to-bracket"></i></span>
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
                                <span class="info-box-icon bg-success"><i class="fa-solid fa-phone-slash"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">สายที่พลาด</span>
                                    <span class="info-box-number">0 ครั้ง</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fa-solid fa-percent"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> เปอร์เซ็นต์
                                        สายที่พลาด</span>
                                    <span class="info-box-number">0.0 %</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fa-regular fa-hourglass"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">เวลารอสายเฉลี่ย
                                        ต่อสาย</span>
                                    <span class="info-box-number">00:00:12</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fa-solid fa-headset"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เวลาที่สนทนาทั้งหมด</span>
                                    <span class="info-box-number">00:38:43</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fa-solid fa-phone-volume"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เวลาสนทนาเฉลี่ยต่อสาย</span>
                                    <span class="info-box-number"> 00:05:12</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fa-solid fa-clock"></i></span>
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
                                <span class="info-box-icon bg-success"><i class="fa-solid fa-clipboard-question"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เคสที่รับแจ้ง</span>
                                    <span class="info-box-number">10 เคส</span>
                                </div>

                            </div>

                        </div>


                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fa-solid fa-clipboard-check"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เคสที่ปิดเคสแล้ว</span>
                                    <span class="info-box-number">4 เคส</span>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fa-solid fa-shuffle"></i></i></span>
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

                            <div class="card card-primary" style="min-height: 440px">
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
                                                &nbsp;
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <!-- class alignment ไว้ทำ css -->
                                                    <div class="alignment info-box-number" id="">
                                                        <p class="font" id="waiting_4071">0</p>
                                                    </div>
                                                    <p class="alignment"><i class="fa-solid fa-user-clock"></i>
                                                        สายที่ <br>กำลังรอสาย</p>
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <div class="alignment info-box-number">
                                                        <p class="font" id="active_4071">0</p>
                                                    </div>
                                                    <p class="alignment"><i class="fa-solid fa-phone-volume"></i>
                                                        สายที่<br>กำลังสนทนา</p>
                                                </div>

                                            </div>
                                            <div class="" style="visibility: collapse;">block</div>
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
                                            <h6>สายที่รับภายใน

                                                20 วินาที <i class="fa fa-edit" data-toggle="modal"
                                                    data-target="#configModal4071"></i>
                                            </h6>
                                            <div id="mainbc2_4071" style="height:300px;"></div>
                                            <div class="float-right "><i class="fa fa-refresh fa-spin "></i> <span
                                                    class="c" id="30"></span> sec</div>
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
                                        <div id="mainbc2_4072" style="height:350px;"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">

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
                                                    <table
                                                        class="table table-striped table-bordered table-hover text-nowrap">
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
                                                                <td><i class="fas fa-power-off status-icon offline"></i>
                                                                    <font class="offline">Offline</font>
                                                                </td>
                                                                <td></td>
                                                                <td>00:00:00</td>
                                                                <td></td>
                                                                <td><img src="{{ asset('images/pauseagent.gif') }}"><img
                                                                        src="{{ asset('images/logout-icon.png') }}"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>1235</td>
                                                                <td><i class="fa-solid fa-user"></i> Agent2</td>
                                                                <td> <i class="fas fa-power-off status-icon offline"></i>
                                                                    <font class="offline">Offline</font>
                                                                </td>
                                                                <td></td>
                                                                <td>00:00:00</td>
                                                                <td></td>
                                                                <td><img src="{{ asset('images/pauseagent.gif') }}"><img
                                                                        src="{{ asset('images/logout-icon.png') }}"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td>1236</td>
                                                                <td><i class="fa-solid fa-user"></i> Agent3</td>
                                                                <td><i class="fa-solid fa-plug status-icon online"></i>
                                                                    <font class="online">Online</font>
                                                                </td>
                                                                <td></td>
                                                                <td>00:00:00</td>
                                                                <td></td>
                                                                <td><img src="{{ asset('images/pauseagent.gif') }}"><img
                                                                        src="{{ asset('images/logout-icon.png') }}"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>4</td>
                                                                <td>1237</td>
                                                                <td><i class="fa-solid fa-user"></i> Agent4</td>
                                                                <td> <i class="fas fa-power-off status-icon offline"></i>
                                                                    <font class="offline">Offline</font>
                                                                </td>
                                                                <td></td>
                                                                <td>00:00:00</td>
                                                                <td></td>
                                                                <td><img src="{{ asset('images/pauseagent.gif') }}"><img
                                                                        src="{{ asset('images/logout-icon.png') }}"></td>
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

                            <div class="card card-primary" style="min-height: 405px">
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
                                                    <table
                                                        class="table table-striped table-bordered table-hover text-nowrap">
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
    <script type="module">
        $(document).ready(() => {
            const selectElement = $('#redirectSelect');

            // Check if a selected option is stored in local storage
            const storedOption = localStorage.getItem('selectedOption');

            if (storedOption) {
                // If a stored option exists, set it as the selected value
                selectElement.val(storedOption);
            }

            // Add an event listener to update local storage when an option is selected
            selectElement.on('change', () => {
                const selectedOption = selectElement.val();
                if (selectedOption) {
                    localStorage.setItem('selectedOption',
                        selectedOption); // Store the selected option in local storage
                }
            });
        });
    </script>
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
            var options_c = {
                series: [7, 2, 4, 3],
                chart: {
                    type: 'donut',
                    //width: 460,
                    height: 330,
                },
                colors: ['#cacaca', '#fed343', '#66DA26', '#E91E63', '#2E93fA', '#A5978B', '#C7F464', '#81D4FA',
                    '#4ECDC4', '#FD6A6A'
                ],
                title: {
                    //text: 'ประเทศที่ดูมากที่สุด ประจำวันที่ 2023-06-30 - 2023-06-30',
                    align: 'left',
                    margin: 10,
                    offsetX: 0,
                    offsetY: 0,
                    floating: false,
                    style: {
                        fontSize: '14px',
                        fontWeight: 'bold',
                        //fontFamily: undefined,
                        color: '#263238'
                    },
                },

                labels: ['Offline', 'Pause', 'Ready', 'Busy'],
                responsive: [{
                    breakpoint: 200,
                    options: {
                        chart: {
                            width: 300,
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            //var chart_c = new ApexCharts(document.querySelector("#chart_c"), options_c);
            //chart_c.render();


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
                            color: '#ff8484',
                            shadowColor: '#ff6633',
                            shadowBlur: 10,
                            shadowOffsetX: 2,
                            shadowOffsetY: 2
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
                            show: true,
                            showAbove: true,
                            color: '#000000',
                            size: 10,
                            itemStyle: {
                                borderWidth: 3,
                            },
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
                            /* offsetCenter: [0, '-15%'], */
                            fontSize: 20,
                            fontWeight: 'bolder',
                            formatter: '{value} %',
                            color: '#000000'
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
                            color: '#ff8484',
                            shadowColor: '#ff6633',
                            shadowBlur: 10,
                            shadowOffsetX: 2,
                            shadowOffsetY: 2
                        },
                        progress: {
                            show: true,
                            width: 8
                        },
                        anchor: {
                            show: false
                        },
                        axisLine: {
                            show: false,
                            roundCap: false,
                            lineStyle: {
                                width: 12,
                                color: [
                                    [0.1, '#00C853'],
                                    [0.8, '#FFD740'],
                                    [1, '#ff8484'],
                                ],
                            },
                        },
                        axisTick: {
                            show: false,
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

            var pie4072 = echarts.init(document.getElementById("mainbc2_4072"));
            var option4072 = {
                title: {
                    show: false,
                    text: 'Referer of a Website',
                    subtext: 'Fake Data',
                    left: 'center'
                },
                toolbox: {
                    show: true,
                    feature: {
                        /*  dataZoom: {
                             yAxisIndex: 'none'
                         },
                         dataView: {
                             readOnly: false
                         },
                         magicType: {
                             type: ['line', 'bar']
                         },
                         restore: {}, */
                        saveAsImage: {}
                    }
                },
                tooltip: {
                    trigger: 'item'
                },
                /* legend: {
                    orient: 'vertical',
                    left: 'left'
                }, */
                legend: {
                    top: '5%',
                    left: 'center'
                },
                series: [{
                    name: 'Status',
                    type: 'pie',
                    selectedMode: 'single',
                    radius: '60%',
                    center: ['50%', '55%'],
                    data: [{
                            value: 4,
                            name: 'Offline'
                        },
                        {
                            value: 3,
                            name: 'Ready'
                        },
                        {
                            value: 2,
                            name: 'Pause'
                        },
                        {
                            value: 5,
                            name: 'Busy',
                            selected: true
                        },

                    ],
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }]
            };

            pie4072.setOption(option4072);
            window.addEventListener('resize', pie4072.resize);
        })

        option = {
            series: [{
                type: 'gauge',
                startAngle: 180,
                endAngle: 0,
                min: 0,
                max: 240,
                splitNumber: 12,
                itemStyle: {
                    color: '#58D9F9',
                    shadowColor: 'rgba(0,138,255,0.45)',
                    shadowBlur: 10,
                    shadowOffsetX: 2,
                    shadowOffsetY: 2
                },
                progress: {
                    show: true,
                    roundCap: true,
                    width: 18
                },
                pointer: {
                    icon: 'path://M2090.36389,615.30999 L2090.36389,615.30999 C2091.48372,615.30999 2092.40383,616.194028 2092.44859,617.312956 L2096.90698,728.755929 C2097.05155,732.369577 2094.2393,735.416212 2090.62566,735.56078 C2090.53845,735.564269 2090.45117,735.566014 2090.36389,735.566014 L2090.36389,735.566014 C2086.74736,735.566014 2083.81557,732.63423 2083.81557,729.017692 C2083.81557,728.930412 2083.81732,728.84314 2083.82081,728.755929 L2088.2792,617.312956 C2088.32396,616.194028 2089.24407,615.30999 2090.36389,615.30999 Z',
                    length: '75%',
                    width: 16,
                    offsetCenter: [0, '5%']
                },
                axisLine: {
                    roundCap: true,
                    lineStyle: {
                        width: 18
                    }
                },
                axisTick: {
                    splitNumber: 2,
                    lineStyle: {
                        width: 2,
                        color: '#999'
                    }
                },
                splitLine: {
                    length: 12,
                    lineStyle: {
                        width: 3,
                        color: '#999'
                    }
                },
                axisLabel: {
                    distance: 30,
                    color: '#999',
                    fontSize: 20
                },
                title: {
                    show: false
                },
                toolbox: {
                    show: true,
                    feature: {
                        dataZoom: {
                            yAxisIndex: 'none'
                        },
                        dataView: {
                            readOnly: false
                        },
                        magicType: {
                            type: ['line', 'bar']
                        },
                        restore: {},
                        saveAsImage: {}
                    }
                },
                detail: {
                    backgroundColor: '#fff',
                    borderColor: '#999',
                    borderWidth: 2,
                    width: '60%',
                    lineHeight: 40,
                    height: 40,
                    borderRadius: 8,
                    offsetCenter: [0, '35%'],
                    valueAnimation: true,
                    formatter: function(value) {
                        return '{value|' + value.toFixed(0) + '}{unit|km/h}';
                    },
                    rich: {
                        value: {
                            fontSize: 50,
                            fontWeight: 'bolder',
                            color: '#777'
                        },
                        unit: {
                            fontSize: 20,
                            color: '#999',
                            padding: [0, 0, -20, 10]
                        }
                    }
                },
                data: [{
                    value: 100
                }]
            }]
        };


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
