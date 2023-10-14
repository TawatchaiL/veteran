<div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                        </div>

                        <div class="card-body">
                            <div class="row ">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="row float-lg-left">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>
                                                    วันที่บันทึกข้อมูล:</strong>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" id="reservation" style="width: 210px">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row float-lg-right">
                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <strong><i class="fa-solid fa-id-card"></i>
                                                    ประเภทการค้นหา:</strong>
                                                <select style="width: 100%;" class="select2 form-control" id="seachtype"
                                                    name="seachtype">
                                                    <option value="0" selected>ตัวเลือกการค้นหา</option>
                                                    <option value="5">รหัสผู้ติดต่อ</option>
                                                    <option value="6">ชื่อผู้ติดต่อ</option>
                                                    <option value="1">เบอร์โทรฉุกเฉิน</option>
                                                    <option value="2">เบอร์โทรศัพท์บ้าน</option>
                                                    <option value="3">เบอร์โทรศัพท์มือถือ</option>
                                                    <option value="4">เบอร์โทรศัพท์ที่ทำงาน</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <strong><i class="fa-regular fa-keyboard"></i>
                                                    คำที่ต้องการค้นหา:</strong>
                                                {!! Form::text('seachtext', null, [
                                                    'id' => 'seachtext',
                                                    'placeholder' => 'ข้อมูลที่ต้องการค้นหา',
                                                    'class' => 'form-control',
                                                ]) !!}
                                                <span id="validationMessages" style="color: red;"></span>
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2">
                                            <strong>&nbsp;</strong>
                                            <button type="button" class="form-control btn btn-success" id="btnsearch">
                                                <i class="fas fa-search"></i></button>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2" style="align-items: flex-end;">
                                            <strong>&nbsp;</strong>
                                            <button type="button" class="form-control btn btn-warning" id="btnreset">
                                                <i class="fa-solid fa-rotate-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <form method="post" action="{{ route('contacts.destroy_all') }}" name="delete_all"
                                        id="delete_all">
                                        @csrf
                                        @method('POST')
                                        <table id="Listview"
                                            class="display nowrap table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="5%"><input type="checkbox" id="check-all"
                                                            class="flat">
                                                    </th>
                                                    <th>รหัสผู้ติดต่อ</th>
                                                    <th>ชื่อผู้ติดต่อ</th>
                                                    <th>เบอร์โทรศัพท์บ้าน</th>
                                                    <th>เบอร์โทรศัพท์มือถือ</th>
                                                    <th>วันที่บันทึก</th>
                                                    <th width="120px"></th>
                                                    <th>More</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>



                </div>

            </div>
