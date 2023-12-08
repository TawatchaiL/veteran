<div class="row">
    <div class="card col-xs-12 col-sm-12 col-md-12">
        <div class="card-header">
            <h3 class="card-title"></h3>
        </div>

        <div class="card-body p-0" style="height: 300px;">
            <table id="Listview" class="table table-sm table-head-fixed text-nowrap table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>วันที่แก้ไข</th>
                        <th>ผู้แก้ไข</th>
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
                                    class="btn btn-sm btn-warning selectlog-button"> <i class="fas fa-rectangle-list"></i> รายละเอียด
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
