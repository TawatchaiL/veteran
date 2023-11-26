<div class="modal fade" id="CreateModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="fas fa-list-ol"></i> เพิ่ม อัตราค่าใช้จ่ายการโทร</h4>
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
                            <strong><i class="fas fa-list-ol"></i> Note:</strong>
                            {!! Form::text('note', null, ['id' => 'AddNote', 'placeholder' => 'Note', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong><i class="fas fa-list-ol"></i> Trunk:</strong>
                            <select style="width: 100%;" class="select2 select2_single form-control" id="AddTrunk"
                                name="trunk" multiple="multiple">
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
                            {!! Form::text('prefix', null, ['id' => 'AddPrefix', 'placeholder' => 'Prefix', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong><i class="fas fa-list-ol"></i> Price:</strong>
                            {!! Form::text('number', null, [
                                'id' => 'AddPrice',
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
                                <input type="radio" id="AddPerM" name="per" value="0" checked>
                                <label for="AddPerM">Minute
                                </label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="AddPerC" name="per" value="1">
                                <label for="AddPerC">Call
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                <div class="modal-footer {{-- justify-content-between --}}">
                    <button type="button" class="btn btn-success" id="SubmitCreateForm"><i class="fas fa-download"></i>
                        บันทึกข้อมูล</button>
                    <button type="button" class="btn btn-danger modelClose" data-dismiss="modal"><i
                            class="fas fa-door-closed"></i> ปิดหน้าต่าง</button>
                </div>
            </div>
        </div>
    </div>
</div>
