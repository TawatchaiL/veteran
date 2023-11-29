<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <strong><i class="fas fa-code"></i> HN : </strong>{{ $datact->hn }} 
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <strong><i class="fas fa-user-tie"></i> ชื่อ-สกุล : </strong>{{ $datact->tname.$datact->fname." ".$datact->lname  }}
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <strong><i class="fa-regular fa-message"></i> ประเภทเคส : </strong>{{ $cases->casetype1 }}{{ $cases->casetype1 !== $caselog->casetype1 ? ' >> '.$caselog->casetype1 : ''  }}
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <strong><i class="fa-regular fa-message"></i> รายละเอียดเคส : </strong>{{ $cases->casetype2 }}{{ $cases->casetype2 !== $caselog->casetype2 ? ' >> '.$caselog->casetype2 : ''  }}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <strong><i class="fa-regular fa-message"></i> รายละเอียดเคสย่อย : </strong>{{ $cases->casetype3 }}{{ $cases->casetype3 !== $caselog->casetype3 ? ' >> '.$caselog->casetype3 : ''  }}
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <strong><i class="fa-regular fa-message"></i> รายละเอียดเคส เพิ่มเติม 1 :
                </strong>{{ $cases->casetype4 }}{{ $cases->casetype4 !== $caselog->casetype4 ? ' >> '.$caselog->casetype4 : ''  }}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <strong><i class="fa-regular fa-message"></i> รายละเอียดเคส เพิ่มเติม 2 :
                </strong>{{ $cases->casetype5 }}{{ $cases->casetype5 !== $caselog->casetype5 ? ' >> '.$caselog->casetype5 : ''  }}
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <strong><i class="fa-regular fa-message"></i> รายละเอียดเคส เพิ่มเติม 3 :
                </strong>{{ $cases->casetype6 }}{{ $cases->casetype6 !== $caselog->casetype6 ? ' >> '.$caselog->casetype6 : ''  }}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong><i class="fa-regular fa-comment-dots"></i>
                    รายละเอียด : </strong>{{ $cases->casedetail }}{{ $cases->casedetail !== $caselog->casedetail ? ' >> '.$caselog->casedetail : ''  }}
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <strong><i class="fas fa-shuffle"></i> สถานะการโอนสาย : </strong>{{ $cases->tranferstatus }}{{ $cases->tranferstatus !== $caselog->tranferstatus ? ' >> '.$caselog->tranferstatus : ''  }}
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <strong><i class="fas fa-arrows-rotate"></i> สถานะการเคส : </strong>{{ $cases->casestatus }}{{ $cases->casestatus !== $caselog->casestatus ? ' >> '.$caselog->casestatus : ''  }}
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

