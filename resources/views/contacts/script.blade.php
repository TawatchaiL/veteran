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
                    data: 'adddate',
                    name: 'adddate'
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
            $.ajax({
                    url: "{{ route('thcity.city') }}",
                    method: 'GET',
                    success: function(res) {
                        //alert(res.data.code);
                        var provinceOb = $('#Addcity');
                        provinceOb.html('<option value="">เลือกจังหวัด</option>');
                        $.each(res.data, function(index, item){
                        provinceOb.append(
                            $('<option></option>').val(item.code).html(item.name_th)
                        );
                        });
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

            var additionalData = {
                hn: $('#Addhn').val(),
                adddate: $('#Addadddate').val(),
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
                emergencyData: emergencyData
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

            id = $(this).data('id');
            $.ajax({
                    url: "{{ route('thcity.city') }}",
                    method: 'GET',
                    success: function(res) {
                        //alert(res.data.code);
                        var provinceOb = $('#Editecity');
                        provinceOb.html('<option value="">เลือกจังหวัด</option>');
                        $.each(res.data, function(index, item){
                        provinceOb.append(
                            $('<option></option>').val(item.code).html(item.name_th)
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
                        $('#Editadddate').val(res.datax.datac.adddate);
                        $('#Editfname').val(res.datax.datac.fname);
                        $('#Editlname').val(res.datax.datac.lname);
                        $('#Edithomeno').val(res.datax.datac.homeno);
                        $('#Editmoo').val(res.datax.datac.moo);
                        $('#Editsoi').val(res.datax.datac.soi);
                        $('#Editroad').val(res.datax.datac.road);
                        $('#Editecity').val(res.datax.datac.city);
                        $('#Editecity').change();
                        setTimeout(function() {
                            $('#Editedistrict').val(res.datax.datac.district);
                            $('#Editedistrict').change();
                            setTimeout(function() {
                            $('#Editesubdistrict').val(res.datax.datac.subdistrict);
                            }, 1000)
                        }, 1000)
                        $('#Editedistrict').val(res.datax.datac.district);
                        $('#Editpostcode').val(res.datax.datac.postcode);
                        $('#Edittelhome').val(res.datax.datac.telhome);
                        $('#Editphoneno').val(res.datax.datac.phoneno);
                        $('#Editworkno').val(res.datax.datac.workno);
                        alert(res.datax.emer[0].emergencyname);
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
$('#addRowBtn').click(function() {
				$('#myTbl3').append($('<tr>')
				  .append($('<td width="30%">').append('<div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="emergencyname" name="emergencyname[]" class="form-control has-feedback-left" value="" required="required"></div>'))
				  .append($('<td width="10%">').append('<div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="emerrelation" name="emerrelation[]" class="form-control has-feedback-left" value="" required="required"></div>'))
				  .append($('<td width="10%">').append('<div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="emerphone" name="emerphone[]" class="form-control has-feedback-left" value="" required="required"></div>'))			   
				  .append($('<td width="5%">').append('<button type="button" name="deletem" id="deletem" class="btn btn-sm btn-danger removeRowBtn" onclick="$(this).closest(\'tr\').remove();\"><i class="fa fa-minus"></i></button>')));
});

    $(function(){
	
    var provinceOb = $('#Addcity');
	var districtOb = $('#Adddistrict');
	var cartonOb = $('#Addsubdistrict');
		
    // on change province
    $('#Addcity').on('change', function(){
        var provinceId = $(this).val();
        districtOb.html('<option value="">เลือกอำเภอ</option>');
        $.ajax({
                    url: "thdistrict/district/" + provinceId,
                    method: 'GET',
                    success: function(res) {
                        districtOb.html('<option value="">เลือกอำเภอ</option>');
                        cartonOb.html('<option value="">เลือกตำบล</option>');
                        $.each(res.data, function(index, item){
                            districtOb.append(
                            $('<option></option>').val(item.code).html(item.name_th)
                        );
                        });
                    }
        });
    });
    districtOb.on('change', function(){
        var districtId = $(this).val();
        cartonOb.html('<option value="">เลือกตำบล</option>');
        $.ajax({
            url: "thsubdistrict/subdistrict/" + districtId,
                    method: 'GET',
                    success: function(res) {
                        cartonOb.html('<option value="">เลือกตำบล</option>');
                        $.each(res.data, function(index, item){
                            cartonOb.append(
                            $('<option></option>').val(item.code).html(item.name_th)
                        );
                        });
                    }
        });
    });

    var EprovinceOb = $('#Editecity');
	var EdistrictOb = $('#Editedistrict');
	var EcartonOb = $('#Editesubdistrict');
		
    // Edit
    $('#Editecity').on('change', function(){
        var provinceId = $(this).val();
        EdistrictOb.html('<option value="">เลือกอำเภอ</option>');
        $.ajax({
                    url: "thdistrict/district/" + provinceId,
                    method: 'GET',
                    success: function(res) {
                        EdistrictOb.html('<option value="">เลือกอำเภอ</option>');
                        EcartonOb.html('<option value="">เลือกตำบล</option>');
                        $.each(res.data, function(index, item){
                            EdistrictOb.append(
                            $('<option></option>').val(item.code).html(item.name_th)
                        );
                        });
                    }
        });
    });
    EdistrictOb.on('change', function(){
        var districtId = $(this).val();
        EcartonOb.html('<option value="">เลือกตำบล</option>');
        $.ajax({
            url: "thsubdistrict/subdistrict/" + districtId,
                    method: 'GET',
                    success: function(res) {
                        EcartonOb.html('<option value="">เลือกตำบล</option>');
                        $.each(res.data, function(index, item){
                            EcartonOb.append(
                            $('<option></option>').val(item.code).html(item.name_th)
                        );
                        });
                    }
        });
    });
});	
</script>
