let alert_danger = (title, message, subtitle) => {
	$(document).Toasts('create', {
		body: message,
		title: title,
		class: 'bg-danger mr-2 mt-2',
		subtitle: subtitle,
		icon: 'fas fa-bell',
		autohide: true,
		fade: true,
		delay: 3000
	})
}

let alert_success = (title, message, subtitle) => {
	$(document).Toasts('create', {
		body: message,
		title: title,
		class: 'bg-success mr-2 mt-2',
		subtitle: subtitle,
		icon: 'fas fa-bell',
		autohide: true,
		fade: true,
		delay: 3000
	})
}

let toHoursAndMinutes = (totalSeconds) => {
	const totalMinutes = Math.floor(totalSeconds / 60);
	const seconds = totalSeconds % 60;
	const hours = Math.floor(totalMinutes / 60);
	const minutes = totalMinutes % 60;

	return String(hours).padStart(2, '0') + ':' + String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0')
}




//blind tranfer
$(".button_tranfer").click(function () {
	let len = $('input[name="call[]"]:checked').length;
	if (len > 0) {
		if (len > 1) {
			alert_danger('Opp', 'Can Not Tranfer More Than 1 Call', '');
		} else {
			let call_number = $('#dial_number').val();
			if (call_number !== '') {
				//if (confirm("Click OK to Tranfer?")) {
				let tranfer_chan = $("input[type='checkbox']").val();
				let chan = tranfer_chan.split("/");
				$.get(`${event_serv}/tranfer/` + call_number + "/" + chan[1], (data, status) => {
					if (data.response == 'Success') {
						alert_success('OK', 'Tranfer Success', '');
					} else {
						alert_danger('Opp', 'หมายเลขปลายทางไม่สามารถติดต่อได้', '');
					}
				});
				//}
			} else {
				alert_danger('Opp', 'Please input tranfer to number', '');
			}

		}
	} else {
		alert_danger('Opp', 'Please select call to tranfer', '');

	}
});

//atx tranfer
$(".button_atx_tranfer").click(function () {
	let len = $('input[name="call[]"]:checked').length;
	if (len > 0) {
		if (len > 1) {
			alert_danger('Opp', 'Can Not Tranfer More Than 1 Call', '');
		} else {
			let call_number = $('#dial_number').val();
			if (call_number !== '') {
				//if (confirm("Click OK to Tranfer?")) {
				let tranfer_chan = $("input[type='checkbox']").val();
				let chan = tranfer_chan.split("/");
				$.get(`${event_serv}/atx_tranfer/` + call_number + "/" + chan[1], (data, status) => {
					if (status == 'success') {
						alert_success('OK', 'Tranfer Success', '');
					} else {
						alert_danger('Opp', 'Something Error', '');
					}
				});
				//}
			} else {
				alert_danger('Opp', 'Please input tranfer to number', '');
			}

		}
	} else {
		alert_danger('Opp', 'Please select call to tranfer', '');

	}

});


//break
$(".button_break").click(function () {
	if (!confirm("Are you sure to Break?")) return;
	let rowid = $(this).data("id")

	if (!rowid) return;
	$.get(`${web_url}/agent/agent_break/` + rowid, (data, status) => {
		if (data == 'success') {
			$('.button_unbreak').removeClass("d-none");
			$('.button_unbreak').attr('disabled', false);
			$('#break_group').addClass("d-none");
			$('#sub_header').append('<div id="break_text"><i class="fas fa-pause"></i> ' + rowid + '</div>');
			$('#main_header').removeClass("card-primary");
			$('#main_header').addClass("card-warning");
			alert_success('OK', 'Pause Success', '');
		}

	});

})

