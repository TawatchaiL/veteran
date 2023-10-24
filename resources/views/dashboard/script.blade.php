<script src="{{ config('asterisk.dashboard_serv.address') }}/socket.io/socket.io.js"></script>
<script>
    const dashboard_serv = '{{ config('asterisk.dashboard_serv.address') }}';
    const api_serv = '{{ config('asterisk.api_serv.address') }}';
    const socket = io.connect(`${dashboard_serv}`);
    const storedOption = localStorage.getItem('selectedOption');


    let call_list = (exten) => {
        let mcallprofile = '';
        let mcallexten = '';
        let luniq = '';
        let mstrArray = [];
        let calls_active = 0;


        $.get(`${api_serv}/chans/` + exten, async (data, status) => {

            await data.forEach((item, index) => {
                let strArray = item.split("!");
                let chan = strArray[0].split("/");

                $.get(`${api_serv}/chans_variable/` + chan[1], (data, status) => {

                    console.log(data)
                    luniq = data[0][1];
                    luniqrd = luniq.replace('.', '');
                    mcallprofile = data[1][1];
                    mcallexten = data[2][1];
                    mcalldestchan = data[3][1];

                    /* if (strArray[4] == 'Ringing' || strArray[4] == 'Ring') {
                        localStorage.setItem(chan[1] + '_ring_cid',
                        mcallexten);
                        localStorage.setItem(chan[1] + '_ring_time',
                            res.timestamp);
                        $('#' + chan[1] + '_src').html(mcallexten);
                    } else if (strArray[4] == 'Up' && strArray[12] == '') {
                        state = 'กำลังรอสาย'
                        state_icon =
                            '<i class="fa-solid fa-bell fa-beat" style="--fa-beat-scale: 2.0;"></i>';
                        state_color = 'card-danger';
                        check_box_state = 'disabled';
                    } else if (strArray[4] == 'Up') {
                        state = 'กำลังสนทนา'
                        state_icon =
                            '<i class="fa-solid fa-phone-volume fa-bounce" style=" --fa-bounce-start-scale-x: 1; --fa-bounce-start-scale-y: 1; --fa-bounce-jump-scale-x: 1; --fa-bounce-jump-scale-y: 1; --fa-bounce-land-scale-x: 1; --fa-bounce-land-scale-y: 1; "></i>';
                        state_color = 'card-success';
                        check_box_state = '';
                    }
 */
                });
                calls_active += 1;
            });
        });
    };



    socket.on('connect', () => {
        socket.emit('join', 'Client Connect To Asterisk Event Serv');
    });

    socket.on('queuemember', async (response) => {
        //console.log(response)
        const storedOption = localStorage.getItem('selectedOption');
        let res = response.data;
        let status = '';
        let phone_status = '';
        let state_dur = '';
        let ring_cid = '';
        let ring_time = '';
        let ans_cid = '';
        let ans_time = '';
        let loginTime = '';
        let exts = res.location.split('/');
        let phone_number = exts[1];
        const div_src = $('#' + phone_number + '_src');

        if (res.queue == storedOption) {
            if (res.status == 5 || res.status == 0) {
                phone_status = `<span style="font-size: 1em; color: red;">
                    <i class="fa-solid fa-triangle-exclamation"></i></span> ` + phone_number
                status = 'โทรศัพท์ไม่พร้อมใช้งาน'
            } else {
                phone_status = phone_number
            }

            if (res.paused == 1) {
                if (res.pausedreason == 'Warp UP') {
                    status = `<span style="font-size: 1em; color: #ff9900;">
                        <i class="fa-solid fa-user-pen"></i></span> Warp UP`
                    state_dur = duration_time(res.lastpause);
                } else {
                    status = `<span style="font-size: 1em; color: #ff9900;">
                    <i class="fa-solid fa-user-clock"></i></span> พักสาย ( ${res.pausedreason} )`
                    state_dur = duration_time(res.lastpause);
                }
            } else if (res.status == 6) {
                ring_cid = localStorage.getItem(phone_number + '_ring_cid');
                ring_time = localStorage.getItem(phone_number + '_ring_time');
                status = `<span style="font-size: 1em; color: red;">
                    <i class="fa-solid fa-bell fa-beat" style="--fa-beat-scale: 2.0;"></i></span> กำลังรอสาย`
                div_src.html(ring_cid);
                state_dur = duration_miltime(ring_time);
            } else if (res.status == 2) {
                ans_cid = localStorage.getItem(phone_number + '_ans_cid');
                ans_time = localStorage.getItem(phone_number + '_ans_time');
                status = `<span style="font-size: 1em; color: red;">
                    <i class="fa-solid fa-phone-volume fa-beat" style="--fa-beat-scale: 1.5;"></i></span> กำลังสนทนา`
                div_src.html(ans_cid);
                state_dur = duration_miltime(ans_time);
            } else if (res.status == 8) {
                status = `<span style="font-size: 1em; color: #ff9900;">
                    <i class="fa-solid fa-user-clock fa-beat" style="--fa-beat-scale: 1.5;"></i></span> กำลังพักสาย`
            } else if (res.status == 1) {
                status = `<span style="font-size: 1em; color: green;">
                    <i class="fa-solid fa-user-check"></i></span> พร้อมรับสาย`
                if (res.lastpause == 0) {
                    if (res.lastcall == 0) {
                        loginTime = new Date($('#' + exts[1] + '_login').val()).getTime() / 1000;
                        state_dur = duration_time(loginTime);
                    } else {
                        state_dur = duration_time(res.lastcall);
                    }
                } else {
                    state_dur = duration_time(res.lastpause);
                }
            }

            $('#' + phone_number + '_status').html(status);
            $('#' + phone_number + '_phone').html(phone_status);
            $('#' + phone_number + '_queue').html(res.queue);
            $('#' + phone_number + '_duration').html(state_dur);
        }

    });

    socket.on('queuememberstatus', async (response) => {
        console.log(response)
    });

    socket.on('agentcalled', async (response) => {
        console.log(response)
        let res = response.data;
        localStorage.setItem(res.destcalleridnum + '_ring_cid',
            res.calleridnum);
        localStorage.setItem(res.destcalleridnum + '_ring_time',
            res.timestamp);
        $('#' + res.destcalleridnum + '_src').html(res.calleridnum);
    });

    socket.on('agentconnect', async (response) => {
        console.log(response)
        let res = response.data;
        localStorage.setItem(res.destcalleridnum + '_ans_cid',
            res.calleridnum);
        localStorage.setItem(res.destcalleridnum + '_ans_time',
            Math.floor(Date.now() / 1000));
        $('#' + res.destcalleridnum + '_src').html(res.calleridnum);
    });


    /* setInterval(() => {
        socket.emit('getqueue', {
            queue: storedOption,
        });
    }, 1000); */

    let duration_time = (timestamp) => {
        let presentTimestamp = Math.floor(Date.now() / 1000);
        let timeDifference = presentTimestamp - timestamp;

        let hours = Math.floor(timeDifference / 3600);
        let minutes = Math.floor((timeDifference % 3600) / 60);
        let seconds = timeDifference % 60;

        let formattedHours = String(hours).padStart(2, '0');
        let formattedMinutes = String(minutes).padStart(2, '0');
        let formattedSeconds = String(seconds).padStart(2, '0');

        const duration = `${formattedHours}:${formattedMinutes}:${formattedSeconds}`;
        return duration;
    }

    let duration_miltime = (timestampMilliseconds) => {
        // Get the current timestamp for the present time (in seconds)
        let presentTimestamp = Math.floor(Date.now() / 1000);

        // Convert the provided timestamp in milliseconds to seconds
        let timestampSeconds = Math.floor(timestampMilliseconds);

        // Calculate the time difference in seconds
        let timeDifference = presentTimestamp - timestampSeconds;

        let hours = Math.floor(timeDifference / 3600);
        let minutes = Math.floor((timeDifference % 3600) / 60);
        let seconds = timeDifference % 60;

        let formattedHours = String(hours).padStart(2, '0');
        let formattedMinutes = String(minutes).padStart(2, '0');
        let formattedSeconds = String(seconds).padStart(2, '0');

        const duration = `${formattedHours}:${formattedMinutes}:${formattedSeconds}`;
        return duration;
    }


    let get_agent = (selectedOption) => {
        $.ajax({
            url: '{{ route('dashboard.agent_list') }}',
            type: 'post',
            data: {
                queue: selectedOption,
                _token: token,
            },
            success: function(response) {
                response.agent_arr.forEach(element => {
                    ccall_list(element);
                });
                $('#agent_list tbody').html(response.html);

            },
            error: function(xhr, status, error) {
                // Handle errors
            }
        });
    }
    $(document).ready(() => {
        const selectElement = $('#redirectSelect');

        if (storedOption) {
            selectElement.val(storedOption);
        }

        get_agent(storedOption);

        selectElement.on('change', () => {
            const selectedOption = selectElement.val();
            if (selectedOption) {
                localStorage.setItem('selectedOption',
                    selectedOption);
            }

            get_agent(selectedOption);
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
