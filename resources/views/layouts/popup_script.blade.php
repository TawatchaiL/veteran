<script>
    const removeAllTabs = () => {
        $('#custom-tabs-pop').empty();
        $('#custom-tabs-pop-tabContent').empty();
    };

    $('#custom-tabs-pop').on('click', '.nav-link', function() {
        var dataId = $(this).data('id');
        var datatext = $('#pop_' + dataId).text();
        if (datatext === '(ผู้ติดต่อที่เคยบันทึกข้อมูลไว้)' || datatext === '(ผู้ติดต่อใหม่)') {
            maximizeCard(dataId);
        }
    });

    function positionCards() {
        var cardPositions = [];
        $.ajax({
            url: '{{ route('contacts.popup') }}',
            type: 'get',
            success: function(response) {
                if (response.tab_link !== '') {
                    removeAllTabs();

                    $('#custom-tabs-pop').prepend(response.tab_link);
                    $('#custom-tabs-pop-tabContent').prepend(response.tab_content);

                    maximizeCard(response.active_id);
                }
                $('#hold_tab').html(response.hold_tab);
                $('#hold_tab_content').html(response.hold_tab_content);
            },
            error: function(xhr, status, error) {

            }
        });
    }

    function minimizeCard(cardId) {
        $.ajax({
            url: 'your_minimize_url',
            type: 'POST',
            data: {
                cardId: cardId
            },
            success: function(response) {

            },
            error: function(xhr, status, error) {

            }
        });
    }
    /// Maximize card AJAX function
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
                        //let contactid = $('#contractid' + cardId).val();
                        var telnop = $('#telnop' + cardId).val();
                        $('#phonenosuccess' + cardId).html(
                            '<h3 class="card-title" style="color: #1a16eb"> <i class="fa-solid fa-user-tie"></i> ผู้ติดต่อใหม่</h3>'
                        );
                        $.ajax({
                            url: "contacts/popupeditphone/" + telnop,
                            method: 'GET',
                            async: false,
                            success: function(res) {
                                if (res.datax.length != 0) {
                                    $('#phonenosuccess' + cardId).html(
                                        '<h3 class="card-title" style="color: #1a16eb"> <i class="fa-solid fa-user-tie"></i> ' +
                                        res.datax.datac.fname +
                                        ' ' + res.datax.datac
                                        .lname + '</h3>');
                                    $('#contractid' + cardId).val(res.datax
                                        .datac.id);
                                    $('#hnp' + cardId).val(res.datax.datac.hn);
                                    //$('#adddatep' + cardId).val(res.datax.datac.adddate);
                                    var arrayDate = res.datax.datac.adddate
                                        .split("-");
                                    arrayDate[0] = parseInt(arrayDate[0]) + 543;
                                    $('#adddatep' + cardId).val(arrayDate[0] +
                                        "-" + arrayDate[1] + "-" +
                                        arrayDate[2]);

                                    $('#tnamep' + cardId).val(res.datax.datac
                                        .tname);
                                    $('#fnamep' + cardId).val(res.datax.datac
                                        .fname);
                                    $('#lnamep' + cardId).val(res.datax.datac
                                        .lname);
                                    $('#sexp' + cardId).val(res.datax.datac
                                        .sex);

                                    //$('#birthdayp' + cardId).val(res.datax.datac.birthday);
                                    var arrayDate = res.datax.datac.birthday
                                        .split("-");
                                    arrayDate[0] = parseInt(arrayDate[0]) + 543;
                                    $('#birthdayp' + cardId).val(arrayDate[0] +
                                        "-" + arrayDate[1] + "-" +
                                        arrayDate[2]);
                                    $('#agep' + cardId).val(res.datax.datac
                                        .age);
                                    $('#bloodgroupp' + cardId).val(res.datax
                                        .datac.bloodgroup);
                                    $('#homenop' + cardId).val(res.datax.datac
                                        .homeno);
                                    $('#moop' + cardId).val(res.datax.datac
                                        .moo);
                                    $('#soip' + cardId).val(res.datax.datac
                                        .soi);
                                    $('#roadp' + cardId).val(res.datax.datac
                                        .road);
                                    $('#cityp' + cardId).val(res.datax.datac
                                        .city);
                                    $('#cityp' + cardId).change();
                                    setTimeout(function() {
                                        $('#districtp' + cardId).val(res
                                            .datax.datac.district);
                                        $('#districtp' + cardId)
                                            .change();
                                        setTimeout(function() {
                                            $('#subdistrictp' +
                                                cardId).val(
                                                res.datax
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
                                        tbody.removeChild(tbody.firstChild);
                                    }
                                    $.each(res.datax.emer, function(index,
                                        value) {
                                        $('#myTbl3p' + cardId +
                                                ' tbody')
                                            .append($('<tr>')
                                                .append($(
                                                        '<td width="30%">'
                                                    )
                                                    .append(
                                                        '<div class="col-md-12 col-sm-12 col-xs-12"><input type="hidden" value="' +
                                                        value.id +
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
                                                    )).append($(
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

                                    $.each(res.datax.cases, function(index,
                                        value) {
                                        $('#Listviewcasesp' + cardId +
                                            ' tbody').append($(
                                                '<tr>')
                                            .append($('<td>')
                                                .append(
                                                    '<div class="col-md-12 col-sm-12 col-xs-12">' +
                                                    value
                                                    .casetype1 +
                                                    '</div>'))
                                            .append($('<td>')
                                                .append(
                                                    '<div class="col-md-12 col-sm-12 col-xs-12">' +
                                                    value
                                                    .casedetail +
                                                    '</div>'))
                                            .append($('<td>')
                                                .append(
                                                    '<div class="col-md-12 col-sm-12 col-xs-12">' +
                                                    value
                                                    .casestatus +
                                                    '</div>'))
                                            .append($('<td>')
                                                .append(
                                                    '<div class="col-md-12 col-sm-12 col-xs-12">' +
                                                    value
                                                    .tranferstatus +
                                                    '</div>'))
                                            .append($('<td>')
                                                .append(
                                                    '<div class="col-md-12 col-sm-12 col-xs-12">' +
                                                    value
                                                    .created_at +
                                                    '</div>'))
                                        );
                                    });
                                }
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
            }
        });
    }

    function validateNumberp(event) {
        var allowedKeys = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
        var keyCode = event.key;

        if (keyCode === "Backspace") {
            return;
        }

        if (allowedKeys.indexOf(keyCode) === -1) {
            event.preventDefault();
        }
    }

    /// Close card AJAX function
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

            }
        });
    }

    $(document).ready(function() {
        positionCards();
        //datepicker
        $.datepicker.setDefaults($.datepicker.regional['th']);
        $(document).on("focus", ".AddDatep", function() {
            $(this).datepicker({
                dateFormat: "yy-mm-dd",
                //defaultDate: '2023-11-14',
                isBuddhist: true,
                changeMonth: true,
                changeYear: true,
                //yearRange:'1940:2057',
                yearRange: 'c-40:c+10',
                dayNamesMin: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"],
                monthNamesShort: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม",
                    "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน",
                    "ธันวาคม"
                ],
                beforeShow: function() {
                    if ($(this).val() != "") {
                        var arrayDate = $(this).val().split("-");
                        arrayDate[0] = parseInt(arrayDate[0]) - 543;
                        $(this).val(arrayDate[0] + "-" + arrayDate[1] + "-" + arrayDate[2]);
                        dateBefore = $(this).val();
                    }
                    setTimeout(function() {
                        $.each($(".ui-datepicker-year option"), function(j, k) {
                            var textYear = parseInt($(
                                    ".ui-datepicker-year option").eq(j)
                                .val()) + 543;
                            $(".ui-datepicker-year option").eq(j).text(
                                textYear);
                        });
                    }, 50);

                },
                onChangeMonthYear: function() {
                    setTimeout(function() {
                        $.each($(".ui-datepicker-year option"), function(j, k) {
                            var textYear = parseInt($(
                                    ".ui-datepicker-year option").eq(j)
                                .val()) + 543;
                            $(".ui-datepicker-year option").eq(j).text(
                                textYear);
                        });
                    }, 50);
                },
                onClose: function() {
                    if ($(this).val() != "" && $(this).val() == dateBefore) {
                        var arrayDate = dateBefore.split("-");
                        //$('#temp'+$(this).attr('id')).html(dateBefore);
                        arrayDate[0] = parseInt(arrayDate[0]) + 543;
                        $(this).val(arrayDate[0] + "-" + arrayDate[1] + "-" + arrayDate[2]);
                    }
                },
                onSelect: function(dateText, inst) {
                    dateBefore = $(this).val();
                    //$('#temp'+$(this).attr('id')).html(dateBefore);
                    var arrayDate = dateText.split("-");
                    arrayDate[0] = parseInt(arrayDate[0]) + 543;
                    $(this).val(arrayDate[0] + "-" + arrayDate[1] + "-" + arrayDate[2]);

                    var selectedDate = new Date(dateText);
                    var currentDate = new Date();
                    var years = currentDate.getFullYear() - selectedDate.getFullYear();
                    var months = currentDate.getMonth() - selectedDate.getMonth();
                    var days = currentDate.getDate() - selectedDate.getDate();
                    if (days < 0) {
                        months--;
                        days += new Date(currentDate.getFullYear(), currentDate.getMonth(), 0).getDate();
                    }

                    if (months < 0) {
                        years--;
                        months += 12;
                    }
                    $("#agep"+$(this).data('tid')).val(years + " ปี " + months + " เดือน " + days + " วัน");
                }
            });
        });

        //birth day change
       /* $(document).on("change", ".Birthdayp", function() {
            alert('ok');
            var selectedDate = new Date($(this).val());
            var currentDate = new Date();
            var tid = $(this).data("tid");
            var years = currentDate.getFullYear() - selectedDate.getFullYear();
            var months = currentDate.getMonth() - selectedDate.getMonth();
            var days = currentDate.getDate() - selectedDate.getDate();
            if (days < 0) {
                months--;
                days += new Date(currentDate.getFullYear(), currentDate.getMonth(), 0).getDate();
            }

            if (months < 0) {
                years--;
                months += 12;
            }
            $("#agep" + tid).val(years + " ปี " + months + " เดือน " + days + " วัน");
        });*/
        //casetype changes
        $(document).on("change", ".casetypechang", function() {
            var cardId = $(this).data("tabid");
            var levcase = $(this).data("lev");
            var parent_id = $(this).val();
            var nextcase = levcase + 1;
            var discase = nextcase + 1;
            if (parent_id != '' && levcase < 6) {
                for (let i = nextcase; i < 7; i++) {
                    if (i === 2) {
                        $('#casetype2p' + cardId).html('<option value="">เลือกรายละเอียดเคส</option>');
                    }
                    if (i === 3) {
                        $('#casetype3p' + cardId).html(
                            '<option value="">เลือกรายละเอียดเคสย่อย</option>');
                    }
                    if (i === 4) {
                        $('#casetype4p' + cardId).html(
                            '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>');
                    }
                    if (i === 5) {
                        $('#casetype5p' + cardId).html(
                            '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
                    }
                    if (i === 6) {
                        $('#casetype6p' + cardId).html(
                            '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
                    }
                }
                $.ajax({
                    url: "casetype6/casetype/" + parent_id,
                    method: 'GET',
                    async: false,
                    success: function(res) {
                        $.each(res.data, function(index, item) {
                            $('#casetype' + nextcase + 'p' + cardId).append(
                                $('<option></option>').val(item.id)
                                .html(item.name)
                            );
                        });
                    }
                });

                $('#casetype' + nextcase + 'p' + cardId).attr('disabled', false);
                for (let i = discase; i < 7; i++) {
                    $('#casetype' + i + 'p' + cardId).attr('disabled', true);
                }
            } else {
                for (let i = nextcase; i < 7; i++) {
                    if (i === 2) {
                        $('#casetype2p' + cardId).html('<option value="">เลือกรายละเอียดเคส</option>');
                    }
                    if (i === 3) {
                        $('#casetype3p' + cardId).html(
                            '<option value="">เลือกรายละเอียดเคสย่อย</option>');
                    }
                    if (i === 4) {
                        $('#casetype4p' + cardId).html(
                            '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 1</option>');
                    }
                    if (i === 5) {
                        $('#casetype5p' + cardId).html(
                            '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 2</option>');
                    }
                    if (i === 6) {
                        $('#casetype6p' + cardId).html(
                            '<option value="">เลือกรายละเอียดเคสเพิ่มเติม 3</option>');
                    }
                    $('#casetype' + i + 'p' + cardId).attr('disabled', true);
                }
            }
        });
        //province changes
        $(document).on("change", ".citypchang", function() {
            let datatId = $(this).data("tabid");
            var districtOb = $('#districtp' + datatId);
            var cartonOb = $('#subdistrictp' + datatId);
            districtOb.html('<option value="">เลือกอำเภอ</option>');
            $.ajax({
                url: "thdistrict/district/" + $(this).val(),
                method: 'GET',
                success: function(res) {
                    districtOb.html(
                        '<option value="">เลือกอำเภอ</option>');
                    cartonOb.html(
                        '<option value="">เลือกตำบล</option>');
                    $.each(res.data, function(index, item) {
                        districtOb.append(
                            $('<option></option>').val(item.code).html(item
                                .name_th)
                        );
                    });
                }
            });
        });

        $(document).on("change", ".districtpchang", function() {
            let datatId = $(this).data("tabid");
            var cartonOb = $('#subdistrictp' + datatId);
            //cartonOb.html('<option value="">เลือกตำบล</option>');
            $.ajax({
                url: "thsubdistrict/subdistrict/" + $(this).val(),
                method: 'GET',
                success: function(res) {
                    cartonOb.html('<option value="">เลือกตำบล</option>');
                    $.each(res.data, function(index, item) {
                        cartonOb.append(
                            $('<option></option>').val(item.code).html(item
                                .name_th)
                        );
                    });
                }
            });
        });
        //Add new phone emergency
        $(document).on('click', '.addRowBtnp-button',
            function() {
                let cardId = $(this).data("tabid");
                $('#myTbl3p' + cardId + ' tbody')
                    .append($('<tr>')
                        .append($('<td width="30%">')
                            .append(
                                '<div class="col-md-12 col-sm-12 col-xs-12"><input type="hidden" value="" name="emertypep' +
                                cardId + '[]" id="emertypep' + cardId +
                                '"><input type="text" id="emergencynamep' + cardId +
                                '" name="emergencynamep' + cardId +
                                '[]" class="form-control has-feedback-left" value="" required="required"></div>'
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
        //Add phone number to textbox
        $(document).on('click', '.btnpnumber',
            function() {
                let datatId = $(this).data("tabid");
                let tagetp = $(this).data("tagetp");
                $('#' + tagetp + datatId).val(datatId);
            });
        // contact list to from
        $(document).on('click', '.selectcontactp-button',
            function() {
                let datatId = $(this).data("tabid");
                let cardId = $(this).data("tabid");
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

                        $.ajax({
                            url: "{{ route('thcity.city') }}",
                            method: 'GET',
                            async: false,
                            success: function(res) {
                                var provinceOb = $('#cityp' + datatId);
                                provinceOb.html(
                                    '<option value="">เลือกจังหวัด</option>'
                                );
                                $.each(res.data, function(index, item) {
                                    provinceOb.append($('<option></option>')
                                        .val(item.code).html(item
                                            .name_th));
                                });
                            }
                        });

                        //let telnop = $('#telnop' + cardId).val();
                        $('#phonenosuccess' + cardId).html(
                            '<h3 class="card-title" style="color: #1a16eb"> <i class="fa-solid fa-user-tie"></i> ผู้ติดต่อใหม่</h3>'
                        );
                        $.ajax({
                            url: "contacts/popupedit/" + contactid,
                            method: 'GET',
                            async: false,
                            success: function(res) {
                                $('#phonenosuccess' + cardId).html(
                                    '<h3 class="card-title" style="color: #1a16eb"> <i class="fa-solid fa-user-tie"></i> ' +
                                    res.datax.datac.fname +
                                    ' ' + res.datax.datac
                                    .lname + '</h3>');
                                $('#contractid' + cardId).val(res.datax.datac.id);
                                $('#hnp' + cardId).val(res.datax.datac.hn);
                                //$('#adddatep' + cardId).val(res.datax.datac.adddate);
                                var arrayDate = res.datax.datac.adddate.split("-");
                                arrayDate[0] = parseInt(arrayDate[0]) + 543;
                                $('#adddatep' + cardId).val(arrayDate[0] + "-" +
                                    arrayDate[1] + "-" + arrayDate[2]);
                                $('#tnamep' + cardId).val(res.datax.datac.tname);
                                $('#fnamep' + cardId).val(res.datax.datac.fname);
                                $('#lnamep' + cardId).val(res.datax.datac.lname);
                                $('#sexp' + cardId).val(res.datax.datac.sex);
                                //$('#birthdayp' + cardId).val(res.datax.datac.birthday);
                                var arrayDate = res.datax.datac.birthday.split("-");
                                arrayDate[0] = parseInt(arrayDate[0]) + 543;
                                $('#birthdayp' + cardId).val(arrayDate[0] + "-" +
                                    arrayDate[1] + "-" + arrayDate[2]);
                                $('#agep' + cardId).val(res.datax.datac.age);
                                $('#bloodgroupp' + cardId).val(res.datax.datac
                                    .bloodgroup);
                                $('#homenop' + cardId).val(res.datax.datac.homeno);
                                $('#moop' + cardId).val(res.datax.datac.moo);
                                $('#soip' + cardId).val(res.datax.datac.soi);
                                $('#roadp' + cardId).val(res.datax.datac.road);
                                $('#cityp' + cardId).val(res.datax.datac.city);
                                $('#cityp' + cardId).change();
                                setTimeout(function() {
                                    $('#districtp' + cardId).val(res.datax
                                        .datac.district);
                                    $('#districtp' + cardId).change();
                                    setTimeout(function() {
                                        $('#subdistrictp' + cardId)
                                            .val(res.datax.datac
                                                .subdistrict);
                                    }, 500)
                                }, 500)
                                $('#postcodep' + cardId).val(res.datax.datac
                                    .postcode);
                                $('#telhomep' + cardId).val(res.datax.datac
                                    .telhome);
                                $('#phonenop' + cardId).val(res.datax.datac
                                    .phoneno);
                                $('#worknop' + cardId).val(res.datax.datac.workno);

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
                                            .append($('<td width="30%">')
                                                .append(
                                                    '<div class="col-md-12 col-sm-12 col-xs-12"><input type="hidden" value="' +
                                                    value.id +
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
                                            .append($('<td width="10%">')
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
                                            .append($('<td width="10%">')
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
                                            .append($('<td width="5%">')
                                                .append(
                                                    '<button type="button" name="deletem' +
                                                    cardId +
                                                    '" id="deletem' +
                                                    cardId +
                                                    '" class="btn btn-sm btn-danger removeRowBtn" onclick="$(this).closest(\'tr\').remove();\"><i class="fa fa-minus"></i></button>'
                                                )));
                                });

                                $.each(res.datax.cases, function(index, value) {
                                    $('#Listviewcases' + cardId + ' tbody')
                                        .append($('<tr>')
                                            .append($('<td>')
                                                .append(
                                                    '<div class="col-md-12 col-sm-12 col-xs-12">' +
                                                    value.casetype1 +
                                                    '</div>'))
                                            .append($('<td>')
                                                .append(
                                                    '<div class="col-md-12 col-sm-12 col-xs-12">' +
                                                    value.casedetail +
                                                    '</div>'))
                                            .append($('<td>')
                                                .append(
                                                    '<div class="col-md-12 col-sm-12 col-xs-12">' +
                                                    value.casestatus +
                                                    '</div>'))
                                            .append($('<td>')
                                                .append(
                                                    '<div class="col-md-12 col-sm-12 col-xs-12">' +
                                                    value.tranferstatus +
                                                    '</div>'))
                                            .append($('<td>')
                                                .append(
                                                    '<div class="col-md-12 col-sm-12 col-xs-12">' +
                                                    value.created_at +
                                                    '</div>'))
                                        );
                                });

                            }
                        });

                        $.ajax({
                            url: "casetype6/casetype/0",
                            method: 'GET',
                            async: false,
                            success: function(res) {
                                var caseOb = $('#casetype1p' + datatId);
                                caseOb.html(
                                    '<option value="">เลือกประเภทการติดต่อ</option>'
                                );
                                $.each(res.data, function(index, item) {
                                    caseOb.append(
                                        $('<option></option>').val(item
                                            .id).html(item.name)
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
                    }
                });
            });
        // Save data asdf
        $(document).on('click', '.SubmitCreateFormP-button', function() {
            let cardId = $(this).data("tabid");
            var uniqid = $('#custom-tabs-pop-' + cardId).data("tick");
            var emergencyData = [];

            var arrayDate = $('#adddatep' + cardId).val().split("-");
            arrayDate[0] = parseInt(arrayDate[0]) - 543;
            var tempadddate = arrayDate[0] + "-" + arrayDate[1] + "-" + arrayDate[2];

            var arrayDateb = $('#birthdayp' + cardId).val().split("-");
            arrayDateb[0] = parseInt(arrayDateb[0]) - 543;
            var tempbirthday = arrayDateb[0] + "-" + arrayDateb[1] + "-" + arrayDateb[2];

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
                    adddate: tempadddate,
                    tname: $('#tnamep' + cardId).val(),
                    fname: $('#fnamep' + cardId).val(),
                    lname: $('#lnamep' + cardId).val(),
                    sex: $('#sexp' + cardId).val(),
                    birthday: tempbirthday,
                    age: $('#agep' + cardId).val(),
                    bloodgroup: $('#bloodgroupp' + cardId).val(),
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
                    uniqid: uniqid,
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
                            //$('html, body').animate({scrollTop:0}, 'slow');
                            //$('#toolbar_header').scrollTop(0);
                            $('#ToolbarModal').scrollTop(0);
                            //window.addEventListener('keydown', (e) => {
                            //    console.log(e)
                            //})
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
                //if (!confirm("ยืนยันการทำรายการ ?")) return;
                ezBSAlert({
                    type: "confirm",
                    headerText: "Confirm",
                    messageText: "ยืนยันการทำรายการ?",
                    alertType: "info",
                }).done(function(r) {
                    if (r == true) {
                        $('#myTbl3p' + cardId + ' tbody tr').each(function(index, tr) {
                            var emertype = $(this).find(
                                'input[name="emertypep' + cardId + '[]"]').val();
                            var emergencyname = $(this).find(
                                    'input[name="emergencynamep' + cardId + '[]"]')
                                .val();
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
                            adddate: tempadddate,
                            tname: $('#tnamep' + cardId).val(),
                            fname: $('#fnamep' + cardId).val(),
                            lname: $('#lnamep' + cardId).val(),
                            sex: $('#sexp' + cardId).val(),
                            birthday: tempbirthday,
                            age: $('#agep' + cardId).val(),
                            bloodgroup: $('#bloodgroupp' + cardId).val(),
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
                            uniqid: uniqid,
                            telno: $('#telnop' + cardId).val(),
                            casetype1: $('#casetype1p' + cardId + ' option:selected')
                                .text(),
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
                                    $('.alert-danger-pop').focus();
                                } else {
                                    $('.alert-danger-pop' + cardId).hide();
                                    $('.alert-success-pop' + cardId).show();
                                    $('.alert-success-pop' + cardId).append(
                                        '<strong><li>' + result
                                        .success +
                                        '</li></strong>');
                                    var cardElementId = $('#telnop' + cardId)
                                        .val();

                                    $(`#custom-tabs-pop-${cardElementId}-tab`)
                                        .closest(
                                            '.nav-item').remove();
                                    $(`#custom-tabs-pop-${cardElementId}`).remove();
                                    toastr.success('บันทึกข้อมูลเรียบร้อยแล้ว', {
                                        timeOut: 5000
                                    });

                                    $('.alert-success-pop' + cardId).hide();
                                    $('#ToolbarModal').modal('hide');
                                    positionCards();
                                }
                            }
                        });
                    }
                });


            }
        });

        //Click Tab
        $(document).on('click', '.tablistcaseP', function() {
            var contactid = $(this).data("contactid");
            var tabid = $(this).data("tabid");
            $.ajax({
                url: '{{ route('cases.caseslist') }}',
                type: 'POST',
                data: {
                    id: contactid,
                    tabid: tabid
                },
                success: function(response) {
                    $('#ListviewcasesP' + tabid).html(response.html);
                }
            });
        });
        //List cases
        $(document).on('click', '.listcasesP-button', function() {
            var contactid = $(this).data("contactid");
            var tabid = $(this).data("tabid");
            $.ajax({
                url: '{{ route('cases.caseslist') }}',
                type: 'POST',
                data: {
                    id: contactid,
                    tabid: tabid
                },
                success: function(response) {
                    $('#ListviewcasesP' + tabid).html(response.html);
                }
            });
        });
        //case view
        $(document).on('click', '.casedetailP-button', function() {
            var casesid = $(this).data("cases_id");
            var tabid = $(this).data("tabid");
            $.ajax({
                url: '{{ route('cases.casesview') }}',
                type: 'POST',
                data: {
                    id: casesid,
                    tabid: tabid
                },
                success: function(response) {
                    $('#ListviewcasesP' + tabid).html(response.html);
                }
            });
        });

        $(document).on('click', '.custom-bottom-right-card .card-tools [data-card-widget="maximize"]',
            function() {

                var card = $(this).closest('.custom-bottom-right-card');
                var cardIndex = card.index();
                var cardId = card.data('id');

                if (!card.hasClass('collapsed-card')) {
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
            function(e) {

                var href = $(e.target).attr("href");
                var targetTab = href.replace("#custom-tabs-pop-", "");

                if (!confirm("ยืนยันการเปลี่ยน Tab ไปยัง " + targetTab +
                        " ? \nกรุณาบันทึกข้อมุลก่อนเปลี่ยน Tab")) {
                    e.preventDefault();
                }

            });
    });
</script>