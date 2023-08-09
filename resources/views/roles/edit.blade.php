<!-- Edit  Modal -->
<div class="fade modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="EditModal">
    <div class="modal-dialog modal-xl" role="document">
        <form id="editdata" class="form" action="" method="POST">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-user-lock"></i> แก้ไข สิทธิ์การใช้งาน</h4>
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
                        <strong>สำเร็จ!</strong> บันทึก สิทธิ์การใช้งาน เรียบร้อยแล้ว .
                        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div id="EditModalBody">
                        {!! Form::open(['method' => 'POST', 'class' => 'form']) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong><i class="fas fa-user-lock"></i> ชื่อ สิทธิ์การใช้งาน:</strong>
                                    {!! Form::text('name', null, ['id' => 'editName', 'placeholder' => 'Name', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong><i class="fas fa-user-lock"></i> สิทธิ์การใช้งาน:</strong>
                                    <br />
                                    <div class="row">
                                        @foreach ($permission as $value)
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                <div class="custom-control custom-switch">
                                                    {{ Form::checkbox('epermission[]', $value->id, false, ['id' => 'ecustomCheckbox' . $value->id, 'class' => 'custom-control-input name']) }}
                                                    <label for="ecustomCheckbox{{ $value->id }}"
                                                        class="custom-control-label">
                                                        {{ $value->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>

                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="SubmitEditForm"><i class="fas fa-download"></i> บันทึกช้อมูล</button>
                    <button type="button" class="btn btn-danger modelClose" data-dismiss="modal"><i class="fas fa-door-closed"></i> ปิดหน้าต่าง</button>
                </div>
            </div>
        </form>
    </div>
</div>
