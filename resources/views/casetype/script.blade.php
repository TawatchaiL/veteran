<script>
    $(document).ready(function() {
        //$.noConflict();
        var token = ''
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //$(document).on('click', '#CreateButton', function(e) {
        //    e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();
            $('.form').trigger('reset');

            $.ajax({
                url: "casetype/casetype/0",
                method: 'GET',
                success: function(res) {
                    var provinceOb = $('#casetype1');
                    provinceOb.html('<option value="">เลือกประเภทการติดต่อ</option>');
                    var countres = res.data.length - 1;
                    $('#targettext').html('');
                    $.each(res.data, function(index, item) {
                        provinceOb.append(
                            $('<option></option>').val(item.id).html(item.name)
                        );
                        htmltargettext = '<div class="row mb-3"><div class="col-xs-12 col-sm-12 col-md-12"><div class="input-group">'
                                    + '<input type="text" class="form-control has-feedback-left text-editcasetype" id="editcasetype' + item.id + '" value="' + item.name + '" required="required" disabled>' 
                                    + '&nbsp;<button type="button" class="btn btn-success btn-editcasetype" id="btneditcasetype' + item.id + '" data-id="' + item.id + '"><i class="fa-regular fa-pen-to-square"></i>แก้ไข</button>' 
                                    + '&nbsp;<button type="button" class="btn btn-warning btn-editcancel" id="btneditcancel' + item.id + '" data-id="' + item.id + '" data-oldvalue="' + item.name + '" disabled><i class="fa-regular fa-rectangle-xmark"></i>ยกเลิก</button>' 
                                    + '&nbsp;<button type="button" class="btn btn-danger btn-casetypedelete" id="btncasetypedelete' + item.id + '" data-id="' + item.id + '" data-pid="' + item.parent_id + '" data-crmlev="' + item.crmlev + '"><i class="fa-regular fa-trash-can"></i>ลบ</button>'; 
                                    if(index > 0){
                                        htmltargettext += '&nbsp;<button type="button" class="btn btn-primary btn-editup" data-id="' + item.id + '" data-crmlist="' + item.crmlist + '" data-upid="' + res.data[index-1].id + '" data-upcrmlist="' + res.data[index-1].crmlist + '" data-pid="' + item.parent_id + '" data-crmlev="' + item.crmlev + '"><i class="fa-solid fa-angle-up"></i></button>'; 
                                    }else{
                                        htmltargettext += '&nbsp;<button type="button" class="btn btn-primary" data-id="' + item.id + '" disabled><i class="fa-solid fa-angle-up"></i></button>';     
                                    }
                                    if(index < countres){
                                        htmltargettext += '&nbsp;<button type="button" class="btn btn-primary btn-editdown" data-id="' + item.id + '" data-crmlist="' + item.crmlist + '" data-downid="' + res.data[index+1].id + '" data-downcrmlist="' + res.data[index+1].crmlist + '" data-pid="' + item.parent_id + '" data-crmlev="' + item.crmlev + '"><i class="fa-solid fa-angle-down"></i></button>'; 
                                    }else{
                                        htmltargettext += '&nbsp;<button type="button" class="btn btn-primary" data-id="' + item.id + '" disabled><i class="fa-solid fa-angle-down"></i></button>';     
                                    }
                                    htmltargettext += '</div></div></div>';
                        $('#targettext').append(htmltargettext);
                    });
                        $('#targettext').append(
                            '<div class="row mb-3"><div class="col-xs-12 col-sm-12 col-md-12"><div class="input-group">'
                                 + '<input type="text" class="form-control has-feedback-left newcasetype" value="" id="textnewcasetype" required="required">' 
                                 + '&nbsp;<button type="button" class="btn btn-success btn-newcasetype" data-pid="0" data-crmlev="1"><i class="fa-solid fa-plus"></i>เพิ่ม</button>' 
                                 + '</div></div></div>');
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
        //});

        $(document).on("change", ".casetypechang", function() {
            let levcase = $(this).data("lev");
            let parent_id = $(this).val();
            let nextcase = levcase + 1;
            let discase = nextcase + 1;
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
            if (parent_id != '' && levcase < 6) {
                if(parent_id != ''){
                    $.ajax({
                        url: "casetype/casetype/" + parent_id,
                        method: 'GET',
                        async: false,
                        success: function(res) {
                            var caseOb = $('#casetype' + nextcase);
                                caseOb.attr('disabled', false);
                                var countres = res.data.length - 1;
                                $('#targettext').html('');
                            $.each(res.data, function(index, item) {
                                caseOb.append(
                                    $('<option></option>').val(item.id).html(item.name)
                                );
                                htmltargettext = '<div class="row mb-3"><div class="col-xs-12 col-sm-12 col-md-12"><div class="input-group">'
                                    + '<input type="text" class="form-control has-feedback-left text-editcasetype" id="editcasetype' + item.id + '" value="' + item.name + '" required="required" disabled>' 
                                    + '&nbsp;<button type="button" class="btn btn-success btn-editcasetype" id="btneditcasetype' + item.id + '" data-id="' + item.id + '"><i class="fa-regular fa-pen-to-square"></i>แก้ไข</button>' 
                                    + '&nbsp;<button type="button" class="btn btn-warning btn-editcancel" id="btneditcancel' + item.id + '" data-id="' + item.id + '" data-oldvalue="' + item.name + '" disabled><i class="fa-regular fa-rectangle-xmark"></i>ยกเลิก</button>'
                                    + '&nbsp;<button type="button" class="btn btn-danger btn-casetypedelete" id="btncasetypedelete' + item.id + '" data-id="' + item.id + '" data-pid="' + item.parent_id + '" data-crmlev="' + item.crmlev + '"><i class="fa-regular fa-trash-can"></i>ลบ</button>'; 
                                    if(index > 0){
                                        htmltargettext += '&nbsp;<button type="button" class="btn btn-primary btn-editup" data-id="' + item.id + '" data-crmlist="' + item.crmlist + '" data-upid="' + res.data[index-1].id + '" data-upcrmlist="' + res.data[index-1].crmlist + '" data-pid="' + item.parent_id + '" data-crmlev="' + item.crmlev + '"><i class="fa-solid fa-angle-up"></i></button>'; 
                                    }else{
                                        htmltargettext += '&nbsp;<button type="button" class="btn btn-primary" data-id="' + item.id + '" disabled><i class="fa-solid fa-angle-up"></i></button>';     
                                    }
                                    if(index < countres){
                                        htmltargettext += '&nbsp;<button type="button" class="btn btn-primary btn-editdown" data-id="' + item.id + '" data-crmlist="' + item.crmlist + '" data-downid="' + res.data[index+1].id + '" data-downcrmlist="' + res.data[index+1].crmlist + '" data-pid="' + item.parent_id + '" data-crmlev="' + item.crmlev + '"><i class="fa-solid fa-angle-down"></i></button>'; 
                                    }else{
                                        htmltargettext += '&nbsp;<button type="button" class="btn btn-primary" data-id="' + item.id + '" disabled><i class="fa-solid fa-angle-down"></i></button>';     
                                    }
                                    htmltargettext += '</div></div></div>';
                                $('#targettext').append(htmltargettext);
                            });
                            for (let i = discase; i < 7; i++) {
                                $('#casetype' + i).attr('disabled', true);
                                $('#case' + i).hide();
                            }
                                $('#targettext').append(
                                '<div class="row mb-3"><div class="col-xs-12 col-sm-12 col-md-12"><div class="input-group">'
                                    + '<input type="text" class="form-control has-feedback-left newcasetype" id="textnewcasetype" value="" required="required">' 
                                    + '&nbsp;<button type="button" class="btn btn-success btn-newcasetype" data-pid="' + parent_id + '" data-crmlev="' + nextcase + '"><i class="fa-solid fa-plus"></i>เพิ่ม</button>' 
                                    + '</div></div></div>');
                        }
                    });
                }

            } else {
        
                let backcase = levcase - 1;
                if(levcase > 1){
                    parent_id = $('#casetype' + backcase).val();
                }else{
                    parent_id = 0;
                }
                $.ajax({
                        url: "casetype/casetype/" + parent_id,
                        method: 'GET',
                        async: false,
                        success: function(res) {
                            var caseOb = $('#casetype' + nextcase);
                                caseOb.attr('disabled', false);
                            var countres = res.data.length - 1;
                                $('#targettext').html('');
                            $.each(res.data, function(index, item) {
                                htmltargettext = '<div class="row mb-3"><div class="col-xs-12 col-sm-12 col-md-12"><div class="input-group">'
                                    + '<input type="text" class="form-control has-feedback-left text-editcasetype" id="editcasetype' + item.id + '" value="' + item.name + '" required="required" disabled>' 
                                    + '&nbsp;<button type="button" class="btn btn-success btn-editcasetype" id="btneditcasetype' + item.id + '" data-id="' + item.id + '"><i class="fa-regular fa-pen-to-square"></i>แก้ไข</button>' 
                                    + '&nbsp;<button type="button" class="btn btn-warning btn-editcancel" id="btneditcancel' + item.id + '" data-id="' + item.id + '" data-oldvalue="' + item.name + '" disabled><i class="fa-regular fa-rectangle-xmark"></i>ยกเลิก</button>'
                                    + '&nbsp;<button type="button" class="btn btn-danger btn-casetypedelete" id="btncasetypedelete' + item.id + '" data-id="' + item.id + '" data-pid="' + item.parent_id + '" data-crmlev="' + item.crmlev + '"><i class="fa-regular fa-trash-can"></i>ลบ</button>'; 
                                    if(index > 0){
                                        htmltargettext += '&nbsp;<button type="button" class="btn btn-primary btn-editup" data-id="' + item.id + '" data-crmlist="' + item.crmlist + '" data-upid="' + res.data[index-1].id + '" data-upcrmlist="' + res.data[index-1].crmlist + '" data-pid="' + item.parent_id + '" data-crmlev="' + item.crmlev + '"><i class="fa-solid fa-angle-up"></i></button>'; 
                                    }else{
                                        htmltargettext += '&nbsp;<button type="button" class="btn btn-primary" data-id="' + item.id + '" disabled><i class="fa-solid fa-angle-up"></i></button>';     
                                    }
                                    if(index < countres){
                                        htmltargettext += '&nbsp;<button type="button" class="btn btn-primary btn-editdown" data-id="' + item.id + '" data-crmlist="' + item.crmlist + '" data-downid="' + res.data[index+1].id + '" data-downcrmlist="' + res.data[index+1].crmlist + '" data-pid="' + item.parent_id + '" data-crmlev="' + item.crmlev + '"><i class="fa-solid fa-angle-down"></i></button>'; 
                                    }else{
                                        htmltargettext += '&nbsp;<button type="button" class="btn btn-primary" data-id="' + item.id + '" disabled><i class="fa-solid fa-angle-down"></i></button>';     
                                    }
                                    htmltargettext += '</div></div></div>';
                                $('#targettext').append(htmltargettext);
                            });
                        }

                    });
                for (let d = nextcase; d < 7; d++) {
                                $('#casetype' + d).attr('disabled', true);
                                $('#case' + d).hide();
                    }
                    $('#targettext').append(
                    '<div class="row mb-3"><div class="col-xs-12 col-sm-12 col-md-12"><div class="input-group">'
                        + '<input type="text" class="form-control has-feedback-left newcasetype" id="textnewcasetype" value="" required="required">' 
                        + '&nbsp;<button type="button" class="btn btn-success btn-newcasetype" data-pid="' + parent_id + '" data-crmlev="' + levcase + '"><i class="fa-solid fa-plus"></i>เพิ่ม</button>' 
                        + '</div></div></div>');
            }
        });

        $(document).on("click", ".btn-editcasetype", function() {
            var id = $(this).data("id");
            $('.btn-editcasetype').attr('disabled', true);
            $('.btn-editup').attr('disabled', true);
            $('.btn-editdown').attr('disabled', true);
            $('.btn-newcasetype').attr('disabled', true);
            $('.btn-casetypedelete').attr('disabled', true);
            $('#editcasetype' + id).prop('disabled', false);
            $('#btneditcasetype' + id).html('<i class="fa-regular fa-pen-to-square"></i>บันทึก').prop('disabled', false).addClass("btn-savecasetype");
            $('#btneditcancel' + id).prop('disabled', false);
        });

        $(document).on("click", ".btn-editcancel", function() {
            var id = $(this).data("id");
            var oldvalue = $(this).data("oldvalue");
            var thisvalue = $('#editcasetype' + id).val();
            if(oldvalue != thisvalue){
                $('#editcasetype' + id).val(oldvalue);
            }
            $('#editcasetype' + id).attr('disabled', true);
            $('.btn-editup').prop('disabled', false);
            $('.btn-editdown').prop('disabled', false);
            $('.btn-newcasetype').prop('disabled', false);
            $('.btn-casetypedelete').prop('disabled', false);
            $('#btneditcasetype' + id).html('<i class="fa-regular fa-pen-to-square"></i>แก้ไข').removeClass("btn-savecasetype");
            $('.btn-editcasetype').prop('disabled', false);
            $(this).attr('disabled', true);
        });

        $(document).on("click", ".btn-savecasetype", function() {
            var id = $(this).data("id");
            $.ajax({
                url: "casetype/save/" + id,
                method: 'PUT',
                data: {
                    name: $('#editcasetype' + id).val(),
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
                        $('#btneditcasetype' + id).html('<i class="fa-regular fa-pen-to-square"></i>แก้ไข').removeClass("btn-savecasetype");
                        $('#editcasetype' + id).attr('disabled', true);
                        $('#btneditcancel' + id).attr('disabled', true);
                        $('.btn-editcasetype').prop('disabled', false);
                        $('.btn-newcasetype').prop('disabled', false);
                        $('.btn-casetypedelete').prop('disabled', false);
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.alert-success').append('<strong><li>' + result.success +
                            '</li></strong>');
                    }
                }
            });
        });

        $(document).on("click", ".btn-newcasetype", function() {
            var id = $(this).data("id");
            var pid = $(this).data("pid");
            var crmlev = $(this).data("crmlev");
            $.ajax({
                url: "{{ route('casetype.store') }}",
                method: 'post',
                data: {
                    parent_id: pid,
                    name: $('#textnewcasetype').val(),
                    crmlev: crmlev,
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
                        $('#textnewcasetype').val('');
                        $('.alert-success').html('');
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.alert-success').append('<strong><li>' + result.success + '</li></strong>');
                        loadcrm(pid, crmlev);
                    }
                }
            });
        });

        $(document).on('click', '.btn-casetypedelete', function() {
            if (!confirm("ยืนยันการทำรายการ ?")) return;
            var id = $(this).data("id");
            var pid = $(this).data("pid");
            var crmlev = $(this).data("crmlev");
            if (!id) return;
            $.ajax({
                type: "POST",
                dataType: 'JSON',
                url: "casetype/destroy",
                data: {
                    id: id,
                    _method: 'delete',
                    _token: token
                },
                success: function(data) {
                    if (data.success) {
                        $('.alert-success').html('');
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.alert-success').append('<strong><li>' + data.message +
                            '</li></strong>');
                            loadcrm(pid, crmlev);
                    }else{
                        $('.alert-danger').html('');
                        $('.alert-danger').show();
                        $('.alert-danger').append('<strong><li>' + data.message +
                            '</li></strong>');
                    }
                }
            });
        });

        $(document).on("click", ".btn-editup", function() {
            var id = $(this).data("id");
            var crmlist = $(this).data("crmlist");
            var upid = $(this).data("upid");
            var upcrmlist = $(this).data("upcrmlist");
            var pid = $(this).data("pid");
            var crmlev = $(this).data("crmlev");
            $.ajax({
                url: "casetype/crmmoveup",
                method: 'PUT',
                data: {
                    id: id,
                    crmlist: crmlist,
                    upid: upid,
                    upcrmlist: upcrmlist,
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
                        $('.alert-success').html('');
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.alert-success').append('<strong><li>' + result.success +
                            '</li></strong>');
                            loadcrm(pid, crmlev);
                    }
                }
            });
        });

        $(document).on("click", ".btn-editdown", function() {
            var id = $(this).data("id");
            var crmlist = $(this).data("crmlist");
            var downid = $(this).data("downid");
            var downcrmlist = $(this).data("downcrmlist");
            var pid = $(this).data("pid");
            var crmlev = $(this).data("crmlev");
            $.ajax({
                url: "casetype/crmmovedown",
                method: 'PUT',
                data: {
                    id: id,
                    crmlist: crmlist,
                    upid: downid,
                    upcrmlist: downcrmlist,
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
                        $('.alert-success').html('');
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.alert-success').append('<strong><li>' + result.success +
                            '</li></strong>');
                            loadcrm(pid, crmlev);
                    }
                }
            });
        });
        
    });
    function loadcrm(pid, crmlev){
        $.ajax({
            url: "casetype/casetype/" + pid,
            method: 'GET',
            async: false,
            success: function(res) {
                if (crmlev === 1) {
                    $('#casetype1').html('<option value="">เลือกประเภทการติดต่อ</option>');
                }
                if (crmlev === 2) {
                    $('#casetype2').html('<option value="">เลือกรายละเอียดเคส</option>');
                }
                if (crmlev === 3) {
                    $('#casetype3').html(
                        '<option value="">เลือกรายละเอียดเคสย่อย</option>');
                }
                if (crmlev === 4) {
                    $('#casetype4').html(
                        '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>');
                }
                if (crmlev === 5) {
                    $('#casetype5').html(
                        '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
                }
                if (crmlev === 6) {
                    $('#casetype6').html(
                        '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
                }
                var caseOb = $('#casetype' + crmlev);
                caseOb.attr('disabled', false);
                var countres = res.data.length - 1;
                $('#targettext').html('');
                $.each(res.data, function(index, item) {
                    caseOb.append(
                        $('<option></option>').val(item.id).html(item.name)
                    );
                    htmltargettext = '<div class="row mb-3"><div class="col-xs-12 col-sm-12 col-md-12"><div class="input-group">'
                        + '<input type="text" class="form-control has-feedback-left text-editcasetype" id="editcasetype' + item.id + '" value="' + item.name + '" required="required" disabled>' 
                        + '&nbsp;<button type="button" class="btn btn-success btn-editcasetype" id="btneditcasetype' + item.id + '" data-id="' + item.id + '"><i class="fa-regular fa-pen-to-square"></i>แก้ไข</button>' 
                        + '&nbsp;<button type="button" class="btn btn-warning btn-editcancel" id="btneditcancel' + item.id + '" data-id="' + item.id + '" data-oldvalue="' + item.name + '" disabled><i class="fa-regular fa-rectangle-xmark"></i>ยกเลิก</button>'
                        + '&nbsp;<button type="button" class="btn btn-danger btn-casetypedelete" id="btncasetypedelete' + item.id + '" data-id="' + item.id + '" data-pid="' + item.parent_id + '" data-crmlev="' + item.crmlev + '"><i class="fa-regular fa-trash-can"></i>ลบ</button>'; 
                        if(index > 0){
                            htmltargettext += '&nbsp;<button type="button" class="btn btn-primary btn-editup" data-id="' + item.id + '" data-crmlist="' + item.crmlist + '" data-upid="' + res.data[index-1].id + '" data-upcrmlist="' + res.data[index-1].crmlist + '" data-pid="' + item.parent_id + '" data-crmlev="' + item.crmlev + '"><i class="fa-solid fa-angle-up"></i></button>'; 
                        }else{
                            htmltargettext += '&nbsp;<button type="button" class="btn btn-primary" data-id="' + item.id + '" disabled><i class="fa-solid fa-angle-up"></i></button>';     
                        }
                        if(index < countres){
                            htmltargettext += '&nbsp;<button type="button" class="btn btn-primary btn-editdown" data-id="' + item.id + '" data-crmlist="' + item.crmlist + '" data-downid="' + res.data[index+1].id + '" data-downcrmlist="' + res.data[index+1].crmlist + '" data-pid="' + item.parent_id + '" data-crmlev="' + item.crmlev + '"><i class="fa-solid fa-angle-down"></i></button>'; 
                        }else{
                            htmltargettext += '&nbsp;<button type="button" class="btn btn-primary" data-id="' + item.id + '" disabled><i class="fa-solid fa-angle-down"></i></button>';     
                        }
                        htmltargettext += '</div></div></div>';
                    $('#targettext').append(htmltargettext);
                });
                $('#targettext').append(
                        '<div class="row mb-3"><div class="col-xs-12 col-sm-12 col-md-12"><div class="input-group">'
                            + '<input type="text" class="form-control has-feedback-left newcasetype" id="textnewcasetype" value="" required="required">' 
                            + '&nbsp;<button type="button" class="btn btn-success btn-newcasetype" data-pid="' + pid + '" data-crmlev="' + crmlev + '"><i class="fa-solid fa-plus"></i>เพิ่ม</button>' 
                            + '</div></div></div>');
            }
        });
    }
    
</script>
