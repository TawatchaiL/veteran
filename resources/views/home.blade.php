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
                    <h4><i class="fa-solid fa-chart-pie"></i> สถิติการรับสาย และ รับเคสของ [{{ Auth::user()->name }}]</h4>
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
                                <span class="info-box-icon bg-primary"><i
                                        class="fa-solid fa-arrow-right-to-bracket"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">สายเข้า</span>
                                    <span class="info-box-number">15 ครั้ง</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-solid fa-user-clock"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">เวลารอสายเฉลี่ย</span>
                                    <span class="info-box-number">00:00:12</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fa-solid fa-phone-volume"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เวลาที่สนทนาทั้งหมด</span>
                                    <span class="info-box-number">00:38:43</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fa-solid fa-headset"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เวลาสนทนาเฉลี่ยต่อสาย</span>
                                    <span class="info-box-number"> 00:05:12</span>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fa-solid fa-clipboard-question"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เคสที่รับแจ้ง</span>
                                    <span class="info-box-number">10 เคส</span>
                                </div>

                            </div>

                        </div>


                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-clipboard-check"></i></span>
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
                        <div class="col-md-6">

                            <div class="card card-primary" style="max-height: 485px">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa-solid fa-chart-line"></i> สถิติการรับสายตามช่วงเวลา
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
                                    <div id="mainbc2_4072" style="width: 100%; height: 450px;"></div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="card card-primary" style="max-height: 485px">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa-solid fa-chart-line"></i> สถิติ สายเข้า รายวัน
                                        ประจำเดือน 2023-08
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
                                            <div id="chart_date"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>



                    </div>
                    <div class="row">
                        <div class="col-md-8">

                            <div class="card card-primary" style="max-height: 455px">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa-solid fa-chart-line"></i> สถิติ เคสที่รับแจ้ง /
                                        เคสที่ปิดเคสแล้ว รายวัน ประจำเดือน 2023-08
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
                                            <div id="chart"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="card card-primary" style="max-height: 455px">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa-solid fa-chart-line"></i> คะแนน ความพึงพอใจ </h3>
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
                                        <div id="mainbc2_4071" style="width: 100%; height: 420px;"></div>
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
            window.Apex.chart = {
                fontFamily: "Sarabun"
            };
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
                    //width: 550,
                    height: 390,
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
                    breakpoint: 200,
                    options: {
                        chart: {
                            width: 350,
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            //var chart_os = new ApexCharts(document.querySelector("#chart_os"), options_os);
            //chart_os.render();


            var options_c = {
                series: [10, 5, 18, 20, 50],
                chart: {
                    type: 'donut',
                    //width: 460,
                    height: 370,
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
                    breakpoint: 200,
                    options: {
                        chart: {
                            width: 350,
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
            var option4071 = {
                title: {
                    show: false,
                    text: 'Referer of a Website',
                    subtext: 'Fake Data',
                    left: 'center'
                },
                tooltip: {
                    trigger: 'item'
                },
                toolbox: {
                    show: true,
                    feature: {
                        /* dataZoom: {
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
                /* legend: {
                    orient: 'vertical',
                    left: 'left'
                }, */
                legend: {
                    top: '5%',
                    left: 'center'
                },
                series: [{
                    name: 'คะแนน',
                    type: 'pie',
                    selectedMode: 'single',
                    radius: '60%',
                    center: ['50%', '45%'],
                    data: [{
                            value: 10,
                            name: '1'
                        },
                        {
                            value: 15,
                            name: '2'
                        },
                        {
                            value: 18,
                            name: '3'
                        },
                        {
                            value: 20,
                            name: '4'
                        },
                        {
                            value: 50,
                            name: '5',
                            selected: true
                        }
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

            pie4071.setOption(option4071);
            window.addEventListener('resize', pie4071.resize);


            var datac = [];
            var timeIntervals = ['00:00 - 01:59', '02:00 - 03:59', '04:00 - 05:59', '06:00 - 07:59',
                '08:00 - 09:59',
                '10:00 - 11:59', '12:00 - 13:59', '14:00 - 15:59', '16:00 - 17:59', '18:00 - 19:59',
                '20:00 - 21:59', '22:00 - 23:59'
            ];

            for (var i = 0; i < timeIntervals.length; i++) {
                var randomValue = Math.floor(Math.random() * 1000); // Generate a random value between 0 and 999
                var dataPoint = {
                    value: randomValue,
                    name: timeIntervals[i]
                };
                datac.push(dataPoint);
            }
            var pie4072 = echarts.init(document.getElementById("mainbc2_4072"));

            option4072 = {
                tooltip: {
                    trigger: 'item'
                },
                toolbox: {
                    show: true,
                    feature: {
                        /* dataZoom: {
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
                legend: {
                    show: true,
                    type: 'scroll',
                    orient: 'vertical',
                    right: 5,
                    top: 30,
                    bottom: 20,
                    data: datac.legendData
                },
                series: [{
                    name: 'ช่วงเวลา',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    center: ['35%', '40%'],
                    avoidLabelOverlap: true,
                    label: {
                        show: true,
                        position: 'inner',
                        fontSize: 10,
                        color: '#ffffff',
                        formatter(param) {
                            // correct the percentage
                            return /* param.name +  */ ' (' + param.percent * 2 + '%)';
                        }
                    },
                    color: ['#5470c6', '#91cc75', '#fac858', '#ee6666', '#73c0de', '#3ba272', '#fc8452',
                        '#9a60b4', '#ea7ccc', '#91c7ae',
                        '#fb7293',
                        '#96BFFF',
                        '#bda29a',
                    ],
                    emphasis: {
                        label: {
                            show: true,
                            fontSize: 20,
                            fontWeight: 'bold'
                        }
                    },
                    labelLine: {
                        show: true
                    },
                    data: datac
                }]
            };

            pie4072.setOption(option4072);
            window.addEventListener('resize', pie4072.resize);

        })
    </script>
@endsection