//unbreak
$(".button_unbreak").click(function () {
	if (!confirm("Are you sure to UnBreak?")) return;
	$.get(`${web_url}/agent/agent_unbreak/`, (data, status) => {
		if (data == 'success') {
			$('.button_unbreak').addClass("d-none");
			$('#break_group').removeClass("d-none");
			$('#break_text').remove();
			$('#main_header').addClass("card-primary");
			$('#main_header').removeClass("card-warning");
			alert_success('OK', 'UnPause Success', '');
		}
	});

})


//call button
$(".button_dial").click(function () {
	let call_number = $('#dial_number').val();
	if (call_number !== '') {
		$.get(`${event_serv}/dial/` + call_number + "/" + exten + "/" + account_code, (data, status) => {
			if (status == 'success') {
				alert_success('OK', 'Dial Success', '');
				$('#dial_number').val('');
			} else {
				alert_danger('Opp', 'Something Error', '');
			}
		});
	} else {
		alert_danger('Opp', 'Please input  number to dial ', '');
	}

});

//conf
$(".button_conf").click(function () {
	let len = $('input[name="call[]"]:checked').length;
	if (len > 0) {
		if (len !== 2) {
			alert_danger('Opp', 'Please Select 2 Call', '');
		} else {
			let chan = []
			$('input[name="call[]"]:checked').each(function () {
				let bv = $(this).val().split("/");
				chan.push(bv[1]);
			});

			$.get(`${event_serv}/chans_variable/` + chan[0], (data, status) => {
				$.get(`${event_serv}/chans_variable/` + chan[1], (data2, status2) => {
					mcalldestchan = data[3][1].split("/");
					mcalldestchan2 = data2[3][1].split("/");
					$.get(`${event_serv}/conf/` + mcalldestchan[1] + "/" + mcalldestchan2[1] + "/" + chan[1] + "/" + exten, (data, status) => {

						if (status == 'success') {
							alert_success('OK', 'Conferrent Success', '');
						} else {
							alert_danger('Opp', 'Something Error', '');
						}
					});
				});

			});

		}
	} else {
		alert_danger('Opp', 'Please select call to conferrence', '');

	}

});

//unwrap
$(".button_complete").click(function () {
	if (!confirm("Are you sure to Complete Call?")) return;
	let rowid = $(this).data("id")

	if (!rowid) return;
	$.get(`${web_url}/agent/agent_unwrap/` + rowid, (data, status) => {
		if (data == 'success') {
			$('#dial_number').attr('disabled', false);
			$('.button_dial').attr('disabled', false);
			$('.button_tranfer').attr('disabled', false);
			$('.button_conf').attr('disabled', false);
			$('#btn-wrap').attr('disabled', true);
			$('#btn-pause').attr('disabled', false);
			$('#btn-logout').attr('disabled', false);
			$('.button_unbreak').addClass("d-none");
			$('#break_group').removeClass("d-none");
			$('#break_text').remove();
			$('#main_header').addClass("card-primary");
			$('#main_header').removeClass("card-warning");
			alert_success('OK', 'Complete Call Success', '');
		}

	});

})




//hangup
$(document).on('click', '.hangup_call', function (data) {
	if (!confirm("Are you sure to hangup?")) return;
	let rowid = $(this).data("id")

	if (!rowid) return;
	let chan = rowid.split("/");

	$.get(`${event_serv}/hangup/` + chan[1], (data, status) => {

	});

})



