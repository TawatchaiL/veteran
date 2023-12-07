<!-- Edit  Modal -->
<div class="fade modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="EditModal">
    <div class="modal-dialog modal-lg" role="document">
        <form id="editdata" class="form" action="" method="POST">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-list-ol"></i> แก้ไข วันหยุดประจำปี
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
                                    <strong><i class="fas fa-list-ol"></i> ชื่อ:</strong>
                                    {!! Form::text('ename', null, ['id' => 'EditName', 'placeholder' => 'Name', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong><i class="fas fa-calendar"></i> จากวันที่:</strong>
                                    @php
                                        $datethai = date('d/m/') . date('Y');
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
                                        $datethai = date('d/m/') . date('Y');
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
                                    <strong><i class="fas fa-list-ol"></i> เสียง ประกาศวันหยุด:</strong>
                                    <select style="width: 100%;" class="select2 select2_single form-control"
                                        id="EditGreeting" name="egreeting" multiple="multiple">
                                        @foreach ($sound as $key2)
                                            <option value="{{ $key2->displayname }}">{{ $key2->displayname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <div class="form-group">
                                    <strong><i class="fas fa-list-ol"></i> เสียง ขอบคุณ:</strong>
                                    <select style="width: 100%;" class="select2 select2_single form-control"
                                        id="EditThankyou" name="ethankyou" multiple="multiple">
                                        @foreach ($sound as $key2)
                                            <option value="{{ $key2->displayname }}">{{ $key2->displayname }}
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <div class="form-group">
                                    <strong><i class="fas fa-eye"></i> เปิดใช้งาน:</strong>
                                    <br />
                                    <div class="custom-control custom-switch">
                                        {{ Form::checkbox('status', '1', false, ['id' => 'ecustomCheckbox1', 'class' => 'custom-control-input name']) }}
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
