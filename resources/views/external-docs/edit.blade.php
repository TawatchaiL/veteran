<!-- Edit  Modal -->
<div class="fade modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
id="EditModal">
<div class="modal-dialog modal-xl" role="document">
    <form id="editdata" class="form" action="" method="POST">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title" id="exampleModalLongTitle">แก้ไข หนังสือ  </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert"
                    style="display: none;">
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert"
                    style="display: none;">
                    <strong>Success!</strong> Users was edit successfully.
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div id="EditModalBody">
                    {!! Form::open(['method' => 'POST', 'class' => 'form','id'=>'editdata']) !!}
                    <div class="card card-success card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-home-tab2" data-toggle="pill"
                                        href="#custom-tabs-one-home2" role="tab" aria-controls="custom-tabs-one-home2"
                                        aria-selected="true">รายละเอียดหนังสือ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-profile-tab2" data-toggle="pill"
                                        href="#custom-tabs-one-profile2" role="tab"
                                        aria-controls="custom-tabs-one-profile2"
                                        aria-selected="false">อัพโหลดไฟล์นำเข้าเอกสาร</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-preview-tab2" data-toggle="pill"
                                        href="#custom-tabs-one-preview2" role="tab"
                                        aria-controls="custom-tabs-one-preview2"
                                        aria-selected="false">ดูเอกสารที่อัพโหลด</a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-one-home2" role="tabpanel"
                                    aria-labelledby="custom-tabs-one-home-tab2">

                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>เลขที่ทะเบียนรับ:</strong>
                                                {!! Form::text('enumber', null, [
                                                    'id' => 'EditNumber',
                                                    'placeholder' => '',
                                                    'class' => 'form-control',
                                                    'readonly' => true,
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>หนังสือเลขที่:</strong>
                                                {!! Form::text('edoc_number', null, [
                                                    'id' => 'EditDocNumber',
                                                    'placeholder' => 'หนังสือเลขที่',
                                                    'class' => 'form-control',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>ระดับชั้นความเร็วของหนังสือ:</strong>
                                                <div class="input-group">
                                                    <select style="width: 91%;" class="priorities select2 select2_single form-control"
                                                        id="EditPriorities" name="epriorities" multiple="multiple">
                                                        <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                                        <option value="" selected>Select Parent</option>-->
                                                        @foreach ($priorities as $key2)
                                                            <option value="{{ $key2->id }}">{{ $key2->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-primary inner2" data-toggle="modal"
                                                            data-target="#innerModal2"><i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>ลงวันที่:</strong>
                                                @php
                                                    $datethai = date('m/d/') . date('Y') + 543;
                                                @endphp
                                                {!! Form::text('esigndate', null, ['id' => 'EditDate', 'placeholder' => '', 'class' => 'datepick form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>จาก:</strong>
                                                <div class="input-group">
                                                    <select style="width: 91%;"
                                                        class="doc_from select2 select2_single form-control" id="EditDocFrom"
                                                        name="edoc_from" multiple="multiple">
                                                        <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                      <option value="" selected>Select Parent</option>-->
                                                        @foreach ($contacts as $key)
                                                            <option value="{{ $key->id }}">{{ $key->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button  type="button" class="inner1 btn btn-primary"
                                                            data-toggle="modal"
                                                            data-target="#innerModal"><i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>ถึง:</strong>
                                                {!! Form::text('edoc_to', 'นายกเทศมนตรี', [
                                                    'id' => 'EditDocTo',
                                                    'placeholder' => '',
                                                    'class' => 'form-control',
                                                    //'value' => 'นายกเทศมลตรี',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>เรื่อง:</strong>
                                                {!! Form::text('esubject', null, ['id' => 'EditSubject', 'placeholder' => 'เรื่อง', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>ผู้รับ:</strong>
                                                <div class="input-group">
                                                    <select style="width: 87%;"
                                                        class="doc_receive select2 select2_single form-control" id="EditReceive"
                                                        name="edoc_receive" multiple="multiple" readonly>
                                                        <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                      <option value="" selected>Select Parent</option>-->
                                                       {{--  @foreach ($contacts as $key)
                                                            <option value="{{ $key->id }}">{{ $key->name }}
                                                            </option>
                                                        @endforeach --}}
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button type="button" class="inner3 btn btn-primary"
                                                            data-toggle="modal"
                                                            data-target="#innerModal3">เลือก</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-profile2" role="tabpanel"
                                    aria-labelledby="custom-tabs-one-profile-tab2">

                                    <div class="row imgs">

                                    </div>
                                    <div class="form-row form-focus" id="dropzone-att2">
                                        <div class="col-md-12 col-sm-12">
                                            <a id="datt2"></a>
                                            <div class="position-relative form-group">
                                                <label class="form-label form-label-top form-label-auto"
                                                    for="att">อัพโหลดไฟล์<span class="form-required">*</span>
                                                    <div style="width: 280px"></div>
                                                </label>
                                                <input type="text" id="drop2" name="drop2"
                                                    class="form-control form_none" value="" required>
                                                <div class="dropzone" id="my-awesome-dropzone2" style="font-size: 1.5em;">
                                                    <div class="fallback">

                                                    </div>
                                                </div>
                                                <label class="form-sub-label" style="min-height:13px"
                                                    aria-hidden="false">นำเข้าเอกสาร</label>
                                                <div id="dropzone-att-error" class="form-error-message" role="alert">
                                                    <img src="https://cdn.jotfor.ms/images/exclamation-octagon.png"
                                                        height="10">
                                                    <span class="error-navigation-message">This field is
                                                        required.</span>
                                                    <div class="form-error-arrow">
                                                        <div class="form-error-arrow-inner"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropzonex dz-default dz-message" id="dropzone_preview2"
                                        style="font-size: 1.5em;">
                                        <h3 class="dropzone-previews ui"></h3>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-preview2" role="tabpanel"
                                aria-labelledby="custom-tabs-one-profile-preview2">
                                <div class="row" id="file_preview">
                                </div>
                                <div class="row" id="upload_preview2">

                                </div>
                            </div>
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
