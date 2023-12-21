<div class="row" style="display: flex; justify-content: center; align-items: center;">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="alert alert-danger alert-danger-pop{{ $cardid }} alert-dismissible fade show" role="alert"
            style="display: none;">
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="alert alert-success alert-success-pop{{ $cardid }} alert-dismissible fade show" role="alert"
            style="display: none;">

            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        {!! Form::open(['method' => 'POST', 'class' => 'form']) !!}
        <div class="text-end"><input type="hidden" value="" name="contractid{{ $cardid }}"
                id="contractid{{ $cardid }}"><input type="hidden" value="{{ $telephone }}"
                name="telnop{{ $cardid }}" id="telnop{{ $cardid }}">
            {{-- <h1 style="color: #1a16eb"><i class="fa-solid fa-id-card-clip"></i> {{ $telephone }}</h1> --}}
        </div>
        <div class="text-right">
        </div>
        <div class="card card-success card-outline card-outline-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tabp" role="tablist">
                    <li class="pt-2 px-3" id="phonenosuccess{{ $cardid }}"> </li>
                    {{--   <li class="pt-2 px-3">
                        <h3 class="card-title" id="contact_name"></h3>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link active tablistcaseP" id="custom-tabs-one-casedetail-tabp{{ $cardid }}"
                            data-tabid="{{ $cardid }}" data-contactid="{{ $contactd }}" data-toggle="pill"
                            href="#custom-tabs-one-casedetailp{{ $cardid }}" role="tab"
                            aria-controls="custom-tabs-one-casedetailp{{ $cardid }}"
                            aria-selected="false">ประวัติการติดต่อ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-home-tabp{{ $cardid }}" data-toggle="pill"
                            href="#custom-tabs-one-homep{{ $cardid }}" role="tab"
                            aria-controls="custom-tabs-one-homep{{ $cardid }}"
                            aria-selected="true">ข้อมูลผู้ติดต่อ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-address-tabp{{ $cardid }}" data-toggle="pill"
                            href="#custom-tabs-one-addressp{{ $cardid }}" role="tab"
                            aria-controls="custom-tabs-one-addressp{{ $cardid }}"
                            aria-selected="false">ข้อมูลที่อยู่</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-profile-tabp{{ $cardid }}" data-toggle="pill"
                            href="#custom-tabs-one-profilep{{ $cardid }}" role="tab"
                            aria-controls="custom-tabs-one-profilep{{ $cardid }}"
                            aria-selected="false">ข้อมูลเบอร์ติดต่อ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-case-tabp{{ $cardid }}" data-toggle="pill"
                            href="#custom-tabs-one-casep{{ $cardid }}" role="tab"
                            aria-controls="custom-tabs-one-casep{{ $cardid }}"
                            aria-selected="true">ข้อมูลเรื่องที่ติดต่อ</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContentp">
                    <div class="tab-pane fade" id="custom-tabs-one-homep{{ $cardid }}" role="tabpanel"
                        aria-labelledby="custom-tabs-one-home-tabp{{ $cardid }}">

                        <div class="row">

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-code"></i> HN:</strong>
                                    {!! Form::text('hnp' . $cardid, '', [
                                        'id' => 'hnp' . $cardid,
                                        'placeholder' => 'HN',
                                        'class' => 'form-control',
                                        'readonly' => false,
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-calendar"></i> วันที่บันทึก:</strong>
                                    {!! Form::text('adddatep' . $cardid, date('Y-m-d'), [
                                        'id' => 'adddatep' . $cardid,
                                        'placeholder' => 'วันที่บันทึก',
                                        'class' => 'AddDatep form-control',
                                        'data-target' => '#reservationdate',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-user-tie"></i> คำนำหน้าชื่อ:</strong>
                                    <select style="width: 100%;" class="select2 select2_single form-control"
                                        id="tnamep{{ $cardid }}" name="tnamep{{ $cardid }}">
                                        <option value="">กรุณาเลือก</option>
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
                                    {!! Form::text('fnamep' . $cardid, null, [
                                        'id' => 'fnamep' . $cardid,
                                        'placeholder' => 'ชื่อ',
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-user-tie"></i> นามสกุล:</strong>
                                    {!! Form::text('lnamep' . $cardid, null, [
                                        'id' => 'lnamep' . $cardid,
                                        'placeholder' => 'นามสกุล',
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-user-tie"></i> เพศ:</strong>
                                    <select style="width: 100%;" class="select2 select2_single form-control"
                                        id="sexp{{ $cardid }}" name="sexp{{ $cardid }}">
                                        <option value="">กรุณาเลือก</option>
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
                                    {!! Form::text('birthdayp' . $cardid, null, [
                                        'id' => 'birthdayp' . $cardid,
                                        'data-tid' => $cardid,
                                        'placeholder' => 'วันเกิด',
                                        'class' => 'Birthdayp form-control',
                                        'data-target' => '#reservationdate',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-user-tie"></i> อายุ:</strong>
                                    {!! Form::text('agep' . $cardid, null, [
                                        'id' => 'agep' . $cardid,
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
                                        id="bloodgroupp{{ $cardid }}" name="bloodgroupp{{ $cardid }}">
                                        <option value="">กรุณาเลือก</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="AB">AB</option>
                                        <option value="O">O</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="custom-tabs-one-addressp{{ $cardid }}" role="tabpanel"
                        aria-labelledby="custom-tabs-one-address-tabp{{ $cardid }}">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-home"></i> บ้านเลขที่:</strong>
                                    {!! Form::text('homenop' . $cardid, null, [
                                        'id' => 'homenop' . $cardid,
                                        'placeholder' => 'บ้านเลขที่',
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fa-solid fa-people-roof"></i> หมู่:</strong>
                                    {!! Form::text('moop' . $cardid, null, [
                                        'id' => 'moop' . $cardid,
                                        'placeholder' => 'หมู่',
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fa-solid fa-people-roof"></i> ซอย :</strong>
                                    {!! Form::text('soip' . $cardid, null, [
                                        'id' => 'soip' . $cardid,
                                        'placeholder' => 'ซอย',
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-road"></i> ถนน :</strong>
                                    {!! Form::text('roadp' . $cardid, null, [
                                        'id' => 'roadp' . $cardid,
                                        'placeholder' => 'ถนน',
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fa-solid fa-city"></i> จังหวัด :</strong>
                                    <select style="width: 100%;" class="select2 select2_single form-control citypchang"
                                        id="cityp{{ $cardid }}" data-tabid="{{ $cardid }}"
                                        name="cityp{{ $cardid }}">
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fa-solid fa-building-circle-arrow-right"></i>
                                        อำเภอ:</strong>
                                    <select style="width: 100%;" class="select2 select2_single form-control districtpchang"
                                        id="districtp{{ $cardid }}" data-tabid="{{ $cardid }}"
                                        name="districtp{{ $cardid }}">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fa-solid fa-building-circle-arrow-right"></i> ตำบล
                                        :</strong>
                                    <select style="width: 100%;" class="select2 select2_single form-control"
                                        id="subdistrictp{{ $cardid }}" name="subdistrictp{{ $cardid }}">
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-code"></i> รหัสไปรษณีย์:</strong>
                                    {!! Form::text('postcodep' . $cardid, null, [
                                        'id' => 'postcodep' . $cardid,
                                        'placeholder' => 'รหัสไปรษณีย์',
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="custom-tabs-one-profilep{{ $cardid }}" role="tabpanel"
                        aria-labelledby="custom-tabs-one-profile-tabp{{ $cardid }}">

                        <div class="row">

                            <div class="col-xs-5 col-sm-5 col-md-5">
                                <div class="form-group">
                                    <strong><i class="fas fa-phone"></i> เบอร์โทรศัพท์บ้าน:</strong>
                                    {!! Form::text('telhomep' . $cardid, null, [
                                        'id' => 'telhomep' . $cardid,
                                        'placeholder' => 'เบอร์โทรศัพท์บ้าน',
                                        'class' => 'form-control',
                                        'onkeydown' => 'validateNumberp(event)',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-xs-1 col-sm-1 col-md-1" style="align-items: flex-end;">
                                <strong>&nbsp;</strong>
                                <button type="button" class="form-control btn btn-success btnpnumber"
                                    data-tagetp="telhomep" data-tabid="{{ $cardid }}">
                                    <i class="fa-regular fa-paste"></i></button>
                            </div>
                            <div class="col-xs-5 col-sm-5 col-md-5">
                                <div class="form-group">
                                    <strong><i class="fas fa-phone"></i> เบอร์โทรศัพท์มือถือ :</strong>
                                    {!! Form::text('phonenop' . $cardid, null, [
                                        'id' => 'phonenop' . $cardid,
                                        'placeholder' => 'เบอร์โทรศัพท์มือถือ',
                                        'class' => 'form-control',
                                        'onkeydown' => 'validateNumberp(event)',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-xs-1 col-sm-1 col-md-1" style="align-items: flex-end;">
                                <strong>&nbsp;</strong>
                                <button type="button" class="form-control btn btn-success btnpnumber"
                                    data-tagetp="phonenop" data-tabid="{{ $cardid }}">
                                    <i class="fa-regular fa-paste"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-5 col-sm-5 col-md-5">
                                <div class="form-group">
                                    <strong><i class="fas fa-phone"></i>
                                        เบอร์โทรศัพท์ที่ทำงาน:</strong>
                                    {!! Form::text('worknop' . $cardid, null, [
                                        'id' => 'worknop' . $cardid,
                                        'placeholder' => 'เบอร์โทรศัพท์ที่ทำงาน',
                                        'class' => 'form-control',
                                        'onkeydown' => 'validateNumberp(event)',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-xs-1 col-sm-1 col-md-1" style="align-items: flex-end;">
                                <strong>&nbsp;</strong>
                                <button type="button" class="form-control btn btn-success btnpnumber"
                                    data-tagetp="worknop" data-tabid="{{ $cardid }}">
                                    <i class="fa-regular fa-paste"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <table id="myTbl3p{{ $cardid }}"
                                    class="table table-striped table-bordered responsive-utilities jambo_table "
                                    width="400">
                                    <thead>
                                        <tr class="headings">
                                            <th class="column-title">
                                                ชื่อบุคคลที่ติดต่อได้ในกรณีฉุกเฉิน</th>
                                            <th class="column-title"> ความสัมพันธ์</th>
                                            <th class="column-title"> เบอร์โทรศัพท์</th>
                                            <th class="column-title"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12" align="right">

                                <button type="button" id="addRowBtnp{{ $cardid }}"
                                    class="btn btn-warning btnAddg addRowBtnp-button" data-id=""
                                    data-tabid="{{ $cardid }}"><i class="fa-solid fa-plus"></i>
                                    เพิ่มบุคคลที่ติดต่อได้ในกรณีฉุกเฉิน</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show active" id="custom-tabs-one-casedetailp{{ $cardid }}"
                        role="tabpanel" aria-labelledby="custom-tabs-one-casedetail-tabp{{ $cardid }}">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div id="ListviewcasesP{{ $cardid }}">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <table id="ListCaseview{{ $cardid }}"
                                                class="table table-sm table-head-fixed text-nowrap table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>วันที่ทำรายการ</th>
                                                        <th>ประเภทเคส</th>
                                                        <th>รายละเอียดเคส</th>
                                                        <th>สถานะเคส</th>
                                                        <th>Agent ที่บันทึก</th>
                                                        <th width="120px"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="6" align="center">ไม่พบข้อมูลการติดต่อ</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-casep{{ $cardid }}" role="tabpanel"
                        aria-labelledby="custom-tabs-one-case-tabp{{ $cardid }}">

                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fa-regular fa-message"></i> ประเภทเคส:</strong>
                                    <select style="width: 100%;" class="select2 select2_single form-control casetypechang"
                                        id="casetype1p{{ $cardid }}" name="casetype1p{{ $cardid }}"
                                        data-tabid="{{ $cardid }}" data-lev="1">
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fa-regular fa-comment-dots"></i>
                                        รายละเอียดเคส:</strong>
                                    <select style="width: 100%;" class="select2 select2_single form-control casetypechang"
                                        id="casetype2p{{ $cardid }}" name="casetype2p{{ $cardid }}"
                                        data-tabid="{{ $cardid }}" data-lev="2">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fa-regular fa-comment-dots"></i>
                                        รายละเอียดเคสย่อย:</strong>
                                    <select style="width: 100%;" class="select2 select2_single form-control casetypechang"
                                        id="casetype3p{{ $cardid }}" name="casetype3p{{ $cardid }}"
                                        data-tabid="{{ $cardid }}" data-lev="3">
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fa-regular fa-comment-dots"></i> รายละเอียดเคส
                                        เพิ่มเติม 1:</strong>
                                    <select style="width: 100%;" class="select2 select2_single form-control casetypechang"
                                        id="casetype4p{{ $cardid }}" name="casetype4p{{ $cardid }}"
                                        data-tabid="{{ $cardid }}" data-lev="4">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fa-regular fa-comment-dots"></i> รายละเอียดเคส
                                        เพิ่มเติม 2:</strong>
                                    <select style="width: 100%;" class="select2 select2_single form-control casetypechang"
                                        id="casetype5p{{ $cardid }}" name="casetype5p{{ $cardid }}"
                                        data-tabid="{{ $cardid }}" data-lev="5">
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fa-regular fa-comment-dots"></i> รายละเอียดเคส
                                        เพิ่มเติม 3:</strong>
                                    <select style="width: 100%;" class="select2 select2_single form-control casetypechang"
                                        id="casetype6p{{ $cardid }}" name="casetype6p{{ $cardid }}"
                                        data-tabid="{{ $cardid }}" data-lev="6">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong><i class="fa-regular fa-comment-dots"></i>
                                        รายละเอียด:</strong>
                                    {!! Form::textarea('casedetailp' . $cardid, null, [
                                        'rows' => 4,
                                        'id' => 'casedetailp' . $cardid,
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-shuffle"></i> สถานะการโอนสาย
                                        :</strong>
                                    <select class="select2 select2_single form-control" id="tranferstatusp{{ $cardid }}"
                                        name="tranferstatusp{{ $cardid }}">
                                        <option value="ไม่มีการโอนสาย">ไม่มีการโอนสาย</option>
                                        <option value="รับสาย">รับสาย</option>
                                        <option value="ไม่รับสาย">ไม่รับสาย</option>
                                        <option value="สายไม่ว่าง">สายไม่ว่าง</option>
                                        <option value="โอนอัตโนมัติ">โอนอัตโนมัติ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-arrows-rotate"></i> สถานะการเคส
                                        :</strong>
                                    <select class="select2 select2_single form-control" id="casestatusp{{ $cardid }}"
                                        name="casestatusp{{ $cardid }}">
                                        <option value="ปิดเคส">ปิดเคส</option>
                                        <option value="กำลังดำเนินการ">กำลังดำเนินการ</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>

        {!! Form::close() !!}
        <div class="modal-footer {{-- justify-content-between --}}">
            <button type="button" class="btn btn-success SubmitCreateFormP-button" data-id=""
                data-tabid="{{ $cardid }}" data-uniqid="{{ $cardid }}"
                id="SubmitCreateFormP{{ $cardid }}"><i class="fas fa-download"></i>
                บันทึกข้อมูล</button>
        </div>

    </div>
