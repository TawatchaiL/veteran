<script>
    // Function to clear Dropzone previews
    function clearDropzonePreviews() {
        $('input[name="imgFiles[]"]').remove();
        $('#dropzone_preview').html('');
        $('#dropzone_preview').css("display", "none");
    }

    function clearDropzonePreviews2() {
        $('input[name="imgFiles2[]"]').remove();
        $('#dropzone_preview2').html('');
        $('#dropzone_preview2').css("display", "none");
    }

    $(document).ready(function() {
        $(".delete_all_button").click(function() {
            var len = $('input[name="table_records[]"]:checked').length;
            if (len > 0) {

                if (confirm("ยืนยันการลบข้อมูล ?")) {
                    $('form#delete_all').submit();
                }
            } else {
                alert("กรุณาเลือกรายการที่จะลบ");
            }

        });

        $('#check-all').click(function() {
            $(':checkbox.flat').prop('checked', this.checked);
        });

        $("button[data-dismiss-modal=modal1]").click(function() {
            $('#innerModal').modal('hide');
        });

        $("button[data-dismiss-modal=modal2]").click(function() {
            $('#innerModal2').modal('hide');
        });

        $("button[data-dismiss-modal=modal3]").click(function() {
            $('#innerModal3').modal('hide');
        });

        /* $("#AddDate").datepicker({
                language:'th-th',
                format:'dd/mm/yyyy',
                autoclose: true
            }); */

        $.datepicker.setDefaults($.datepicker.regional["th"]);
        var currentDate = new Date();

        currentDate.setYear(currentDate.getFullYear() + 543);
        // Birth date
        $(".datepick").datetimepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '+443:+543',
            dateFormat: 'dd/mm/yy',
            onSelect: function(date) {
                $("#edit-date-of-birth").addClass('filled');
            }
        });
        $('.datepick').datetimepicker("setDate", currentDate);



        $(".select2_single").select2({
            maximumSelectionLength: 1,
            allowClear: false,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือก'
        });

        $(".select2_single").on("select2:unselect", function(e) {
            //log("select2:unselect", e);
            //$('.products').html('');
        });

        $(".select2_singles").select2({
            maximumSelectionLength: 1,
            allowClear: false,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือก'
        });


        $(".select2_multiple").select2({
            maximumSelectionLength: 2,
            //placeholder: "With Max Selection limit 4",
            allowClear: false,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือก'
        });

        //$.noConflict();
        var token = ''
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        var table = $('#Listview').DataTable({
            /*"aoColumnDefs": [
            {
            'bSortable': true,
            'aTargets': [0]
            } //disables sorting for column one
            ],
            "searching": false,
            "lengthChange": false,
            "paging": false,
            'iDisplayLength': 10,
            "sPaginationType": "full_numbers",
            "dom": 'T<"clear">lfrtip',
                */
            ajax: '',
            serverSide: true,
            processing: true,
            language: {
                loadingRecords: '&nbsp;',
                processing: `<div class="spinner-border text-primary"></div>`,
                "sProcessing": "กำลังดำเนินการ...",
                "sLengthMenu": "แสดง_MENU_ แถว",
                "sZeroRecords": "ไม่พบข้อมูล",
                "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 รายการ",
                "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                "sInfoPostFix": "",
                "sSearch": "ค้นหา:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "เริ่มต้น",
                    "sPrevious": "ก่อนหน้า",
                    "sNext": "ถัดไป",
                    "sLast": "สุดท้าย"
                }
            },
            aaSorting: [
                [0, "desc"]
            ],
            iDisplayLength: 10,
            lengthMenu: [10, 25, 50, 75, 100],
            stateSave: true,
            autoWidth: false,
            responsive: true,
            sPaginationType: "full_numbers",
            dom: 'T<"clear">lfrtip',
            columns: [{
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'cname',
                    name: 'cname'
                },
                {
                    data: 'doc_receive_number',
                    name: 'doc_receive_number'
                },
                {
                    data: 'subject',
                    name: 'subject'
                },
                {
                    data: 'signdate',
                    name: 'signdate'
                },
                {
                    data: 'priorities',
                    name: 'priorities'
                },
                {
                    data: 'uname',
                    name: 'uname'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });


        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        $(".departmentl").change(function() {
            let department = $('#AddDepartment').val();
            //console.log(product);
            //alert(product);
            $('#AddPosition').html('');
            if (department.length !== 0) {
                $.ajax({
                    method: "GET",
                    url: "departments/find/add/" + department,
                    success: function(res) {
                        $('.positions').html(res.html);
                        $('.positions').removeAttr('readonly');
                    }
                });
            }
        })

        $(".positions").change(function() {
            let position = $('#AddPosition').val();
            $('#AddUser').html('');
            if (position.length !== 0) {
                $.ajax({
                    method: "GET",
                    url: "users/find/add/" + position,
                    success: function(res) {
                        $('.users').html(res.html);
                        $('.users').removeAttr('readonly');
                    }
                });
            }
        })




        $(document).on('click', '#CreateButton', function(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();

            $('#custom-tabs-one-home-tab').tab('show');
            $("#AddDocFrom").val(null).trigger("change");
            $("#AddPriorities").val(null).trigger("change");
            $('#AddReceive').empty().trigger('change');
            $('.positions').attr("readonly", "readonly");
            $('.users').attr("readonly", "readonly");
            $("#AddDepartment").val(null).trigger("change")
            $("#AddPosition").val(null).trigger("change")

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


        $(document).on('click', '.inner1', function(e) {
            e.preventDefault();
            $('.alert-in').html('');
            $('.alert-in').hide();
            $('.success-in').html('');
            $('.success-in').hide();
        });

        $(document).on('click', '.inner2', function(e) {
            e.preventDefault();
            $('.alert-in').html('');
            $('.alert-in').hide();
            $('.success-in').html('');
            $('.success-in').hide();
        });

        $(document).on('click', '.inner3', function(e) {
            e.preventDefault();
            $('.alert-in').html('');
            $('.alert-in').hide();
            $('.success-in').html('');
            $('.success-in').hide();
        });

        // Create product Ajax request.
        $('#SubmitCreateForm').click(function(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();

            isValid = true;
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
                return false;
            }


            $.ajax({
                url: "{{ route('external-docs.store') }}",
                method: 'post',
                data: {
                    img: values,
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
                        $('#CreateModal').modal('hide');
                    }
                }
            });
        });


        $('#SubmitCreateFormIn1').click(function(e) {
            e.preventDefault();
            $('.alert-in').html('');
            $('.alert-in').hide();
            $('.success-in').html('');
            $('.success-in').hide();


            $.ajax({
                url: "{{ route('contacts.store') }}",
                method: 'post',
                data: {
                    name: $('#AddName').val(),
                    telephone: $('#AddTelephone').val(),
                    _token: token,
                },
                success: function(result) {
                    if (result.errors) {
                        $('.alert-in').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-in').show();
                            $('.alert-in').append('<strong><li>' + value +
                                '</li></strong>');
                        });
                    } else {
                        $('.alert-in').hide();
                        $('.success-in').show();
                        $('.success-in').append('<strong><li>' + result.success +
                            '</li></strong>');
                        toastr.success(result.success, {
                            timeOut: 5000
                        });
                        $('.doc_from').append(result.contact);
                        $('.doc_from').val(result.cid).change();
                        $('#AddName').val('');
                        $('#AddTelephone').val('');
                        //$('.form').trigger('reset');
                        $('.success-in').hide();
                        $('.alert-in').hide();
                        $('#innerModal').modal('hide');
                    }
                }
            });
        });

        $('#SubmitCreateFormIn2').click(function(e) {
            e.preventDefault();
            $('.alert-in').html('');
            $('.alert-in').hide();
            $('.success-in').html('');
            $('.success-in').hide();


            $.ajax({
                url: "{{ route('priorities.store') }}",
                method: 'post',
                data: {
                    name: $('#AddPName').val(),
                    status: 1,
                    _token: token,
                },
                success: function(result) {
                    if (result.errors) {
                        $('.alert-in').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-in').show();
                            $('.alert-in').append('<strong><li>' + value +
                                '</li></strong>');
                        });
                    } else {
                        $('.alert-in').hide();
                        $('.success-in').show();
                        $('.success-in').append('<strong><li>' + result.success +
                            '</li></strong>');
                        toastr.success(result.success, {
                            timeOut: 5000
                        });
                        $('.priorities').append(result.priorities);
                        $('.priorities').val(result.pid).change();
                        $('#AddPName').val('');
                        //$('.form').trigger('reset');
                        $('.success-in').hide();
                        $('.alert-in').hide();
                        $('#innerModal2').modal('hide');
                    }
                }
            });
        });

        $('#SubmitCreateFormIn3').click(function(e) {
            e.preventDefault();
            $('.alert-in').html('');
            $('.alert-in').hide();
            $('.success-in').html('');
            $('.success-in').hide();



            if ($("#AddUser").val()[0] === null || $("#AddUser").val()[0] === undefined || $(
                    "#AddUser").val()[0] === "" || $("#AddUser").val()[0].length === 0) {
                toastr.error('คุณยังไม่ได้เลือกผู้รับ', {
                    timeOut: 5000
                });
            } else {

                const selectedData = $('#AddUser').select2('data');

                // Loop through the selected data and extract text and value
                selectedData.forEach(function(data) {
                    const text = data.text;
                    const value = data.id;

                    // Do something with the text and value
                    console.log(`Selected Text: ${text}, Selected Value: ${value}`);
                    uid = value;
                    html = `<option value="${value}" > ${text} </option>`;
                });

                $('.doc_receive').empty().trigger('change');
                $('.doc_receive').append(html);
                $('.doc_receive').val(uid).change();

                $("#AddDepartment").val(null).trigger("change");
                $("#AddPosition").val(null).trigger("change");
                $("#AddUser").val(null).trigger("change");

                $('#innerModal3').modal('hide');



            }
        });



        let id;
        $(document).on('click', '#getEditData', function(e) {
            e.preventDefault();


            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();

            $('#custom-tabs-one-home-tab2').tab('show');
            clearDropzonePreviews2();
            $('#upload_preview2').html('');
            $('#EditReceive').empty();
            $("#AddDepartment").val(null).trigger("change")
            $("#AddPosition").val(null).trigger("change")
            $('.positions').attr("readonly", "readonly");
            $('.users').attr("readonly", "readonly");



            id = $(this).data('id');
            $.ajax({
                url: "external-docs/edit/" + id,
                method: 'GET',
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
                    $('#file_preview').html(res.iframes);
                    //$('#EditModalBody').html(res.html);
                    $('#EditModal').modal('show');
                }
            });

        })

        $('#SubmitEditForm').click(function(e) {
            if (!confirm("ยืนยันการทำรายการ ?")) return;
            e.preventDefault();

            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();

            var values = $("input[name='imgFiles2[]']")
                .map(function() {
                    return $(this).val();
                }).get();

            $.ajax({
                url: "external-docs/save/" + id,
                method: 'PUT',
                data: {
                    img: values,
                    doc_receive_number: $('#EditNumber').val(),
                    doc_number: $('#EditDocNumber').val(),
                    priorities_id: $('#EditPriorities').val()[0],
                    signdate: $('#EditDate').val(),
                    doc_from: $('#EditDocFrom').val()[0],
                    doc_to: $('#EditDocTo').val(),
                    subject: $('#EditSubject').val(),
                    doc_receive: $('#EditReceive').val()[0],
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
                        $('#file_preview').empty();
                        //setTimeout(function() {
                        //$('.alert-success').hide();

                        //}, 10000);

                    }
                }
            });
        });

        let rid;
        let rid2;
        $(document).on('click', '#getDeleteData', function(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();
            rid = $(this).data('id');
            rid2 = $(this).data('id2');
            if (confirm("Click OK to Delete?")) {
                $.ajax({
                    url: "external-docs/delete/img/" + rid + "/" + rid2,
                    method: 'PUT',
                    // async : false,
                    success: function(res) {
                        toastr.success('ลบไฟล์เรียบร้อยแล้ว', {
                            timeOut: 5000
                        });
                        $('.imgs').html(res.imgs);
                        $('#file_preview').empty();
                        $('#file_preview').html(res.iframes);

                    }
                })
            }
        })


        $(document).on('click', '.btn-delete', function() {
            if (!confirm("ยืนยันการทำรายการ ?")) return;

            var rowid = $(this).data('rowid')
            var el = $(this)
            if (!rowid) return;


            $.ajax({
                //type: "POST",
                method: 'DELETE',
                dataType: 'JSON',
                url: "external-docs/destroy/",
                data: {
                    id: rowid,
                    //_method: 'delete',
                    _token: token
                },
                success: function(data) {
                    console.log(data);
                    if (data.success) {
                        toastr.success(data.message, {
                            timeOut: 5000
                        });
                        table.row(el.parents('tr'))
                            .remove()
                            .draw();
                    }
                }
            }); //end ajax
        })


    });
</script>
