<script language="javascript" type="text/javascript">
    const updateAvgData = () => {
        $.ajax({
            url: '{{ route('dashboard.agent_avg_data') }}',
            method: 'POST',
            data: {
                _token: token,
            },
            success: (data) => {
                console.log(data);
                data.avg_data.forEach((item) => {
                    avg_talk.html(item.avg_talk_time)
                    avg_wait.html(item.avg_hold_time)
                    total_talk.html(item.total_talk_time)
                    total_call.html(item.total_call)
                    total_score.html(item.total_score)
                    total_closed_case.html(item.total_case)
                    total_case.html(item.total_case)
                    total_tranfer_case.html(item.total_tranfer_case)
                });
            },
            error: (error) => {
                console.error('Error fetching data:', error);
            },
        });
    };

    const AgentbyDateData = async () => {
        try {
            const response = await $.ajax({
                url: '{{ route('dashboard.agent_by_date') }}',
                method: 'POST',
                data: {
                    _token: token,
                },
            });
            return response.date_data;
        } catch (error) {
            console.error('Error fetching data:', error);
            throw error;
        }
    };


    const AgentCasebyDateData = async () => {
        try {
            const response = await $.ajax({
                url: '{{ route('dashboard.agent_case_by_date') }}',
                method: 'POST',
                data: {
                    _token: token,
                },
            });
            return response.date_data;
        } catch (error) {
            console.error('Error fetching data:', error);
            throw error;
        }
    };

    const date_chart_data = (data) => {
        const dataArray = Object.entries(data).map(([day, count]) => ({
            day: parseInt(day), // Convert day to a number
            count: count,
        }));
        const option = {
            series: [{
                name: 'สายเข้ารายวัน',
                data: dataArray.map((item) => item.count),
            }, ],
            markers: {
                size: 5,
                colors: ["#FFFFFF"],
                strokeColor: "#A5978B",
                strokeWidth: 4,
            },
            chart: {
                type: 'area',
                height: 380,
                zoom: {
                    enabled: false,
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: 'straight',
                width: 4,
            },
            colors: ['#fb7293'],
            title: {
                align: 'left',
            },
            subtitle: {
                text: 'จำนวน',
                align: 'left',
            },
            xaxis: {
                labels: {
                    show: true,
                    rotate: -30,
                    rotateAlways: true,
                    maxHeight: 300,
                    // hideOverlappingLabels: false
                },
                categories: dataArray.map((item) => item.day.toString()),
            },
            legend: {
                horizontalAlign: 'left',
            },
        };
        return option;
    };


    const date_case_chart_data = (data) => {
        const dataArray = Object.entries(data).map(([day, counts]) => ({
            day: parseInt(day),
            all: counts.all,
            tranfer: counts.tranfer,
        }));
        const option = {
            series: [{
                    name: 'เคสที่รับแจ้งทั้งหมด',
                    data: dataArray.map((item) => item.all),
                },
                {
                    name: 'เคสที่โอนสาย',
                    data: dataArray.map((item) => item.tranfer),
                },

            ],
            chart: {
                type: 'area',
                height: 350,
                zoom: {
                    enabled: false,
                },

            },
            colors: ['#91cc75', '#fc8452'],
            title: {
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
                categories: dataArray.map((item) => item.day.toString()),
            },
            yaxis: {

            },
            fill: {
                type: 'solid',
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
        return option;
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
            return response.hour_data;
        } catch (error) {
            console.error('Error fetching data:', error);
            throw error;
        }
    };

    const hour_chart_data = (data) => {

        const timeIntervals = [
            '00:00', '01:00', '02:00', '03:00',
            '04:00', '05:00', '06:00', '07:00',
            '08:00', '09:00', '10:00', '11:00',
            '12:00', '13:00', '14:00', '15:00',
            '16:00', '17:00', '18:00', '19:00',
            '20:00', '21:00', '22:00', '23:00',
        ];

        const datac = timeIntervals.map((interval, index) => ({
            value: data[index],
            name: interval,
        }));

        const option = {
            series: [{
                    name: 'สายเข้ารายชั่วโมง',
                    data: datac.map((item) => item.value)
                },

            ],

            markers: {
                size: 5,
                colors: ["#FFFFFF"],
                strokeColor: "#A5978B",
                strokeWidth: 4
            },
            chart: {
                type: 'bar',
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
            colors: ['#5470c6'],
            title: {
                align: 'left'
            },
            subtitle: {
                text: 'จำนวน',
                align: 'left'
            },

            xaxis: {
                labels: {
                    show: true,
                    rotate: -30,
                    rotateAlways: true,
                    maxHeight: 300,
                    //hideOverlappingLabels: false
                },
                categories: datac.map((item) => item.name),
            },
            legend: {
                horizontalAlign: 'left'
            }
        };

        /*  const option = {
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
                 top: 20,
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
                         return  ' (' + param.percent * 2 + '%)';
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
         }; */

        return option;

    };

    const AgentCallSurvey = async () => {
        try {
            const response = await $.ajax({
                url: '{{ route('dashboard.agent_call_survey') }}',
                method: 'POST',
                data: {
                    _token: token,
                },
            });
            return response.score_data;
        } catch (error) {
            console.error('Error fetching data:', error);
            throw error;
        }
    };

    const score_chart_data = (data) => {
        const labels = Object.keys(data);
        const values = Object.values(data);

        const option = {
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
                    saveAsImage: {}
                }
            },
            legend: {
                top: '5%',
                left: 'center',
                data: labels.map(String)
            },
            series: [{
                name: 'คะแนน',
                type: 'pie',
                selectedMode: 'single',
                radius: '60%',
                center: ['50%', '45%'],
                data: labels.map(label => ({
                    value: data[label],
                    name: label
                })),
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }]
        };

        return option;
    };

    const handleDataHour = async () => {
        try {
            const data = await AgentbyHourData();
            const option = hour_chart_data(data);
            var chart_hour = new ApexCharts(document.querySelector("#hour_chart"), option);
            chart_hour.render();
            //const hour_chart = echarts.init(document.getElementById("hour_chart"));
            //hour_chart.setOption(option);
            //window.addEventListener('resize', hour_chart.resize);
        } catch (error) {
            console.error('Error:', error);
        }
    };

    const handleDataDate = async () => {
        try {
            const datad = await AgentbyDateData();
            const optiond = date_chart_data(datad);
            var chart_d = new ApexCharts(document.querySelector("#chart_date"), optiond);
            chart_d.render();
        } catch (error) {
            console.error('Error:', error);
        }
    };

    const handleCaseDataDate = async () => {
        try {
            const datac = await AgentCasebyDateData();
            const optionc = date_case_chart_data(datac);
            var chart_case = new ApexCharts(document.querySelector("#chart_case"), optionc);
            chart_case.render();
        } catch (error) {
            console.error('Error:', error);
        }
    };


    const handleCallSurveyData = async () => {
        try {
            const datas = await AgentCallSurvey();
            const options = score_chart_data(datas);
            var chart_score = echarts.init(document.getElementById("chart_call_survey"));
            chart_score.setOption(options);
            window.addEventListener('resize', chart_score.resize);
        } catch (error) {
            console.error('Error:', error);
        }
    };





    const total_call = $('#total_call');
    const avg_talk = $('#avg_talk');
    const total_talk = $('#total_talk');
    const avg_wait = $('#avg_wait');
    const total_score = $('#total_score');
    const total_case = $('#total_case');
    const total_closed_case = $('#total_closed_case');
    const total_tranfer_case = $('#total_tranfer_case');

    //const max_wait = document.getElementById("max_wait");
    $(document).ready(() => {
        window.Apex.chart = {
            fontFamily: "Sarabun"
        };
        updateAvgData();
        handleDataHour();
        handleDataDate();
        handleCaseDataDate();
        handleCallSurveyData();

    });
</script>
