@php
    $detect = new Detection\MobileDetect();
@endphp
<script>
    $(document).ready(function() {

        $(".delete_all_button").click(function() {
            var len = $('input[name="table_records[]"]:checked').length;
            if (len > 0) {
                ezBSAlert({
                    type: "confirm",
                    headerText: "Confirm",
                    messageText: "ยืนยันการลบข้อมูล??",
                    alertType: "info",
                }).done(function(r) {
                    if (r == true) {
                        $('form#delete_all').submit();
                    }
                });
            } else {
                const prom = ezBSAlert({
                    headerText: "Alert",
                    messageText: "กรุณาเลือกรายการที่จะลบ",
                    alertType: "danger",
                });
            }

        });

        $('#check-all').click(function() {
            $(':checkbox.flat').prop('checked', this.checked);
        });


        $(".select2_single").select2({
            maximumSelectionLength: 1,
            //allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือก'
        });

        $(".select2_single").on("select2:unselect", function(e) {
            //log("select2:unselect", e);
            //$('.products').html('');
        });

        //$.noConflict();
        var token = ''
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var startDate;
        var endDate;

        function datesearch() {
            var currentDate = moment();
            // Set the start date to 7 days before today
            startDate = moment(currentDate).subtract(30, 'days').format('YYYY-MM-DD');
            // Set the end date to the end of the current month
            //endDate = moment(currentDate).endOf('month').format('YYYY-MM-DD');
            //startDate = moment().format('YYYY-MM-DD');
            endDate = moment(currentDate).endOf('month').format('YYYY-MM-DD');
        }

        function storeFieldValues() {
            var dateStart = $('#reservation').val();
            var searchtext = $('#seachtext').val();
            var searchtype = $('#seachtype').val();

            localStorage.setItem('dateStart', dateStart);
            localStorage.setItem('keyword', searchtext);
            localStorage.setItem('searchType', searchtype);

        }

        function datereset() {
            localStorage.removeItem('dateStart');
            localStorage.removeItem('searchType');
            localStorage.removeItem('keyword');

            $('#seachtext').val('');
            $('#seachtype').val('0');

            var currentDate = moment();
            //startDate = moment().format('YYYY-MM-DD');
            startDate = moment(currentDate).subtract(30, 'days').format('YYYY-MM-DD');
            endDate = moment(currentDate).endOf('month').format('YYYY-MM-DD');
            daterange();

        }

        function retrieveFieldValues() {
            var saveddateStart = localStorage.getItem('dateStart');
            var savedSearchType = localStorage.getItem('searchType');
            var savedKeyword = localStorage.getItem('keyword');

            // Set field values from local storage
            if (saveddateStart) {
                var dateParts = saveddateStart.split(' - ');
                startDate = dateParts[0];
                endDate = dateParts[1];
            } else {
                datesearch();
            }

            $('#reservation').val(`${startDate} - ${endDate}`)

            if (savedKeyword) {
                $('#seachtext').val(savedKeyword);
            }

            if (savedSearchType) {
                $('#seachtype').val(savedSearchType);
            }

        }

        let daterange = () => {
            var todayRange = [moment().startOf('day'), moment().endOf('day')];
            var yesterdayRange = [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days')
                .endOf('day')
            ];
            var last7DaysRange = [moment().subtract(6, 'days').startOf('day'), moment().endOf('day')];
            var last30DaysRange = [moment().subtract(29, 'days').startOf('day'), moment().endOf('day')];
            var currentYear = moment().year();
            var maxYear = moment().year(currentYear).add(1, 'year').format('YYYY-MM-DD');
            var minYear = moment().year(currentYear).subtract(2, 'years').format('YYYY-MM-DD');

            $('#reservation').daterangepicker({
                startDate: startDate,
                endDate: endDate,
                showDropdowns: true,
                linkedCalendars: false,
                minDate: minYear,
                maxDate: maxYear,
                ranges: {
                    'วันนี้': todayRange,
                    'เมื่อวานนี้': yesterdayRange,
                    'ย้อนหลัง 7 วัน': last7DaysRange,
                    'ย้อนหลัง 30 วัน': last30DaysRange,
                    'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
                    'เดือนที่แล้ว': [moment().subtract(1, 'month').startOf('month'), moment()
                        .subtract(1, 'month').endOf('month')
                    ]
                },
                locale: {
                    format: 'YYYY-MM-DD',
                    applyLabel: 'ตกลง',
                    cancelLabel: 'ยกเลิก',
                    fromLabel: 'จาก',
                    toLabel: 'ถึง',
                    customRangeLabel: 'เลือกวันที่เอง',
                    daysOfWeek: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
                    monthNames: [
                        'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน',
                        'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
                    ],
                    firstDay: 1
                }

            });

            // Apply the custom date range filter on input change
            $('#reservation').on('apply.daterangepicker', function() {
                table.draw();
                storeFieldValues();
            });
        }

        retrieveFieldValues();
        daterange();


        $.datepicker.setDefaults($.datepicker.regional['th']);
        var currentDate = new Date();
        var currentYear = currentDate.getFullYear();
        var maxYear = currentYear + 1;


        $(".AddDate").datepicker({
            dateFormat: "yy-mm-dd",
            //defaultDate: '2023-11-14',
            //isBuddhist: true,
            changeMonth: true,
            changeYear: true,
            //yearRange:'1940:2057',
            //yearRange: 'c-40:c+10',
            yearRange: '2023' + ':' + maxYear,
            dayNamesMin: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"],
            monthNamesShort: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
                "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
            ],
            /* beforeShow: function() {
                if ($(this).val() != "") {
                    var arrayDate = $(this).val().split("-");
                    arrayDate[0] = parseInt(arrayDate[0]) - 543;
                    $(this).val(arrayDate[0] + "-" + arrayDate[1] + "-" + arrayDate[2]);
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
            onClose: function() {
                if ($(this).val() != "" && $(this).val() == dateBefore) {
                    var arrayDate = dateBefore.split("-");
                    //$('#temp'+$(this).attr('id')).html(dateBefore);
                    arrayDate[0] = parseInt(arrayDate[0]) + 543;
                    $(this).val(arrayDate[0] + "-" + arrayDate[1] + "-" + arrayDate[2]);
                }
            },
            onSelect: function(dateText, inst) {
                dateBefore = $(this).val();
                //$('#temp'+$(this).attr('id')).html(dateBefore);
                var arrayDate = dateText.split("-");
                arrayDate[0] = parseInt(arrayDate[0]) + 543;
                $(this).val(arrayDate[0] + "-" + arrayDate[1] + "-" + arrayDate[2]);
            } */
        });
        //$(".AddDate").datepicker({
        /*  onSelect: function() {
             table.draw();
         }, */
        //    dateFormat: 'yy-mm-dd',
        //    changeMonth: true,
        //    changeYear: true,
        //    yearRange: '1980:2050',
        //});
        var table = $('#Listview').DataTable({
            ajax: {
                data: function(d) {
                    d.seachtype = $("#seachtype").val();
                    d.seachtext = $("#seachtext").val();
                    d.sdate = $('#reservation').val();
                }
            },
            serverSide: true,
            processing: true,
            "searching": false,
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
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'hn',
                    name: 'hn'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'phoneno',
                    name: 'phoneno'
                },
                {
                    data: 'casename',
                    name: 'casename'
                },
                {
                    data: 'casestatus',
                    name: 'casestatus'
                },
                {
                    data: 'tranferstatus',
                    name: 'tranferstatus'
                },
                {
                    data: 'agent',
                    name: 'agent'
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
        $("#seachtext").attr('disabled', true);
        $('#btnsearch').click(function(e) {
            var fieldValue = $("#seachtype").val();
            var textValue = $("#seachtext").val();
            if (fieldValue === '3' || fieldValue === '4' || fieldValue === '5') {
                if (textValue === '') {
                    document.getElementById('validationMessages').textContent =
                        'กรุณาระบุคำที่จะค้นหา';
                    return false;
                } else {
                    if (textValue.length < 4) {
                    document.getElementById('validationMessages').textContent =
                        'กรุณาระบุคำที่จะค้นหาอย่างน้อย 4 ตัวอักษร';
                        return false;
                    } else {
                        document.getElementById('validationMessages').textContent = '';
                    }
                }
            } else {
                document.getElementById('validationMessages').textContent = '';
            }
            storeFieldValues();
            table.search('').draw();
            $.fn.dataTable.ext.search.pop();
            //$('#Listview').DataTable().ajax.reload();
        });

        $('#seachtype').change(function(e) {
            var fieldValue = $("#seachtype").val();
            if (fieldValue === '0' || fieldValue === '1' || fieldValue === '2') {
                $("#seachtext").val('');
                $("#seachtext").attr('disabled', true);
            } else {
                $("#seachtext").prop('disabled', false);
            }
            storeFieldValues();
            //table.search('').draw();
            //$.fn.dataTable.ext.search.pop();
            //$('#Listview').DataTable().ajax.reload();
        });

        $('#btnreset').click(function(e) {
            $("#seachtype").val(0);
            $("#seachtext").val('');
            datereset();
            daterange();
            document.getElementById('validationMessages').textContent = '';
            $('#Listview').DataTable().ajax.reload();
        });




        /* $(document).on('change', '#Hn', function() {
            var query = $(this).val();
            $.ajax({
                url: 'cases/seachcontact/' + query,
                method: 'GET',
                async: false,
                success: function(data) {
                    console.log(data);
                    var suggestionsList = $('#suggestions');
                    suggestionsList.empty();
                    $.each(data, function(index, item) {
                        suggestionsList.append('<li data-id="' + item
                            .id + '" data-hn="' + item.hn +
                            '" data-name="' + item.fname + ' ' +
                            item.fname + '">HN ' + item.hn +
                            ' ชื่อ-สกุล ' + item.fname + ' ' + item
                            .fname + '</li>');
                    });

                    suggestionsList.on('click', 'li', function() {
                        $('#Addid').val($(this).data('id'));
                        $('#Hn').val($(this).data('hn'));
                        $('#Name').val($(this).data('name'));
                        suggestionsList.empty();
                    }); 
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        });
 */
        $(document).on('click', '#CreateButton', function(e) {
            e.preventDefault();
            $('#custom-tabs-one-home-tab').tab('show');
            $("#Hn").val(null).trigger("change")
            $("#Hn").removeAttr('readonly');
            $('#casetype1').html('')
            $('#casetype1').val(null).trigger("change")
            $('#topiccase').html('<i class="fa-solid fa-clipboard-list"></i> เพิ่มเรื่องที่ติดต่อ');
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();
            $('.form').trigger('reset');
            $('#custom-tabs-one-comment-tab').attr('disabled', true);
            $('#custom-tabs-one-comment-tab').hide();
            $('#custom-tabs-one-commentlog-tab').attr('disabled', true);
            $('#custom-tabs-one-commentlog-tab').hide();
            $('#custom-tabs-one-editlog-tab').attr('disabled', true);
            $('#custom-tabs-one-editlog-tab').hide();
            $('#CommentButton').addClass('d-none');
            actions = 'add';
            //_token: token

            $.ajax({
                url: "casetype6/casetype/0",
                method: 'GET',
                async: false,
                success: function(res) {
                    var provinceOb = $('#casetype1');
                    /* provinceOb.html('<option value="">เลือกประเภทการติดต่อ</option>'); */
                    $.each(res.data, function(index, item) {
                        provinceOb.append(
                            $('<option></option>').val(item.id).html(item
                                .name)
                        );
                    });
                }
            });
            /* $('#casetype2').html('<option value="">เลือกรายละเอียดเคส</option>');
            $('#casetype3').html('<option value="">เลือกรายละเอียดเคสย่อย</option>');
            $('#casetype4').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>');
            $('#casetype5').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
            $('#casetype6').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>'); */
            if($('#Addadddate').is(':disabled')){
                $("#Addadddate").removeAttr("disabled"); 
            }
            if($('#casetype1').prop('readonly')){
                $("#casetype1").removeAttr("readonly"); 
            }
            if($('#tranferstatus').is(':disabled')){
                $("#tranferstatus").removeAttr("disabled"); 
            }

            $('#casetype2').val(null).trigger("change")
            $('#casetype3').val(null).trigger("change")
            $('#casetype4').val(null).trigger("change")
            $('#casetype5').val(null).trigger("change")
            $('#casetype6').val(null).trigger("change")
            $('#tranferstatus').val(null).trigger("change")
            $('#casestatus').val(null).trigger("change")
            $('#casetype2').attr('disabled', true);
            $('#casetype3').attr('disabled', true);
            $('#casetype4').attr('disabled', true);
            $('#casetype5').attr('disabled', true);
            $('#casetype6').attr('disabled', true);
            $('#CreateModal').modal('show');
        });


        $('#SubmitCreateForm').click(function(e) {
            if (actions == 'edit') {
                //if (!confirm("ยืนยันการทำรายการ ?")) return;
            }

            e.preventDefault();
            ezBSAlert({
                type: "confirm",
                headerText: "Confirm",
                messageText: "ยืนยันการบันทึกข้อมูล?",
                alertType: "info",
            }).done(function(r) {
                if (r == true) {
                    $('.alert-danger').html('');
                    $('.alert-danger').hide();
                    $('.alert-success').html('');
                    $('.alert-success').hide();

                    //console.log($('#Hn').val()[0]);

                    var arrayDate = $('#Addadddate').val().split("-");
                    //arrayDate[0] = parseInt(arrayDate[0]) - 543;
                    var tempadddate = arrayDate[0] + "-" + arrayDate[1] + "-" + arrayDate[2];

                    var additionalData = {
                        contact_id: $('#Hn').val()[0],
                        adddate: tempadddate,
                        //adddate: $('#Addadddate').val(),
                        //adddate: $('#tempAddadddate').html(),
                        casetype1: $('#casetype1 option:selected').text(),
                        caseid1: $('#casetype1').val()[0],
                        casedetail: $('#Detail').val(),
                        tranferstatus: $('#tranferstatus option:selected').text(),
                        casestatus: $('#casestatus option:selected').text(),
                        _token: token
                    };
                    if ($('#casetype2').val() !== '') {
                        additionalData.casetype2 = $('#casetype2 option:selected').text();
                        additionalData.caseid2 = $('#casetype2').val()[0];
                    }
                    if ($('#casetype3').val() !== '') {
                        additionalData.casetype3 = $('#casetype3 option:selected').text();
                        additionalData.caseid3 = $('#casetype3').val()[0];
                    }
                    if ($('#casetype4').val() !== '') {
                        additionalData.casetype4 = $('#casetype4 option:selected').text();
                        additionalData.caseid4 = $('#casetype4').val()[0];
                    }
                    if ($('#casetype5').val() !== '') {
                        additionalData.casetype5 = $('#casetype5 option:selected').text();
                        additionalData.caseid5 = $('#casetype5').val()[0];
                    }
                    if ($('#casetype6').val() !== '') {
                        additionalData.casetype6 = $('#casetype6 option:selected').text();
                        additionalData.caseid6 = $('#casetype6').val()[0];
                    }

                    if (actions == 'add') {
                        urls = "{{ route('cases.store') }}";
                        methods = 'post';
                    } else if (actions == 'edit') {
                        urls = "cases/save/" + id;
                        methods = 'PUT';
                    }
                    $.ajax({
                        url: urls,
                        method: methods,
                        data: additionalData,
                        success: function(result) {
                            if (result.errors) {
                                $('.alert-danger').html('');
                                $.each(result.errors, function(key, value) {
                                    $('.alert-danger').show();
                                    $('.alert-danger').append(
                                        '<strong><li>' + value +
                                        '</li></strong>');
                                });
                                //$('#CreateModal').scrollTop(0);
                                $('.alert-danger').focus();
                            } else {
                                $('.alert-danger').hide();
                                $('.alert-success').show();
                                $('.alert-success').append('<strong><li>' + result
                                    .success +
                                    '</li></strong>');
                                toastr.success(result.success, {
                                    timeOut: 5000
                                });
                                $('#Listview').DataTable().ajax.reload();
                                $("#Hn").val(null).trigger("change")
                                $('.form').trigger('reset');
                                $('#CreateModal').modal('hide');
                            }
                        }
                    });
                }
            });

        });


        let id;
        let actions;
        $(document).on('click', '#getEditData', function(e) {
            e.preventDefault();
            $('#topiccase').html('<i class="fa-solid fa-clipboard-list"></i> แก้ไขเรื่องที่ติดต่อ');
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();
            $('.form').trigger('reset');
            $('#custom-tabs-one-home-tab').tab('show');
            $('#custom-tabs-one-comment-tab').attr('disabled', false);
            $('#custom-tabs-one-comment-tab').show();
            $('#custom-tabs-one-commentlog-tab').attr('disabled', false);
            $('#custom-tabs-one-commentlog-tab').show();
            $('#custom-tabs-one-editlog-tab').attr('disabled', false);
            $('#custom-tabs-one-editlog-tab').show();
            $('#CommentButton').removeClass('d-none')

            actions = 'edit';
            id = $(this).data('id');
            $.ajax({
                url: "casetype6/casetype/0",
                method: 'GET',
                async: false,
                success: function(res) {
                    $('#casetype1').html('');
                    var provinceOb = $('#casetype1');
                    //provinceOb.html('<option value="">เลือกประเภทการติดต่อ</option>');
                    $.each(res.data, function(index, item) {
                        provinceOb.append(
                            $('<option></option>').val(item.id).html(item
                                .name)
                        );
                    });
                }
            });
            /* $('#casetype2').html('<option value="">เลือกรายละเอียดเคส</option>');
            $('#casetype3').html('<option value="">เลือกรายละเอียดเคสย่อย</option>');
            $('#casetype4').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>');
            $('#casetype5').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
            $('#casetype6').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>'); */
            $('#casetype2').attr('disabled', true);
            $('#casetype3').attr('disabled', true);
            $('#casetype4').attr('disabled', true);
            $('#casetype5').attr('disabled', true);
            $('#casetype6').attr('disabled', true);
            $.ajax({
                url: "cases/edit/" + id,
                method: 'GET',
                async: false,
                success: function(res) {
                    console.log(res);
                    $('#Hn').val(res.data.contact_id).change();
                    $('#Hn').attr("readonly", "readonly");
                    //$('#Name').val(res.data.name);
                    //date+543
                    var arrayDate = res.data.adddate.split("-");
                    //arrayDate[0] = parseInt(arrayDate[0]) + 543;
                    $('#Addadddate').val(arrayDate[0] + "-" + arrayDate[1] + "-" +
                        arrayDate[2]);
                    //$('#Addadddate').attr("readonly", "readonly");
                    $('#Addadddate').attr("disabled", "disabled");
                    //$('#Addadddate').removeClass("AddDate");
                    //$('#tempAddadddate').html(res.data.adddate);
                    $('#Detail').val(res.data.casedetail);
                    $('#tranferstatus').val(res.data.tranferstatus).change();
                    $('#tranferstatus').attr("disabled", "disabled");
                    $('#casestatus').val(res.data.casestatus).change();
                    $('#casetype1').val(res.data.caseid1).change();
                    $('#casetype1').attr("readonly", "readonly");
                    if (res.data.caseid2 != 0) {
                        $('#casetype2').val(res.data.caseid2).change();
                        $('#casetype2').attr("readonly", "readonly");
                    }
                    if (res.data.caseid3 != 0) {
                        $('#casetype3').val(res.data.caseid3).change();
                        $('#casetype3').attr("readonly", "readonly");
                    }
                    if (res.data.caseid4 != 0) {
                        $('#casetype4').val(res.data.caseid4).change();
                        $('#casetype4').attr("readonly", "readonly");
                    }
                    if (res.data.caseid5 != 0) {
                        $('#casetype5').val(res.data.caseid5).change();
                        $('#casetype5').attr("readonly", "readonly");
                    }
                    if (res.data.caseid6 != 0) {
                        $('#casetype6').val(res.data.caseid6).change();
                        $('#casetype6').attr("readonly", "readonly");
                    }

                    if (res.data.caseid2 == 0) {
                        $('#casetype2').attr("readonly", "readonly");
                    }
                    if (res.data.caseid3 == 0) {
                        $('#casetype3').attr("readonly", "readonly");
                    }
                    if (res.data.caseid4 == 0) {
                        $('#casetype4').attr("readonly", "readonly");
                    }
                    if (res.data.caseid5 == 0) {
                        $('#casetype5').attr("readonly", "readonly");
                    }
                    if (res.data.caseid6 == 0) {
                        $('#casetype6').attr("readonly", "readonly");
                    }
                    //Comment Data
                    $('#cHn').text(res.data.hn);
                    $('#cName').text(res.data.name);
                    $('#cCasetype1').text(res.data.casetype1);
                    $('#cCasetype2').text(res.data.casetype2);
                    $('#cCasetype3').text(res.data.casetype3);
                    $('#cCasetype4').text(res.data.casetype4);
                    $('#cCasetype5').text(res.data.casetype5);
                    $('#cCasetype6').text(res.data.casetype6);
                    $('#cDetail').text(res.data.casedetail);
                    $('#cTranferstatus').text(res.data.tranferstatus);
                    $('#cCasestatus').text(res.data.casestatus);
                }
            });

            $('#CreateModal').modal('show');
        });

        $('#SubmitCommentForm').click(function(e) {
            if (!confirm("ยืนยันการทำรายการ ?")) return;
            e.preventDefault();

            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();

            var additionalData = {
                case_id: id,
                comment: $('#cComment').val()
            };
            $.ajax({
                url: "cases/casecomment/" + id,
                method: 'PUT',
                data: additionalData,

                success: function(result) {
                    //console.log(result);
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
                        $('#CreateModal').modal('hide');
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

        $('#SubmitEditForm').click(function(e) {
            //if (!confirm("ยืนยันการทำรายการ ?")) return;
            e.preventDefault();
            ezBSAlert({
                type: "confirm",
                headerText: "Confirm",
                messageText: "ยืนยันการบันทึกข้อมูล?",
                alertType: "info",
            }).done(function(r) {
                if (r == true) {
                    $('.alert-danger').html('');
                    $('.alert-danger').hide();
                    $('.alert-success').html('');
                    $('.alert-success').hide();

                    var additionalData = {
                        adddate: $('#Addadddate').val(),
                        casetype1: $('#Editcasetype1e').val()[0],
                        tranferstatus: $('#Edittranferstatuse option:selected').text(),
                        casedetail: $('#Editdetail').val(),
                        casestatus: $('#Editcasestatuse option:selected').text(),
                    };
                    $.ajax({
                        url: "cases/save/" + id,
                        method: 'PUT',
                        data: additionalData,

                        success: function(result) {
                            //console.log(result);
                            if (result.errors) {
                                $('.alert-danger').html('');
                                $.each(result.errors, function(key, value) {
                                    $('.alert-danger').show();
                                    $('.alert-danger').append(
                                        '<strong><li>' + value +
                                        '</li></strong>');
                                });
                            } else {
                                $('.alert-danger').hide();
                                $('.alert-success').show();
                                $('.alert-success').append('<strong><li>' + result
                                    .success +
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
                }
            });

        });

        $('#CommentButton').click(function(e) {
            e.preventDefault();

            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();

            ezBSAlert({
                type: "prompt",
                okButtonText: "บันทึกข้อมูล",
                messageText: "กรุณาระบุ ความคิดเห็น",
                alertType: "primary"
            }).done(function(e) {
                if (e !== '') {
                    const content = e;
                    var additionalData = {
                        case_id: id,
                        comment: content
                    };
                    $.ajax({
                        url: "cases/casecomment/" + id,
                        method: 'PUT',
                        data: additionalData,

                        success: function(result) {
                            //console.log(result);
                            if (result.errors) {
                                $('.alert-danger').html('');
                                $.each(result.errors, function(key, value) {
                                    $('.alert-danger').show();
                                    $('.alert-danger').append(
                                        '<strong><li>' + value +
                                        '</li></strong>');
                                });
                            } else {
                                $('.alert-danger').hide();
                                /*$('.alert-success').show();
                                  $('.alert-success').append('<strong><li>' + result
                                     .success +
                                     '</li></strong>'); */
                                //$('#CreateModal').modal('hide');
                                toastr.success(result.success, {
                                    timeOut: 5000
                                });
                                $.ajax({
                                    url: '{{ route('cases.commentlist') }}',
                                    type: 'POST',
                                    data: {
                                        id: id
                                    },

                                    success: function(response) {
                                        $('#listlog').html(response
                                            .html);
                                    }
                                });

                            }
                        }
                    });
                } else {
                    /* toastr.error('กรุณาระบุความคิดเห็น', {
                        timeOut: 5000
                    }); */
                    const prom = ezBSAlert({
                        headerText: "Alert",
                        messageText: "กรุณาระบุความคิดเห็น",
                        alertType: "danger",
                    });
                }
            });

        });



        $(document).on('click', '.btn-delete', function() {
            //if (!confirm("ยืนยันการทำรายการ ?")) return;
            var rowid = $(this).data('rowid');
            var el = $(this);
            ezBSAlert({
                type: "confirm",
                headerText: "Confirm",
                messageText: "ยืนยันการลบข้อมูล?",
                alertType: "info",
            }).done(function(r) {
                if (r == true) {
                    if (!rowid) return;
                    $.ajax({
                        type: "DELETE",
                        dataType: 'JSON',
                        url: "cases/destroy/",
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
                    });
                }
            });

        });
        //Click Tab
        $(document).on('click', '.tablistcommentlog', function() {
            //var id = $(this).data("contactid");
            $.ajax({
                url: '{{ route('cases.commentlist') }}',
                type: 'POST',
                data: {
                    id: id
                },

                success: function(response) {
                    $('#listlog').html(response.html);
                }
            });
        });
        //listcomment
        $(document).on('click', '.listcomment-button', function() {
            var case_id = $(this).data('case_id');
            $.ajax({
                url: '{{ route('cases.commentlist') }}',
                type: 'POST',
                data: {
                    id: case_id
                },

                success: function(response) {
                    $('#listlog').html(response.html);
                }
            });
        });

        //loadcasescomment
        $(document).on('click', '.selectcomment-button', function() {
            var comment_id = $(this).data('comment_id');
            $.ajax({
                url: '{{ route('cases.commentview') }}',
                type: 'POST',
                async: false,
                data: {
                    commentid: comment_id
                },
                success: function(response) {
                    $('#listlog').html(response.html);
                }
            });
        });
        //Update Edit Log 
        //Click Tab Log
        $(document).on('click', '.tablisteditlog', function() {
            //var id = $(this).data("contactid");
            $.ajax({
                url: '{{ route('cases.caseslistlog') }}',
                type: 'POST',
                data: {
                    id: id
                },

                success: function(response) {
                    $('#editlog').html(response.html);
                }
            });
        });
        //listlog
        $(document).on('click', '.listeditlog-button', function() {
            var case_id = $(this).data('case_id');
            $.ajax({
                url: '{{ route('cases.caseslistlog') }}',
                type: 'POST',
                data: {
                    id: case_id
                },

                success: function(response) {
                    $('#editlog').html(response.html);
                }
            });
        });

        //loadcaseslog
        $(document).on('click', '.selectlog-button', function() {
            var log_id = $(this).data('log_id');
            $.ajax({
                url: '{{ route('cases.casesviewlog') }}',
                type: 'POST',
                async: false,
                data: {
                    id: log_id
                },
                success: function(response) {
                    $('#editlog').html(response.html);
                }
            });
        });


        $('#casetype1').on('change', function() {
            var parent_id = $(this).val();
            /* $('#casetype2').html('<option value="">เลือกรายละเอียดเคส</option>');
            $('#casetype3').html('<option value="">เลือกรายละเอียดเคสย่อย</option>');
            $('#casetype4').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>');
            $('#casetype5').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
            $('#casetype6').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>'); */
            if (parent_id != '') {
                $.ajax({
                    url: "casetype6/casetype/" + parent_id,
                    method: 'GET',
                    async: false,
                    success: function(res) {
                        $('#casetype2').html('');
                        $.each(res.data, function(index, item) {
                            $('#casetype2').append(
                                $('<option></option>').val(item.id).html(item
                                    .name)
                            );
                        });
                        if(res.data.length === 0){
                            $('#casetype2').attr('disabled', true);
                        }else{
                            $('#casetype2').attr('disabled', false);
                        }
                    }
                });
                
                $('#casetype3').attr('disabled', true);
                $('#casetype4').attr('disabled', true);
                $('#casetype5').attr('disabled', true);
                $('#casetype6').attr('disabled', true);
            } else {
                $('#casetype2').attr('disabled', true);

                $('#casetype3').attr('disabled', true);
                $('#casetype4').attr('disabled', true);
                $('#casetype5').attr('disabled', true);
                $('#casetype6').attr('disabled', true);
            }
        });

        $('#casetype2').on('change', function() {
            var parent_id = $(this).val();
            /* $('#casetype3').html('<option value="">เลือกรายละเอียดเคสย่อย</option>');
            $('#casetype4').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>');
            $('#casetype5').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
            $('#casetype6').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>'); */
            if (parent_id != '') {
                $.ajax({
                    url: "casetype6/casetype/" + parent_id,
                    method: 'GET',
                    async: false,
                    success: function(res) {
                        $('#casetype3').html('');
                        $.each(res.data, function(index, item) {
                            $('#casetype3').append(
                                $('<option></option>').val(item.id).html(item
                                    .name)
                            );
                        });
                        if(res.data.length === 0){
                            $('#casetype3').attr('disabled', true);
                        }else{
                            $('#casetype3').attr('disabled', false);
                        }
                    }
                });

                $('#casetype4').attr('disabled', true);
                $('#casetype5').attr('disabled', true);
                $('#casetype6').attr('disabled', true);
            } else {
                $('#casetype3').attr('disabled', true);

                $('#casetype4').attr('disabled', true);
                $('#casetype5').attr('disabled', true);
                $('#casetype6').attr('disabled', true);
            }
        });

        $('#casetype3').on('change', function() {
            var parent_id = $(this).val();
            /* $('#casetype4').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>');
            $('#casetype5').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
            $('#casetype6').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>'); */
            if (parent_id != '') {
                $.ajax({
                    url: "casetype6/casetype/" + parent_id,
                    method: 'GET',
                    async: false,
                    success: function(res) {
                        $('#casetype4').html('');
                        $.each(res.data, function(index, item) {
                            $('#casetype4').append(
                                $('<option></option>').val(item.id).html(item
                                    .name)
                            );
                        });
                        if(res.data.length === 0){
                            $('#casetype4').attr('disabled', true);
                        }else{
                            $('#casetype4').attr('disabled', false);
                        }
                    }
                });

                $('#casetype5').attr('disabled', true);
                $('#casetype6').attr('disabled', true);
            } else {
                $('#casetype4').attr('disabled', true);

                $('#casetype5').attr('disabled', true);
                $('#casetype6').attr('disabled', true);
            }
        });

        $('#casetype4').on('change', function() {
            var parent_id = $(this).val();
            /* $('#casetype5').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
            $('#casetype6').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>'); */
            if (parent_id != '') {
                $.ajax({
                    url: "casetype6/casetype/" + parent_id,
                    method: 'GET',
                    async: false,
                    success: function(res) {
                        $('#casetype5').html('');
                        $.each(res.data, function(index, item) {
                            $('#casetype5').append(
                                $('<option></option>').val(item.id).html(item
                                    .name)
                            );
                        });
                        if(res.data.length === 0){
                            $('#casetype5').attr('disabled', true);
                        }else{
                            $('#casetype5').attr('disabled', false);
                        }
                    }
                });

                $('#casetype6').attr('disabled', true);
            } else {
                $('#casetype5').attr('disabled', true);

                $('#casetype6').attr('disabled', true);
            }
        });

        $('#casetype5').on('change', function() {
            var parent_id = $(this).val();
            //$('#casetype6').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
            if (parent_id != '') {
                $.ajax({
                    url: "casetype6/casetype/" + parent_id,
                    method: 'GET',
                    async: false,
                    success: function(res) {
                        $('#casetype6').html('');
                        $.each(res.data, function(index, item) {
                            $('#casetype6').append(
                                $('<option></option>').val(item.id).html(item
                                    .name)
                            );
                        });
                        if(res.data.length === 0){
                            $('#casetype6').attr('disabled', true);
                        }else{
                            $('#casetype6').attr('disabled', false);
                        }
                    }
                });
            } else {
                $('#casetype6').attr('disabled', true);
            }
        });



    });
</script>
