@extends('layouts.app')

@section('style')
    @include('callstatus.style')
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa-solid fa-magnifying-glass"></i> Filter</h3>
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
                                    <div class="col-xs-2 col-sm-2 col-md-2 align-self-end">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-success" id="btnsearch">
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
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-address-ยพรืะ"></i>สถานะการรับสาย
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
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
                                            <th width="5%">ลำดับ</th>
                                            <th>Agent</th>
                                            <th>สายที่รับ</th>
                                            <th>เวลารอสายเฉลี่ย</th>
                                            <th>เวลาสนทนา</th>
                                            <th>เวลาสนทนาเฉลี่ย</th>
                                            <th>เวลาที่Login</th>
                                            <th>เวลาที่พัก</th>
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
    @include('callstatus.script')
@endsection
