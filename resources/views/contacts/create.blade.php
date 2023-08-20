<div class="modal fade" id="CreateModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="fas fa-address-book"></i> เพิ่ม รายชื่อผู้ติดต่อ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong>Something went wrong.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">

                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>


                {{-- 'route' => 'users.store', --}}
                {!! Form::open(['method' => 'POST', 'class' => 'form']) !!}

                <div class="card card-success card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                    href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                                    aria-selected="true">ข้อมูลผู้ติดต่อ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                    href="#custom-tabs-one-profile" role="tab"
                                    aria-controls="custom-tabs-one-profile" aria-selected="false">ข้อมูลอื่นๆ</a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                                aria-labelledby="custom-tabs-one-home-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-code"></i> รหัสผู้ติดต่อ.</strong>
                                                    {!! Form::text('code', null, [
                                                        'id' => 'AddCode',
                                                        'placeholder' => 'Code',
                                                        'class' => 'form-control',
                                                        'readonly' => true,
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-calendar"></i> วันที่บันทึก:</strong>
                                                    {!! Form::text('start_date', null, [
                                                        'id' => 'AddDate',
                                                        'placeholder' => '',
                                                        'class' => 'AddDate form-control',
                                                        'data-target' => '#reservationdate',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            {{-- <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-book-open"></i> Start Term:</strong>
                                                    <select style="width: 100%;"
                                                        class="select2 select2_single form-control" id="AddSTerm"
                                                        name="sterm" multiple="multiple">
                                                        @foreach ($term as $keyt)
                                                            <option value="{{ $keyt->id }}">
                                                                {{ $keyt->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-user-tie"></i> ชื่อ:</strong>
                                                    {!! Form::text('name', null, ['id' => 'AddName', 'placeholder' => 'Name', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-user-tie"></i> นามสกุล:</strong>
                                                    {!! Form::text('name', null, ['id' => 'AddName', 'placeholder' => 'Name', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            {{-- <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-layer-group"></i> Level:</strong>
                                                    <select style="width: 100%;"
                                                        class="select2 select2_single form-control" id="AddLevel"
                                                        name="level" multiple="multiple">
                                                        @foreach ($term as $keyt)
                                                            <option value="{{ $keyt->id }}">
                                                                {{ $keyt->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div> --}}

                                        </div>
                                        {{-- <div class="row">
                                           
                                            <div class="col-xs-3 col-sm-3 col-md-3">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-book-open"></i> Term:</strong>
                                                    <select style="width: 100%;"
                                                        class="select2 select2_single form-control" id="AddTerm"
                                                        name="term" multiple="multiple">
                                                        @foreach ($term as $keyt)
                                                            <option value="{{ $keyt->id }}">
                                                                {{ $keyt->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div> --}}
                                        {{--  <div class="col-xs-3 col-sm-3 col-md-3">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-book-medical"></i> BookUse:</strong>
                                                    <select style="width: 100%;"
                                                        class="select2 select2_single form-control" id="AddBook"
                                                        name="book" multiple="multiple">
                                                        @foreach ($term as $keyt)
                                                            <option value="{{ $keyt->id }}">
                                                                {{ $keyt->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div> 
                                        </div> --}}
                                    </div>
                                </div>

                                {{-- <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xs-2 col-sm-2 col-md-2">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-handshake-slash"></i>
                                                        Discontinued:</strong>
                                                    <div class="custom-control custom-switch">
                                                        {{ Form::checkbox('discontinued', '1', false, ['id' => 'customCheckbox1', 'class' => 'custom-control-input name', 'disabled' => true]) }}
                                                        <label for="customCheckbox1" class="custom-control-label">
                                                            Discontinued</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-calendar"></i> Date</strong>
                                                    {!! Form::text('ddate', null, [
                                                        'id' => 'AddDDate',
                                                        'placeholder' => '',
                                                        'class' => 'form-control',
                                                        'disabled' => true,
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-list"></i> Reason</strong>
                                                    {!! Form::text('reason', null, [
                                                        'id' => 'AddReason',
                                                        'placeholder' => '',
                                                        'class' => 'form-control',
                                                        'disabled' => true,
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div> --}}
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-home"></i> บ้านเลขที่:</strong>
                                                    {!! Form::text('postcode', null, [
                                                        'id' => 'AddPostcode',
                                                        'placeholder' => 'Postcode',
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong> หมู่:</strong>
                                                    {!! Form::text('homephone', null, [
                                                        'id' => 'homephone',
                                                        'placeholder' => 'Telephone',
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong> ซอย :</strong>
                                                    {!! Form::text('postcode', null, [
                                                        'id' => 'AddPostcode',
                                                        'placeholder' => 'Postcode',
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-road"></i> ถนน :</strong>
                                                    {!! Form::text('homephone', null, [
                                                        'id' => 'homephone',
                                                        'placeholder' => 'Telephone',
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong>จังหวัด :</strong>
                                                    <select style="width: 100%;"
                                                        class="select2 select2_city form-control" id="city"
                                                        name="city" multiple="multiple">
                                                        <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                    <option value="" selected>Select Parent</option>-->

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong>อำเภอ:</strong>
                                                    <select style="width: 100%;"
                                                        class="select2 select2_am form-control" id="am"
                                                        name="am" multiple="multiple">
                                                        <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                    <option value="" selected>Select Parent</option>-->

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong>ตำบล :</strong>
                                                    <select style="width: 100%;"
                                                        class="select2 select2_tm form-control" id="tm"
                                                        name="tm" multiple="multiple">
                                                        <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                    <option value="" selected>Select Parent</option>-->

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-code"></i> รหัสไปรษณีย์:</strong>
                                                    {!! Form::text('postcode', null, [
                                                        'id' => 'AddPostcode',
                                                        'placeholder' => 'Postcode',
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-phone"></i> เบอร์โทรศัพท์บ้าน:</strong>
                                                    {!! Form::text('homephone', null, [
                                                        'id' => 'homephone',
                                                        'placeholder' => 'Telephone',
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-phone"></i> เบอร์โทรศัพท์มือถือ :</strong>
                                                    {!! Form::text('telephone', null, [
                                                        'id' => 'telephone',
                                                        'placeholder' => 'Postcode',
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-phone"></i>
                                                        เบอร์โทรศัพท์ที่ทำงาน:</strong>
                                                    {!! Form::text('workphone', null, [
                                                        'id' => 'workphone',
                                                        'placeholder' => 'Telephone',
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                aria-labelledby="custom-tabs-one-profile-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-graduation-cap"></i>Father Name:</strong>
                                                    {!! Form::text('name', null, ['id' => 'AddName', 'placeholder' => 'Name', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-at"></i> Email:</strong>
                                                    {!! Form::text('email', null, ['id' => 'AddEmail', 'placeholder' => 'Email', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-phone"></i> Mobile:</strong>
                                                    {!! Form::text('telephone', null, [
                                                        'id' => 'AddTelephone',
                                                        'placeholder' => 'Telephone',
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-graduation-cap"></i>Mother Name:</strong>
                                                    {!! Form::text('name', null, ['id' => 'AddName', 'placeholder' => 'Name', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-at"></i> Email:</strong>
                                                    {!! Form::text('email', null, ['id' => 'AddEmail', 'placeholder' => 'Email', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-phone"></i> Mobile:</strong>
                                                    {!! Form::text('telephone', null, [
                                                        'id' => 'AddTelephone',
                                                        'placeholder' => 'Telephone',
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
            <div class="modal-footer {{-- justify-content-between --}}">
                <button type="button" class="btn btn-success" id="SubmitCreateForm"><i class="fas fa-download"></i>
                    บันทึกข้อมูล</button>
                <button type="button" class="btn btn-danger modelClose" data-dismiss="modal"><i
                        class="fas fa-door-closed"></i> ปิดหน้าต่าง</button>
            </div>
        </div>
    </div>
</div>
