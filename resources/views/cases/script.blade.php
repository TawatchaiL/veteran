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


        $(document).on('click', '#CreateButton', function(e) {
            e.preventDefault();
            $('#topiccase').html('<i class="fa-regular fa-clipboard"></i> เพิ่ม เรื่องที่ติดต่อ');
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();
            $('.form').trigger('reset');
            $('#custom-tabs-one-comment-tab').attr('disabled', true);
            $('#custom-tabs-one-comment-tab').hide();
            $('#custom-tabs-one-commentlog-tab').attr('disabled', true);
            $('#custom-tabs-one-commentlog-tab').hide();
            actions = 'add';
            //_token: token
            $('#Hn').on('input', function() {
                var query = $(this).val();
                    $.ajax({
                    url: 'cases/seachcontact/' + query,
                    method: 'GET',
                    async: false,
                    success: function(data) {
                        var suggestionsList = $('#suggestions');
                        suggestionsList.empty();
                            $.each(data, function(index, item) {
                            suggestionsList.append('<li data-id="' + item.id + '" data-hn="' + item.hn + '" data-name="' + item.fname + ' ' + item.fname + '">HN ' + item.hn + ' ชื่อ-สกุล ' + item.fname + ' ' + item.fname + '</li>');
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
            $.ajax({
                url: "casetype6/casetype/0",
                method: 'GET',
                async: false,
                success: function(res) {
                    var provinceOb = $('#casetype1');
                    provinceOb.html('<option value="">เลือกประเภทการติดต่อ</option>');
                    $.each(res.data, function(index, item) {
                        provinceOb.append(
                            $('<option></option>').val(item.id).html(item
                                .name)
                        );
                    });
                }
            });
            $('#casetype2').html('<option value="">เลือกรายละเอียดเคส</option>');
            $('#casetype3').html('<option value="">เลือกรายละเอียดเคสย่อย</option>');
            $('#casetype4').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>');
            $('#casetype5').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
            $('#casetype6').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
            $('#casetype2').attr('disabled', true);
            $('#casetype3').attr('disabled', true);
            $('#casetype4').attr('disabled', true);
            $('#casetype5').attr('disabled', true);
            $('#casetype6').attr('disabled', true);
            $('#CreateModal').modal('show');
        });

        
        $('#SubmitCreateForm').click(function(e) {
            if(actions == 'edit'){
                if (!confirm("ยืนยันการทำรายการ ?")) return;
            }
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();

            var additionalData = {
                contact_id: $('#Addid').val(),
                casetype1: $('#casetype1 option:selected').text(),
                caseid1: $('#casetype1').val(),
                casedetail: $('#Detail').val(),
                tranferstatus: $('#tranferstatus option:selected').text(),
                casestatus: $('#casestatus option:selected').text(),
                _token: token 
            };
            if($('#casetype2').val() !== ''){
                additionalData.casetype2 = $('#casetype2 option:selected').text();
                additionalData.caseid2 = $('#casetype2').val();
            }
            if($('#casetype3').val() !== ''){
                additionalData.casetype3= $('#casetype3 option:selected').text();
                additionalData.caseid3 = $('#casetype3').val();
            }
            if($('#casetype4').val() !== ''){
                additionalData.casetype4 = $('#casetype4 option:selected').text();
                additionalData.caseid4 = $('#casetype4').val();
            }
            if($('#casetype5').val() !== ''){
                additionalData.casetype5 = $('#casetype5 option:selected').text();
                additionalData.caseid5 = $('#casetype5').val();
            }
            if($('#casetype6').val() !== ''){
                additionalData.casetype6 = $('#casetype6 option:selected').text();
                additionalData.caseid6 = $('#casetype6').val();
            }

            if(actions == 'add'){
                urls = "{{ route('cases.store') }}";
                methods = 'post';
            }else if(actions == 'edit'){
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
                        $('.form').trigger('reset');
                        $('#CreateModal').modal('hide');
                    }
                }
            });
        });


        let id;
        let actions;
        $(document).on('click', '#getEditData', function(e) {
            e.preventDefault();
            $('#topiccase').html('<i class="fa-regular fa-clipboard"></i> แก้ไข เรื่องที่ติดต่อ');
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
            actions = 'edit';
            id = $(this).data('id');
            $.ajax({
                url: "casetype6/casetype/0",
                method: 'GET',
                async: false,
                success: function(res) {
                    var provinceOb = $('#casetype1');
                    provinceOb.html('<option value="">เลือกประเภทการติดต่อ</option>');
                    $.each(res.data, function(index, item) {
                        provinceOb.append(
                            $('<option></option>').val(item.id).html(item
                                .name)
                        );
                    });
                }
            });
            $('#casetype2').html('<option value="">เลือกรายละเอียดเคส</option>');
            $('#casetype3').html('<option value="">เลือกรายละเอียดเคสย่อย</option>');
            $('#casetype4').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>');
            $('#casetype5').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
            $('#casetype6').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
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
                    $('#Hn').val(res.data.hn);
                    $('#Name').val(res.data.name);
                    $('#Detail').val(res.data.casedetail);
                    $('#tranferstatus').val(res.data.tranferstatus);
                    $('#casestatus').val(res.data.casestatus);
                    $('#casetype1').val(res.data.caseid1);
                    $('#casetype1').change();
                    if(res.data.caseid2 != 0){
                        $('#casetype2').val(res.data.caseid2);
                        $('#casetype2').change();
                    }
                    if(res.data.caseid3 != 0){
                        $('#casetype3').val(res.data.caseid3);
                        $('#casetype3').change();
                    }
                    if(res.data.caseid4 != 0){
                        $('#casetype4').val(res.data.caseid4);
                        $('#casetype4').change();
                    }
                    if(res.data.caseid5 != 0){
                        $('#casetype5').val(res.data.caseid5);
                        $('#casetype5').change();
                    }
                    if(res.data.caseid6 != 0){
                        $('#casetype6').val(res.data.caseid6);
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
            if (!confirm("ยืนยันการทำรายการ ?")) return;
            e.preventDefault();

            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();

            var additionalData = {
                casetype1: $('#Editcasetype1e').val(),
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
                url: "casescontract/destroy/",
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
            });
        });

        //loadcasescomment
        $(document).on('click', '.selectcomment-button',function() {
            comment_id = $(this).data('comment_id');
            $.ajax({
                url: '{{ route('cases.commentview') }}',
                type: 'POST',
                data: {
                    commentid: comment_id
                    },
                success: function(response) {
                    alert('OK');
                    $('#listlog').html(response.html);
                }
            });
        });

        $('#casetype1').on('change', function() {
            var parent_id = $(this).val();
            $('#casetype2').html('<option value="">เลือกรายละเอียดเคส</option>');
            $('#casetype3').html('<option value="">เลือกรายละเอียดเคสย่อย</option>');
            $('#casetype4').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>');
            $('#casetype5').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
            $('#casetype6').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
                if(parent_id != ''){    
                    $.ajax({
                        url: "casetype6/casetype/" + parent_id,
                        method: 'GET',
                        async: false,
                        success: function(res) {
                            $.each(res.data, function(index, item) {
                                $('#casetype2').append(
                                    $('<option></option>').val(item.id).html(item.name)
                                );
                            });
                        }
                    });
                    $('#casetype2').attr('disabled', false);

                    $('#casetype3').attr('disabled', true);
                    $('#casetype4').attr('disabled', true);
                    $('#casetype5').attr('disabled', true);
                    $('#casetype6').attr('disabled', true);
                }else{
                    $('#casetype2').attr('disabled', true);

                    $('#casetype3').attr('disabled', true);
                    $('#casetype4').attr('disabled', true);
                    $('#casetype5').attr('disabled', true);
                    $('#casetype6').attr('disabled', true);
                }   
        });

        $('#casetype2').on('change', function() {
            var parent_id = $(this).val();
            $('#casetype3').html('<option value="">เลือกรายละเอียดเคสย่อย</option>');
            $('#casetype4').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>');
            $('#casetype5').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
            $('#casetype6').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
                if(parent_id != ''){    
                    $.ajax({
                        url: "casetype6/casetype/" + parent_id,
                        method: 'GET',
                        async: false,
                        success: function(res) {
                            $.each(res.data, function(index, item) {
                                $('#casetype3').append(
                                    $('<option></option>').val(item.id).html(item.name)
                                );
                            });
                        }
                    });
                    $('#casetype3').attr('disabled', false);

                    $('#casetype4').attr('disabled', true);
                    $('#casetype5').attr('disabled', true);
                    $('#casetype6').attr('disabled', true);
                }else{
                    $('#casetype3').attr('disabled', true);

                    $('#casetype4').attr('disabled', true);
                    $('#casetype5').attr('disabled', true);
                    $('#casetype6').attr('disabled', true);
                }   
        });
        $('#casetype3').on('change', function() {
            var parent_id = $(this).val();
            $('#casetype4').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>');
            $('#casetype5').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
            $('#casetype6').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
                if(parent_id != ''){    
                    $.ajax({
                        url: "casetype6/casetype/" + parent_id,
                        method: 'GET',
                        async: false,
                        success: function(res) {
                            $.each(res.data, function(index, item) {
                                $('#casetype4').append(
                                    $('<option></option>').val(item.id).html(item.name)
                                );
                            });
                        }
                    });
                    $('#casetype4').attr('disabled', false);

                    $('#casetype5').attr('disabled', true);
                    $('#casetype6').attr('disabled', true);
                }else{
                    $('#casetype4').attr('disabled', true);

                    $('#casetype5').attr('disabled', true);
                    $('#casetype6').attr('disabled', true);
                }   
        });
        $('#casetype4').on('change', function() {
            var parent_id = $(this).val();
            $('#casetype5').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
            $('#casetype6').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
                if(parent_id != ''){    
                    $.ajax({
                        url: "casetype6/casetype/" + parent_id,
                        method: 'GET',
                        async: false,
                        success: function(res) {
                            $.each(res.data, function(index, item) {
                                $('#casetype5').append(
                                    $('<option></option>').val(item.id).html(item.name)
                                );
                            });
                        }
                    });
                    $('#casetype5').attr('disabled', false);

                    $('#casetype6').attr('disabled', true);
                }else{
                    $('#casetype5').attr('disabled', true);

                    $('#casetype6').attr('disabled', true);
                }   
        });
        $('#casetype5').on('change', function() {
            var parent_id = $(this).val();
            $('#casetype6').html('<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
                if(parent_id != ''){    
                    $.ajax({
                        url: "casetype6/casetype/" + parent_id,
                        method: 'GET',
                        async: false,
                        success: function(res) {
                            $.each(res.data, function(index, item) {
                                $('#casetype6').append(
                                    $('<option></option>').val(item.id).html(item.name)
                                );
                            });
                        }
                    });
                    $('#casetype6').attr('disabled', false);
                }else{
                    $('#casetype6').attr('disabled', true);
                }   
        });


    });
</script>
