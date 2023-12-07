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

        $.datepicker.setDefaults($.datepicker.regional["th"]);
        var currentDate = new Date();
        var currentYear = currentDate.getFullYear();
        var maxYear = currentYear + 1;

        $(".datepick2").datepicker({
            changeMonth: true,
            changeYear: true,
            /* langTh: true,
            yearTh: true, */
            yearRange: '2023' + ':' + maxYear,
            dateFormat: 'dd/mm/yy',
            /* isBE: true,
            autoConversionField: true, */
            /*  isBuddhist: true,
             defaultDate: toDay, */
            onSelect: function(date_text, inst) {
                console.log(date_text)
                let arr = date_text.split("/");
                let new_date = arr[0] + "/" + arr[1] + "/" + (parseInt(arr[2]) + 543).toString();
                $(this).val(new_date);
                $(this).css("color", "");
                console.log(new_date)
            },
            beforeShow: function(input, inst) {
                if ($(input).val() !== "") {
                    let arr = $(input).val().split("/");
                    let new_date = arr[0] + "/" + arr[1] + "/" + (parseInt(arr[2]) - 543)
                        .toString();
                    $(input).val(new_date);
                }
                $(input).css("color", "#e9ecef");
            },
            onClose: function(dateText, inst) {
                $(this).css("color", "");

                if ($(this).val() != "") {
                    let arr = dateText.split("/");
                    if (parseInt(arr[2]) < 2500) {
                        let new_date = arr[0] + "/" + arr[1] + "/" + (parseInt(arr[2]) + 543)
                            .toString();
                        $(this).val(new_date);
                    }
                }

                console.log($(this).val());
            }
        });

        setDateBetween('AddSDate','AddEDate');
        setDateBetween('EditSDate','EditEDate');


        $('.timepick').timepicker({
            timeFormat: "HH:mm:ss",
            timeText: 'เวลา',
            hourText: 'ชั่วโมง',
            minuteText: 'นาที',
            secondText: 'วินาที',
            currentText: 'เวลาปัจจุบัน',
            closeText: 'ตกลง',
        });


        //currentDate.setYear(currentDate.getFullYear() + 543);
        //$('.datepick').datetimepicker("setDate", currentDate);


        //$.noConflict();
        var token = ''
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        var table = $('#Listview').DataTable({
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
            iDisplayLength: 5,
            lengthMenu: [5, 10, 25, 50, 75, 100],
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
                    data: 'holidaydate',
                    name: 'holidaydate'
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



        $(document).on('click', '#CreateButton', function(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();
            $('#CreateModal').modal('show');
        });


        $('#SubmitCreateForm').click(function(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();

            if ($('#customCheckbox1').is(":checked")) {
                sstatus = 1;
            } else {
                sstatus = 0;
            }


            $.ajax({
                url: "{{ route('holiday.store') }}",
                method: 'post',
                data: {
                    name: $('#AddName').val(),
                    start_date: $('#AddSDate').val(),
                    end_date: $('#AddEDate').val(),
                    start_time: $('#AddSTime').val(),
                    end_time: $('#AddETime').val(),
                    holiday_sound: $('#AddGreeting').val()[0],
                    thankyou_sound: $('#AddThankyou').val()[0],
                    status: sstatus,
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
                        $("#AddGreeting").val(null).trigger("change")
                        $("#AddThankyou").val(null).trigger("change")
                        $('.form').trigger('reset');
                        $('#CreateModal').modal('hide');
                    }
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

            id = $(this).data('id');
            $.ajax({
                url: "holiday/edit/" + id,
                method: 'GET',
                success: function(res) {
                    $('#EditName').val(res.data.name);
                    $('#EditGreeting').val(res.data.holiday_sound).change();
                    $('#EditThankyou').val(res.data.thankyou_sound).change();
                    $('#EditSDate').val(res.datasdate);
                    $('#EditEDate').val(res.dataedate);
                    $('#EditSTime').val(res.datastime);
                    $('#EditETime').val(res.dataetime);
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
                url: "holiday/save/" + id,
                method: 'PUT',
                data: {
                    name: $('#EditName').val(),
                    start_date: $('#EditSDate').val(),
                    end_date: $('#EditEDate').val(),
                    start_time: $('#EditSTime').val(),
                    end_time: $('#EditETime').val(),
                    holiday_sound: $('#EditGreeting').val()[0],
                    thankyou_sound: $('#EditThankyou').val()[0],
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
                //type: "POST",
                method: 'DELETE',
                dataType: 'JSON',
                url: "holiday/destroy/",
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