//list all call function
let call_list = () => {
	let mcallprofile = '';
	let mcallexten = '';
	let luniq = '';
	let mcallivr = [];
	let mstrArray = [];
	let mcallivr_val = '';
	let dur = [];
	let calls_active = 0;


	$.get(`${event_serv}/chans/` + exten, async (data, status) => {

		await data.forEach((item, index) => {
			let strArray = item.split("!");
			let chan = strArray[0].split("/");
			mcallivr = [];
			$.get(`${event_serv}/chans_variable/` + chan[1], (data, status) => {

				luniq = data[0][1];
				luniqrd = luniq.replace('.', '');
				mcallprofile = data[1][1];
				mcallexten = data[2][1];
				mcalldestchan = data[3][1];


				if (mcallprofile !== undefined) {
					mstrArray = mcallprofile.split("|");
					mcallivr = mstrArray[4].split(":");
					mcallivr_val = mcallivr[1];
					ivr_text = `<br> <h4>IVR Press: ${mcallivr[1]}</h4>`;
				} else {
					ivr_text = ``;
				}

				if (strArray[4] == 'Ringing' || strArray[4] == 'Ring') {
					state = 'Ringing'
					state_icon = '<i class="fa-solid fa-bell fa-beat" style="--fa-beat-scale: 2.0;"></i>';
					state_color = 'card-danger';
					check_box_state = 'disabled';
				} else if (strArray[4] == 'Up') {
					state = 'Talking'
					state_icon = '<i class="fa-solid fa-phone-volume fa-bounce" style=" --fa-bounce-start-scale-x: 1; --fa-bounce-start-scale-y: 1; --fa-bounce-jump-scale-x: 1; --fa-bounce-jump-scale-y: 1; --fa-bounce-land-scale-x: 1; --fa-bounce-land-scale-y: 1; "></i>';
					state_color = 'card-success';
					check_box_state = '';
				}


				if (!$('#' + luniq.replace('.', '')).length) {
					$('#call_list').append(`<div class="col-md-4" id = "${luniq.replace('.', '')}">
				<div class="card ${state_color}" id = "color_${luniq.replace('.', '')}">
					<div class="card-header">
						<h3 class="card-title" id = "state_${luniq.replace('.', '')}">  ${state_icon} ${state}  </h3>
						<div class="card-tools">
							<!-- <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
							</button>-->
							
							<div ><input type="checkbox" style="width: 20px; height: 20px;" name="call[]" id="call[]" value="${strArray[0]}" ${check_box_state}></div>
						</div>

					</div>

					<div class="card-body">
						<h2> ${mcallexten} </h2> ${ivr_text}
					</div>
					
					<div class="card-footer text-muted text-right">
					<a href="#" class="btn btn-lg btn-danger hangup_call" data-id="${strArray[0]}"><i class="fa-solid fa-phone-slash"></i> Hangup</a>
						
					</div>
				</div>

	</div>`);

					/* 	dur[luniq.replace('.', '')] = parseInt(strArray[11]);
						obj[luniq.replace('.', '')] = setInterval(function() {
							dur[luniq.replace('.', '')] = dur[luniq.replace('.', '')] + 1;
							console.log(dur[luniq.replace('.', '')])
							console.log(luniq.replace('.', ''))
							$('#state_' + luniq.replace('.', '')).html(`${state_icon} ${state} (${toHoursAndMinutes(dur[luniq.replace('.', '')])})`);
						}, 1000); */

				}

			});
			calls_active += 1;

			if (calls_active !== 0) {
				$('#btn-pause').attr('disabled', true);
				$('#btn-state').attr('disabled', true);
				$('#btn-logout').attr('disabled', true);
			}
		});
	});

};

//load call list on access page
call_list();


//event socket 
const socket = io.connect(`${event_serv}`);
socket.on('connect', data => {
	socket.emit('join', 'Client Connect To Asterisk Event Serv');
});

socket.on('event', data => {
	if (data.extension == exten) {
		if (data.status == 4 || data.status == -1) {
			$('#main_header').removeClass("card-primary");
			$('#main_header').addClass("card-secondary");
			$('#state_overlay').removeClass("d-none");
		} else {
			$('#state_overlay').addClass("d-none");
			$('#main_header').removeClass("card-secondary card-danger");
			if (data.status == 0) {
				$('#main_header').addClass("card-primary");
				$('#btn-pause').attr('disabled', false);
				$('#btn-state').attr('disabled', false);
				$('#btn-logout').attr('disabled', false);
			} else if (data.status == 1 || data.status == 2 || data.status == 8 || data.status == 9) {
				$('#main_header').addClass("card-danger");
			} else if (data.status == 16 || data.status == 17) {
				$('#main_header').addClass("card-danger");
			}


		}
	}

});

