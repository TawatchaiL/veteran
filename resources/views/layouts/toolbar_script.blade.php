<script>
    const updateUI = (result) => {
        console.log(result);
        if (result.success == true) {
            toastr.success('เปลี่ยนสถานะ เรียบร้อยแล้ว', {
                timeOut: 5000
            });
            $('#phone_state').html(result.message);
            $('#phone_state_icon').html(result.icon);
            $('#phone_state').removeClass().addClass(get_state_color(result.id));
            $('#phone_state_icon').removeClass().addClass(get_state_color(result.id));
            set_state_button(result.id);
            $('#ToolbarModal').modal('hide');
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
        if (id === 0) {
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

        const performance_button = $('#performance_button');
        const tranfer_button = $('#tranfer_button');
        const conf_button = $('#conf_button');
        const break_group = $('#break_group');
        const btn_pause = $('#btn-pause');
        const btn_unbreak = $('#btn-unbreak');
        const btn_system_logout = $('#btn-system-logout');
        const btn_agent_logout = $('#btn-agent-logout');
        const btn_agent_login = $('#btn-agent-login');


        if (id === 0) {
            performance_button.prop('disabled', true);
            tranfer_button.prop('disabled', true);
            conf_button.prop('disabled', true);
            break_group.addClass("d-none");
            btn_pause.prop('disabled', true);
            btn_unbreak.addClass("d-none");
            //btn_system_logout.prop('disabled', false);
            btn_agent_logout.removeClass("d-none");
            btn_agent_logout.prop('disabled', false);
            btn_agent_logoff.addClass("d-none");
            btn_agent_logoff.prop('disabled', true);
            btn_agent_login.removeClass("d-none");
            btn_agent_login.prop('disabled', false);
        } else if (id === 1) {
            performance_button.prop('disabled', true);
            tranfer_button.prop('disabled', true);
            conf_button.prop('disabled', true);
            break_group.removeClass("d-none");
            btn_pause.prop('disabled', false);
            btn_unbreak.addClass("d-none");
            btn_unbreak.prop('disabled', true);
            //btn_system_logout.prop('disabled', true);
            btn_agent_logout.removeClass("d-none");
            btn_agent_logout.prop('disabled', false);
            btn_agent_login.prop('disabled', true);
            btn_agent_login.addClass("d-none");
        } else if (id === 2) {
            performance_button.prop('disabled', true);
            tranfer_button.prop('disabled', true);
            conf_button.prop('disabled', true);
            break_group.addClass("d-none");
            btn_pause.prop('disabled', true);
            btn_unbreak.removeClass("d-none");
            btn_unbreak.prop('disabled', false);
            //btn_system_logout.prop('disabled', true);
            btn_agent_logout.addClass("d-none");
            btn_agent_logout.prop('disabled', true);
            btn_agent_login.addClass("d-none");
            btn_agent_login.prop('disabled', true);
        } else if (id === 4) {
            performance_button.prop('disabled', false);
            tranfer_button.prop('disabled', false);
            conf_button.prop('disabled', false);
            break_group.addClass("d-none");
            btn_pause.prop('disabled', true);
            btn_unbreak.removeClass("d-none");
            btn_unbreak.prop('disabled', false);
            //btn_system_logout.prop('disabled', true);
            btn_agent_logout.addClass("d-none");
            btn_agent_login.addClass("d-none");
            btn_agent_logout.prop('disabled', true);
            btn_agent_login.prop('disabled', true);
        } else if (id === 5) {
            performance_button.prop('disabled', false);
            tranfer_button.prop('disabled', false);
            conf_button.prop('disabled', false);
            break_group.addClass("d-none");
            btn_pause.prop('disabled', true);
            btn_unbreak.removeClass("d-none");
            btn_unbreak.prop('disabled', false);
            //btn_system_logout.prop('disabled', true);
            btn_agent_logout.addClass("d-none");
            btn_agent_login.addClass("d-none");
            btn_agent_logout.prop('disabled', true);
            btn_agent_login.prop('disabled', true);
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
</script>
