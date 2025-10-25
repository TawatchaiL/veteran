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
    <title> {{ config('app.subtitle') }} {{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/cropped-footer-logo-32x32.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/cropped-footer-logo-32x32.png') }}" type="image/x-icon">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    {{-- <meta name="description" content="This is an example dashboard created using build-in elements and components."> --}}
    <meta name="msapplication-tap-highlight" content="no">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/toastr/toastr.min.js"></script>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var passwordIcon = document.getElementById("password-icon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordIcon.className = "fas fa-eye-slash";
            } else {
                passwordInput.type = "password";
                passwordIcon.className = "fas fa-eye";
            }
        }
    </script>

    <link rel="stylesheet" href="dist/css/Sans.css?:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="dist/css/Sarabun.css?:wght@400&display=swap">
    <link rel='stylesheet' href='dist/css/LibreCaslonText.css'>
    <link rel='stylesheet' href='dist/css/Roboto.css'>
    <link rel="stylesheet" href="dist/css/adminlte.css?v=3.2.0">
    <link rel="stylesheet" href="dist/css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/font-awesome-animation.min.css">
    {{-- <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css"> --}}
    <link rel="stylesheet" href="plugins/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.css?v=3.2.0">

<style>
    body {
        font-family: 'Roboto', 'Sarabun';
        font-size: 16px;
        background: linear-gradient(135deg, #002B7F 0%, #C4161C 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
    }

    .login-box {
        width: 400px;
    }

    .login-logo a {
        color: #ffffff !important;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.4);
    }

    .card {
        border-radius: 16px;
        background: #ffffff;
        color: #333;
        overflow: hidden;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    }

    .login-card-body {
        background: linear-gradient(to bottom, #ffffff 0%, #f8f9fa 100%);
        border-radius: 12px;
        padding: 30px;
    }

    .btn-primary {
        background-color: #005A41;
        border-color: #004C37;
        font-weight: bold;
        transition: all 0.2s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #007A59;
        border-color: #00664A;
    }

    .login-box-msg {
        font-weight: 600;
        color: #005A41;
    }

    .image-container img {
        height: 120px;
        filter: drop-shadow(2px 2px 3px rgba(0, 0, 0, 0.3));
    }

    input.form-control {
        border: 1px solid #ccc;
        border-radius: 8px;
    }

    .input-group-text {
        background-color: #005A41;
        color: white;
        border: none;
        border-radius: 0 8px 8px 0;
    }
        body.login-page {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #005A9C 0%, #9B0B16 100%);
            color: #fff;
        }

        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 150px;
            text-align: center;
            margin-bottom: 10px;
        }

        .image-container img {
            height: 120px;
            width: auto;
            display: block;
            margin: 0 auto;
        }
</style>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="image-container"><img src="{{ asset('images/logov.png') }}" alt="..."></div>
        <div class="login-logo">
            <a href="{{ url('/home') }}"><b> {{ config('app.subtitle') }} {{ config('app.name') }} <br>
                    {{ config('app.name2') }} </b></a>
        </div>
        <!-- /.login-logo -->

        <!-- /.login-box-body -->
        <div class="card" style="box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);">
            <div class="card" style="">
                <div class="card-body login-card-body">

                    @if (request()->has('error'))
                        <div class="alert alert-danger">
                            {{ urldecode(request('error')) }}
                        </div>
                    @endif
                    <p class="login-box-msg">กรุณาเข้าสู่ระบบเพื่อเริ่มใช้งาน</p>

                    <form method="post" action="{{ url('/login') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="text" name="email" value="{{-- {{ old('email') }} --}}" placeholder="Username"
                                class="form-control @error('email') is-invalid @enderror">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-user"></span></div>
                            </div>
                            @error('email')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password" value=""
                                placeholder="Password" class="form-control @error('password') is-invalid @enderror">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span id="password-icon" class="fas fa-eye"
                                        onclick="togglePasswordVisibility()"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" name="phone" value="" placeholder="หมายเลขโทรศัพท์"
                                class="form-control @error('phone') is-invalid @enderror" {{-- value="{{ old('phone', $temporaryPhone) }}" --}}>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                </div>
                            </div>
                            @error('phone')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="icheck-primary from-group">
                                    <input type="checkbox" id="ldap" name="ldap" value="1">
                                    <label for="remember">เข้าสู่ระบบด้วย Active Directory</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">Remember Me</label>
                                </div>
                            </div> --}}


                            <div class="col-6">
                                <button type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</button>
                            </div>

                        </div>
                    </form>

                    {{--  <p class="mb-1">
                        <a href="{{ route('password.request') }}">I forgot my password</a>
                    </p>
                    <p class="mb-0">
                        <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
                    </p> --}}
                </div>
                <!-- /.login-card-body -->
            </div>

        </div>
        <!-- /.login-box -->
</body>

</html>
{{-- </x-laravel-ui-adminlte::adminlte-layout> --}}
