<script>
    $(document).ready(function() {
        $.fn.bootstrapSwitch.defaults.size = 'small';
        $.fn.bootstrapSwitch.defaults.onColor = 'success';

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
            placeholder: 'กรุณาเลือก'
        });

        $(".select2_single").on("select2:unselect", function(e) {
            //log("select2:unselect", e);
            //$('.products').html('');
        });

        $(".select2_singles").select2({
            maximumSelectionLength: 1,
            allowClear: false,
            placeholder: 'กรุณาเลือก'
        });


        $(".select2_multiple").select2({
            maximumSelectionLength: 50,
            allowClear: false,
            placeholder: 'กรุณาเลือก'
        });

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

        $.datepicker.setDefaults($.datepicker.regional["th"]);
        var currentDate = new Date();
        var currentYear = currentDate.getFullYear();
        var maxYear = currentYear + 1;

        $(".datepick").datetimepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: currentYear + ':' + maxYear,
            dateFormat: 'dd/mm/yy',
            dayNamesMin: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"],
            monthNamesShort: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
                "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
            ],
            beforeShow: function() {
                if ($(this).val() != "") {
                    var arrayDateT = $(this).val().split(" ");
                    var arrayDate = arrayDateT[0].split("/");
                    arrayDate[2] = parseInt(arrayDate[2]) - 543;
                    $(this).val(arrayDate[0] + "/" + arrayDate[1] + "/" + arrayDate[2] + " " +
                        arrayDateT[1]);
                    dateBefore = $(this).val();
                }
                setTimeout(function() {
                    $.each($(".ui-datepicker-year option"), function(j, k) {
                        var textYear = parseInt($(".ui-datepicker-year option").eq(
                            j).val()) + 543;
                        $(".ui-datepicker-year option").eq(j).text(textYear);
                    });
                }, 50);

            },
            onChangeMonthYear: function() {
                setTimeout(function() {
                    $.each($(".ui-datepicker-year option"), function(j, k) {
                        var textYear = parseInt($(".ui-datepicker-year option").eq(
                            j).val()) + 543;
                        $(".ui-datepicker-year option").eq(j).text(textYear);
                    });
                }, 50);
            },
            onClose: function(dateText, inst) {
                if ($(this).val() != "" && dateText == dateBefore) {
                    var arrayDateT = $(this).val().split(" ");
                    var arrayDate = arrayDateT[0].split("/");
                    //$('#temp'+$(this).attr('id')).html(dateBefore);
                    arrayDate[2] = parseInt(arrayDate[2]) + 543;
                    $(this).val(arrayDate[0] + "/" + arrayDate[1] + "/" + arrayDate[2] + " " +
                        arrayDateT[1]);
                    console.log($(this).val())
                }
            },
            onSelect: function(dateText, inst) {
                dateBefore = $(this).val();
                //$('#temp'+$(this).attr('id')).html(dateBefore);
                var arrayDateT = $(this).val().split(" ");
                var arrayDate = arrayDateT[0].split("/");
                arrayDate[2] = parseInt(arrayDate[2]) + 543;
                $(this).val(arrayDate[0] + "/" + arrayDate[1] + "/" + arrayDate[2] + 543 + " " +
                    arrayDateT[1]);
                console.log($(this).val())

                /* var selectedDate = new Date(dateText);
                var currentDate = new Date();
                var years = currentDate.getFullYear() - selectedDate.getFullYear();
                var months = currentDate.getMonth() - selectedDate.getMonth();
                var days = currentDate.getDate() - selectedDate.getDate();
                if (days < 0) {
                    months--;
                    days += new Date(currentDate.getFullYear(), currentDate.getMonth(), 0)
                        .getDate();
                }

                if (months < 0) {
                    years--;
                    months += 12;
                } */
            }
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
                    data: 'group_name',
                    name: 'group_name'
                },
                {
                    data: 'notifydate',
                    name: 'notifydatee'
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

            if ($('#sat').is(":checked")) {
                sat = 1;
            } else {
                sat = 0;
            }

            if ($('#sun').is(":checked")) {
                sun = 1;
            } else {
                sun = 0;
            }

            if ($('#misscall').is(":checked")) {
                misscall = 1;
            } else {
                misscall = 0;
            }


            $.ajax({
                url: "{{ route('notify.store') }}",
                method: 'post',
                data: {
                    group_name: $('#AddName').val(),
                    group_start: $('#AddSDate').val(),
                    group_end: $('#AddEDate').val(),
                    group_extension: $('#AddExtension').val(),
                    line_token: $('#AddLine').val(),
                    email: $('#AddEmail').val(),
                    sat: sat,
                    sun: sun,
                    misscall: misscall,
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
                        $("#AddExtension").val(null).trigger("change")
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

            $("#EditExtension").empty();
            $("#EditExtension").val(null).trigger("change")

            id = $(this).data('id');
            $.ajax({
                url: "notify/edit/" + id,
                method: 'GET',
                success: function(res) {

                    $('#EditName').val(res.data.group_name);
                    $('#EditExtension').append(res.select_list_exten);
                    $('#EditLine').val(res.data.line_token);
                    $('#EditEmail').val(res.data.email);
                    $('#EditSDate').val(res.data.group_start_th);
                    $('#EditEDate').val(res.data.group_end_th);

                    if (res.data.status == 1) {
                        $('#ecustomCheckbox1').prop('checked', true);
                    } else {
                        $('#ecustomCheckbox1').prop('checked', false);
                    }
                    if (res.data.group_sat == 1) {
                        $('#esat').prop('checked', true);
                    } else {
                        $('#esat').prop('checked', false);
                    }
                    if (res.data.group_sun == 1) {
                        $('#esun').prop('checked', true);
                    } else {
                        $('#esun').prop('checked', false);
                    }
                    if (res.data.misscall == 1) {
                        $('#emisscall').prop('checked', true);
                    } else {
                        $('#emisscall').prop('checked', false);
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

            if ($('#esat').is(":checked")) {
                sat = 1;
            } else {
                sat = 0;
            }

            if ($('#esun').is(":checked")) {
                sun = 1;
            } else {
                sun = 0;
            }

            if ($('#emisscall').is(":checked")) {
                misscall = 1;
            } else {
                misscall = 0;
            }

            $.ajax({
                url: "notify/save/" + id,
                method: 'PUT',
                data: {
                    group_name: $('#EditName').val(),
                    group_start: $('#EditSDate').val(),
                    group_end: $('#EditEDate').val(),
                    group_extension: $('#EditExtension').val(),
                    line_token: $('#EditLine').val(),
                    email: $('#EditEmail').val(),
                    sat: sat,
                    sun: sun,
                    misscall: misscall,
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
                url: "notify/destroy/",
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
