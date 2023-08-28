<!-- Edit  Modal -->
<div class="fade modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="EditModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="fa-regular fa-clipboard"></i> เพิ่ม เรื่องที่ติดต่อ</h4>
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


                {{-- 'route' => 'users.store', --}}
                {!! Form::open(['method' => 'POST', 'class' => 'form']) !!}
                <div class="card card-success card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tabp" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-home-tabp" data-toggle="pill"
                                    href="#custom-tabs-one-homep" role="tab" aria-controls="custom-tabs-one-homep"
                                    aria-selected="true">ข้อมูลเรื่องที่ติดต่อ</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-profile-tabp" data-toggle="pill"
                                    href="#custom-tabs-one-profilep" role="tab" aria-controls="custom-tabs-one-profilep"
                                    aria-selected="false">ข้อมูลเบอร์ติดต่อ</a>
                            </li> --}}

                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContentp">
                            <div class="tab-pane fade show active" id="custom-tabs-one-homep" role="tabpanel"
                                aria-labelledby="custom-tabs-one-home-tabp">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-code"></i> HN:</strong>
                                                    {!! Form::text('name', '000001', [
                                                        'id' => 'AddName',
                                                        'placeholder' => 'Name',
                                                        'class' => 'form-control',
                                                        'readonly' => true,
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-user-tie"></i> ชื่อ-สกุล :</strong>
                                                    {!! Form::text('name', 'นายสมมุติ ไม่สบาย', [
                                                        'id' => 'AddName',
                                                        'placeholder' => 'Name',
                                                        'class' => 'form-control',
                                                        'readonly' => true,
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-regular fa-message"></i> ประเภทเคส:</strong>
                                                    <select style="width: 100%;"
                                                        class="select2 select2_casetype1e form-control" id="casetype1e"
                                                        name="casetype1e" multiple="multiple">
                                                        <option value="" selected>โอนสาย</option>
                                                        <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                    <option value="" selected>Select Parent</option>-->
                                                        @foreach ($casetype as $key2)
                                                            <option value="{{ $key2->id }}">{{ $key2->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-regular fa-comment-dots"></i>
                                                        รายละเอียดเคส:</strong>
                                                    <select style="width: 100%;"
                                                        class="select2 select2_casetype2e form-control" id="casetype2e"
                                                        name="casetype2e" multiple="multiple">
                                                        <option value="" selected>OPD</option>
                                                        <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                    <option value="" selected>Select Parent</option>-->

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-regular fa-comment-dots"></i>
                                                        รายละเอียดเคสย่อย:</strong>
                                                    <select style="width: 100%;"
                                                        class="select2 select2_casetype3e form-control" id="casetype3e"
                                                        name="casetype3e" multiple="multiple">
                                                        <option value="" selected>OPD ในเวลา</option>
                                                        <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                    <option value="" selected>Select Parent</option>-->

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-regular fa-comment-dots"></i> รายละเอียดเคส
                                                        เพิ่มเติม 1:</strong>
                                                    <select style="width: 100%;"
                                                        class="select2 select2_casetype4e form-control" id="casetype4e"
                                                        name="casetype4e" multiple="multiple">
                                                        <option value="" selected>อายุรกรรม</option>
                                                        <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                    <option value="" selected>Select Parent</option>-->

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-regular fa-comment-dots"></i> รายละเอียดเคส
                                                        เพิ่มเติม 2:</strong>
                                                    <select style="width: 100%;"
                                                        class="select2 select2_casetype5e form-control" id="casetype5e"
                                                        name="casetype5e" multiple="multiple">
                                                        <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                    <option value="" selected>Select Parent</option>-->

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-regular fa-comment-dots"></i> รายละเอียดเคส
                                                        เพิ่มเติม 3:</strong>
                                                    <select style="width: 100%;"
                                                        class="select2 select2_casetype6e form-control" id="casetype6e"
                                                        name="casetype6e" multiple="multiple">
                                                        <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                    <option value="" selected>Select Parent</option>-->

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong><i class="fa-regular fa-comment-dots"></i>
                                                        รายละเอียด:</strong>
                                                    {!! Form::textarea('detail', 'ทดสอบ', [
                                                        'rows' => 4,
                                                        'id' => 'AddDetail',
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>


                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-shuffle"></i> สถานะการโอนสาย
                                                        :</strong>
                                                    <select style="width: 100%;"
                                                        class="select2 select2_tranfere form-control"
                                                        id="tranferstatuse" name="tranferstatuse">
                                                        <option value="1" selected>รับสาย</option>
                                                        <option value="2">ไม่รับสาย</option>
                                                        <option value="3">สายไม่ว่าง</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-arrows-rotate"></i> สถานะการเคส
                                                        :</strong>
                                                    <select style="width: 100%;"
                                                        class="select2 select2_casestatuse form-control"
                                                        id="casestatuse" name="casestatuse">
                                                        <option value="1" selected>ปิดเคส</option>
                                                        <option value="2">กำลังดำเนินการ</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>


                            {{--   <div class="tab-pane fade" id="custom-tabs-one-profilep" role="tabpanel"
                                aria-labelledby="custom-tabs-one-profile-tabp">
                                <div class="card">
                                    <div class="card-body">
                                       
                                    </div>
                                </div>
                            </div> --}}
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
