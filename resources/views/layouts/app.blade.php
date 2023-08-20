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
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/toastr/toastr.min.js"></script>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Libre Caslon Text' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/font-awesome-animation@1.1.1/css/font-awesome-animation.min.css"
        rel="stylesheet">
    {{-- <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css"> --}}
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <!-- Include Bootstrap DateTimePicker CDN -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.37.1/apexcharts.min.css"
        integrity="sha512-FVK9gBi+kZ53Adi2mwTlAXLduxcltMFsyTyoLhJyJcVgbhXb0eQdAGNjoNc7Mt75cH0uc6I1JEdjWc36TUhBuQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    {{-- <link rel="stylesheet" href="dist/css/jquery.datetimepicker.css"> --}}
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css" />
    <link rel="stylesheet" href="dist/css/adminlte.css?v=3.2.0">
    <link rel="stylesheet" href="dist/css/fontawesome/css/all.min.css">
    <style>
        /* body {
            font-family: 'Sarabun', serif;
                    font-size: 20px;
        } */
        .btn-orange,
        .btn-orange:hover,
        .btn-orange:active,
        .btn-orange:visited {
            background-color: #ff8000;
            color: #ffffff;
        }

        .btn-yellow,
        .btn-yellow:hover,
        .btn-yellow:active,
        .btn-yellow:visited {
            background-color: #c7c42c;
            color: #ffffff;
        }

        body {
            font-family: 'Roboto', 'Sarabun';
            font-size: 16px;
        }

        .main-header.navbar {
            box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.1);
            /* Adjust shadow values as needed */
        }

        .center-content {
            text-align: center;
        }

        /* sidebar-bg */
        .main-sidebar {
            background-color: rgb(162, 223, 144) !important
        }

        .control-sidebar-light {
            background-color: rgb(252, 253, 251) !important
        }


        /* .card-container {
            display: flex;
            flex-direction: row-reverse;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
        }

        */
        .card-content {
            padding: 15px;
            /* Set the maximum height for the card's content */
            max-height: 100%;
            overflow-y: auto;
            /* Enable vertical scrolling when content overflows */
        }

        .custom-bottom-right-card {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1040;
        }

        /* .card {
            margin-left: 10px;
            position: fixed;
            bottom: 20px;
        } */

        .scroll-to-top {
            position: fixed;
            right: 1rem;
            bottom: 1rem;
            display: none;
            width: 2.75rem;
            height: 2.75rem;
            text-align: center;
            color: #fff;
            background: rgba(90, 92, 105, .5);
            line-height: 46px
        }

        .scroll-to-top:focus,
        .scroll-to-top:hover {
            color: #fff
        }

        .scroll-to-top:hover {
            background: #5a5c69
        }

        .scroll-to-top i {
            font-weight: 800
        }

        .digital-clock {
            /* font-family: Arial, sans-serif; */
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .digit {
            padding: 0.2em;
            background-color: #333;
            color: white;
            border-radius: 0.2em;
        }
    </style>
    @yield('style')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Main Header -->
        @include('layouts.header')

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Main Footer -->
        @include('layouts.footer')

        <div class="card-container" id="dpopup">

        </div>
    </div>

    <div class="modal fade" id="ToolbarModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">{{-- <i class="fas fa-wrench"></i> --}} <i class="fas fa-spin fa-gear"></i> Agent ToolBar [
                        9999 ]</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <input {{-- <?= $outbound_dis ?> --}} style="height:50px" type="number" class="form-control"
                                        maxlength="11" id="dial_number" name="dial_number" value=""
                                        placeholder="กรอกเบอร์" />
                                </div>
                                <div class="mx-1">
                                    <button {{-- <?= $outbound_dis ?> --}} class="btn btn-lg btn-info button_dial"><i
                                            class="fas fa-phone-square"></i> โทรออก</button>
                                </div>
                                <div class="mx-1">
                                    {{--  <button  <?= $outbound_dis ?>  class="btn btn-lg btn-warning button_tranfer"><i
                                            class="fas fa-random"></i> โอนสาย</button> --}}
                                    <div class="btn-group">
                                        <button type="button"
                                            class="btn btn-lg btn-warning dropdown-toggle dropdown-icon"
                                            data-toggle="dropdown">
                                            <i class="fas fa-random"></i> โอนสาย <span class="sr-only">Toggle
                                                Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item button_tranfer" href="#"><i
                                                    class="fas fa-random"></i> Blind Tranfer</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item button_atx_tranfer" href="#"><i
                                                    class="fas fa-random"></i> Attendant Tranfer</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="mx-1">
                                    <button {{-- <?= $outbound_dis ?> --}} class="btn btn-lg btn-success button_conf"><i
                                            class="fas fa-star"></i> ประเมินความพึงพอใจ</button>
                                </div>
                                <div class="mx-1">
                                    <button {{-- <?= $outbound_dis ?> --}} class="btn btn-lg btn-primary button_conf"><i
                                            class="fas fa-handshake"></i> ประชุมสาย</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <div class="btn-group float-left {{-- <?= $break_class ?> --}}" id="break_group">
                        <button type="button" id="btn-pause"
                            class="btn btn-lg btn-orange  mx-1 dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <i class="fas fa-pause"></i> พัก <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">

                            <a class="dropdown-item button_break" href="#" data-id="ทานข้าว"><i
                                    class="fas fa-pause"></i> ทานข้าว</a>
                            <a class="dropdown-item button_break" href="#" data-id="ทานข้าว"><i
                                    class="fas fa-pause"></i> เข้าห้องน้ำ</a>
                            <a class="dropdown-item button_break" href="#" data-id="ทานข้าว"><i
                                    class="fas fa-pause"></i> ประชุม</a>
                            <div class="dropdown-divider"></div>


                        </div>
                    </div>
                    <button class="btn btn-lg btn-yellow float-left mx-1 button_unbreak"><i class="fas fa-clock"></i>
                        UnWarp </button>

                    <button {{-- <?= $logoff_dis ?> --}} onclick="location.href='#'" id="btn-logout"
                        class="btn btn-lg btn-danger float-right"><i class="fas fa-power-off"></i>
                        Logoff </button>
                    <button {{-- <?= $logoff_dis ?> --}} onclick="location.href='#'" id="btn-logout"
                        class="btn btn-lg btn-success mx-1 float-right"><i class="fas fa-plug"></i>
                        Login </button>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.37.1/apexcharts.min.js"
    integrity="sha512-hl0UXLK2ElpaU9SHbuVNsvFv2BaYszlhxB2EntUy5FTGdfg9wFJrJG2JDcT4iyKmWeuDLmK+Nr2hLoq2sKk6MQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
<!-- Include Moment.js CDN -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/i18n/datepicker-th.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/adminlte.min.js?v=3.2.0"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
    function updateDigitalClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        document.getElementById('hours').textContent = hours;
        document.getElementById('minutes').textContent = minutes;
        document.getElementById('seconds').textContent = seconds;
    }

    /* updateDigitalClock();
    setInterval(updateDigitalClock, 1000); */

    function updateWeather(lat, lon) {
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
    }

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
    updateWeather('14.683409', '100.706897');

    function updateClock() {
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

        // Create the complete text  <i class="fas fa-clock"></i> เวลา: ${thaiDateTimeString.slice(11)}
        const text = `<i class="fas fa-calendar"></i> วันที่: ${thaiDateTimeString.slice(0, 10)}
        &nbsp;&nbsp;<i class="fas fa-clock"></i> เวลา: ${thaiDateTimeString.slice(11)}`;

        datetimeElement.innerHTML = text;

    }

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
    //hide logo when resize
    $(document).ready(function() {
        $('#ToolbarModal').modal('show');

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

        //popup card
        function positionCards() {
            var cardPositions = [];

            $.ajax({
                url: '{{ route('contacts.popup') }}',
                type: 'get',
                success: function(response) {
                    // Handle success
                    $('#dpopup').html(response.html);
                    // Position the cards after dynamic content is loaded
                    $('.custom-bottom-right-card').each(function(index) {
                        cardPositions.push({
                            right: (20 + (index * 220)) + 'px',
                            isMaximized: false,
                        });
                        $(this).css('right', cardPositions[index].right);
                        $(this).delay(index * 100).fadeIn();
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error
                }
            });
        }

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

                // Update button icon
                //var icon = card.hasClass('collapsed-card') ? 'fas fa-compress' : 'fas fa-expand';
                //$(this).find('i').removeClass().addClass(icon);
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
                success: function(response) {
                    $('.pop_content').html(response.html);
                },
                error: function(xhr, status, error) {
                    // Handle error
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


        $(document).on('click', '#ToolbarButton', function(e) {
            e.preventDefault();
            $('#ToolbarModal').modal('show');
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
</script>
@yield('script')

</html>
{{-- </x-laravel-ui-adminlte::adminlte-layout> --}}
