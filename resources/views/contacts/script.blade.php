@php
    $detect = new Detection\MobileDetect();
@endphp
<script>
    $(document).ready(function() {
        $("#etm").val(1).trigger("change")
        $("#eam").val(1).trigger("change")
        $("#ecity").val(1).trigger("change")

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
        $(".select2_single2").select2({
            maximumSelectionLength: 1,
            allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือก'
        });
        $(".select2_single3").select2({
            maximumSelectionLength: 1,
            allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือก'
        });
        $(".select2_singlee").select2({
            maximumSelectionLength: 1,
            allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือก'
        });
        $(".select2_singlee2").select2({
            maximumSelectionLength: 1,
            allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือก'
        });
        $(".select2_singlee3").select2({
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
            allowClear: false,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือก'
        });

        $(".select2_singlec").select2({
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

        //$(".AddDate").datepicker({
        //    dateFormat: "yy-mm-dd"
        //});

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
            //startDate = moment(currentDate).subtract(3,650, 'days').format('YYYY-MM-DD');
            // Set the end date to the end of the current month
            //endDate = moment(currentDate).endOf('month').format('YYYY-MM-DD');
            //startDate = moment().format('YYYY-MM-DD');
            startDate = '2023-01-01';
            endDate = moment(currentDate).endOf('month').format('YYYY-MM-DD');
        }

        function datereset() {
            var currentDate = moment();
            //startDate = moment().format('YYYY-MM-DD');
            //startDate = moment(currentDate).subtract(3,650, 'days').format('YYYY-MM-DD');
            startDate = '2023-01-01';
            endDate = moment(currentDate).endOf('month').format('YYYY-MM-DD');
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
        }

        let daterange = () => {
            var todayRange = [moment().startOf('day'), moment().endOf('day')];
            var yesterdayRange = [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days')
                .endOf('day')
            ];
            var last7DaysRange = [moment().subtract(6, 'days').startOf('day'), moment().endOf('day')];
            var last30DaysRange = [moment().subtract(29, 'days').startOf('day'), moment().endOf('day')];

            $('#reservation').dateRangePicker({
                startDate: startDate,
                endDate: endDate,
                language: 'auto',
                separator: ' - ',
                showShortcuts: true,
                shortcuts: {
                    'วันนี้': todayRange,
                    'เมื่อวานนี้': yesterdayRange,
                    'ย้อนหลัง 7 วัน': last7DaysRange,
                    'ย้อนหลัง 30 วัน': last30DaysRange,
                    'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
                    'เดือนที่แล้ว': [moment().subtract(1, 'month').startOf('month'), moment()
                        .subtract(1, 'month').endOf('month')
                    ]
                },
                /* locale: {
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
                } */

            }).setDateRange('2013-11-20', '2013-11-25');
            // Apply the custom date range filter on input change
            $('#reservation').on('datepicker-apply', function() {
                table.draw();
                //storeFieldValues();
            });
        }
        datesearch();
        daterange();

        $.datepicker.setDefaults($.datepicker.regional['th']);
        $(".AddDate").datepicker({
            dateFormat: "yy-mm-dd",
            //defaultDate: '2023-11-14',
            isBuddhist: true,
            changeMonth: true,
            changeYear: true,
            //yearRange:'1940:2057',
            yearRange: '1930:2050',
            dayNamesMin: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"],
            monthNamesShort: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
                "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
            ],
            beforeShow: function() {
                if ($(this).val() != "") {
                    var arrayDate = $(this).val().split("-");
                    arrayDate[0] = parseInt(arrayDate[0]) - 543;
                    $(this).val(arrayDate[0] + "-" + arrayDate[1] + "-" + arrayDate[2]);
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
                    var arrayDate = dateText.split("-");
                    //$('#temp'+$(this).attr('id')).html(dateBefore);
                    arrayDate[0] = parseInt(arrayDate[0]) + 543;
                    $(this).val(arrayDate[0] + "-" + arrayDate[1] + "-" + arrayDate[2]);
                }
            },
            /*onClose: function() {
                if ($(this).val() != "" && $(this).val() == dateBefore) {
                    var arrayDate = dateBefore.split("-");
                    //$('#temp'+$(this).attr('id')).html(dateBefore);
                    arrayDate[0] = parseInt(arrayDate[0]) + 543;
                    $(this).val(arrayDate[0] + "-" + arrayDate[1] + "-" + arrayDate[2]);
                }
            },*/
            /*onBlur: function(dateText, inst) {
                if ($(this).val() != "") {
                    var arrayDate = dateBefore.split("-");
                    //$('#temp'+$(this).attr('id')).html(dateBefore);
                    arrayDate[0] = parseInt(arrayDate[0]) + 543;
                    $(this).val(arrayDate[0] + "-" + arrayDate[1] + "-" + arrayDate[2]);
                }
            },*/
            onSelect: function(dateText, inst) {
                dateBefore = $(this).val();
                //$('#temp'+$(this).attr('id')).html(dateBefore);
                var arrayDate = dateText.split("-");
                arrayDate[0] = parseInt(arrayDate[0]) + 543;
                $(this).val(arrayDate[0] + "-" + arrayDate[1] + "-" + arrayDate[2]);

                var selectedDate = new Date(dateText);
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
                }
                $("#" + $(this).data('age')).val(years + " ปี " + months + " เดือน " + days +
                    " วัน");
            }
        });

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
            searching: false,
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
                    data: 'adddate',
                    name: 'adddate'
                },
                {
                    data: 'hn',
                    name: 'hn'
                },
                {
                    data: 'fname',
                    name: 'fname'
                },
                {
                    data: 'telhome',
                    name: 'telhome'
                },
                {
                    data: 'phoneno',
                    name: 'phoneno'
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

        $('#btnsearch').click(function(e) {
            var fieldValue = $("#seachtype").val();
            var textValue = $("#seachtext").val();
            if (fieldValue !== '0') {
                if (textValue === '') {
                    document.getElementById('validationMessages').textContent =
                        'กรุณากรอกข้อมูลที่จะค้นหา';
                    return false;
                } else {
                    document.getElementById('validationMessages').textContent = '';
                }
            } else {
                document.getElementById('validationMessages').textContent = '';
            }
            $('#Listview').DataTable().ajax.reload();
        });
        $('#btnreset').click(function(e) {
            $("#seachtype").val(0);
            $("#seachtext").val('');
            datereset();
            daterange();
            document.getElementById('validationMessages').textContent = '';
            $('#Listview').DataTable().ajax.reload();
        });




        $(document).on('click', '#CreateButton', function(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();
            $.ajax({
                method: "GET",
                url: "{{ route('contacts.running') }}",
                success: function(res) {
                    $('#AddCode').val(res.running);
                }
            });
            $.ajax({
                url: "{{ route('thcity.city') }}",
                method: 'GET',
                success: function(res) {
                    //alert(res.data.code);
                    var provinceOb = $('#Addcity');
                    provinceOb.html('<option value="">เลือกจังหวัด</option>');
                    $.each(res.data, function(index, item) {
                        provinceOb.append(
                            $('<option></option>').val(item.code).html(item
                                .name_th)
                        );
                    });

                    setTimeout(function() {
                        $('#Addcity').val('65');
                        $('#Addcity').change();
                    }, 1000)

                }
            });
            var tbody = document.querySelector('#myTbl3 tbody');
            var rows = tbody.querySelectorAll('tr');
            for (var i = 1; i < rows.length; i++) {
                tbody.removeChild(rows[i]);
            }
            $('#custom-tabs-one-tabp a[href="#custom-tabs-one-home"]').tab('show');
            $('#CreateModal').modal('show');
        });



        // Create product Ajax request.
        $('#SubmitCreateForm').click(function(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();

            var emergencyData = [];
            $('#myTbl3 tbody tr').each(function() {
                var emergencyname = $(this).find('input[name="emergencyname[]"]').val();
                var emerrelation = $(this).find('input[name="emerrelation[]"]').val();
                var emerphone = $(this).find('input[name="emerphone[]"]').val();

                var emergency = {
                    emergencyname: emergencyname,
                    emerrelation: emerrelation,
                    emerphone: emerphone
                };
                emergencyData.push(emergency);
            });

            var arrayDate = $('#Addadddate').val().split("-");
            arrayDate[0] = parseInt(arrayDate[0]) - 543;
            var tempadddate = arrayDate[0] + "-" + arrayDate[1] + "-" + arrayDate[2];

            var arrayDateb = $('#Addbirthday').val().split("-");
            arrayDateb[0] = parseInt(arrayDateb[0]) - 543;
            var tempbirthday = arrayDateb[0] + "-" + arrayDateb[1] + "-" + arrayDateb[2];

            var additionalData = {
                hn: $('#Addhn').val(),
                adddate: tempadddate,
                tname: $('#Addtname').val(),
                fname: $('#Addfname').val(),
                lname: $('#Addlname').val(),
                sex: $('#Addsex').val(),
                birthday: tempbirthday,
                age: $('#Addage').val(),
                bloodgroup: $('#Addbloodgroup').val(),
                homeno: $('#Addhomeno').val(),
                moo: $('#Addmoo').val(),
                soi: $('#Addsoi').val(),
                road: $('#Addroad').val(),
                city: $('#Addcity').val(),
                district: $('#Adddistrict').val(),
                subdistrict: $('#Addsubdistrict').val(),
                postcode: $('#Addpostcode').val(),
                telhome: $('#Addtelhome').val(),
                phoneno: $('#Addphoneno').val(),
                workno: $('#Addworkno').val(),
                checkemer: $('#Addcheckemer').val(),
                emergencyData: emergencyData,
                _token: token
            };

            $.ajax({
                url: "{{ route('contacts.store') }}",
                method: 'post',
                data: additionalData,
                success: function(result) {
                    if (result.errors) {
                        $('.alert-danger').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<strong><li>' + value +
                                '</li></strong>');
                        });
                        //$('#CreateModal').scrollTop(0);
                        $('.alert-danger').focus();
                    } else {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.alert-success').append('<strong><li>' + result.success +
                            '</li></strong>');
                        toastr.success(result.success, {
                            timeOut: 5000
                        });
                        $('#Listview').DataTable().ajax.reload();
                        $('.form').trigger('reset');
                        $('#CreateModal').modal('hide');
                    }
                }
            });
        });

        let id;
        $(document).on('click', '#getCases', function(e) {
            id = $(this).data('id');
            //window.location.href = "{{ route('cases', ['id' => '.id.']) }}";
            //window.location.href = "cases";
            //var id = '12';
            var url = "casescontract?id=" + id;
            //url = url.replace(':id', id);
            location.href = url;
        });
        $(document).on('click', '#getEditData', function(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();

            id = $(this).data('id');
            $.ajax({
                url: "{{ route('thcity.city') }}",
                method: 'GET',
                success: function(res) {
                    //alert(res.data.code);
                    var provinceOb = $('#Editcity');
                    provinceOb.html('<option value="">เลือกจังหวัด</option>');
                    $.each(res.data, function(index, item) {
                        provinceOb.append(
                            $('<option></option>').val(item.code).html(item
                                .name_th)
                        );
                    });
                }
            });
            setTimeout(function() {
                $.ajax({
                    url: "contacts/edit/" + id,
                    method: 'GET',
                    success: function(res) {
                        $('#Edithn').val(res.datax.datac.hn);
                        if (res.datax.datac.adddate !== '' && res.datax.datac
                            .adddate !== null && res.datax.datac.adddate !==
                            undefined) {
                            var arrayDate = res.datax.datac.adddate.split("-");
                            arrayDate[0] = parseInt(arrayDate[0]) + 543;
                            $('#Editadddate').val(arrayDate[0] + "-" + arrayDate[
                                    1] +
                                "-" + arrayDate[2]);
                        }
                        //$('#Editadddate').val(res.datax.datac.adddate);
                        $('#Edittname').val(res.datax.datac.tname);
                        $('#Editfname').val(res.datax.datac.fname);
                        $('#Editlname').val(res.datax.datac.lname);
                        $('#Editsex').val(res.datax.datac.sex);
                        if (res.datax.datac.birthday !== '' && res.datax.datac
                            .birthday !== null && res.datax.datac.birthday !==
                            undefined) {
                            var arrayDateb = res.datax.datac.birthday.split("-");
                            arrayDateb[0] = parseInt(arrayDateb[0]) + 543;
                            $('#Editbirthday').val(arrayDateb[0] + "-" + arrayDateb[
                                    1] +
                                "-" + arrayDateb[2]);
                            //$('#Editbirthday').val(res.datax.datac.birthday);
                        }
                        $('#Editage').val(res.datax.datac.age);
                        $('#Editbloodgroup').val(res.datax.datac.bloodgroup);
                        $('#Edithomeno').val(res.datax.datac.homeno);
                        $('#Editmoo').val(res.datax.datac.moo);
                        $('#Editsoi').val(res.datax.datac.soi);
                        $('#Editroad').val(res.datax.datac.road);
                        $('#Editcity').val(res.datax.datac.city);
                        $('#Editcity').change();
                        setTimeout(function() {
                            $('#Editdistrict').val(res.datax.datac
                                .district);
                            $('#Editdistrict').change();
                            setTimeout(function() {
                                $('#Editsubdistrict').val(res.datax
                                    .datac.subdistrict);
                            }, 1000)
                        }, 1000)
                        $('#Editpostcode').val(res.datax.datac.postcode);
                        $('#Edittelhome').val(res.datax.datac.telhome);
                        $('#Editphoneno').val(res.datax.datac.phoneno);
                        $('#Editworkno').val(res.datax.datac.workno);

                        var tbody = document.querySelector('#myTbl3e tbody');
                        while (tbody.firstChild) {
                            tbody.removeChild(tbody.firstChild);
                        }

                        $.each(res.datax.emer, function(index, value) {
                            $('#myTbl3e tbody').append($('<tr>')
                                .append($('<td style="display:none;">')
                                    .append(value.id))
                                .append($('<td width="30%">').append(
                                    '<div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="eemergencyname" name="eemergencyname[]" class="form-control has-feedback-left" value="' +
                                    value.emergencyname +
                                    '" required="required"></div>'))
                                .append($('<td width="10%">').append(
                                    '<div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="eemerrelation" name="eemerrelation[]" class="form-control has-feedback-left" value="' +
                                    value.emerrelation +
                                    '" required="required"></div>'))
                                .append($('<td width="10%">').append(
                                    '<div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="eemerphone" name="eemerphone[]" class="form-control has-feedback-left" onkeydown="validateNumber(event)" value="' +
                                    value.emerphone +
                                    '" required="required"></div>'))
                                .append($('<td width="5%">').append(
                                    '<button type="button" name="deletem" id="deletem" class="btn btn-sm btn-danger removeRowBtn" onclick="$(this).closest(\'tr\').remove();\"><i class="fa fa-minus"></i></button>'
                                )));
                        });

                        $('#custom-tabs-one-tabe a[href="#custom-tabs-one-homee"]')
                            .tab('show');
                        $('#EditModal').modal('show');
                    }
                });
            }, 1000)
        });

        $('#SubmitEditForm').click(function(e) {
            if (!confirm("ยืนยันการทำรายการ ?")) return;
            e.preventDefault();

            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();

            var eemergencyData = [];
            $('#myTbl3e tbody tr').each(function(index, tr) {
                var eemertype = tr.cells[0].innerHTML;
                var eemergencyname = $(this).find('input[name="eemergencyname[]"]').val();
                var eemerrelation = $(this).find('input[name="eemerrelation[]"]').val();
                var eemerphone = $(this).find('input[name="eemerphone[]"]').val();
                var eemergency = {
                    eemertype: eemertype,
                    emergencyname: eemergencyname,
                    emerrelation: eemerrelation,
                    emerphone: eemerphone
                };
                eemergencyData.push(eemergency);
            });

            var arrayDate = $('#Editadddate').val().split("-");
            arrayDate[0] = parseInt(arrayDate[0]) - 543;
            var tempadddate = arrayDate[0] + "-" + arrayDate[1] + "-" + arrayDate[2];

            var arrayDateb = $('#Editbirthday').val().split("-");
            arrayDateb[0] = parseInt(arrayDateb[0]) - 543;
            var tempbirthday = arrayDateb[0] + "-" + arrayDateb[1] + "-" + arrayDateb[2];

            var additionalData = {
                hn: $('#Edithn').val(),
                adddate: tempadddate,
                tname: $('#Edittname').val(),
                fname: $('#Editfname').val(),
                lname: $('#Editlname').val(),
                sex: $('#Editsex').val(),
                birthday: tempbirthday,
                age: $('#Editage').val(),
                bloodgroup: $('#Editbloodgroup').val(),
                homeno: $('#Edithomeno').val(),
                moo: $('#Editmoo').val(),
                soi: $('#Editsoi').val(),
                road: $('#Editroad').val(),
                city: $('#Editcity').val(),
                district: $('#Editdistrict').val(),
                subdistrict: $('#Editsubdistrict').val(),
                postcode: $('#Editpostcode').val(),
                telhome: $('#Edittelhome').val(),
                phoneno: $('#Editphoneno').val(),
                workno: $('#Editworkno').val(),
                eemergencyData: eemergencyData
            };
            $.ajax({
                url: "contacts/update/" + id,
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
                        $('#EditModal').scrollTop(0);
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
                url: "contacts/destroy/",
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
<script>
    $('#addRowBtn').click(function() {
        $('#myTbl3 tbody').append($('<tr>')
            .append($('<td width="30%">').append(
                '<div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="emergencyname" name="emergencyname[]" class="form-control has-feedback-left" value="" required="required"></div>'
            ))
            .append($('<td width="10%">').append(
                '<div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="emerrelation" name="emerrelation[]" class="form-control has-feedback-left" value="" required="required"></div>'
            ))
            .append($('<td width="10%">').append(
                '<div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="emerphone" name="emerphone[]" class="form-control has-feedback-left" onkeydown="validateNumber(event)" value="" required="required"></div>'
            ))
            .append($('<td width="5%">').append(
                '<button type="button" name="deletem" id="deletem" class="btn btn-sm btn-danger removeRowBtn" onclick="$(this).closest(\'tr\').remove();\"><i class="fa fa-minus"></i></button>'
            )));
    });
    $('#editRowBtne').click(function() {
        $('#myTbl3e tbody').append($('<tr>')
            .append($('<td style="display:none;">').append(''))
            .append($('<td width="30%">').append(
                '<div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="eemergencyname" name="eemergencyname[]" class="form-control has-feedback-left" value="" required="required"></div>'
            ))
            .append($('<td width="10%">').append(
                '<div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="eemerrelation" name="eemerrelation[]" class="form-control has-feedback-left" value="" required="required"></div>'
            ))
            .append($('<td width="10%">').append(
                '<div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="eemerphone" name="eemerphone[]" class="form-control has-feedback-left" onkeydown="validateNumber(event)" value="" required="required"></div>'
            ))
            .append($('<td width="5%">').append(
                '<button type="button" name="deletem" id="deletem" class="btn btn-sm btn-danger removeRowBtn" onclick="$(this).closest(\'tr\').remove();\"><i class="fa fa-minus"></i></button>'
            )));
    });

    $(function() {

        var provinceOb = $('#Addcity');
        var districtOb = $('#Adddistrict');
        var cartonOb = $('#Addsubdistrict');

        // on change province
        $('#Addcity').on('change', function() {
            var provinceId = $(this).val();
            districtOb.html('<option value="">เลือกอำเภอ</option>');
            $.ajax({
                url: "thdistrict/district/" + provinceId,
                method: 'GET',
                success: function(res) {
                    districtOb.html('<option value="">เลือกอำเภอ</option>');
                    cartonOb.html('<option value="">เลือกตำบล</option>');
                    $.each(res.data, function(index, item) {
                        districtOb.append(
                            $('<option></option>').val(item.code).html(item
                                .name_th)
                        );
                    });
                }
            });
        });
        districtOb.on('change', function() {
            var districtId = $(this).val();
            cartonOb.html('<option value="">เลือกตำบล</option>');
            $.ajax({
                url: "thsubdistrict/subdistrict/" + districtId,
                method: 'GET',
                success: function(res) {
                    cartonOb.html('<option value="">เลือกตำบล</option>');
                    $.each(res.data, function(index, item) {
                        cartonOb.append(
                            $('<option></option>').val(item.code).html(item
                                .name_th)
                        );
                    });
                }
            });
        });

        var EprovinceOb = $('#Editcity');
        var EdistrictOb = $('#Editdistrict');
        var EcartonOb = $('#Editsubdistrict');

        // Edit
        $('#Editcity').on('change', function() {
            var provinceId = $(this).val();
            EdistrictOb.html('<option value="">เลือกอำเภอ</option>');
            $.ajax({
                url: "thdistrict/district/" + provinceId,
                method: 'GET',
                success: function(res) {
                    EdistrictOb.html('<option value="">เลือกอำเภอ</option>');
                    EcartonOb.html('<option value="">เลือกตำบล</option>');
                    $.each(res.data, function(index, item) {
                        EdistrictOb.append(
                            $('<option></option>').val(item.code).html(item
                                .name_th)
                        );
                    });
                }
            });
        });
        EdistrictOb.on('change', function() {
            var districtId = $(this).val();
            EcartonOb.html('<option value="">เลือกตำบล</option>');
            $.ajax({
                url: "thsubdistrict/subdistrict/" + districtId,
                method: 'GET',
                success: function(res) {
                    EcartonOb.html('<option value="">เลือกตำบล</option>');
                    $.each(res.data, function(index, item) {
                        EcartonOb.append(
                            $('<option></option>').val(item.code).html(item
                                .name_th)
                        );
                    });
                }
            });
        });
    });

    function validateNumber(event) {
        //var keyCode = event.which || event.keyCode;
        //if ((keyCode < 48 || keyCode > 57) && keyCode !== 8) {
        //if ((keyCode < 48 || (keyCode > 57 && keyCode < 96) || keyCode > 105) && keyCode !== 8) {
        //    event.preventDefault();
        //} 
        var allowedKeys = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
        var keyCode = event.key;

        if (keyCode === "Backspace") {
            return;
        }

        if (allowedKeys.indexOf(keyCode) === -1) {
            event.preventDefault();
        }
    }
</script>
