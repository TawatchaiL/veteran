<div class="row" style="display: flex; justify-content: center; align-items: center;">
    <div class="col-md-10 col-sm-10 col-lg-10">
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
        {!! Form::open(['method' => 'POST', 'class' => 'form']) !!}
        <div class="text-center">
            <h1 style="color: #1a16eb"><i class="fa-solid fa-id-card-clip"></i> {{ $telephone }}</h1>
            @if ($contact_name)
                <h2 style="color: #1a16eb"><i class="fa-solid fa-user-tie"></i> {{ $contact_name }} {{ $contact_lname }}
                </h2>
            @endif
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
                                            {!! Form::text('hn', '000001', [
                                                'id' => 'hn',
                                                'placeholder' => 'รหัสผู้ติดต่อ',
                                                'class' => 'form-control',
                                                'readonly' => false,
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fas fa-calendar"></i> วันที่บันทึก:</strong>
                                            {!! Form::text('start_date', date('Y-m-d'), [
                                                'id' => 'AddDate',
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
                                            {!! Form::text('fname', null, ['id' => 'fname', 'placeholder' => 'ชื่อ', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fas fa-user-tie"></i> นามสกุล:</strong>
                                            {!! Form::text('lname', null, [
                                                'id' => 'lname',
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
                                            {!! Form::text('homeno', null, [
                                                'id' => 'homeno',
                                                'placeholder' => 'บ้านเลขที่',
                                                'class' => 'form-control',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fa-solid fa-people-roof"></i> หมู่:</strong>
                                            {!! Form::text('moo', null, [
                                                'id' => 'moo',
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
                                            {!! Form::text('soi', null, [
                                                'id' => 'soi',
                                                'placeholder' => 'ซอย',
                                                'class' => 'form-control',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fas fa-road"></i> ถนน :</strong>
                                            {!! Form::text('road', null, [
                                                'id' => 'road',
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
                                            <select style="width: 100%;" class="select2 select2_city form-control"
                                                id="city" name="city" multiple="multiple">
                                                <option value="" selected>พิษณุโลก</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fa-solid fa-building-circle-arrow-right"></i>
                                                อำเภอ:</strong>
                                            <select style="width: 100%;" class="select2 select2_am form-control"
                                                id="district" name="district" multiple="multiple">
                                                <option value="" selected>อำเภอเมือง</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fa-solid fa-building-circle-arrow-right"></i> ตำบล
                                                :</strong>
                                            <select style="width: 100%;" class="select2 select2_tm form-control"
                                                id="subdistrict" name="subdistrict" multiple="multiple">
                                                <option value="" selected>ในเมือง</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fas fa-code"></i> รหัสไปรษณีย์:</strong>
                                            {!! Form::text('postcode', null, [
                                                'id' => 'postcode',
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
                                            {!! Form::text('telhome', null, [
                                                'id' => 'telhome',
                                                'placeholder' => 'เบอร์โทรศัพท์บ้าน',
                                                'class' => 'form-control',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fas fa-phone"></i> เบอร์โทรศัพท์มือถือ :</strong>
                                            {!! Form::text('phoneno', null, [
                                                'id' => 'phoneno',
                                                'placeholder' => 'เบอร์โทรศัพท์มือถือ',
                                                'class' => 'form-control',
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
                                                'id' => 'workno',
                                                'placeholder' => 'เบอร์โทรศัพท์ที่ทำงาน',
                                                'class' => 'form-control',
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
                                                </tr>
                                            </thead>
                                            <tr>
                                                <td width="30%">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <input type="text" id="name" name="name[]"
                                                            class="form-control has-feedback-left" value=""
                                                            required="required">
                                                    </div>
                                                </td>

                                                <td width="10%">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <input type="text" id="amount" name="amount[]"
                                                            class="form-control has-feedback-left" value=""
                                                            required="required">
                                                    </div>
                                                </td>
                                                <td width="10%">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <input type="text" id="price" name="price[]"
                                                            class="form-control has-feedback-left" value=""
                                                            required="required">
                                                    </div>
                                                </td>
                                                <td width="5%">
                                                </td>
                                            </tr>
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
                                            <strong><i class="fas fa-code"></i> HN:</strong>
                                            {!! Form::text('name', '000001', [
                                                'id' => 'AddName',
                                                'placeholder' => 'Name',
                                                'class' => 'form-control',
                                                'readonly' => false,
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fas fa-user-tie"></i> ชื่อ-สกุล :</strong>
                                            {!! Form::text('name', null, [
                                                'id' => 'AddName',
                                                'placeholder' => 'Name',
                                                'class' => 'form-control',
                                                'readonly' => false,
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fa-regular fa-message"></i> ประเภทเคส:</strong>
                                            <select class="select2 select2_single form-control" id="casetype1p"
                                                name="casetype1p" multiple="multiple">
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
                                            <select class="select2 select2_single form-control" id="casetype2p"
                                                name="casetype2p" multiple="multiple">
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
                                            <select class="select2 select2_single form-control" id="casetype3p"
                                                name="casetype3p" multiple="multiple">
                                                <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                    <option value="" selected>Select Parent</option>-->

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fa-regular fa-comment-dots"></i> รายละเอียดเคส
                                                เพิ่มเติม 1:</strong>
                                            <select class="select2 select2_single form-control" id="casetype4p"
                                                name="casetype4p" multiple="multiple">
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
                                            <select class="select2 select2_single form-control" id="casetype5p"
                                                name="casetype5p" multiple="multiple">
                                                <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                    <option value="" selected>Select Parent</option>-->

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fa-regular fa-comment-dots"></i> รายละเอียดเคส
                                                เพิ่มเติม 3:</strong>
                                            <select class="select2 select2_single form-control" id="casetype6p"
                                                name="casetype6p" multiple="multiple">
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
                                            {!! Form::textarea('detail', null, [
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
                                            <select class="select2 select2_single form-control" id="tranferstatusp"
                                                name="tranferstatus" multiple="multiple">
                                                <option value="1">รับสาย</option>
                                                <option value="2">ไม่รับสาย</option>
                                                <option value="3">สายไม่ว่าง</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong><i class="fas fa-arrows-rotate"></i> สถานะการเคส
                                                :</strong>
                                            <select class="select2 select2_single form-control" id="casestatusp"
                                                name="casestatus" multiple="multiple">
                                                <option value="1">ปิดเคส</option>
                                                <option value="2">กำลังดำเนินการ</option>
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
