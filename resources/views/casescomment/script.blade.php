@php
    $detect = new Detection\MobileDetect();
@endphp
<script>
    var $eventLog = $(".js-event-log");
    let fatotal = () => {
        let atotal = 0;
        let aamount = 0;
        $("input[name='total[]']").each(function() {
            let value = parseFloat(this.value);
            if (!isNaN(value)) {
                atotal += value;
            }
        });
        $("input[name='amount[]']").each(function() {
            let value = parseFloat(this.value);
            if (!isNaN(value)) {
                aamount += value;
            }
        });
        //alert(atotal);
        $('#AddTotalCost').val(atotal);
        $('#AddAmount').val(aamount);
    }

    let efatotal = () => {
        let atotal = 0;
        let aamount = 0;
        $("input[name='etotal[]']").each(function() {
            let value = parseFloat(this.value);
            if (!isNaN(value)) {
                atotal += value;
            }
        });
        $("input[name='eamount[]']").each(function() {
            let value = parseFloat(this.value);
            if (!isNaN(value)) {
                aamount += value;
            }
        });
        //alert(atotal);
        $('#EditTotalCost').val(atotal);
        $('#EditAmount').val(aamount);
    }

    let log = (name, evt) => {
        if (!evt) {
            var args = "{}";
        } else {
            var args = JSON.stringify(evt.params, function(key, value) {
                if (value && value.nodeName) return "[DOM node]";
                if (value instanceof $.Event) return "[$.Event]";
                return value;
            });
        }
        var $e = $("<li>" + name + " -> " + args + "</li>");
        $eventLog.append($e);
        $e.animate({
            opacity: 1
        }, 10000, 'linear', function() {
            $e.animate({
                opacity: 0
            }, 2000, 'linear', function() {
                $e.remove();
            });
        });
    }

    $(document).ready(function() {

        $(".delete_all_button").click(function() {
            var len = $('input[name="table_records[]"]:checked').length;
            if (len > 0) {

                if (confirm("ยืนยันการลบข้อมูล?")) {
                    $('form#delete_all').submit();
                }
            } else {
                alert("กรุณาเลือกรายการที่จะลบ");
            }

        });

        $('#check-all').click(function() {
            $(':checkbox.flat').prop('checked', this.checked);
        });

        $(".select2_tranfer").select2({
            maximumSelectionLength: 1,
            allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือกประเภทการโอนสาย'
        });

        $(".select2_single").on("select2:unselect", function(e) {
            //log("select2:unselect", e);
            $('.products').html('');
        });

        $(".select2_casestatus").select2({
            maximumSelectionLength: 1,
            allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือกสถานะเคส'
        });

        $(".select2_singlec").select2({
            maximumSelectionLength: 1,
            allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือกประเภทการติดต่อ'
        });


        $(".select2_casetype1").select2({
            maximumSelectionLength: 1,
            allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือกประเภทการติดต่อ'
        });
        $(".select2_casetype2").select2({
            maximumSelectionLength: 1,
            allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'รายละเอียดเคส'
        });
        $(".select2_casetype3").select2({
            maximumSelectionLength: 1,
            allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'รายละเอียดเคสย่อย'
        });
        $(".select2_casetype4").select2({
            maximumSelectionLength: 1,
            allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'รายละเอียดเคส เพิ่มเติม 1'
        });
        $(".select2_casetype5").select2({
            maximumSelectionLength: 1,
            allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'รายละเอียดเคส เพิ่มเติม 2'
        });
        $(".select2_casetype6").select2({
            maximumSelectionLength: 1,
            allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'รายละเอียดเคส เพิ่มเติม 3'
        });

        $(".select2_casetype1e").select2({
            maximumSelectionLength: 1,
            allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือกประเภทการติดต่อ'
        });
        $(".select2_casetype2e").select2({
            maximumSelectionLength: 1,
            allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'รายละเอียดเคส'
        });
        $(".select2_casetype3e").select2({
            maximumSelectionLength: 1,
            allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'รายละเอียดเคสย่อย'
        });
        $(".select2_casetype4e").select2({
            maximumSelectionLength: 1,
            allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'รายละเอียดเคส เพิ่มเติม 1'
        });
        $(".select2_casetype5e").select2({
            maximumSelectionLength: 1,
            allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'รายละเอียดเคส เพิ่มเติม 2'
        });
        $(".select2_casetype6e").select2({
            maximumSelectionLength: 1,
            allowClear: true,
            //theme: 'bootstrap4'
            placeholder: 'รายละเอียดเคส เพิ่มเติม 3'
        });

        $("#price,#amount,#stock").on("change", function() {
            var parent = $(this).parent().parent().parent();

            var amount = parent.find('#amount').val();
            var price = parent.find('#price').val();
            var sid = parent.find('#stock').val();

            let total_cost = amount * price;
            parent.find('#total').val(total_cost)

            fatotal();
            if (sid !== null) {
                $.ajax({
                    type: "GET",
                    dataType: 'JSON',
                    async: false,
                    url: "stocks/find/price/" + sid,
                    success: function(res) {
                        //console.log(res);
                        parent.find('#lot_price').html(
                            `***ควรขายที่ราคา ${res.cost} - ${res.price} บาท `);
                        if (parseInt(amount) > parseInt(res.remaining)) {
                            toastr.error('จำนวนที่จะขายมากกว่าจำนวนที่เหลือในล๊อต', {
                                timeOut: 5000
                            });
                            parent.find('#lot_error').html(
                                '***จำนวนที่จะขายมากกว่าจำนวนที่เหลือในล๊อต');
                            parent.find('#amount').val('')
                        } else {
                            parent.find('#lot_error').html('');
                        }
                    }
                });
            }
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
            //startDate = moment(currentDate).subtract(15, 'days').format('YYYY-MM-DD');
            // Set the end date to the end of the current month
            //endDate = moment(currentDate).endOf('month').format('YYYY-MM-DD');
            startDate = moment().format('YYYY-MM-DD');
            endDate = moment(currentDate).endOf('month').format('YYYY-MM-DD');
        }
        function datereset() {
            var currentDate = moment();
            startDate = moment().format('YYYY-MM-DD');
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

            $('#reservation').daterangepicker({
                startDate: startDate,
                endDate: endDate,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });

            // Apply the custom date range filter on input change
            $('#reservation').on('apply.daterangepicker', function() {
                table.draw();
                //storeFieldValues();
            });
        }
        datesearch();
        daterange();


        $.datepicker.setDefaults($.datepicker.regional['en']);
        $(".AddDate").datepicker({
            /*  onSelect: function() {
                 table.draw();
             }, */
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            yearRange: '1980:2050',
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
                    data: 'created_at',
                    name: 'created_at'
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
        $('#btnsearch').click(function(e) {
            var fieldValue = $("#seachtype").val();
            var textValue = $("#seachtext").val();
            if (fieldValue === '3' || fieldValue === '4' || fieldValue === '5') {
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
            document.getElementById('validationMessages').textContent = '';
            datereset();
            daterange();
            $('#Listview').DataTable().ajax.reload();
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
    
        let id;
        let actions;
        $(document).on('click', '#getCommentData', function(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();
            actions = 'edit';
            id = $(this).data('id');
            $.ajax({
                url: "casescomment/edit/" + id,
                method: 'GET',
                success: function(res) {
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
                    $('#CommmentModal').modal('show');
                }
            });
        })

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
                url: "casescomment/save/" + id,
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
                        $('#CommmentModal').modal('hide');
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

        $(document).on('click', '.btn-viewcomment', function() {
            id = $(this).data('id');
            $.ajax({
                url: "casescomment/records/" + id,
                method: 'GET',
                success: function(res) {
                    alert('OK');
                    $.each(res.data, function(index, value) {
                        alert('OK2');
                                        $('#ListviewComment tbody').append($('<tr>')
                                                .append($('<td>')
                                                    .append('<div class="col-md-12 col-sm-12 col-xs-12">' + value.comment + '</div>'))
                                                .append($('<td>')
                                                    .append('<div class="col-md-12 col-sm-12 col-xs-12">' + value.agent + '</div>'))
                                                .append($('<td>')
                                                    .append('<div class="col-md-12 col-sm-12 col-xs-12">' + value.created_at + '</div>'))
                                        );
                                    });
                    $('#RecoreModal').modal('show');
                }
            });
        });


    });
</script>
