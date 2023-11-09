<div class="fade modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="EditModal">
    <div class="modal-dialog modal-lg" role="document">
        <form id="editdata" class="form" action="" method="POST">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-list-ol"></i> แก้ไข
                        อัตราค่าใช้จ่ายการโทร
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
                                    <strong><i class="fas fa-list-ol"></i> Note:</strong>
                                    {!! Form::text('enote', null, ['id' => 'EditNote', 'placeholder' => 'Note', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <div class="form-group">
                                    <strong><i class="fas fa-list-ol"></i> Trunk:</strong>
                                    <select style="width: 100%;" class="select2 select2_single form-control"
                                        id="EditTrunk" name="etrunk" multiple="multiple">
                                        @foreach ($trunk as $key2)
                                            <option value="{{ strtoupper($key2->tech) }}/{{ $key2->channelid }}">
                                                {{ $key2->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <div class="form-group">
                                    <strong><i class="fas fa-list-ol"></i> Prefix:</strong>
                                    {!! Form::text('eprefix', null, ['id' => 'EditPrefix', 'placeholder' => 'Prefix', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <div class="form-group">
                                    <strong><i class="fas fa-list-ol"></i> Price:</strong>
                                    {!! Form::text('number', null, [
                                        'id' => 'EditPrice',
                                        'step' => 0.5,
                                        'placeholder' => 'Price',
                                        'class' => 'form-control auto_decimal',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <div class="form-group clearfix">
                                    <strong><i class="fas fa-list-ol"></i> Per:</strong>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="EditPerM" name="eper" value="0" checked>
                                        <label for="EditPerM">Minute
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="EditPerC" name="eper" value="1">
                                        <label for="EditPerC">Call
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="SubmitEditForm"><i class="fas fa-download"></i>
                        บันทึกข้อมูล</button>
                    <button type="button" class="btn btn-danger modelClose" data-dismiss="modal"><i
                            class="fas fa-door-closed"></i> ปิดหน้าต่าง</button>
                </div>
            </div>
        </form>
    </div>
</div>


