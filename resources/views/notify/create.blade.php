<div class="modal fade" id="CreateModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="fas fa-list-ol"></i> เพิ่มกลุ่มการแจ้งเตือน</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong><i class="fas fa-list-ol"></i> ชื่อกลุ่ม:</strong>
                            {!! Form::text('name', null, ['id' => 'AddName', 'placeholder' => 'Name', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong><i class="fas fa-calendar"></i> จากวันที่:</strong>
                            @php
                                $datethai = date('m/d/') . date('Y') + 543 . ' ' . date('H:i');
                            @endphp
                            {!! Form::text('start_date', $datethai, [
                                'id' => 'AddSDate',
                                'placeholder' => '',
                                'class' => 'datepick form-control',
                            ]) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong><i class="fas fa-calendar"></i> ถึงวันที่:</strong>
                            @php
                                $datethai = date('m/d/') . date('Y') + 543 . ' ' . date('H:i');
                            @endphp
                            {!! Form::text('end_date', $datethai, [
                                'id' => 'AddEDate',
                                'placeholder' => '',
                                'class' => 'datepick form-control',
                            ]) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong><i class="fas fa-list-ol"></i> แจ้งเตือนวันหยุด:</strong><br>
                            <div class="material-switch">
                                <input id="sat" name="sat" type="checkbox">
                                <label for="sat" class="primary"></label>
                              </div>
                              <div class="material-switch">
                                <input id="sun" name="sun" type="checkbox">
                                <label for="sun" class="primary"></label>
                              </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong><i class="fas fa-list-ol"></i> ประเภทการแจ้งเตือน:</strong><br>
                            <input type="checkbox" name="miscall" data-bootstrap-switch>
                            <label for="sat" class="custom-control-label">
                                MissCall</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong><i class="fas fa-list-ol"></i> Extension:</strong>
                            <select style="width: 100%;" class="select2 select2_multiple form-control" id="AddExtension"
                                name="extension" multiple="multiple">
                                @foreach ($sound as $key2)
                                    <option value="{{ $key2->number }}">{{ $key2->number }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong><i class="fas fa-list-ol"></i> Line Token:</strong>
                            {!! Form::text('line', null, ['id' => 'AddLine', 'placeholder' => 'Line Token', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong><i class="fas fa-list-ol"></i> Email:</strong>
                            {!! Form::email('email', null, ['id' => 'AddEmail', 'placeholder' => 'Email', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong><i class="fas fa-eye"></i> เปิดใช้งาน:</strong>
                            <br />
                            <div class="custom-control custom-switch">
                                {{ Form::checkbox('status', '1', false, ['id' => 'customCheckbox1', 'class' => 'custom-control-input name']) }}
                                <label for="customCheckbox1" class="custom-control-label">
                                    เปิดใช้งาน</label>
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
