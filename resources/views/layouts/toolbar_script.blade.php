<script>
    const web_url = '{{ url('/') }}';
    const agent_username = '{{ $temporaryPhone }}';
    const exten = '{{ $temporaryPhone }}';
    const account_code = exten;
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
    const btn_unwarp = $('#btn-unwarp');
    const btn_agent_logout = $('#btn-system-logout');
    const btn_agent_logoff = $('#btn-agent-logout');
    const btn_agent_login = $('#btn-agent-login');
    const toolbar_header = $('#toolbar_header');
    const phone_state = $('#phone_state');
    const phone_state_icon = $('#phone_state_icon');
    const toolbar_modal = $('#ToolbarModal');
    const popup_tab = $("#custom-tabs-one-popup-tab");
    const call_tab = $("#custom-tabs-one-call-tab");
    const state_overlay = $('#state_overlay');
    const toolbar_card = $('#toolbar_card');
    const popup_tab_main = $('#popup_tab_main');

    let alert_danger = (title, message, subtitle) => {
        $(document).Toasts('create', {
            body: message,
            title: title,
            class: 'bg-danger mr-2 mt-2',
            subtitle: subtitle,
            icon: 'fas fa-bell',
            autohide: true,
            zIndex: 99999999,
            fade: true,
            delay: 3000
        })
    }

    let alert_success = (title, message, subtitle) => {
        $(document).Toasts('create', {
            body: message,
            title: title,
            class: 'bg-success mr-2 mt-2',
            subtitle: subtitle,
            icon: 'fas fa-bell',
            autohide: true,
            zIndex: 99999999,
            fade: true,
            delay: 3000
        })
    }

    const updateUI = (result) => {
        console.log(result);
        if (result.success == true) {
            toastr.success('เปลี่ยนสถานะ เรียบร้อยแล้ว', {
                timeOut: 5000
            });
            set_state_icon(result.id, result.icon, result.message);
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



    const get_state_color = (id, icon, message) => {
        if (id === -1) {
            return 'icon-gray';
        } else if (id === 0) {
            return 'icon-gray';
        } else if (id === 1) {
            return 'icon-green';
        } else if (id === 2) {
            return 'icon-yellow';
        } else if (id === 3) {
            return 'icon-yellow';
        } else if (id === 4) {
            return 'icon-red';
        } else if (id === 5) {
            return 'icon-red';
        }
    };

    const set_state_icon = (id, icon, message) => {
        phone_state.html(message);
        phone_state_icon.html(icon);
        phone_state.removeClass().addClass(get_state_color(id));
        phone_state_icon.removeClass().addClass(get_state_color(id));
    }

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
            btn_unwarp.addClass("d-none");
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
            btn_unwarp.addClass("d-none");
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
            btn_unwarp.addClass("d-none");
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
            btn_unwarp.addClass("d-none");
            btn_agent_logout.removeClass("d-none");
            btn_agent_logout.prop('disabled', false);
            btn_agent_logoff.addClass("d-none");
            btn_agent_logoff.prop('disabled', true);
            btn_agent_login.addClass("d-none");
            btn_agent_login.prop('disabled', true);
            toolbar_header.removeClass("");
            toolbar_header.addClass("card-warning");
        } else if (id === 3) {
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
            btn_unbreak.prop('disabled', true);
            btn_unwarp.prop('disabled', false);
            btn_unwarp.removeClass("d-none");
            btn_agent_logout.addClass("d-none");
            btn_agent_logout.prop('disabled', true);
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
            btn_unwarp.addClass("d-none");
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
            btn_unwarp.addClass("d-none");
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

    $(document).on('click', '#btn-unwarp', function(e) {
        e.preventDefault();
        sendAjaxRequest("{{ route('agent.unwarp') }}", "POST");
    });

    $(document).on('click', '#btn-system-logout', function(e) {
        e.preventDefault();
        document.getElementById('logout-form').submit();
    });


    function AsyncConfirmYesNo(title, msg, yesFn, noFn) {
            var $confirm = $("#modalConfirmYesNo");
            $confirm.modal('show');
            $("#lblTitleConfirmYesNo").html(title);
            $("#lblMsgConfirmYesNo").html(msg);
            $("#btnYesConfirmYesNo").off('click').click(function() {
                yesFn();
                $confirm.modal("hide");
            });
            $("#btnNoConfirmYesNo").off('click').click(function() {
                noFn();
                $confirm.modal("hide");
            });
        }

       /*  $(document).on('show.bs.tab', '#custom-tabs-pop a[data-toggle="pill"]',
            async function(e) {
                // Determine which tab is being switched to
                var href = $(e.target).attr("href");
                var targetTab = href.replace("#custom-tabs-pop-", "");

                // Display a confirmation dialog
                if (!confirm("ยืนยันการเปลี่ยน Tab ไปยัง " + targetTab +
                        " ? \nกรุณาบันทึกข้อมุลก่อนเปลี่ยน Tab")) {
                    // If the user cancels, prevent the tab switch
                    e.preventDefault();
                }

            }); */
        $(document).on('click', '#custom-tabs-pop-*',async function(e) {

            /* var areYouSure = confirm(
                'If you sure you wish to leave this tab?  Any data entered will NOT be saved.  To save information, use the Save buttons.'
                );
            if (areYouSure === true) {
                $(this).tab('show')
            } else {
                // do other stuff
                return false;
            } */
            await AsyncConfirmYesNo(
                    "Yes & No Confirmation Box",
                    "Are you hungry?",
                    function() {
                        $(this).tab('show')
                    },
                    function() {
                        e.preventDefault()
                    }
                );
        })



    //blind tranfer
    $(".button_tranfer").click(function() {
        let len = $('input[name="call[]"]:checked').length;
        if (len > 0) {
            if (len > 1) {
                alert_danger('Opp', 'ไม่สามารถโอนสายมากกว่า 1 สายต่อครั้ง', '');
            } else {
                let call_number = $('#dial_number').val();
                if (call_number !== '') {
                    //if (confirm("Click OK to Tranfer?")) {
                    let tranfer_chan = $("input[type='checkbox']").val();
                    let chan = tranfer_chan.split("/");
                    /* $.get(`${event_serv}/tranfer/` + call_number + "/" + chan[1], (data, status) => {
                        if (data.response == 'Success') {
                            alert_success('OK', 'Tranfer Success', '');
                        } else {
                            alert_danger('Opp', 'หมายเลขปลายทางไม่สามารถติดต่อได้', '');
                        }
                    }); */
                    $.ajax({
                        url: "{{ route('tranfer') }}",
                        method: 'post',
                        data: {
                            number: call_number,
                            atxfer: 0,
                            _token: token,
                        },
                        async: false,
                        success: function(result) {
                            if (result.success == true) {
                                alert_success('OK', 'โอนสายสำเร็จ', '');
                            } else {
                                alert_danger('Oop', 'โอนสาย ไม่สำเร็จ', '');
                            }
                        }
                    });
                    //}
                } else {
                    alert_danger('Opp', 'กรุณาระบุหมายเลขที่จะโอนสาย', '');
                }

            }
        } else {
            alert_danger('Opp', 'กรุณาระบุสายที่จะโอนสาย', '');

        }
    });

    //atx tranfer
    $(".button_atx_tranfer").click(function() {
        let len = $('input[name="call[]"]:checked').length;
        if (len > 0) {
            if (len > 1) {
                alert_danger('Opp', 'ไม่สามารถโอนสายมากกว่า 1 สายต่อครั้ง', '');
            } else {
                let call_number = $('#dial_number').val();
                if (call_number !== '') {
                    //if (confirm("Click OK to Tranfer?")) {
                    let tranfer_chan = $("input[type='checkbox']").val();
                    let chan = tranfer_chan.split("/");
                    /* $.get(`${event_serv}/atx_tranfer/` + call_number + "/" + chan[1], (data, status) => {
                        if (status == 'success') {
                            alert_success('OK', 'Tranfer Success', '');
                        } else {
                            alert_danger('Opp', 'Something Error', '');
                        }
                    }); */
                    $.ajax({
                        url: "{{ route('tranfer') }}",
                        method: 'post',
                        data: {
                            number: call_number,
                            atxfer: 1,
                            _token: token,
                        },
                        async: false,
                        success: function(result) {
                            if (result.success == true) {
                                alert_success('OK', 'โอนสายสำเร็จ', '');
                            } else {
                                alert_danger('Oop', 'โอนสาย ไม่สำเร็จ', '');
                            }
                        }
                    });
                    //}
                } else {
                    alert_danger('Opp', 'กรุณาระบุหมายเลขที่จะโอนสาย', '');
                }

            }
        } else {
            alert_danger('Opp', 'กรุณาระบุสายที่จะโอนสาย', '');

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

     //unwrap
    /* $(".button_complete").click(function() {
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

    }) */



    //call button
    dial_button.click(function() {
        let call_number = dial_number.val();
        if (call_number !== '') {
            $.get(`${event_serv}/dial/` + call_number + "/" + exten + "/" + account_code, (data, status) => {
                if (status == 'success') {
                    alert_success('OK', 'โทรออกสำเร็จ', '');
                    dial_number.val('');
                } else {
                    alert_danger('Opp', 'Something Error', '');
                }
            });
        } else {
            alert_danger('Opp', 'กรุณาระบุหมายเลขที่จะโทร ', '');
        }

    });

    //conf
    conf_button.click(function() {
        let len = $('input[name="call[]"]:checked').length;
        if (len > 0) {
            if (len !== 2) {
                alert_danger('Opp', 'กรุณาเลือกสายสองสายขึ้นไป', '');
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
                                alert_success('OK', 'ประชุมสายสำเร็จ', '');
                            } else {
                                alert_danger('Opp', 'Something Error', '');
                            }
                        });
                    });

                });

            }
        } else {
            alert_danger('Opp', 'กรุณาเลือกสายที่จะประชุม', '');

        }

    });


    //hangup
    $(document).on('click', '.hangup_call', function(data) {
        if (!confirm("ยืนยันการวางสาย?")) return;
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
                        state = 'กำลังสนทนา'
                        state_icon =
                            '<i class="fa-solid fa-phone-volume fa-bounce" style=" --fa-bounce-start-scale-x: 1; --fa-bounce-start-scale-y: 1; --fa-bounce-jump-scale-x: 1; --fa-bounce-jump-scale-y: 1; --fa-bounce-land-scale-x: 1; --fa-bounce-land-scale-y: 1; "></i>';
                        state_color = 'card-danger';
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
                    btn_pause.attr('disabled', true);
                    btn_agent_logout.attr('disabled', true);
                    btn_agent_logoff.attr('disabled', true);
                    //popup_tab.click();
                    toolbar_modal.modal('show');
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
