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
            $('.form').trigger('reset');

            $.ajax({
                url: "casetype6/casetype/0",
                method: 'GET',
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
            $('#AddName2').attr('disabled', true);
            $('#AddName3').attr('disabled', true);
            $('#AddName4').attr('disabled', true);
            $('#AddName5').attr('disabled', true);
            $('#AddName6').attr('disabled', true);
            $('#typelev2').hide();
            $('#typelev3').hide();
            $('#typelev4').hide();
            $('#typelev5').hide();
            $('#typelev6').hide();
            $('#CreateModal').modal('show');
        });


        // Create product Ajax request.
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
            for (let c = 1; c < 7; c++) {
                if (!$('#AddName' + c).prop('disabled')) {
                    crmname = $('#AddName' + c).val();
                    l = c;
                    p = c - 1;
                    if(c == 1){
                        parent_id = 0;
                    }else{
                        parent_id = $('#casetype' + p).val();
                    }
                }
            }
            var additionalData = {
                parent_id: parent_id,
                name: crmname,
                crmlev: l,
                status: sstatus,
            };
            $.ajax({
                url: "{{ route('casetype6.store') }}",
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
                },
                error: function(result) {
                    alert('error; ' + result.responseText);

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
                url: "casetype6/edit/" + id,
                method: 'GET',
                success: function(res) {
                    console.log(res);
                    $('#EditName').val(res.data.name);
                    $('#EditModalBody').html(res.html);
                    if (res.data.status == 1) {
                        $('#ecustomCheckbox1').prop('checked', true);
                    } else {
                        $('#ecustomCheckbox1').prop('checked', false);
                    }
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
                url: "casetype6/save/" + id,
                method: 'PUT',
                data: {
                    name: $('#EditName').val(),
                    status: esstatus,
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
                type: "POST",
                dataType: 'JSON',
                url: "casetype6/destroy/",
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

        //$('#casetype'+1).on('change', function() {
        //        alert('OK');
        //});
        $(document).on("change", ".casetype6chang", function() {
            let levcase = $(this).data("lev");
            let parent_id = $(this).val();
            let nextcase = levcase + 1;
            let discase = nextcase + 1;
            if (parent_id != '' && levcase < 6) {
                for (let i = nextcase; i < 7; i++) {
                    if (i === 2) {
                        $('#casetype2').html('<option value="">เลือกรายละเอียดเคส</option>');
                    }
                    if (i === 3) {
                        $('#casetype3').html(
                            '<option value="">เลือกรายละเอียดเคสย่อย</option>');
                    }
                    if (i === 4) {
                        $('#casetype4').html(
                            '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>');
                    }
                    if (i === 5) {
                        $('#casetype5').html(
                            '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
                    }
                    if (i === 6) {
                        $('#casetype6').html(
                            '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
                    }
                }
                $.ajax({
                    url: "casetype6/casetype/" + parent_id,
                    method: 'GET',
                    async: false,
                    success: function(res) {
                        $.each(res.data, function(index, item) {
                            $('#casetype' + nextcase).append(
                                $('<option></option>').val(item.id)
                                .html(item.name)
                            );
                        });
                    }
                });

                $('#casetype' + nextcase).attr('disabled', false);
                $('#AddName' + nextcase).attr('disabled', false);
                $('#typelev' + nextcase).show();

                if(parent_id != ''){
                    $('#typelev' + levcase).hide();
                }else{
                    $('#typelev' + levcase).show();
                }
                
                for (let i = discase; i < 7; i++) {
                    $('#casetype' + i).attr('disabled', true);
                    $('#AddName' + i).attr('disabled', true);
                    $('#typelev' + i).hide();
                }
            } else {
                for (let i = nextcase; i < 7; i++) {
                    if (i === 2) {
                        $('#casetype2').html('<option value="">เลือกรายละเอียดเคส</option>');
                    }
                    if (i === 3) {
                        $('#casetype3').html(
                            '<option value="">เลือกรายละเอียดเคสย่อย</option>');
                    }
                    if (i === 4) {
                        $('#casetype4').html(
                            '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>');
                    }
                    if (i === 5) {
                        $('#casetype5').html(
                            '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
                    }
                    if (i === 6) {
                        $('#casetype6').html(
                            '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
                    }
                    $('#casetype' + i).attr('disabled', true);
                    $('#typelev' + i).hide();
                }
            }
        });
    });




    //function changecasetype(event) {
    //    var selectno = parseInt(event.target.name.substring(8, 9));
        //if(selectnext < 7){
    //        for (let i = selectno; i < 7; i++) {
    //            var selectnext = i + 1;
    //                if($('#casetype' + i).val() == ''){
    //                    $('#AddName' + i).attr('disabled', false);
    //                    $('#casetype' + selectnext).attr('disabled', true);
    //                    $('#AddName' + selectnext).attr('disabled', true);
    //                }else{
    //                    $('#AddName' + i).attr('disabled', true);
    //                    $('#casetype' + selectnext).attr('disabled', false);
    //                    $('#AddName' + selectnext).attr('disabled', true);
    //                }

                //$('#casetype' + selectnext).attr('disabled', true);
                //$('#AddName' + selectno).attr('disabled', true);

                //$('#casetype' + selectnext).attr('disabled', false);
                //$('#AddName' + selectnext).attr('disabled', false);
    //        }
        //}
    //}
</script>
