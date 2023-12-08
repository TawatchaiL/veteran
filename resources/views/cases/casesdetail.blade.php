<div class="row">
    <div class="col-md-6">
        <aside class="sidebarr">
            <div class="single contact-info">
                <h4 class="side-title">รายละเอียด เรื่องที่ติดต่อ</h4>
                <ul class="list-unstyled">
                    <li>
                        <div class="icon"><i class="fas fa-code"></i></div>
                        <div class="info">
                            <p><strong>HN</strong> <br>&nbsp;{{ $datact->hn !== '' ? $datact->hn : '-' }}</p>
                        </div>
                    </li>

                    <li>
                        <div class="icon"><i class="fa-solid fa-list-ul"></i></div>
                        <div class="info">
                            <p><strong>ประเภทเคส</strong>
                                <br>&nbsp;{{ $cases->casetype1 !== '' ? $cases->casetype1 : '-' }}</p>
                        </div>
                    </li>

                    <li>
                        <div class="icon"><i class="fa-solid fa-list-ul"></i></div>
                        <div class="info">
                            <p><strong>รายละเอียดเคสย่อย</strong><br>&nbsp;{{ $cases->casetype3 !== '' ? $cases->casetype3 : '-' }}
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="icon"><i class="fa-solid fa-list-ul"></i></div>
                        <div class="info">
                            <p><strong>รายละเอียดเคส เพิ่มเติม
                                    2</strong><br>&nbsp;{{ $cases->casetype5 !== '' ? $cases->casetype5 : '-' }}</p>
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
                            <p><strong>ชื่อ-สกุล</strong> <br>&nbsp;{{ $datact->tname }}{{ $datact->fname }}
                                {{ $datact->lname }}</p>
                        </div>
                    </li>

                    <li>
                        <div class="icon"><i class="fa-solid fa-list-ul"></i></div>
                        <div class="info">
                            <p><strong>รายละเอียดเคส</strong><br>&nbsp;{{ $cases->casetype2 !== '' ? $cases->casetype2 : '-' }}
                            </p>
                        </div>
                    </li>

                    <li>
                        <div class="icon">
                            <i class="fa-solid fa-list-ul"></i>
                        </div>
                        <div class="info">
                            <p><strong>รายละเอียดเคส เพิ่มเติม
                                    1</strong><br>&nbsp;{{ $cases->casetype4 !== '' ? $cases->casetype4 : '-' }}</p>
                        </div>
                    </li>
                    <li>
                        <div class="icon"><i class="fa-solid fa-list-ul"></i></div>
                        <div class="info">
                            <p><strong>รายละเอียดเคส เพิ่มเติม
                                    3</strong><br>&nbsp;{{ $cases->casetype6 !== '' ? $cases->casetype6 : '-' }}</p>
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
                            <p><strong>รายละเอียด</strong>
                                <br>&nbsp;{{ $cases->casedetail !== '' ? $cases->casedetail : '-' }}</p>
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
                            <p><strong>สถานะการโอนสาย</strong> <br>&nbsp;{{ $cases->tranferstatus }}</p>
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
                            <p><strong>สถานะเคส</strong> <br>&nbsp;{{ $cases->casestatus }}</p>
                        </div>
                    </li>


                </ul>
            </div>
        </aside>
    </div>
</div>


<div class="row justify-content-end">
    <button type="button" data-contactid="{{ $cases->contact_id }}" data-tabid="{{ $cardid }}"
        class="btn btn-warning listcasesP-button"><i class="fa-solid fa-backward"></i>
        ย้อนกลับ</button>&nbsp;
</div>
