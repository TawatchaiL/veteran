<!-- Comment  Modal -->
<div class="fade modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="CommmentModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="fa-regular fa-clipboard"></i> แสดงความคิดเห็น เรื่องที่ติดต่อ</h4>
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
                        <div class="tab-content" id="custom-tabs-one-tabContente">
                            <div class="tab-pane fade show active" id="custom-tabs-one-homee" role="tabpanel"
                                aria-labelledby="custom-tabs-one-home-tabe">
                                <div class="row">
                                    <div class="col-md-6">
                                        <aside class="sidebarr">
                                            <div class="single contact-info">
                                                <h4 class="side-title">รายละเอียด เรื่องที่ติดต่อ</h4>
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <div class="icon"><i class="fas fa-code"></i></div>
                                                        <div class="info">
                                                            <p><strong>HN</strong> <br>&nbsp;<div id="cHn"></div></p>
                                                        </div>
                                                    </li>
                                
                                                    <li>
                                                        <div class="icon"><i class="fa-solid fa-list-ul"></i></div>
                                                        <div class="info">
                                                            <p><strong>ประเภทเคส</strong> <br>&nbsp;<div id="cCasetype1"></div></p>
                                                        </div>
                                                    </li>
                                
                                                    <li>
                                                        <div class="icon"><i class="fa-solid fa-list-ul"></i></div>
                                                        <div class="info">
                                                            <p><strong>รายละเอียดเคสย่อย</strong><br>&nbsp;<div id="cCasetype3"></div></p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="icon"><i class="fa-solid fa-list-ul"></i></div>
                                                        <div class="info">
                                                            <p><strong>รายละเอียดเคส เพิ่มเติม 2</strong><br>&nbsp;<div id="cCasetype5"></div></p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </aside>
                                    </div>
                                    <div class="col-md-6">
                                        <aside class="sidebarr">
                                            <div class="single contact-info">
                                                <h4 class="side-title">&nbsp;</h4>
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <div class="icon"><i class="fas fa-user-tie"></i></div>
                                                        <div class="info">
                                                            <p><strong>ชื่อ-สกุล</strong> <br>&nbsp;<div id="cName"></div></p>
                                                        </div>
                                                    </li>
                                
                                                    <li>
                                                        <div class="icon"><i class="fa-solid fa-list-ul"></i></div>
                                                        <div class="info">
                                                            <p><strong>รายละเอียดเคส</strong><br>&nbsp;<div id="cCasetype2"></div></p>
                                                        </div>
                                                    </li>
                                
                                                    <li>
                                                        <div class="icon">
                                                            <i class="fa-solid fa-list-ul"></i>
                                                        </div>
                                                        <div class="info">
                                                            <p><strong>รายละเอียดเคส เพิ่มเติม 1</strong><br>&nbsp;<div id="cCasetype4"></div></p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="icon"><i class="fa-solid fa-list-ul"></i></div>
                                                        <div class="info">
                                                            <p><strong>รายละเอียดเคส เพิ่มเติม 3</strong><br>&nbsp;<div id="cCasetype6"></div></p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </aside>
                                    </div>
                                    <div class="col-md-12">
                                        <aside class="sidebarr">
                                            <div class="single contact-info">
                                                <h4 class="side-title"></h4>
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <div class="icon"><i class="fa-regular fa-comment-dots"></i></div>
                                                        <div class="info">
                                                            <p><strong>รายละเอียด</strong> <br>&nbsp;<div id="cDetail"></div></p>
                                                        </div>
                                                    </li>
                                
                                
                                                </ul>
                                            </div>
                                        </aside>
                                    </div>
                                    <div class="col-md-6">
                                        <aside class="sidebarr">
                                            <div class="single contact-info">
                                                <h4 class="side-title">สถานะ เรื่องที่ติดต่อ</h4>
                                                <ul class="list-unstyled">
                                    
                                                    <li>
                                                        <div class="icon"><i class="fas fa-shuffle"></i></div>
                                                        <div class="info">
                                                            <p><strong>สถานะการโอนสาย</strong> <br>&nbsp;<div id="cTranferstatus"></div></p>
                                                        </div>
                                                    </li>
                                    
                                    
                                                </ul>
                                            </div>
                                        </aside>
                                    </div>
                                    <div class="col-md-6">
                                        <aside class="sidebarr">
                                            <div class="single contact-info">
                                                <h4 class="side-title">&nbsp;</h4>
                                                <ul class="list-unstyled">
                                    
                                                    <li>
                                                        <div class="icon"><i class="fas fa-arrows-rotate"></i></div>
                                                        <div class="info">
                                                            <p><strong>สถานะการเคส</strong> <br>&nbsp;<div id="cCasestatus"></div></p>
                                                        </div>
                                                    </li>
                                    
                                    
                                                </ul>
                                            </div>
                                        </aside>
                                    </div>
                                </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <strong><i class="fas fa-shuffle"></i> แสดงความคิดเห็น : </strong>
                                                    {!! Form::text('cComment', null , [
                                                        'id' => 'cComment',
                                                        'placeholder' => '',
                                                        'class' => 'form-control',
                                                        'readonly' => false,
                                                    ]) !!}
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
                <button type="button" class="btn btn-success" id="SubmitCommentForm"><i class="fas fa-download"></i>
                    บันทึกข้อมูล</button>
                <button type="button" class="btn btn-danger modelClose" data-dismiss="modal"><i
                        class="fas fa-door-closed"></i> ปิดหน้าต่าง</button>
            </div>
        </div>
    </div>
</div>
