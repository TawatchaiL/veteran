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

    var logoutConfirmed = false;

    $(document).ready(function() {
        // Handle the window's beforeunload event
        $(window).on('beforeunload', function(e) {
            if (!logoutConfirmed) {
                // Display a confirmation dialog
                var confirmationMessage = 'คุณแน่ใจว่าต้องการออกจากระบบ?';
                (e || window.event).returnValue = confirmationMessage;
                return confirmationMessage;
            }
        });

        // Handle the click event of the logout button
        $('#logoutButton').on('click', function() {
            logoutConfirmed = true;
            // Perform the logout action here, e.g., make an AJAX request
            $.ajax({
                url: "{{ route('logout') }}",
                method: 'POST',
                success: function(result) {
                    // Handle the logout success, e.g., redirect to the login page
                    window.location.href = "{{ route('login') }}";
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    // Handle any errors during logout
                }
            });
        });
    });
</script>
