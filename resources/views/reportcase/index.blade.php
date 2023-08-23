@extends('layouts.app')

@section('style')
    @include('reportcase.style')
@endsection



@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa-solid fa-magnifying-glass"></i> Filter</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-12">
                                <ol class="breadcrumb float-sm-center">
                                    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users Management</li> --}}
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong><i class="fas fa-calendar"></i> วันที่เริ่ม:</strong>
                                            {!! Form::text('start_date', null, [
                                                'id' => 'SDate',
                                                'placeholder' => '',
                                                'class' => 'SDate form-control',
                                                'data-target' => '#reservationdate',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong><i class="fas fa-calendar"></i> วันที่สิ้นสุด:</strong>
                                            {!! Form::text('end_date', null, [
                                                'id' => 'EDate',
                                                'placeholder' => '',
                                                'class' => 'EDate form-control',
                                                'data-target' => '#reservationdate',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2 align-self-end">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-success" id="CreateButton">
                                                <i class="fas fa-address-book"></i> รายงาน </button>
                                        </div>
                                    </div>
                                </ol>
                            </div>
                        </div>
                    </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-address-book"></i> ผลรวมสายเข้าแยกตาม Agent</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                {{-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button> --}}
                            </div>
                        </div>

                        <div class="card-body">
                            @if ($message = Session::get('success'))
                                {{--  <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div> --}}
                                <script>
                                    toastr.success('{{ $message }}', {
                                        timeOut: 5000
                                    });
                                </script>
                            @endif
                            <form method="post" name="delete_all" id="delete_all">
                                @csrf
                                @method('POST')
                                <table id="Listview" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th width="20px"><input type="checkbox" id="check-all" class="flat"></th>
                                            <th>agent</th>
                                            <th width="280px">จำนวน</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="col-xs-2 col-sm-2 col-md-2 align-self-end">
                                <div class="form-group">
                                    <a class="btn btn-danger" id="CreateButton" href="{{ route('reportcase.pdf') }}">
                                        <i class="fa-regular fa-file-pdf"></i> Pdf </a>
                                    <a class="btn btn-success" id="CreateButton2" href="{{ route('reportcase.pdf') }}">
                                        <i class="fa-regular fa-file-excel"></i> XLS </a>
                                    <a class="btn btn-info" id="CreateButton3" href="{{ route('reportcase.pdf') }}">
                                        <i class="fa-solid fa-print"></i> PRINT </a>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

            </div>
            <div class="card">
                <div class="card card-success card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                    href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                                    aria-selected="true">Bar Graph</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                    href="#custom-tabs-one-line" role="tab" aria-controls="custom-tabs-one-profile"
                                    aria-selected="false">Line Graph</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                    href="#custom-tabs-one-pie" role="tab" aria-controls="custom-tabs-one-profile"
                                    aria-selected="false">Pie Graph</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                                aria-labelledby="custom-tabs-one-home-tab">
                                <div class="col-sm-6">
                                    {!! $chart1->renderHtml() !!}
                                </div>
                                <div class="col-md-12">
                                    <div id="chart_os"></div>
                                </div>
                                <div class="col-md-12">
                                    <div id="chart_date"></div>
                                </div>
                                <div class="col-md-12">
                                    <div id="chart"></div>
                                </div>
                                <div class="col-md-12">
                                    <div id="chart_c"></div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-line" role="tabpanel"
                                aria-labelledby="custom-tabs-one-line-tab">
                                <div class="col-sm-6">
                                    {!! $chart2->renderHtml() !!}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-pie" role="tabpanel"
                                aria-labelledby="custom-tabs-one-pie-tab">
                                <div class="col-sm-6">
                                    {!! $chart3->renderHtml() !!}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </section>


    {{--  {!! $data->render() !!} --}}
@endsection

@section('script')
    @include('reportcase.script')

    <script>
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

            var options = {
                series: [{
                        name: 'เคสที่รับแจ้ง',
                        data: generateRandomData(31).map(item => item[1])
                    },
                    {
                        name: 'เคสที่ปิดเคสแล้ว',
                        data: generateRandomData(31).map(item => item[0])
                    },
                    /* {
                             name: 'Revenue',
                             data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                           }, {
                             name: 'Free Cash Flow',
                             data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
                           } */
                ],
                chart: {
                    type: 'bar',
                    height: 350,

                },
                colors: ['#2E93fA', '#FF9800', '#546E7A', '#66DA26', '#E91E63', '#4ECDC4', '#C7F464', '#81D4FA',
                    '#A5978B', '#FD6A6A'
                ],
                title: {
                    //text: 'สถิติการเข้าชม แยกตามหน้า ประจำวันที่ 2023-06-30 - 2023-06-30',
                    margin: 50,
                    //offsetX: 50,
                    //offsetY: 100,
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            position: 'top',
                            enabled: true,
                            textAnchor: 'start',
                            style: {
                                fontSize: '10pt',
                                colors: ['#000']
                            }
                        },
                        horizontal: false,
                        columnWidth: '75%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    labels: {
                        rotate: -30,
                        rotateAlways: true,
                        maxHeight: 300,
                        hideOverlappingLabels: false
                    },


                    categories: ['01', '02', '03', '04', '05', '06', '07', '08',
                        '09', '10', '11', '12', '13', '14', '15', '16', '17',
                        '18', '19', '20', '21', '22', '23', '24', '25', '26',
                        '27', '28', '29', '30', '31'
                    ],
                },
                yaxis: {

                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: "horizontal",
                        shadeIntensity: 0.25,
                        gradientToColors: undefined,
                        inverseColors: true,
                        opacityFrom: 0.85,
                        opacityTo: 0.85,
                        stops: [50, 0, 100]
                    },
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return " จำนวน " + val + "  เคส"
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();

            var options_d = {
                series: [{
                        name: 'สายเข้า',
                        data: generateRandomData(31).map(item => item[1])
                    },
                    /* {
                        name: 'สายที่ได้รับ',
                        data: generateRandomData(30).map(item => item[0])
                    }, */
                ],

                markers: {
                    size: 5,
                    colors: ["#FFFFFF"],
                    strokeColor: "#A5978B",
                    strokeWidth: 4
                },
                chart: {
                    type: 'area',
                    height: 380,
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight',
                    width: 4
                },
                colors: ['#E91E63', '#66DA26', '#546E7A', '#E91E63', '#FF9800', '#4ECDC4', '#C7F464', '#81D4FA',
                    '#A5978B', '#FD6A6A'
                ],
                title: {
                    //text: 'สถิติการเข้าชม รายวัน ประจำเดือน 2023-06',
                    align: 'left'
                },
                subtitle: {
                    //text: 'จำนวน',
                    align: 'left'
                },
                //labels: ['06-09','06-10','06-11','06-12','06-13','06-14','06-15','06-16','06-17','06-18','06-19','06-20','06-21','06-22','06-23','06-24','06-25','06-26','06-27','06-28','06-29'],
                /* xaxis: {
                   //type: 'datetime',
                }, */
                /*yaxis: {
                   opposite: true
                 }, */
                xaxis: {
                    labels: {
                        show: true,
                        rotate: -30,
                        rotateAlways: true,
                        maxHeight: 300,
                        //hideOverlappingLabels: false
                    },
                    categories: ['01', '02', '03', '04', '05', '06', '07', '08',
                        '09', '10', '11', '12', '13', '14', '15', '16', '17',
                        '18', '19', '20', '21', '22', '23', '24', '25', '26',
                        '27', '28', '29', '30', '31'
                    ],
                },
                legend: {
                    horizontalAlign: 'left'
                }
            };

            var chart_d = new ApexCharts(document.querySelector("#chart_date"), options_d);
            chart_d.render();


            var options_os = {
                series: generateRandomData(12).map(item => item[1]),
                chart: {
                    type: 'donut',
                    width: 550,
                    height: 650,
                },
                colors: ['#2E93fA', '#66DA26', '#546E7A', '#E91E63', '#FF9800', '#4ECDC4', '#C7F464', '#81D4FA',
                    '#A5978B', '#FD6A6A'
                ],
                title: {
                    //text: 'OS ที่ดูมากที่สุด ประจำวันที่ 2023-06-30 - 2023-06-30',
                    align: 'center',
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
                labels: generateTimeLabels(12),
                responsive: [{
                    breakpoint: 280,
                    options_os: {
                        chart: {
                            width: 200,
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart_os = new ApexCharts(document.querySelector("#chart_os"), options_os);
            chart_os.render();


            var options_c = {
                series: [10, 5, 18, 20, 50],
                chart: {
                    type: 'donut',
                    width: 460,
                    height: 450,
                },
                colors: ['#4ECDC4', '#FF9800', '#2E93fA', '#66DA26', '#E91E63', '#546E7A', '#C7F464', '#81D4FA',
                    '#A5978B', '#FD6A6A'
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

                labels: ['1', '2', '3', '4', '5'],
                responsive: [{
                    breakpoint: 280,
                    options_c: {
                        chart: {
                            width: 200,
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart_c = new ApexCharts(document.querySelector("#chart_c"), options_c);
            chart_c.render();





        })
    </script>

    {!! $chart1->renderChartJsLibrary() !!}
    {!! $chart1->renderJs() !!}

    {!! $chart2->renderJs() !!}


    {!! $chart3->renderJs() !!}
@endsection