socket.on('ringing', data => {
	let mcallivr = [];
	let ivr_text = '';
	if (data.extension.match(exten)) {

		if (data.variable) {
			let mstrArray = data.variable.split("|");
			mcallivr = mstrArray[4].split(":");
			ivr_text = `<br> <h4>IVR Press: ${mcallivr[1]} </h4>`;
		}
		if (mcallivr[1] == undefined) {
			ivr_text = ``;
		}

		let state_icon = '<i class="fa-solid fa-bell fa-beat" style="--fa-beat-scale: 2.0;"></i>';
		let state = 'Ringing';

		if (!$('#' + data.luniq.replace('.', '')).length) {

			$('#call_list').append(`<div class="col-md-4" id = "${data.luniq.replace('.', '')}">
				<div class="card card-danger" id = "color_${data.luniq.replace('.', '')}">
					<div class="card-header">
						<h3 class="card-title" id = "state_${data.luniq.replace('.', '')}"> ${state_icon} ${state} </h3>
						<div class="card-tools">
							<!-- <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
							</button> -->
							
							<div ><input type="checkbox" style="width: 20px; height: 20px;" name="call[]" id="call_${data.luniq.replace('.', '')}" value="${data.extension}" disabled></div>
						</div>

					</div>

					<div class="card-body">
						<h2> ${data.cid} </h2> ${ivr_text}
					</div>
					<div class="card-footer text-muted text-right">

					<a href="#" class="btn btn-lg btn-danger hangup_call" data-id="${data.extension}"><i class="fa-solid fa-phone-slash"></i> Hangup</a>
						
					</div>
				</div>

			</div>`);


		}

		$('#btn-pause').attr('disabled', true);
		$('#btn-state').attr('disabled', true);
		$('#btn-logout').attr('disabled', true);

	}
	call_list();
});

socket.on('talking', data => {
	if (data.extension.match('SIP/' + exten)) {
		$('#state_' + data.luniq.replace('.', '')).html('<i class="fa-solid fa-phone-volume fa-bounce" style=" --fa-bounce-start-scale-x: 1; --fa-bounce-start-scale-y: 1; --fa-bounce-jump-scale-x: 1; --fa-bounce-jump-scale-y: 1; --fa-bounce-land-scale-x: 1; --fa-bounce-land-scale-y: 1; "></i> Talking');
		$('#color_' + data.luniq.replace('.', '')).removeClass("card-danger");
		$('#color_' + data.luniq.replace('.', '')).addClass("card-success");
		$('#call_' + data.luniq.replace('.', '')).removeAttr("disabled");
		if (data.mcall !== undefined) {
			let mstrArray = data.mcall.split("|");
			let queue_val = mstrArray[3].split(":");
			let cid_val = mstrArray[1].split(":");
			if (enable_popup == 1) {
				if (queue_val[1] !== '') {
					let result_url = popup_url.replace("{username}", agent_username).replace("{extension}", exten).replace("{phone}", cid_val[1]).replace("{queue}", queue_val[1]).replace("{waittime}", data.duration).replace("{mcallprofile}", data.mcall);
					let win = window.open(result_url, '_popup');
					win.focus();
				}

			}
		}
	}
	call_list();
});

socket.on('hold', data => {
	if (data.extension.match(exten)) {
		$('#state_' + data.luniq.replace('.', '')).html('<i class="fa-solid fa-pause fa-bounce" style=" --fa-bounce-start-scale-x: 1; --fa-bounce-start-scale-y: 1; --fa-bounce-jump-scale-x: 1; --fa-bounce-jump-scale-y: 1; --fa-bounce-land-scale-x: 1; --fa-bounce-land-scale-y: 1; "></i> Hold');
		$('#color_' + data.luniq.replace('.', '')).removeClass("card-success");
		$('#color_' + data.luniq.replace('.', '')).addClass("card-warning");
	}
});

