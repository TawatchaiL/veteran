<div class="row">
    <div class="card col-xs-12 col-sm-12 col-md-12">
        <div class="card-header">
            <h3 class="card-title">รายการความคิดเห็น</h3>
        </div>

        <div class="card-body p-0">
            <table id="Listview" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="25%">วันที่ทำรายการ</th>
                        <th width="25%">ผู้ทำรายการ</th>
                        <th width="40%">ความคิดเห็น</th>
                        <th width="160px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($casecomment as $casecomments)
                        <tr>
                            <td>{{ $casecomments->created_at }}</td>
                            <td>{{ $casecomments->agentname }}</td>
                            <td>{{ $casecomments->comment }}</td>
                            <td width="160px">
                                <button type="button" data-comment_id="{{ $casecomments->id }}"
                                    class="btn btn-warning selectcomment-button"><i
                                        class="fa-solid fa-comment-dots"></i> รายละเอียด
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
