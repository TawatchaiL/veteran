<div class="row" style="display: flex; justify-content: center; align-items: center;">
    <div class="col-md-10 col-sm-10 col-lg-10">
        <div class="alert alert-danger alert-danger-pop alert-dismissible fade show" role="alert" style="display: none;">
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="alert alert-success alert-success-pop alert-dismissible fade show" role="alert" style="display: none;">

            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"></span>
            </button>
        </div>

        {!! Form::open(['method' => 'POST', 'class' => 'form']) !!}
        <div class="text-center">
            <h1 style="color: #1a16eb"><i class="fa-solid fa-id-card-clip"></i><input type="hidden" value="" name="contractid" id="contractid"><input type="hidden" value="{{ $telephone }}" name="telnop" id="telnop"> {{ $telephone }}</h1>
        </div>
        <div id="phonenosuccess" class="text-center">
        </div>
        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tabp" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-home-tabp" data-toggle="pill"
                            href="#custom-tabs-one-homep" role="tab" aria-controls="custom-tabs-one-homep"
                            aria-selected="true">ข้อมูลผู้ติดต่อ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-profile-tabp" data-toggle="pill"
                            href="#custom-tabs-one-profilep" role="tab" aria-controls="custom-tabs-one-profilep"
                            aria-selected="false">ข้อมูลเบอร์ติดต่อ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-case-tabp" data-toggle="pill"
                            href="#custom-tabs-one-casep" role="tab" aria-controls="custom-tabs-one-casep"
                            aria-selected="true">ข้อมูลเรื่องที่ติดต่อ</a>
                    </li>
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
                                            <strong><i class="fas fa-code"></i> รหัสผู้ติดต่อ:</strong>
                                            {!! Form::text('hnp', '', [
                                                'id' => 'hnp',
                                                'placeholder' => 'รหัสผู้ติดต่อ',
                                                'class' => 'form-control',
                                                'readonly' => false,
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fas fa-calendar"></i> วันที่บันทึก:</strong>
                                            {!! Form::text('adddatep', date('Y-m-d'), [
                                                'id' => 'adddatep',
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
                                            {!! Form::text('fnamep', null, ['id' => 'fnamep', 'placeholder' => 'ชื่อ', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fas fa-user-tie"></i> นามสกุล:</strong>
                                            {!! Form::text('lnamep', null, [
                                                'id' => 'lnamep',
                                                'placeholder' => 'นามสกุล',
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
                                            <strong><i class="fas fa-home"></i> บ้านเลขที่:</strong>
                                            {!! Form::text('homenop', null, [
                                                'id' => 'homenop',
                                                'placeholder' => 'บ้านเลขที่',
                                                'class' => 'form-control',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fa-solid fa-people-roof"></i> หมู่:</strong>
                                            {!! Form::text('moop', null, [
                                                'id' => 'moop',
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
                                            {!! Form::text('soip', null, [
                                                'id' => 'soip',
                                                'placeholder' => 'ซอย',
                                                'class' => 'form-control',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fas fa-road"></i> ถนน :</strong>
                                            {!! Form::text('roadp', null, [
                                                'id' => 'roadp',
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
                                            <select style="width: 100%;" class="select2 form-control"
                                                id="cityp" name="cityp">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fa-solid fa-building-circle-arrow-right"></i>
                                                อำเภอ:</strong>
                                            <select style="width: 100%;" class="select2 form-control"
                                                id="districtp" name="districtp">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fa-solid fa-building-circle-arrow-right"></i> ตำบล
                                                :</strong>
                                            <select style="width: 100%;" class="select2 form-control"
                                                id="subdistrictp" name="subdistrictp">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fas fa-code"></i> รหัสไปรษณีย์:</strong>
                                            {!! Form::text('postcodep', null, [
                                                'id' => 'postcodep',
                                                'placeholder' => 'รหัสไปรษณีย์',
                                                'class' => 'form-control',
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="tab-pane fade" id="custom-tabs-one-profilep" role="tabpanel"
                        aria-labelledby="custom-tabs-one-profile-tabp">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fas fa-phone"></i> เบอร์โทรศัพท์บ้าน:</strong>
                                            {!! Form::text('telhomep', null, [
                                                'id' => 'telhomep',
                                                'placeholder' => 'เบอร์โทรศัพท์บ้าน',
                                                'class' => 'form-control',
                                                'onkeydown' => 'validateNumber(event)',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fas fa-phone"></i> เบอร์โทรศัพท์มือถือ :</strong>
                                            {!! Form::text('phonenop', null, [
                                                'id' => 'phonenop',
                                                'placeholder' => 'เบอร์โทรศัพท์มือถือ',
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
                                            {!! Form::text('worknop', null, [
                                                'id' => 'worknop',
                                                'placeholder' => 'เบอร์โทรศัพท์ที่ทำงาน',
                                                'class' => 'form-control',
                                                'onkeydown' => 'validateNumber(event)',
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <table id="myTbl3p"
                                            class="table table-striped table-bordered responsive-utilities jambo_table "
                                            width="400">
                                            <thead>
                                                <tr class="headings">
                                                    {{-- <th class="column-title"> สินค้า</th> --}}
                                                    <th class="column-title">
                                                        ชื่อบุคคลที่ติดต่อได้ในกรณีฉุกเฉิน</th>
                                                    <th class="column-title"> ความสัมพันธ์</th>
                                                    <th class="column-title"> เบอร์โทรศัพท์</th>
                                                    <th class="column-title"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td width="30%">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <input type="hidden" value="" name="emertypep[]" id="emertypep">
                                                        <input type="text" id="emergencynamep" name="emergencynamep[]"
                                                            class="form-control has-feedback-left" value=""
                                                            required="required">
                                                    </div>
                                                </td>

                                                <td width="10%">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <input type="text" id="emerrelationp" name="emerrelationp[]"
                                                            class="form-control has-feedback-left" value=""
                                                            required="required">
                                                    </div>
                                                </td>
                                                <td width="10%">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <input type="text" id="emerphonep" name="emerphonep[]"
                                                            class="form-control has-feedback-left" onkeydown="validateNumber(event)" value=""
                                                            required="required">
                                                    </div>
                                                </td>
                                                <td width="5%">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12" align="right">

                                        <button type="button" id="addRowBtnp" class="btn btn-warning btnAddg"><i
                                                class="fa-solid fa-plus"></i>
                                            เพิ่มบุคคลที่ติดต่อได้ในกรณีฉุกเฉิน</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-casep" role="tabpanel"
                        aria-labelledby="custom-tabs-one-case-tabp">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fa-regular fa-message"></i> ประเภทเคส:</strong>
                                            <select class="select2 form-control" id="casetype1p"
                                                name="casetype1p">
                                                @foreach ($casetype as $key2)
                                                    <option value="{{ $key2->id }}">{{ $key2->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong><i class="fa-regular fa-comment-dots"></i>
                                                รายละเอียด:</strong>
                                            {!! Form::textarea('casedetailp', null, [
                                                'rows' => 4,
                                                'id' => 'casedetailp',
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
                                            <select class="select2 form-control" id="tranferstatusp"
                                                name="tranferstatusp">
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
                                            <select class="select2 form-control" id="casestatusp"
                                                name="casestatusp">
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
            </div>
            <div class="card-footer text-muted">
                <button type="button" class="btn btn-success" id="SubmitCreateFormPOP"><i
                        class="fas fa-download"></i>
                    บันทึกข้อมูล</button>

            </div>
        </div>

        {!! Form::close() !!}
    </div>

</div>
