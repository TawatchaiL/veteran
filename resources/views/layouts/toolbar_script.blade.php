<script>
    const web_url = '{{ url('/') }}';
    const agent_username = '{{ $temporaryPhone }}';
    const exten = '{{ $temporaryPhone }}';
    const account_code = '';
    const event_serv = '{{ config('asterisk.event_serv.address') }}';
    let obj = {};

    const dial_number = $('#dial_number');
    const dial_button = $('#dial_button');
    const performance_button = $('#performance_button');
    const tranfer_button = $('#tranfer_button');
    const conf_button = $('#conf_button');
    const break_group = $('#break_group');
    const btn_pause = $('#btn-pause');
    const btn_unbreak = $('#btn-unbreak');
    const btn_agent_logout = $('#btn-system-logout');
    const btn_agent_logoff = $('#btn-agent-logout');
    const btn_agent_login = $('#btn-agent-login');
    const toolbar_header = $('#toolbar_header');
    const phone_state = $('#phone_state');
    const phone_state_icon = $('#phone_state_icon');
    const toolbar_modal = $('#ToolbarModal');
    const state_overlay = $('#state_overlay');

    const updateUI = (result) => {
        console.log(result);
        if (result.success == true) {
            toastr.success('เปลี่ยนสถานะ เรียบร้อยแล้ว', {
                timeOut: 5000
            });
            phone_state.html(result.message);
            phone_state_icon.html(result.icon);
            phone_state.removeClass().addClass(get_state_color(result.id));
            phone_state_icon.removeClass().addClass(get_state_color(result.id));
            set_state_button(result.id);
            toolbar_modal.modal('hide');
        } else {
            toastr.error('เปลี่ยนสถานะ ไม่สำเร็จ', {
                timeOut: 5000
            });
        }

    };

    const check_state = () => {
        sendAjaxRequest("{{ route('agent.status') }}", "POST");
    }

    const sendAjaxRequest = (url, method, data = {}) => {
        $.ajax({
            url,
            method,
            data,
            async: false,
            success: updateUI,
        });
    };

    const get_state_color = (id) => {
        if (id === -1) {
            return 'icon-gray';
        } else if (id === 0) {
            return 'icon-gray';
        } else if (id === 1) {
            return 'icon-green';
        } else if (id === 2) {
            return 'icon-yellow';
        } else if (id === 4) {
            return 'icon-red';
        } else if (id === 5) {
            return 'icon-red';
        }
    };

    const set_state_button = (id) => {

        if (id === -1) {
            dial_number.addClass('d-none');
            dial_number.prop('disabled', true);
            dial_button.addClass('d-none');
            dial_button.prop('disabled', true);
            performance_button.prop('disabled', true);
            performance_button.addClass("d-none");
            tranfer_button.prop('disabled', true);
            tranfer_button.addClass("d-none")
            conf_button.prop('disabled', true);
            conf_button.addClass("d-none")
            break_group.addClass("d-none");
            btn_pause.prop('disabled', true);
            btn_unbreak.addClass("d-none");
            btn_agent_logout.addClass("d-none");
            btn_agent_logout.prop('disabled', true);
            btn_agent_logoff.addClass("d-none");
            btn_agent_logoff.prop('disabled', true);
            btn_agent_login.addClass("d-none");
            btn_agent_login.prop('disabled', true);
            toolbar_header.removeClass("");
            toolbar_header.addClass("card-secondary");
        } else if (id === 0) {
            dial_number.removeClass('d-none');
            dial_number.prop('disabled', false);
            dial_button.removeClass('d-none');
            dial_button.prop('disabled', false);
            performance_button.prop('disabled', true);
            performance_button.removeClass("d-none");
            tranfer_button.prop('disabled', true);
            tranfer_button.removeClass("d-none");
            conf_button.prop('disabled', true);
            conf_button.removeClass("d-none");
            break_group.addClass("d-none");
            btn_pause.prop('disabled', true);
            btn_unbreak.addClass("d-none");
            btn_agent_logout.removeClass("d-none");
            btn_agent_logout.prop('disabled', false);
            btn_agent_logoff.addClass("d-none");
            btn_agent_logoff.prop('disabled', true);
            btn_agent_login.removeClass("d-none");
            btn_agent_login.prop('disabled', false);
            toolbar_header.removeClass("");
            toolbar_header.addClass("card-secondary");
        } else if (id === 1) {
            dial_number.removeClass('d-none');
            dial_number.prop('disabled', false);
            dial_button.removeClass('d-none');
            dial_button.prop('disabled', false);
            performance_button.prop('disabled', true);
            performance_button.removeClass("d-none");
            tranfer_button.prop('disabled', true);
            tranfer_button.removeClass("d-none");
            conf_button.prop('disabled', true);
            conf_button.removeClass("d-none");
            break_group.removeClass("d-none");
            btn_pause.prop('disabled', false);
            btn_unbreak.addClass("d-none");
            btn_unbreak.prop('disabled', true);
            btn_agent_logout.removeClass("d-none");
            btn_agent_logout.prop('disabled', false);
            btn_agent_logoff.removeClass("d-none");
            btn_agent_logoff.prop('disabled', false);
            btn_agent_login.prop('disabled', true);
            btn_agent_login.addClass("d-none");
            toolbar_header.removeClass("");
            toolbar_header.addClass("card-success");
        } else if (id === 2) {
            dial_number.removeClass('d-none');
            dial_number.prop('disabled', false);
            dial_button.removeClass('d-none');
            dial_button.prop('disabled', false);
            performance_button.prop('disabled', true);
            performance_button.removeClass("d-none");
            tranfer_button.prop('disabled', true);
            tranfer_button.removeClass("d-none");
            conf_button.prop('disabled', true);
            conf_button.removeClass("d-none");
            break_group.addClass("d-none");
            btn_pause.prop('disabled', true);
            btn_unbreak.removeClass("d-none");
            btn_unbreak.prop('disabled', false);
            btn_agent_logout.removeClass("d-none");
            btn_agent_logout.prop('disabled', false);
            btn_agent_logoff.addClass("d-none");
            btn_agent_logoff.prop('disabled', true);
            btn_agent_login.addClass("d-none");
            btn_agent_login.prop('disabled', true);
            toolbar_header.removeClass("");
            toolbar_header.addClass("card-warning");
        } else if (id === 4) {
            dial_number.removeClass('d-none');
            dial_number.prop('disabled', false);
            dial_button.removeClass('d-none');
            dial_button.prop('disabled', false);
            performance_button.prop('disabled', false);
            performance_button.removeClass("d-none");
            tranfer_button.prop('disabled', false);
            tranfer_button.removeClass("d-none");
            conf_button.prop('disabled', false);
            conf_button.removeClass("d-none");
            break_group.addClass("d-none");
            btn_pause.prop('disabled', true);
            btn_unbreak.addClass("d-none");
            btn_unbreak.prop('disabled', true);
            btn_agent_logout.addClass("d-none");
            btn_agent_logout.prop('disabled', true);
            btn_agent_logoff.addClass("d-none");
            btn_agent_logoff.prop('disabled', true);
            btn_agent_logout.prop('disabled', true);
            btn_agent_login.addClass("d-none");
            btn_agent_login.prop('disabled', true);
            toolbar_header.removeClass("");
            toolbar_header.addClass("card-danger");
        } else if (id === 5) {
            dial_number.removeClass('d-none');
            dial_number.prop('disabled', false);
            dial_button.removeClass('d-none');
            dial_button.prop('disabled', false);
            performance_button.prop('disabled', false);
            performance_button.removeClass("d-none");
            tranfer_button.prop('disabled', false);
            tranfer_button.removeClass("d-none");
            conf_button.prop('disabled', false);
            conf_button.removeClass("d-none");
            break_group.addClass("d-none");
            btn_pause.prop('disabled', true);
            btn_unbreak.addClass("d-none");
            btn_unbreak.prop('disabled', true);
            btn_agent_logout.addClass("d-none");
            btn_agent_logout.prop('disabled', true);
            btn_agent_logoff.addClass("d-none");
            btn_agent_logoff.prop('disabled', true);
            btn_agent_logout.prop('disabled', true);
            btn_agent_login.addClass("d-none");
            btn_agent_login.prop('disabled', true);
            toolbar_header.removeClass("");
            toolbar_header.addClass("card-danger");
        }
    };

    $(document).on('click', '#btn-agent-login', function(e) {
        e.preventDefault();
        sendAjaxRequest("{{ route('agent.login') }}", "POST");
    });

    $(document).on('click', '#btn-agent-logout', function(e) {
        e.preventDefault();
        sendAjaxRequest("{{ route('agent.logoff') }}", "POST");
    });

    $(document).on('click', '.button_break', function(e) {
        e.preventDefault();
        const bid = $(this).data('id');
        const additionalData = {
            id_break: bid,
        };
        sendAjaxRequest("{{ route('agent.break') }}", "POST", additionalData);
    });

    $(document).on('click', '.button_unbreak', function(e) {
        e.preventDefault();
        sendAjaxRequest("{{ route('agent.unbreak') }}", "POST");
    });

    $(document).on('click', '#btn-system-logout', function(e) {
        e.preventDefault();
        document.getElementById('logout-form').submit();
    });


    //blind tranfer
    $(".button_tranfer").click(function() {
        let len = $('input[name="call[]"]:checked').length;
        if (len > 0) {
            if (len > 1) {
                alert_danger('Opp', 'Can Not Tranfer More Than 1 Call', '');
            } else {
                let call_number = $('#dial_number').val();
                if (call_number !== '') {
                    //if (confirm("Click OK to Tranfer?")) {
                    let tranfer_chan = $("input[type='checkbox']").val();
                    let chan = tranfer_chan.split("/");
                    $.get(`${event_serv}/tranfer/` + call_number + "/" + chan[1], (data, status) => {
                        if (data.response == 'Success') {
                            alert_success('OK', 'Tranfer Success', '');
                        } else {
                            alert_danger('Opp', 'หมายเลขปลายทางไม่สามารถติดต่อได้', '');
                        }
                    });
                    //}
                } else {
                    alert_danger('Opp', 'Please input tranfer to number', '');
                }

            }
        } else {
            alert_danger('Opp', 'Please select call to tranfer', '');

        }
    });

    //atx tranfer
    $(".button_atx_tranfer").click(function() {
        let len = $('input[name="call[]"]:checked').length;
        if (len > 0) {
            if (len > 1) {
                alert_danger('Opp', 'Can Not Tranfer More Than 1 Call', '');
            } else {
                let call_number = $('#dial_number').val();
                if (call_number !== '') {
                    //if (confirm("Click OK to Tranfer?")) {
                    let tranfer_chan = $("input[type='checkbox']").val();
                    let chan = tranfer_chan.split("/");
                    $.get(`${event_serv}/atx_tranfer/` + call_number + "/" + chan[1], (data, status) => {
                        if (status == 'success') {
                            alert_success('OK', 'Tranfer Success', '');
                        } else {
                            alert_danger('Opp', 'Something Error', '');
                        }
                    });
                    //}
                } else {
                    alert_danger('Opp', 'Please input tranfer to number', '');
                }

            }
        } else {
            alert_danger('Opp', 'Please select call to tranfer', '');

        }

    });


    /*  //break
     $(".button_break").click(function() {
         if (!confirm("Are you sure to Break?")) return;
         let rowid = $(this).data("id")

         if (!rowid) return;
         $.get(`${web_url}/agent/agent_break/` + rowid, (data, status) => {
             if (data == 'success') {
                 $('.button_unbreak').removeClass("d-none");
                 $('.button_unbreak').attr('disabled', false);
                 $('#break_group').addClass("d-none");
                 $('#sub_header').append('<div id="break_text"><i class="fas fa-pause"></i> ' + rowid +
                     '</div>');
                 $('#toolbar_header').removeClass("card-primary");
                 $('#toolbar_header').addClass("card-warning");
                 alert_success('OK', 'Pause Success', '');
             }

         });

     })

     //unbreak
     $(".button_unbreak").click(function() {
         if (!confirm("Are you sure to UnBreak?")) return;
         $.get(`${web_url}/agent/agent_unbreak/`, (data, status) => {
             if (data == 'success') {
                 $('.button_unbreak').addClass("d-none");
                 $('#break_group').removeClass("d-none");
                 $('#break_text').remove();
                 $('#toolbar_header').addClass("card-primary");
                 $('#toolbar_header').removeClass("card-warning");
                 alert_success('OK', 'UnPause Success', '');
             }
         });

     }) */


    //call button
    $(".button_dial").click(function() {
        let call_number = $('#dial_number').val();
        if (call_number !== '') {
            $.get(`${event_serv}/dial/` + call_number + "/" + exten + "/" + account_code, (data, status) => {
                if (status == 'success') {
                    alert_success('OK', 'Dial Success', '');
                    $('#dial_number').val('');
                } else {
                    alert_danger('Opp', 'Something Error', '');
                }
            });
        } else {
            alert_danger('Opp', 'Please input  number to dial ', '');
        }

    });

    //conf
    $(".button_conf").click(function() {
        let len = $('input[name="call[]"]:checked').length;
        if (len > 0) {
            if (len !== 2) {
                alert_danger('Opp', 'Please Select 2 Call', '');
            } else {
                let chan = []
                $('input[name="call[]"]:checked').each(function() {
                    let bv = $(this).val().split("/");
                    chan.push(bv[1]);
                });

                $.get(`${event_serv}/chans_variable/` + chan[0], (data, status) => {
                    $.get(`${event_serv}/chans_variable/` + chan[1], (data2, status2) => {
                        mcalldestchan = data[3][1].split("/");
                        mcalldestchan2 = data2[3][1].split("/");
                        $.get(`${event_serv}/conf/` + mcalldestchan[1] + "/" + mcalldestchan2[
                            1] + "/" + chan[1] + "/" + exten, (data, status) => {

                            if (status == 'success') {
                                alert_success('OK', 'Conferrent Success', '');
                            } else {
                                alert_danger('Opp', 'Something Error', '');
                            }
                        });
                    });

                });

            }
        } else {
            alert_danger('Opp', 'Please select call to conferrence', '');

        }

    });

    //unwrap
    $(".button_complete").click(function() {
        if (!confirm("Are you sure to Complete Call?")) return;
        let rowid = $(this).data("id")

        if (!rowid) return;
        $.get(`${web_url}/agent/agent_unwrap/` + rowid, (data, status) => {
            if (data == 'success') {
                $('#dial_number').attr('disabled', false);
                $('.button_dial').attr('disabled', false);
                $('.button_tranfer').attr('disabled', false);
                $('.button_conf').attr('disabled', false);
                $('#btn-wrap').attr('disabled', true);
                $('#btn-pause').attr('disabled', false);
                $('#btn-logout').attr('disabled', false);
                $('.button_unbreak').addClass("d-none");
                $('#break_group').removeClass("d-none");
                $('#break_text').remove();
                $('#toolbar_header').addClass("card-primary");
                $('#toolbar_header').removeClass("card-warning");
                alert_success('OK', 'Complete Call Success', '');
            }

        });

    })


    //hangup
    $(document).on('click', '.hangup_call', function(data) {
        if (!confirm("Are you sure to hangup?")) return;
        let rowid = $(this).data("id")

        if (!rowid) return;
        let chan = rowid.split("/");

        $.get(`${event_serv}/hangup/` + chan[1], (data, status) => {

        });

    })



    //list all call function
    let call_list = () => {
        let mcallprofile = '';
        let mcallexten = '';
        let luniq = '';
        let mstrArray = [];
        let calls_active = 0;


        $.get(`${event_serv}/chans/` + exten, async (data, status) => {

            await data.forEach((item, index) => {
                let strArray = item.split("!");
                let chan = strArray[0].split("/");

                $.get(`${event_serv}/chans_variable/` + chan[1], (data, status) => {

                    luniq = data[0][1];
                    luniqrd = luniq.replace('.', '');
                    mcallprofile = data[1][1];
                    mcallexten = data[2][1];
                    mcalldestchan = data[3][1];




                    if (strArray[4] == 'Ringing' || strArray[4] == 'Ring') {
                        state = 'Ringing'
                        state_icon =
                            '<i class="fa-solid fa-bell fa-beat" style="--fa-beat-scale: 2.0;"></i>';
                        state_color = 'card-danger';
                        check_box_state = 'disabled';
                    } else if (strArray[4] == 'Up' && strArray[12] == '') {
                        state = 'Ringing'
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


                    if (!$('#' + luniq.replace('.', '')).length) {
                        $('#call_list').prepend(`<div class="col-md-3" id = "${luniq.replace('.', '')}">
						<div class="card custom-bottom-right-card ${state_color}" id = "color_${luniq.replace('.', '')}" data-id="${mcallexten}">
							<div class="card-header">
								<h3 class="card-title" id = "state_${luniq.replace('.', '')}" >  ${state_icon} ${state} ${mcallexten} </h3>
								<div class="card-tools">
									<div ><input type="checkbox" style="width: 20px; height: 20px;" name="call[]" id="call[]" value="${strArray[0]}" ${check_box_state}></div>
								</div>
							</div>
							<div class="card-body card-content">
							</div>
							<div class="card-footer text-muted text-right ">
							     <a href="#" class="btn btn-danger hangup_call" data-id="${strArray[0]}"><i class="fa-solid fa-phone-slash"></i> วางสาย</a>
							</div>
						</div>

			             </div>`);

                    }

                });
                calls_active += 1;

                if (calls_active !== 0) {
                    btn-pause.attr('disabled', true);
                    btn-agent-logout.attr('disabled', true);
                    btn-agent-logoff.attr('disabled', true);
                }
            });
        });

    };

    //load call list on access page
    call_list();
    @php
       if ($temporaryPhoneStatusID==-1) {
    @endphp
    set_state_button(-1);
    state_overlay.removeClass("d-none");
    toolbar_modal.modal('show');
    @php
       }
    @endphp
</script>
