<script>
    function clearDropzonePreviews2() {
        $('input[name="imgFiles2[]"]').remove();
        $('#dropzone_preview2').html('');
        $('#dropzone_preview2').css("display", "none");
    }

    $(document).ready(function() {

        var canvas2 = document.getElementById('esignature-pad');
        var esignaturePad = new SignaturePad(canvas2);

        // Optional: Customize the appearance of the signature pad
        esignaturePad.penColor = 'blue'; // Change the pen color
        esignaturePad.backgroundColor = 'rgba(0, 0, 0, 0)'; // Set the background color

        // Handle clear button click event
        $('#eclear-signature').on('click', function() {
            esignaturePad.clear();
            canvas2.style.backgroundColor = 'rgba(0, 0, 0, 0)';
            //$('#signature-image').attr('src', '');
        });

        $('#EditStamp').click(function(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();
            $('#loadingOverlay').show();
            $(this).prop('disabled', true)

            isValid = true;

            /*  var imageElement = document.getElementById('background-image');
             if (!imageElement) {
                 console.log(imageElement)
                 if (esignaturePad.isEmpty()) {
                     toastr.error('กรุณาเซ็นต์ลายเซ็น', {
                         timeOut: 5000
                     });
                     isValid = false;
                 }
             } */

            var values = $("input[name='imgFiles2[]']").add("input[name='imgFiles3[]']")
                .map(function() {
                    return $(this).val();
                }).get();

            if (!document.getElementsByName('imgFiles2[]').length && !document.getElementsByName(
                    'imgFiles3[]').length) {
                toastr.error('กรุณาอัพโหลดไฟล์', {
                    timeOut: 5000
                });
                isValid = false;
            }

            if (!isValid) {
                $('#loadingOverlay').hide();
                $("#EditStamp").prop('disabled', false);
                return false;
            }

            var esignatureData = esignaturePad.toDataURL();
            $.ajax({
                url: "{{ route('external-docs.stamp') }}",
                method: 'post',
                data: {
                    img: values,
                    signature: esignatureData,
                    doc_receive_number: $('#EditNumber').val(),
                    signdate: $('#EditDate').val(),
                    stampx: $('#estampx').val(),
                    stampy: $('#estampy').val(),
                    sstampx: $('#esstampx').val(),
                    sstampy: $('#esstampy').val(),
                    //old_stamp: $('#old_stamp').val(),
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
                        $('#file_preview').html('');
                        $('#upload_preview2').html(result.iframe)
                    }
                    $('#loadingOverlay').hide();
                    $("#EditStamp").prop('disabled', false);
                }
            });
        });


        let id;
        $(document).on('click', '#getEditData', function(e) {
            e.preventDefault();


            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();

            $('#custom-tabs-one-profile-tab2').tab('show');
            clearDropzonePreviews2();
            $('#upload_preview2').html('');
            $('#EditReceive').empty();
            $("#AddDepartment").val(null).trigger("change")
            $("#AddPosition").val(null).trigger("change")
            $('.positions').attr("readonly", "readonly");
            $('.users').attr("readonly", "readonly");
            esignaturePad.clear();
            canvas2.style.backgroundColor = 'rgba(0, 0, 0, 0)';
            $('input[name="imgFiles3[]"]').remove();



            id = $(this).data('id');
            $.ajax({
                url: "external-docs/edit/" + id,
                method: 'GET',
                cache: false,
                success: function(res) {
                    $('#EditNumber').val(res.data.doc_receive_number);
                    $('#EditDocNumber').val(res.data.doc_number);
                    $('#EditDate').val(res.data.signdate);
                    $('#EditPriorities').val(res.data.priorities_id).change();
                    $('#EditDocFrom').val(res.data.doc_from).change();
                    $('#EditDocTo').val(res.data.doc_to);
                    $('#EditSubject').val(res.data.subject);
                    $('#EditReceive').append(res.select_list_receive);
                    $('#EditReceive').val(res.data.doc_receive).change();
                    $('.imgs').html(res.imgs);
                    $('#estampx').val(res.data.stampx);
                    $('#estampy').val(res.data.stampy);
                    $('#esstampx').val(res.data.sstampx);
                    $('#esstampy').val(res.data.sstampy);
                    $('#file_preview').html(res.iframes);
                    //$('#old_stamp').val(res.data.signature);
                    $('#editdata').append(res.inputf);

                    var backgroundImageUrl =
                        res.data.signature; // Replace this with the path to your image
                    var image = new Image();

                    image.onload = function() {
                        // Draw the image onto the second canvas as a background
                        canvas2.getContext('2d').drawImage(image, 0, 0, canvas2.width,
                            canvas2.height);
                    };

                    image.src = backgroundImageUrl;
                    image.setAttribute('id', 'background-image');

                    //console.log(res.inputf);
                    //$('#EditModalBody').html(res.html);
                    $('#EditModal').modal('show');
                }
            });

        })

        $('#SubmitEditForm').click(function(e) {
            if (!confirm("ยืนยันการทำรายการ ?")) return;
            e.preventDefault();
            $(this).prop('disabled', true);

            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();

            isValid = true;
            /* if (esignaturePad.isEmpty()) {
                toastr.error('กรุณาเซ็นต์ลายเซ็น', {
                    timeOut: 5000
                });
                isValid = false;
            } */

            var values = $("input[name='imgFiles2[]']").add("input[name='imgFiles3[]']")
                .map(function() {
                    return $(this).val();
                }).get();

            if (!document.getElementsByName('imgFiles2[]').length && !document.getElementsByName(
                    'imgFiles3[]').length) {
                toastr.error('กรุณาอัพโหลดไฟล์', {
                    timeOut: 5000
                });
                isValid = false;
            }

            if (!isValid) {
                $("#SubmitEditForm").prop('disabled', false);
                return false;
            }
            console.log($('#old_stamp').val());

            //console.log(values);
            var esignatureData = esignaturePad.toDataURL();
            $.ajax({
                url: "external-docs/save/" + id,
                method: 'PUT',
                data: {
                    img: values,
                    signature: esignatureData,
                    stampx: $('#estampx').val(),
                    stampy: $('#estampy').val(),
                    sstampx: $('#esstampx').val(),
                    sstampy: $('#esstampy').val(),
                    doc_receive_number: $('#EditNumber').val(),
                    doc_number: $('#EditDocNumber').val(),
                    priorities_id: $('#EditPriorities').val()[0],
                    signdate: $('#EditDate').val(),
                    doc_from: $('#EditDocFrom').val()[0],
                    doc_to: $('#EditDocTo').val(),
                    subject: $('#EditSubject').val(),
                    doc_receive: $('#EditReceive').val()[0],
                    //old_stamp: $('#old_stamp').val(),
                    _token: token
                },

                success: function(result) {
                    console.log(result);
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
                        $('#EditModal').modal('hide');
                        toastr.success(result.success, {
                            timeOut: 5000
                        });
                        $('#Listview').DataTable().ajax.reload();
                        clearDropzonePreviews2();
                        esignaturePad.clear();
                        canvas2.style.backgroundColor = 'rgba(0, 0, 0, 0)';
                        $('#file_preview').empty();
                        //setTimeout(function() {
                        //$('.alert-success').hide();

                        //}, 10000);

                    }
                    $("#SubmitEditForm").prop('disabled', false);
                }
            });
        });
    });
</script>
