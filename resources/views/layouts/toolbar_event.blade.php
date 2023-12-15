<script src="{{ config('asterisk.toolbar_serv.address') }}/socket.io/socket.io.js"></script>
<script>
    const formatTime = seconds => {
        const hours = Math.floor(seconds / 3600);
        const minutes = Math.floor((seconds % 3600) / 60);
        const remainingSeconds = Math.floor(seconds % 60);

        return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(remainingSeconds).padStart(2, '0')}`;
    };

    const socket = io.connect(`${toolbar_serv}`);
    socket.on('connect', data => {
        socket.emit('join', 'Client Connect To Asterisk Event Serv');
    });

    //agent receive call
    socket.on('agentconnect', (response) => {
        //console.log(response)
    });

    //agent answer call
    socket.on('agentcalled', (response) => {

    });

    socket.on('queuemember', (response) => {
        //console.log(response)
        if (response.data.paused == 1 && response.data.name == exten) {
            //const currentTimestamp = Math.floor(Date.now() / 1000) - response.data.lastpause;
            const currentTimestamp = (response.timestamp / 1000) - response.data.lastpause;
            const formattedTime = formatTime(currentTimestamp);
            $('#pausereason').html(response.data.pausedreason);
            $('#pausedur').html(formattedTime);
        }

    });

    socket.on('unwarp', (response) => {
        $.ajax({
            url: "{{ route('agent.hang') }}",
            method: 'post',
            async: true,
            data: {
                extension: response.phone,
                _token: token,
            },
            success: function(result) {
                setTimeout(() => {
                    set_state_icon(result.id, result.icon, result.message);
                    set_state_button(result.id);
                }, 1000);
                //positionCards();
            }
        });
    });


    //agent or caller hangup after talk
    socket.on('agentcomplete', async (response) => {
        if (response.data.membername == exten) {
            $.ajax({
                url: "{{ route('agent.warp') }}",
                method: 'post',
                async: true,
                data: {
                    exten: response.data.membername,
                    uniqid: response.data.uniqueid,
                    _token: token,
                },
                success: function(result) {
                    console.log(result)
                    setTimeout(() => {
                        set_state_icon(result.id, result.icon, result.message);
                        set_state_button(result.id);
                    }, 1000);

                    call_list();

                    @if (Request::is('home'))
                        updateAvgData();
                        handleDataHour();
                        handleDataDate();
                        handleCaseDataDate();
                        handleCallSurveyData();
                    @endif

                }
            });
        }
    });


    //queue wait list on agent
    socket.on('queuecallerjoin', async (response) => {
        const dropdownButton = $('#queue_wait_button');
        if (dropdownButton.length > 0 && !isDropdownClicked) {
            dropdownButton.click();
            isDropdownClicked = true;
        }

        //alert_danger('Alert', 'มีสายรอในคิว ' + response.data.count + ' สาย', '');
        /*  alert_danger('Alert สายเข้าจาก ' + response.data.calleridnum, 'มีสายเข้าคิวจากหมายเลข: ' + response
             .data.calleridnum + '<br>ในลำดับ: ' + response
             .data.position, ''); */
    });



    socket.on('queueentry', async (response) => {
        waitData[response.data.uniqueid] = response.data;
        //$('#queue_wait').html(`( ${Object.keys(waitData).length} )`);
        const tableBody = $('#queue_wait_list');

        let dataArray = Object.values(waitData);
        dataArray.sort((a, b) => parseInt(a.position) - parseInt(b.position));

        let html = '';
        dataArray.forEach((item) => {
            let parsedNumber = parseInt(item.wait);
            let hours = Math.floor(parsedNumber / 3600);
            let minutes = Math.floor((parsedNumber % 3600) / 60);
            let seconds = parsedNumber % 60;

            let formattedTime =
                `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            html += `
                <a href="#" class="dropdown-item">
                    <div class="media ">
                        <img src="{{ asset('images/user.png') }}" alt="..." class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                ${item.calleridnum}
                                <span class="float-right text-sm text-danger"><i class="fa-solid fa-sync fa-spin"></i></span>
                            </h3>
                            <p class="text-sm text-muted">Queue ${item.queue}</p>
                            <p class="text-sm">ลำดับที่ ${item.position}</p>
                            <p class="text-sm text-muted"><i class="far fa-clock fa-bounce mr-1"></i>${formattedTime}</p>
                            <p class="text-sm text-muted">Agent ${item.connectedlinenum === 'unknown' ? '-' : item.connectedlinenum}</p>
                        </div>
                    </div>

                </a>
                <div class="dropdown-divider"></div>`;
        });

        tableBody.html(html);
        changeText(`( ${Object.keys(waitData).length} )`);
    });

    socket.on('queuecallerleave', async (response) => {
        await delete waitData[response.data.uniqueid];
        const tableBody = $('#queue_wait_list');
        if (Object.keys(waitData).length === 0) {
            //$('#queue_wait').html('( 0 )');
            tableBody.html(`<a href="#" class="dropdown-item hold_tab_a">
                        <div class="media ">
                            <img src="{{ asset('images/user.png') }}" alt="..." class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                ยังไม่มีสายรออยู่ในคิว
                                </h3>
                            </div>
                        </div>

                    </a>
                    <div class="dropdown-divider"></div>`);
            changeText('( 0 )');
            isDropdownClicked = false;
        }
    });
    //queue wait list on agent

    socket.on('queuecallerabandon', async (response) => {
        //positionCards();
    });

    socket.on('agentdump', async (response) => {
        //positionCards();
    });

    socket.on('peerstatus', async (data) => {
        let peer = data.extension.split("/");
        if (peer[1] == exten) {
            if (data.status == 'Unregistered') {
                $.ajax({
                    url: "{{ route('agent.phone_unregis') }}",
                    method: 'post',
                    async: false,
                    success: function(result) {
                        set_state_icon(result.id, result.icon, result.message);
                        set_state_button(result.id);
                    }
                });
                /* toolbar_header.removeClass("bg-primary");
                toolbar_header.addClass("bg-secondary"); */
                /* state_overlay.removeClass("d-none");
                toolbar_card.addClass("d-none");
                popup_tab_main.addClass("d-none");
                toolbar_modal.modal('show'); */
            } else if (data.status == 'Registered') {
                state_overlay.addClass("d-none");
                toolbar_card.removeClass("d-none");
                popup_tab_main.removeClass("d-none");
                $.ajax({
                    url: "{{ route('agent.hang') }}",
                    method: 'post',
                    async: false,
                    data: {
                        extension: data.extension,
                        _token: token,
                    },
                    success: function(result) {
                        set_state_icon(result.id, result.icon, result.message);
                        set_state_button(result.id);
                        //positionCards();
                    }
                });
                //toolbar_modal.modal('hide');
            }
        }
    });

    socket.on('event', async (data) => {

        if (data.extension == exten) {
            if (data.status == 4 || data.status == -1) {
                //toolbar_header.addClass("bg-secondary");
            } else if (data.status == 0) {
                //toolbar_header.addClass("bg-primary");
                $.ajax({
                    url: "{{ route('agent.hang') }}",
                    method: 'post',
                    async: true,
                    data: {
                        extension: data.extension,
                        _token: token,
                    },
                    success: function(result) {
                        setTimeout(() => {
                            set_state_icon(result.id, result.icon, result.message);
                            set_state_button(result.id);
                        }, 1000);
                        //positionCards();
                        $('#custom-tabs-pop-' + result.tab_id + '-tab').remove();
                        $('#custom-tabs-pop-' + result.tab_id).remove();
                    }
                });
            } else if (data.status == 1 || data.status == 2 || data.status == 8 || data.status == 9) {
                //toolbar_header.addClass("bg-danger");
            } else if (data.status == 16 || data.status == 17) {
                //toolbar_header.addClass("bg-danger");
            }

        }
    });


    socket.on('pause', data => {
        if (data.extension.match(exten) && data.paused == 0) {
            /* toolbar_header.removeClass("bg-warning");
            toolbar_header.addClass("bg-primary"); */
            $('#pausedur').html('');
            $('#pausereason').html('');
            //localStorage.removeItem('warp');
        } else if (data.extension.match(exten) && data.paused == 1) {
            /* toolbar_header.removeClass("bg-primary bg-secondary bg-danger");
            toolbar_header.addClass("bg-warning"); */

        }

        /* $.ajax({
            url: "{{ route('agent.status') }}",
            method: 'post',
            async: false,
            data: {
                _token: token,
            },
            success: function(result) {
                set_state_icon(result.id, result.icon, result.message);
                set_state_button(result.id);
            }
        }); */
    });

    socket.on('qlogoff', data => {

        if (data.extension.match(exten)) {
            $.ajax({
                url: "{{ route('agent.kick') }}",
                method: 'post',
                async: false,
                data: {
                    _token: token,
                },
                success: function(result) {
                    if (result == 1) {
                        const errorMessage = "คุณถูกเตะออกจากระบบ กรุณาล็อกอิน";
                        const encodedErrorMessage = encodeURIComponent(errorMessage);
                        window.location.replace(`${web_url}/login?error=${encodedErrorMessage}`);
                    } else {
                        setTimeout(() => {
                            set_state_icon(result.id, result.icon, result.message);
                            set_state_button(result.id);
                        }, 1000);

                        /*  $.ajax({
                             url: "{{ route('agent.hang') }}",
                             method: 'post',
                             async: true,
                             data: {
                                 extension: data.extension,
                                 _token: token,
                             },
                             success: function(result) {
                                 set_state_icon(result.id, result.icon, result.message);
                                 set_state_button(result.id);
                                 //positionCards();
                             }
                         }); */
                    }

                }
            });
        }

    });


    socket.on('ringing', data => {

        if (data.extension.match(sipexten)) {
            console.log('ring')
            let peer = data.extension.split("-");
            let peern = peer[0].split("/");

            $.ajax({
                url: "{{ route('agent.ring') }}",
                method: 'post',
                async: false,
                data: {
                    uniqid: data.luniq,
                    context: data.context,
                    telno: data.cid,
                    agentno: peern[1],
                    _token: token,
                },
                success: function(result) {
                    set_state_icon(result.id, result.icon, result.message);
                    set_state_button(result.id);
                    positionCards();
                }
            });


            let state_icon = '<i class="fa-solid fa-bell fa-beat" style="--fa-beat-scale: 2.0;"></i>';
            let state = 'กำลังรอสาย';

            if (!$('#' + data.luniq.replace('.', '')).length) {

                $('#call_list').prepend(`<div class="col-md-3" id = "${data.luniq.replace('.', '')}">
                <div class="card card-danger" id = "color_${data.luniq.replace('.', '')}">
                    <div class="card-header">
                        <h3 class="card-title" id = "state_${data.luniq.replace('.', '')}"> ${state_icon} ${state} ${data.cid}</h3>
                        <div class="card-tools">
                            <div ><input type="checkbox" style="width: 20px; height: 20px;" name="call[]" id="call_${data.luniq.replace('.', '')}" value="${data.extension}" disabled></div>
                        </div>
                    </div>
                    <div class="card-body card-content">
                    </div>
                    <div class="card-footer text-muted text-right">
                        <a href="#" class="btn btn-warning hold_call d-none" data-id="${peern[1]}"><i class="fa-solid fa-pause"></i> Hold</a>
                        <a href="#" class="btn btn-success answer_call" data-id="${peern[1]}"><i class="fa-solid fa-phone-volume"></i> รับสาย</a>
                        <a href="#" class="btn btn-danger hangup_call" data-id="${data.extension}"><i class="fa-solid fa-phone-slash"></i> วางสาย</a>
                    </div>
                </div>
                </div>`);
                call_list();
                toolbar_modal.modal('show');


            }

            btn_pause.attr('disabled', true);
            btn_agent_logout.attr('disabled', true);
            btn_agent_logoff.attr('disabled', true);

        }
        //call_list();
    });

    socket.on('talking', data => {

        if (data.extension.match(sipexten)) {
            console.log('talk')
            console.log(data)
            $.ajax({
                url: "{{ route('agent.talk') }}",
                method: 'post',
                async: false,
                data: {
                    uniqid: data.luniq,
                    telno: data.cid,
                    agentno: data.dstnumber,
                    context: data.context,
                    _token: token,
                },
                success: function(result) {
                    call_list();
                    set_state_icon(result.id, result.icon, result.message);
                    set_state_button(result.id);
                    //positionCards();
                    toolbar_modal.modal('show');
                }
            });

        }

    });

    socket.on('hold', data => {
        if (data.extension.match(sipexten)) {
            $.ajax({
                url: "{{ route('agent.hold') }}",
                method: 'post',
                async: false,
                data: {
                    uniqid: data.luniq,
                    _token: token,
                },
                success: function(result) {
                    $('#state_' + data.luniq.replace('.', '')).html(
                        `<i class="fa-solid fa-pause fa-bounce" style=" --fa-bounce-start-scale-x: 1; --fa-bounce-start-scale-y: 1; --fa-bounce-jump-scale-x: 1; --fa-bounce-jump-scale-y: 1; --fa-bounce-land-scale-x: 1; --fa-bounce-land-scale-y: 1; "></i> Hold ${data.cid}`
                    );
                    $('#color_' + data.luniq.replace('.', '')).removeClass("card-danger");
                    $('#color_' + data.luniq.replace('.', '')).addClass("card-warning");
                }
            });
        }
    });

    socket.on('unhold', data => {
        if (data.extension.match(sipexten)) {
            $.ajax({
                url: "{{ route('agent.unhold') }}",
                method: 'post',
                async: false,
                data: {
                    uniqid: data.luniq,
                    _token: token,
                },
                success: function(result) {
                    $('#state_' + data.luniq.replace('.', '')).html(
                        `<i class="fa-solid fa-phone-volume fa-bounce" style=" --fa-bounce-start-scale-x: 1; --fa-bounce-start-scale-y: 1; --fa-bounce-jump-scale-x: 1; --fa-bounce-jump-scale-y: 1; --fa-bounce-land-scale-x: 1; --fa-bounce-land-scale-y: 1; "></i> Talking ${data.cid}`
                    );
                    $('#color_' + data.luniq.replace('.', '')).removeClass("card-warning");
                    $('#color_' + data.luniq.replace('.', '')).addClass("card-danger");
                }
            });

        }

    });



    socket.on('hangup', data => {
        if (data.extension) {
            if (data.extension.match(sipexten)) {
                console.log(data);
                if (data.luniq) {
                    //check answer announce
                    if (data.chanstate !== 'Up') {
                        $('#' + data.luniq.replace('.', '')).remove();
                    }
                }
                if ((data.event == 'BridgeLeave' || data.event == 'SoftHangupRequest')) {

                    /* $.ajax({
                        url: "{{ route('agent.status') }}",
                        method: 'post',
                        async: false,
                        data: {
                            _token: token,
                        },
                        success: function(result) {
                            set_state_icon(result.id, result.icon, result.message);
                            set_state_button(result.id);
                        }
                    }); */
                    //check_state();

                } else {
                    //check answer announce
                    if (data.chanstate !== 'Up') {
                        call_list();
                    }

                }

            }

        }
    });


    socket.on('disconnect', data => {
        socket.emit('join', 'Bye from client');
    });
</script>
