<script>
    $(document).on('click', '#btn-agent-login', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('agent.login') }}",
            method: 'POST',
            success: function(result) {
                console.log(result)
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
            }
        });
    });

    $(document).on('click', '.button_break', function(e) {
        e.preventDefault();
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
        e.preventDefault();
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

    $(window).on('beforeunload', function() {
        // Your code to execute before the page is unloaded
        // For example, you can show a confirmation dialog here
        return 'คุณแน่ใจว่าจะปิดหน้าโปรแกรมใช่ไหม ถ้าใช่จะทำการออกจากระบบให้อัติโนมัติ?';
    });

    $(window).on('unload', function() {
        $.ajax({
            url: "{{ route('agent.logoff') }}",
            method: 'POST',
            success: function(result) {
                console.log(result)
            }
        });
    });
</script>
