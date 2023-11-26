@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">

        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4><i class="fa-solid fa-chart-pie"></i> CRM Report</h4>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
            <div class="row">

                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> 10 อันดับเรื่องที่ติดต่อมากที่สุด</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('reportcasetop10') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> ผลรวมเรื่องที่ติดต่อแยกตามประเภทที่ติดต่อ</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('reportsumbytype') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> ผลรวมเรื่องที่ติดต่อแยกตามสถานะ</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('reportsumcasebystatus') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>



                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> ผลรวมเรื่องที่ติดต่อแยกตามสถานะการโอนสาย</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('reportsumcasebytranferstatus') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> ผลรวมเรื่องที่ติดต่อแยกตาม HN</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('sumcasebyhn') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> รายการเรื่องที่ติดต่อ</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('detailcases') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>


                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> รายการเรื่องที่ติดต่อแสดงตามสถานะ</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('detailcasesstatus') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm">รายการเรื่องที่ติดต่อที่มีการ แก้ไข และการคอมเม้น</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('detailcaselogbyhn') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>


            </div>

        </div>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4><i class="fa-solid fa-chart-pie"></i> Callcenter Report</h4>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> ผลรวมสายเข้าแยกตาม Agent</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('reportcase') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> จำนวนสายที่ติดต่อ</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('sumtel') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> สถานะการรับสาย</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('callstatus') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> สายที่ได้รับบริการ</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('hitcall') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> สายที่ไม่ได้รับบริการ</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('misscall') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> ผลรวมสายเข้าภายในแยกตามช่วงเวลา</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('reportcaseinbyhour') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> ผลรวมสายเข้าภายนอกแยกตามช่วงเวลา</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('reportcaseoutbyhour') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> สถานะการเข้าสู่ระบบ</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('loginstatus') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> ประวัติการพักรับสาย</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('reportbreak') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> 10 อันดับเบอร์ภายในที่โทรเข้ามาติดต่อ</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('reporttop10in') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> 10 อันดับเบอร์ภายนอกที่โทรเข้ามาติดต่อ</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('reporttop10out') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>



                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> รายละเอียดเบอร์ภายในที่โทรเข้ามาติดต่อ</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('detailcaseinternalnumber') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> รายละเอียดเบอร์ภายนอกที่โทรเข้ามาติดต่อ</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('detailcaseexternalnumber') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4><i class="fa-solid fa-chart-pie"></i> IVR & Call Survey Report</h4>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
            <div class="row">

                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> IVR Report</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('ivrreport') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> IVR Report Top 10</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('ivrreporttop10') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> ผลรวมคะแนนความพึงพอใจ 3 อันดับแรก</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('reportsumscoreagent') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> รายละเอียดการประเมินความพึงพอใจ</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('detailscore') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>


                <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text-sm"> ผลรวมการประเมินความพึงพอใจ ราย Agent
                                ที่รับสาย</span>
                            <span class="info-box-number text-right"><button
                                    onclick="window.location.href='{{ route('detailscoreagent') }}'"
                                    class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                    ดูรายงาน</button></span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section>
@endsection

@section('script')
@endsection
