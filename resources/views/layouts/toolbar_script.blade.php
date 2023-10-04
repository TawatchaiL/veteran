<script>
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
                console.log($result)
            }
        });
    });
</script>
