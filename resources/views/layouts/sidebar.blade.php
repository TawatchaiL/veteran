<aside class="main-sidebar sidebar-light-primary elevation-2">
    <div class="center-content">
        <a href="{{ route('home') }}" class="brand-link">
            <img id="logo" src="{{ asset('images/11890-removebg-preview.png') }}" alt="..." height="150"><br>
            <span class="brand-text font-weight-light">{{-- {{ config('app.subtitle') }}  --}}{{ config('app.name') }} </span>
        </a>
    </div>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
