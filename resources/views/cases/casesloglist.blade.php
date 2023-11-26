<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-address-book"></i> ประวัติการแก้ไขเรื่องที่ติดต่อ</h3>
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
                        <th>Action</th>
                        <th>Agent</th>
                        <th>วันที่ทำรายการ</th>
                        <th width="140px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($caselog as $caselogs)
                    <tr>
                        <td>{{ $caselogs->modifyaction }}</td>
                        <td>{{ $caselogs->agentname }}</td>
                        <td>{{ $caselogs->modifydate }}</td>
                        <td width="140px">
                            <button type="button" data-log_id="{{ $caselogs->lid }}" class="form-control btn btn-success selectlog-button">รายละเอียด
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