<div class="modal fade" id="CreateModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="fas fa-list-ol"></i> เพิ่มหัวข้อ ระบบประเมิน</h4>
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
                            <strong><i class="fas fa-list-ol"></i> ชื่อ:</strong>
                            {!! Form::text('name', null, ['id' => 'AddName', 'placeholder' => 'Name', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong><i class="fas fa-list-ol"></i> คะแนนสูงสุด:</strong>
                            {!! Form::number('score', null, [
                                'id' => 'AddScore',
                                'placeholder' => 'Score',
                                'min' => '1',
                                'max' => '10',
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong><i class="fas fa-list-ol"></i> เสียง Greeting:</strong>
                            <select style="width: 100%;" class="select2 select2_single form-control" id="AddGreeting"
                                name="greeting" multiple="multiple">
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
                            <select style="width: 100%;" class="select2 select2_single form-control" id="AddThankyou"
                                name="thankyou" multiple="multiple">
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
                            <strong><i class="fas fa-list-ol"></i> เสียง กดเมนูผิด:</strong>
                            <select style="width: 100%;" class="select2 select2_single form-control" id="AddInvalid"
                                name="invalid" multiple="multiple">
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
                            <strong><i class="fas fa-list-ol"></i> เสียง ไม่ทำรายการตามเวลา:</strong>
                            <select style="width: 100%;" class="select2 select2_single form-control" id="AddTimeout"
                                name="timeout" multiple="multiple">
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
                            <strong><i class="fas fa-list-ol"></i> เสียง ทำรายการเกินจำนวนครั้ง:</strong>
                            <select style="width: 100%;" class="select2 select2_single form-control" id="AddMax"
                                name="max" multiple="multiple">
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
                            <strong><i class="fas fa-eye"></i> ตั้งเป็น ระบบประเมินหลัก:</strong>
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
