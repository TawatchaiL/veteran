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
        /* const gaugeData = [{
                value: wait,
                name: 'รอสาย',
                title: {
                    offsetCenter: ['-40%', '80%']
                },
                detail: {
                    offsetCenter: ['-40%', '95%']
                }
            },
            {
                value: talk,
                name: 'สนทนา',
                title: {
                    offsetCenter: ['0%', '80%']
                },
                detail: {
                    offsetCenter: ['0%', '95%']
                }
            }
        ]; */
        let option = {
            series: [{
                type: 'gauge',
                min: 0,
                max: 10,
                progress: {
                    show: true,
                    width: 18
                },
                axisLine: {
                    lineStyle: {
                        width: 18
                    }
                },
                axisTick: {
                    show: false
                },
                splitLine: {
                    length: 15,
                    lineStyle: {
                        width: 2,
                        color: '#999'
                    }
                },
                axisLabel: {
                    distance: 25,
                    color: '#999',
                    fontSize: 20
                },
                anchor: {
                    show: true,
                    showAbove: true,
                    size: 25,
                    itemStyle: {
                        borderWidth: 10
                    }
                },
                title: {
                    show: false
                },
                detail: {
                    valueAnimation: true,
                    fontSize: 80,
                    offsetCenter: [0, '70%']
                },
                data: [{
                    value: data,
                    name: 'รอสาย',
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
    const storedOption = localStorage.getItem('selectedOption');
    const storedSLA = localStorage.getItem('sla_setting');

    const active_div = $('#active_total');
    const waiting_div = $('#waiting_total');
    const allcall = $('#allcall');
    const completed = $('#completed');
    const abandoned = $('#abandoned');
    const abandoned_percent = $('#abandoned_percent');
    const avg_talk = document.getElementById("avg_talk");
    const total_talk = document.getElementById("total_talk");
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

                offline_list = response.agent_offline;
                response.agent_offline.forEach(element => {
                    call_list(element);
                });

                $('#agent_list tbody').html(response.html);
                offline_total = response.offline;
                queue_name = response.queue_arr;

            },
            error: function(xhr, status, error) {
                // Handle errors
            }
        });
    }


    let set_state = (phone, mcallexten, mcalluniq, mcallapp, mcallstate) => {
        dbv[phone + '_cid'] = mcallexten;
        dbv[phone + '_time'] = mcalluniq;
        dbv[phone + '_app'] = mcallapp;
        dbv[phone + '_state'] = mcallstate;
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
        const storedOption = localStorage.getItem('selectedOption');
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

                data.avg_data.forEach((item) => {
                    if (item.queue_number == storedOption) {
                        /* avg_talk.html(item.avg_talk_time)
                        avg_wait.html(item.avg_hold_time)
                        total_talk.html(item.total_talk_time)
                        max_wait.html(item.max_hold_time) */
                        changeText(avg_talk, item.avg_talk_time)
                        changeText(avg_wait, item.avg_hold_time)
                        changeText(total_talk, item.total_talk_time)
                        changeText(max_wait, item.max_hold_time)
                    }
                });
            },
            error: (error) => {
                console.error('Error fetching data:', error);
            },
        });
    };

    const updateSLAData = () => {
        const storedOption = localStorage.getItem('selectedOption');
        const storedSLA = localStorage.getItem('sla_setting');
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
        const storedOption = localStorage.getItem('selectedOption');
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
                    set_state(exten, mcallexten, mcalluniq, mcallapp, mcallstate);
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
        const storedOption = localStorage.getItem('selectedOption');
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
        const storedOption = localStorage.getItem('selectedOption');
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
                    state_dur = duration_time(res.lastpause);
                    warp_total[phone_number] = 1;
                    status = set_status('warp', '');
                } else {
                    state_dur = duration_time(res.lastpause);
                    pause_total[phone_number] = 1;
                    status = set_status('pause', res.pausedreason);
                }
                div_src.html('');
            } else if (res.status == 6) {
                await call_list(phone_number);
                ring_cid = dbv[phone_number + '_cid'];
                ring_time = dbv[phone_number + '_time'];
                ring_app = dbv[phone_number + '_app'];
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
            } else if (res.status == 2) {
                call_list(phone_number);

                ans_cid = dbv[phone_number + '_cid'];
                ans_time = dbv[phone_number + '_time'];
                ans_app = dbv[phone_number + '_app'];
                ans_state = dbv[phone_number + '_state'];
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
            } else if (res.status == 8) {
                active_call[phone_number] = 1;
                status = set_status('hold', '');
            } else if (res.status == 1) {

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
            }

            $('#' + phone_number + '_status').html(status);
            $('#' + phone_number + '_phone').html(phone_status);
            //$('#' + phone_number + '_queue').html(res.queue);
            $('#' + phone_number + '_duration').html(state_dur);

            let num_ring = Object.keys(ring_call).length;
            let num_active = Object.keys(active_call).length;
            let num_busy = num_active + num_ring;
            let num_pause = Object.keys(pause_total).length;
            let num_warp = Object.keys(warp_total).length;
            let num_ready = Object.keys(ready_total).length - (num_active + num_ring);
            //let num_offline = offline_total - (num_busy + num_pause + num_ready)
            let num_offline = offline_total;

            console.log(num_warp);
            //active_div.html(num_active);
            div_agent_status_chart.setOption(agent_status_chart(num_offline, num_ready, num_pause, num_warp,
                num_busy));
            div_queue_status_chart_talk.setOption(queue_status_chart(num_active));

        }

    });


    socket.on('agentcomplete', async (response) => {
        await delete active_call[response.data.connectedlinenum];
        if (Object.keys(active_call).length === 0) {
            //active_div.html('0');
            div_queue_status_chart_talk.setOption(queue_status_chart(0));
        }
    });

    socket.on('agentdump', async (response) => {
        //console.log(response)
        await delete active_call[response.data.connectedlinenum];
        if (Object.keys(active_call).length === 0) {
            //active_div.html('0');
            div_queue_status_chart_talk.setOption(queue_status_chart(0));
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
                div_queue_status_chart_talk.setOption(queue_status_chart(0));
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
            div_queue_status_chart_talk.setOption(queue_status_chart(0));
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


    $(document).on('change', '#modal_sla', function(e) {
        e.preventDefault();
        let sla = $('#modal_sla').val();
        localStorage.setItem('sla_setting',
            sla);
        updateSLAData();
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
        div_queue_status_chart_talk.setOption(queue_status_chart(active_call));
        window.addEventListener('resize', div_agent_status_chart.resize);

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

            get_agent(selectedOption);
            updateSLAData();
        });

        /* setInterval(() => {
        socket.emit('getqueue', {
            queue: storedOption,
        });
    }, 1000); */
    });
</script>
