<script src="{{ config('asterisk.event_serv.address') }}/socket.io/socket.io.js"></script>
<script>

    //event socket
    const socket = io.connect(`${event_serv}`);
    socket.on('connect', data => {
        socket.emit('join', 'Client Connect To Asterisk Event Serv');
    });

    socket.on('event', async (data) => {
        if (data.extension == exten) {
            if (data.status == 4 || data.status == -1) {
                $.ajax({
                    url: "{{ route('agent.phone_unregis') }}",
                    method: 'post',
                    async: false,
                    success: function(result) {
                        set_state_icon(result.id,result.icon,result.message);
                        set_state_button(result.id);
                    }
                });
                toolbar_header.removeClass("bg-primary");
                toolbar_header.addClass("bg-secondary");
                state_overlay.removeClass("d-none");
                toolbar_modal.modal('show');
            } else {
                state_overlay.addClass("d-none");
                toolbar_header.removeClass("bg-primary bg-secondary bg-danger");
                if (data.status == 0) {
                    $.ajax({
                        url: "{{ route('agent.hang') }}",
                        method: 'post',
                        async: false,
                        data: {
                            extension: data.extension,
                            _token: token,
                        },
                        success: function(result) {
                            set_state_icon(result.id,result.icon,result.message);
                            set_state_button(result.id);
                            positionCards();
                        }
                    });
                    toolbar_header.addClass("bg-primary");
                    //toolbar_modal.modal('hide');
                } else if (data.status == 1 || data.status == 2 || data.status == 8 || data.status == 9) {
                    toolbar_header.addClass("bg-danger");
                } else if (data.status == 16 || data.status == 17) {
                    toolbar_header.addClass("bg-danger");
                }

            }
        }
    });


    socket.on('pause', data => {

        if (data.extension.match(exten) && data.paused == 0) {
            console.log(data);
            $.get(`${web_url}/agent/clear_pause/`, (data, status) => {
                if (data == 'success') {
                    $('#dial_number').attr('disabled', false);
                    $('.button_dial').attr('disabled', false);
                    $('.button_tranfer').attr('disabled', false);
                    $('.button_conf').attr('disabled', false);
                    $('#btn-wrap').attr('disabled', true);
                    $('#btn-pause').attr('disabled', false);
                    $('#btn-system-logout').attr('disabled', false);
                    $('#btn-agent-logout').attr('disabled', false);
                    $('.button_unbreak').addClass("d-none");
                    $('#break_group').removeClass("d-none");
                    $('#break_text').remove();
                    $('#toolbar_header').addClass("card-primary");
                    $('#toolbar_header').removeClass("card-warning");
                    //alert_success('OK', 'Complete Call Success', '');
                }

            });
        }
    });

    //logoff by remove queue member
    socket.on('qlogoff', data => {

        if (data.extension.match(exten)) {
            console.log(data)
            $.get(`${web_url}/agent/kick/`, (dataw, status) => {
                if (dataw) {
                    window.location.replace(`${web_url}/auth/agent_kick`);
                }
            });
        }

    });


    socket.on('ringing', data => {

        if (data.extension.match(exten)) {
            console.log(data);

            $.ajax({
                url: "{{ route('agent.ring') }}",
                method: 'post',
                async: false,
                data: {
                    uniqid: data.luniq,
                    context: data.context,
                    telno: data.cid,
                    agentno: data.destexten,
                    _token: token,
                },
                success: function(result) {
                    set_state_icon(result.id,result.icon,result.message);
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
							<a href="#" class="btn btn-danger hangup_call" data-id="${data.extension}"><i class="fa-solid fa-phone-slash"></i> วางสาย</a>
							</div>
						</div>
					</div>`);
                //$('#ToolbarModal').modal('show');


            }

            btn_pause.attr('disabled', true);
            btn_agent_logout.attr('disabled', true);
            btn_agent_logoff.attr('disabled', true);

        }
        //call_list();
    });

    socket.on('talking', data => {

        if (data.extension.match(exten)) {
            console.log(data);

            $.ajax({
                url: "{{ route('agent.talk') }}",
                method: 'post',
                async: false,
                data: {
                    uniqid: data.luniq,
                    telno: data.cid,
                    agentno: data.dstnumber,
                    _token: token,
                },
                success: function(result) {
                    set_state_icon(result.id,result.icon,result.message);
                    set_state_button(result.id);
                    positionCards();
                    call_list();
                    toolbar_modal.modal('show');
                }
            });

        }

    });

    socket.on('hold', data => {
        if (data.extension.match(exten)) {
            $('#state_' + data.luniq.replace('.', '')).html(
                '<i class="fa-solid fa-pause fa-bounce" style=" --fa-bounce-start-scale-x: 1; --fa-bounce-start-scale-y: 1; --fa-bounce-jump-scale-x: 1; --fa-bounce-jump-scale-y: 1; --fa-bounce-land-scale-x: 1; --fa-bounce-land-scale-y: 1; "></i> Hold'
            );
            $('#color_' + data.luniq.replace('.', '')).removeClass("card-success");
            $('#color_' + data.luniq.replace('.', '')).addClass("card-warning");
        }
    });

    socket.on('unhold', data => {
        if (data.extension.match(exten)) {
            $('#state_' + data.luniq.replace('.', '')).html(
                '<i class="fa-solid fa-phone-volume fa-bounce" style=" --fa-bounce-start-scale-x: 1; --fa-bounce-start-scale-y: 1; --fa-bounce-jump-scale-x: 1; --fa-bounce-jump-scale-y: 1; --fa-bounce-land-scale-x: 1; --fa-bounce-land-scale-y: 1; "></i> Talking'
            );
            $('#color_' + data.luniq.replace('.', '')).removeClass("card-warning");
            $('#color_' + data.luniq.replace('.', '')).addClass("card-success");
        }

    });



    socket.on('hangup', data => {
        if (data.extension) {
            if (data.extension.match(exten)) {
                /* $.ajax({
                    url: "{{ route('agent.hang') }}",
                    method: 'post',
                    async: false,
                    data: {
                        _token: token,
                    },
                    success: function(result) {
                        //alert_success('OK', 'วางสายเรียบร้อยแล้ว', '');
                        $('#phone_state').html(result.message);
                        $('#phone_state_icon').html(result.icon);
                        $('#phone_state').removeClass().addClass(get_state_color(result.id));
                        $('#phone_state_icon').removeClass().addClass(get_state_color(result.id));
                        //check_state();
                        set_state_button(result.id);
                        positionCards();
                    }
                }); */
                //console.log(data)
                if (data.luniq) {
                    $('#' + data.luniq.replace('.', '')).remove();
                }
                call_list();
                //if (data.extension.match(exten)) {
                //(data.event == 'DialEnd' &&
                //|| data.event == 'BlindTransfer'
                /* chan = data.extension.split("/");
                if ((data.event == 'BridgeLeave' || data.context == 'macro-dialout-trunk')) {
                   $.get(`${web_url}/agent/agent_wrap/` + data.luniq + `/` + data.transfer, (dataw,
                        status) => {
                        console.log(dataw);
                        console.log('hang');
                        console.log(data);
                        if (dataw !== 'error' && dataw !== '') {
                            //$.get(`${web_url}/agent/get_wrap_list/` + dataw, (datawl, status) => {
                            if (dataw == 'Outbound') {
                                $('#dial_number').attr('disabled', true);
                                $('.button_dial').attr('disabled', true);
                                $('.button_tranfer').attr('disabled', true);
                                $('.button_conf').attr('disabled', true);
                                $('.cbutton_Inbound').addClass("d-none");
                                $('.cbutton_Outbound').removeClass("d-none");
                            } else {
                                $('.cbutton_Outbound').addClass("d-none");
                                $('.cbutton_Inbound').removeClass("d-none");
                            }
                            $('#btn-wrap').attr('disabled', false);
                            $('.button_unbreak').attr('disabled', true);
                            $('.button_unbreak').removeClass("d-none");
                            $('#btn-system-logout').attr('disabled', true);
                            $('#btn-agent-logout').attr('disabled', true);
                            $('#break_group').addClass("d-none");
                            $('#sub_header').append(
                                `<div id="break_text"><i class="fas fa-pause"></i> Wrap UP (${dataw})</div>`
                            );
                            $('#toolbar_header').removeClass("card-primary");
                            $('#toolbar_header').addClass("card-warning");
                            alert_success('OK', 'Call End', '');
                            //});
                        }


                    });
                }*/

                //}

            }

        }
    });

    socket.on('hangupconf', data => {
        console.log(data)
        if (data.extension.match(exten)) {
            $('#' + data.luniq.replace('.', '')).remove();
            call_list();
            if (data.extension.match(exten)) {
                chan = data.extension.split("/");
                $.get(`${web_url}/agent/agent_wrap/` + data.luniq + `/1`, (dataw, status) => {

                    if (dataw) {
                        //$.get(`${web_url}/agent/get_wrap_list/` + dataw, (datawl, status) => {
                        if (dataw == 'Outbound') {
                            $('#dial_number').attr('disabled', true);
                            $('.button_dial').attr('disabled', true);
                            $('.button_tranfer').attr('disabled', true);
                            $('.button_conf').attr('disabled', true);
                            $('.cbutton_Inbound').addClass("d-none");
                            $('.cbutton_Outbound').removeClass("d-none");
                        } else {
                            $('.cbutton_Outbound').addClass("d-none");
                            $('.cbutton_Inbound').removeClass("d-none");
                        }
                        $('#btn-wrap').attr('disabled', false);
                        $('.button_unbreak').attr('disabled', true);
                        $('.button_unbreak').removeClass("d-none");
                        $('#btn-logout').attr('disabled', true);
                        $('#break_group').addClass("d-none");
                        $('#sub_header').append(
                            `<div id="break_text"><i class="fas fa-pause"></i> Wrap UP (${dataw})</div>`
                        );
                        $('#toolbar_header').removeClass("card-primary");
                        $('#toolbar_header').addClass("card-warning");
                        alert_success('OK', 'Call End', '');
                        //});
                    }

                });

            }

        }
    });

    socket.on('disconnect', data => {
        socket.emit('join', 'Bye from client');
    });
</script>
