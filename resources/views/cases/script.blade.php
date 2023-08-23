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

        $(document).on('change', '#eprice,#eamount,#estock', function(e) {
            var parent = $(this).parent().parent().parent();

            var amount = parent.find('#eamount').val();
            var amounth = parent.find('#eamounth').val();
            var price = parent.find('#eprice').val();
            var sid = parent.find('#estock').val();

            let total_cost = amount * price;
            parent.find('#etotal').val(total_cost)

            //alert(amounth);
            if (isNaN(parseInt(amounth))) {
                amounth = 0;
            }

            efatotal();
            if (sid !== null) {
                $.ajax({
                    type: "GET",
                    dataType: 'JSON',
                    async: false,
                    url: "stocks/find/price/" + sid,
                    success: function(res) {
                        //console.log(res);

                        //alert(parseInt(amounth));
                        //alert(parseInt(res.remaining)+parseInt(amounth));
                        parent.find('#elot_price').html(
                            `***ควรขายที่ราคา ${res.cost} - ${res.price} บาท `);
                        if (parseInt(amount) > (parseInt(res.remaining) + parseInt(
                                amounth))) {
                            toastr.error('จำนวนที่จะขายมากกว่าจำนวนที่เหลือในล๊อต', {
                                timeOut: 5000
                            });
                            parent.find('#elot_error').html(
                                '***จำนวนที่จะขายมากกว่าจำนวนที่เหลือในล๊อต');
                            parent.find('#eamount').val('')
                        } else {
                            parent.find('#elot_error').html('');
                        }
                    }
                });
            }
        });


        $("#EditCost,#EditAmount").on("keyup", function() {
            let cost = $("#EditCost").val();
            let amount = $("#EditAmount").val();

            let total_cost = amount * cost;
            $("#EditTotalCost").val(total_cost);

        });



        $(".productl").change(function() {
            let product = $('#AddProduct').val();
            //console.log(product);
            //alert(product);
            $('#AddStock').html('');
            if (product.length !== 0) {
                $.ajax({
                    method: "GET",
                    url: "stocks/find/add/" + product,
                    success: function(res) {

                        //$('#AddStock').html(res.html);
                        $('.products').html(res.html);
                        //console.log(res);

                    }
                });
            }

        })

        $(".producte").change(function() {
            let product = $('#EditProduct').val();
            //console.log(product);
            //alert(product);
            $('#EditStock').html('');
            if (product.length !== 0) {
                $.ajax({
                    method: "GET",
                    url: "stocks/find/edit/" + product,
                    async: false,
                    success: function(res) {
                        $('#EditStock').html(res.html);
                        //console.log(res);

                    }
                });
            }

        })

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
                    data: 'contact_id',
                    name: 'contact_id'
                },
                {
                    data: 'telephone',
                    name: 'telephone'
                },
                {
                    data: 'create_date',
                    name: 'create_date'
                },
                {
                    data: 'case_type',
                    name: 'case_type'
                },
                {
                    data: 'case_status',
                    name: 'case_status'
                },
                {
                    data: 'transfer_status',
                    name: 'transfer_status'
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


        let lid;
        $(document).on('click', '#getLogData', function(e) {
            e.preventDefault();
            lid = $(this).data('id');
            $.ajax({
                url: "orders/log/" + lid,
                method: 'GET',
                success: function(res) {
                    $('#log_table').html(res.html);
                    $('#LogModal').modal('show');
                }
            });


        })


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

            var stockValues = [];
            var amountValues = [];
            var priceValues = [];
            var isValid = true;

            // Initializing array values
            $("select[name='stock[]']").each(function() {
                stockValues.push(this.value);
            });

            // Check for duplicates in stock values
            var duplicateValues = stockValues.filter(function(value, index, self) {
                return self.indexOf(value) !== index;
            });

            if (duplicateValues.length > 0) {
                toastr.error('ไม่สามารถเลือกสินค้าล็อตเดียวกันในรายการขาย', {
                    timeOut: 5000
                });
                return false;
            }

            // Validate stock select
            var stockSelects = $("select[name='stock[]']");
            stockSelects.each(function() {
                var stockSelect = $(this);
                var selectedValue = stockSelect.val();

                if (selectedValue === null || selectedValue.trim() === '') {
                    stockSelect.addClass("is-invalid");
                    stockSelect.removeClass("is-valid");
                    toastr.error('กรุณาเลือกสินค้าในคลังสินค้า', {
                        timeOut: 5000
                    });
                    isValid = false;
                } else {
                    stockSelect.removeClass("is-invalid");
                    stockSelect.addClass("is-valid");
                }
            });

            if (!isValid) {
                return false;
            }

            // Collect amount values and validate
            $("input[name='amount[]']").each(function() {
                var amountInput = $(this);
                var value = parseFloat(amountInput.val());

                if (isNaN(value) || value % 0.5 !== 0) {
                    // Invalid amount input
                    amountInput.addClass("is-invalid");
                    amountInput.removeClass("is-valid");
                    amountInput.siblings(".error-message").text(
                        "กรุณาระบุจำนวนที่จะขาย");
                    toastr.error('กรุณาระบุจำนวนที่จะขาย', {
                        timeOut: 5000
                    });
                    isValid = false;
                } else {
                    // Valid amount input
                    amountInput.removeClass("is-invalid");
                    amountInput.addClass("is-valid");
                    amountValues.push(value);
                }
            });

            if (!isValid) {
                return false;
            }

            // Collect price values and validate
            $("input[name='price[]']").each(function() {
                var priceInput = $(this);
                var value = parseFloat(priceInput.val());

                if (isNaN(value) || value <= 0) {
                    // Invalid price input
                    priceInput.addClass("is-invalid");
                    priceInput.removeClass("is-valid");
                    priceInput.siblings(".error-message").text(
                        "กรุณาระบุราคาที่จะขาย");
                    toastr.error('กรุณาระบุราคาที่จะขาย', {
                        timeOut: 5000
                    });
                    isValid = false;
                } else {
                    // Valid price input
                    priceInput.removeClass("is-invalid");
                    priceInput.addClass("is-valid");
                    priceValues.push(value);
                }
            });

            if (!isValid) {
                return false;
            }

            if ($('#AddCompany').val()[0] !== undefined) {
                var formData = {
                    order_number: $('#AddLot').val(),
                    sid: stockValues, // Only consider the first selected stock value
                    cid: $('#AddCompany').val()[0],
                    pid: $('#AddProduct').val()[0],
                    amount: amountValues,
                    price: priceValues,
                    tamount: $('#AddAmount').val(),
                    //cost: $('#AddCost').val(),
                    total_cost: $('#AddTotalCost').val(),
                    detail: $('#AddDetail').val(),
                    _token: token
                };

                $.ajax({
                    url: "{{ route('cases.store') }}",
                    method: 'post',
                    data: formData,
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
                            $('.alert-success').text(result.success);
                            toastr.success(result.success, {
                                timeOut: 5000
                            });
                            $('#Listview').DataTable().ajax.reload();
                            $("#AddProduct").val(null).trigger("change")
                            $("#AddStock").val(null).trigger("change")
                            $("#AddCompany").val(null).trigger("change")
                            $('.form').trigger('reset');
                            $('#CreateModal').modal('hide');
                        }
                    }
                });

            } else {
                toastr.error('กรุณากรอกข้อมูลให้ครบ', {
                    timeOut: 5000
                });
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
                url: "orders/edit/" + id,
                method: 'GET',
                success: function(res) {
                    console.log(res);
                    $('#EditLot').val(res.data.order_number);
                    $('#EditProduct').val(res.data.pid).change();
                    $("select[name=eproduct]").attr("readonly", "readonly");
                    $('#EditStock').val(res.data.sid).change();
                    $("select[name=estock]").attr("readonly", "readonly");
                    $('#EditCompany').val(res.data.cid).change();
                    $('#EditAmount').val(res.data.amount);
                    $('#EditCost').val(res.data.cost);
                    $('#EditTotalCost').val(res.data.total_cost);
                    $('#EditDetail').val(res.data.detail);
                    $('#EditModalBodyTable').html(res.table_html);
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

            var stockValues = [];
            var amountValues = [];
            var priceValues = [];
            var isValid = true;

            // Initializing array values
            $("select[name='estock[]']").each(function() {
                stockValues.push(this.value);
            });

            // Check for duplicates in stock values
            var duplicateValues = stockValues.filter(function(value, index, self) {
                return self.indexOf(value) !== index;
            });

            if (duplicateValues.length > 0) {
                toastr.error('ไม่สามารถเลือกสินค้าล็อตเดียวกันในรายการขาย', {
                    timeOut: 5000
                });
                return false;
            }

            // Validate stock select
            var stockSelects = $("select[name='estock[]']");
            stockSelects.each(function() {
                var stockSelect = $(this);
                var selectedValue = stockSelect.val();

                if (selectedValue === null || selectedValue.trim() === '') {
                    stockSelect.addClass("is-invalid");
                    stockSelect.removeClass("is-valid");
                    toastr.error('กรุณาเลือกสินค้าในคลังสินค้า', {
                        timeOut: 5000
                    });
                    isValid = false;
                } else {
                    stockSelect.removeClass("is-invalid");
                    stockSelect.addClass("is-valid");
                }
            });

            if (!isValid) {
                return false;
            }

            // Collect amount values and validate
            $("input[name='eamount[]']").each(function() {
                var amountInput = $(this);
                var value = parseFloat(amountInput.val());

                if (isNaN(value) || value % 0.5 !== 0) {
                    // Invalid amount input
                    amountInput.addClass("is-invalid");
                    amountInput.removeClass("is-valid");
                    amountInput.siblings(".error-message").text(
                        "กรุณาระบุจำนวนที่จะขาย");
                    toastr.error('กรุณาระบุจำนวนที่จะขาย', {
                        timeOut: 5000
                    });
                    isValid = false;
                } else {
                    // Valid amount input
                    amountInput.removeClass("is-invalid");
                    amountInput.addClass("is-valid");
                    amountValues.push(value);
                }
            });

            if (!isValid) {
                return false;
            }

            // Collect price values and validate
            $("input[name='eprice[]']").each(function() {
                var priceInput = $(this);
                var value = parseFloat(priceInput.val());

                if (isNaN(value) || value <= 0) {
                    // Invalid price input
                    priceInput.addClass("is-invalid");
                    priceInput.removeClass("is-valid");
                    priceInput.siblings(".error-message").text(
                        "กรุณาระบุราคาที่จะขาย");
                    toastr.error('กรุณาระบุราคาที่จะขาย', {
                        timeOut: 5000
                    });
                    isValid = false;
                } else {
                    // Valid price input
                    priceInput.removeClass("is-invalid");
                    priceInput.addClass("is-valid");
                    priceValues.push(value);
                }
            });

            if (!isValid) {
                return false;
            }

            if ($('#EditCompany').val()[0] !== undefined) {
                var formData = {
                    order_number: $('#EditLot').val(),
                    sid: stockValues, // Only consider the first selected stock value
                    cid: $('#EditCompany').val()[0],
                    pid: $('#EditProduct').val()[0],
                    amount: amountValues,
                    price: priceValues,
                    tamount: $('#EditAmount').val(),
                    //cost: $('#AddCost').val(),
                    total_cost: $('#EditTotalCost').val(),
                    detail: $('#EditDetail').val(),
                    _token: token
                };

                $.ajax({
                    url: "orders/save/" + id,
                    method: 'PUT',
                    data: formData,

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
            } else {
                toastr.error('กรุณากรอกข้อมูลให้ครบ', {
                    timeOut: 5000
                });
            }
        });

        $(document).on('click', '.btn-delete', function() {
            if (!confirm("ยืนยันการทำรายการ ?")) return;

            var rowid = $(this).data('rowid')
            var el = $(this)
            if (!rowid) return;


            $.ajax({
                type: "POST",
                dataType: 'JSON',
                url: "orders/destroy/",
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

    $(function() {

        $("#addRow").click(function() {
            // ส่วนของการ clone ข้อมูลด้วย jquery clone() ค่า true คือ
            // การกำหนดให้ ไม่ต้องมีการ ดึงข้อมูลจากค่าเดิมมาใช้งาน
            // รีเซ้ตเป็นค่าว่าง ถ้ามีข้อมูลอยู่แล้ว ทั้ง select หรือ input
            // $(".firstTr1:eq(0)").clone(true)
            //     .find("input").attr("value", "").end()
            //     .find("select").attr("value", "").end()
            //     .appendTo($("#myTbl"));
            $(".firstTr:eq(0)").clone(true)

                .find("input").attr("value", "").end()
                .find("select").attr("value", "").end()
                .appendTo($("#myTbl"));


            efatotal();

        });
        $("#removeRow").click(function() {
            // // ส่วนสำหรับการลบ
            if ($("#myTbl tr").length > 2) { // จะลบรายการได้ อย่างน้อย ต้องมี 1 รายการ
                $("#myTbl tr:last").remove(); // ลบรายการสุดท้าย
                efatotal();
            } else {
                // เหลือ 1 รายการลบไม่ได้
                if ($("#myTbl tr").length > 1) {
                    //alert("ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ");
                    toastr.success('ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ', {
                        timeOut: 5000
                    });
                }
            }
        });
        $(document).on('click', '.btnRemoveg', function() {
            // // ส่วนสำหรับการลบ
            if ($("#myTbl tr").length > 2) { // จะลบรายการได้ อย่างน้อย ต้องมี 1 รายการ
                //$("#myTbl tr:last").remove(); // ลบรายการสุดท้าย
                $(this).closest("tr").remove();
                efatotal();
            } else {
                // เหลือ 1 รายการลบไม่ได้
                if ($("#myTbl tr").length > 1) {
                    //alert("ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ");
                    toastr.success('ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ', {
                        timeOut: 5000
                    });
                }
            }
        });

        $("#addRow2").click(function() {
            // ส่วนของการ clone ข้อมูลด้วย jquery clone() ค่า true คือ
            // การกำหนดให้ ไม่ต้องมีการ ดึงข้อมูลจากค่าเดิมมาใช้งาน
            // รีเซ้ตเป็นค่าว่าง ถ้ามีข้อมูลอยู่แล้ว ทั้ง select หรือ input
            $(".firstTr3:eq(0)").clone(true)

                .find("input").attr("value", "").end()
                .find("select").attr("value", "").end()
                .appendTo($("#myTbl3"));

            fatotal();
        });
        $("#removeRow2").click(function() {
            // // ส่วนสำหรับการลบ
            if ($("#myTbl3 tr").length > 2) { // จะลบรายการได้ อย่างน้อย ต้องมี 1 รายการ
                $("#myTbl3 tr:last").remove(); // ลบรายการสุดท้าย
                fatotal();
            } else {
                // เหลือ 1 รายการลบไม่ได้
                if ($("#myTbl3 tr").length > 1) {
                    //alert("ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ");
                    toastr.success('ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ', {
                        timeOut: 5000
                    });
                }
            }
        });
        $(".btnRemoveg2").click(function() {
            // // ส่วนสำหรับการลบ
            if ($("#myTbl3 tr").length > 2) { // จะลบรายการได้ อย่างน้อย ต้องมี 1 รายการ
                //$("#myTbl tr:last").remove(); // ลบรายการสุดท้าย
                $(this).closest("tr").remove();
                fatotal();
            } else {
                // เหลือ 1 รายการลบไม่ได้
                if ($("#myTbl3 tr").length > 1) {
                    //alert("ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ");
                    toastr.success('ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ', {
                        timeOut: 5000
                    });
                }
            }
        });

        $(this).closest(".abcd").remove();

    });
</script>
