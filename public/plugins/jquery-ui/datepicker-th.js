/* Thai initialisation for the jQuery UI date picker plugin. */
/* Written by pipo (pipo@sixhead.com). */
(function (factory) {
	if (typeof define === "function" && define.amd) {

		// AMD. Register as an anonymous module.
		define(["../datepicker"], factory);
	} else {

		// Browser globals
		factory(jQuery.datepicker);
	}
}(function (datepicker) {

	datepicker.regional['th'] = {
		closeText: 'ปิด',
		prevText: '&#xAB;&#xA0;ย้อน',
		nextText: 'ถัดไป&#xA0;&#xBB;',
		currentText: 'วันนี้',
		monthNames: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน',
			'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
		monthNamesShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.',
			'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
		dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
		dayNamesShort: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
		dayNamesMin: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
		weekHeader: 'Wk',
		dateFormat: 'dd/mm/yy',
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''
	};
	datepicker.setDefaults(datepicker.regional['th']);

	return datepicker.regional['th'];

}));


var dateBefore = null;
var minD = null;
var maxD = null;
//var obj = null;



function setminDate(minDt) {
	minD = minDt;
}

function setmaxDate(maxDt) {
	maxD = maxDt;
}

function clearAvailable() {
	minD = null;
	maxD = null;
}

function setDatepicker(selector) {
	$(selector).datepicker({

		minDate: minD,
		maxDate: maxD,

		beforeShow: function () {
			if ($(this).val() != "") {
				var arrD = $(this).val().split("-");
				arrD[2] = parseInt(arrD[2]) - 543;
				$(this).val(arrD[0] + "-" + arrD[1] + "-" + arrD[2]);
			}
			setTimeout(function () {
				$.each($(".ui-datepicker-year option"), function (j, k) {
					var textYear = parseInt($(".ui-datepicker-year option").eq(j).val()) + 543;
					$(".ui-datepicker-year option").eq(j).text(textYear);
				});
			}, 50);
		},

		onClose: function () {
			if ($(this).val() != "" && $(this).val() == dateBefore) {
				var arrD = dateBefore.split("-");
				arrD[2] = parseInt(arrD[2]) + 543;
				$(this).val(arrD[0] + "-" + arrD[1] + "-" + arrD[2]);
			}
		},

		onSelect: function (dateText, inst) {
			dateBefore = $(this).val();
			var arrD = dateText.split("-");
			arrD[2] = parseInt(arrD[2]) + 543;
			$(this).val(arrD[0] + "-" + arrD[1] + "-" + arrD[2]);
		}

	});

	clearAvailable();
}


function setDatepickerSchedule(selector) {
	$(selector).datepicker({

		minDate: minD,
		maxDate: maxD,
		

		beforeShow: function () {
			if ($(this).val() != "") {
				var arrD = $(this).val().split("-");
				arrD[2] = parseInt(arrD[2]) - 543;
				$(this).val(arrD[0] + "-" + arrD[1] + "-" + arrD[2]);
			}
			setTimeout(function () {
				$.each($(".ui-datepicker-year option"), function (j, k) {
					var textYear = parseInt($(".ui-datepicker-year option").eq(j).val()) + 543;
					$(".ui-datepicker-year option").eq(j).text(textYear);
				});
			}, 50);
		},

		onClose: function () {
			if ($(this).val() != "" && $(this).val() == dateBefore) {
				var arrD = dateBefore.split("-");
				arrD[2] = parseInt(arrD[2]) + 543;
				$(this).val(arrD[0] + "-" + arrD[1] + "-" + arrD[2]);
			}
		},

		onSelect: function (dateText, inst) {
			dateBefore = $(this).val();
			var arrD = dateText.split("-");
			arrD[2] = parseInt(arrD[2]) + 543;
			$(this).val(arrD[0] + "-" + arrD[1] + "-" + arrD[2]);
			$(this).change();
		}

	});

	clearAvailable();
} //function setDatepicker(selector){

function setDateBetween(select1, select2) {
	$('#' + select1 + ',#' + select2).datepicker({
		dateFormat: 'dd/mm/yy',
		beforeShow: function () {
			if ($(this).val() != "") {
				var arrD = $(this).val().split("-");
				arrD[2] = parseInt(arrD[2]) - 543;
				$(this).val(arrD[0] + "-" + arrD[1] + "-" + arrD[2]);
			}
			setTimeout(function () {
				$.each($(".ui-datepicker-year option"), function (j, k) {
					var textYear = parseInt($(".ui-datepicker-year option").eq(j).val()) + 543;
					$(".ui-datepicker-year option").eq(j).text(textYear);
				});
			}, 50);
			if (this.id == select2 && $('#' + select1).val() != "") {
				var arrD = $('#' + select1).val().split("-");
				arrD[2] = parseInt(arrD[2]) - 543;
				return {
					minDate: arrD[0] + "-" + arrD[1] + "-" + arrD[2],
				}
			} else if (this.id == select1 && $('#' + select2).val() != "") {
				var arrD = $('#' + select2).val().split("-");
				arrD[2] = parseInt(arrD[2]) - 543;
				return { maxDate: arrD[0] + "-" + arrD[1] + "-" + arrD[2], }
			}
		}, //beforeShow

		onClose: function () {
			if ($(this).val() != "" && $(this).val() == dateBefore) {
				var arrD = dateBefore.split("-");
				arrD[2] = parseInt(arrD[2]) + 543;
				$(this).val(arrD[0] + "-" + arrD[1] + "-" + arrD[2]);
			}
		},

		onSelect: function (dateText, inst) {
			dateBefore = $(this).val();
			var arrD = dateText.split("-");
			arrD[2] = parseInt(arrD[2]) + 543;
			$(this).val(arrD[0] + "-" + arrD[1] + "-" + arrD[2]);
		}

	});
}
