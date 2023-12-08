<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <table id="Listview" class="display nowrap table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>วันที่ทำรายการ</th>
                    <th>ผู้ทำรายการ</th>
                    <th width="60%">การแสดงความคิดเห็น</th>
                    <th width="140px"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($casecomment as $casecomments)
                    <tr>
                        <td>{{ $casecomments->created_at }}</td>
                        <td>{{ $casecomments->agentname }}</td>
                        <td>{{ $casecomments->comment }}</td>
                        <td width="140px">
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
