<script>
    $(document).on('click', '#btn-agent-login', function(e) {
        $.ajax({
            url: "/agent_login",
            method: 'POST',
            success: function(result) {
                console.log(result)
            }
        });
    });

    $(document).on('click', '.button_break', function(e) {
        var id = 2;
        var additionalData = {
            phone: 9999,
            break_id: id,
        };
        $.ajax({
            url: "/agent_break",
            method: 'POST',
            data: additionalData,

            success: function(result) {
                console.log(result)
            }
        });
    });

    $(document).on('click', '.button_unbreak', function(e) {
        var additionalData = {
            phone: 9999,
        };
        $.ajax({
            url: "/agent_unbreak",
            method: 'POST',
            data: additionalData,

            success: function(result) {
                console.log(result)
            }
        });
    });
</script>
