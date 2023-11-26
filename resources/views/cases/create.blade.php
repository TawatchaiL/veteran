<div class="modal fade" id="CreateModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="topiccase"><i class="fa-regular fa-clipboard"></i> เพิ่ม เรื่องที่ติดต่อ</h4>
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
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-comment-tab" data-toggle="pill"
                                    href="#custom-tabs-one-comment" role="tab"
                                    aria-controls="custom-tabs-one-comment"
                                    aria-selected="true">แสดงความคิดเห็นเรื่องที่ติดต่อ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tablistcommentlog" id="custom-tabs-one-commentlog-tab"
                                    data-toggle="pill" href="#custom-tabs-one-commentlog" role="tab"
                                    aria-controls="custom-tabs-one-commentlog"
                                    aria-selected="true">ประวัติการแสดงความคิดเห็นเรื่องที่ติดต่อ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tablisteditlog" id="custom-tabs-one-editlog-tab" data-toggle="pill"
                                    href="#custom-tabs-one-editlog" role="tab"
                                    aria-controls="custom-tabs-one-editlog"
                                    aria-selected="true">ประวัติการแก้ไขเรื่องที่ติดต่อ</a>
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
                                aria-labelledby="custom-tabs-one-home-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                {{--  <div class="form-group">
                                                    <strong><i class="fas fa-code"></i><input type="hidden" value="" name="Addid" id="Addid"> HN:</strong>
                                                    {!! Form::text('hn', null , [
                                                        'id' => 'Hn',
                                                        'placeholder' => 'HN',
                                                        'class' => 'form-control',
                                                        'readonly' => false,
                                                    ]) !!}
                                                    <ul id="suggestions"></ul>
                                                </div> --}}
                                                <div class="form-group">
                                                    <strong><i class="fas fa-user-tie"></i> ผู้ติดต่อ :</strong>
                                                    <input type="hidden" value="" name="Addid" id="Addid">
                                                    <select style="width: 100%;"
                                                        class="select2 select2_single form-control" id="Hn"
                                                        name="hn" multiple="multiple">
                                                        @foreach ($contacts as $contact)
                                                            <option value="{{ $contact->id }}">{{ $contact->hn }}
                                                                {{ $contact->fname }} {{ $contact->lname }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-calendar"></i> วันที่บันทึก:</strong>
                                                    {!! Form::text('adddate', null, [
                                                        'id' => 'Addadddate',
                                                        'placeholder' => 'วันที่บันทึก',
                                                        'class' => 'AddDate form-control',
                                                        'data-target' => '#reservationdate',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            {{-- <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fas fa-user-tie"></i> ชื่อ-สกุล :</strong>
                                                    {!! Form::text('name', null, [
                                                        'id' => 'Name',
                                                        'placeholder' => 'Name',
                                                        'class' => 'form-control',
                                                        'readonly' => true,
                                                    ]) !!}
                                                </div>
                                            </div> --}}
                                        </div>
                                        {{-- <div class="row">
                                            
                                        </div> --}}
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-regular fa-message"></i> ประเภทเคส:</strong>
                                                    <select style="width: 100%;" class="select2 form-control"
                                                        id="casetype1" name="casetype1">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-regular fa-comment-dots"></i>
                                                        รายละเอียดเคส:</strong>
                                                    <select style="width: 100%;" class="select2 form-control"
                                                        id="casetype2" name="casetype2">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-regular fa-comment-dots"></i>
                                                        รายละเอียดเคสย่อย:</strong>
                                                    <select style="width: 100%;" class="select2 form-control"
                                                        id="casetype3" name="casetype3">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-regular fa-comment-dots"></i> รายละเอียดเคส
                                                        เพิ่มเติม 1:</strong>
                                                    <select style="width: 100%;" class="select2 form-control"
                                                        id="casetype4" name="casetype4">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-regular fa-comment-dots"></i> รายละเอียดเคส
                                                        เพิ่มเติม 2:</strong>
                                                    <select style="width: 100%;" class="select2 form-control"
                                                        id="casetype5" name="casetype5">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong><i class="fa-regular fa-comment-dots"></i> รายละเอียดเคส
                                                        เพิ่มเติม 3:</strong>
                                                    <select style="width: 100%;" class="select2 form-control"
                                                        id="casetype6" name="casetype6">
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
                                                        'id' => 'Detail',
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
                                                    <select style="width: 100%;" class="select2 form-control"
                                                        id="tranferstatus" name="tranferstatus">
                                                        <option value="ไม่มีการโอนสาย">ไม่มีการโอนสาย</option>
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
                                                    <select style="width: 100%;" class="select2 form-control"
                                                        id="casestatus" name="casestatus">
                                                        <option value="ปิดเคส">ปิดเคส</option>
                                                        <option value="กำลังดำเนินการ">กำลังดำเนินการ</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row justify-content-end">
                                            <button type="button" class="btn btn-success" id="SubmitCreateForm"><i
                                                    class="fas fa-download"></i>
                                                บันทึกข้อมูล</button>&nbsp;
                                            <button type="button" class="btn btn-danger modelClose"
                                                data-dismiss="modal"><i class="fas fa-door-closed"></i>
                                                ปิดหน้าต่าง</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-comment" role="tabpanel"
                                aria-labelledby="custom-tabs-one-comment-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <strong><i class="fas fa-code"></i> HN : </strong>
                                                <div id="cHn"></div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <strong><i class="fas fa-user-tie"></i> ชื่อ-สกุล : </strong>
                                                <div id="cName"></div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <strong><i class="fa-regular fa-message"></i> ประเภทเคส : </strong>
                                                <div id="cCasetype1"></div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <strong><i class="fa-regular fa-message"></i> รายละเอียดเคส : </strong>
                                                <div id="cCasetype2"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <strong><i class="fa-regular fa-message"></i> รายละเอียดเคสย่อย :
                                                </strong>
                                                <div id="cCasetype3"></div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <strong><i class="fa-regular fa-message"></i> รายละเอียดเคส เพิ่มเติม 1
                                                    : </strong>
                                                <div id="cCasetype4"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <strong><i class="fa-regular fa-message"></i> รายละเอียดเคส เพิ่มเติม 2
                                                    : </strong>
                                                <div id="cCasetype5"></div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <strong><i class="fa-regular fa-message"></i> รายละเอียดเคส เพิ่มเติม 3
                                                    : </strong>
                                                <div id="cCasetype6"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <strong><i class="fa-regular fa-comment-dots"></i>
                                                    รายละเอียด : </strong>
                                                <div id="cDetail"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <strong><i class="fas fa-shuffle"></i> สถานะการโอนสาย : </strong>
                                                <div id="cTranferstatus"></div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <strong><i class="fas fa-arrows-rotate"></i> สถานะการเคส : </strong>
                                                <div id="cCasestatus"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <strong><i class="fas fa-shuffle"></i> แสดงความคิดเห็น : </strong>
                                                {!! Form::text('cComment', null, [
                                                    'id' => 'cComment',
                                                    'placeholder' => '',
                                                    'class' => 'form-control',
                                                    'readonly' => false,
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row justify-content-end">
                                            <button type="button" class="btn btn-success" id="SubmitCommentForm"><i
                                                    class="fas fa-download"></i>
                                                บันทึกข้อมูล</button>&nbsp;
                                            <button type="button" class="btn btn-danger modelClose"
                                                data-dismiss="modal"><i class="fas fa-door-closed"></i>
                                                ปิดหน้าต่าง</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-commentlog" role="tabpanel"
                                aria-labelledby="custom-tabs-one-commentlog-tab">
                                <div id="listlog">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-editlog" role="tabpanel"
                                aria-labelledby="custom-tabs-one-editlog-tab">
                                <div id="editlog">
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
        </div>
    </div>
</div>
