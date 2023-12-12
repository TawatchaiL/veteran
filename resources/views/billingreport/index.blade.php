@extends('layouts.app')

@section('style')
    @include('billingreport.style')
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
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
                            <div class="row">
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong>
                                            วันที่โทรเข้า:</strong>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control float-right" id="reservation"
                                                readonly>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-xs-2 col-sm-2 col-md-2">
                                    <div class="form-group">
                                        <strong><i class="fas fa-square-phone"></i> เบอร์ที่ติดต่อ:</strong>
                                        {{-- {!! Form::text('telp', null, ['id' => 'telp', 'placeholder' => '', 'class' => 'form-control']) !!} --}}
                                        <input type="text" name="telp" id="telp" class="form-control"
                                            autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2">
                                    <div class="form-group">
                                        <strong><i class="fa-solid fa-building-user"></i>
                                            แผนก:</strong>
                                        <select style="width: 100%;" class="select2 form-control" id="cdepartment"
                                            name="cdepartment">
                                            <option value="">ทั้งหมด</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">
                                                    {{ $department->name ?? 'ไม่พบแผนก' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2">
                                    <div class="form-group">
                                        <strong><i class="fas fa-user"></i>
                                            Agent:</strong>
                                        <select style="width: 100%;" class="select2 form-control" id="agen"
                                            name="agen">
                                            @can('voice-record-supervisor')
                                                <option value="" selected>ทั้งหมด</option>
                                            @endcan
                                            @foreach ($agens as $agen)
                                                @can('voice-record-supervisor')
                                                    <option value="{{ $agen->id }}">
                                                        {{ $agen->name ?? 'ไม่พบเบอร์โทรศัพท์' }}
                                                    </option>
                                                @else
                                                    {{-- For non-supervisors, only show their own agent --}}
                                                    @if (Auth::user()->id == $agen->id)
                                                        <option value="{{ $agen->id }}">
                                                            {{ $agen->name ?? 'ไม่พบเบอร์โทรศัพท์' }}
                                                        </option>
                                                    @endif
                                                @endcan
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2">
                                    <div class="form-group">
                                        <strong><i class="fa-solid fa-list"></i>
                                            ประเภท:</strong>
                                        <select style="width: 100%;" class="select2 form-control" id="ctype"
                                            name="ctype">
                                            <option value="">ทั้งหมด</option>
                                            <option value="1"> สายเข้า</option>
                                            <option value="2"> โทรออก</option>
                                            <option value="3"> ภายใน</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 align-self-end">
                                    <div class="form-group">
                                        <a class="btn btn-success" id="searchButton"> <i class="fas fa-search"></i>
                                        </a>
                                        <a class="btn bg-warning" id="resetSearchButton"> <i class="fa-solid fa-rotate"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                            <div class="row ">

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
                            <h3 class="card-title"><i class="fa-solid fa-comment-dollar"></i> ประวัติและค่าใช้จ่ายการโทร
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
                                            <th>วันที่</th>
                                            <th>เวลา</th>
                                            <th>เบอร์ต้นทาง</th>
                                            <th>เบอร์ปลายทาง</th>
                                            <th>เวลาที่ใช้สาย</th>
                                            <th>ประเภทค่าใช้จ่าย</th>
                                            <th>อัตราค่าใช้จ่าย</th>
                                            <th>ต่อ</th>
                                            <th>เป็นเงิน</th>
                                            <th width="120px"></th>
                                            <th>More</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th align="right"></th>
                                            <th align="right"></th>
                                            <th align="right"></th>
                                            <th align="right"></th>
                                            <th align="center">รวม</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.modal-form')
@endsection
@section('script')
    @include('billingreport.script')
@endsection
