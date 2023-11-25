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
                <div class="col-12">

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
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
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> ผลรวมแยกตามประเภทที่ติดต่อ</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('reportsumbytype') }}'"
                                            class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                            View</button></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> ผลรวมแยกตามสถานะ</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('reportsumcasebystatus') }}'"
                                            class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                            View</button></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> ผลรวมแยกตามสถานะการโอนสาย</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('reportsumcasebytranferstatus') }}'"
                                            class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                            View</button></span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> ผลรวมเรื่องที่ติดต่อแยกตาม HN</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('sumcasebyhn') }}'"
                                            class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                            View</button></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> รายการเรื่องที่ติดต่อ</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('detailcases') }}'"
                                            class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                            View</button></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"> รายการเรื่องที่ติดต่อแสดงตามสถานะ</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('detailcasesstatus') }}'"
                                            class="btn btn-success btn-sm"><i class="fas fa-search"></i>
                                            View</button></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fa-solid fa-print"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">รายการแก้ไข/คอมเม้น เรื่องที่ติดต่อ</span>
                                    <span class="info-box-number text-right"><button
                                            onclick="window.location.href='{{ route('detailcaselogbyhn') }}'"
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
                    <h4><i class="fa-solid fa-chart-pie"></i> Callcenter Report</h4>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
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
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
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
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
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
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
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
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
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

                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
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
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
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
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
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
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
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
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
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
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
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
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
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
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
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

                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
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
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
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
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
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
    @include('script')
@endsection
