<script>
    @if ($options['chart_type'] == 'bar')
        var options = {
            series: [
                @foreach ($datasets as $dataset)
                    {
                        @if ($options['chart_type'] == 'bar')
                            name: 'data',
                        @endif
                        data: [
                            @foreach ($dataset['data'] as $group => $result)
                                {!! $result !!}
                                @unless ($loop->last)
                                    ,
                                @endunless
                            @endforeach
                        ]
                    },
                @endforeach
            ],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false
                },

            },
            colors: [
                @foreach ($options['color'] as $color)
                    '{!! $color !!}'
                    @unless ($loop->last)
                        ,
                    @endunless
                @endforeach
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


                categories: [
                    @if (count($datasets) > 0)
                        @foreach ($datasets[0]['data'] as $group => $result)
                            "{{ $group }}",
                        @endforeach
                    @endif

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
                        return " จำนวน " + val + "  "
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#{{ $options['chart_name'] ?? 'myChart' }}"), options);
        chart.render();
    @elseif ($options['chart_type'] == 'line')
        var options = {
            series: [
                @foreach ($datasets as $dataset)
                    {
                        @if ($options['chart_type'] == 'line')
                            name: 'data',
                        @endif
                        data: [
                            @foreach ($dataset['data'] as $group => $result)
                                {!! $result !!}
                                @unless ($loop->last)
                                    ,
                                @endunless
                            @endforeach
                        ]
                    },
                @endforeach
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
                },
                toolbar: {
                    show: false
                },

            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight',
                width: 4
            },
            colors: ['#E91E63', '#2E93fA', '#546E7A', '#66DA26', '#FF9800', '#4ECDC4', '#C7F464', '#81D4FA',
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
                categories: [
                    @if (count($datasets) > 0)
                        @foreach ($datasets[0]['data'] as $group => $result)
                            "{{ $group }}",
                        @endforeach
                    @endif
                ],
            },

            legend: {
                horizontalAlign: 'left'
            }
        };

        var chart = new ApexCharts(document.querySelector("#{{ $options['chart_name'] ?? 'myChart' }}"), options);
        chart.render();
    @elseif ($options['chart_type'] == 'pie')

        var options = {

            series: [
                @foreach ($datasets as $dataset)
                    @foreach ($dataset['data'] as $group => $result)
                        {!! $result !!}
                        @unless ($loop->last)
                            ,
                        @endunless
                    @endforeach
                @endforeach
            ],
            chart: {
                type: 'donut',
                //width: 550,
                height: 380,
                toolbar: {
                    show: false
                },
            },
            colors: ['#E91E63', '#2E93fA', '#546E7A', '#66DA26', '#FF9800', '#4ECDC4', '#C7F464', '#81D4FA',
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
            labels: [
                @if (count($datasets) > 0)
                    @foreach ($datasets[0]['data'] as $group => $result)
                        "{{ $group }}",
                    @endforeach
                @endif
            ],
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

        var chart = new ApexCharts(document.querySelector("#{{ $options['chart_name'] ?? 'myChart' }}"), options);
        chart.render();
    @endif
</script>
