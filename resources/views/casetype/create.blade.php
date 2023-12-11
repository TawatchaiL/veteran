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
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6" id="targetselect">
                        <div class="form-group">
                            <select style="width: 100%;"
                                class="select2 form-control casetypechang" id="casetype1" data-lev="1"
                                name="casetype1">
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6" id="targettext">
                        <div class="row"><div class="col-xs-12 col-sm-12 col-md-12"><div class="input-group"><input type="text" id="newcasetype" name="newcasetype[]" class="form-control has-feedback-left" value="" required="required"> <button type="button" class="btn btn-success" id="SubmitNewCasetype"><i class="fas fa-download"></i>เพิ่ม</button></div></div></div>
                    </div>
                </div>
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
