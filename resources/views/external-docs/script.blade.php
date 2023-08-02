<script>
    var token = ''
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        //$.noConflict();

        $("button[data-dismiss-modal=modal1]").click(function() {
            $('#innerModal').modal('hide');
        });

        $("button[data-dismiss-modal=modal2]").click(function() {
            $('#innerModal2').modal('hide');
        });

        $("button[data-dismiss-modal=modal3]").click(function() {
            $('#innerModal3').modal('hide');
        });

        $("button[data-dismiss-modal=modal4]").click(function() {
            $('#innerModal4').modal('hide');
        });

        /* $("#AddDate").datepicker({
                language:'th-th',
                format:'dd/mm/yyyy',
                autoclose: true
            }); */

        $.datepicker.setDefaults($.datepicker.regional["th"]);
        var currentDate = new Date();

        currentDate.setYear(currentDate.getFullYear() + 543);
        // Birth date
        $(".datepick").datetimepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '+443:+543',
            dateFormat: 'dd/mm/yy',
            onSelect: function(date) {
                $("#edit-date-of-birth").addClass('filled');
            }
        });
        $('.datepick').datetimepicker("setDate", currentDate);



        $(".select2_single").select2({
            maximumSelectionLength: 1,
            allowClear: false,
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


        $(".select2_multiple").select2({
            maximumSelectionLength: 2,
            //placeholder: "With Max Selection limit 4",
            allowClear: false,
            //theme: 'bootstrap4'
            placeholder: 'กรุณาเลือก'
        });



        $(".departmentl").change(function() {
            let department = $('#AddDepartment').val();
            //console.log(product);
            //alert(product);
            $('#AddPosition').html('');
            if (department.length !== 0) {
                $.ajax({
                    method: "GET",
                    url: "departments/find/add/" + department,
                    success: function(res) {
                        $('.positions').html(res.html);
                        $('.positions').removeAttr('readonly');
                    }
                });
            }
        })

        $(".positions").change(function() {
            let position = $('#AddPosition').val();
            $('#AddUser').html('');
            if (position.length !== 0) {
                $.ajax({
                    method: "GET",
                    url: "users/find/add/" + position,
                    success: function(res) {
                        $('.users').html(res.html);
                        $('.users').removeAttr('readonly');
                    }
                });
            }
        })


        /* $(document).on('click', '.inner1', function(e) {
            e.preventDefault();
            $('.alert-in').html('');
            $('.alert-in').hide();
            $('.success-in').html('');
            $('.success-in').hide();
        }); */

        $(document).on('click', '.inner2', function(e) {
            e.preventDefault();
            $('.alert-in').html('');
            $('.alert-in').hide();
            $('.success-in').html('');
            $('.success-in').hide();
        });

        $(document).on('click', '.inner3', function(e) {
            e.preventDefault();
            $('.alert-in').html('');
            $('.alert-in').hide();
            $('.success-in').html('');
            $('.success-in').hide();
        });

        $(document).on('click', '.inner4', function(e) {
            e.preventDefault();
            $('.alert-in').html('');
            $('.alert-in').hide();
            $('.success-in').html('');
            $('.success-in').hide();
        });


        $('#SubmitCreateFormIn1').click(function(e) {
            e.preventDefault();
            $('.alert-in').html('');
            $('.alert-in').hide();
            $('.success-in').html('');
            $('.success-in').hide();


            $.ajax({
                url: "{{ route('contacts.store') }}",
                method: 'post',
                data: {
                    name: $('#AddName').val(),
                    telephone: $('#AddTelephone').val(),
                    _token: token,
                },
                success: function(result) {
                    if (result.errors) {
                        $('.alert-in').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-in').show();
                            $('.alert-in').append('<strong><li>' + value +
                                '</li></strong>');
                        });
                    } else {
                        $('.alert-in').hide();
                        $('.success-in').show();
                        $('.success-in').append('<strong><li>' + result.success +
                            '</li></strong>');
                        toastr.success(result.success, {
                            timeOut: 5000
                        });
                        $('.doc_from').append(result.contact);
                        $('.doc_from').val(result.cid).change();
                        $('#AddName').val('');
                        $('#AddTelephone').val('');
                        //$('.form').trigger('reset');
                        $('.success-in').hide();
                        $('.alert-in').hide();
                        $('#innerModal').modal('hide');
                    }
                }
            });
        });

        $('#SubmitCreateFormIn2').click(function(e) {
            e.preventDefault();
            $('.alert-in').html('');
            $('.alert-in').hide();
            $('.success-in').html('');
            $('.success-in').hide();


            $.ajax({
                url: "{{ route('priorities.store') }}",
                method: 'post',
                data: {
                    name: $('#AddPName').val(),
                    status: 1,
                    _token: token,
                },
                success: function(result) {
                    if (result.errors) {
                        $('.alert-in').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-in').show();
                            $('.alert-in').append('<strong><li>' + value +
                                '</li></strong>');
                        });
                    } else {
                        $('.alert-in').hide();
                        $('.success-in').show();
                        $('.success-in').append('<strong><li>' + result.success +
                            '</li></strong>');
                        toastr.success(result.success, {
                            timeOut: 5000
                        });
                        $('.priorities').append(result.priorities);
                        $('.priorities').val(result.pid).change();
                        $('#AddPName').val('');
                        //$('.form').trigger('reset');
                        $('.success-in').hide();
                        $('.alert-in').hide();
                        $('#innerModal2').modal('hide');
                    }
                }
            });
        });

        $('#SubmitCreateFormIn3').click(function(e) {
            e.preventDefault();
            $('.alert-in').html('');
            $('.alert-in').hide();
            $('.success-in').html('');
            $('.success-in').hide();



            if ($("#AddUser").val()[0] === null || $("#AddUser").val()[0] === undefined || $(
                    "#AddUser").val()[0] === "" || $("#AddUser").val()[0].length === 0) {
                toastr.error('คุณยังไม่ได้เลือกผู้รับ', {
                    timeOut: 5000
                });
            } else {

                const selectedData = $('#AddUser').select2('data');

                // Loop through the selected data and extract text and value
                selectedData.forEach(function(data) {
                    const text = data.text;
                    const value = data.id;

                    // Do something with the text and value
                    console.log(`Selected Text: ${text}, Selected Value: ${value}`);
                    uid = value;
                    html = `<option value="${value}" > ${text} </option>`;
                });

                $('.doc_receive').empty().trigger('change');
                $('.doc_receive').append(html);
                $('.doc_receive').val(uid).change();

                $("#AddDepartment").val(null).trigger("change");
                $("#AddPosition").val(null).trigger("change");
                $("#AddUser").val(null).trigger("change");

                $('#innerModal3').modal('hide');



            }
        });


        /*   var iframe = document.getElementById("iframe")

onmousedown = function(e) {
    document.getElementById("position").textContent = "Mouse position: " + (e.clientX - iframe.offsetLeft) + " | " + (e.clientY - iframe.offsetTop)
} */


    });
</script>
