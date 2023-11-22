<aside class="main-sidebar main-sidebar-custom sidebar-light-primary elevation-2">
    <div class="center-content">
        <a href="{{ route('home') }}" class="brand-link">
            <img id="logo" src="{{ asset('images/logo.png') }}" alt="..." height="100"><br>
            <span class="brand-text font-weight-light">{{ config('app.subtitle') }} {{ config('app.name') }} <br>
                {{ config('app.name2') }}</span>
        </a>
    </div>

    <div class="sidebar">
       {{--  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/2048px-User_icon_2.svg.png"
                height="150" class="user-image img-circle elevation-1" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div> --}}
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>


    </div>

    <div class="sidebar-custom">
        <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a>
        <a href="#" class="btn btn-secondary hide-on-collapse pos-right">Help</a>
    </div>

</aside>
