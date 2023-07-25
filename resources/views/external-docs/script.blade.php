<script>
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
        $("#AddDate").datetimepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '+443:+543',
            dateFormat: 'dd/mm/yy',
            onSelect: function(date) {
                $("#edit-date-of-birth").addClass('filled');
            }
        });
        $('#AddDate').datetimepicker("setDate", currentDate);



        $(".select2_single").select2({
            maximumSelectionLength: 1,
            allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือก'
        });

        $(".select2_single").on("select2:unselect", function(e) {
            //log("select2:unselect", e);
            //$('.products').html('');
        });

        $(".select2_singles").select2({
            maximumSelectionLength: 1,
            allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือก'
        });


        $(".select2_multiple").select2({
            maximumSelectionLength: 2,
            //placeholder: "With Max Selection limit 4",
            allowClear: true,
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
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'dname',
                    name: 'dname'
                },
                {
                    data: 'dname',
                    name: 'dname'
                },
                {
                    data: 'status',
                    name: 'status'
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

            $("#AddDocFrom").val(null).trigger("change");
            $("#AddPriorities").val(null).trigger("change");
            $('#AddReceive').empty().trigger('change');

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


        $(document).on('click', '#inner1', function(e) {
            e.preventDefault();
            $('.alert-in').html('');
            $('.alert-in').hide();
            $('.success-in').html('');
            $('.success-in').hide();
        });

        $(document).on('click', '#inner2', function(e) {
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



            $.ajax({
                url: "{{ route('external-docs.store') }}",
                method: 'post',
                data: {
                    doc_receive_number: $('#AddNumber').val(),
                    doc_number: $('#AddDocNumber').val(),
                    priorities_id: $('#AddPriorities').val(),
                    signdate: $('#AddDate').val(),
                    doc_from: $('#AddDocFrom').val(),
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
                        $('#AddDocFrom').append(result.contact);
                        $('#AddDocFrom').val(result.cid).change();
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
                        $('#AddPriorities').append(result.priorities);
                        $('#AddPriorities').val(result.pid).change();
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

                $('#AddReceive').empty().trigger('change');
                $('#AddReceive').append(html);
                $('#AddReceive').val(uid).change();

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

            id = $(this).data('id');
            $.ajax({
                url: "positions/edit/" + id,
                method: 'GET',
                success: function(res) {
                    $('#EditName').val(res.data.name);
                    $('#EditDepartment').val(res.data.department_id).change();
                    if (res.data.status == 1) {
                        $('#ecustomCheckbox1').prop('checked', true);
                    } else {
                        $('#ecustomCheckbox1').prop('checked', false);
                    }

                    $('#EditModalBody').html(res.html);
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


            if ($('#ecustomCheckbox1').is(":checked")) {
                esstatus = 1;
            } else {
                esstatus = 0;
            }

            $.ajax({
                url: "positions/save/" + id,
                method: 'PUT',
                data: {
                    name: $('#EditName').val(),
                    department: $('#EditDepartment').val()[0],
                    status: esstatus,
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
                        //setTimeout(function() {
                        //$('.alert-success').hide();

                        //}, 10000);

                    }
                }
            });
        });

        $(document).on('click', '.btn-delete', function() {
            if (!confirm("ยืนยันการทำรายการ ?")) return;

            var rowid = $(this).data('rowid')
            var el = $(this)
            if (!rowid) return;


            $.ajax({
                type: "POST",
                dataType: 'JSON',
                url: "positions/destroy/",
                data: {
                    id: rowid,
                    _method: 'delete',
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
