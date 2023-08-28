<div class="modal fade" id="CreateModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="fas fa-address-book"></i> เพิ่ม รายชื่อผู้ติดต่อ</h4>
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
                                    aria-selected="true">ข้อมูลผู้ติดต่อ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-profile-tabp" data-toggle="pill"
                                    href="#custom-tabs-one-profilep" role="tab"
                                    aria-controls="custom-tabs-one-profilep" aria-selected="false">ข้อมูลเบอร์ติดต่อ</a>
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
                                                    <strong><i class="fas fa-code"></i> รหัสผู้ติดต่อ.</strong>
                                                    {!! Form::text('code', null, [
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
                                                    {!! Form::text('start_date', null, [
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
                                                    {!! Form::text('name', null, ['id' => 'AddName', 'placeholder' => 'Name', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-user-tie"></i> นามสกุล:</strong>
                                                    {!! Form::text('name', null, ['id' => 'AddName', 'placeholder' => 'LastName', 'class' => 'form-control']) !!}
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
                                                    {!! Form::text('postcode', null, [
                                                        'id' => 'AddPostcode',
                                                        'placeholder' => 'Address',
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-solid fa-people-roof"></i> หมู่:</strong>
                                                    {!! Form::text('homephone', null, [
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
                                                    {!! Form::text('postcode', null, [
                                                        'id' => 'AddPostcode',
                                                        'placeholder' => 'Soi',
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-road"></i> ถนน :</strong>
                                                    {!! Form::text('homephone', null, [
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
                                                    <select style="width: 100%;"
                                                        class="select2 select2_city form-control" id="city"
                                                        name="city" multiple="multiple">
                                                        <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                        <option value="" selected>Select Parent</option>-->

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-solid fa-building-circle-arrow-right"></i>
                                                        อำเภอ:</strong>
                                                    <select style="width: 100%;"
                                                        class="select2 select2_am form-control" id="am"
                                                        name="am" multiple="multiple">
                                                        <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                        <option value="" selected>Select Parent</option>-->

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
                                                    <select style="width: 100%;"
                                                        class="select2 select2_tm form-control" id="tm"
                                                        name="tm" multiple="multiple">
                                                        <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                        <option value="" selected>Select Parent</option>-->

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-code"></i> รหัสไปรษณีย์:</strong>
                                                    {!! Form::text('postcode', null, [
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


                            <div class="tab-pane fade" id="custom-tabs-one-profilep" role="tabpanel"
                                aria-labelledby="custom-tabs-one-profile-tabp">
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
                                                <table id="myTbl3"
                                                    class="table table-striped table-bordered responsive-utilities jambo_table " width="400">
                                                    <thead>
                                                        <tr class="headings">
                                                            {{-- <th class="column-title"> สินค้า</th> --}}
                                                            <th class="column-title"> ล็อตสินค้าในคลังสินค้า</th>
                                                            <th class="column-title"> จำนวนที่ขาย</th>
                                                            <th class="column-title"> ราคาต่อหน่วย</th>
                                                            <th class="column-title"> รายรับที่ได้</th>
                                                            <th class="column-title"> </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="firstTr3">
                                                            {{--  <td width="30%">
                                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                                            <input type="text" id="flown[]" name="flown[]"
                                                                                class="form-control has-feedback-left" value=""
                                                                                required="required">
                                                                        </div>
                                                                    </td> --}}
                                                            <td width="30%">
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <select style="width: 100%;" class="products form-control" id="stock"
                                                                        name="stock[]" required>
                                                                        <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                                            <option value="" selected>Select Parent</option>-->
                                                                        {{-- @foreach ($product as $key2)
                                                            <option value="{{ $key2->id }}">{{ $key2->name }}
                                                            </option>
                                                        @endforeach --}}
                    
                                                                    </select>
                                                                    <div id="lot_price" class="text-success"></div>
                                                                    <div id="lot_error" class="text-danger"></div>
                                                                </div>
                                                            </td>
                    
                                                            <td width="10%">
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <input type="number" step="0.50" id="amount" name="amount[]"
                                                                        class="form-control has-feedback-left" value=""
                                                                        required="required">
                                                                </div>
                                                            </td>
                                                            <td width="10%">
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <input type="number" step="0.50" id="price" name="price[]"
                                                                        class="form-control has-feedback-left" value=""
                                                                        required="required">
                                                                </div>
                                                            </td>
                    
                                                            <td width="10%">
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <input type="number" step="0.50" id="total" name="total[]"
                                                                        class="form-control has-feedback-left" value="" readonly>
                                                                </div>
                                                            </td>
                    
                                                            <td width="10%"><button type="button" id="removeRowt"
                                                                    class="btn btn-sm btn-danger btnRemoveg2"><i
                                                                        class="fa fa-minus"></i></button></td>
                    
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-12" align="right">
                    
                                                <button type="button" id="addRow2" class="btn btn-sm btn-primary btnAddg"><i
                                                        class="fa fa-plus"></i></button>
                                                <button type="button" id="removeRow2" class="btn btn-sm btn-danger btnRemoveg"><i
                                                        class="fa fa-minus"></i></button>
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
