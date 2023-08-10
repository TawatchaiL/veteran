<!-- need to remove -->
{{-- <li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li> --}}

@can('contact-list')
<li class="nav-item">
    <a href="{{ route('contacts') }}" class="nav-link {{ Request::is('contacts') ? 'active' : '' }}">
        <i class="nav-icon fas fa-graduation-cap"></i>
        <p>Students</p>
    </a>
</li>


@endcan
@can('master-data-list')
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-database"></i>
        <p>Databases</p>
        <i class="fas fa-angle-left right"></i>
    </a>
    <ul class="nav nav-treeview">

        <li class="nav-item" >
            <a href="{{ route('departments') }}" class="nav-link {{ Request::is('departments') ? 'active' : '' }}">
                <i class="fas fa-list-ol nav-icon"></i>
                <p>Centre</p>
            </a>
        </li>
        <li class="nav-item" >
            <a href="{{ route('positions') }}" class="nav-link {{ Request::is('positions') ? 'active' : '' }}">
                <i class="fas fa-list-ol nav-icon"></i>
                <p>Department</p>
            </a>
        </li>
        {{-- <li class="nav-item" >
            <a href="{{ route('persons') }}" class="nav-link {{ Request::is('persons') ? 'active' : '' }}">
                <i class="fas fa-user-tie nav-icon"></i>
                <p>บุคคล</p>
            </a>
        </li> --}}

    </ul>
</li>
@endcan
@can('user-list')
<li class="nav-item">

    <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>Users</p>
    </a>

</li>
@endcan
@can('role-list')
<li class="nav-item">

    <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('roles') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-lock"></i>
        <p>Roles</p>
    </a>

</li>
@endcan






