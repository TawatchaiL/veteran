<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link sidebar-toggle-btn" data-widget="pushmenu" href="#" role="button"><i
                    class="fas fa-bars"></i></a>
        </li>

        {{--  <li class="nav-item d-none d-sm-inline-block"><a href="#" class="nav-link"> [ <i
                    class="fa-solid fa-lg fa-truck-medical"></i>
                <b class="text-primary"> โรงพยาบาลพุทธชินราช พิษณุโลก</b> ]
            </a></li> --}}


        <!--<li class="nav-item d-none d-sm-inline-block">
            <a class="btn btn-success" id="ToolbarButton" {{-- data-widget="control-sidebar" data-slide="true" href="#" --}} role="button">
                <i class="fas fa-xl fa-spin fa-gear"></i> Agent ToolBar
            </a>{{-- faa-shake animated faa-slow fa-wrench --}}
        </li>-->
       {{--  <li class="nav-item d-none d-sm-inline-block">
            <a class="btn btn-success" data-widget="fullscreen" role="button">
                <i class="fas fa-xl fa-expand-arrows-alt"></i> ขยาย/ย่อ หน้าจอ
            </a>
        </li> --}}
        @if (!empty($sidebarc))
            <li class="nav-item d-none d-sm-inline-block"><a href="/" class="nav-link"> [ <i
                        class="fa-solid fa-lg fa-home"></i>
                    <b class="text-primary"> หน้าหลัก </b> ]
                </a></li>
        @endif


        {{-- <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">s
                <span id="real-time-clock"></span>

            </a>
        </li>
       <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">
                <span class="digital-clock"> <i class="fas fa-clock"></i>  เวลา: &nbsp;
                    <div id="hours" class="digit">00</div>
                    <span>:</span>
                    <div id="minutes" class="digit">00</div>
                    <span>:</span>
                    <div id="seconds" class="digit">00</div>
                </span>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">

            </a>
        </li> --}}

    </ul>

    <ul class="navbar-nav ml-auto">



        <li class="nav-item d-none d-sm-inline-block">
            <a class="btn btn-success" role="button" id="ToolbarButton">
                <span id="phone_state_icon">{!! $temporaryPhoneStatusIcon !!}</span> [
                <b class="text-primary">{{ $temporaryPhone }} :</b> <b class="text-primary"
                    id="phone_state">{{ $temporaryPhoneStatus }}</b> ]
            </a>
        </li>

    </ul>
</nav>
