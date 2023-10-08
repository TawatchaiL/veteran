{{-- <x-laravel-ui-adminlte::adminlte-layout> --}}
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> {{ config('app.subtitle') }} {{ config('app.name') }} </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/cropped-footer-logo-32x32.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/cropped-footer-logo-32x32.png') }}" type="image/x-icon">

    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    {{--  <meta name="description" content="This is an example dashboard created using build-in elements and components."> --}}
    <meta name="msapplication-tap-highlight" content="no">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/toastr/toastr.min.js"></script>


    <link rel="stylesheet" href="dist/css/Sans.css?:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="dist/css/Sarabun.css?:wght@400&display=swap">
    <link rel='stylesheet' href='dist/css/LibreCaslonText.css'>
    <link rel='stylesheet' href='dist/css/Roboto.css'>
    <link rel="stylesheet" href="plugins/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/apexchart/apexcharts.min.css">
    <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css" type="text/css" />
    {{-- <link rel="stylesheet" href="dist/css/jquery.datetimepicker.css"> --}}
    <link rel="stylesheet" href="plugins/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="plugins/jquery-ui/jquery-ui-timepicker-addon.min.css" />
    <link rel="stylesheet" href="dist/css/adminlte.css?v=3.2.0">
    <link rel="stylesheet" href="dist/css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/font-awesome-animation.min.css">

    @include('layouts.style')
    @yield('style')

<body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Main Header -->
        @include('layouts.header')

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper main_content">
            @yield('content')
        </div>

        <div class="card-container" id="dpopup">

        </div>

        <!-- Main Footer -->
        @include('layouts.footer')
        @include('layouts.toolbar')

    </div>

</body>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/apexchart/apexcharts.min.js"></script>
<script src="plugins/echart/echarts.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/select2/js/select2.full.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/moment/momentn.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/datepicker/bootstrap-datetimepicker.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.js"></script>
<script src="plugins/jquery-ui/jquery-ui-timepicker-addon.min.js"></script>
<script src="plugins/signature/signature_pad.min.js"></script>
<script src="plugins/jquery-ui/datepicker-th.js"></script>

<script src="plugins/datatables-buttons/2.1.1/js/dataTables.buttons.min.js"></script>
<!-- Additional button libraries -->
<script src="plugins/datatables-buttons/2.1.1/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/2.1.1/js/buttons.print.min.js"></script>
{{-- <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script> --}}
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/adminlte.min.js?v=3.2.0"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/dropzone/min/dropzone.min.js"></script>

@include('layouts.footer_script')

