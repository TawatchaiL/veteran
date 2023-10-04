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

    var pageIsReloading = false;

    $(document).ready(function() {
        // Set the flag when the page is about to be reloaded
        $(window).on('beforeunload', function() {
            if (!pageIsReloading) {
                // Your code to execute before the page is unloaded
                // For example, you can show a confirmation dialog here
                return 'คุณแน่ใจว่าจะปิดหน้าโปรแกรมใช่ไหม ถ้าใช่จะทำการออกจากระบบให้อัติโนมัติ?';
            }
        });

        // Listen for the "beforeunload" event triggered when the page is reloaded
        $(window).on('beforeunload', function() {
            pageIsReloading = true;
        });

        // Handle the button click event to trigger the logoff action
        $('#logoffButton').on('click', function() {
            $.ajax({
                url: "{{ route('agent.logoff_out') }}",
                method: 'POST',
                success: function(result) {
                    console.log(result);
                    // Handle success, e.g., show a message to the user
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    // Handle error, e.g., display an error message
                }
            });
        });
    });
</script>
