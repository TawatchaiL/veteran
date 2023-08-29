@extends('layouts.app')

@section('style')
    @include('contacts.style')
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


                        @can('contact-create')
                            <button type="button" class="btn btn-success" id="CreateButton">
                                <i class="fas fa-address-book"></i> เพิ่ม รายชื่อผู้ติดต่อ </button>
                        @else
                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="bottom"
                                title="คุณไม่มีสิทธิ์ในส่วนนี้">
                                <button type="button" class="btn btn-success disabled">
                                    <i class="fas fa-address-book"></i> เพิ่ม รายชื่อผู้ติดต่อ </button>
                            </span>
                        @endcan &nbsp;

                        @can('contact-delete')
                            <button type="button" class="btn btn-danger delete_all_button"><i class="fa fa-trash"></i> ลบ
                                ทั้งหมด</button>
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
                            <h3 class="card-title"><i class="fas fa-address-book"></i> รายชื่อผู้ติดต่อ</h3>
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
                        <div class="row">
                            <div class="col-xs-2 col-sm-2 col-md-2">
                                <div class="form-group">
                                    <strong><i class="fa-solid fa-phone"></i>
                                        ประเภทการค้นหา:</strong>
                                    <select style="width: 100%;" class="select2 form-control" id="telin"
                                        name="telin">
                                        <option value="" selected>เบอร์โทรฉุกเฉิน</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-2 col-sm-2 col-md-2">
                                <div class="form-group">
                                    <strong><i class="fa-solid fa-hashtag"></i> รายละเอียดที่ต้องการค้นหา:</strong>
                                    {!! Form::text('name', null, ['id' => 'AddName', 'placeholder' => 'เบอร์ต้นทาง', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-2 col-sm-2 col-md-2" style="display: flex; align-items: flex-end;">
                                <div class="form-group">
                                    <button type="button" class="btn btn-success" id="CreateButtons" style="margin-top: auto;">
                                        <i class="fas fa-search"></i> ค้นหา </button>
                                </div>
                            </div>
                        </div>
                            <form method="post" action="{{ route('contacts.destroy_all') }}" name="delete_all"
                                id="delete_all">
                                @csrf
                                @method('POST')
                                <table id="Listview" class="display nowrap table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%"><input type="checkbox" id="check-all" class="flat"></th>
                                            <th>รหัสผู้ติดต่อ</th>
                                            <th>ชื่อผู้ติดต่อ</th>
                                            <th>เบอร์โทรศัพท์บ้าน</th>
                                            <th>เบอร์โทรศัพท์มือถือ</th>
                                            <th>วันที่บันทึก</th>
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

    </section>


    @include('contacts.create')

    @include('contacts.edit')

    {{--  {!! $data->render() !!} --}}
@endsection

@section('script')
    @include('contacts.script')
@endsection
