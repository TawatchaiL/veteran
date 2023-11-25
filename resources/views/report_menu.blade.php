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
