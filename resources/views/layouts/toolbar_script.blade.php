<script>
    const updateUI = (result) => {
        console.log(result);
        $('#phone_state').html(result.message);
        $('#phone_state_icon').html(result.icon);
        $('#ToolbarButton').removeClass().addClass(get_state_color(result.id));
        set_state_button(result.id)
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
        let dial_number = $('#dial_number');
        let dial_button = $('#dial_button');
        let tranfer_button = $('#dial_number');
        let performance_button = $('#dial_number');
        let conf_button = $('#dial_number');
        let break_group = $('#dial_number');
        let btn_pause = $('#dial_number');
        let btn_unbreak = $('#dial_number');
        let btn_system_logout = $('#dial_number');
        let btn_agent_logout = $('#dial_number');
        let btn_agent_login = $('#dial_number');

        if (id === 0) {
            performance_button.attr('disabled', true);
            break_group.addClass("d-none");
            btn_pause.attr('disabled', true);
            btn_unbreak.addClass("d-none");
            btn_system_logout.attr('disabled', false);
            btn_agent_logout.addClass("d-none");
            btn_agent_login.attr('disabled', false);
        } else if (id === 1) {
            performance_button.attr('disabled', false);
            break_group.removeClass("d-none");
            btn_pause.attr('disabled', false);
            btn_unbreak.addClass("d-none");
            btn_system_logout.attr('disabled', true);
            btn_agent_logout.removeClass("d-none");
            btn_agent_login.addClass("d-none");
        } else if (id === 2) {
            break_group.removeClass("d-none");
            btn_pause.attr('disabled', true);
            btn_unbreak.removeClass("d-none");
            btn_system_logout.attr('disabled', true);
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
