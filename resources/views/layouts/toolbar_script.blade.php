<script>
    const updateUI = (result) => {
        console.log(result);
        $('#phone_state').html(result.message);
        $('#phone_state_icon').html(result.icon);
        $('#ToolbarButton').removeClass().addClass(get_state_color(result.id));
        set_state_button(result.id);
        $('#ToolbarModal').modal('hide');
    };

    const sendAjaxRequest = (url, method, data = {}) => {
        $.ajax({
            url,
            method,
            data,
            success: updateUI,
        });
    };

    const get_state_color = (id) => {
        if (id === 0) {
            return 'btn btn-secondary';
        } else if (id === 1) {
            return 'btn btn-success';
        } else if (id === 2) {
            return 'btn btn-warning';
        }
    };

    const set_state_button = (id) => {

        const performance_button = $('#performance_button');
        const break_group = $('#break_group');
        const btn_pause = $('#btn-pause');
        const btn_unbreak = $('#btn-unbreak');
        const btn_system_logout = $('#btn-system-logout');
        const btn_agent_logout = $('#btn-agent-logout');
        const btn_agent_login = $('#btn-agent-login');

        if (id === 0) {
            performance_button.prop('disabled', true);
            break_group.addClass("d-none");
            btn_pause.prop('disabled', true);
            btn_unbreak.addClass("d-none");
            btn_system_logout.prop('disabled', false);
            btn_agent_logout.addClass("d-none");
            btn_agent_login.removeClass("d-none");
            btn_agent_login.prop('disabled', false);
        } else if (id === 1) {
            performance_button.prop('disabled', false);
            break_group.removeClass("d-none");
            btn_pause.prop('disabled', false);
            btn_unbreak.addClass("d-none");
            btn_system_logout.prop('disabled', true);
            btn_agent_logout.removeClass("d-none");
            btn_agent_logout.prop('disabled', false);
            btn_agent_login.addClass("d-none");
        } else if (id === 2) {
            performance_button.prop('disabled', true);
            break_group.addClass("d-none");
            btn_pause.prop('disabled', true);
            btn_unbreak.removeClass("d-none");
            btn_unbreak.prop('disabled', false);
            btn_system_logout.prop('disabled', true);
            btn_agent_logout.addClass("d-none");
            btn_agent_login.addClass("d-none");
        }
    };

    $(document).on('click', '#btn-agent-login', (e) => {
        e.preventDefault();
        sendAjaxRequest("{{ route('agent.login') }}", "POST");
    });

    $(document).on('click', '#btn-agent-logout', (e) => {
        e.preventDefault();
        sendAjaxRequest("{{ route('agent.logoff') }}", "POST");
    });

    $(document).on('click', '.button_break', (e) => {
        e.preventDefault();
        const bid = $(this).data('id');
        const additionalData = {
            id_break: bid,
        };
        console.log(additionalData);
        sendAjaxRequest("{{ route('agent.break') }}", "POST", additionalData);
    });

    $(document).on('click', '.button_unbreak', (e) => {
        e.preventDefault();
        sendAjaxRequest("{{ route('agent.unbreak') }}", "POST");
    });

    $(document).on('click', '#btn-system-logout', (e) => {
        e.preventDefault();
        document.getElementById('logout-form').submit();
    });
</script>
