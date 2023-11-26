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
@can('agent-outbound')
    <li class="nav-item">
        <a href="{{ route('agent_outbound') }}" class="nav-link {{ Request::is('agent_outbound') ? 'active' : '' }}">
            <i class="fa-solid fa-tty nav-icon"></i>
            <p>รายการโทรออก</p>
        </a>
    </li>
@endcan
@can('voice-record-list')
    <li class="nav-item">
        <a href="{{ route('voicerecord') }}" class="nav-link {{ Request::is('voicerecord') ? 'active' : '' }}">
            <i class="fa-solid fa-volume-high nav-icon"></i>
            <p>ไฟล์บันทึกเสียงสนทนา</p>
        </a>
    </li>
@endcan
@can('case-list')
    <li class="nav-item">
        <a href="{{ route('billing') }}" class="nav-link {{ Request::is('billing') ? 'active' : '' }}">
            <i class="fa-solid fa-file-invoice-dollar nav-icon"></i>
            <p>CDR & Billing</p>
        </a>
    </li>
@endcan
@can('case-list')
    <li class="nav-item">
        <a href="{{ route('dashboard.index') }}" class="nav-link {{ Request::is('dashboard.index') ? 'active' : '' }}">
            <i class="fa-solid fa-desktop nav-icon"></i>
            <p>Queue/Agent Monitor</p>
        </a>
    </li>
@endcan
@can('master-data-list')
    <li
        class="nav-item {{ in_array(Request::route()->getName(), [
            'report',
            'reportcasetop10',
            'reportsumbytype',
            'reportsumcasebystatus',
            'reportsumcasebytranferstatus',
            'detailcases',
            'detailcasesstatus',
            'sumcasebyhn',
            'detailcaselogbyhn',
            'reportcaseinbyhour',
            'reporttop10in',
            'reporttop10out',
            'reportcaseoutbyhour',
            'detailcaseinternalnumber',
            'detailcaseexternalnumber',
            'loginstatus',
            'reportbreak',
            'sumtel',
            'callstatus',
            'misscall',
            'misscall',
            'reportcase',
            'ivrreport',
            'ivrreporttop10',
            'reportsumscoreagent',
            'detailscore',
            'detailscoreagent',
        ])
            ? 'menu-open'
            : '' }}">
        <a href="{{ route('report') }}"
            class="nav-link {{ in_array(Request::route()->getName(), [
                'reportcasetop10',
                'reportsumbytype',
                'reportsumcasebystatus',
                'reportsumcasebytranferstatus',
                'detailcases',
                'detailcasesstatus',
                'sumcasebyhn',
                'detailcaselogbyhn',
                'reportcaseinbyhour',
                'reporttop10in',
                'reporttop10out',
                'reportcaseoutbyhour',
                'detailcaseinternalnumber',
                'detailcaseexternalnumber',
                'loginstatus',
                'reportbreak',
                'sumtel',
                'callstatus',
                'misscall',
                'misscall',
                'reportcase',
                'ivrreport',
                'ivrreporttop10',
                'reportsumscoreagent',
                'detailscore',
                'detailscoreagent',
            ])
                ? 'active'
                : '' }}">
            <i class="fa-solid fa-print nav-icon"></i>
            <p>รายงาน</p>
            <i class="fas fa-angle-left right"></i>
        </a>
        {{-- <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('reportcasetop10') }}"
                    class="nav-link {{ Request::is('reportcasetop10') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip" title="10 อันดับเรื่องที่ติดต่อมากที่สุด">
                        <span class="text-truncate d-block">
                            10 อันดับเรื่องที่ติดต่อมากที่สุด
                        </span>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('reportsumbytype') }}"
                    class="nav-link {{ Request::is('reportsumbytype') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip" title="ผลรวมแยกตามประเภทที่ติดต่อ">
                        <span class="text-truncate d-block">
                            ผลรวมแยกตามประเภทที่ติดต่อ
                        </span>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('reportsumcasebystatus') }}"
                    class="nav-link {{ Request::is('reportsumcasebystatus') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip" title="ผลรวมเรื่องที่ติดต่อแยกตามสถานะ">
                        <span class="text-truncate d-block">
                            ผลรวมเรื่องที่ติดต่อแยกตามสถานะ
                        </span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('reportsumcasebytranferstatus') }}"
                    class="nav-link {{ Request::is('reportsumcasebytranferstatus') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip"
                        title="ผลรวมเรื่องที่ติดต่อแยกตามสถานะการโอนสาย">
                        <span class="text-truncate d-inline-block" style="max-width: 150px">
                            ผลรวมเรื่องที่ติดต่อแยกตามสถานะการโอนสาย
                        </span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('detailcases') }}" class="nav-link {{ Request::is('detailcases') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip" title="รายละเอียดเรื่องที่ติดต่อ">
                        <span class="text-truncate d-block">
                            รายละเอียดเรื่องที่ติดต่อ
                        </span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('detailcasesstatus') }}"
                    class="nav-link {{ Request::is('detailcasesstatus') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip"
                        title="รายละเอียดเรื่องที่ติดต่อแสดงตามสถานะ">
                        <span class="text-truncate d-block">
                            รายละเอียดเรื่องที่ติดต่อแสดงตามสถานะ
                        </span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('sumcasebyhn') }}" class="nav-link {{ Request::is('sumcasebyhn') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip" title="ผลรวมเรื่องที่ติดต่อแยกตาม HN">
                        <span class="text-truncate d-block">
                            ผลรวมเรื่องที่ติดต่อแยกตาม HN
                        </span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('detailcaselogbyhn') }}"
                    class="nav-link {{ Request::is('detailcaselogbyhn') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip"
                        title="รายละเอียดเรื่องที่ติดต่อที่มีการ แก้ไข และการคอมเม้น">
                        <span class="text-truncate d-block">
                            รายละเอียดเรื่องที่ติดต่อที่มีการ แก้ไข และการคอมเม้น
                        </span>
                    </p>
                </a>
            </li>
        </ul> --}}
    </li>
