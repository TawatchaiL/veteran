<div class="modal fade" id="CreateModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="fas fa-list-ol"></i> เพิ่ม ประเภทการติดต่อ</h4>
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

                {!! Form::open(['method' => 'POST', 'class' => 'form']) !!}
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong><i class="fa-regular fa-message"></i> ประเภทเคส:</strong>
                            <select style="width: 100%;"
                                class="select2 form-control casetype6chang" id="casetype1" data-lev="1"
                                name="casetype1">
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group" id="typelev1">
                            <strong><i class="fas fa-list-ol"></i> ประเภทเคส:</strong>
                            {!! Form::text('name1', null, ['id' => 'AddName1', 'placeholder' => 'Name', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong><i class="fa-regular fa-comment-dots"></i>
                                รายละเอียดเคส:</strong>
                            <select style="width: 100%;"
                                class="select2 form-control casetype6chang" id="casetype2" data-lev="2"
                                name="casetype2">
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group" id="typelev2">
                            <strong><i class="fas fa-list-ol"></i> รายละเอียดเคส:</strong>
                            {!! Form::text('name2', null, ['id' => 'AddName2', 'placeholder' => 'Name', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong><i class="fa-regular fa-comment-dots"></i>
                                รายละเอียดเคสย่อย:</strong>
                            <select style="width: 100%;"
                                class="select2 form-control casetype6chang" id="casetype3" data-lev="3"
                                name="casetype3">
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group" id="typelev3">
                            <strong><i class="fas fa-list-ol"></i> รายละเอียดเคสย่อย:</strong>
                            {!! Form::text('name3', null, ['id' => 'AddName3', 'placeholder' => 'Name', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong><i class="fa-regular fa-comment-dots"></i> รายละเอียดเคส
                                เพิ่มเติม 1:</strong>
                            <select style="width: 100%;"
                                class="select2 form-control casetype6chang" id="casetype4" data-lev="4"
                                name="casetype4">
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group" id="typelev4">
                            <strong><i class="fas fa-list-ol"></i> รายละเอียดเคส
                                เพิ่มเติม 1:</strong>
                            {!! Form::text('name4', null, ['id' => 'AddName4', 'placeholder' => 'Name', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong><i class="fa-regular fa-comment-dots"></i> รายละเอียดเคส
                                เพิ่มเติม 2:</strong>
                            <select style="width: 100%;"
                                class="select2 form-control casetype6chang" id="casetype5" data-lev="5"
                                name="casetype5">
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group" id="typelev5">
                            <strong><i class="fas fa-list-ol"></i> รายละเอียดเคส
                                เพิ่มเติม 2:</strong>
                            {!! Form::text('name5', null, ['id' => 'AddName5', 'placeholder' => 'Name', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong><i class="fa-regular fa-comment-dots"></i> รายละเอียดเคส
                                เพิ่มเติม 3:</strong>
                            <select style="width: 100%;"
                                class="select2 form-control casetype6chang" id="casetype6" data-lev="6"
                                name="casetype6">
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group" id="typelev6">
                            <strong><i class="fas fa-list-ol"></i> รายละเอียดเคส
                                เพิ่มเติม 3:</strong>
                            {!! Form::text('name6', null, ['id' => 'AddName6', 'placeholder' => 'Name', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong><i class="fas fa-eye"></i> สถานะ:</strong>
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
