@php
    $detect = new Detection\MobileDetect();
@endphp
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
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือก'
        });

        $(".select2_single").on("select2:unselect", function(e) {
            //log("select2:unselect", e);
            //$('.positions').html('');
        });

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })



        $.datepicker.setDefaults($.datepicker.regional["th"]);
        var currentDate = new Date();
        var currentYear = currentDate.getFullYear();
        var maxYear = currentYear + 1;

        $(".datepick").datepicker({
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
            fixedHeader: true,
            @if ($detect->isMobile())
                responsive: true,
            @else
                responsive: {
                    details: {
                        type: 'column',
                        target: 'tr'
                    }
                },
                columnDefs: [{
                    className: 'control',
                    orderable: false,
                    targets: -1
                }],
            @endif
            sPaginationType: "full_numbers",
            dom: 'T<"clear">lfrtip',
            columns: [{
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'export_name',
                    name: 'export_name'
                },
                {
                    data: 'export_date',
                    name: 'export_date'
                },
                {
                    data: 'export_src',
                    name: 'export_src'
                },
                {
                    data: 'export_dst',
                    name: 'export_dst'
                },
                {
                    data: 'export_ctype',
                    name: 'export_ctype'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'export_progress',
                    name: 'export_progress'
                },
                {
                    data: 'action',
                    name: 'action'
                },
                {
                    data: 'more',
                    name: 'more'
                }
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


            $.ajax({
                url: "{{ route('voicebackup.store') }}",
                method: 'post',
                data: {
                    export_date: $('#AddSDate').val() + ' ' + $('#AddSTime').val() + ' - ' + $(
                        '#AddEDate').val() + ' ' + $('#AddETime').val(),
                    src: $('#AddSrc').val(),
                    dst: $('#AddAgent').val()[0],
                    ctype: $('#AddCtype').val()[0],
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
                        $("#AddAgent").val(null).trigger("change")
                        $("#AddCtype").val(null).trigger("change")
                        $('.form').trigger('reset');
                        $('#CreateModal').modal('hide');
                    }
                }
            });
        });

        $(document).on('click', '.btn-download', function() {
            var confirmed = confirm("ยืนยันการทำรายการ ?");
            if (!confirmed) {
                return false; // Cancel the operation if not confirmed
            }

            var rowid = $(this).data('id');
            if (!rowid) {
                return false; // Cancel the operation if rowid is missing
            }

            var url = '{{ url('zip') }}/' + rowid;
            console.log(url);
            window.open(url, '_blank');
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
                url: "voicebackup/destroy/",
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