@endcan
{{-- @can('master-data-list')
    <li
        class="nav-item {{ in_array(Request::route()->getName(), [
            'reportcaseinbyhour',
            'reporttop10in',
            'reporttop10out',
            'reportcaseoutbyhour',
            'detailcaseinternalnumber',
            'detailcaseexternalnumber',
            'loginstatus',
            'reportbreak',
            'sumtel',
            'callstatus',
            'misscall',
            'misscall',
            'reportcase',
        ])
            ? 'menu-open'
            : '' }}">
        <a href="#"
            class="nav-link {{ in_array(Request::route()->getName(), [
                'reportcaseinbyhour',
                'reporttop10in',
                'reporttop10out',
                'reportcaseoutbyhour',
                'detailcaseinternalnumber',
                'detailcaseexternalnumber',
                'loginstatus',
                'reportbreak',
                'sumtel',
                'callstatus',
                'hitcall',
                'misscall',
                'reportcase',
            ])
                ? 'active'
                : '' }}">
            <i class="fa-solid fa-print nav-icon"></i>
            <p>Callcenter Report</p>
            <i class="fas fa-angle-left right"></i>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('reporttop10in') }}"
                    class="nav-link {{ Request::is('reporttop10in') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip" title="10 อันดับเบอร์ภายใน">
                        <span class="text-truncate d-block">
                            10 อันดับเบอร์ภายใน
                        </span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('reporttop10out') }}"
                    class="nav-link {{ Request::is('reporttop10out') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip" title="10 อันดับเบอร์ภายนอก">
                        <span class="text-truncate d-block">
                            10 อันดับเบอร์ภายนอก
                        </span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('reportcaseinbyhour') }}"
                    class="nav-link {{ Request::is('reportcaseinbyhour') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip" title="ผลรวมสายเข้าภายในแยกตามช่วงเวลา">
                        <span class="text-truncate d-block">
                            ผลรวมสายเข้าภายในแยกตามช่วงเวลา
                        </span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('reportcaseoutbyhour') }}"
                    class="nav-link {{ Request::is('reportcaseoutbyhour') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip" title="ผลรวมสายเข้าภายนอกแยกตามช่วงเวลา">
                        <span class="text-truncate d-block">
                            ผลรวมสายเข้าภายนอกแยกตามช่วงเวลา
                        </span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('detailcaseinternalnumber') }}"
                    class="nav-link {{ Request::is('detailcaseinternalnumber') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip"
                        title="รายละเอียดเบอร์ภายในที่โทรเข้ามาติดต่อ">
                        <span class="text-truncate d-block">
                            รายละเอียดเบอร์ภายในที่โทรเข้ามาติดต่อ
                        </span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('detailcaseexternalnumber') }}"
                    class="nav-link {{ Request::is('detailcaseexternalnumber') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip"
                        title="รายละเอียดเบอร์ภายนอกที่โทรเข้ามาติดต่อ">
                        <span class="text-truncate d-block">
                            รายละเอียดเบอร์ภายนอกที่โทรเข้ามาติดต่อ
                        </span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('loginstatus') }}" class="nav-link {{ Request::is('loginstatus') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip" title="ผลรวมสายเข้าแยกตาม Agent">
                        <span class="text-truncate d-block">
                            สถานะการเข้าสู่ระบบ
                        </span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('reportbreak') }}" class="nav-link {{ Request::is('reportbreak') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip" title="ประวัติการหยุดรับสาย">
                        <span class="text-truncate d-block">
                            ประวัติการหยุดรับสาย
                        </span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('sumtel') }}" class="nav-link {{ Request::is('sumtel') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip" title="จำนวนสายที่ติดต่อ">
                        <span class="text-truncate d-block">
                            จำนวนสายที่ติดต่อ
                        </span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('callstatus') }}" class="nav-link {{ Request::is('callstatus') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip" title="สถานะการรับสาย">
                        <span class="text-truncate d-block">
                            สถานะการรับสาย
                        </span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('hitcall') }}" class="nav-link {{ Request::is('hitcall') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip" title="สายที่ได้รับ">
                        <span class="text-truncate d-block">
                            สายที่ได้รับ
                        </span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('misscall') }}" class="nav-link {{ Request::is('misscall') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip" title="สายที่ไม่ได้รับ">
                        <span class="text-truncate d-block">
                            สายที่ไม่ได้รับ
                        </span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('reportcase') }}" class="nav-link {{ Request::is('reportcase') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip" title="ผลรวมสายเข้าแยกตาม Agent">
                        <span class="text-truncate d-block">
                            ผลรวมสายเข้าแยกตาม Agent
                        </span>
                    </p>
                </a>
            </li>
        </ul>
    </li>
@endcan
@can('master-data-list')
    <li
        class="nav-item {{ in_array(Request::route()->getName(), ['ivrreport', 'ivrreporttop10', 'reportsumscoreagent', 'detailscore', 'detailscoreagent'])
            ? 'menu-open'
            : '' }}">
        <a href="#"
            class="nav-link {{ in_array(Request::route()->getName(), ['ivrreport', 'ivrreporttop10', 'reportsumscoreagent', 'detailscore', 'detailscoreagent'])
                ? 'active'
                : '' }}">
            <i class="fa-solid fa-print nav-icon"></i>
            <p>IVR & Survey Report</p>
            <i class="fas fa-angle-left right"></i>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('ivrreport') }}" class="nav-link {{ Request::is('ivrreport') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip" title="ivrreport">
                        <span class="text-truncate d-block">
                            IVR Report
                        </span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('ivrreporttop10') }}"
                    class="nav-link {{ Request::is('ivrreporttop10') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip" title="ivrreport">
                        <span class="text-truncate d-block">
                            IVR Report Top 10
                        </span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('reportsumscoreagent') }}"
                    class="nav-link {{ Request::is('reportsumscoreagent') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip" title="ผลรวมการประเมินความพึงพอใจ 3 อันดับ ที่ได้คะแนนสูงสุด">
                        <span class="text-truncate d-block">
                            ผลรวมการประเมินความพึงพอใจ 3 อันดับ ที่ได้คะแนนสูงสุด
                        </span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('detailscore') }}" class="nav-link {{ Request::is('detailscore') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip" title="รายละเอียดการประเมินความพึงพอใจ">
                        <span class="text-truncate d-block">
                            รายละเอียดการประเมินความพึงพอใจ
                        </span>
                    </p>
                </a>
            </li>
            <li class="nav-item custom-tooltip">
                <a href="{{ route('detailscoreagent') }}"
                    class="custom-tooltip nav-link {{ Request::is('detailscoreagent') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p class="d-inline-flex sidebar-item" data-toggle="tooltip"
                        title="ผลรวมการประเมินความพึงพอใจ ราย Agent ที่รับสาย">
                        <span class="text-truncate d-block">
                            ผลรวมการประเมินความพึงพอใจ ราย Agent
                            ที่รับสาย
                        </span>
                    </p>

                </a>
            </li>
        </ul>
    </li>
@endcan --}}
@can('master-data-list')
    <li
        class="nav-item {{ in_array(Request::route()->getName(), [
            'casetype',
            'departments',
            'positions',
            // Add more route names here if needed
        ])
            ? 'menu-open'
            : '' }}">
        <a href="#"
            class="nav-link {{ in_array(Request::route()->getName(), [
                'casetype',
                'departments',
                'positions',
                // Add more route names here if needed
            ])
                ? 'active'
                : '' }}">
            <i class="nav-icon fas fa-database"></i>
            <p>ข้อมูลหลัก</p>
            <i class="fas fa-angle-left right"></i>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('casetype6') }}" class="nav-link {{ Request::is('casetype6') ? 'active' : '' }}">
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
        </ul>
    </li>
