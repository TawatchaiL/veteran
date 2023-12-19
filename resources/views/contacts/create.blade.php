<div class="modal fade" id="CreateModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="fas fa-address-book"></i> เพิ่มรายชื่อผู้ติดต่อ</h4>
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
                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                    href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                                    aria-selected="true">ข้อมูลผู้ติดต่อ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-address-tab" data-toggle="pill"
                                    href="#custom-tabs-one-address" role="tab"
                                    aria-controls="custom-tabs-one-address" aria-selected="false">ข้อมูลที่อยู่</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                    href="#custom-tabs-one-profile" role="tab"
                                    aria-controls="custom-tabs-one-profile" aria-selected="false">ข้อมูลเบอร์ติดต่อ</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                                aria-labelledby="custom-tabs-one-home-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-code"></i> HN</strong>
                                                    {!! Form::text('hn', null, [
                                                        'id' => 'Addhn',
                                                        'placeholder' => 'HN',
                                                        'class' => 'form-control',
                                                        'tabindex' => '1',
                                                        //'readonly' => true,
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-calendar"></i> วันที่บันทึก:</strong>
                                                    {!! Form::text('adddate', null, [
                                                        'id' => 'Addadddate',
                                                        'placeholder' => 'วันที่บันทึก',
                                                        'class' => 'AddDate form-control',
                                                        'tabindex' => '2',
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
                                                    <select style="width: 100%;"
                                                        class="select2 select2_single form-control" id="Addtname"
                                                        name="Addtname" multiple="multiple" tabindex="3">
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
                                                    {!! Form::text('fname', null, [
                                                        'id' => 'Addfname',
                                                        'placeholder' => 'ชื่อ',
                                                        'class' => 'form-control',
                                                        'tabindex' => '4',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-user-tie"></i> นามสกุล:</strong>
                                                    {!! Form::text('lname', null, [
                                                        'id' => 'Addlname',
                                                        'placeholder' => 'นามสกุล',
                                                        'class' => 'form-control',
                                                        'tabindex' => '5',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-user-tie"></i> เพศ:</strong>
                                                    <select style="width: 100%;"
                                                        class="select2 select2_single form-control" id="Addsex"
                                                        name="Addsex" multiple="multiple" tabindex="6">
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
                                                    {!! Form::text('addbirthday', null, [
                                                        'id' => 'Addbirthday',
                                                        'data-age' => 'Addage',
                                                        'placeholder' => 'วันเกิด',
                                                        'class' => 'BirthDate form-control',
                                                        'data-target' => '#reservationdate',
                                                        'tabindex' => '7',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-user-tie"></i> อายุ:</strong>
                                                    {!! Form::text('Addage', null, [
                                                        'id' => 'Addage',
                                                        'placeholder' => 'อายุ',
                                                        'class' => 'form-control',
                                                        'readonly' => true,
                                                        'tabindex' => '8',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-user-tie"></i> กรุ๊ปเลือด:</strong>
                                                    <select style="width: 100%;"
                                                        class="select2 select2_single form-control" id="Addbloodgroup"
                                                        name="Addbloodgroup" multiple="multiple" tabindex="9">
                                                        {{-- <option value="">กรุณาเลือก</option> --}}
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
                            <div class="tab-pane fade" id="custom-tabs-one-address" role="tabpanel"
                                aria-labelledby="custom-tabs-one-address-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-home"></i> บ้านเลขที่:</strong>
                                                    {!! Form::text('homeno', null, [
                                                        'id' => 'Addhomeno',
                                                        'placeholder' => 'บ้านเลขที่',
                                                        'class' => 'form-control',
                                                        'tabindex' => '10',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-solid fa-people-roof"></i> หมู่:</strong>
                                                    {!! Form::text('moo', null, [
                                                        'id' => 'Addmoo',
                                                        'placeholder' => 'หมู่',
                                                        'class' => 'form-control',
                                                        'tabindex' => '11',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-solid fa-people-roof"></i> ซอย :</strong>
                                                    {!! Form::text('soi', null, [
                                                        'id' => 'Addsoi',
                                                        'placeholder' => 'ซอย',
                                                        'class' => 'form-control',
                                                        'tabindex' => '12',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-road"></i> ถนน :</strong>
                                                    {!! Form::text('road', null, [
                                                        'id' => 'Addroad',
                                                        'placeholder' => 'ถนน',
                                                        'class' => 'form-control',
                                                        'tabindex' => '13',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-solid fa-city"></i> จังหวัด :</strong>
                                                    <select class="select2 select2_single form-control" id="Addcity"
                                                        name="city" multiple="multiple" tabindex="14">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-solid fa-building-circle-arrow-right"></i>
                                                        อำเภอ:</strong>
                                                    <select class="select2 select2_single form-control"
                                                        id="Adddistrict" name="district" multiple="multiple"
                                                        tabindex="15">
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
                                                    <select class="select2 select2_single form-control"
                                                        id="Addsubdistrict" name="subdistrict" multiple="multiple"
                                                        tabindex="16">
                                                        {{-- <option value="">กรุณาเลือกตำบล</option> --}}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-code"></i> รหัสไปรษณีย์:</strong>
                                                    {!! Form::text('postcode', null, [
                                                        'id' => 'Addpostcode',
                                                        'placeholder' => 'รหัสไปรษณีย์',
                                                        'class' => 'form-control',
                                                        'tabindex' => '17',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                aria-labelledby="custom-tabs-one-profile-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-phone"></i> เบอร์โทรศัพท์บ้าน:</strong>
                                                    {!! Form::text('telhome', null, [
                                                        'id' => 'Addtelhome',
                                                        'placeholder' => 'เบอร์โทรศัพท์บ้าน',
                                                        'class' => 'form-control',
                                                        'tabindex' => '18',
                                                        'onkeydown' => 'validateNumber(event)',

                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-phone"></i> เบอร์โทรศัพท์มือถือ :</strong>
                                                    {!! Form::text('phoneno', null, [
                                                        'id' => 'Addphoneno',
                                                        'placeholder' => 'เบอร์โทรศัพท์มือถือ',
                                                        'class' => 'form-control',
                                                        'tabindex' => '19',
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
                                                    {!! Form::text('workno', null, [
                                                        'id' => 'Addworkno',
                                                        'placeholder' => 'เบอร์โทรศัพท์ที่ทำงาน',
                                                        'class' => 'form-control',
                                                        'tabindex' => '20',
                                                        'onkeydown' => 'validateNumber(event)',

                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <table id="myTbl3"
                                                    class="table table-striped table-bordered responsive-utilities jambo_table "
                                                    width="400">
                                                    <thead>
                                                        <tr class="headings">
                                                            <th class="column-title">
                                                                ชื่อบุคคลที่ติดต่อได้ในกรณีฉุกเฉิน<input type="hidden"
                                                                    value="" name="checkemer"
                                                                    id="Addcheckemer"></th>
                                                            <th class="column-title"> ความสัมพันธ์</th>
                                                            <th class="column-title"> เบอร์โทรศัพท์</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-12" align="right">

                                                <button type="button" id="addRowBtn"
                                                    class="btn btn-primary btnAddg"><i class="fa-solid fa-plus"></i>
                                                    เพิ่มบุคคลที่ติดต่อได้ในกรณีฉุกเฉิน</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
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
