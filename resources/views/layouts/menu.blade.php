<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>

@can('contact-list')
    <li class="nav-item">
        <a href="{{ route('contacts') }}" class="nav-link {{ Request::is('contacts') ? 'active' : '' }}">
            <i class="nav-icon fas fa-address-book"></i>
            <p>รายชื่อผู้ติดต่อ</p>
        </a>
    </li>
@endcan

<li class="nav-item">
    <a href="{{ route('cases') }}" class="nav-link {{ Request::is('cases') ? 'active' : '' }}">
        <i class="far fas fa-clipboard nav-icon"></i>
        <p>เรื่องที่ติดต่อ</p>
    </a>
</li>
@can('master-data-list')
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-database"></i>
            <p>ข้อมูลหลัก</p>
            <i class="fas fa-angle-left right"></i>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('casetype') }}" class="nav-link {{ Request::is('casetype') ? 'active' : '' }}">
                    <i class="fas fa-list-ol nav-icon"></i>
                    <p>ประเภทการติดต่อ</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('departments') }}" class="nav-link {{ Request::is('departments') ? 'active' : '' }}">
                    <i class="fas fa-list-ol nav-icon"></i>
                    <p>แผนก</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('positions') }}" class="nav-link {{ Request::is('positions') ? 'active' : '' }}">
                    <i class="fas fa-list-ol nav-icon"></i>
                    <p>ตำแหน่ง</p>
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
            <p>ผู้ใช้งาน</p>
        </a>

    </li>
@endcan
@can('role-list')
    <li class="nav-item">

        <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('roles') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-lock"></i>
            <p>สิทธิ์การใช้งาน</p>
        </a>

    </li>
@endcan
