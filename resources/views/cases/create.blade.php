<div class="modal fade" id="CreateModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">เพิ่ม เรื่องที่ติดต่อ</h4>
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
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>HN : 99999</strong>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>ชื่อ-สกุล : นายสมมุติ ไม่สบาย</strong>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>ประเภทเคส:</strong>
                            <select style="width: 100%;" class="select2 select2_casetype1 form-control" id="casetype1"
                                name="casetype1" multiple="multiple">
                                <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                    <option value="" selected>Select Parent</option>-->
                                @foreach ($casetype as $key2)
                                    <option value="{{ $key2->id }}">{{ $key2->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>รายละเอียดเคส:</strong>
                            <select style="width: 100%;" class="select2 select2_casetype2 form-control" id="casetype2"
                                name="casetype2" multiple="multiple">
                                <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                    <option value="" selected>Select Parent</option>-->

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>รายละเอียดเคสย่อย:</strong>
                            <select style="width: 100%;" class="select2 select2_casetype3 form-control" id="casetype3"
                                name="casetype3" multiple="multiple">
                                <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                    <option value="" selected>Select Parent</option>-->

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>รายละเอียดเคส เพิ่มเติม 1:</strong>
                            <select style="width: 100%;" class="select2 select2_casetype4 form-control" id="casetype4"
                                name="casetype4" multiple="multiple">
                                <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                    <option value="" selected>Select Parent</option>-->

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>รายละเอียดเคส เพิ่มเติม 2:</strong>
                            <select style="width: 100%;" class="select2 select2_casetype5 form-control" id="casetype5"
                                name="casetype5" multiple="multiple">
                                <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                    <option value="" selected>Select Parent</option>-->

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>รายละเอียดเคส เพิ่มเติม 3:</strong>
                            <select style="width: 100%;" class="select2 select2_casetype6 form-control" id="casetype6"
                                name="casetype6" multiple="multiple">
                                <!-- <option value="" selected>Select Student</option>
                                                                                                                                                                                                                                                                                                                                                                                    <option value="" selected>Select Parent</option>-->

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>รายละเอียด:</strong>
                            {!! Form::textarea('detail', null, [
                                'rows' => 4,
                                'id' => 'AddDetail',
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>สถานะการโอนสาย :</strong>
                            <select style="width: 100%;" class="select2 select2_tranfer form-control"
                                id="tranferstatus" name="tranferstatus" multiple="multiple">
                                <option value="1">รับสาย</option>
                                <option value="2">ไม่รับสาย</option>
                                <option value="3">สายไม่ว่าง</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>สถานะการเคส :</strong>
                            <select style="width: 100%;" class="select2 select2_casestatus form-control"
                                id="casestatus" name="casestatus" multiple="multiple">
                                <option value="1">ปิดเคส</option>
                                <option value="2">กำลังดำเนินการ</option>
                            </select>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer {{-- justify-content-between --}}">
                <button type="button" class="btn btn-success" id="SubmitCreateForm">บันทึก</button>
                <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>
