<div class="modal fade" id="CreateModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="fas fa-list-ol"></i> เพิ่ม เบอร์โทรศัพท์แบล็กลิสต์</h4>
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
                            <strong><i class="fas fa-list-ol"></i> เบอร์โทรศัพท์:</strong>
                            {!! Form::text('phone', null, ['id' => 'Addphone', 'placeholder' => 'เบอร์โทรศัพท์', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong><i class="fas fa-list-ol"></i> เหตุผล:</strong>
                            {!! Form::text('description', null, ['id' => 'Adddescription', 'placeholder' => 'เหตุผล', 'class' => 'form-control']) !!}
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
