<div class="modal fade" id="CreateModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="fa-regular fa-clipboard"></i> เพิ่ม เรื่องที่ติดต่อ</h4>
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
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                    href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                                    aria-selected="true">ข้อมูลเรื่องที่ติดต่อ</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-profile-tabp" data-toggle="pill"
                                    href="#custom-tabs-one-profilep" role="tab" aria-controls="custom-tabs-one-profilep"
                                    aria-selected="false">ข้อมูลเบอร์ติดต่อ</a>
                            </li> --}}

                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                                aria-labelledby="custom-tabs-one-home-tabp">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-code"></i><input type="hidden" value="{{$contacts[0]->id}}" name="Addid" id="Addid"> HN:</strong>
                                                    {!! Form::text('hn', $contacts[0]->hn , [
                                                        'id' => 'Addhn',
                                                        'placeholder' => 'HN',
                                                        'class' => 'form-control',
                                                        'readonly' => true,
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-user-tie"></i> ชื่อ-สกุล :</strong>
                                                    {!! Form::text('name', $contacts[0]->fname.' '.$contacts[0]->lname, [
                                                        'id' => 'AddName',
                                                        'placeholder' => 'Name',
                                                        'class' => 'form-control',
                                                        'readonly' => true,
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-regular fa-message"></i> ประเภทเคส:</strong>
                                                    <select style="width: 100%;"
                                                        class="select2 form-control" id="Addcasetype1"
                                                        name="casetype1">
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
                                                    {!! Form::textarea('casedetail', null, [
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
                                                    <select style="width: 100%;"
                                                        class="select2 form-control"
                                                        id="Addtranferstatus" name="tranferstatus">
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
                                                    <select style="width: 100%;"
                                                        class="select2 form-control"
                                                        id="Addcasestatus" name="casestatus">
                                                        <option value="1">ปิดเคส</option>
                                                        <option value="2">กำลังดำเนินการ</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>


                            {{--   <div class="tab-pane fade" id="custom-tabs-one-profilep" role="tabpanel"
                                aria-labelledby="custom-tabs-one-profile-tabp">
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                </div>
                            </div> --}}
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
