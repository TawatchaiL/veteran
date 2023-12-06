<!-- Edit  Modal -->
<div class="fade modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="EditModal">
    <div class="modal-dialog modal-lg" role="document">
        <form id="editdata" class="form" action="" method="POST">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-list-ol"></i>
                        แก้ไขกลุ่มการแจ้งเตือน
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                        <strong>Success!</strong> Users was edit successfully.
                        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div id="EditModalBody">
                        {!! Form::open(['method' => 'POST', 'class' => 'form']) !!}
                        <div class="row">
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <div class="form-group">
                                    <strong><i class="fas fa-list-ol"></i> ชื่อกลุ่ม:</strong>
                                    {!! Form::text('ename', null, ['id' => 'EditName', 'placeholder' => 'Name', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong><i class="fas fa-calendar"></i> จากวันที่:</strong>
                                    @php
                                        $datethai = date('d/m/') . date('Y') + 543;
                                    @endphp
                                    {!! Form::text('start_date', $datethai, [
                                        'id' => 'EditSDate',
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
                                        $timethai = date('H:i:s');
                                    @endphp
                                    {!! Form::text('end_time', $timethai, [
                                        'id' => 'EditSTime',
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
                                        $datethai = date('d/m/') . date('Y') + 543;
                                    @endphp
                                    {!! Form::text('end_date', $datethai, [
                                        'id' => 'EditEDate',
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
                                        $timethai = date('H:i:s');
                                    @endphp
                                    {!! Form::text('end_time', $timethai, [
                                        'id' => 'EditETime',
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
                                    <select style="width: 100%;" class="select2 select2_multiple form-control"
                                        id="EditExtension" name="eextension" multiple="multiple">
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
                                    {!! Form::text('eline', null, ['id' => 'EditLine', 'placeholder' => 'Line Token', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <div class="form-group">
                                    <label for="EditEmail"><strong><i class="fas fa-list-ol"></i>
                                            Email:</strong></label>
                                    <input type="eemail" id="EditEmail" name="email" placeholder="Email"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <div class="form-group">
                                    <strong><i class="fas fa-list-ol"></i> แจ้งเตือนวันหยุด:</strong><br>
                                    <div class="custom-control custom-switch">
                                        {{ Form::checkbox('esat', '1', false, ['id' => 'esat', 'class' => 'custom-control-input name']) }}
                                        <label for="esat" class="custom-control-label">
                                            เสาร์</label>
                                    </div>
                                    <div class="custom-control custom-switch">
                                        {{ Form::checkbox('esun', '1', false, ['id' => 'esun', 'class' => 'custom-control-input name']) }}
                                        <label for="esun" class="custom-control-label">
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
                                        {{ Form::checkbox('emisscall', '1', false, ['id' => 'emisscall', 'class' => 'custom-control-input name']) }}
                                        <label for="emisscall" class="custom-control-label">
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
                                        {{ Form::checkbox('estatus', '1', false, ['id' => 'ecustomCheckbox1', 'class' => 'custom-control-input name']) }}
                                        <label for="ecustomCheckbox1" class="custom-control-label">
                                            เปิดใช้งาน</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="SubmitEditForm"><i
                            class="fas fa-download"></i> บันทึกข้อมูล</button>
                    <button type="button" class="btn btn-danger modelClose" data-dismiss="modal"><i
                            class="fas fa-door-closed"></i> ปิดหน้าต่าง</button>
                </div>
            </div>
        </form>
    </div>
</div>
