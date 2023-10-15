<script>
    //const addemerphone = (cardid) => {
        
    //    const tableBody = document.getElementById('myTbl3p' + cardid).getElementsByTagName('tbody')[0];

    //    document.getElementById('addRowBtnp' + cardid).addEventListener('click', () => {
    //        alert('OK');
    //        const newRow = document.createElement('tr');
    //        newRow.innerHTML = `
    //        <td width="30%">
    //            <div class="col-md-12 col-sm-12 col-xs-12">
    //                <input type="hidden" value="" name="emertypep` + cardid +
    //            `[]" class="emertypep"><input type="text" name="emergencynamep` + cardid + `[]" class="form-control has-feedback-left" value="" required>
    //            </div>
    ///        </td>
    //        <td width="10%">
    //            <div class="col-md-12 col-sm-12 col-xs-12">
    //                <input type="text" name="emerrelationp` + cardid + `[]" class="form-control has-feedback-left" value="" required>
    //            </div>
    //        </td>
    //        <td width="10%">
    //            <div class="col-md-12 col-sm-12 col-xs-12">
    //                <input type="text" name="emerphonep` + cardid + `[]" class="form-control has-feedback-left" onkeydown="validateNumber(event)" value="" required>
    //            </div>
    //        </td>
    //        <td width="5%">
    //            <button type="button" class="btn btn-sm btn-danger removeRowBtnp"><i class="fa fa-minus"></i></button>
    //        </td>
    //    `;
