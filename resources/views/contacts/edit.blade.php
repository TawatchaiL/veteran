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
                                <a class="nav-link" id="custom-tabs-one-profile-tabe" data-toggle="pill"
                                    href="#custom-tabs-one-profilee" role="tab"
                                    aria-controls="custom-tabs-one-profilee" aria-selected="false">ข้อมูลเบอร์ติดต่อ</a>
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
                                                    {!! Form::text('code', '00001', [
                                                        'id' => 'AddCode',
                                                        'placeholder' => 'Code',
                                                        'class' => 'form-control',
                                                        'readonly' => true,
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-calendar"></i> วันที่บันทึก:</strong>
                                                    {!! Form::text('start_date', '2023-08-28', [
                                                        'id' => 'AddDate',
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
                                                    <strong><i class="fas fa-user-tie"></i> ชื่อ:</strong>
                                                    {!! Form::text('name', 'สมชาย', ['id' => 'AddName', 'placeholder' => 'Name', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-user-tie"></i> นามสกุล:</strong>
                                                    {!! Form::text('name', 'เสมอ', ['id' => 'AddName', 'placeholder' => 'LastName', 'class' => 'form-control']) !!}
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
                                                    {!! Form::text('postcode', '90', [
                                                        'id' => 'AddPostcode',
                                                        'placeholder' => 'Address',
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-solid fa-people-roof"></i> หมู่:</strong>
                                                    {!! Form::text('homephone', '2', [
                                                        'id' => 'homephone',
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
                                                    {!! Form::text('postcode', '3', [
                                                        'id' => 'AddPostcode',
                                                        'placeholder' => 'Soi',
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-road"></i> ถนน :</strong>
                                                    {!! Form::text('homephone', 'ศรีธรรมไตรปิฎก', [
                                                        'id' => 'homephone',
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
                                                    <select class="select2 select2_single form-control" id="ecity"
                                                        name="ecity" multiple="multiple">
                                                        <option value="1" selected="selected">พิษณุโลก </option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-solid fa-building-circle-arrow-right"></i>
                                                        อำเภอ:</strong>
                                                    <select class="select2 select2_single form-control" id="eam"
                                                        name="eam" multiple="multiple">
                                                        <option value="1" selected="selected">อำเภอเมือง
                                                        </option>
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
                                                    <select class="select2 select2_single form-control" id="etm"
                                                        name="etm" multiple="multiple">
                                                        <option value="1" selected="selected">ในเมือง</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-code"></i> รหัสไปรษณีย์:</strong>
                                                    {!! Form::text('postcode', '65000', [
                                                        'id' => 'AddPostcode',
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
                                                    {!! Form::text('homephone', null, [
                                                        'id' => 'homephone',
                                                        'placeholder' => 'Telephone',
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-phone"></i> เบอร์โทรศัพท์มือถือ :</strong>
                                                    {!! Form::text('telephone', null, [
                                                        'id' => 'telephone',
                                                        'placeholder' => 'Postcode',
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
                                                    {!! Form::text('workphone', null, [
                                                        'id' => 'workphone',
                                                        'placeholder' => 'Telephone',
                                                        'class' => 'form-control',
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
                                                                    class="form-control has-feedback-left"
                                                                    value="สมหญิง ใจดี" required="required">
                                                            </div>
                                                        </td>

                                                        <td width="10%">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <input type="text" id="amount" name="amount[]"
                                                                    class="form-control has-feedback-left"
                                                                    value="แม่" required="required">
                                                            </div>
                                                        </td>
                                                        <td width="10%">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <input type="text" id="price" name="price[]"
                                                                    class="form-control has-feedback-left"
                                                                    value="089999999" required="required">
                                                            </div>
                                                        </td>
                                                        <td width="5%">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <input type="text" id="name" name="name[]"
                                                                    class="form-control has-feedback-left"
                                                                    value="สมชายใจดี" required="required">
                                                            </div>
                                                        </td>

                                                        <td width="10%">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <input type="text" id="amount" name="amount[]"
                                                                    class="form-control has-feedback-left"
                                                                    value="พี่" required="required">
                                                            </div>
                                                        </td>
                                                        <td width="10%">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <input type="text" id="price" name="price[]"
                                                                    class="form-control has-feedback-left"
                                                                    value="0999854" required="required">
                                                            </div>
                                                        </td>
                                                        <td width="5%">
                                                            <button type="button" id="removeRow2e"
                                                                class="btn btn-sm btn-danger deleteRowBtnf"><i
                                                                    class="fa fa-minus"></i></button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-12" align="right">

                                                <button type="button" id="addRowBtne"
                                                    class="btn btn-primary btnAddg"><i class="fa-solid fa-plus"></i> เพิ่มบุคคลที่ติดต่อได้ในกรณีฉุกเฉิน</button>
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
