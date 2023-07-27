<!-- Inner Modal -->
<div class="modal fade innerm" id="innerModal" tabindex="-1" role="dialog" aria-labelledby="innerModalLabel"
aria-hidden="true" data-backdrop="static">
<div class="modal-dialog modal-dialog-in modal-lg {{-- modal-dialog-centered --}}" role="document">
    <div class="modal-content">
        <!-- Inner Modal Header -->
        <div class="modal-header bg-primary">
            <h4 class="modal-title" id="innerModalLabel">เพิ่มผู้ติดต่อ</h4>
            <button type="button" class="close" data-dismiss-modal="modal1" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Inner Modal Body -->
        <div class="modal-body">
            <div class="alert alert-danger alert-in alert-dismissible fade show" role="alert" style="display: none;">
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="alert alert-success success-in alert-dismissible fade show" role="alert" style="display: none;">

                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>

            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>ชื่่อหน่วยงาน:</strong>
                        {!! Form::text('name', null, ['id' => 'AddName', 'placeholder' => 'Name', 'class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>เบอร์โทรศัพท์:</strong>
                        {!! Form::text('telephone', null, [
                            'id' => 'AddTelephone',
                            'placeholder' => 'Telephone',
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- Inner Modal Footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-success" id="SubmitCreateFormIn1">บันทึก</button>
            <button type="button" class="btn btn-danger" data-dismiss-modal="modal1">ปิด</button>
        </div>
    </div>
</div>
</div>
<!-- End of Inner Modal -->


<!-- Inner Modal2 -->
<div class="modal fade innerm" id="innerModal2" tabindex="-1" role="dialog" aria-labelledby="innerModalLabel"
aria-hidden="true" data-backdrop="static">
<div class="modal-dialog modal-dialog-in2 modal-lg {{-- modal-dialog-centered --}}" role="document">
    <div class="modal-content">
        <!-- Inner Modal Header -->
        <div class="modal-header bg-primary">
            <h4 class="modal-title" id="innerModalLabel">เพิ่มระดับชั้นความเร็วของหนังสือ</h4>
            <button type="button" class="close" data-dismiss-modal="modal2" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Inner Modal Body -->
        <div class="modal-body">
            <div class="alert alert-danger alert-in alert-dismissible fade show" role="alert" style="display: none;">
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="alert alert-success success-in alert-dismissible fade show" role="alert" style="display: none;">

                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>

            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>ชื่่อระดับชั้นความเร็ว:</strong>
                        {!! Form::text('pname', null, ['id' => 'AddPName', 'placeholder' => '', 'class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- Inner Modal Footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-success" id="SubmitCreateFormIn2">บันทึก</button>
            <button type="button" class="btn btn-danger" data-dismiss-modal="modal2">ปิด</button>
        </div>
    </div>
</div>
</div>
<!-- End of Inner Modal2 -->


<!-- Inner Modal3 -->
<div class="modal fade innerm" id="innerModal3" tabindex="-1" role="dialog" aria-labelledby="innerModalLabel"
aria-hidden="true" data-backdrop="static">
<div class="modal-dialog modal-dialog-in3 modal-lg {{-- modal-dialog-centered --}}" role="document">
    <div class="modal-content">
        <!-- Inner Modal Header -->
        <div class="modal-header bg-primary">
            <h4 class="modal-title" id="innerModalLabel">เลือกผู้รับ</h4>
            <button type="button" class="close" data-dismiss-modal="modal3" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Inner Modal Body -->
        <div class="modal-body">
            <div class="alert alert-danger alert-in alert-dismissible fade show" role="alert" style="display: none;">
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="alert alert-success success-in alert-dismissible fade show" role="alert" style="display: none;">

                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>ส่วนราชการ:</strong>
                    <select style="width: 100%;" class="departmentl select2 select2_single form-control" id="AddDepartment"
                        name="department" multiple="multiple">
                        <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                <option value="" selected>Select Parent</option>-->
                        @foreach ($departments as $key2)
                            <option value="{{ $key2->id }}">{{ $key2->name }}
                            </option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>ส่วนงาน:</strong>
                    <select style="width: 100%;" class="positions select2 select2_single form-control"
                        id="AddPosition" name="position" multiple="multiple" readonly>
                        <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                <option value="" selected>Select Parent</option>-->
                        {{--   @foreach ($position as $key)
                                <option value="{{ $key->id }}">{{ $key->name }}
                                </option>
                            @endforeach --}}

                    </select>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>ผู้รับ:</strong>
                    <select style="width: 100%;" class="users select2 select2_single form-control"
                        id="AddUser" name="user" multiple="multiple" readonly>
                        <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                <option value="" selected>Select Parent</option>-->
                        {{--   @foreach ($position as $key)
                                <option value="{{ $key->id }}">{{ $key->name }}
                                </option>
                            @endforeach --}}

                    </select>
                </div>
            </div>
        </div>
        <!-- Inner Modal Footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-success" id="SubmitCreateFormIn3">เลือก</button>
            <button type="button" class="btn btn-danger" data-dismiss-modal="modal3">ปิด</button>
        </div>
    </div>
</div>
</div>
<!-- End of Inner Modal3 -->

