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

        $(".AddDate").datepicker({
            dateFormat: "yy-mm-dd"
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
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'telephone',
                    name: 'telephone'
                },
                {
                    data: 'mobile',
                    name: 'mobile'
                },
                {
                    data: 'create_at',
                    name: 'create_at'
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
            $.ajax({
                method: "GET",
                url: "{{ route('contacts.running') }}",
                success: function(res) {
                    console.log(res)
                    $('#AddCode').val(res.running);
                }
            });
            $('#CreateModal').modal('show');
        });



        // Create product Ajax request.
        $('#SubmitCreateForm').click(function(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();


            $.ajax({
                url: "{{ route('contacts.store') }}",
                method: 'post',
                data: {
                    hn: $('#Addhn').val(),
                    fname: $('#Addfname').val(),
                    lname: $('#Addlname').val(),
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

            //id = $(this).data('id');
            //$.ajax({
            //    url: "contacts/edit/" + id,
            //    method: 'GET',
            //    success: function(res) {
            //        $('#EditName').val(res.data.name);
            //        $('#EditPostcode').val(res.data.postcode);
            //        $('#EditAddress').val(res.data.address);
            //        $('#postcode').val('1');
            //
            //                    $('#EditModalBody').html(res.html);
            $('#EditModal').modal('show');
            //    }
            //});

        })

        $('#SubmitEditForm').click(function(e) {
            if (!confirm("ยืนยันการทำรายการ ?")) return;
            e.preventDefault();

            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();


            $.ajax({
                url: "contacts/save/" + id,
                method: 'PUT',
                data: {
                    name: $('#EditName').val(),
                    email: $('#EditEmail').val(),
                    postcode: $('#EditPostcode').val(),
                    address: $('#EditAddress').val(),
                    telephone: $('#EditTelephone').val(),
                },

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
    document.getElementById('addRowBtn').addEventListener('click', function() {
        var table = document.getElementById('myTbl3');

        var newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td width="30%">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" name="name[]" class="form-control has-feedback-left" value="" required>
                    <div id="lot_price" class="text-success"></div>
                    <div id="lot_error" class="text-danger"></div>
                </div>
            </td>
            <td width="10%">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" name="amount[]" class="form-control has-feedback-left" value="" required>
                </div>
            </td>
            <td width="10%">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" name="price[]" class="form-control has-feedback-left" value="" required>
                </div>
            </td>
            <td>
                <button type="button" id="removeRow2" class="btn btn-sm btn-danger removeRowBtn"><i
                                                        class="fa fa-minus"></i></button>
            </td>
        `;

        table.appendChild(newRow);

        newRow.querySelector('.removeRowBtn').addEventListener('click', function() {
            table.removeChild(newRow);
        });
    });
</script>
<script>
    document.getElementById('addRowBtne').addEventListener('click', function() {
        var table = document.getElementById('myTbl3e');

        var newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td width="30%">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" name="name[]" class="form-control has-feedback-left" value="" required>
                    <div id="lot_price" class="text-success"></div>
                    <div id="lot_error" class="text-danger"></div>
                </div>
            </td>
            <td width="10%">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" name="amount[]" class="form-control has-feedback-left" value="" required>
                </div>
            </td>
            <td width="10%">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" name="price[]" class="form-control has-feedback-left" value="" required>
                </div>
            </td>
            <td>
                <button type="button" id="removeRow2" class="btn btn-sm btn-danger removeRowBtn"><i class="fa fa-minus"></i></button>
            </td>
        `;

        table.appendChild(newRow);

        newRow.querySelector('.removeRowBtn').addEventListener('click', function() {
            table.removeChild(newRow);
        });
    });

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('deleteRowBtnf')) {
            var rowToRemove = event.target.parentNode.parentNode;
            rowToRemove.parentNode.removeChild(rowToRemove);
        }
    });
</script>
