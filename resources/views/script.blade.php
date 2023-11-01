<script language="javascript" type="text/javascript">
    const updateAvgData = () => {
        $.ajax({
            url: '{{ route('dashboard.agent_avg_data') }}',
            method: 'POST',
            data: {
                _token: token,
            },
            success: (data) => {
                data.avg_data.forEach((item) => {
                    avg_talk.html(item.avg_talk_time)
                    avg_wait.html(item.avg_hold_time)
                    total_talk.html(item.total_talk_time)
                    total_call.html(item.total_call)
                });
            },
            error: (error) => {
                console.error('Error fetching data:', error);
            },
        });
    };

    const AgentbyHourData = async () => {
        try {
            const response = await $.ajax({
                url: '{{ route('dashboard.agent_by_hour') }}',
                method: 'POST',
                data: {
                    _token: token,
                },
            });
            return response.hour_data; // Assuming response has a 'hour_data' property
        } catch (error) {
            console.error('Error fetching data:', error);
            throw error;
        }
    };

    const hour_chart_data = (data) => {
        if (data && data.length === 24) {
            const timeIntervals = [
                '00:00 - 00:59', '01:00 - 01:59', '02:00 - 02:59', '03:00 - 03:59',
                '04:00 - 04:59', '05:00 - 05:59', '06:00 - 06:59', '07:00 - 07:59',
                '08:00 - 08:59', '09:00 - 09:59', '10:00 - 10:59', '11:00 - 11:59',
                '12:00 - 12:59', '13:00 - 13:59', '14:00 - 14:59', '15:00 - 15:59',
                '16:00 - 16:59', '17:00 - 17:59', '18:00 - 18:59', '19:00 - 19:59',
                '20:00 - 20:59', '21:00 - 21:59', '22:00 - 22:59', '23:00 - 23:59',
            ];

            const datac = timeIntervals.map((interval, index) => ({
                value: data[index],
                name: interval,
            }));

            const option = {
                tooltip: {
                    trigger: 'item',
                },
                toolbox: {
                    show: true,
                    feature: {
                        saveAsImage: {},
                    },
                },
                legend: {
                    show: true,
                    type: 'scroll',
                    orient: 'vertical',
                    right: 5,
                    top: 30,
                    bottom: 20,
                    data: datac.map((item) => item.name),
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
                            return /* param.name +  */ ' (' + param.percent * 2 + '%)';
                        },
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
                            fontWeight: 'bold',
                        },
                    },
                    labelLine: {
                        show: true,
                    },
                    data: datac,
                }],
            };

            return option;
        } else {
            console.error('Data is undefined or has an incorrect length.');
            return {};
        }
    };

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





    })


    const handleDataHour = async () => {
    try {
        const data = await AgentbyHourData();
        const option = hour_chart_data(data);
        const hour_chart = echarts.init(document.getElementById("hour_chart"));
        hour_chart.setOption(option);
        window.addEventListener('resize', hour_chart.resize);
    } catch (error) {
        console.error('Error:', error);
    }
};

    const total_call = $('#total_call');
    const avg_talk = $('#avg_talk');
    const total_talk = $('#total_talk');
    const avg_wait = $('#avg_wait');
    //const max_wait = document.getElementById("max_wait");
    $(document).ready(() => {
        updateAvgData();
        handleDataHour();
    });
</script>
