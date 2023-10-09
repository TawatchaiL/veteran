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
                $('.custom-bottom-right-card').each(function(index) {
                    cardPositions.push({
                        //right: (20 + (index * 320)) + 'px',
                        isMaximized: false,
                    });
                    //$(this).css('right', cardPositions[index].right);
                    //$(this).css('bottom', '35px');
                    //$(this).delay(index * 100).fadeIn();
                });

                //$('.custom-bottom-right-card').each(function(index) {
                //    var cardPosition = {
                //        right: (20 + (index % 4 * 320)) + 'px',
                //        top: (35 + Math.floor(index / 4) * 160) + 'px',
                //        isMaximized: false,
                //    };
                //    cardPositions.push(cardPosition);
                //    $(this).css('right', cardPosition.right);
                //    $(this).css('top', cardPosition.top);
                //    $(this).delay(index * 100).fadeIn();
                //});
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

                $('#casetype1p').on('change', function() {
                    var parent_id = $(this).val();
                    $('#casetype2p').html('<option value="">เลือกรายละเอียดเคส</option>');
                    $('#casetype3p').html('<option value="">เลือกรายละเอียดเคสย่อย</option>');
                    $('#casetype4p').html(
                    '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>');
                    $('#casetype5p').html(
                    '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
                    $('#casetype6p').html(
                    '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
                    if (parent_id != '') {
                        $.ajax({
                            url: "casetype6/casetype/" + parent_id,
                            method: 'GET',
                            async: false,
                            success: function(res) {
                                $.each(res.data, function(index, item) {
                                    $('#casetype2p').append(
                                        $('<option></option>').val(item.id)
                                        .html(item.name)
                                    );
                                });
                            }
                        });
                        $('#casetype2p').attr('disabled', false);

                        $('#casetype3p').attr('disabled', true);
                        $('#casetype4p').attr('disabled', true);
                        $('#casetype5p').attr('disabled', true);
                        $('#casetype6p').attr('disabled', true);
                    } else {
                        $('#casetype2p').attr('disabled', true);

                        $('#casetype3p').attr('disabled', true);
                        $('#casetype4p').attr('disabled', true);
                        $('#casetype5p').attr('disabled', true);
                        $('#casetype6p').attr('disabled', true);
                    }
                });

                $('#casetype2p').on('change', function() {
                    var parent_id = $(this).val();
                    $('#casetype3p').html('<option value="">เลือกรายละเอียดเคสย่อย</option>');
                    $('#casetype4p').html(
                    '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>');
                    $('#casetype5p').html(
                    '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
                    $('#casetype6p').html(
                    '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
                    if (parent_id != '') {
                        $.ajax({
                            url: "casetype6/casetype/" + parent_id,
                            method: 'GET',
                            async: false,
                            success: function(res) {
                                $.each(res.data, function(index, item) {
                                    $('#casetype3p').append(
                                        $('<option></option>').val(item.id)
                                        .html(item.name)
                                    );
                                });
                            }
                        });
                        $('#casetype3p').attr('disabled', false);

                        $('#casetype4p').attr('disabled', true);
                        $('#casetype5p').attr('disabled', true);
                        $('#casetype6p').attr('disabled', true);
                    } else {
                        $('#casetype3p').attr('disabled', true);

                        $('#casetype4p').attr('disabled', true);
                        $('#casetype5p').attr('disabled', true);
                        $('#casetype6p').attr('disabled', true);
                    }
                });
                $('#casetype3p').on('change', function() {
                    var parent_id = $(this).val();
                    $('#casetype4p').html(
                    '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>');
                    $('#casetype5p').html(
                    '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
                    $('#casetype6p').html(
                    '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
                    if (parent_id != '') {
                        $.ajax({
                            url: "casetype6/casetype/" + parent_id,
                            method: 'GET',
                            async: false,
                            success: function(res) {
                                $.each(res.data, function(index, item) {
                                    $('#casetype4p').append(
                                        $('<option></option>').val(item.id)
                                        .html(item.name)
                                    );
                                });
                            }
                        });
                        $('#casetype4p').attr('disabled', false);

                        $('#casetype5p').attr('disabled', true);
                        $('#casetype6p').attr('disabled', true);
                    } else {
                        $('#casetype4p').attr('disabled', true);

                        $('#casetype5p').attr('disabled', true);
                        $('#casetype6p').attr('disabled', true);
                    }
                });
                $('#casetype4p').on('change', function() {
                    var parent_id = $(this).val();
                    $('#casetype5p').html(
                    '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
                    $('#casetype6p').html(
                    '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
                    if (parent_id != '') {
                        $.ajax({
                            url: "casetype6/casetype/" + parent_id,
                            method: 'GET',
                            async: false,
                            success: function(res) {
                                $.each(res.data, function(index, item) {
                                    $('#casetype5p').append(
                                        $('<option></option>').val(item.id)
                                        .html(item.name)
                                    );
                                });
                            }
                        });
                        $('#casetype5p').attr('disabled', false);

                        $('#casetype6p').attr('disabled', true);
                    } else {
                        $('#casetype5p').attr('disabled', true);

                        $('#casetype6p').attr('disabled', true);
                    }
                });
                $('#casetype5p').on('change', function() {
                    var parent_id = $(this).val();
                    $('#casetype6p').html(
                    '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
                    if (parent_id != '') {
                        $.ajax({
                            url: "casetype6/casetype/" + parent_id,
                            method: 'GET',
                            async: false,
                            success: function(res) {
                                $.each(res.data, function(index, item) {
                                    $('#casetype6p').append(
                                        $('<option></option>').val(item.id)
                                        .html(item.name)
                                    );
                                });
                            }
                        });
                        $('#casetype6p').attr('disabled', false);
                    } else {
                        $('#casetype6p').attr('disabled', true);
                    }
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
                        setTimeout(function() {
                            $.ajax({
                                url: "casetype6/casetype/0",
                                method: 'GET',
                                async: false,
                                success: function(res) {
                                    var provinceOb = $('#casetype1p');
                                    provinceOb.html(
                                        '<option value="">เลือกประเภทการติดต่อ</option>'
                                        );
                                    $.each(res.data, function(index,
                                        item) {
                                        provinceOb.append(
                                            $(
                                                '<option></option>')
                                            .val(item.id)
                                            .html(item
                                                .name)
                                        );
                                    });
                                }
                            });
                            $('#casetype2p').html(
                                '<option value="">เลือกรายละเอียดเคส</option>');
                            $('#casetype3p').html(
                                '<option value="">เลือกรายละเอียดเคสย่อย</option>'
                                );
                            $('#casetype4p').html(
                                '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>'
                                );
                            $('#casetype5p').html(
                                '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>'
                                );
                            $('#casetype6p').html(
                                '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>'
                                );
                            $('#casetype2p').attr('disabled', true);
                            $('#casetype3p').attr('disabled', true);
                            $('#casetype4p').attr('disabled', true);
                            $('#casetype5p').attr('disabled', true);
                            $('#casetype6p').attr('disabled', true);
                        }, 500)
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
                            casetype1: $('#casetype1p option:selected').text(),
                            caseid1: $('#casetype1p').val(),
                            tranferstatus: $('#tranferstatusp').val(),
                            casedetail: $('#casedetailp').val(),
                            casestatus: $('#casestatusp').val(),
                            agent: $('#telnop').val(),
                            emergencyData: emergencyData,
                            _token: token
                        };
                        if ($('#casetype2p').val() !== '') {
                            additionalData.casetype2 = $('#casetype2p option:selected').text();
                            additionalData.caseid2 = $('#casetype2p').val();
                        }
                        if ($('#casetype3p').val() !== '') {
                            additionalData.casetype3 = $('#casetype3p option:selected').text();
                            additionalData.caseid3 = $('#casetype3p').val();
                        }
                        if ($('#casetype4p').val() !== '') {
                            additionalData.casetype4 = $('#casetype4p option:selected').text();
                            additionalData.caseid4 = $('#casetype4p').val();
                        }
                        if ($('#casetype5p').val() !== '') {
                            additionalData.casetype5 = $('#casetype5p option:selected').text();
                            additionalData.caseid5 = $('#casetype5p').val();
                        }
                        if ($('#casetype6p').val() !== '') {
                            additionalData.casetype6 = $('#casetype6p option:selected').text();
                            additionalData.caseid6 = $('#casetype6p').val();
                        }
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
                                    $('html, body').animate({ scrollTop: 0 }, 'fast');
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
                            casetype1: $('#casetype1p option:selected').text(),
                            caseid1: $('#casetype1p').val(),
                            tranferstatus: $('#tranferstatusp').val(),
                            casedetail: $('#casedetailp').val(),
                            casestatus: $('#casestatusp').val(),
                            agent: $('#telnop').val(),
                            emergencyData: emergencyData
                        };
                        if ($('#casetype2p').val() !== '') {
                            additionalData.casetype2 = $('#casetype2p option:selected').text();
                            additionalData.caseid2 = $('#casetype2p').val();
                        }
                        if ($('#casetype3p').val() !== '') {
                            additionalData.casetype3 = $('#casetype3p option:selected').text();
                            additionalData.caseid3 = $('#casetype3p').val();
                        }
                        if ($('#casetype4p').val() !== '') {
                            additionalData.casetype4 = $('#casetype4p option:selected').text();
                            additionalData.caseid4 = $('#casetype4p').val();
                        }
                        if ($('#casetype5p').val() !== '') {
                            additionalData.casetype5 = $('#casetype5p option:selected').text();
                            additionalData.caseid5 = $('#casetype5p').val();
                        }
                        if ($('#casetype6p').val() !== '') {
                            additionalData.casetype6 = $('#casetype6p option:selected').text();
                            additionalData.caseid6 = $('#casetype6p').val();
                        }
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
                                    $('html, body').animate({ scrollTop: 0 }, 'fast');
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
                    //card.css('right', '-300px'); // Adjust as needed
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
                    //card.css('right', '-300px'); // Adjust as needed
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
