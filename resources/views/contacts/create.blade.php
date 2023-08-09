<div class="modal fade" id="CreateModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="fas fa-graduation-cap"></i> เพิ่ม รายชื่อนักเรียน</h4>
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
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong><i class="fas fa-code"></i> รหัสสาขา:</strong>
                            <select style="width: 100%;" class="productl select2 select2_single form-control"
                                id="AddProduct" name="product" multiple="multiple"
                                @cannot('all-centre') disabled @endcannot>
                                <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                    <option value="" selected>Select Parent</option>-->
                                @foreach ($centre as $key2)
                                    <option value="{{ $key2->id }}"
                                        @if (Auth::user()->department->id == (int) $key2->id) selected @endif>{{ $key2->code }}
                                        {{ $key2->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong><i class="fas fa-graduation-cap"></i> ชื่อนักเรียน:</strong>
                            {!! Form::text('name', null, ['id' => 'AddName', 'placeholder' => 'Name', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-address-card"></i> ที่อยู่:</strong>
                            {!! Form::textarea('address', null, [
                                'rows' => 4,
                                'id' => 'AddAddress',
                                'class' => 'form-control',
                            ]) !!}
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
                            <strong><i class="fas fa-at"></i> อีเมล์:</strong>
                            {!! Form::text('email', null, ['id' => 'AddEmail', 'placeholder' => 'Email', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong><i class="fas fa-phone"></i> เบอร์โทรศัพท์:</strong>
                            {!! Form::text('telephone', null, [
                                'id' => 'AddTelephone',
                                'placeholder' => 'Telephone',
                                'class' => 'form-control',
                            ]) !!}
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
