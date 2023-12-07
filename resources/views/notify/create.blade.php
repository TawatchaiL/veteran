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
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong><i class="fas fa-calendar"></i> จากวันที่:</strong>
                            @php
                                $datethai = date('Y-m-d');
                            @endphp
                            {!! Form::text('start_date', $datethai, [
                                'id' => 'AddSDate',
                                'placeholder' => '',
                                'readonly' => true,
                                'class' => 'datepick form-control',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong><i class="fas fa-clock-o"></i> เวลา:</strong>
                            @php
                                $timethai = "00:00:00";
                            @endphp
                            {!! Form::text('start_time', $timethai, [
                                'id' => 'AddSTime',
                                'placeholder' => '',
                                'readonly' => true,
                                'class' => 'timepick form-control',
                            ]) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong><i class="fas fa-calendar"></i> ถึงวันที่:</strong>
                            @php
                                $datethai = date('Y-m-d');
                            @endphp
                            {!! Form::text('end_date', $datethai, [
                                'id' => 'AddEDate',
                                'placeholder' => '',
                                'readonly' => true,
                                'class' => 'datepick form-control',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong><i class="fas fa-clock-o"></i> เวลา:</strong>
                            @php
                                $timethai = "23:59:59";
                            @endphp
                            {!! Form::text('end_time', $timethai, [
                                'id' => 'AddETime',
                                'placeholder' => '',
                                'readonly' => true,
                                'class' => 'timepick form-control',
                            ]) !!}
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
                            <label for="AddEmail"><strong><i class="fas fa-list-ol"></i> Email:</strong></label>
                            <input type="email" id="AddEmail" name="email" placeholder="Email"
                                class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong><i class="fas fa-list-ol"></i> แจ้งเตือนวันหยุด:</strong><br>
                            <div class="custom-control custom-switch">
                                {{ Form::checkbox('sat', '1', false, ['id' => 'sat', 'class' => 'custom-control-input name']) }}
                                <label for="sat" class="custom-control-label">
                                    เสาร์</label>
                            </div>
                            <div class="custom-control custom-switch">
                                {{ Form::checkbox('sun', '1', false, ['id' => 'sun', 'class' => 'custom-control-input name']) }}
                                <label for="sun" class="custom-control-label">
                                    อาทิตย์</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong><i class="fas fa-list-ol"></i> ประเภทการแจ้งเตือน:</strong><br>
                            <div class="custom-control custom-switch">
                                {{ Form::checkbox('misscall', '1', false, ['id' => 'misscall', 'class' => 'custom-control-input name']) }}
                                <label for="misscall" class="custom-control-label">
                                    Misscall</label>
                            </div>
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
