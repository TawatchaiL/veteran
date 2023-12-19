@extends('layouts.app')

@section('style')
    @include('detailscoreagent.style')
@endsection



@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa-solid fa-magnifying-glass"></i> ผลรวมการประเมินความพึงพอใจ ราย
                                Agent
                                ที่รับสาย</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                {{-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-12">
                                <ol class="breadcrumb float-sm-center">
                                    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item active">Users Management</li> --}}
                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <strong>
                                                    วันที่บันทึกข้อมูล:</strong>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" id="reservation" style="width: 210px" readonly>
                                                </div>
                
                                            </div>
                                        </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong><i class="fa-regular fa-comment-dots"></i>
                                                Agent:</strong>
                                            <select style="width: 100%;" class="select2 form-control" id="Agent"
                                                name="Agent">
                                                <option value="0" selected>ทั้งหมด</option>
                                                @foreach($agents as $agentss)
                                                    <option value="{{ $agentss->id }}">{{ $agentss->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2 align-self-end">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-success btnsearch" id="btnsearch">
                                                <i class="fas fa-search"></i> ค้นหา </button>
                                        </div>
                                    </div>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row" style="display: flex; justify-content: center; align-items: center;">
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <div class="card card-success card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                        href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                                        aria-selected="true">Bar Graph</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                        href="#custom-tabs-one-line" role="tab" aria-controls="custom-tabs-one-profile"
                                        aria-selected="false">Line Graph</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                        href="#custom-tabs-one-pie" role="tab" aria-controls="custom-tabs-one-profile"
                                        aria-selected="false">Pie Graph</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                                    aria-labelledby="custom-tabs-one-home-tab">
                                    <div class="col-xs-12 col-sm-12 col-md-12 align-self-end text-right">
                                        <button id="download_bar" class="btn btn-info">
                                            <i class="fas fa-file-pdf"></i> บันทึกเป็น PDF
                                        </button>
                                        <button id="download_bar_img" class="btn btn-warning">
                                            <i class="fas fa-file-image"></i> บันทึกเป็นรูป
                                        </button>
                                        <button id="print_bar" class="btn btn-secondary">
                                            <i class="fas fa-print"></i> พิมพ์กราฟ
                                        </button>
                                    </div>
                                    <div class="col-sm-10 mx-auto text-center" id="bar_chart_div">
                                        <div id="bar_graph" ></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-line" role="tabpanel"
                                    aria-labelledby="custom-tabs-one-line-tab">
                                    <div class="col-xs-12 col-sm-12 col-md-12 align-self-end text-right">
                                        <button id="download_line" class="btn btn-info">
                                            <i class="fas fa-file-pdf"></i> บันทึกเป็น PDF
                                        </button>
                                        <button id="download_line_img" class="btn btn-warning">
                                            <i class="fas fa-file-image"></i> บันทึกเป็นรูป
                                        </button>
                                        <button id="print_line" class="btn btn-secondary">
                                            <i class="fas fa-print"></i> พิมพ์กราฟ
                                        </button>
                                    </div>
                                    <div class="col-sm-10 mx-auto text-center" id="bar_chart_div">
                                        <div id="line_graph" ></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-pie" role="tabpanel"
                                    aria-labelledby="custom-tabs-one-pie-tab">
                                    <div class="col-xs-12 col-sm-12 col-md-12 align-self-end text-right">
                                        <button id="download_pie" class="btn btn-info">
                                            <i class="fas fa-file-pdf"></i> บันทึกเป็น PDF
                                        </button>
                                        <button id="download_pie_img" class="btn btn-warning">
                                            <i class="fas fa-file-image"></i> บันทึกเป็นรูป
                                        </button>
                                        <button id="print_pie" class="btn btn-secondary">
                                            <i class="fas fa-print"></i> พิมพ์กราฟ
                                        </button>
                                    </div>
                                    <div class="col-sm-10 mx-auto text-center" id="bar_chart_div">
                                        <div id="pie_graph" ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="fa-solid fa-print"></i> ผลรวมการประเมินความพึงพอใจ ราย Agent
                                ที่รับสาย</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                {{-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button> --}}
                            </div>
                        </div>

                        <div class="card-body">
                            @if ($message = Session::get('success'))
                                {{--  <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div> --}}
                                <script>
                                    toastr.success('{{ $message }}', {
                                        timeOut: 5000
                                    });
                                </script>
                            @endif
                            <div class="col-xs-12 col-sm-12 col-md-12 align-self-end text-right">
                                <div class="form-group">
                                    <a class="btn btn-danger" id="exportPDFButton" {{-- href="{{ route('reportcase.pdf') }}" --}}>
                                        <i class="fa-regular fa-file-pdf"></i> PDF / <i class="fa-solid fa-print"></i> PRINT</a>
                                    <a class="btn btn-success" id="exportXLSButton" {{-- href="{{ route('reportcase.pdf') }}" --}}>
                                        <i class="fa-regular fa-file-excel"></i> XLS </a>
                                </div>
                                <div id="#Listview_wrapper"></div>
                            </div>
                            <form method="post" name="delete_all" id="delete_all">
                                @csrf
                                @method('POST')
                                <table id="Listview" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%">ลำดับ
                                            </th>
                                            <th>Agent</th>
                                            <th>ระดับคะแนน</th>
                                            <th width="280px">จำนวน</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
@endsection

@section('script')
    @include('detailscoreagent.script')
@endsection
