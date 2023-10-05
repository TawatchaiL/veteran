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
        const classMap = {
            0: 'btn btn-secondary',
            1: 'btn btn-success',
            2: 'btn btn-warning',
        };
        return classMap[id] || '';
    };

    const toggleButtonState = (element, enabled) => {
        element.prop('disabled', !enabled);
    };

    const set_state_button = (id) => {
        const buttonElements = {
            performance_button: $('#performance_button'),
            break_group: $('#break_group'),
            btn_pause: $('#btn_pause'),
            btn_unbreak: $('#btn_unbreak'),
            btn_system_logout: $('#btn_system_logout'),
            btn_agent_logout: $('#btn_agent_logout'),
            btn_agent_login: $('#btn_agent_login'),
        };

        toggleButtonState(buttonElements.performance_button, id === 1);
        toggleButtonState(buttonElements.break_group, id !== 0);
        toggleButtonState(buttonElements.btn_pause, id === 0);
        toggleButtonState(buttonElements.btn_unbreak, id === 2);
        toggleButtonState(buttonElements.btn_system_logout, id === 0);
        toggleButtonState(buttonElements.btn_agent_logout, id === 1);
        toggleButtonState(buttonElements.btn_agent_login, id === 0);
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
