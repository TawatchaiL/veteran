<div class="modal fade" id="CreateModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="fas fa-user"></i> เพิ่ม ผู้ใช้งาน</h4>
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
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-user"></i> ชื่อ-นามสกุล:</strong>
                            {!! Form::text('name', null, ['id' => 'AddName', 'placeholder' => 'Name', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-at"></i> Username:</strong>
                            {!! Form::text('email', null, ['id' => 'AddEmail', 'placeholder' => 'Email', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong><i class="fas fa-list-ol"></i> Queue:</strong>
                            <select style="width: 100%;" class="select2 select2_multiple form-control" id="AddQueue"
                                name="queue" multiple="multiple">
                                @foreach ($queue as $keyq)
                                    <option value="{{ $keyq->extension }}">{{ $keyq->extension }} ( {{ $keyq->descr }}
                                        )
                                    </option>
                                @endforeach


                            </select>
                        </div>
                    </div>
                    {{-- <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong><i class="fas fa-list-ol"></i> Agent :</strong>
                            <select style="width: 100%;" class="select2 select2_single form-control" id="AddAgent"
                                name="agent" multiple="multiple">
                                @foreach ($agent as $keya)
                                    <option value="{{ $keya->id }}">{{ $keya->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong><i class="fas fa-list-ol"></i> แผนก:</strong>
                            <select style="width: 100%;" class="departmentl select2 select2_single form-control"
                                id="AddDepartment" name="department" multiple="multiple">
                                <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                        <option value="" selected>Select Parent</option>-->
                                @foreach ($department as $key2)
                                    <option value="{{ $key2->id }}">{{ $key2->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong><i class="fas fa-list-ol"></i> ตำแหน่ง:</strong>
                            <select style="width: 100%;" class="positions select2 select2_single form-control"
                                id="AddPosition" name="position" multiple="multiple">
                                <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                        <option value="" selected>Select Parent</option>-->
                                {{--   @foreach ($position as $key)
                                        <option value="{{ $key->id }}">{{ $key->name }}
                                        </option>
                                    @endforeach --}}

                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-key"></i> รหัสผ่าน:</strong>
                            {!! Form::password('password', ['id' => 'AddPassword', 'placeholder' => 'Password', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-key"></i> ยืนยันรหัสผ่าน:</strong>
                            {!! Form::password('confirm-password', [
                                'id' => 'AddPasswordc',
                                'placeholder' => 'Confirm Password',
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                    </div>



                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fas fa-user-lock"></i> สิทธิ์การใช้งาน:</strong>
                            {!! Form::select('roles', $roles, [], ['id' => 'AddRole', 'class' => 'form-control', 'single']) !!}
                        </div>
                    </div>
                    {{--  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                  </div> --}}
                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer {{-- justify-content-between --}}">
                <button type="button" class="btn btn-success" id="SubmitCreateForm"><i class="fas fa-download"></i>
                    บันทึกข้อมูล</button>
                <button type="button" class="btn btn-danger modelClose" data-dismiss="modal"><i
                        class="fas fa-door-closed"></i> ปืดหน้าต่าง</button>
            </div>
        </div>
    </div>
</div>
