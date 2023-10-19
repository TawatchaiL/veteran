<div class="row" style="display: flex; justify-content: center; align-items: center;">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="alert alert-danger alert-danger-pop{{$cardid}} alert-dismissible fade show" role="alert" style="display: none;">
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="alert alert-success alert-success-pop{{$cardid}} alert-dismissible fade show" role="alert"
            style="display: none;">

            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        {!! Form::open(['method' => 'POST', 'class' => 'form']) !!}
        <div class="text-end"><input type="hidden" value="{{$contactd['0']->id}}" name="contractid{{$cardid}}" id="contractid{{$cardid}}"><input type="hidden" value="{{ $telephone }}" name="telnop{{$cardid}}" id="telnop{{$cardid}}">
            {{-- <h1 style="color: #1a16eb"><i class="fa-solid fa-id-card-clip"></i> {{ $telephone }}</h1> --}}
        </div>
        <div  class="text-right">
        </div>
        <div class="card card-success card-outline card-outline-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tabp" role="tablist">
                    <li class="pt-2 px-3" id="phonenosuccess{{$cardid}}"> </li>
                    {{--   <li class="pt-2 px-3">
                        <h3 class="card-title" id="contact_name"></h3>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-home-tabp{{$cardid}}" data-toggle="pill"
                            href="#custom-tabs-one-homep{{$cardid}}" role="tab" aria-controls="custom-tabs-one-homep{{$cardid}}"
                            aria-selected="true">ข้อมูลผู้ติดต่อ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-profile-tabp{{$cardid}}" data-toggle="pill"
                            href="#custom-tabs-one-profilep{{$cardid}}" role="tab" aria-controls="custom-tabs-one-profilep{{$cardid}}"
                            aria-selected="false">ข้อมูลเบอร์ติดต่อ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-case-tabp{{$cardid}}" data-toggle="pill"
                            href="#custom-tabs-one-casep{{$cardid}}" role="tab" aria-controls="custom-tabs-one-casep{{$cardid}}"
                            aria-selected="true">ข้อมูลเรื่องที่ติดต่อ</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContentp">
                    <div class="tab-pane fade show active" id="custom-tabs-one-homep{{$cardid}}" role="tabpanel"
                        aria-labelledby="custom-tabs-one-home-tabp{{$cardid}}">

                        <div class="row">

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-code"></i> รหัสผู้ติดต่อ:</strong>
                                    {!! Form::text('hnp'.$cardid, '', [
                                        'id' => 'hnp'.$cardid,
                                        'placeholder' => 'รหัสผู้ติดต่อ',
                                        'class' => 'form-control',
                                        'readonly' => false,
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-calendar"></i> วันที่บันทึก:</strong>
                                    {!! Form::text('adddatep'.$cardid, date('Y-m-d'), [
                                        'id' => 'adddatep'.$cardid,
                                        'placeholder' => 'วันที่บันทึก',
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
                                    <strong><i class="fas fa-user-tie"></i> ชื่อ:</strong>
                                    {!! Form::text('fnamep'.$cardid, null, ['id' => 'fnamep'.$cardid, 'placeholder' => 'ชื่อ', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-user-tie"></i> นามสกุล:</strong>
                                    {!! Form::text('lnamep'.$cardid, null, [
                                        'id' => 'lnamep'.$cardid,
                                        'placeholder' => 'นามสกุล',
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-home"></i> บ้านเลขที่:</strong>
                                    {!! Form::text('homenop'.$cardid, null, [
                                        'id' => 'homenop'.$cardid,
                                        'placeholder' => 'บ้านเลขที่',
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fa-solid fa-people-roof"></i> หมู่:</strong>
                                    {!! Form::text('moop'.$cardid, null, [
                                        'id' => 'moop'.$cardid,
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
                                    {!! Form::text('soip'.$cardid, null, [
                                        'id' => 'soip'.$cardid,
                                        'placeholder' => 'ซอย',
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-road"></i> ถนน :</strong>
                                    {!! Form::text('roadp'.$cardid, null, [
                                        'id' => 'roadp'.$cardid,
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
                                    <select style="width: 100%;" class="select2 form-control citypchang" id="cityp{{$cardid}}" data-tabid="{{$cardid}}"
                                        name="cityp{{$cardid}}">
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fa-solid fa-building-circle-arrow-right"></i>
                                        อำเภอ:</strong>
                                    <select style="width: 100%;" class="select2 form-control districtpchang" id="districtp{{$cardid}}" data-tabid="{{$cardid}}"
                                        name="districtp{{$cardid}}">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fa-solid fa-building-circle-arrow-right"></i> ตำบล
                                        :</strong>
                                    <select style="width: 100%;" class="select2 form-control" id="subdistrictp{{$cardid}}"
                                        name="subdistrictp{{$cardid}}">
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-code"></i> รหัสไปรษณีย์:</strong>
                                    {!! Form::text('postcodep'.$cardid, null, [
                                        'id' => 'postcodep'.$cardid,
                                        'placeholder' => 'รหัสไปรษณีย์',
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="custom-tabs-one-profilep{{$cardid}}" role="tabpanel"
                        aria-labelledby="custom-tabs-one-profile-tabp{{$cardid}}">

                        <div class="row">

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-phone"></i> เบอร์โทรศัพท์บ้าน:</strong>
                                    {!! Form::text('telhomep'.$cardid, null, [
                                        'id' => 'telhomep'.$cardid,
                                        'placeholder' => 'เบอร์โทรศัพท์บ้าน',
                                        'class' => 'form-control',
                                        'onkeydown' => 'validateNumberp(event)',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-phone"></i> เบอร์โทรศัพท์มือถือ :</strong>
                                    {!! Form::text('phonenop'.$cardid, null, [
                                        'id' => 'phonenop'.$cardid,
                                        'placeholder' => 'เบอร์โทรศัพท์มือถือ',
                                        'class' => 'form-control',
                                        'onkeydown' => 'validateNumberp(event)',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-phone"></i>
                                        เบอร์โทรศัพท์ที่ทำงาน:</strong>
                                    {!! Form::text('worknop'.$cardid, null, [
                                        'id' => 'worknop'.$cardid,
                                        'placeholder' => 'เบอร์โทรศัพท์ที่ทำงาน',
                                        'class' => 'form-control',
                                        'onkeydown' => 'validateNumberp(event)',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <table id="myTbl3p{{$cardid}}"
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

                                <button type="button" id="addRowBtnp{{$cardid}}" class="btn btn-warning btnAddg addRowBtnp-button" data-id="" data-tabid="{{ $cardid }}"><i
                                        class="fa-solid fa-plus"></i>
                                    เพิ่มบุคคลที่ติดต่อได้ในกรณีฉุกเฉิน</button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="custom-tabs-one-casep{{$cardid}}" role="tabpanel"
                        aria-labelledby="custom-tabs-one-case-tabp{{$cardid}}">

                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fa-regular fa-message"></i> ประเภทเคส:</strong>
                                    <select style="width: 100%;" class="select2 form-control casetypechang" id="casetype1p{{$cardid}}"
                                        name="casetype1p{{$cardid}}" data-tabid="{{$cardid}}" data-lev="1">
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fa-regular fa-comment-dots"></i>
                                        รายละเอียดเคส:</strong>
                                    <select style="width: 100%;" class="select2 form-control casetypechang" id="casetype2p{{$cardid}}"
                                        name="casetype2p{{$cardid}}" data-tabid="{{$cardid}}" data-lev="2">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fa-regular fa-comment-dots"></i>
                                        รายละเอียดเคสย่อย:</strong>
                                    <select style="width: 100%;" class="select2 form-control casetypechang" id="casetype3p{{$cardid}}"
                                        name="casetype3p{{$cardid}}" data-tabid="{{$cardid}}" data-lev="3">
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fa-regular fa-comment-dots"></i> รายละเอียดเคส
                                        เพิ่มเติม 1:</strong>
                                    <select style="width: 100%;" class="select2 form-control casetypechang" id="casetype4p{{$cardid}}"
                                        name="casetype4p{{$cardid}}" data-tabid="{{$cardid}}" data-lev="4">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fa-regular fa-comment-dots"></i> รายละเอียดเคส
                                        เพิ่มเติม 2:</strong>
                                    <select style="width: 100%;" class="select2 form-control casetypechang" id="casetype5p{{$cardid}}"
                                        name="casetype5p{{$cardid}}" data-tabid="{{$cardid}}" data-lev="5">
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fa-regular fa-comment-dots"></i> รายละเอียดเคส
                                        เพิ่มเติม 3:</strong>
                                    <select style="width: 100%;" class="select2 form-control casetypechang" id="casetype6p{{$cardid}}"
                                        name="casetype6p{{$cardid}}" data-tabid="{{$cardid}}" data-lev="6">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong><i class="fa-regular fa-comment-dots"></i>
                                        รายละเอียด:</strong>
                                    {!! Form::textarea('casedetailp'.$cardid, null, [
                                        'rows' => 4,
                                        'id' => 'casedetailp'.$cardid,
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
                                    <select class="select2 form-control" id="tranferstatusp{{$cardid}}" name="tranferstatusp{{$cardid}}>
                                        <option value="รับสาย">รับสาย</option>
                                        <option value="ไม่รับสาย">ไม่รับสาย</option>
                                        <option value="สายไม่ว่าง">สายไม่ว่าง</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-arrows-rotate"></i> สถานะการเคส
                                        :</strong>
                                    <select class="select2 form-control" id="casestatusp{{$cardid}}" name="casestatusp{{$cardid}}">
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
            <button type="button" class="btn btn-success SubmitCreateFormP-button" data-id="" data-tabid="{{ $cardid }}" id="SubmitCreateFormP{{$cardid}}"><i class="fas fa-download"></i>
                บันทึกข้อมูล</button>
    </div>

</div>
