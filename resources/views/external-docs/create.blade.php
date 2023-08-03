<div class="modal fade" id="CreateModal" data-backdrop="static">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">ลงรับหนังสือ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
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
                        <div class="alert alert-danger alert-dismissible fade show" role="alert"
                            style="display: none;">
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="alert alert-success alert-dismissible fade show" role="alert"
                            style="display: none;">

                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"></span>
                            </button>
                        </div>

                        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#innerModal">Open Inner
                    Modal</button> --}}

                        {{-- 'route' => 'users.store', --}}
                        {!! Form::open(['method' => 'POST', 'class' => 'form', 'id' => 'create_form']) !!}
                        <div class="card card-success card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                            href="#custom-tabs-one-profile" role="tab"
                                            aria-controls="custom-tabs-one-profile"
                                            aria-selected="false">นำเข้าเอกสาร</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link " id="custom-tabs-one-home-tab" data-toggle="pill"
                                            href="#custom-tabs-one-home" role="tab"
                                            aria-controls="custom-tabs-one-home"
                                            aria-selected="true">รายละเอียดหนังสือ</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-preview-tab" data-toggle="pill"
                                            href="#custom-tabs-one-preview" role="tab"
                                            aria-controls="custom-tabs-one-preview"
                                            aria-selected="false">ประทับตรา/เซ็นต์</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade" id="custom-tabs-one-home" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-home-tab">


                                        <div class="col-xs-12 col-sm-12 col-md-12">
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
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>หนังสือเลขที่:</strong>
                                                {!! Form::text('doc_number', null, [
                                                    'id' => 'AddDocNumber',
                                                    'placeholder' => 'หนังสือเลขที่',
                                                    'class' => 'form-control',
                                                ]) !!}
                                            </div>
                                        </div>


                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>ระดับชั้นความเร็วของหนังสือ:</strong>
                                                <div class="input-group">
                                                    <select style="width: 89%;"
                                                        class="priorities select2 select2_single form-control"
                                                        id="AddPriorities" name="priorities" multiple="multiple">
                                                        <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                                    <option value="" selected>Select Parent</option>-->
                                                        @foreach ($priorities as $key2)
                                                            <option value="{{ $key2->id }}">{{ $key2->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                    <div class="input-group-append">
                                                        <button type="button" class="inner2 btn btn-primary"
                                                            data-toggle="modal" data-target="#innerModal2"><i
                                                                class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>ลงวันที่:</strong>
                                                @php
                                                    $datethai = date('m/d/') . date('Y') + 543 ." ".date("H:i");
                                                @endphp
                                                {!! Form::text('signdate', $datethai, [
                                                    'id' => 'AddDate',
                                                    'placeholder' => '',
                                                    'class' => 'datepick form-control',
                                                ]) !!}
                                            </div>
                                        </div>


                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>จาก:</strong>
                                                <div class="input-group">
                                                    <select style="width: 89%;"
                                                        class="doc_from select2 select2_single form-control"
                                                        id="AddDocFrom" name="doc_from" multiple="multiple">
                                                        <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                  <option value="" selected>Select Parent</option>-->
                                                        @foreach ($contacts as $key)
                                                            <option value="{{ $key->id }}">{{ $key->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button type="button" class="inner1 btn btn-primary"
                                                            data-toggle="modal" data-target="#innerModal"><i
                                                                class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
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


                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>เรื่อง:</strong>
                                                {!! Form::text('subject', null, ['id' => 'AddSubject', 'placeholder' => 'เรื่อง', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>ผู้รับ:</strong>
                                                <div class="input-group">
                                                    <select style="width: 84%;"
                                                        class="doc_receive select2 select2_single form-control"
                                                        id="AddReceive" name="doc_receive" multiple="multiple"
                                                        readonly>
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
                                    <div class="tab-pane fade show active" id="custom-tabs-one-profile"
                                        role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">

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
                                                    <div class="dropzone" id="my-awesome-dropzone"
                                                        style="font-size: 1.5em;">
                                                        <div class="fallback">

                                                        </div>
                                                    </div>
                                                    <label class="form-sub-label" style="min-height:13px"
                                                        aria-hidden="false">นำเข้าเอกสาร</label>
                                                    <div id="dropzone-att-error" class="form-error-message"
                                                        role="alert">
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
                                    <div class="tab-pane fade" id="custom-tabs-one-preview" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-profile-preview">
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="customRange3">ตำแหน่งประทับตรายางแนวตั้ง</label>
                                                <input type="range" min="-100" max="300" value="100"
                                                    class="custom-range custom-range-teal" id="stampx">
                                            </div>
                                            <div class="form-group">
                                                <label for="customRange3">ตำแหน่งประทับตรายางแนวนอน</label>
                                                <input type="range" min="-100" max="300" value="5"
                                                    class="custom-range custom-range-teal" id="stampy">
                                            </div>

                                            <div class="form-group">
                                                <div class="signpadi">
                                                    <canvas id="signature-pad" width="350"
                                                        height="150"></canvas>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="customRange3">ตำแหน่งประทับลายเซ็นต์แนวตั้ง</label>
                                                <input type="range" min="-100" max="300" value="20"
                                                    class="custom-range custom-range-teal" id="sstampx">
                                            </div>
                                            <div class="form-group">
                                                <label for="customRange3">ตำแหน่งประทับลายเซ็นต์แนวนอน</label>
                                                <input type="range" min="-100" max="300" value="5"
                                                    class="custom-range custom-range-teal" id="sstampy">
                                            </div>
                                            <div class="from-group">
                                                {{-- <button type="button" class="inner4 btn btn-primary"
                                                data-toggle="modal" data-target="#innerModal4"><i
                                                    class="fas fa-plus"></i>เซ็นต์</button> --}}
                                                <button type="button" class="btn btn-danger"
                                                    id="clear-signature">ล้างลายเซ็นต์</button>
                                                <button type="button" class="btn btn-info"
                                                    id="CreateStamp">ประทับตรายางและลายเซ็นต์</button>
                                                {{-- <button type="button" class="btn btn-primary"
                                                    id="save-signature">ลงลายเซ็นต์บนเอกสาร</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <!-- Your footer content here -->
                                <button type="button" class="btn btn-success"
                                    id="SubmitCreateForm">บันทึกข้อมูล</button>
                                <button type="button" class="btn btn-danger modelClose"
                                    data-dismiss="modal">ปิด</button>

                            </div>
                        </div>


                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-8">
                        <div class="card card-warning myCard">
                            <div class="card-header">
                                <!-- Your header content here -->
                                <h3 class="card-title">เอกสารที่นำเข้า</h3>
                            </div>
                            <div class="card-body">

                                <div class="row" style="display: flex; justify-content: center;"
                                    id="upload_preview">
                                    <!-- Your card body content here -->

                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer {{-- justify-content-between --}}">

            </div>
        </div>
    </div>
</div>
