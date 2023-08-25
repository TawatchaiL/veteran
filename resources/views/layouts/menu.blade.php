<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>หน้าหลัก</p>
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
@can('case-list')
<li class="nav-item">
    <a href="{{ route('cases') }}" class="nav-link {{ Request::is('cases') ? 'active' : '' }}">
        <i class="fas fa-clipboard nav-icon"></i>
        <p>เรื่องที่ติดต่อ</p>
    </a>
</li>
@endcan
@can('master-data-list')
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fa-solid fa-print nav-icon"></i>
            <p>รายงาน</p>
            <i class="fas fa-angle-left right"></i>
        </a>
        <ul class="nav nav-treeview">

            <li class="nav-item">
                <a href="{{ route('reportcase') }}" class="nav-link {{ Request::is('reportcase') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p style="font-size: 12px;">ผลรวมสายเข้าแยกตาม Agent</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('reportcasetop10') }}" class="nav-link {{ Request::is('reportcasetop10') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p style="font-size: 12px;">10 อันดับเรื่องที่ติดต่อมากที่สุด</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('reporttop10in') }}" class="nav-link {{ Request::is('reporttop10in') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p style="font-size: 12px;">10 อันดับเบอร์ภายใน</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('reporttop10out') }}" class="nav-link {{ Request::is('reporttop10out') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p style="font-size: 12px;">10 อันดับเบอร์ภายนอก</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('reportsumbytype') }}" class="nav-link {{ Request::is('reportsumbytype') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p style="font-size: 12px;">ผลรวมแยกตามประเภทที่ติดต่อ</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('reportcaseinbyhour') }}" class="nav-link {{ Request::is('reportcaseinbyhour') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p style="font-size: 12px;">ผลรวมสายเข้าภายในแยกตามช่วงเวลา</p>
                </a>
            </li>
        </ul>
    </li>
@endcan
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
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p>ประเภทการติดต่อ</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('departments') }}" class="nav-link {{ Request::is('departments') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p>แผนก</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('positions') }}" class="nav-link {{ Request::is('positions') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
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
