<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <aside class="sidebarr">
                    <div class="single contact-info">
                        <h4 class="side-title">รายละเอียด เรื่องที่ติดต่อ</h4>
                        <ul class="list-unstyled">
                            <li>
                                <div class="icon"><i class="fa fa-map-marker"></i></div>
                                <div class="info">
                                    <p><strong>HN</strong> <br>&nbsp;{{ $datact->hn }}</p>
                                </div>
                            </li>

                            <li>
                                <div class="icon"><i class="fa fa-phone"></i></div>
                                <div class="info">
                                    <p><strong>ประเภทเคส</strong> <br>&nbsp;{{ $cases->casetype1 }}</p>
                                </div>
                            </li>

                            <li>
                                <div class="icon"><i class="fa fa-envelope"></i></div>
                                <div class="info">
                                    <p><strong>รายละเอียดเคสย่อย</strong><br>&nbsp;{{ $cases->casetype3 }}</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon"><i class="fa fa-envelope"></i></div>
                                <div class="info">
                                    <p><strong>รายละเอียดเคส เพิ่มเติม 2</strong><br>&nbsp;{{ $cases->casetype5 }}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </aside>
            </div>
            <div class="col-md-6">
                <aside class="sidebarr">
                    <div class="single contact-info">
                        <h4 class="side-title"></h4>
                        <ul class="list-unstyled">
                            <li>
                                <div class="icon"><i class="fa fa-map-marker"></i></div>
                                <div class="info">
                                    <p><strong>ชื่อ-สกุล</strong> <br>&nbsp;{{ $datact->tname }}{{ $datact->fname }}
                                        {{ $datact->lname }}</p>
                                </div>
                            </li>

                            <li>
                                <div class="icon"><i class="fa fa-phone"></i></div>
                                <div class="info">
                                    <p><strong>รายละเอียดเคส</strong><br>&nbsp;{{ $cases->casetype2 }}</p>
                                </div>
                            </li>

                            <li>
                                <div class="icon"><i class="fa fa-envelope"></i></div>
                                <div class="info">
                                    <p><strong>รายละเอียดเคส เพิ่มเติม 1</strong><br>&nbsp;{{ $cases->casetype4 }}</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon"><i class="fa fa-envelope"></i></div>
                                <div class="info">
                                    <p><strong>รายละเอียดเคส เพิ่มเติม 3</strong><br>&nbsp;{{ $cases->casetype6 }}</p>
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
                                <div class="icon"><i class="fa fa-map-marker"></i></div>
                                <div class="info">
                                    <p><strong>รายละเอียด</strong> <br>&nbsp;{{ $cases->casedetail }}</p>
                                </div>
                            </li>

                            
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong><i class="fas fa-code"></i> HN :
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong><i class="fas fa-user-tie"></i> : </strong>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong><i class="fa-regular fa-message"></i> : </strong>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong><i class="fa-regular fa-message"></i>  : </strong>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong><i class="fa-regular fa-message"></i>  : </strong>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong><i class="fa-regular fa-message"></i>  :
                </strong>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong><i class="fa-regular fa-message"></i> รายละเอียดเคส เพิ่มเติม 2 :
                </strong>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong><i class="fa-regular fa-message"></i>  :
                </strong>{{ $cases->casetype6 }}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong><i class="fa-regular fa-comment-dots"></i>
                    รายละเอียด : </strong>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong><i class="fas fa-shuffle"></i> สถานะการโอนสาย : </strong>{{ $cases->tranferstatus }}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong><i class="fas fa-arrows-rotate"></i> สถานะการเคส : </strong>{{ $cases->casestatus }}
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row justify-content-end">
            <button type="button" data-contactid="{{ $cases->contact_id }}" data-tabid="{{ $cardid }}"
                class="btn btn-success listcasesP-button"><i class="fas fa-download"></i>
                ย้อนกลับ</button>&nbsp;
        </div>
    </div>
</div>
