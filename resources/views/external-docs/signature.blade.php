<script>
    $(document).ready(function() {


        // Handle save button click event
        $('#save-signature').on('click', function() {
            if (signaturePad.isEmpty()) {
                alert('กรุณาเซ็นต์ลายเซ็น');
            } else {
                // Get the signature data as a base64-encoded PNG image
                var signatureData = signaturePad.toDataURL();

                // Set the signature image source
                //$('#signature-image').attr('src', signatureData);

                // Send the signature data to the Laravel route via AJAX
                $.ajax({
                    type: 'POST',
                    url: '/save-signature', // Replace this with your Laravel route URL
                    data: {
                        image_data: signatureData
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // The server-side script can send back a response if needed
                        console.log(response);
                    },
                    error: function() {
                        alert('Failed to save the signature.');
                    }
                });
            }
        });
    });
</script>
