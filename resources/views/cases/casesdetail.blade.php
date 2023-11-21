<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                    <strong><i class="fas fa-code"></i> HN : {{ $datact->hn }}                                       
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                    <strong><i class="fas fa-user-tie"></i> ชื่อ-สกุล : </strong>{{ $datact->tname }}{{ $datact->fname }} {{ $datact->lname }}                                 
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                    <strong><i class="fa-regular fa-message"></i> ประเภทเคส : </strong>{{ $cases->casetype1 }}  
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong><i class="fa-regular fa-message"></i> รายละเอียดเคส : </strong>{{ $cases->casetype2 }} 
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                    <strong><i class="fa-regular fa-message"></i> รายละเอียดเคสย่อย : </strong>{{ $cases->casetype3 }} 
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong><i class="fa-regular fa-message"></i> รายละเอียดเคส เพิ่มเติม 1 : </strong>{{ $cases->casetype4 }} 
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                    <strong><i class="fa-regular fa-message"></i> รายละเอียดเคส เพิ่มเติม 2 : </strong>{{ $cases->casetype5 }} 
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong><i class="fa-regular fa-message"></i> รายละเอียดเคส เพิ่มเติม 3 : </strong>{{ $cases->casetype6 }} 
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                    <strong><i class="fa-regular fa-comment-dots"></i>
                        รายละเอียด : </strong>{{ $cases->casedetail }} 
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
            <button type="button" data-contactid="{{ $cases->contact_id }}" data-tabid="{{$cardid}}" class="btn btn-success listcasesP-button"><i class="fas fa-download"></i>
                ย้อนกลับ</button>&nbsp;
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <aside class="sidebar">
                <div class="single contact-info">
                    <h3 class="side-title">Contact Information</h3>
                    <ul class="list-unstyled">
                        <li>
                            <div class="icon"><i class="fa fa-map-marker"></i></div>
                            <div class="info">
                                <p>1600 Amphitheatre Parkway <br>St Martin Church</p>
                            </div>
                        </li>

                        <li>
                            <div class="icon"><i class="fa fa-phone"></i></div>
                            <div class="info">
                                <p>098-765-4321<br>123-456-7890</p>
                            </div>
                        </li>

                        <li>
                            <div class="icon"><i class="fa fa-envelope"></i></div>
                            <div class="info">
                                <p>info@example.com<br>sales@yourdomain.com</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</div>
