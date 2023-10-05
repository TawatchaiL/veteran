<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link sidebar-toggle-btn" data-widget="pushmenu" href="#" role="button"><i
                    class="fas fa-bars"></i></a>
        </li>
         <!-- <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link" {{-- dropdown-toggle" data-toggle="dropdown" --}}>
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/2048px-User_icon_2.svg.png"
                    height="150" class="user-image img-circle elevation-1" alt="User Image">
                <span class="d-none d-md-inline text-primary">{{ Auth::user()->name }}</span>
            </a>
           <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <li class="user-header bg-info">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/2048px-User_icon_2.svg.png"
                        height="100" class="img-circle elevation-1" alt="User Image">
                    <p>
                        {{ Auth::user()->name }} <br>
                        <i class="fas fa-building"></i> แผนก :
                        @if (Auth::check() && Auth::user()->department && Auth::user()->department->name)
{{ Auth::user()->department->name }}
@endif
                        <br>
                        <i class="fas fa-users"></i> ตำแหน่ง :
                        @if (Auth::check() && Auth::user()->position && Auth::user()->position->name)
{{ Auth::user()->position->name }}
@endif

                        <small>สร้างเมื่อ {{ Auth::user()->created_at->format('M. Y') }}</small><br>
                    </p>
                </li>


                <li class="user-footer">
                    {{-- <a href="#" class="btn btn-default btn-flat">Profile</a> --}}
                    <a href="#" class="btn btn-default btn-flat float-right"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        ออกจากระบบ
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>-->
        <li class="nav-item d-none d-sm-inline-block"><a href="#" class="nav-link"> [ <i
                    class="fa-solid fa-lg fa-truck-medical"></i>
                <b class="text-primary"> โรงพยาบาลพุทธชินราช พิษณุโลก</b> ]
            </a></li>


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
        @php
            switch ($temporaryPhoneStatusID) {
                case 0:
                    $temporaryPhoneColor = 'btn btn-secondary';
                    $dial_number = 'disabled';
                    $dial_button = 'disabled';
                    break;
                case 1:
                    $temporaryPhoneColor = 'btn btn-success';
                    $dial_number = '';
                    $dial_button = '';
                    break;
                case 2:
                    $temporaryPhoneColor = 'btn btn-warning';
                    $dial_number = '';
                    $dial_button = '';
                    break;
                case 3:
                    $temporaryPhoneColor = '';
                    break;
                default:
                    $temporaryPhoneColor = 'btn btn-secondary';
                    break;
            }
        @endphp

        <li class="nav-item d-none d-sm-inline-block">
            <a class="{{ $temporaryPhoneColor }}" role="button" id="ToolbarButton">
                <span id="phone_state_icon">{!! $temporaryPhoneStatusIcon !!}</span> {{ Auth::user()->name }} [
                {{ $temporaryPhone }}  ] : <span id="phone_state">{{ $temporaryPhoneStatus }}</span>
            </a>
        </li>

    </ul>
</nav>
