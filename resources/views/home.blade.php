@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4><i class="fa-solid fa-chart-pie"></i> สถิติการรับสาย และ รับเคสของ [{{ Auth::user()->name }}]</h4>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i
                                        class="fa-solid fa-arrow-right-to-bracket"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">สายเข้า</span>
                                    <span class="info-box-number"><span id="total_call">0</span> ครั้ง</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-solid fa-user-clock"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">เวลารอสายเฉลี่ย</span>
                                    <span class="info-box-number" id="avg_wait">00:00:00</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-solid fa-phone-volume"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เวลาที่สนทนาทั้งหมด</span>
                                    <span class="info-box-number" id="total_talk">00:00:00</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-solid fa-headset"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เวลาสนทนาเฉลี่ยต่อสาย</span>
                                    <span class="info-box-number" id="avg_talk"> 00:00:00</span>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-solid fa-clipboard-question"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เคสที่รับแจ้ง</span>
                                    <span class="info-box-number"><span id="total_case">0</span> เคส</span>
                                </div>

                            </div>

                        </div>


                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-solid fa-clipboard-check"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เคสที่ปิดเคสแล้ว</span>
                                    <span class="info-box-number"><span id="total_closed_case">0</span> เคส</span>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-solid fa-shuffle"></i></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">เคสที่โอนสาย</span>
                                    <span class="info-box-number"><span id="total_tranfer_case">0</span> เคส</span>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6  col-xl-3 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa-solid fa-star"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text ">คะแนนความพึงพอใจ</span>
                                    <span class="info-box-number">ล่าสุด <span id="latest_score">0</span> / ทั้งหมด
                                        <span id="total_score">0</span></span>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">

                            <div class="card card-primary" style="max-height:480px">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa-solid fa-chart-line"></i> สถิติการรับสายตามช่วงเวลา
                                        00:00 - 23:59
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                            <i class="fas fa-expand"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="hour_chart" style="width: 100%; height: 450px;"></div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="card card-primary" style="max-height: 480px">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa-solid fa-chart-line"></i> สถิติ สายเข้า รายวัน
                                        ประจำเดือน {{ date('Y-m') }}
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                            <i class="fas fa-expand"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <div class="col-md-12">
                                            <div id="chart_date" style="width: 100%; height: 450px;"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>



                    </div>
                    <div class="row">
                        <div class="col-md-8">

                            <div class="card card-primary" style="max-height: 455px">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa-solid fa-chart-line"></i> สถิติ
                                        เคสที่รับแจ้งทั้งหมด /
                                        เคสที่โอนสาย รายวัน ประจำเดือน {{ date('Y-m') }}
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                            <i class="fas fa-expand"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <div class="col-md-12">
                                            <div id="chart_case"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="card card-primary" style="max-height: 455px">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa-solid fa-chart-line"></i> คะแนน ความพึงพอใจ </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                            <i class="fas fa-expand"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div id="chart_call_survey" style="width: 100%; height: 420px;"></div>
                                    </div>
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