@endcan
@can('pbx-tool')
    <li
        class="nav-item {{ in_array(Request::route()->getName(), [
            'outbound',
            'callsurvey',
            'holiday',
            'billing',
            'notify',
            'customize',
            'voicebackup',
            // Add more route names here if needed
        ])
            ? 'menu-open'
            : '' }}">
        <a href="#"
            class="nav-link {{ in_array(Request::route()->getName(), [
                'outbound',
                'callsurvey',
                'holiday',
                'billing',
                'notify',
                'customize',
                'voicebackup',
                // Add more route names here if needed
            ])
                ? 'active'
                : '' }}">
            <i class="nav-icon fa-solid fa-screwdriver-wrench"></i>
            <p>PBX-Tool</p>
            <i class="fas fa-angle-left right"></i>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('outbound') }}" class="nav-link {{ Request::is('outbound') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p>นำเข้ารายการโทรออก</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('voicebackup') }}" class="nav-link {{ Request::is('voicebackup') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p>Export ไฟล์บันทึกเสียง</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('holiday') }}" class="nav-link {{ Request::is('holiday') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p>ตั้งค่าวันหยุดประจำปี</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('callsurvey') }}" class="nav-link {{ Request::is('callsurvey') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p>ตั้งค่าระบบประเมิน</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('billing') }}" class="nav-link {{ Request::is('billing') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p>อัตราค่าใช้จ่ายการโทร</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('notify') }}" class="nav-link {{ Request::is('notify') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p>ตั้งค่าการแจ้งเตือน</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('customize') }}" class="nav-link {{ Request::is('customize') ? 'active' : '' }}">
                    <i class="fa-solid fa-xs fa-angle-right nav-icon"></i>
                    <p>ตั้งค่า Customize</p>
                </a>
            </li>
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
