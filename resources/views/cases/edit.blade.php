<!-- Edit  Modal -->
<div class="fade modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="EditModal">
    <div class="modal-dialog modal-xl" role="document">
        <form id="editdata" class="form" action="" method="POST">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title" id="exampleModalLongTitle">แก้ไข รายการขาย</h4>
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
                        <strong>Success!</strong> Product was edit successfully.
                        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div id="EditModalBody">
                        {!! Form::open(['method' => 'POST', 'class' => 'form']) !!}
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>ประเภทเรื่องติดต่อ:</strong>
                                    {!! Form::text('lot', null, ['id' => 'EditLot', 'placeholder' => 'Order Number', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>รายละเอียด:</strong>
                                    {!! Form::textarea('detail', null, [
                                        'rows' => 4,
                                        'id' => 'EditDetail',
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>สถานะการโอนสาย:</strong>
                                    {!! Form::text('lot', null, ['id' => 'EditLot', 'placeholder' => 'Order Number', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>สถานะการเคส:</strong>
                                    {!! Form::text('amount', null, [
                                        'id' => 'EditAmount',
                                        'placeholder' => 'Amount',
                                        'class' => 'form-control',
                                        'readonly' => 'true',
                                    ]) !!}
                                </div>
                            </div>

                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="SubmitEditForm">บันทึก</button>
                    <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </form>
    </div>
</div>
