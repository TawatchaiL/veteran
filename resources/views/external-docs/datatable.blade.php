<script>
    var table;
    $(document).ready(function() {
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
            iDisplayLength: 10,
            lengthMenu: [10, 25, 50, 75, 100],
            stateSave: true,
            autoWidth: false,
            fixedHeader: true,
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
            sPaginationType: "full_numbers",
            dom: 'T<"clear">lfrtip',
            columns: [{
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'cname',
                    name: 'cname'
                },
                {
                    data: 'doc_receive_number',
                    name: 'doc_receive_number'
                },
                {
                    data: 'subject',
                    name: 'subject'
                },
                {
                    data: 'signdate',
                    name: 'signdate'
                },
                {
                    data: 'priorities',
                    name: 'priorities'
                },
                {
                    data: 'uname',
                    name: 'uname'
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


        let rid;
        let rid2;
        $(document).on('click', '#getDeleteData', function(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();
            rid = $(this).data('id');
            rid2 = $(this).data('id2');
            if (confirm("Click OK to Delete?")) {
                $.ajax({
                    url: "external-docs/delete/img/" + rid + "/" + rid2,
                    method: 'PUT',
                    // async : false,
                    success: function(res) {
                        toastr.success('ลบไฟล์เรียบร้อยแล้ว', {
                            timeOut: 5000
                        });
                        console.log(res);
                        $('.imgs').html(res.imgs);
                        $('#file_preview').empty();
                        $('#file_preview').html(res.iframes);
                        $('#editdata [name="imgFiles3[]"]').remove();
                        $('#editdata').append(res.inputf);

                    }
                })
            }
        })


        $(document).on('click', '.btn-delete', function() {
            if (!confirm("ยืนยันการทำรายการ ?")) return;

            var rowid = $(this).data('rowid')
            var el = $(this)
            if (!rowid) return;


            $.ajax({
                //type: "POST",
                method: 'DELETE',
                dataType: 'JSON',
                url: "external-docs/destroy/",
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