socket.on('unhold', data => {
	if (data.extension.match(exten)) {
		$('#state_' + data.luniq.replace('.', '')).html('<i class="fa-solid fa-phone-volume fa-bounce" style=" --fa-bounce-start-scale-x: 1; --fa-bounce-start-scale-y: 1; --fa-bounce-jump-scale-x: 1; --fa-bounce-jump-scale-y: 1; --fa-bounce-land-scale-x: 1; --fa-bounce-land-scale-y: 1; "></i> Talking');
		$('#color_' + data.luniq.replace('.', '')).removeClass("card-warning");
		$('#color_' + data.luniq.replace('.', '')).addClass("card-success");
	}

});

socket.on('pause', data => {
	console.log(data);
	if (data.extension.match(exten) && data.paused == 0) {
		$.get(`${web_url}/agent/clear_pause/`, (data, status) => {
			if (data == 'success') {
				$('#dial_number').attr('disabled', false);
				$('.button_dial').attr('disabled', false);
				$('.button_tranfer').attr('disabled', false);
				$('.button_conf').attr('disabled', false);
				$('#btn-wrap').attr('disabled', true);
				$('#btn-pause').attr('disabled', false);
				$('#btn-logout').attr('disabled', false);
				$('.button_unbreak').addClass("d-none");
				$('#break_group').removeClass("d-none");
				$('#break_text').remove();
				$('#main_header').addClass("card-primary");
				$('#main_header').removeClass("card-warning");
				//alert_success('OK', 'Complete Call Success', '');
			}

		});
	}
});


socket.on('hangup', data => {
	console.log(data)
	if (data.extension.match(exten)) {
		$('#' + data.luniq.replace('.', '')).remove();
		call_list();
		if (data.extension.match('SIP/' + exten)) {
			chan = data.extension.split("/");
			$.get(`${web_url}/agent/agent_wrap/` + data.luniq + `/` + data.transfer, (dataw, status) => {

				if (dataw) {
					$.get(`${web_url}/agent/get_wrap_list/` + dataw, (datawl, status) => {
						if (dataw == 'Outbound') {
							$('#dial_number').attr('disabled', true);
							$('.button_dial').attr('disabled', true);
							$('.button_tranfer').attr('disabled', true);
							$('.button_conf').attr('disabled', true);
							$('.cbutton_Inbound').addClass("d-none");
							$('.cbutton_Outbound').removeClass("d-none");
						} else {
							$('.cbutton_Outbound').addClass("d-none");
							$('.cbutton_Inbound').removeClass("d-none");
						}
						$('#btn-wrap').attr('disabled', false);
						$('.button_unbreak').attr('disabled', true);
						$('.button_unbreak').removeClass("d-none");
						$('#btn-logout').attr('disabled', true);
						$('#break_group').addClass("d-none");
						$('#sub_header').append(`<div id="break_text"><i class="fas fa-pause"></i> Wrap UP (${dataw})</div>`);
						$('#main_header').removeClass("card-primary");
						$('#main_header').addClass("card-warning");
						alert_success('OK', 'Call End', '');
					});
				}

			});

		}

	}
	//clearInterval(obj[data.luniq.replace('.', '')]);
});

//logoff by remove queue member
socket.on('qlogoff', data => {
	console.log(data)
	if (data.extension.match(exten)) {
		$.get(`${web_url}/agent/kick/`, (dataw, status) => {
			if (dataw) {
				window.location.replace(`${web_url}/auth/agent_kick`);
			}
		});
	}

});

socket.on('disconnect', data => {
	$.get(`${web_url}/agent/kick/`, (dataw, status) => {
		if (dataw) {
			window.location.replace(`${web_url}/auth/agent_kick`);
		}
	});
	socket.emit('join', 'Bye from client');
});
