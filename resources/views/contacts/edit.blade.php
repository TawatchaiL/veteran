<!-- Edit  Modal -->
<div class="fade modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="EditModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="fas fa-address-book"></i> แก้ไข รายชื่อผู้ติดต่อ</h4>
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
                        <ul class="nav nav-tabs" id="custom-tabs-one-tabe" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-home-tabe" data-toggle="pill"
                                    href="#custom-tabs-one-homee" role="tab" aria-controls="custom-tabs-one-homee"
                                    aria-selected="true">ข้อมูลผู้ติดต่อ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-address-tabe" data-toggle="pill"
                                    href="#custom-tabs-one-addresse" role="tab"
                                    aria-controls="custom-tabs-one-addresse" aria-selected="false">ข้อมูลที่อยู่</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-profile-tabe" data-toggle="pill"
                                    href="#custom-tabs-one-profilee" role="tab"
                                    aria-controls="custom-tabs-one-profilee" aria-selected="false">ข้อมูลเบอร์ติดต่อ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tablistcase" id="custom-tabs-one-history-tabe" data-toggle="pill"
                                    href="#custom-tabs-one-history" role="tab"
                                    aria-controls="custom-tabs-one-history" aria-selected="false">ประวัติการติดต่อ</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContente">
                            <div class="tab-pane fade show active" id="custom-tabs-one-homee" role="tabpanel"
                                aria-labelledby="custom-tabs-one-home-tabe">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-code"></i> รหัสผู้ติดต่อ.</strong>
                                                    {!! Form::text('ehn', null, [
                                                        'id' => 'Edithn',
                                                        'placeholder' => 'Code',
                                                        'class' => 'form-control',
                                                        'readonly' => true,
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-calendar"></i> วันที่บันทึก:</strong>
                                                    {!! Form::text('eadddate', '2023-08-28', [
                                                        'id' => 'Editadddate',
                                                        'placeholder' => '',
                                                        'class' => 'AddDate form-control',
                                                        'data-target' => '#reservationdate',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-user-tie"></i> คำนำหน้าชื่อ:</strong>
                                                    <select style="width: 100%;" class="select2 select2_single form-control"
                                                        id="Edittname" name="etname" multiple="multiple">
                                                        {{-- <option value="">กรุณาเลือก</option> --}}
                                                        <option value="คุณ">คุณ</option>
                                                        <option value="เด็กชาย">เด็กชาย</option>
                                                        <option value="เด็กหญิง">เด็กหญิง</option>
                                                        <option value="นาย">นาย</option>
                                                        <option value="นาง">นาง</option>
                                                        <option value="นางสาว">นางสาว</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-user-tie"></i> ชื่อ:</strong>
                                                    {!! Form::text('efname', null, ['id' => 'Editfname', 'placeholder' => 'ชื่อ', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-user-tie"></i> นามสกุล:</strong>
                                                    {!! Form::text('Editlname', null, ['id' => 'Editlname', 'placeholder' => 'นามสกุล', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-user-tie"></i> เพศ:</strong>
                                                    <select style="width: 100%;" class="select2 select2_single form-control"
                                                        id="Editsex" name="Editsex" multiple="multiple">
                                                        {{-- <option value="">กรุณาเลือก</option> --}}
                                                        <option value="ชาย">ชาย</option>
                                                        <option value="หญิง">หญิง</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-user-tie"></i> วันเกิด:</strong>
                                                    {!! Form::text('Editbirthday', null, [
                                                        'id' => 'Editbirthday',
                                                        'placeholder' => 'วันเกิด',
                                                        'data-age' => 'Editage',
                                                        'class' => 'AddDate form-control',
                                                        'data-target' => '#reservationdate',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-user-tie"></i> อายุ:</strong>
                                                    {!! Form::text('Editage', null, [
                                                        'id' => 'Editage',
                                                        'placeholder' => 'อายุ',
                                                        'class' => 'form-control',
                                                        'readonly' => true,
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-user-tie"></i> กรุ๊ปเลือด:</strong>
                                                    <select style="width: 100%;" class="select2 select2_single form-control"
                                                        id="Editbloodgroup" name="Editbloodgroup" multiple="multiple">
                                                       {{--  <option value="">กรุณาเลือก</option> --}}
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="AB">AB</option>
                                                        <option value="O">O</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-addresse" role="tabpanel"
                                aria-labelledby="custom-tabs-one-address-tabe">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-home"></i> บ้านเลขที่:</strong>
                                                    {!! Form::text('homeno', null, [
                                                        'id' => 'Edithomeno',
                                                        'placeholder' => 'Address',
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-solid fa-people-roof"></i> หมู่:</strong>
                                                    {!! Form::text('moo', null, [
                                                        'id' => 'Editmoo',
                                                        'placeholder' => 'Group',
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-solid fa-people-roof"></i> ซอย :</strong>
                                                    {!! Form::text('esoi', null, [
                                                        'id' => 'Editsoi',
                                                        'placeholder' => 'Soi',
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-road"></i> ถนน :</strong>
                                                    {!! Form::text('eroad', null, [
                                                        'id' => 'Editroad',
                                                        'placeholder' => 'Road',
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-solid fa-city"></i> จังหวัด :</strong>
                                                    <select class="select2 select2_single form-control" id="Editcity"
                                                        name="ecity" multiple="multiple">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-solid fa-building-circle-arrow-right"></i>
                                                        อำเภอ:</strong>
                                                    <select class="select2 select2_single form-control" id="Editdistrict"
                                                        name="edistrict" multiple="multiple">
                                                        {{-- <option value="">กรุณาเลือกอำเภอ</option> --}}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-solid fa-building-circle-arrow-right"></i>
                                                        ตำบล
                                                        :</strong>
                                                    <select class="select2 select2_single form-control" id="Editsubdistrict"
                                                        name="esubdistrict" multiple="multiple">
                                                        {{-- <option value="">กรุณาเลือกตำบล</option> --}}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-code"></i> รหัสไปรษณีย์:</strong>
                                                    {!! Form::text('epostcode', null, [
                                                        'id' => 'Editpostcode',
                                                        'placeholder' => 'Postcode',
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="custom-tabs-one-profilee" role="tabpanel"
                                aria-labelledby="custom-tabs-one-profile-tabe">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-phone"></i> เบอร์โทรศัพท์บ้าน:</strong>
                                                    {!! Form::text('etelhome', null, [
                                                        'id' => 'Edittelhome',
                                                        'placeholder' => 'Telephone',
                                                        'class' => 'form-control',
                                                        'onkeydown' => 'validateNumber(event)',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-phone"></i> เบอร์โทรศัพท์มือถือ :</strong>
                                                    {!! Form::text('ephoneno', null, [
                                                        'id' => 'Editphoneno',
                                                        'placeholder' => 'Postcode',
                                                        'class' => 'form-control',
                                                        'onkeydown' => 'validateNumber(event)',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-phone"></i>
                                                        เบอร์โทรศัพท์ที่ทำงาน:</strong>
                                                    {!! Form::text('eworkno', null, [
                                                        'id' => 'Editworkno',
                                                        'placeholder' => 'Telephone',
                                                        'class' => 'form-control',
                                                        'onkeydown' => 'validateNumber(event)',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <table id="myTbl3e"
                                                    class="table table-striped table-bordered responsive-utilities jambo_table "
                                                    width="400">
                                                    <thead>
                                                        <tr class="headings">
                                                            <th style="display:none;"></th>
                                                            <th class="column-title">
                                                                ชื่อบุคคลที่ติดต่อได้ในกรณีฉุกเฉิน</th>
                                                            <th class="column-title"> ความสัมพันธ์</th>
                                                            <th class="column-title"> เบอร์โทรศัพท์</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-12" align="right">

                                                <button type="button" id="editRowBtne"
                                                    class="btn btn-primary btnAddg"><i class="fa-solid fa-plus"></i>
                                                    เพิ่มบุคคลที่ติดต่อได้ในกรณีฉุกเฉิน</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="custom-tabs-one-history" role="tabpanel"
                                aria-labelledby="custom-tabs-one-history-tabe">
                                <div id="casehistory"></div>
                            </div>

                        </div>
                    </div>

                </div>


                {!! Form::close() !!}
            </div>
            <div class="modal-footer {{-- justify-content-between --}}">
                <button type="button" class="btn btn-success" id="SubmitEditForm"><i class="fas fa-download"></i>
                    บันทึกข้อมูล</button>
                <button type="button" class="btn btn-danger modelClose" data-dismiss="modal"><i
                        class="fas fa-door-closed"></i> ปิดหน้าต่าง</button>
            </div>
        </div>
    </div>
</div>
