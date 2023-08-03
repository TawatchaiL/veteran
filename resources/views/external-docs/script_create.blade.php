<script>
    // Function to clear Dropzone previews
    function clearDropzonePreviews() {
        $('input[name="imgFiles[]"]').remove();
        $('#dropzone_preview').html('');
        $('#dropzone_preview').css("display", "none");
    }

    $(document).ready(function() {

        var canvas = document.getElementById('signature-pad');
        var signaturePad = new SignaturePad(canvas);

        // Optional: Customize the appearance of the signature pad
        signaturePad.penColor = 'blue'; // Change the pen color
        signaturePad.backgroundColor = 'rgba(0, 0, 0, 0)'; // Set the background color

        // Handle clear button click event
        $('#clear-signature').on('click', function() {
            signaturePad.clear();
            canvas.style.backgroundColor = 'rgba(0, 0, 0, 0)';
            //$('#signature-image').attr('src', '');
        });

        $(document).on('click', '#CreateButton', function(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();

            $('#custom-tabs-one-profile-tab').tab('show');
            $("#AddDocFrom").val(null).trigger("change");
            $("#AddPriorities").val(null).trigger("change");
            $('#AddReceive').empty().trigger('change');
            $('.positions').attr("readonly", "readonly");
            $('.users').attr("readonly", "readonly");
            $("#AddDepartment").val(null).trigger("change")
            $("#AddPosition").val(null).trigger("change")
            $('#upload_preview').html('');

            $.ajax({
                method: "GET",
                url: "external-docs/running",
                success: function(res) {
                    console.log(res)
                    $('#AddNumber').val(res.running);
                }
            });

            $('#CreateModal').modal('show');
        });

        // Create product Ajax request.
        $('#SubmitCreateForm').click(function(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();
            $(this).prop('disabled', true);

            isValid = true;
            if (signaturePad.isEmpty()) {
                toastr.error('กรุณาเซ็นต์ลายเซ็น', {
                    timeOut: 5000
                });
                isValid = false;
            }

            var values = $("input[name='imgFiles[]']")
                .map(function() {
                    return $(this).val();
                }).get();

            if (!document.getElementsByName('imgFiles[]').length) {
                toastr.error('กรุณาอัพโหลดไฟล์', {
                    timeOut: 5000
                });
                isValid = false;
            }

            if (!isValid) {
                $("#SubmitCreateForm").prop('disabled', false);
                return false;

            }

            var signatureData = signaturePad.toDataURL();
            $.ajax({
                url: "{{ route('external-docs.store') }}",
                method: 'post',
                data: {
                    img: values,
                    signature: signatureData,
                    stampx: $('#stampx').val(),
                    stampy: $('#stampy').val(),
                    sstampx: $('#sstampx').val(),
                    sstampy: $('#sstampy').val(),
                    doc_receive_number: $('#AddNumber').val(),
                    doc_number: $('#AddDocNumber').val(),
                    priorities_id: $('#AddPriorities').val()[0],
                    signdate: $('#AddDate').val(),
                    doc_from: $('#AddDocFrom').val()[0],
                    doc_to: $('#AddDocTo').val(),
                    subject: $('#AddSubject').val(),
                    doc_receive: $('#AddReceive').val()[0],
                    _token: token,
                },
                success: function(result) {
                    if (result.errors) {
                        $('.alert-danger').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<strong><li>' + value +
                                '</li></strong>');
                        });
                    } else {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.alert-success').append('<strong><li>' + result.success +
                            '</li></strong>');
                        toastr.success(result.success, {
                            timeOut: 5000
                        });
                        $('#Listview').DataTable().ajax.reload();
                        $("#AddDocFrom").val(null).trigger("change");
                        $("#AddPriorities").val(null).trigger("change");
                        $('#AddReceive').empty().trigger('change');
                        $('.form').trigger('reset');
                        clearDropzonePreviews();
                        signaturePad.clear();
                        canvas.style.backgroundColor = 'rgba(0, 0, 0, 0)';
                        $('#CreateModal').modal('hide');
                    }
                    $("#SubmitCreateForm").prop('disabled', false);
                }
            });
        });



        $('#CreateStamp').click(function(e) {
            $(this).prop('disabled', true);
            cstamp(e);
        });

        function cstamp(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();
            $('#loadingOverlay').show();

            isValid = true;
            if (signaturePad.isEmpty()) {
                toastr.error('กรุณาเซ็นต์ลายเซ็น', {
                    timeOut: 5000
                });
                isValid = false;
            }
            var values = $("input[name='imgFiles[]']")
                .map(function() {
                    return $(this).val();
                }).get();

            if (!document.getElementsByName('imgFiles[]').length) {
                toastr.error('กรุณาอัพโหลดไฟล์', {
                    timeOut: 5000
                });
                isValid = false;
            }

            if (!isValid) {
                $('#loadingOverlay').hide();
                $("#CreateStamp").prop('disabled', false);
                return false;
            }
            console.log($('#old_stamp').val());
            var signatureData = signaturePad.toDataURL();
            $.ajax({
                url: "{{ route('external-docs.stamp') }}",
                method: 'post',
                data: {
                    img: values,
                    signature: signatureData,
                    doc_receive_number: $('#AddNumber').val(),
                    signdate: $('#AddDate').val(),
                    stampx: $('#stampx').val(),
                    stampy: $('#stampy').val(),
                    sstampx: $('#sstampx').val(),
                    sstampy: $('#sstampy').val(),
                    old_stamp: $('#old_stamp').val(),
                    _token: token,
                },
                success: function(result) {
                    if (result.errors) {
                        $('.alert-danger').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<strong><li>' + value +
                                '</li></strong>');
                        });
                    } else {
                        $('.alert-danger').hide();
                        toastr.success(result.success, {
                            timeOut: 5000
                        });
                        $('#old_stamp').val(result.old_stamp);
                        $('#upload_preview').html(result.iframe)
                    }
                    $('#loadingOverlay').hide();
                    $("#CreateStamp").prop('disabled', false);
                }
            });
        }

    });
</script>
