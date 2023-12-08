<div class="row">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">รายการความคิดเห็น</h3>
        </div>

        <div class="card-body p-0">
            <table id="Listview" class="display nowrap table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>วันที่ทำรายการ</th>
                        <th>ผู้ทำรายการ</th>
                        <th width="60%">การแสดงความคิดเห็น</th>
                        <th width="1ุ0px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($casecomment as $casecomments)
                        <tr>
                            <td>{{ $casecomments->created_at }}</td>
                            <td>{{ $casecomments->agentname }}</td>
                            <td>{{ $casecomments->comment }}</td>
                            <td width="1ุ0px">
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
