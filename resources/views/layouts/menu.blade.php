<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-address-book"></i>
        <p>หน่วยงานที่ติดต่อ</p>
        <i class="fas fa-angle-left right"></i>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item" >
            <a href="{{ route('contacts') }}" class="nav-link {{ Request::is('contacts') ? 'active' : '' }}">
                <i class="far fa-building nav-icon"></i>
                <p>หน่วยงานราชการ</p>
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
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-database"></i>
        <p>ข้อมูลหลัก</p>
        <i class="fas fa-angle-left right"></i>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item" >
            <a href="{{ route('priorities') }}" class="nav-link {{ Request::is('priorities') ? 'active' : '' }}">
                <i class="fas fa-list-ol nav-icon"></i>
                <p>ระดับชั้นความเร็ว</p>
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
<li class="nav-item">

    <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>ผู้ใช้งาน</p>
    </a>

</li>
<li class="nav-item">

    <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('roles') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-lock"></i>
        <p>สิทธิ์การใช้งาน</p>
    </a>

</li>






