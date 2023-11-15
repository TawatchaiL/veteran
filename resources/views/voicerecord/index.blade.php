@extends('layouts.app')

@section('style')
    @include('voicerecord.style')
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa-solid fa-magnifying-glass"></i> Filter</h3>
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

                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>
                                                วันที่:</strong>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control float-right" id="reservation">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong><i class="fas fa-square-phone"></i> เบอร์ที่โทรเข้า:</strong>
                                            {{-- {!! Form::text('telp', null, ['id' => 'telp', 'placeholder' => '', 'class' => 'form-control']) !!} --}}
                                            <input type="text" name="telp" id="telp" class="form-control"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong><i class="fas fa-user"></i>
                                                Agent ที่รับสาย:</strong>
                                            <select style="width: 100%;" class="select2 form-control" id="agen"
                                                name="agen">
                                                <option value="" selected>ทั้งหมด</option>
                                                @foreach ($agens as $agen)
                                                    <option value="{{ $agen->id }}">{{ $agen->name ?? 'ไม่พบเบอร์โทรศัพท์'}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2 align-self-end">
                                        <div class="row">
                                            <div class="col-xs-2 col-sm-2 col-md-2 align-self-end">
                                                <div class="form-group">
                                                    <button class="btn btn-success" id="searchButton"> <i class="fas fa-search"></i> Search </button>
                                                </div>
                                            </div>
                                            <div class="col-xs-2 col-sm-2 col-md-2 align-self-end">
                                                <div class="form-group">
                                                    <button class="btn bg-warning" id="resetSearchButton"> <i class="fa-solid fa-rotate"></i> Reset </button>
                                                </div>
                                            </div>
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
                            <h3 class="card-title"><i class="fa-solid fa-volume-high"></i> ไฟล์บันทึกเสียงสนทนา
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


                            {{-- <button class="changeUrlButton">Change URL</button> --}}
                            <div class="col-xs-12 col-sm-12 col-md-12 align-self-end text-right">
                                <div class="form-group">
                                    <a class="btn btn-warning" id="exportVoiceButton" {{-- href="{{ route('reportcase.pdf') }}" --}}>
                                        <i class="fa-solid fa-file-export"></i> Export </a>
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
                                            <th width="5%"><input type="checkbox" id="check-all" class="flat">
                                            </th>
                                            <th>วันที่</th>
                                            <th>เวลา</th>
                                            <th>เบอร์โทรศัพท์</th>
                                            <th>Agent ที่รับสาย</th>
                                            <th>เวลาที่ใช้สาย</th>
                                            <th width="100px"></th>
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
    @include('layouts.modal-form')
    @include('voicerecord.create')
@endsection
@section('script')
    @include('voicerecord.script')
@endsection
