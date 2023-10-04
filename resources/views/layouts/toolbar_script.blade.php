<script>
    $(document).on('click', '#btn-agent-login', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('agent.login') }}",
            method: 'POST',
            success: function(result) {
                console.log(result)
                $('#phone_state').html(result.message);
                $('#phone_state_icon').html(result.icon);
                $('#ToolbarModal').modal('hide');
            }
        });
    });

    $(document).on('click', '#btn-agent-logout', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('agent.logoff') }}",
            method: 'POST',
            success: function(result) {
                console.log(result)
                $('#phone_state').html(result.message);
                $('#phone_state_icon').html(result.icon);
                $('#ToolbarModal').modal('hide');
            }
        });
    });

    let bid;
    $(document).on('click', '.button_break', function(e) {
        e.preventDefault();
        var bid = $(this).data('id');
        var additionalData = {
            id_break: bid,
        };
        $.ajax({
            url: "{{ route('agent.break') }}",
            method: 'POST',
            data: additionalData,

            success: function(result) {
                console.log(result)
                $('#phone_state').html(result.message);
                $('#phone_state_icon').html(result.icon);
                $('#ToolbarModal').modal('hide');
            }
        });
    });

    $(document).on('click', '.button_unbreak', function(e) {
        e.preventDefault();
        var additionalData = {
            phone: 9999,
        };
        $.ajax({
            url: "{{ route('agent.unbreak') }}",
            method: 'POST',
            data: additionalData,

            success: function(result) {
                console.log(result)
            }
        });
    });
</script>
