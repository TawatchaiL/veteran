<script>
    /* const updateDigitalClock = () => {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');

    document.getElementById('hours').textContent = hours;
    document.getElementById('minutes').textContent = minutes;
    document.getElementById('seconds').textContent = seconds;
}; */

    // Call updateDigitalClock immediately and then every 1000ms (1 second)
    //updateDigitalClock();
    //setInterval(updateDigitalClock, 1000);

    var token = ''
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const updateWeather = (lat, lon) => {
        const weatherElement = document.getElementById('weather');

        const apiKey = 'fbe9ed2bd4d3caedef17a2f42e43dc7d';
        const apiUrl =
            `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`;

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                const temperature = data.main.temp;
                const weatherIconCode = data.weather[0].icon;
                const weatherIconUrl = `http://openweathermap.org/img/w/${weatherIconCode}.png`;
                const weatherDescription = data.weather[0].description;

                const weatherHTML = `สภาพอากาศ :
        <img src="${weatherIconUrl}" alt="${weatherDescription}" width="35px">
        ${temperature.toFixed(1)}°C
    `;

                weatherElement.innerHTML = weatherHTML;
            })
            .catch(error => {
                console.error('Error fetching weather data:', error);
            });
    };

    // Get user's location and update weather
    /* if ('geolocation' in navigator) {
        navigator.geolocation.getCurrentPosition(position => {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            updateWeather(latitude, longitude);
        }, error => {
            console.error('Error getting location:', error);
        });
    } else {
        console.error('Geolocation is not available.');
    } */
    updateWeather('16.808413', '100.263495');

    const updateClock = () => {
        const datetimeElement = document.getElementById('real-time-clock');
        const now = new Date();

        // Thai language and desired formatting options
        const thaiOptions = {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false,
            timeZone: 'Asia/Bangkok'
        };

        // Format the date and time
        const thaiDateTimeString = now.toLocaleString('th-TH', thaiOptions);

        // Create the complete text
        const text = `<i class="fas fa-calendar"></i> วันที่: ${thaiDateTimeString.slice(0, 10)}
    &nbsp;&nbsp;<i class="fas fa-clock"></i> เวลา: ${thaiDateTimeString.slice(11)}`;

        datetimeElement.innerHTML = text;
    };

    // Call updateClock immediately and then every 1000ms (1 second)
    updateClock();
    setInterval(updateClock, 1000);

    // Update the clock immediately and then every second
    updateClock();
    setInterval(updateClock, 1000);

    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });

    $('.scroll-to-top').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
        return false;
    });

    function initializeTooltips() {
        $('[data-toggle="tooltip"]').tooltip();
    }

    $(document).ready(function() {
        //$('[data-toggle="tooltip"]').tooltip();

        $("[data-toggle=popover]").popover({
            trigger: 'click',
            html: true,
            content: function() {
                var content = $(this).attr("data-popover-content");
                return $(content).children(".popover-body").html();
            },
            title: function() {
                var title = $(this).attr("data-popover-content");
                return $(title).children(".popover-heading").html();
            }
        });


        $(document).on('click', '#closedialpad', function() {
            console.log('close')
            $("[data-toggle=popover]").popover('hide');
            dialpadcount = 0;
        });

        $(document).on('click', '#dial_number', function() {
            dialpadcount = 0;
        });

        $('#dial_number').on('keypress', function(event) {
            var charCode = event.which;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                // Prevent non-numeric characters
                event.preventDefault();
            }
        });

        // Additionally, you might want to handle paste events to ensure only numbers are pasted
        $('#dial_number').on('paste', function(event) {
            var clipboardData = event.originalEvent.clipboardData || window.clipboardData;
            var pastedData = clipboardData.getData('text');

            if (isNaN(pastedData)) {
                // Prevent pasting non-numeric values
                event.preventDefault();
            }
        });


        $('.sidebar-toggle-btn').on('click', function() {
            // Get the logo element
            var logo = $('#logo');

            // Check if the sidebar is being opened or closed
            if (logo.is(':visible')) {
                // Hide the logo when the sidebar is toggled
                logo.hide();
            } else {
                // Show the logo when the sidebar is toggled
                logo.show();
            }
        });

        initializeTooltips();

        $('#Listview').on('draw.dt', function() {
            initializeTooltips();
        });

        //$('#ToolbarModal').modal('show');
        $(document).on('click', '#ToolbarButton, #user_button, #hold_tab_list', function(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();
            $('#ToolbarModal').modal('show');
        });

        $(document).on('click', '.hold_tab_a', async function(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            $('.alert-success').html('');
            $('.alert-success').hide();
            let dataId = $(this).data('id');
            if (dataId !== '') {
                // If dataId is not an empty string
                $('#custom-tabs-pop-' + dataId + '-tab').tab('show');
                await maximizeCard(dataId);
            }
            $('#ToolbarModal').modal('show');
        });

    });

    function ezBSAlert(options) {
        var deferredObject = $.Deferred();
        var defaults = {
            type: "alert", //alert, prompt,confirm
            modalSize: 'modal-sm', //modal-sm, modal-lg
            okButtonText: 'OK',
            cancelButtonText: 'Cancel',
            yesButtonText: 'Yes',
            noButtonText: 'No',
            headerText: 'Attention',
            messageText: 'Message',
            alertType: 'default', //default, primary, success, info, warning, danger
            inputFieldType: 'text', //could ask for number,email,etc
        }
        $.extend(defaults, options);

        var _show = function() {
            var headClass = "navbar-default";
            switch (defaults.alertType) {
                case "primary":
                    headClass = "alert-primary";
                    break;
                case "success":
                    headClass = "alert-success";
                    break;
                case "info":
                    headClass = "alert-info";
                    break;
                case "warning":
                    headClass = "alert-warning";
                    break;
                case "danger":
                    headClass = "alert-danger";
                    break;
            }
            $('BODY').append(
                '<div id="ezAlerts" class="modal fade">' +
                '<div class="modal-dialog" class="' + defaults.modalSize + '">' +
                '<div class="modal-content">' +
                '<div id="ezAlerts-header" class="modal-header ' + headClass + '">' +
                '<h4 id="ezAlerts-title" class="modal-title">Modal title</h4>' +
                '<button id="close-button" type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>' +
                '</div>' +
                '<div id="ezAlerts-body" class="modal-body">' +
                '<div id="ezAlerts-message" ></div>' +
                '</div>' +
                '<div id="ezAlerts-footer" class="modal-footer">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>'
            );

            $('.modal-header').css({
                'padding': '15px 15px',
                '-webkit-border-top-left-radius': '5px',
                '-webkit-border-top-right-radius': '5px',
                '-moz-border-radius-topleft': '5px',
                '-moz-border-radius-topright': '5px',
                'border-top-left-radius': '5px',
                'border-top-right-radius': '5px'
            });

            $('#ezAlerts-title').text(defaults.headerText);
            $('#ezAlerts-message').html(defaults.messageText);

            var keyb = "false",
                backd = "static";
            var calbackParam = "";
            switch (defaults.type) {
                case 'alert':
                    keyb = "true";
                    backd = "true";
                    $('#ezAlerts-footer').html('<button class="btn btn-' + defaults.alertType + '">' + defaults
                        .okButtonText + '</button>').on('click', ".btn", function() {
                        calbackParam = true;
                        $('#ezAlerts').modal('hide');
                    });
                    break;
                case 'confirm':
                    var btnhtml = '<button id="ezok-btn" class="btn btn-primary">' + defaults.yesButtonText +
                        '</button>';
                    if (defaults.noButtonText && defaults.noButtonText.length > 0) {
                        btnhtml += '<button id="ezclose-btn" class="btn btn-default">' + defaults.noButtonText +
                            '</button>';
                    }
                    $('#ezAlerts-footer').html(btnhtml).on('click', 'button', function(e) {
                        if (e.target.id === 'ezok-btn') {
                            calbackParam = true;
                            $('#ezAlerts').modal('hide');
                        } else if (e.target.id === 'ezclose-btn') {
                            calbackParam = false;
                            $('#ezAlerts').modal('hide');
                        }
                    });
                    break;
                case 'prompt':
                    $('#ezAlerts-message').html(defaults.messageText +
                        '<br /><br /><div class="form-group"><input type="' + defaults.inputFieldType +
                        '" class="form-control" id="prompt" /></div>');
                    $('#ezAlerts-footer').html('<button class="btn btn-primary">' + defaults.okButtonText +
                        '</button>').on('click', ".btn", function() {
                        calbackParam = $('#prompt').val();
                        $('#ezAlerts').modal('hide');
                    });
                    break;
            }

            $('#ezAlerts').modal({
                show: false,
                backdrop: backd,
                keyboard: keyb === "true",
            }).on('hidden.bs.modal', function(e) {
                $('#ezAlerts').remove();
                deferredObject.resolve(calbackParam);
            }).on('shown.bs.modal', function(e) {
                if ($('#prompt').length > 0) {
                    $('#prompt').focus();
                }
            }).modal('show');
        }

        _show();
        return deferredObject.promise();
    }


    $(document).ready(function() {
        /*  $("#btnAlert").on("click", function() {
            var prom = ezBSAlert({
                messageText: "hello world",
                alertType: "danger"
            }).done(function(e) {
                $("body").append('<div>Callback from alert</div>');
            });
        });

        $("#btnConfirm").on("click", function() {
            ezBSAlert({
                type: "confirm",
                messageText: "hello world",
                alertType: "info"
            }).done(function(e) {
                $("body").append('<div>Callback from confirm ' + e + '</div>');
            });
        }); */

        $("#btnPrompt").on("click", function() {
            ezBSAlert({
                type: "prompt",
                messageText: "Enter Something",
                alertType: "primary"
            }).done(function(e) {
                ezBSAlert({
                    messageText: "You entered: " + e,
                    alertType: "success"
                });
            });
        });



    });


    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }


    /*let isRefreshing = false;

     // Detect refresh event
    window.addEventListener('beforeunload', function() {
        isRefreshing = true;


    });

    // Detect close event
    window.addEventListener('unload', function() {
        if (!isRefreshing) {
            // The page is being closed (not refreshed)
            // Perform actions for page close here

            sendAjaxRequest("{{ route('agent.logoff') }}", "POST");
        }
    }); */
</script>
