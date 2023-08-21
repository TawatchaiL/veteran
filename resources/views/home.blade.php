@extends('layouts.app')

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
                                <span class="info-box-icon bg-success"><i class="fas fa-warehouse"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text text-primary">ลวดทองแดง ที่เหลือในคลัง</span>
                                    <span class="info-box-number">1,600.00 กิโลกรัม</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fas fa-warehouse"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text text-primary">เศษพาสติก ที่เหลือในคลัง</span>
                                    <span class="info-box-number">1,000.00 กิโลกรัม</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-warehouse"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">จำนวนสินค้าเข้าคลังวันนี้</span>
                                    <span class="info-box-number">0.00 หน่วย</span>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fas fa-dollar-sign"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">จำนวนรายจ่ายวันนี้</span>
                                    <span class="info-box-number">0.00 บาท</span>
                                </div>

                            </div>

                        </div>


                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fas fa-cart-arrow-down"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">จำนวนสินค้าที่ขายได้วันนี้</span>
                                    <span class="info-box-number">0.00 หน่วย</span>
                                </div>

                            </div>

                        </div>


                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fas fa-hand-holding-usd"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">จำนวนรายรับวันนี้</span>
                                    <span class="info-box-number">0.00 บาท</span>
                                </div>

                            </div>

                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-6">

                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">สถิติการนำสินค้าเข้าคลัง / ขายสินค้าออก รายวัน ประจำเดือน 2023-08
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <div class="col-md-12">
                                            <div id="chart_date"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="col-md-6">

                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">สถิติรายจ่าย / รายรับ รายวัน ประจำเดือน 2023-08</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div id="chart"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">จำนวนสินค้าคงเหลือในคลังสินค้า</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <div class="col-md-12">
                                            <div id="chart_os"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="col-md-6">

                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">จำนวนสินค้าที่นำสินค้าเข้าคลัง / ที่ขายสินค้าออกจากคลัง</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div id="chart_c"></div>
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
@endsection

@section('script')
    <script language="javascript" type="text/javascript">
        $(document).ready(function() {

            var options = {
                series: [{
                        name: 'Income',
                        data: ['0', '0', '0', '0', '20000', '0', '0', '0', '0', '0', '0', '0', '0', '0',
                            '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0',
                            '0', '0'
                        ]
                    },
                    {
                        name: 'Cost',
                        data: ['0', '0', '0', '0', '115000', '0', '0', '0', '0', '0', '0', '0', '0', '0',
                            '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0',
                            '0', '0'
                        ]
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
                        columnWidth: '55%',
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


                    categories: ['08-01', '08-02', '08-03', '08-04', '08-05', '08-06', '08-07', '08-08',
                        '08-09', '08-10', '08-11', '08-12', '08-13', '08-14', '08-15', '08-16', '08-17',
                        '08-18', '08-19', '08-20', '08-21', '08-22', '08-23', '08-24', '08-25', '08-26',
                        '08-27', '08-28', '08-29', '08-30', '08-31'
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
                            return " จำนวน " + val + "  บาท"
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();

            var options_d = {
                series: [{
                        name: 'Instock',
                        data: ['0', '0', '0', '0', '3000', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0',
                            '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0',
                            '0'
                        ]
                    },
                    {
                        name: 'Order',
                        data: ['0', '0', '0', '0', '400', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0',
                            '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0',
                            '0'
                        ]
                    },
                ],

                markers: {
                    size: 5,
                    colors: ["#FFFFFF"],
                    strokeColor: "#A5978B",
                    strokeWidth: 4
                },
                chart: {
                    type: 'area',
                    height: 350,
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
                    categories: ['08-01', '08-02', '08-03', '08-04', '08-05', '08-06', '08-07', '08-08',
                        '08-09', '08-10', '08-11', '08-12', '08-13', '08-14', '08-15', '08-16', '08-17',
                        '08-18', '08-19', '08-20', '08-21', '08-22', '08-23', '08-24', '08-25', '08-26',
                        '08-27', '08-28', '08-29', '08-30', '08-31'
                    ],
                },
                legend: {
                    horizontalAlign: 'left'
                }
            };

            var chart_d = new ApexCharts(document.querySelector("#chart_date"), options_d);
            chart_d.render();


            var options_os = {
                series: [1600, 1000],
                chart: {
                    type: 'donut',
                    width: 450,
                    height: 350,
                },
                colors: ['#2E93fA', '#66DA26', '#546E7A', '#E91E63', '#FF9800', '#4ECDC4', '#C7F464', '#81D4FA',
                    '#A5978B', '#FD6A6A'
                ],
                title: {
                    //text: 'OS ที่ดูมากที่สุด ประจำวันที่ 2023-06-30 - 2023-06-30',
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
                labels: ['ลวดทองแดง', 'เศษพาสติก'],
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
                series: [20000, 115000],
                chart: {
                    type: 'donut',
                    width: 450,
                    height: 550,
                },
                colors: ['#4ECDC4', '#FF9800', '#2E93fA', '#66DA26', '#546E7A', '#E91E63', '#C7F464', '#81D4FA',
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

                labels: ['ขายสินค้าออกจากคลัง', 'นำสินค้าเข้าคลัง'],
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
@endsection
