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
                <table id="Listview" class="display nowrap table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Agent</th>
                            <th>วันที่ทำรายการ</th>
                            <th width="140px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($caselog as $caselogs)
                            <tr>
                                <td>{{ $caselogs->modifyaction }}</td>
                                <td>{{ $caselogs->agentname }}</td>
                                <td>{{ $caselogs->modifydate }}</td>
                                <td width="140px">
                                    <button type="button" data-log_id="{{ $caselogs->lid }}"
                                        class="form-control btn btn-success selectlog-button">รายละเอียด
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="card col-xs-12 col-sm-12 col-md-12">
        <div class="card-header">
            <h3 class="card-title"></h3>
        </div>

        <div class="card-body p-0">
            <table id="Listview" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th width="30%">วันที่แก้ไข</th>
                        <th width="30%">ผู้ทำรายการ</th>
                        <th width="150px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($caselog as $caselogs)
                        <tr>
                            <td>{{ $caselogs->modifydate }}</td>
                            <td>{{ $caselogs->agentname }}</td>
                           {{--  <td>{{ $caselogs->modifyaction }}</td> --}}
                            <td width="150px">
                                <button type="button" data-log_id="{{ $caselogs->lid }}"
                                    class="btn btn-sm btn-warning selectlog-button"> <i class="fa-regular fa-rectangle-list"></i> รายละเอียด
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
