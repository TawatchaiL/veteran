<script src="{{ config('asterisk.toolbar_serv.address') }}/socket.io/socket.io.js"></script>
<script language="javascript" type="text/javascript">
    let agent_sla_chart = (sla) => {
        option = {
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
                            width: 20,
                            color: [
                                [0.5, '#d5d5d5'],
                                [0.8, '#d5d5d5'],
                                [1, '#d5d5d5'],
                            ],
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
                        value: sla
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
                                [0.5, '#00C853'],
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
                        value: sla,
                    }]

                }
            ],
        };
        return option;

    }

    let agent_status_chart = (offline, online, pause, warp, busy) => {
        let option = {
            title: {
                show: false,
                text: 'Referer of a Website',
                subtext: 'Fake Data',
                left: 'center'
            },
            toolbox: {
                show: true,
                feature: {
                    saveAsImage: {}
                }
            },
            tooltip: {
                trigger: 'item'
            },
            legend: {
                top: '5%',
                left: 'center'
            },
            series: [{
                name: 'Status',
                color: ['#bbbbbb', '#46c184', '#fed343', '#ff9900', '#f46884'],
                type: 'pie',
                selectedMode: 'single',
                radius: '60%',
                center: ['50%', '55%'],
                data: [{
                        value: offline,
                        name: 'Offline'
                    },
                    {
                        value: online,
                        name: 'Ready'
                    },
                    {
                        value: pause,
                        name: 'Pause'
                    },
                    {
                        value: warp,
                        name: 'WarpUp'
                    },
                    {
                        value: busy,
                        name: 'Busy',
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
        return option;
    }


    let queue_status_chart = (data) => {

        let option = {
            series: [{
                type: 'gauge',
                startAngle: 180,
                endAngle: 0,
                min: 0,
                max: 10,
                splitNumber: 5,
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
                    width: 12
                },
                pointer: {
                    icon: 'path://M2090.36389,615.30999 L2090.36389,615.30999 C2091.48372,615.30999 2092.40383,616.194028 2092.44859,617.312956 L2096.90698,728.755929 C2097.05155,732.369577 2094.2393,735.416212 2090.62566,735.56078 C2090.53845,735.564269 2090.45117,735.566014 2090.36389,735.566014 L2090.36389,735.566014 C2086.74736,735.566014 2083.81557,732.63423 2083.81557,729.017692 C2083.81557,728.930412 2083.81732,728.84314 2083.82081,728.755929 L2088.2792,617.312956 C2088.32396,616.194028 2089.24407,615.30999 2090.36389,615.30999 Z',
                    length: '75%',
                    width: 16,
                    offsetCenter: [0, '20%']
                },
                axisLine: {
                    roundCap: true,
                    lineStyle: {
                        width: 12
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
                    length: 0.1,
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
                detail: {
                    backgroundColor: '#fff',
                    borderColor: '#999',
                    borderWidth: 0,
                    width: '95%',
                    lineHeight: 30,
                    height: 30,
                    borderRadius: 8,
                    offsetCenter: [0, '35%'],
                    valueAnimation: true,
                    formatter: function(value) {
                        return `{unit|รอสาย} {value| ${value.toFixed(0)} }{unit|สาย}`;

                    },
                    rich: {
                        value: {
                            fontSize: 35,
                            fontWeight: 'bolder',
                            color: '#777'
                        },
                        unit: {
                            fontSize: 20,
                            color: '#999',
                            padding: [0, 0, -5, 10]
                        }
                    }
                },
                data: [{
                    value: data,
                }]
            }]
        };
        return option;
    }

    let queue_status_chart_talk = (data) => {

        let option = {
            series: [{
                type: 'gauge',
                startAngle: 180,
                endAngle: 0,
                min: 0,
                max: 10,
                splitNumber: 5,
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
                    width: 12
                },
                pointer: {
                    icon: 'path://M2090.36389,615.30999 L2090.36389,615.30999 C2091.48372,615.30999 2092.40383,616.194028 2092.44859,617.312956 L2096.90698,728.755929 C2097.05155,732.369577 2094.2393,735.416212 2090.62566,735.56078 C2090.53845,735.564269 2090.45117,735.566014 2090.36389,735.566014 L2090.36389,735.566014 C2086.74736,735.566014 2083.81557,732.63423 2083.81557,729.017692 C2083.81557,728.930412 2083.81732,728.84314 2083.82081,728.755929 L2088.2792,617.312956 C2088.32396,616.194028 2089.24407,615.30999 2090.36389,615.30999 Z',
                    length: '75%',
                    width: 16,
                    offsetCenter: [0, '20%']
                },
                axisLine: {
                    roundCap: true,
                    lineStyle: {
                        width: 12
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
                    length: 0.1,
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
                detail: {
                    backgroundColor: '#fff',
                    borderColor: '#999',
                    borderWidth: 0,
                    width: '95%',
                    lineHeight: 30,
                    height: 30,
                    borderRadius: 8,
                    offsetCenter: [0, '35%'],
                    valueAnimation: true,
                    formatter: function(value) {
                        return `{unit|สนทนา} {value| ${value.toFixed(0)} }{unit|สาย}`;

                    },
                    rich: {
                        value: {
                            fontSize: 35,
                            fontWeight: 'bolder',
                            color: '#777'
                        },
                        unit: {
                            fontSize: 20,
                            color: '#999',
                            padding: [0, 0, -5, 10]
                        }
                    }
                },
                data: [{
                    value: data,
                }]
            }]
        };
        return option;
    }



    let sla_count = () => {
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

    const changeText = (div, text) => {
        div.classList.add('hide_text');
        setTimeout(function() {
            div.innerHTML = text;
            div.classList.remove('hide_text');
        }, 500);
    }

    const selectElement = $('#redirectSelect');
    const selectSLA = $('#modal_sla');
    const div_agent_status_chart = echarts.init(document.getElementById("agent_status_chart"));
    const div_agent_sla_chart = echarts.init(document.getElementById("agent_sla_chart"));
    const div_queue_status_chart = echarts.init(document.getElementById("queue_status_chart"));
    const div_queue_status_chart_talk = echarts.init(document.getElementById("queue_status_chart_talk"));

    const dashboard_serv = '{{ config('asterisk.toolbar_serv.address') }}';
    const api_serv = '{{ config('asterisk.api_serv.address') }}';
    const socket = io.connect(`${dashboard_serv}`);
    const web_url = '{{ url('/') }}';
    const agent_username = '{{ $temporaryPhone }}';
    const exten = '{{ $temporaryPhone }}';
    const account_code = exten;
    const storedOption = localStorage.getItem('selectedOption') || '{{ $queue[0]->extension }}';
    const storedSLA = localStorage.getItem('sla_setting') || '30';

    const active_div = $('#active_total');
    const waiting_div = $('#waiting_total');
    const allcall = $('#allcall');
    const completed = $('#completed');
    const abandoned = $('#abandoned');
    const abandoned_percent = $('#abandoned_percent');
    const avg_talk = document.getElementById("avg_talk");
    const total_talk = document.getElementById("total_talk");
    const total_score = document.getElementById("total_score");
    const avg_wait = document.getElementById("avg_wait");
    const max_wait = document.getElementById("max_wait");
    const dbv = {};

    let waitData = {};
    let ring_call = {};
    let active_call = {};
    let pause_total = {};
    let warp_total = {};
    let ready_total = {};
    let offline_total = 0;
    let offline_list = [];
    let queue_name = [];
    let total_call = '';
    let completed_call = '';
    let abandoned_call = '';
    let abandonedPercentage = '';
    let waiting_total = 0;

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
        let presentTimestamp = Math.floor(Date.now() / 1000);
        let timestampSeconds = Math.floor(timestampMilliseconds);
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

                offline_list = response.agent_offline;
                response.agent_offline.forEach(element => {
                    call_list(element);
                });

                $('#agent_list tbody').html(response.html);
                offline_total = response.offline;
                queue_name = response.queue_arr;

            },
            error: function(xhr, status, error) {}
        });
    }


    let set_state = (phone, mcallexten, mcalluniq, mcallapp, mcallstate, mcallqueue) => {
        dbv[phone + '_cid'] = mcallexten;
        dbv[phone + '_time'] = mcalluniq;
        dbv[phone + '_app'] = mcallapp;
        dbv[phone + '_state'] = mcallstate;
        dbv[phone + '_queue'] = mcallqueue;
    }

    let set_status = (status, text = '') => {
        let ret_status = '';

        const statusMap = {
            'pause': `<span style="font-size: 1em; color: #ff9900;"><i class="fa-solid fa-user-clock"></i></span> พักสาย ( ${text} )`,
            'warp': `<span style="font-size: 1em; color: #ff9900;"><i class="fa-solid fa-user-pen"></i></span> Warp UP`,
            'ring': `<span style="font-size: 1em; color: red;"><i class="fa-solid fa-bell fa-beat" style="--fa-beat-scale: 2.0;"></i></span> ${text}`,
            'answer': `<span style="font-size: 1em; color: red;"><i class="fa-solid fa-phone-volume fa-beat" style="--fa-beat-scale: 1.5;"></i></span> ${text}`,
            'hold': `<span style="font-size: 1em; color: #ff9900;"><i class="fa-solid fa-user-clock fa-beat" style="--fa-beat-scale: 1.5;"></i></span> กำลังพักสาย`,
            'ready': `<span style="font-size: 1em; color: green;"><i class="fa-solid fa-user-check"></i></span> พร้อมรับสาย`,
        };

        ret_status = statusMap[status] || '';

        return ret_status;
    }

    const updateAvgData = () => {
        const storedOption = localStorage.getItem('selectedOption') || '{{ $queue[0]->extension }}';
        const storedSLA = localStorage.getItem('sla_setting') || '30';

        $.ajax({
            url: '{{ route('dashboard.avg_data') }}',
            method: 'POST',
            data: {
                queue: storedOption,
                _token: token,
            },
            success: (data) => {
                /* avg_talk.html('')
                avg_wait.html('')
                total_talk.html('')
                max_wait.html('') */
                changeText(avg_talk, '00:00:00');
                changeText(avg_wait, '00:00:00');
                changeText(total_talk, '00:00:00');
                changeText(total_score, '0');
                changeText(max_wait, '00:00:00');

                //data.avg_data.forEach((item) => {
                const item = data.avg_data;
                if (item.queue_number == storedOption) {
                    /* avg_talk.html(item.avg_talk_time)
                    avg_wait.html(item.avg_hold_time)
                    total_talk.html(item.total_talk_time)
                    max_wait.html(item.max_hold_time) */
                    changeText(avg_talk, item.avg_talk_time)
                    changeText(avg_wait, item.avg_hold_time)
                    changeText(total_talk, item.total_talk_time)
                    changeText(total_score, item.total_score)
                    changeText(max_wait, item.max_hold_time)
                }
                //});
            },
            error: (error) => {
                console.error('Error fetching data:', error);
            },
        });
    };

    const updateSLAData = () => {
        const storedOption = localStorage.getItem('selectedOption') || '{{ $queue[0]->extension }}';
        const storedSLA = localStorage.getItem('sla_setting') || '30';
        if (storedSLA == '') {
            storedSLA = 20;
        }
        $.ajax({
            url: '{{ route('dashboard.sla_data') }}',
            method: 'POST',
            data: {
                queue: storedOption,
                sla: storedSLA,
                _token: token,
            },
            success: (data) => {
                div_agent_sla_chart.setOption(agent_sla_chart(0));
                data.sla_data.forEach((item) => {
                    if (item.queue_number == storedOption) {
                        div_agent_sla_chart.setOption(agent_sla_chart(item.percentage));
                    }
                });
            },
            error: (error) => {
                console.error('Error fetching data:', error);
            },
        });
    };


    let call_list = (exten) => {
        const storedOption = localStorage.getItem('selectedOption') || '{{ $queue[0]->extension }}';
        const storedSLA = localStorage.getItem('sla_setting') || '30';
        let mcallprofile = '';
        let mcallexten = '';
        let luniq = '';
        let uniq = '';
        let mstrArray = [];
        let calls_active = 0;

        $.get(`${api_serv}/chans/` + exten, async (data, status) => {

            await data.forEach((item, index) => {
                let strArray = item.split("!");
                let chan = strArray[0].split("/");
                let phone = exten;

                $.get(`${api_serv}/chans_variable/` + chan[1], (data, status) => {
                    //if (storedOption == data[3][1]) {

                    mcallexten = data[2][1];
                    mcallqueue = data[3][1];
                    mcalluniq = data[4][1];
                    mcallapp = data[5][1];
                    mcallstate = data[6][1].replace(/\s*\(\d+\)/, '');
                    set_state(exten, mcallexten, mcalluniq, mcallapp, mcallstate,
                        mcallqueue);
                    //}

                    if (strArray[4] == 'Ringing' || strArray[4] == 'Ring') {
                        state = 'กำลังรอสาย'
                        state_icon =
                            '<i class="fa-solid fa-bell fa-beat" style="--fa-beat-scale: 2.0;"></i>';
                        state_color = 'card-danger';
                        check_box_state = 'disabled';
                    } else if (strArray[4] == 'Up' && strArray[12] == '') {
                        state = 'กำลังรอสาย'
                        state_icon =
                            '<i class="fa-solid fa-bell fa-beat" style="--fa-beat-scale: 2.0;"></i>';
                        state_color = 'card-danger';
                        check_box_state = 'disabled';
                    } else if (strArray[4] == 'Up') {
                        if (mcallapp !== 'AppQueue') {
                            active_call[mcallexten] = 1;
                        }

                        state = 'กำลังสนทนา'
                        state_icon =
                            '<i class="fa-solid fa-phone-volume fa-bounce" style=" --fa-bounce-start-scale-x: 1; --fa-bounce-start-scale-y: 1; --fa-bounce-jump-scale-x: 1; --fa-bounce-jump-scale-y: 1; --fa-bounce-land-scale-x: 1; --fa-bounce-land-scale-y: 1; "></i>';
                        state_color = 'card-danger';
                        check_box_state = '';
                    }

                });
                /* if (mcallapp !== 'AppQueue') {
                    calls_active += 1;
                } */

            });
            /* active_div.html(calls_active); */
        });
    };

    socket.on('connect', () => {
        socket.emit('join', 'Client Connect To Asterisk Event Serv');
    });

    socket.on('queuememberstatus', async (response) => {});
    socket.on('pause', data => {
        get_agent(storedOption);
    });
    socket.on('qlogoff', data => {
        get_agent(storedOption);
    });
    socket.on('qlogin', data => {
        get_agent(storedOption);
    });


    socket.on('queueparams', async (response) => {
        const storedOption = localStorage.getItem('selectedOption') || '{{ $queue[0]->extension }}';
        const storedSLA = localStorage.getItem('sla_setting') || '30';
        let res = response.data;
        if (res.queue == storedOption) {
            total_call = parseInt(res.completed) + parseInt(res.abandoned);
            abandonedPercentage = (parseFloat(res.abandoned) / total_call) * 100;
            allcall.html(total_call);
            completed.html(res.completed);
            abandoned.html(res.abandoned);
            abandoned_percent.html(abandonedPercentage.toFixed(2));
        }
    });

    socket.on('queueentry', async (response) => {
        const storedOption = localStorage.getItem('selectedOption') || '{{ $queue[0]->extension }}';
        const storedSLA = localStorage.getItem('sla_setting') || '30';
        waitData[response.data.uniqueid] = response.data;
        //console.log(waitData);

        const tableBody = $('#waiting_list tbody');

        let dataArray = Object.values(waitData);
        dataArray.sort((a, b) => parseInt(a.position) - parseInt(b.position));

        let html = '';
        waiting_total = 0;

        dataArray.forEach((item) => {
            let parsedNumber = parseInt(item.wait);
            let hours = Math.floor(parsedNumber / 3600);
            let minutes = Math.floor((parsedNumber % 3600) / 60);
            let seconds = parsedNumber % 60;

            let formattedTime =
                `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            //chek if specific queue waiting
            //if (item.queue == storedOption) {
            html += `
                <tr>
                    <td>${item.position}</td>
                    <td><i class="fa-solid fa-user-clock"></i> ${item.calleridnum}</td>
                    <td>${formattedTime}</td>
                    <td>${queue_name[item.queue]}</td>
                    <td>${item.connectedlinenum === 'unknown' ? '-' : item.connectedlinenum}</td>
                </tr>`;
            waiting_total++;
            //}
        });

        tableBody.html(html);
        //waiting_div.html(waiting_total);
        div_queue_status_chart.setOption(queue_status_chart(waiting_total));

    });

    socket.on('queuemember', async (response) => {

        const storedOption = localStorage.getItem('selectedOption') || '{{ $queue[0]->extension }}';
        const storedSLA = localStorage.getItem('sla_setting') || '30';
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
        const div_queue = $('#' + phone_number + '_queue');

        if (res.queue == storedOption) {
            if (res.status == 5 || res.status == 0) {
                phone_status = `<span style="font-size: 1em; color: red;">
                    <i class="fa-solid fa-triangle-exclamation"></i></span> ` + phone_number
                status = 'โทรศัพท์ไม่พร้อมใช้งาน'
            } else {
                phone_status = phone_number
            }

            if (res.status == 6) {
                await call_list(phone_number);
                ring_cid = dbv[phone_number + '_cid'];
                ring_time = dbv[phone_number + '_time'];
                ring_app = dbv[phone_number + '_app'];
                ring_queue = dbv[phone_number + '_queue'];
                ring_state = dbv[phone_number + '_state'];

                let ring_text;
                if (ring_app === 'AppQueue') {
                    ring_call[phone_number] = 1;
                    ring_text = 'กำลังรอสาย';
                } else {
                    ring_text = 'กำลังรอสาย';
                }

                state_dur = duration_miltime(ring_time);
                status = set_status('ring', ring_text);
                div_src.html(ring_cid);
                div_queue.html(queue_name[ring_queue]);
            } else if (res.status == 2) {
                call_list(phone_number);

                ans_cid = dbv[phone_number + '_cid'];
                ans_time = dbv[phone_number + '_time'];
                ans_app = dbv[phone_number + '_app'];
                ans_state = dbv[phone_number + '_state'];
                ans_queue = dbv[phone_number + '_queue'];
                state_dur = duration_miltime(ans_time);

                let ans_text;
                if (ans_state === 'Up') {
                    ans_text = 'กำลังสนทนา';
                } else {
                    ans_text = 'กำลังรอสาย';
                }

                if (ans_app === 'AppQueue') {
                    active_call[phone_number] = 1;
                }

                status = set_status('answer', ans_text);
                div_src.html(ans_cid);
                div_queue.html(queue_name[ans_queue]);
            } else if (res.status == 8) {
                active_call[phone_number] = 1;
                status = set_status('hold', '');
            } else if (res.paused == 1) {
                if (res.pausedreason == 'Warp UP') {
                    state_dur = duration_time(res.lastpause);
                    warp_total[phone_number] = 1;
                    status = set_status('warp', '');
                } else {
                    state_dur = duration_time(res.lastpause);
                    pause_total[phone_number] = 1;
                    status = set_status('pause', res.pausedreason);
                }
                div_src.html('');
                div_queue.html(queue_name[res.queue]);
            } else if (res.status == 1) {
                delete warp_total[phone_number];
                delete pause_total[phone_number];
                ready_total[phone_number] = 1;

                if (res.lastpause === '0') {
                    if (res.lastcall === '0') {
                        loginTime = new Date($('#' + phone_number + '_login').val()).getTime() / 1000;
                        state_dur = duration_time(loginTime);
                    } else {
                        state_dur = duration_time(res.lastcall);
                    }
                } else {
                    state_dur = duration_time(res.lastpause);
                }
                status = set_status('ready', '');
                div_src.html('');
                div_queue.html(queue_name[res.queue]);
            }

            $('#' + phone_number + '_status').html(status);
            $('#' + phone_number + '_phone').html(phone_status);
            $('#' + phone_number + '_duration').html(state_dur);

            let num_ring = Object.keys(ring_call).length;
            let num_active = Object.keys(active_call).length;
            let num_busy = num_active + num_ring;
            let num_pause = Object.keys(pause_total).length;
            let num_warp = Object.keys(warp_total).length;
            let num_ready = Object.keys(ready_total).length - (num_active + num_ring) - num_pause -
                num_warp;
            //let num_offline = offline_total - (num_busy + num_pause + num_ready)
            let num_offline = offline_total;
            //active_div.html(num_active);
            div_agent_status_chart.setOption(agent_status_chart(num_offline, num_ready, num_pause, num_warp,
                num_busy));
            div_queue_status_chart_talk.setOption(queue_status_chart_talk(num_active));

        }

    });


    socket.on('agentcomplete', async (response) => {
        await delete active_call[response.data.connectedlinenum];
        if (Object.keys(active_call).length === 0) {
            //active_div.html('0');
            div_queue_status_chart_talk.setOption(queue_status_chart_talk(0));
        }
    });

    socket.on('agentdump', async (response) => {
        //console.log(response)
        await delete active_call[response.data.connectedlinenum];
        if (Object.keys(active_call).length === 0) {
            //active_div.html('0');
            div_queue_status_chart_talk.setOption(queue_status_chart_talk(0));
        }
    });

    socket.on('hangup', async (data) => {
        if (data.extension) {
            var extractedNumber;
            var splitResult
            if (data.extension.includes('/')) {
                splitResult = data.extension.split('/');
                extractedNumber = splitResult[1].split('-')[0];
            } else {
                extractedNumber = data.extension
            }
            $('#' + extractedNumber + '_queue').html('');
            await delete ring_call[extractedNumber];
            if (Object.keys(ring_call).length === 0) {
                //waiting_div.html('0');
                div_queue_status_chart.setOption(queue_status_chart(0));
            }

            await delete active_call[extractedNumber];
            if (Object.keys(active_call).length === 0) {
                //active_div.html('0');
                div_queue_status_chart_talk.setOption(queue_status_chart_talk(0));
            }


        } else {
            console.log("Extension property is missing in the data object");
        }
    });


    socket.on('agentcalled', async (response) => {
        //console.log(response)
        let res = response.data;
        dbv[res.destcalleridnum + '_cid'] = res.calleridnum;
        dbv[res.destcalleridnum + '_time'] = res.timestamp;
        $('#' + res.destcalleridnum + '_src').html(res.calleridnum);
        $('#' + res.destcalleridnum + '_queue').html(queue_name[res.queue]);
    });

    socket.on('agentconnect', async (response) => {
        //console.log(response)
        let res = response.data;
        dbv[res.destcalleridnum + '_cid'] = res.calleridnum;
        dbv[res.destcalleridnum + '_time'] = Math.floor(Date.now() / 1000);
        $('#' + res.destcalleridnum + '_src').html(res.calleridnum);
        $('#' + res.destcalleridnum + '_queue').html(queue_name[res.queue]);
    });


    socket.on('queuecallerjoin', async (response) => {
        //waitData[response.data.uniqueid] = response.data;
        //console.log(waitData);

    });

    socket.on('queuecallerabandon', async (response) => {
        //waitData[response.data.uniqueid] = response.data;
        //console.log(response);
        await delete active_call[response.data.connectedlinenum];
        if (Object.keys(active_call).length === 0) {
            //active_div.html('0');
            div_queue_status_chart_talk.setOption(queue_status_chart_talk(0));
        }
    });

    socket.on('queuecallerleave', async (response) => {
        const tableBody = $('#waiting_list tbody');
        await delete waitData[response.data.uniqueid];
        if (Object.keys(waitData).length === 0) {
            tableBody.html(
                '<tr><td colspan="5" style="text-align: center;">ยังไม่มีสายรอในคิว</td></tr>');
            div_queue_status_chart.setOption(queue_status_chart(0));
        }
        //console.log(waitData);
    });


    const sendAjaxRequest = (url, method, data = {}) => {
        $.ajax({
            url,
            method,
            data,
            async: false,
        });
    };


    $(document).on('change', '#modal_sla', function(e) {
        e.preventDefault();
        let sla = $('#modal_sla').val();
        localStorage.setItem('sla_setting',
            sla);
        updateSLAData();
    });


    $(document).on('click', '.btn-logoff', function(e) {
        e.preventDefault();
        const lid = $(this).data('id');
        const additionalData = {
            id: lid,
            logout: 0,
        };
        ezBSAlert({
            type: "confirm",
            headerText: "Confirm",
            messageText: "ยืนยันการออกจากระบบรับสาย?",
            alertType: "info",
        }).done(function(r) {
            if (r == true) {
                sendAjaxRequest("{{ route('sup.logoff_agent') }}", "POST", additionalData);
            }
        });
    });

    $(document).on('click', '.btn-logout', function(e) {
        e.preventDefault();
        const lid = $(this).data('id');
        const additionalData = {
            id: lid,
            logout: 1,
        };
        ezBSAlert({
            type: "confirm",
            headerText: "Confirm",
            messageText: "ยืนยันการเตะ Agent ออกจากระบบรับสาย?",
            alertType: "info",
        }).done(function(r) {
            if (r == true) {
                sendAjaxRequest("{{ route('sup.logoff_agent') }}", "POST", additionalData);
            }
        });
    });


    $(document).on('click', '.btn-spy', function(e) {
        e.preventDefault();
        const call_number = $(this).data('id');
        const additionalData = {
            telno: call_number,
            mode: 'ดักฟัง'
        };
        $.get(`${api_serv}/spy/` + call_number + "/" + exten + "/" + account_code + "/o", (data, status) => {
            if (status == 'success') {
                sendAjaxRequest("{{ route('agent.spy') }}", "POST", additionalData);
                const prom = ezBSAlert({
                    headerText: "OK",
                    messageText: "ดักฟัง สำเร็จ",
                    alertType: "success",
                });
            } else {
                const prom = ezBSAlert({
                    headerText: "Error",
                    messageText: "ดักฟัง ไม่สำเร็จ",
                    alertType: "danger",
                });
            }
        });

    });


    $(document).on('click', '.btn-whis', function(e) {
        e.preventDefault();
        const call_number = $(this).data('id');
        const additionalData = {
            telno: call_number,
            mode: 'กระซิบ'
        };
        $.get(`${api_serv}/spy/` + call_number + "/" + exten + "/" + account_code + "/w", (data, status) => {
            if (status == 'success') {
                sendAjaxRequest("{{ route('agent.spy') }}", "POST", additionalData);
                const prom = ezBSAlert({
                    headerText: "OK",
                    messageText: "กระซิบ สำเร็จ",
                    alertType: "success",
                });
            } else {
                const prom = ezBSAlert({
                    headerText: "Error",
                    messageText: "กระซิบ ไม่สำเร็จ",
                    alertType: "danger",
                });
            }
        });

    });

    $(document).on('click', '.btn-barge', function(e) {
        e.preventDefault();
        const call_number = $(this).data('id');
        const additionalData = {
            telno: call_number,
            mode: 'แทรกสาย'
        };
        $.get(`${api_serv}/spy/` + call_number + "/" + exten + "/" + account_code + "/B", (data, status) => {
            if (status == 'success') {
                sendAjaxRequest("{{ route('agent.spy') }}", "POST", additionalData);
                const prom = ezBSAlert({
                    headerText: "OK",
                    messageText: "แทรกสาย สำเร็จ",
                    alertType: "success",
                });
            } else {
                const prom = ezBSAlert({
                    headerText: "Error",
                    messageText: "แทรกสาย ไม่สำเร็จ",
                    alertType: "danger",
                });
            }
        });

    });

    $(document).on('click', '.btn-pause', function(e) {
        e.preventDefault();
        const pid = $(this).data('id');
        const additionalData = {
            id: pid,
        };
        ezBSAlert({
            type: "confirm",
            headerText: "Confirm",
            messageText: "ยืนยันการพักสาย Agent?",
            alertType: "info",
        }).done(function(r) {
            if (r == true) {
                sendAjaxRequest("{{ route('sup.break_agent') }}", "POST", additionalData);
            }
        });
    });

    $(document).on('click', '.btn-unpause', function(e) {
        e.preventDefault();
        const pid = $(this).data('id');
        const additionalData = {
            id: pid,
        };
        ezBSAlert({
            type: "confirm",
            headerText: "Confirm",
            messageText: "ยืนยันการหยุดพักสาย Agent?",
            alertType: "info",
        }).done(function(r) {
            if (r == true) {
                sendAjaxRequest("{{ route('sup.unbreak_agent') }}", "POST", additionalData);
            }
        });
    });


    $(document).ready(() => {

        if (storedOption) {
            selectElement.val(storedOption);
        }
        if (storedSLA) {
            selectSLA.val(storedSLA)
        }

        get_agent(storedOption);
        updateAvgData();
        setInterval(updateAvgData, 20000);
        updateSLAData();
        setInterval(updateSLAData, 30000);
        sla_count();
        setInterval(sla_count, 30000);

        div_agent_status_chart.setOption(agent_status_chart(0, 0, 0, 0));
        div_queue_status_chart.setOption(queue_status_chart(waiting_total));
        div_queue_status_chart_talk.setOption(queue_status_chart_talk(active_call));
        window.addEventListener('resize', div_agent_status_chart.resize);
        window.addEventListener('resize', div_queue_status_chart.resize);
        window.addEventListener('resize', div_queue_status_chart_talk.resize);

        setInterval(function() {
            offline_list.forEach(element => {
                logoffTime = new Date($('#' + element + '_logoff').val()).getTime() / 1000;
                $('#' + element + '_duration').html(duration_time(logoffTime));
            });
        }, 1000);

        selectElement.on('change', () => {
            const selectedOption = selectElement.val();
            if (selectedOption) {
                localStorage.setItem('selectedOption',
                    selectedOption);
            }

            allcall.html(0);
            completed.html(0);
            abandoned.html(0);
            abandoned_percent.html(0.0);

            get_agent(selectedOption);
            updateSLAData();
            updateAvgData();
        });

        /* setInterval(() => {
        socket.emit('getqueue', {
            queue: storedOption,
        });
    }, 1000); */
    });
</script>
