<script>
    const web_url = '{{ url('/') }}';
    const agent_username = '{{ $temporaryPhone }}';
    const exten = '{{ $temporaryPhone }}';
    const account_code = exten;
    const toolbar_serv = '{{ config('asterisk.toolbar_serv.address') }}';
    const api_serv = '{{ config('asterisk.api_serv.address') }}';

    const dial_number = $('#dial_number');
    const dial_button = $('#dial_button');
    const ans_button = $('#ans_button');
    const swap_button = $('#swap_button');
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
    const modalc = $('.modal');
    const popup_tab = $("#custom-tabs-one-popup-tab");
    const call_tab = $("#custom-tabs-one-call-tab");
    const state_overlay = $('#state_overlay');
    const toolbar_card = $('#toolbar_card');
    const popup_tab_main = $('#popup_tab_main');
    const elem_queue = document.getElementById("queue_wait");

    let obj = {};
    let waitData = {};
    let isDropdownClicked = false;


    let alert_danger = (title, message, subtitle) => {
        $(document).Toasts('create', {
            body: message,
            title: title,
            class: 'bg-danger mr-2 mb-2',
            subtitle: subtitle,
            icon: 'fas fa-bell',
            autohide: true,
            zIndex: 99999999,
            fade: true,
            delay: 15000,
            position: 'bottomRight'
        })
    }

    let alert_success = (title, message, subtitle) => {
        $(document).Toasts('create', {
            body: message,
            title: title,
            class: 'bg-success mr-2 mb-2',
            subtitle: subtitle,
            icon: 'fas fa-bell',
            autohide: true,
            zIndex: 99999999,
            fade: true,
            delay: 15000,
            position: 'bottomRight'
        })
    }

    modalc.on('hidden.bs.modal', function(e) {
        $('.modal').css('overflow-y', 'hidden');
        $('body').css("overflow-y", "auto");
    });

    modalc.on('shown.bs.modal', function(e) {
        $('.modal').css('overflow-y', 'auto');
        $('body').css("overflow-y", "hidden");
    });

    $(document).ready(function() {
        $("#btnAlert").on("click", function() {
            const prom = ezBSAlert({
                messageText: "hello world",
                alertType: "danger",
            }).done(function(e) {
                $("body").append("<div>Callback from alert</div>");
            });
        });

        $("#btnConfirm").on("click", function() {
            ezBSAlert({
                type: "confirm",
                messageText: "hello world",
                alertType: "info",
            }).done(function(e) {
                $("body").append(`<div>Callback from confirm ${e}</div>`);
            });
        });

        $("#btnPrompt").on("click", function() {
            ezBSAlert({
                type: "prompt",
                messageText: "Enter Something",
                alertType: "primary",
            }).done(function(e) {
                ezBSAlert({
                    messageText: "You entered: " + e,
                    alertType: "success",
                });
            });
        });
    });

    const changeText = (text) => {
        elem_queue.classList.add('hide_text');
        setTimeout(function() {
            elem_queue.innerHTML = text;
            elem_queue.classList.remove('hide_text');
        }, 500);
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
            ans_button.addClass('d-none');
            ans_button.prop('disabled', true);
            swap_button.prop('disabled', true);
            swap_button.addClass("d-none")
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
            toolbar_header.removeClass();
            toolbar_header.addClass("modal-header bg-secondary");
        } else if (id === 0) {
            dial_number.removeClass('d-none');
            dial_number.prop('disabled', false);
            dial_button.removeClass('d-none');
            dial_button.prop('disabled', false);
            ans_button.removeClass('d-none');
            ans_button.prop('disabled', false);
            swap_button.prop('disabled', true);
            swap_button.removeClass("d-none")
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
            toolbar_header.removeClass();
            toolbar_header.addClass("modal-header bg-secondary");
        } else if (id === 1) {
            dial_number.removeClass('d-none');
            dial_number.prop('disabled', false);
            dial_button.removeClass('d-none');
            dial_button.prop('disabled', false);
            ans_button.removeClass('d-none');
            ans_button.prop('disabled', false);
            swap_button.prop('disabled', true);
            swap_button.removeClass("d-none")
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
            toolbar_header.removeClass();
            toolbar_header.addClass("modal-header bg-primary");
        } else if (id === 2) {
            dial_number.removeClass('d-none');
            dial_number.prop('disabled', false);
            dial_button.removeClass('d-none');
            dial_button.prop('disabled', false);
            ans_button.removeClass('d-none');
            ans_button.prop('disabled', false);
            swap_button.prop('disabled', true);
            swap_button.removeClass("d-none")
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
            toolbar_header.removeClass();
            toolbar_header.addClass("modal-header bg-warning");
        } else if (id === 3) {
            dial_number.removeClass('d-none');
            dial_number.prop('disabled', false);
            dial_button.removeClass('d-none');
            dial_button.prop('disabled', false);
            ans_button.removeClass('d-none');
            ans_button.prop('disabled', false);
            swap_button.prop('disabled', false);
            swap_button.removeClass("d-none")
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
            toolbar_header.removeClass();
            toolbar_header.addClass("modal-header bg-warning");
        } else if (id === 4) {
            dial_number.removeClass('d-none');
            dial_number.prop('disabled', false);
            dial_button.removeClass('d-none');
            dial_button.prop('disabled', false);
            ans_button.removeClass('d-none');
            ans_button.prop('disabled', false);
            swap_button.prop('disabled', false);
            swap_button.removeClass("d-none")
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
            toolbar_header.removeClass();
            toolbar_header.addClass("modal-header bg-danger");
        } else if (id === 5) {
            dial_number.removeClass('d-none');
            dial_number.prop('disabled', false);
            dial_button.removeClass('d-none');
            dial_button.prop('disabled', false);
            ans_button.removeClass('d-none');
            ans_button.prop('disabled', false);
            swap_button.prop('disabled', false);
            swap_button.removeClass("d-none")
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
            toolbar_header.removeClass();
            toolbar_header.addClass("modal-header bg-danger");
        }
    };

    $(document).on('click', '#btn-agent-login', function(e) {
        e.preventDefault();
        sendAjaxRequest("{{ route('agent.login') }}", "POST");
    });


    $(document).on('click', '#btn-agent-logout', function(e) {
        e.preventDefault();
        ezBSAlert({
            type: "confirm",
            headerText: "Confirm",
            messageText: "ยืนยันการออกจากระบบรับสาย?",
            alertType: "info",
        }).done(function(r) {
            if (r == true) {
                sendAjaxRequest("{{ route('agent.logoff') }}", "POST");
            }
        });
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
        ezBSAlert({
            type: "confirm",
            headerText: "Confirm",
            messageText: "ยืนยันการหยุดพัก?",
            alertType: "info",
        }).done(function(r) {
            if (r == true) {
                sendAjaxRequest("{{ route('agent.unbreak') }}", "POST");
            }

        });

    });

    $(document).on('click', '#btn-unwarp', function(e) {
        e.preventDefault();
        ezBSAlert({
            type: "confirm",
            headerText: "Confirm",
            messageText: "ยืนยันการ Stop WrapUP",
            alertType: "info",
        }).done(function(r) {
            if (r == true) {
                sendAjaxRequest("{{ route('agent.unwarp') }}", "POST");
            }

        });
    });

    $(document).on('click', '#btn-system-logout', function(e) {
        e.preventDefault();
        ezBSAlert({
            type: "confirm",
            headerText: "Confirm",
            messageText: "ยืนยันการออกจากระบบ?",
            alertType: "info",
        }).done(function(r) {
            if (r == true) {
                document.getElementById('logout-form').submit();
            }
        });

    });


    btn_pause.click(function() {
        $.ajax({
            url: "{{ route('pause_list') }}",
            method: 'post',
            data: {
                _token: token,
            },
            async: true, // Use async:true for better performance
            success: function(result) {
                console.log(result)
                $("#pause_list").empty();
                result.forEach(function(item) {
                    var newDropdownItem = $("<a>").attr({
                        class: "dropdown-item button_break",
                        href: "#",
                        "data-id": item.id
                    }).text(item.name);

                    $("#pause_list").append(newDropdownItem);
                });
            }
        });
    });



    //blind tranfer
    $(".button_tranfer").click(function() {
        let len = $('input[name="call[]"]:checked').length;
        if (len > 0) {
            if (len > 1) {
                const prom = ezBSAlert({
                    headerText: "Notice",
                    messageText: "ไม่สามารถโอนสายมากกว่า 1 สายต่อครั้ง",
                    alertType: "info",
                });
            } else {
                let call_number = $('#dial_number').val();
                if (call_number !== '') {
                    //if (confirm("Click OK to Tranfer?")) {
                    let tranfer_chan = $("input[type='checkbox']").val();
                    let chan = tranfer_chan.split("/");
                    $.get(`${api_serv}/tranfer/` + call_number + "/" + chan[1], (data, status) => {
                        if (data.response == 'Success') {
                            const prom = ezBSAlert({
                                headerText: "OK",
                                messageText: "โอนสายสำเร็จ",
                                alertType: "success",
                            });
                        } else {
                            const prom = ezBSAlert({
                                headerText: "Error",
                                messageText: "โอนสาย ไม่สำเร็จ",
                                alertType: "danger",
                            });
                        }
                    });
                    /* $.ajax({
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
                                const prom = ezBSAlert({
                                    headerText: "OK",
                                    messageText: "โอนสายสำเร็จ",
                                    alertType: "success",
                                });
                            } else {
                                const prom = ezBSAlert({
                                    headerText: "Error",
                                    messageText: "โอนสาย ไม่สำเร็จ",
                                    alertType: "danger",
                                });
                            }
                        }
                    }); */
                    //}
                } else {
                    const prom = ezBSAlert({
                        headerText: "Notice",
                        messageText: "กรุณาระบุหมายเลขที่จะโอนสาย",
                        alertType: "info",
                    });
                }

            }
        } else {
            const prom = ezBSAlert({
                headerText: "Notice",
                messageText: "กรุณาระบุสายที่จะโอนสาย",
                alertType: "info",
            });
        }
    });

    //atx tranfer
    $(".button_atx_tranfer").click(function() {
        let len = $('input[name="call[]"]:checked').length;
        if (len > 0) {
            if (len > 1) {
                const prom = ezBSAlert({
                    headerText: "Notice",
                    messageText: "ไม่สามารถโอนสายมากกว่า 1 สายต่อครั้ง",
                    alertType: "info",
                });
            } else {
                let call_number = $('#dial_number').val();
                if (call_number !== '') {
                    //if (confirm("Click OK to Tranfer?")) {
                    let tranfer_chan = $("input[type='checkbox']").val();
                    let chan = tranfer_chan.split("/");
                    $.get(`${api_serv}/atx_tranfer/` + call_number + "/" + chan[1], (data, status) => {
                        if (status == 'success') {
                            const prom = ezBSAlert({
                                headerText: "OK",
                                messageText: "โอนสายสำเร็จ",
                                alertType: "success",
                            });
                        } else {
                            const prom = ezBSAlert({
                                headerText: "Error",
                                messageText: "โอนสาย ไม่สำเร็จ",
                                alertType: "danger",
                            });
                        }
                    });
                    /* $.ajax({
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
                                const prom = ezBSAlert({
                                    headerText: "OK",
                                    messageText: "โอนสายสำเร็จ",
                                    alertType: "success",
                                });
                            } else {
                                const prom = ezBSAlert({
                                    headerText: "Error",
                                    messageText: "โอนสาย ไม่สำเร็จ",
                                    alertType: "danger",
                                });
                            }
                        }
                    }); */
                    //}
                } else {
                    const prom = ezBSAlert({
                        headerText: "Notice",
                        messageText: "กรุณาระบุหมายเลขที่จะโอนสาย",
                        alertType: "info",
                    });
                }

            }
        } else {
            const prom = ezBSAlert({
                headerText: "Notice",
                messageText: "กรุณาระบุสายที่จะโอนสาย",
                alertType: "info",
            });
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
        dial_button.prop('disabled', true);
        let call_number = dial_number.val();
        if (call_number !== '') {
            $.get(`${api_serv}/dial/` + call_number + "/" + exten + "/" + account_code, async (data,
                status) => {
                if (status == 'success') {
                    dial_button.prop('disabled', true);

                    const prom = ezBSAlert({
                        headerText: "OK",
                        messageText: "โทรออกสำเร็จ",
                        alertType: "success",
                    });
                    dial_number.val('');
                } else {
                    const prom = ezBSAlert({
                        headerText: "Error",
                        messageText: "โทรออก ไม่สำเร็จ",
                        alertType: "danger",
                    });
                }
            });
        } else {
            const prom = ezBSAlert({
                headerText: "Notice",
                messageText: "กรุณาระบุหมายเลขที่จะโทร",
                alertType: "info",
            })
            /* .done(function(e) {
                            $('body').css("overflow-y", "hidden");
                            //$('.modal').css("overflow", "hidden");
                            $('.modal').css("overflow-y", "auto");
                        }); */
        }
    });

    //conf
    conf_button.click(function() {
        let len = $('input[name="call[]"]:checked').length;
        if (len > 0) {
            if (len !== 2) {
                const prom = ezBSAlert({
                    headerText: "Notice",
                    messageText: "กรุณาเลือกสายสองสายขึ้นไป",
                    alertType: "info",
                });
            } else {
                let chan = []
                $('input[name="call[]"]:checked').each(function() {
                    let bv = $(this).val().split("/");
                    chan.push(bv[1]);
                });

                $.get(`${api_serv}/chans_variable/` + chan[0], (data, status) => {
                    $.get(`${api_serv}/chans_variable/` + chan[1], (data2, status2) => {
                        mcalldestchan = data[7][1].split("/");
                        mcalldestchan2 = data2[7][1].split("/");

                        $.get(`${api_serv}/conf/` + mcalldestchan[1] + "/" + mcalldestchan2[
                            1] + "/" + chan[1] + "/" + exten, (data, status) => {

                            console.log(status)
                            if (status == 'success') {
                                const prom = ezBSAlert({
                                    headerText: "OK",
                                    messageText: "ประชุมสายสำเร็จ",
                                    alertType: "success",
                                });
                            } else {

                                const prom = ezBSAlert({
                                    headerText: "Error",
                                    messageText: "ประชุมสาย ไม่สำเร็จ",
                                    alertType: "danger",
                                });
                            }
                        });
                    });

                });

            }
        } else {
            const prom = ezBSAlert({
                headerText: "Notice",
                messageText: "กรุณาเลือกสายที่จะประชุม",
                alertType: "info",
            });

        }

    });


    //hangup
    $(document).on('click', '.hangup_call', function(data) {
        //if (!confirm("ยืนยันการวางสาย?")) return;
        let rowid = $(this).data("id")
        ezBSAlert({
            type: "confirm",
            headerText: "Confirm",
            messageText: "ยืนยันการวางสาย?",
            alertType: "info",
        }).done(function(e) {
            if (e == true) {
                if (!rowid) return;
                let chan = rowid.split("/");

                $.get(`${api_serv}/hangup/` + chan[1], (data, status) => {
                    const prom = ezBSAlert({
                        headerText: "OK",
                        messageText: "วางสายสำเร็จ",
                        alertType: "success",
                    });
                });
            }

        });

    })

    $(document).on('click', '.answer_call', function(data) {
        let exten = $(this).data("id")
        $.ajax({
            url: "{{ route('answer') }}",
            method: 'post',
            data: {
                exten: exten,
                _token: token,
            },
            async: true, // Use async:true for better performance
            success: function(result) {
                console.log(result)
                const prom = ezBSAlert({
                    headerText: "OK",
                    messageText: "รับสายสำเร็จ",
                    alertType: "success",
                });
            }
        });

    })

    $(document).on('click', '.hold_call', function(data) {
        let exten = $(this).data("id")
        $.ajax({
            url: "{{ route('hold') }}",
            method: 'post',
            data: {
                exten: exten,
                _token: token,
            },
            async: true, // Use async:true for better performance
            success: function(result) {
                console.log(result)
            }
        });

    })

    $(document).on('click', '#swap_button', function(data) {
        $.ajax({
            url: "{{ route('swap') }}",
            method: 'post',
            data: {
                _token: token,
            },
            async: true, // Use async:true for better performance
            success: function(result) {
                console.log(result)
            }
        });

    })

    $(document).on('click', '#ans_button', function(data) {

  $.get(`${api_serv}/peer/${exten}`, (data, status) => {
    console.log(data)
    console.log(status)
    const ipAddress = data.assress-id;
    $.get(`${api_serv}/answer/${ipAddress}`, (data, status) => {
    // Handle the response data or any other actions you need
  });
  });

});

    //list all call function
    let call_list = () => {
        let mcallprofile = '';
        let mcallexten = '';
        let luniq = '';
        let mstrArray = [];
        let calls_active = 0;
        let dans_button;


        $.get(`${api_serv}/chans/` + exten, async (data, status) => {

            await data.forEach((item, index) => {
                let strArray = item.split("!");
                let chan = strArray[0].split("/");

                $.get(`${api_serv}/chans_variable/` + chan[1], (data, status) => {

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
                        hold_button = "d-none";
                        dans_button = "";
                    } else if (strArray[4] == 'Up' && strArray[12] == '') {
                        if (strArray[5] == "ChanSpy") {
                            spy_exten = strArray[6].split(',');
                            mcallexten = spy_exten[0]
                            state = 'กำลังดักฟัง'
                            state_icon =
                                '<i class="fa-solid fa-bell fa-beat" style="--fa-beat-scale: 2.0;"></i>';
                            state_color = 'card-danger';
                            check_box_state = 'disabled';
                            hold_button = "d-none";
                            dans_button = "d-none";
                        } else {
                            state = 'กำลังรอสาย'
                            state_icon =
                                '<i class="fa-solid fa-bell fa-beat" style="--fa-beat-scale: 2.0;"></i>';
                            state_color = 'card-danger';
                            check_box_state = 'disabled';
                            hold_button = "d-none";
                            dans_button = "d-none";
                        }

                    } else if (strArray[4] == 'Up') {
                        state = 'กำลังสนทนา'
                        state_icon =
                            '<i class="fa-solid fa-phone-volume fa-bounce" style=" --fa-bounce-start-scale-x: 1; --fa-bounce-start-scale-y: 1; --fa-bounce-jump-scale-x: 1; --fa-bounce-jump-scale-y: 1; --fa-bounce-land-scale-x: 1; --fa-bounce-land-scale-y: 1; "></i>';
                        state_color = 'card-danger';
                        check_box_state = '';
                        hold_button = "";
                        dans_button = "d-none";
                    }


                    if (!$('#' + luniq.replace('.', '')).length) {
                        $('#call_list').prepend(`<div class="col-md-3 " id = "${luniq.replace('.', '')}">
						<div class="card custom-bottom-right-card ${state_color}" id = "color_${luniq.replace('.', '')}" data-id="${mcallexten}">
							<div class="card-header">
								<h3 class="card-title call_box" id="state_${luniq.replace('.', '')}" >  ${state_icon} ${state} ${mcallexten} </h3>
								<div class="card-tools">
									<div ><input type="checkbox" style="width: 20px; height: 20px;" name="call[]" id="call[]" value="${strArray[0]}" ${check_box_state}></div>
								</div>
							</div>
							<div class="card-body card-content">
							</div>
							<div class="card-footer text-muted text-right ">
                                <a href="#" class="btn btn-success answer_call ${dans_button}" data-id="${exten}"><i class="fa-solid fa-phone-volume"></i> รับสาย</a>
                                <a href="#" class="btn btn-warning hold_call ${hold_button}" data-id="${exten}"><i class="fa-solid fa-pause"></i> Hold</a>
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
    if ($temporaryPhoneStatusID == -1) {
        @endphp
        set_state_button(-1);
        state_overlay.removeClass("d-none");
        toolbar_modal.modal('show');
        @php
    }
    @endphp
</script>
