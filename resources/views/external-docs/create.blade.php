<div class="modal fade" id="CreateModal">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">ลงรับหนังสือ</h4>
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

                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#innerModal">Open Inner
                    Modal</button> --}}

                <!-- Inner Modal -->
                <div class="modal fade" id="innerModal" tabindex="-1" role="dialog" aria-labelledby="innerModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-in modal-lg {{-- modal-dialog-centered --}}" role="document">
                        <div class="modal-content">
                            <!-- Inner Modal Header -->
                            <div class="modal-header bg-info">
                                <h4 class="modal-title" id="innerModalLabel">เพิ่มผู้ติดต่อ</h4>
                                <button type="button" class="close" data-dismiss-modal="modal2" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- Inner Modal Body -->
                            <div class="modal-body">
                                <p>This is the content of the inner modal.</p>
                            </div>
                            <!-- Inner Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss-modal="modal2">ปิด</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Inner Modal -->


                {{-- 'route' => 'users.store', --}}
                {!! Form::open(['method' => 'POST', 'class' => 'form']) !!}
                <div class="card card-success card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                    href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                                    aria-selected="true">รายละเอียดหนังสือ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                    href="#custom-tabs-one-profile" role="tab"
                                    aria-controls="custom-tabs-one-profile"
                                    aria-selected="false">อัพโหลดไฟล์นำเข้าเอกสาร</a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                                aria-labelledby="custom-tabs-one-home-tab">

                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>เลขที่ทะเบียนรับ:</strong>
                                            {!! Form::text('number', null, [
                                                'id' => 'AddNumber',
                                                'placeholder' => '',
                                                'class' => 'form-control',
                                                'readonly' => true,
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>หนังสือเลขที่:</strong>
                                            {!! Form::text('doc_number', null, [
                                                'id' => 'AddDocNumber',
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
                                                <select style="width: 91%;" class="select2 select2_single form-control"
                                                    id="AddPriorities" name="priorities" multiple="multiple">
                                                    <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                                    <option value="" selected>Select Parent</option>-->
                                                    @foreach ($priorities as $key2)
                                                        <option value="{{ $key2->id }}">{{ $key2->name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#innerModal"><i class="fas fa-plus"></i></button>
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
                                            {!! Form::text('signdate', $datethai, ['id' => 'AddDate', 'placeholder' => '', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>จาก:</strong>
                                            <div class="input-group">
                                                <select style="width: 91%;"
                                                    class="select2 select2_single form-control" id="AddDocFrom"
                                                    name="doc_from" multiple="multiple">
                                                    <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                  <option value="" selected>Select Parent</option>-->
                                                    @foreach ($contacts as $key)
                                                        <option value="{{ $key->id }}">{{ $key->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-primary"
                                                        data-toggle="modal"
                                                        data-target="#innerModal"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>ถึง:</strong>
                                            {!! Form::text('doc_to', 'นายกเทศมนตรี', [
                                                'id' => 'AddDocTo',
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
                                            {!! Form::text('subject', null, ['id' => 'AddSubject', 'placeholder' => 'เรื่อง', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>ผู้รับ:</strong>
                                            <div class="input-group">
                                                <select style="width: 87%;"
                                                    class="select2 select2_single form-control" id="AddReceive"
                                                    name="doc_receive" multiple="multiple" readonly>
                                                    <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                  <option value="" selected>Select Parent</option>-->
                                                    @foreach ($contacts as $key)
                                                        <option value="{{ $key->id }}">{{ $key->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-primary"
                                                        data-toggle="modal"
                                                        data-target="#innerModal">เลือก</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                aria-labelledby="custom-tabs-one-profile-tab">
                                <div class="form-row form-focus" id="dropzone-att">
                                    <div class="col-md-12 col-sm-12">
                                        <a id="datt"></a>
                                        <div class="position-relative form-group">
                                            <label class="form-label form-label-top form-label-auto"
                                                for="att">อัพโหลดไฟล์<span class="form-required">*</span>
                                                <div style="width: 280px"></div>
                                            </label>
                                            <input type="text" id="drop" name="drop"
                                                class="form-control form_none" value="" required>
                                            <div class="dropzone" id="my-awesome-dropzone" style="font-size: 1.5em;">
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
                                <div class="dropzonex dz-default dz-message" id="dropzone_preview"
                                    style="font-size: 1.5em;">
                                    <h3 class="dropzone-previews ui"></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {!! Form::close() !!}
            </div>
            <div class="modal-footer {{-- justify-content-between --}}">
                <button type="button" class="btn btn-success" id="SubmitCreateForm">บันทึก</button>
                <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>
