@extends('layouts.app')

@section('style')
    @include('detailscore.style')
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
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong><i class="fas fa-calendar"></i> วันที่เริ่ม:</strong>
                                            {!! Form::text('start_date', null, [
                                                'id' => 'SDate',
                                                'placeholder' => '',
                                                'class' => 'SDate form-control',
                                                'data-target' => '#reservationdate',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong><i class="fas fa-calendar"></i> วันที่สิ้นสุด:</strong>
                                            {!! Form::text('end_date', null, [
                                                'id' => 'EDate',
                                                'placeholder' => '',
                                                'class' => 'EDate form-control',
                                                'data-target' => '#reservationdate',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong><i class="fa-regular fa-comment-dots"></i>
                                                Agent ที่รับสาย:</strong>
                                            <select style="width: 100%;" class="form-control" id="agent" name="agent">
                                                <option value="" selected>ทั้งหมด</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2 align-self-end">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-success" id="CreateButton">
                                                <i class="fas fa-address-book"></i> ค้นหา </button>
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
                            <h3 class="card-title"><i class="fas fa-address-book"></i>รายละเอียดการประเมินความพึงพอใจ</h3>
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
                                        <i class="fa-regular fa-file-pdf"></i> PDF </a>
                                    <a class="btn btn-success" id="exportXLSButton" {{-- href="{{ route('reportcase.pdf') }}" --}}>
                                        <i class="fa-regular fa-file-excel"></i> XLS </a>
                                    <a class="btn btn-info" id="exportPrintButton" {{-- href="{{ route('reportcase.pdf') }}" --}}>
                                        <i class="fa-solid fa-print"></i> PRINT </a>
                                </div>
                                <div id="#Listview_wrapper"></div>
                            </div>
                            <form method="post" name="delete_all" id="delete_all">
                                @csrf
                                @method('POST')
                                <table id="Listview" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th width="20px"><input type="checkbox" id="check-all" class="flat"></th>
                                            <th>วันที่</th>
                                            <th>เวลา</th>
                                            <th>เบอร์โทรศัพท์</th>
                                            <th>คิว</th>
                                            <th>Agent ที่รับสาย</th>
                                            <th>คะแนน</th>
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
    @include('detailscore.script')
@endsection
