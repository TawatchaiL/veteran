@extends('layouts.app')

@section('style')
    @include('cases.style')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4></h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users Management</li> --}}

                        @can('case-create')
                            <button type="button" class="btn btn-success" id="CreateButton">
                                <i class="fa-solid fa-clipboard-list"></i> เพิ่มเรื่องที่ติดต่อ</a> </button>
                        @else
                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="bottom"
                                title="คุณไม่มีสิทธิ์ในส่วนนี้">
                                <button type="button" class="btn btn-success disabled">
                                    <i class="fa-solid fa-clipboard-list"></i> เพิ่มเรื่องที่ติดต่อ </a></button>
                            </span>
                        @endcan &nbsp;

                        @can('case-delete')
                            <button type="button" class="btn btn-danger delete_all_button"><i class="fa fa-trash"></i>
                                ลบทั้งหมด</button>
                        @else
                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="bottom"
                                title="คุณไม่มีสิทธิ์ในส่วนนี้">
                                <button type="button" class="btn btn-danger disabled"><i class="fa fa-trash"></i>
                                    ลบทั้งหมด</button>
                            </span>
                        @endcan
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
                            <h3 class="card-title"><i class="fa-solid fa-clipboard-list"></i> เรื่องที่ติดต่อ</h3>
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
                            <div class="row ">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="row float-lg-left">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>
                                                    วันที่บันทึกข้อมูล:</strong>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" id="reservation"
                                                        style="width: 210px">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row float-lg-right">
                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <strong><i class="fa-solid fa-clipboard-question"></i>
                                                    ประเภทการค้นหา:</strong>
                                                <select style="width: 170px;" class="select2 form-control" id="seachtype"
                                                    name="seachtype">
                                                    <option value="0" selected>ตัวเลือกการค้นหา</option>
                                                    <option value="1">กำลังดำเนินการ</option>
                                                    <option value="2">ปิดเคส</option>
                                                    <option value="3">เลขประจำตัว</option>
                                                    <option value="4">ชื่อ-สกุล</option>
                                                    <option value="5">เบอร์โทร</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <strong><i class="fa-regular fa-keyboard"></i> คำที่ต้องการค้นหา:</strong>
                                                {!! Form::text('seachtext', null, ['id' => 'seachtext', 'placeholder' => '', 'class' => 'form-control']) !!}
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
                            <div class="row ">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <form method="post" action="{{ route('cases.destroy_all') }}" name="delete_all"
                                        id="delete_all">
                                        @csrf
                                        @method('POST')
                                        <table id="Listview"
                                            class="display nowrap table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="5%"><input type="checkbox" id="check-all"
                                                            class="flat"></th>
                                                    <th>วันที่บันทึกข้อมูล</th>
                                                    <th>HN</th>
                                                    <th>ชื่อสกุล</th>
                                                    <th>เบอร์โทร</th>
                                                    <th>ประเภทเคส</th>
                                                    <th>สถานะเคส</th>
                                                    <th>สถานะการโอนสาย</th>
                                                    <th>ผู้บันทึก</th>
                                                    <th width="120px"></th>
                                                    <th>More</th>
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

            </div>

        </div>

    </section>

    @include('cases.create')
@endsection

@section('script')
    @include('cases.script')
@endsection
