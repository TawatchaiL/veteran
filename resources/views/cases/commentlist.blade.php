<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-address-book"></i> ประวัติการแสดงความคิดเห็นเรื่องที่ติดต่อ</h3>
        <div class="card-tools">
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <table id="Listview"
                class="display nowrap table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>การแสดงความคิดเห็น</th>
                        <th>Agent</th>
                        <th>วันที่ทำรายการ</th>
                        <th width="140px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($casecomment as $casecomments)
                    <tr>
                        <td>{{ $casecomments->comment }}</td>
                        <td>{{ $casecomments->agentname }}</td>
                        <td>{{ $casecomments->created_at }}</td>
                        <td width="140px">
                            <button type="button" data-comment_id="{{ $casecomments->id }}" class="form-control btn btn-success selectcomment-button">รายละเอียด
                            </button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>  
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row justify-content-end">
            <button type="button" class="btn btn-danger modelClose" data-dismiss="modal"><i
                    class="fas fa-door-closed"></i> ปิดหน้าต่าง</button>
        </div>
    </div>
</div>