//
    //        tableBody.appendChild(newRow);

     //       newRow.querySelector('.removeRowBtnp').addEventListener('click', () => {
    //            tableBody.removeChild(newRow);
    //        });
    //   });
   // };


    const removeAllTabs = () => {
        $('#custom-tabs-pop').empty();
        $('#custom-tabs-pop-tabContent').empty();
    };

    $('#custom-tabs-pop').on('click', '.nav-link', function() {
        let dataId = $(this).data('id');

        maximizeCard(dataId);
    });

    //popup card
    function positionCards() {
        var cardPositions = [];

        $.ajax({
            url: '{{ route('contacts.popup') }}',
            type: 'get',
            success: function(response) {
                // Handle success
                //console.log(response.html)
                removeAllTabs();
                $('#custom-tabs-pop').prepend(response.tab_link);
                $('#custom-tabs-pop-tabContent').prepend(response.tab_content);
                maximizeCard(response.active_id);
                //$('#dpopup').html(response.html);
                // Position the cards after dynamic content is loaded
                /*  $('.custom-bottom-right-card').each(function(index) {
                     cardPositions.push({
                         //right: (20 + (index * 320)) + 'px',
                         isMaximized: false,
                     });
                     //$(this).css('right', cardPositions[index].right);
                     //$(this).css('bottom', '35px');
                     //$(this).delay(index * 100).fadeIn();
                 }); */

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

                $('#addRowBtnp' + cardId).on('click', function() {
                    $('#myTbl3p' + cardId + ' tbody')
                        .append($('<tr>')
                            .append($('<td width="30%">')
                                .append('<div class="col-md-12 col-sm-12 col-xs-12"><input type="hidden" value="" name="emertypep' + cardId +'[]" id="emertypep' + cardId + '"><input type="text" id="emergencynamep' + cardId + '" name="emergencynamep' + cardId + '[]" class="form-control has-feedback-left" value="" required="required"></div>'
                                ))
                            .append($('<td width="10%">').append(
                                    '<div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="eemerrelation' +
                                    cardId +
                                    '" name="emerrelationp' +
                                    cardId +
                                    '[]" class="form-control has-feedback-left" value="" required="required"></div>'
                                ))
                            .append($('<td width="10%">').append(
                                    '<div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="eemerphone' +
                                    cardId +
                                    '" name="emerphonep' +
                                    cardId +
                                    '[]" class="form-control has-feedback-left" onkeydown="validateNumberp(event)" value="" required="required"></div>'
                                ))
                            .append($('<td width="5%">').append('<button type="button" name="deletem' +
                                    cardId +
                                    '" id="deletem' +
                                    cardId +
                                    '" class="btn btn-sm btn-danger removeRowBtn" onclick="$(this).closest(\'tr\').remove();\"><i class="fa fa-minus"></i></button>'
                                )));
                });

                var provinceOb = $('#cityp' + cardId);
                var districtOb = $('#districtp' + cardId);
                var cartonOb = $('#subdistrictp' + cardId);

                $('#cityp' + cardId).on('change', function() {
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

                $('#casetype1p' + cardId).on('change', function() {
                    var parent_id = $(this).val();
                    $('#casetype2p' + cardId).html('<option value="">เลือกรายละเอียดเคส</option>');
                    $('#casetype3p' + cardId).html(
                        '<option value="">เลือกรายละเอียดเคสย่อย</option>');
                    $('#casetype4p' + cardId).html(
                        '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>');
                    $('#casetype5p' + cardId).html(
                        '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
                    $('#casetype6p' + cardId).html(
                        '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
                    if (parent_id != '') {
                        $.ajax({
                            url: "casetype6/casetype/" + parent_id,
                            method: 'GET',
                            async: false,
                            success: function(res) {
                                $.each(res.data, function(index, item) {
                                    $('#casetype2p' + cardId).append(
                                        $('<option></option>').val(item.id)
                                        .html(item.name)
                                    );
                                });
                            }
                        });
                        $('#casetype2p' + cardId).attr('disabled', false);

                        $('#casetype3p' + cardId).attr('disabled', true);
                        $('#casetype4p' + cardId).attr('disabled', true);
                        $('#casetype5p' + cardId).attr('disabled', true);
                        $('#casetype6p' + cardId).attr('disabled', true);
                    } else {
                        $('#casetype2p' + cardId).attr('disabled', true);

                        $('#casetype3p' + cardId).attr('disabled', true);
                        $('#casetype4p' + cardId).attr('disabled', true);
                        $('#casetype5p' + cardId).attr('disabled', true);
                        $('#casetype6p' + cardId).attr('disabled', true);
                    }
                });

                $('#casetype2p' + cardId).on('change', function() {
                    var parent_id = $(this).val();
                    $('#casetype3p' + cardId).html(
                        '<option value="">เลือกรายละเอียดเคสย่อย</option>');
                    $('#casetype4p' + cardId).html(
                        '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>');
                    $('#casetype5p' + cardId).html(
                        '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
                    $('#casetype6p' + cardId).html(
                        '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
                    if (parent_id != '') {
                        $.ajax({
                            url: "casetype6/casetype/" + parent_id,
                            method: 'GET',
                            async: false,
                            success: function(res) {
                                $.each(res.data, function(index, item) {
                                    $('#casetype3p' + cardId).append(
                                        $('<option></option>').val(item.id)
                                        .html(item.name)
                                    );
                                });
                            }
                        });
                        $('#casetype3p' + cardId).attr('disabled', false);

                        $('#casetype4p' + cardId).attr('disabled', true);
                        $('#casetype5p' + cardId).attr('disabled', true);
                        $('#casetype6p' + cardId).attr('disabled', true);
                    } else {
                        $('#casetype3p' + cardId).attr('disabled', true);

                        $('#casetype4p' + cardId).attr('disabled', true);
                        $('#casetype5p' + cardId).attr('disabled', true);
                        $('#casetype6p' + cardId).attr('disabled', true);
                    }
                });
                $('#casetype3p' + cardId).on('change', function() {
                    var parent_id = $(this).val();
                    $('#casetype4p' + cardId).html(
                        '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>');
                    $('#casetype5p' + cardId).html(
                        '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
                    $('#casetype6p' + cardId).html(
                        '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
                    if (parent_id != '') {
                        $.ajax({
                            url: "casetype6/casetype/" + parent_id,
                            method: 'GET',
                            async: false,
                            success: function(res) {
                                $.each(res.data, function(index, item) {
                                    $('#casetype4p' + cardId).append(
                                        $('<option></option>').val(item.id)
                                        .html(item.name)
                                    );
                                });
                            }
                        });
                        $('#casetype4p' + cardId).attr('disabled', false);

                        $('#casetype5p' + cardId).attr('disabled', true);
                        $('#casetype6p' + cardId).attr('disabled', true);
                    } else {
                        $('#casetype4p' + cardId).attr('disabled', true);

                        $('#casetype5p' + cardId).attr('disabled', true);
                        $('#casetype6p' + cardId).attr('disabled', true);
                    }
                });
                $('#casetype4p' + cardId).on('change', function() {
                    var parent_id = $(this).val();
                    $('#casetype5p' + cardId).html(
                        '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
                    $('#casetype6p' + cardId).html(
                        '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
                    if (parent_id != '') {
                        $.ajax({
                            url: "casetype6/casetype/" + parent_id,
                            method: 'GET',
                            async: false,
                            success: function(res) {
                                $.each(res.data, function(index, item) {
                                    $('#casetype5p' + cardId).append(
                                        $('<option></option>').val(item.id)
                                        .html(item.name)
                                    );
                                });
                            }
                        });
                        $('#casetype5p' + cardId).attr('disabled', false);

                        $('#casetype6p' + cardId).attr('disabled', true);
                    } else {
                        $('#casetype5p' + cardId).attr('disabled', true);

                        $('#casetype6p' + cardId).attr('disabled', true);
                    }
                });
                $('#casetype5p' + cardId).on('change', function() {
                    var parent_id = $(this).val();
                    $('#casetype6p' + cardId).html(
                        '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
                    if (parent_id != '') {
                        $.ajax({
                            url: "casetype6/casetype/" + parent_id,
                            method: 'GET',
                            async: false,
                            success: function(res) {
                                $.each(res.data, function(index, item) {
                                    $('#casetype6p' + cardId).append(
                                        $('<option></option>').val(item.id)
                                        .html(item.name)
                                    );
                                });
                            }
                        });
                        $('#casetype6p' + cardId).attr('disabled', false);
                    } else {
                        $('#casetype6p' + cardId).attr('disabled', true);
                    }
                });

                setTimeout(function() {
                    $.ajax({
                        url: "{{ route('thcity.city') }}",
                        method: 'GET',
                        async: false,
                        success: function(res) {
                            var provinceOb = $('#cityp' + cardId);
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
                        var telnop = $('#telnop' + cardId).val();
                        $('#phonenosuccess' + cardId).html(
                            '<h3 class="card-title" style="color: #1a16eb"> <i class="fa-solid fa-user-tie"></i> ผู้ติดต่อใหม่</h3>'
                        );
                        $.ajax({
                            url: "contacts/popupedit/" + telnop,
                            method: 'GET',
                            async: false,
                            success: function(res) {
                                $('#phonenosuccess' + cardId).html(
                                    '<h3 class="card-title" style="color: #1a16eb"> <i class="fa-solid fa-user-tie"></i> ' +
                                    res.datax.datac.fname +
                                    ' ' + res.datax.datac
                                    .lname + '</h3>');
                                /* $('#contact_name').html(res.datax.datac.fname +
                                    ' ' + res.datax.datac
                                    .lname); */
                                $('#contractid' + cardId).val(res.datax.datac
                                    .id);
                                $('#hnp' + cardId).val(res.datax.datac.hn);
                                $('#adddatep' + cardId).val(res.datax.datac
                                    .adddate);
                                $('#fnamep' + cardId).val(res.datax.datac
                                    .fname);
                                $('#lnamep' + cardId).val(res.datax.datac
                                    .lname);
                                $('#homenop' + cardId).val(res.datax.datac
                                    .homeno);
                                $('#moop' + cardId).val(res.datax.datac.moo);
                                $('#soip' + cardId).val(res.datax.datac.soi);
                                $('#roadp' + cardId).val(res.datax.datac
                                    .road);
                                $('#cityp' + cardId).val(res.datax.datac
                                    .city);
                                $('#cityp' + cardId).change();
                                setTimeout(function() {
                                    $('#districtp' + cardId).val(res
                                        .datax.datac
                                        .district);
                                    $('#districtp' + cardId)
                                        .change();
                                    setTimeout(function() {
                                        $('#subdistrictp' +
                                                cardId)
                                            .val(res
                                                .datax
                                                .datac
                                                .subdistrict
                                            );
                                    }, 500)
                                }, 500)
                                $('#postcodep' + cardId).val(res.datax.datac
                                    .postcode);
                                $('#telhomep' + cardId).val(res.datax.datac
                                    .telhome);
                                $('#phonenop' + cardId).val(res.datax.datac
                                    .phoneno);
                                $('#worknop' + cardId).val(res.datax.datac
                                    .workno);

                                var tbody = document.querySelector(
                                    '#myTbl3p' + cardId + ' tbody');
                                while (tbody.firstChild) {
                                    tbody.removeChild(tbody
                                        .firstChild);
                                }
                                $.each(res.datax.emer, function(
                                    index, value) {
                                    $('#myTbl3p' + cardId + ' tbody')
                                        .append($('<tr>')
                                            .append($(
                                                    '<td width="30%">'
                                                )
                                                .append(
                                                    '<div class="col-md-12 col-sm-12 col-xs-12"><input type="hidden" value="' +
                                                    value
                                                    .id +
                                                    '" name="emertypep' +
                                                    cardId +
                                                    '[]" id="emertypep' +
                                                    cardId +
                                                    '"><input type="text" id="emergencynamep' +
                                                    cardId +
                                                    '" name="emergencynamep' +
                                                    cardId +
                                                    '[]" class="form-control has-feedback-left" value="' +
                                                    value
                                                    .emergencyname +
                                                    '" required="required"></div>'
                                                ))
                                            .append($(
                                                    '<td width="10%">'
                                                )
                                                .append(
                                                    '<div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="eemerrelation' +
                                                    cardId +
                                                    '" name="emerrelationp' +
                                                    cardId +
                                                    '[]" class="form-control has-feedback-left" value="' +
                                                    value
                                                    .emerrelation +
                                                    '" required="required"></div>'
                                                ))
                                            .append($(
                                                    '<td width="10%">'
                                                )
                                                .append(
                                                    '<div class="col-md-12 col-sm-12 col-xs-12"><input type="text" id="eemerphone' +
                                                    cardId +
                                                    '" name="emerphonep' +
                                                    cardId +
                                                    '[]" class="form-control has-feedback-left" onkeydown="validateNumberp(event)" value="' +
                                                    value
                                                    .emerphone +
                                                    '" required="required"></div>'
                                                ))
                                            .append($(
                                                    '<td width="5%">'
                                                )
                                                .append(
                                                    '<button type="button" name="deletem' +
                                                    cardId +
                                                    '" id="deletem' +
                                                    cardId +
                                                    '" class="btn btn-sm btn-danger removeRowBtn" onclick="$(this).closest(\'tr\').remove();\"><i class="fa fa-minus"></i></button>'
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
                                    var provinceOb = $('#casetype1p' +
                                        cardId);
                                    provinceOb.html(
                                        '<option value="">เลือกประเภทการติดต่อ</option>'
                                    );
                                    $.each(res.data, function(index,
                                        item) {
                                        provinceOb.append(
                                            $(
                                                '<option></option>'
                                            )
                                            .val(item.id)
                                            .html(item
                                                .name)
                                        );
                                    });
                                }
                            });
                            $('#casetype2p' + cardId).html(
                                '<option value="">เลือกรายละเอียดเคส</option>');
                            $('#casetype3p' + cardId).html(
                                '<option value="">เลือกรายละเอียดเคสย่อย</option>'
                            );
                            $('#casetype4p' + cardId).html(
                                '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>'
                            );
                            $('#casetype5p' + cardId).html(
                                '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>'
                            );
                            $('#casetype6p' + cardId).html(
                                '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>'
                            );
                            $('#casetype2p' + cardId).attr('disabled', true);
                            $('#casetype3p' + cardId).attr('disabled', true);
                            $('#casetype4p' + cardId).attr('disabled', true);
                            $('#casetype5p' + cardId).attr('disabled', true);
                            $('#casetype6p' + cardId).attr('disabled', true);
                        }, 500)
                    }, 500)
                }, 500)

                $('#SubmitCreateFormP' + cardId).click(function(e) {
                    var emergencyData = [];
                    if ($('#contractid' + cardId).val() === "") {
                        $('#myTbl3p' + cardId + ' tbody tr').each(function() {
                            var emergencyname = $(this).find(
                                'input[name="emergencynamep' + cardId + '[]"]').val();
                            var emerrelation = $(this).find(
                                'input[name="emerrelationp' + cardId + '[]"]').val();
                            var emerphone = $(this).find(
                                'input[name="emerphonep' + cardId + '[]"]').val();
                            var emergency = {
                                emergencyname: emergencyname,
                                emerrelation: emerrelation,
                                emerphone: emerphone
                            };
                            emergencyData.push(emergency);
                        });
                        var additionalData = {
                            hn: $('#hnp' + cardId).val(),
                            adddate: $('#adddatep' + cardId).val(),
                            fname: $('#fnamep' + cardId).val(),
                            lname: $('#lnamep' + cardId).val(),
                            homeno: $('#homenop' + cardId).val(),
                            moo: $('#moop' + cardId).val(),
                            soi: $('#soip' + cardId).val(),
                            road: $('#roadp' + cardId).val(),
                            city: $('#cityp' + cardId).val(),
                            district: $('#districtp' + cardId).val(),
                            subdistrict: $('#subdistrictp' + cardId).val(),
                            postcode: $('#postcodep' + cardId).val(),
                            telhome: $('#telhomep' + cardId).val(),
                            phoneno: $('#phonenop' + cardId).val(),
                            workno: $('#worknop' + cardId).val(),
                            telno: $('#telnop' + cardId).val(),
                            casetype1: $('#casetype1p' + cardId + ' option:selected').text(),
                            caseid1: $('#casetype1p' + cardId).val(),
                            tranferstatus: $('#tranferstatusp' + cardId).val(),
                            casedetail: $('#casedetailp' + cardId).val(),
                            casestatus: $('#casestatusp' + cardId).val(),
                            agent: $('#telnop' + cardId).val(),
                            emergencyData: emergencyData,
                            _token: token
                        };
                        if ($('#casetype2p' + cardId).val() !== '') {
                            additionalData.casetype2 = $('#casetype2p' + cardId +
                                ' option:selected').text();
                            additionalData.caseid2 = $('#casetype2p' + cardId).val();
                        }
                        if ($('#casetype3p' + cardId).val() !== '') {
                            additionalData.casetype3 = $('#casetype3p' + cardId +
                                ' option:selected').text();
                            additionalData.caseid3 = $('#casetype3p' + cardId).val();
                        }
                        if ($('#casetype4p' + cardId).val() !== '') {
                            additionalData.casetype4 = $('#casetype4p' + cardId +
                                ' option:selected').text();
                            additionalData.caseid4 = $('#casetype4p' + cardId).val();
                        }
                        if ($('#casetype5p' + cardId).val() !== '') {
                            additionalData.casetype5 = $('#casetype5p' + cardId +
                                ' option:selected').text();
                            additionalData.caseid5 = $('#casetype5p' + cardId).val();
                        }
                        if ($('#casetype6p' + cardId).val() !== '') {
                            additionalData.casetype6 = $('#casetype6p' + cardId +
                                ' option:selected').text();
                            additionalData.caseid6 = $('#casetype6p' + cardId).val();
                        }
                        $.ajax({
                            url: "{{ route('contacts.casescontract') }}",
                            method: 'post',
                            data: additionalData,
                            success: function(result) {
                                if (result.errors) {
                                    $('.alert-danger-pop' + cardId).html('');
                                    $.each(result.errors, function(key,
                                        value) {
                                        $('.alert-danger-pop' + cardId)
                                            .show();
                                        $('.alert-danger-pop' + cardId)
                                            .append('<strong><li>' +
                                                value +
                                                '</li></strong>');
                                    });
                                    window.addEventListener('keydown', (e) => {
                                        console.log(e)
                                    })
                                } else {
                                    $('.alert-danger-pop' + cardId).hide();
                                    $('.alert-success-pop' + cardId).show();
                                    $('.alert-success-pop' + cardId).append(
                                        '<strong><li>' + result
                                        .success +
                                        '</li></strong>');
                                    var cardElementId = $('#telnop' + cardId)
                                        .val();

                                    $(`#custom-tabs-pop-${cardElementId}-tab`).closest(
                                        '.nav-item').remove();
                                    $(`#custom-tabs-pop-${cardElementId}`).remove();
                                    toastr.success('บันทึกข้อมูลเรียบร้อยแล้ว', {
                                        timeOut: 5000
                                    });

                                    $('.alert-success-pop' + cardId).hide();

                                }
                            }
                        });
                    } else {
                        if (!confirm("ยืนยันการทำรายการ ?")) return;
                        $('#myTbl3p' + cardId + ' tbody tr').each(function(index, tr) {
                            var emertype = $(this).find(
                                'input[name="emertypep' + cardId + '[]"]').val();
                            var emergencyname = $(this).find(
                                'input[name="emergencynamep' + cardId + '[]"]').val();
                            var emerrelation = $(this).find(
                                'input[name="emerrelationp' + cardId + '[]"]').val();
                            var emerphone = $(this).find(
                                'input[name="emerphonep' + cardId + '[]"]').val();
                            var emergency = {
                                emertype: emertype,
                                emergencyname: emergencyname,
                                emerrelation: emerrelation,
                                emerphone: emerphone
                            };
                            emergencyData.push(emergency);
                        });
                        var id = $('#contractid' + cardId).val();
                        var additionalData = {
                            hn: $('#hnp' + cardId).val(),
                            adddate: $('#adddatep' + cardId).val(),
                            fname: $('#fnamep' + cardId).val(),
                            lname: $('#lnamep' + cardId).val(),
                            homeno: $('#homenop' + cardId).val(),
                            moo: $('#moop' + cardId).val(),
                            soi: $('#soip' + cardId).val(),
                            road: $('#roadp' + cardId).val(),
                            city: $('#cityp' + cardId).val(),
                            district: $('#districtp' + cardId).val(),
                            subdistrict: $('#subdistrictp' + cardId).val(),
                            postcode: $('#postcodep' + cardId).val(),
                            telhome: $('#telhomep' + cardId).val(),
                            phoneno: $('#phonenop' + cardId).val(),
                            workno: $('#worknop' + cardId).val(),
                            telno: $('#telnop' + cardId).val(),
                            casetype1: $('#casetype1p' + cardId + ' option:selected').text(),
                            caseid1: $('#casetype1p' + cardId).val(),
                            tranferstatus: $('#tranferstatusp' + cardId).val(),
                            casedetail: $('#casedetailp' + cardId).val(),
                            casestatus: $('#casestatusp' + cardId).val(),
                            agent: $('#telnop' + cardId).val(),
                            emergencyData: emergencyData
                        };
                        if ($('#casetype2p' + cardId).val() !== '') {
                            additionalData.casetype2 = $('#casetype2p' + cardId +
                                ' option:selected').text();
                            additionalData.caseid2 = $('#casetype2p' + cardId).val();
                        }
                        if ($('#casetype3p' + cardId).val() !== '') {
                            additionalData.casetype3 = $('#casetype3p' + cardId +
                                ' option:selected').text();
                            additionalData.caseid3 = $('#casetype3p' + cardId).val();
                        }
                        if ($('#casetype4p' + cardId).val() !== '') {
                            additionalData.casetype4 = $('#casetype4p' + cardId +
                                ' option:selected').text();
                            additionalData.caseid4 = $('#casetype4p' + cardId).val();
                        }
                        if ($('#casetype5p' + cardId).val() !== '') {
                            additionalData.casetype5 = $('#casetype5p' + cardId +
                                ' option:selected').text();
                            additionalData.caseid5 = $('#casetype5p' + cardId).val();
                        }
                        if ($('#casetype6p' + cardId).val() !== '') {
                            additionalData.casetype6 = $('#casetype6p' + cardId +
                                ' option:selected').text();
                            additionalData.caseid6 = $('#casetype6p' + cardId).val();
                        }
                        $.ajax({
                            url: "contacts/casescontractupdate/" + id,
                            method: 'PUT',
                            data: additionalData,

                            success: function(result) {
                                if (result.errors) {
                                    $('.alert-danger-pop' + cardId).html('');
                                    $.each(result.errors, function(key,
                                        value) {
                                        $('.alert-danger-pop' + cardId)
                                            .show();
                                        $('.alert-danger-pop' + cardId)
                                            .append('<strong><li>' +
                                                value +
                                                '</li></strong>');
                                    });
                                } else {
                                    $('.alert-danger-pop' + cardId).hide();
                                    $('.alert-success-pop' + cardId).show();
                                    $('.alert-success-pop' + cardId).append(
                                        '<strong><li>' + result
                                        .success +
                                        '</li></strong>');
                                    var cardElementId = $('#telnop' + cardId)
                                        .val();

                                    $(`#custom-tabs-pop-${cardElementId}-tab`).closest(
                                        '.nav-item').remove();
                                    $(`#custom-tabs-pop-${cardElementId}`).remove();
                                    toastr.success('บันทึกข้อมูลเรียบร้อยแล้ว', {
                                        timeOut: 5000
                                    });

                                    $('.alert-success-pop' + cardId).hide();
                                }
                            }
                        });
                    }
                });
            }
        });
    }

    function validateNumberp(event) {
        var keyCode = event.which || event.keyCode;
        if ((keyCode < 48 || keyCode > 57) && keyCode !== 8) {
            event.preventDefault();
        }
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

        $(document).on('click', '.selectcontactp-button',
            function() {
                let datatId = $(this).data("tabid");
                let contactid = $(this).data("id");
            //alert($(this).attr("id"));
                $('#custom-tabs-pop-' + datatId).empty();
            $.ajax({
                url: '{{ route('contacts.popupcontact') }}',
                type: 'POST',
                data: {
                    contactid: contactid,
                    cardid: datatId
                },
                success: async function(response) {
                    $('#' + datatId).removeClass('card-danger');
                    $('#' + datatId).addClass('card-success');
                    await $('#custom-tabs-pop-' + datatId).html(response.html);
                    $(".card-footer").css("display", "block")
                    $('.bclose').css('display', 'none');
                }
            });
        });

        $(document).on('click', '.custom-bottom-right-card .card-tools [data-card-widget="maximize"]',
            function() {

                var card = $(this).closest('.custom-bottom-right-card');
                var cardIndex = card.index();
                var cardId = card.data('id');

                if (!card.hasClass('collapsed-card')) {
                    // Card is not minimized
                    //card.css('right', '-300px'); // Adjust as needed
                    card.css('z-index', '99999');
                    $('body').css('overflow', 'hidden');
                    maximizeCard(cardId);

                } else {
                    // restore
                    $('body').css('overflow', 'auto');
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
                    $('body').css('overflow', 'hidden');
                    maximizeCard(cardId);

                } else {
                    // restore
                    $('#dpopup').html('');
                    $('body').css('overflow', 'auto');
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
                $('body').css('overflow', 'auto');
                positionCards();
            });

        function AsyncConfirmYesNo(title, msg, yesFn, noFn) {
            var $confirm = $("#modalConfirmYesNo");
            $confirm.modal('show');
            $("#lblTitleConfirmYesNo").html(title);
            $("#lblMsgConfirmYesNo").html(msg);
            $("#btnYesConfirmYesNo").off('click').click(function() {
                yesFn();
                $confirm.modal("hide");
            });
            $("#btnNoConfirmYesNo").off('click').click(function() {
                noFn();
                $confirm.modal("hide");
            });
        }

        $(document).on('show.bs.tab', '#custom-tabs-pop a[data-toggle="pill"]',
            async function(e) {
                // Determine which tab is being switched to
                var href = $(e.target).attr("href");
                var targetTab = href.replace("#custom-tabs-pop-", "");

                // Display a confirmation dialog
                if (!confirm("ยืนยันการเปลี่ยน Tab ไปยัง " + targetTab +
                        " ? \nกรุณาบันทึกข้อมุลก่อนเปลี่ยน Tab")) {
                    // If the user cancels, prevent the tab switch
                    e.preventDefault();
                }

            });

        $('#myTabs a').click(function(e) {
            e.preventDefault()
            var areYouSure = confirm(
                'If you sure you wish to leave this tab?  Any data entered will NOT be saved.  To save information, use the Save buttons.'
                );
            if (areYouSure === true) {
                $(this).tab('show')
            } else {
                // do other stuff
                return false;
            }
        })
    });
</script>
