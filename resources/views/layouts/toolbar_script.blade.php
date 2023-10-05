<script>
    const updateUI = (result) => {
        console.log(result);
        $('#phone_state').html(result.message);
        $('#phone_state_icon').html(result.icon);
        $('#ToolbarButton').removeClass().addClass(get_state_color(result.id));
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
        if (id === 0) {
            dial_number.attr('disabled', true);
            dial_button.attr('disabled', true);
        } else if (id === 1) {
            dial_number.attr('disabled', false);
            dial_button.attr('disabled', false);
        } else if (id === 2) {
            dial_number.attr('disabled', false);
            dial_button.attr('disabled', false);
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
