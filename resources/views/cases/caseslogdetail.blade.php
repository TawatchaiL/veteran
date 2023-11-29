<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <strong><i class="fas fa-code"></i> HN : {{ $datact->hn }} 
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="icon"><i class="fas fa-code"></i></div>
                <div class="info">
                <strong> ชื่อ-สกุล : </strong>{{ $datact->tname }}{{ $datact->fname }} {{ $datact->lname }}
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <strong><i class="fa-regular fa-message"></i> ประเภทเคส : </strong>{{ $cases->casetype1 }} >> {{ $cases->casetype1 }}
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <strong><i class="fa-regular fa-message"></i> รายละเอียดเคส : </strong>{{ $cases->casetype2 }} >> 
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <strong><i class="fa-regular fa-message"></i> รายละเอียดเคสย่อย : </strong>{{ $cases->casetype3 }} >>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <strong><i class="fa-regular fa-message"></i> รายละเอียดเคส เพิ่มเติม 1 :
                </strong>{{ $cases->casetype4 }} >>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <strong><i class="fa-regular fa-message"></i> รายละเอียดเคส เพิ่มเติม 2 :
                </strong>{{ $cases->casetype5 }} >>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <strong><i class="fa-regular fa-message"></i> รายละเอียดเคส เพิ่มเติม 3 :
                </strong>{{ $cases->casetype6 }} >>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong><i class="fa-regular fa-comment-dots"></i>
                    รายละเอียด : </strong>{{ $cases->casedetail }} >>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <strong><i class="fas fa-shuffle"></i> สถานะการโอนสาย : </strong>{{ $cases->tranferstatus }} >>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <strong><i class="fas fa-arrows-rotate"></i> สถานะการเคส : </strong>{{ $cases->casestatus }} >>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row justify-content-end">
            <button type="button" data-case_id="{{ $cases->id }}" class="btn btn-success listeditlog-button"
                id="ListcommentButton"><i class="fas fa-download"></i>
                ย้อนกลับ</button>&nbsp;
            <button type="button" class="btn btn-danger modelClose" data-dismiss="modal"><i
                    class="fas fa-door-closed"></i> ปิดหน้าต่าง</button>
        </div>
    </div>
</div>

