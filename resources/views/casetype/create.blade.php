<div class="modal fade" id="CreateModal">
    <div class="modal-dialog modal-xl">
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
                    <div class="col-xs-4 col-sm-4 col-md-4" id="targetselect">
                        <div class="row mb-3 case1">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <select style="width: 100%;"
                                    class="select2 form-control casetypechang" id="casetype1" data-lev="1" data-parent="0" name="casetype1">
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 case2">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <select style="width: 100%;"
                                    class="select2 form-control casetypechang" id="casetype2" data-lev="2" name="casetype2">
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 case3">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <select style="width: 100%;"
                                    class="select2 form-control casetypechang" id="casetype3" data-lev="3" name="casetype3">
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 case4">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <select style="width: 100%;"
                                    class="select2 form-control casetypechang" id="casetype4" data-lev="4" name="casetype4">
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 case5">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <select style="width: 100%;"
                                    class="select2 form-control casetypechang" id="casetype5" data-lev="5" name="casetype5">
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 case6">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <select style="width: 100%;"
                                    class="select2 form-control casetypechang" id="casetype6" data-lev="6" name="casetype6">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8" id="targettext">
                        <div class="row mb-3"><div class="col-xs-12 col-sm-12 col-md-12"><div class="input-group"><input type="text" id="newcasetype" name="newcasetype[]" class="form-control has-feedback-left" value="" required="required">&nbsp;<button type="button" class="btn btn-success" id="SubmitNewCasetype"><i class="fa-solid fa-plus"></i>เพิ่ม</button></div></div></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer {{-- justify-content-between --}}">
                <button type="button" class="btn btn-danger modelClose" data-dismiss="modal"><i
                        class="fas fa-door-closed"></i> ปิดหน้าต่าง</button>
            </div>
        </div>
    </div>
</div>
