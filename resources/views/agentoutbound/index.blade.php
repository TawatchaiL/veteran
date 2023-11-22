@extends('layouts.app')

@section('style')
    <style>
        .dataTables_filter {
            display: none;
        }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h4>Users & Roles Management</h4> --}}
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users Management</li> --}}
                    </ol>

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
                            <h3 class="card-title"><i class="fas fa-list-ol"></i> รายการโทรออก </h3>
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
                            <div class="row ">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="row float-lg-left">
                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <strong><i class="fa-solid fa-calendar"></i>
                                                    ประเภทวันที่:</strong>
                                                <select style="width: 100%;" class="select2 form-control" id="searchtype"
                                                    name="searchtype">
                                                    <option value="1">วันที่สร้าง</option>
                                                    <option value="2">วันที่โทร</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-8 col-sm-8 col-md-8">
                                            <div class="form-group">
                                                <strong><i class="fa-solid fa-calendar"></i> วันที่: 
                                                </strong>
                                                <input type="text" class="form-control" id="reservation"
                                                    style="width: 350px">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row float-lg-right">

                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <strong><i class="fa-solid fa-id-card"></i>
                                                    ประเภทรายการ:</strong>
                                                <select style="width: 100%;" class="select2 form-control" id="calltype"
                                                    name="calltype">
                                                    <option value="1">ยังไม่ได้โทรออก</option>
                                                    <option value="2">โทรออกแล้ว</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <strong><i class="fa-regular fa-keyboard"></i>
                                                    เบอร์โทร:</strong>
                                                {!! Form::text('searchtext', null, [
                                                    'id' => 'searchtext',
                                                    'placeholder' => 'เบอร์โทร',
                                                    'class' => 'form-control',
                                                ]) !!}
                                                <span id="validationMessages" style="color: red;"></span>
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2">
                                            <strong>&nbsp;</strong>
                                            <button type="button" class="form-control btn btn-success" id="btnsearch">
                                                <i class="fas fa-search"></i></button>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2" style="align-items: flex-end;">
                                            <strong>&nbsp;</strong>
                                            <button type="button" class="form-control btn btn-warning" id="btnreset">
                                                <i class="fa-solid fa-rotate-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <table id="Listview"
                                        class="display nowrap table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th width="50px"><input type="checkbox" id="check-all" class="flat">
                                                </th>
                                                <th>วันเวลาที่สร้าง</th>
                                                <th>วันเวลาที่โทร</th>
                                                <th>เบอร์โทร</th>
                                                <th>สถานะ</th>
                                                <th>Agent</th>
                                                <th width="180px"></th>
                                                <th>More</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
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
    @include('agentoutbound.script')
@endsection