<script>
    const addemerphone = () => {
        const tableBody = document.getElementById('myTbl3p').getElementsByTagName('tbody')[0];

        document.getElementById('addRowBtnp').addEventListener('click', () => {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
            <td width="30%">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="hidden" value="" name="emertypep[]" class="emertypep"><input type="text" name="emergencynamep[]" class="form-control has-feedback-left" value="" required>
                </div>
            </td>
            <td width="10%">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" name="emerrelationp[]" class="form-control has-feedback-left" value="" required>
                </div>
            </td>
            <td width="10%">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" name="emerphonep[]" class="form-control has-feedback-left" onkeydown="validateNumber(event)" value="" required>
                </div>
            </td>
            <td width="5%">
                <button type="button" class="btn btn-sm btn-danger removeRowBtnp"><i class="fa fa-minus"></i></button>
            </td>
        `;

            tableBody.appendChild(newRow);

            newRow.querySelector('.removeRowBtnp').addEventListener('click', () => {
                tableBody.removeChild(newRow);
            });
        });
    };

    //popup card
    function positionCards() {
        var cardPositions = [];

        $.ajax({
            url: '{{ route('contacts.popup') }}',
            type: 'get',
            success: function(response) {
                // Handle success
                //console.log(response.html)
                $('#dpopup').html(response.html);
                // Position the cards after dynamic content is loaded
                //$('.custom-bottom-right-card').each(function(index) {
                //    cardPositions.push({
                //        right: (20 + (index * 320)) + 'px',
                //        isMaximized: false,
                //    });
                //    $(this).css('right', cardPositions[index].right);
                //    $(this).css('bottom', '35px');
                 //   $(this).delay(index * 100).fadeIn();
                //});

                $('.custom-bottom-right-card').each(function(index) {
                    var cardPosition = {
                        right: (20 + (index % 4 * 320)) + 'px',
                        top: (35 + Math.floor(index / 4) * 160) + 'px',
                        isMaximized: false,
                    };
                    cardPositions.push(cardPosition);
                    $(this).css('right', cardPosition.right);
                    $(this).css('top', cardPosition.top);
                    $(this).delay(index * 100).fadeIn();
                });
            },
            error: function(xhr, status, error) {
                // Handle error
            }
        });
    }

    // Minimize card AJAX function
    function minimizeCard(cardId) {
        $.ajax({
            url: 'your_minimize_url',
            type: 'POST',
            data: {
                cardId: cardId
            },
            success: function(response) {
                // Handle success
            },
            error: function(xhr, status, error) {
                // Handle error
            }
        });
    }

    // Maximize card AJAX function
    function maximizeCard(cardId) {
        $.ajax({
            url: '{{ route('contacts.popup_content') }}',
            type: 'POST',
            data: {
                cardId: cardId
            },
            success: async function(response) {
                $('#' + cardId).removeClass('card-danger');
                $('#' + cardId).addClass('card-success');
                await $('#pop_' + cardId).html(response.html);
                $(".card-footer").css("display", "block")
                $('.bclose').css('display', 'none');
                addemerphone();

                function validateNumber(event) {
                    var keyCode = event.which || event.keyCode;
                    if ((keyCode < 48 || keyCode > 57) && keyCode !== 8) {
                        event.preventDefault();
                    }
                }
                var provinceOb = $('#cityp');
                var districtOb = $('#districtp');
                var cartonOb = $('#subdistrictp');

                // on change province
                $('#cityp').on('change', function() {
                    var provinceId = $(this).val();
                    districtOb.html('<option value="">เลือกอำเภอ</option>');
                    $.ajax({
                        url: "thdistrict/district/" + provinceId,
                        method: 'GET',
                        success: function(res) {
                            districtOb.html(
                                '<option value="">เลือกอำเภอ</option>');
                            cartonOb.html(
                                '<option value="">เลือกตำบล</option>');
                            $.each(res.data, function(index, item) {
                                districtOb.append(
                                    $('<option></option>').val(
                                        item.code).html(item
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
                            cartonOb.html(
                                '<option value="">เลือกตำบล</option>');
                            $.each(res.data, function(index, item) {
                                cartonOb.append(
                                    $('<option></option>').val(
                                        item.code).html(item
                                        .name_th)
                                );
                            });
                        }
                    });
                });
                setTimeout(function() {
                    $.ajax({
                        url: "{{ route('thcity.city') }}",
                        method: 'GET',
                        async: false,
                        success: function(res) {
                            var provinceOb = $('#cityp');
                            provinceOb.html(
                                '<option value="">เลือกจังหวัด</option>'
                            );
                            $.each(res.data, function(index,
                                item) {
                                provinceOb.append(
                                    $('<option></option>')
                                    .val(item.code)
                                    .html(item.name_th)
                                );
                            });
                        }
                    });

                    setTimeout(function() {
                        var telnop = $('#telnop').val();
                        $.ajax({
                            url: "contacts/popupedit/" + telnop,
                            method: 'GET',
                            async: false,
                            success: function(res) {
                                $('#phonenosuccess').html(
                                    '<h2 style="color: #1a16eb"><i class="fa-solid fa-user-tie"></i>' +
                                    res.datax.datac.fname +
                                    ' ' + res.datax.datac
                                    .lname + '</h2>');
                                $('#contractid').val(res.datax.datac
                                    .id);
                                $('#hnp').val(res.datax.datac.hn);
                                $('#adddatep').val(res.datax.datac
                                    .adddate);
                                $('#fnamep').val(res.datax.datac
                                    .fname);
                                $('#lnamep').val(res.datax.datac
                                    .lname);
                                $('#homenop').val(res.datax.datac
                                    .homeno);
                                $('#moop').val(res.datax.datac.moo);
                                $('#soip').val(res.datax.datac.soi);
                                $('#roadp').val(res.datax.datac
                                    .road);
                                $('#cityp').val(res.datax.datac
                                    .city);
                                $('#cityp').change();
                                setTimeout(function() {
                                    $('#districtp').val(res
                                        .datax.datac
                                        .district);
                                    $('#districtp')
                                        .change();
                                    setTimeout(function() {
                                        $('#subdistrictp')
                                            .val(res
                                                .datax
                                                .datac
                                                .subdistrict
                                            );
                                    }, 500)
                                }, 500)
                                $('#postcodep').val(res.datax.datac
                                    .postcode);
                                $('#telhomep').val(res.datax.datac
                                    .telhome);
                                $('#phonenop').val(res.datax.datac
                                    .phoneno);
                                $('#worknop').val(res.datax.datac
                                    .workno);

                                var tbody = document.querySelector(
                                    '#myTbl3p tbody');
                                while (tbody.firstChild) {
                                    tbody.removeChild(tbody
                                        .firstChild);
                                }
                                $.each(res.datax.emer, function(
                                    index, value) {
                                    $('#myTbl3p tbody')
                                        .append($('<tr>')
                                            .append($(
                                                    '<td width="30%">'
                                                )
                                                .append(
                                                    '<div class="col-md-12 col-sm-12 col-xs-12"><input type="hidden" value="' +
                                                    value
                                                    .id +
                                                    '" name="emertypep[]" id="emertypep"><input type="text" id="emergencynamep" name="emergencynamep[]" class="form-control has-feedback-left" value="' +
                                                    value
                                                    .emergencyname +
                                                    '" required="required"></div>'
                                                ))
                                            .append($(
                                                    '<td width="10%">'
                                                )
                                                .append(
                                                    '<div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="eemerrelation" name="emerrelationp[]" class="form-control has-feedback-left" value="' +
                                                    value
                                                    .emerrelation +
                                                    '" required="required"></div>'
                                                ))
                                            .append($(
                                                    '<td width="10%">'
                                                )
                                                .append(
                                                    '<div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="eemerphone" name="emerphonep[]" class="form-control has-feedback-left" onkeydown="validateNumber(event)" value="' +
                                                    value
                                                    .emerphone +
                                                    '" required="required"></div>'
                                                ))
                                            .append($(
                                                    '<td width="5%">'
                                                )
                                                .append(
                                                    '<button type="button" name="deletem" id="deletem" class="btn btn-sm btn-danger removeRowBtn" onclick="$(this).closest(\'tr\').remove();\"><i class="fa fa-minus"></i></button>'
                                                )));
                                });

                            }
                        });
                    }, 500)
                }, 500)

                $('#SubmitCreateFormPOP').click(function(e) {
                    var emergencyData = [];
                    if ($('#contractid').val() === "") {
                        $('#myTbl3p tbody tr').each(function() {
                            var emergencyname = $(this).find(
                                'input[name="emergencynamep[]"]').val();
                            var emerrelation = $(this).find(
                                'input[name="emerrelationp[]"]').val();
                            var emerphone = $(this).find(
                                'input[name="emerphonep[]"]').val();
                            var emergency = {
                                emergencyname: emergencyname,
                                emerrelation: emerrelation,
                                emerphone: emerphone
                            };
                            emergencyData.push(emergency);
                        });
                        var additionalData = {
                            hn: $('#hnp').val(),
                            adddate: $('#adddatep').val(),
                            fname: $('#fnamep').val(),
                            lname: $('#lnamep').val(),
                            homeno: $('#homenop').val(),
                            moo: $('#moop').val(),
                            soi: $('#soip').val(),
                            road: $('#roadp').val(),
                            city: $('#cityp').val(),
                            district: $('#districtp').val(),
                            subdistrict: $('#subdistrictp').val(),
                            postcode: $('#postcodep').val(),
                            telhome: $('#telhomep').val(),
                            phoneno: $('#phonenop').val(),
                            workno: $('#worknop').val(),
                            telno: $('#telnop').val(),
                            casetype1: $('#casetype1p').val(),
                            tranferstatus: $('#tranferstatusp').val(),
                            casedetail: $('#casedetailp').val(),
                            casestatus: $('#casestatusp').val(),
                            agent: $('#telnop').val(),
                            emergencyData: emergencyData,
                            _token: token
                        };
                        $.ajax({
                            url: "{{ route('contacts.casescontract') }}",
                            method: 'post',
                            data: additionalData,
                            success: function(result) {
                                if (result.errors) {
                                    $('.alert-danger-pop').html('');
                                    $.each(result.errors, function(key,
                                        value) {
                                        $('.alert-danger-pop')
                                            .show();
                                        $('.alert-danger-pop')
                                            .append('<strong><li>' +
                                                value +
                                                '</li></strong>');
                                    });
                                } else {
                                    $('.alert-danger-pop').hide();
                                    $('.alert-success-pop').show();
                                    $('.alert-success-pop').append(
                                        '<strong><li>' + result
                                        .success +
                                        '</li></strong>');
                                    var cardElement = document
                                        .getElementById($('#telnop')
                                            .val()
                                        ); // Replace 'yourCardId' with the actual ID of your card element
                                    cardElement.remove();
                                    //$('#'.$('#telnop').val()).remove();
                                    //$('#EditModal').modal('hide');
                                    //toastr.success(result.success, {
                                    //    timeOut: 5000
                                    //});
                                    //$('#Listview').DataTable().ajax.reload();
                                    //setTimeout(function() {
                                    //$('.alert-success').hide();

                                    //}, 10000);

                                }
                            }
                        });
                    } else {
                        if (!confirm("ยืนยันการทำรายการ ?")) return;
                        $('#myTbl3p tbody tr').each(function(index, tr) {
                            var emertype = $(this).find(
                                'input[name="emertypep[]"]').val();
                            var emergencyname = $(this).find(
                                'input[name="emergencynamep[]"]').val();
                            var emerrelation = $(this).find(
                                'input[name="emerrelationp[]"]').val();
                            var emerphone = $(this).find(
                                'input[name="emerphonep[]"]').val();
                            var emergency = {
                                emertype: emertype,
                                emergencyname: emergencyname,
                                emerrelation: emerrelation,
                                emerphone: emerphone
                            };
                            emergencyData.push(emergency);
                        });
                        var id = $('#contractid').val();
                        var additionalData = {
                            hn: $('#hnp').val(),
                            adddate: $('#adddatep').val(),
                            fname: $('#fnamep').val(),
                            lname: $('#lnamep').val(),
                            homeno: $('#homenop').val(),
                            moo: $('#moop').val(),
                            soi: $('#soip').val(),
                            road: $('#roadp').val(),
                            city: $('#cityp').val(),
                            district: $('#districtp').val(),
                            subdistrict: $('#subdistrictp').val(),
                            postcode: $('#postcodep').val(),
                            telhome: $('#telhomep').val(),
                            phoneno: $('#phonenop').val(),
                            workno: $('#worknop').val(),
                            telno: $('#telnop').val(),
                            casetype1: $('#casetype1p').val(),
                            tranferstatus: $('#tranferstatusp').val(),
                            casedetail: $('#casedetailp').val(),
                            casestatus: $('#casestatusp').val(),
                            agent: $('#telnop').val(),
                            emergencyData: emergencyData
                        };
                        $.ajax({
                            url: "contacts/casescontractupdate/" + id,
                            method: 'PUT',
                            data: additionalData,

                            success: function(result) {
                                if (result.errors) {
                                    $('.alert-danger-pop').html('');
                                    $.each(result.errors, function(key,
                                        value) {
                                        $('.alert-danger-pop')
                                            .show();
                                        $('.alert-danger-pop')
                                            .append('<strong><li>' +
                                                value +
                                                '</li></strong>');
                                    });
                                } else {
                                    $('.alert-danger-pop').hide();
                                    $('.alert-success-pop').show();
                                    $('.alert-success-pop').append(
                                        '<strong><li>' + result
                                        .success +
                                        '</li></strong>');
                                    var cardElement = document
                                        .getElementById($('#telnop')
                                            .val()
                                        ); // Replace 'yourCardId' with the actual ID of your card element
                                    cardElement.remove();
                                    //$('#EditModal').modal('hide');
                                    //toastr.success(result.success, {
                                    //    timeOut: 5000
                                    //});
                                    //$('#Listview').DataTable().ajax.reload();
                                    //setTimeout(function() {
                                    //$('.alert-success').hide();

                                    //}, 10000);

                                }
                            }
                        });
                    }
                });
            }
        });
    }

    // Close card AJAX function
    function closeCard(cardId) {
        $.ajax({
            url: 'your_close_url',
            type: 'POST',
            data: {
                cardId: cardId
            },
            success: function(response) {
                // Handle success
            },
            error: function(xhr, status, error) {
                // Handle error
            }
        });
    }



    $(document).ready(function() {


        positionCards();

        // Handle card maximize
        $(document).on('click', '.custom-bottom-right-card .card-tools [data-card-widget="maximize"]',
            function() {

                var card = $(this).closest('.custom-bottom-right-card');
                var cardIndex = card.index();
                var cardId = card.data('id');

                if (!card.hasClass('collapsed-card')) {
                    // Card is not minimized
                    card.css('right', '-300px'); // Adjust as needed
                    card.css('z-index', '99999');
                    maximizeCard(cardId);

                } else {
                    // restore
                    $('#dpopup').html('');
                    positionCards();

                }

                // Toggle minimized class
                card.toggleClass('collapsed-card');



            });

        $(document).on('click', '.custom-bottom-right-card .card-footer .bopen[data-card-widget="maximize"]',
            function() {

                var card = $(this).closest('.custom-bottom-right-card');
                var cardIndex = card.index();
                var cardId = card.data('id');

                if (!card.hasClass('collapsed-card')) {
                    // Card is not minimized
                    card.css('right', '-300px'); // Adjust as needed
                    card.css('z-index', '99999');
                    maximizeCard(cardId);

                } else {
                    // restore
                    $('#dpopup').html('');
                    positionCards();

                }

                // Toggle minimized class
                card.toggleClass('collapsed-card');



            });


        // Handle card close
        $(document).on('click', '.custom-bottom-right-card .card-tools [data-card-widget="remove"]',
            function() {
                var card = $(this).closest('.custom-bottom-right-card');
                var cardIndex = card.index();
                var cardId = card.data('id');
                // Call AJAX function for close
                //closeCard(cardId);
                positionCards();
            });

    });
</script>

@include('layouts.toolbar_script')
@include('layouts.asterisk_event')

@yield('script')

</html>
{{-- </x-laravel-ui-adminlte::adminlte-layout> --}}
