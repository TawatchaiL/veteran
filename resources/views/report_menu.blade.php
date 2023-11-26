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
                                    View</button></span>
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
                                    View</button></span>
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
                                    View</button></span>
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
                                    View</button></span>
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
                                    View</button></span>
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
                                    View</button></span>
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
                                    View</button></span>
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
                                    View</button></span>
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
                <div class="col-12">

                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> 10 อันดับเรื่องที่ติดต่อมากที่สุด</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('reportcasetop10') }}'"
                                            class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                            View</button></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> 10 อันดับเรื่องที่ติดต่อมากที่สุด</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('reportcasetop10') }}'"
                                            class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                            View</button></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> 10 อันดับเรื่องที่ติดต่อมากที่สุด</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('reportcasetop10') }}'"
                                            class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                            View</button></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> 10 อันดับเรื่องที่ติดต่อมากที่สุด</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('reportcasetop10') }}'"
                                            class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                            View</button></span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> 10 อันดับเรื่องที่ติดต่อมากที่สุด</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('reportcasetop10') }}'"
                                            class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                            View</button></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> 10 อันดับเรื่องที่ติดต่อมากที่สุด</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('reportcasetop10') }}'"
                                            class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                            View</button></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> 10 อันดับเรื่องที่ติดต่อมากที่สุด</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('reportcasetop10') }}'"
                                            class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                            View</button></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> 10 อันดับเรื่องที่ติดต่อมากที่สุด</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('reportcasetop10') }}'"
                                            class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                            View</button></span>
                                </div>
                            </div>
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
                <div class="col-12">

                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> 10 อันดับเรื่องที่ติดต่อมากที่สุด</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('reportcasetop10') }}'"
                                            class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                            View</button></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> 10 อันดับเรื่องที่ติดต่อมากที่สุด</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('reportcasetop10') }}'"
                                            class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                            View</button></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> 10 อันดับเรื่องที่ติดต่อมากที่สุด</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('reportcasetop10') }}'"
                                            class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                            View</button></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> 10 อันดับเรื่องที่ติดต่อมากที่สุด</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('reportcasetop10') }}'"
                                            class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                            View</button></span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> 10 อันดับเรื่องที่ติดต่อมากที่สุด</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('reportcasetop10') }}'"
                                            class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                            View</button></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> 10 อันดับเรื่องที่ติดต่อมากที่สุด</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('reportcasetop10') }}'"
                                            class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                            View</button></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> 10 อันดับเรื่องที่ติดต่อมากที่สุด</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('reportcasetop10') }}'"
                                            class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                            View</button></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4  col-xl-4 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> 10 อันดับเรื่องที่ติดต่อมากที่สุด</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('reportcasetop10') }}'"
                                            class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                            View</button></span>
                                </div>
                            </div>
                        </div>

                    </div>



                </div>

            </div>

        </div>
    </section>
@endsection

@section('script')
@endsection
