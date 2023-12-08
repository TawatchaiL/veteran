{{-- <div class="row">
    <div class="card col-xs-12 col-sm-12 col-md-12">
        <div class="card-header">
            <h3 class="card-title"></h3>
        </div>

        <div class="card-body p-0">
            <table id="Listview" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th width="20%">วันที่ทำรายการ</th>
                        <th width="20%">ผู้ทำรายการ</th>
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
</div> --}}
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="timeline">

                    <div class="time-label">
                        <span></span>
                    </div>


                    @foreach ($casecomment as $casecomments)
                        <div>
                            <i class="fas fa-user bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> {{ $casecomments->created_at }}</span>
                                <h3 class="timeline-header"><a href="#">{{ $casecomments->agentname }}</a></h3>
                                <div class="timeline-body">
                                    {{ $casecomments->comment }}
                                </div>
                                <div class="timeline-footer text-right">
                                    <button type="button" data-comment_id="{{ $casecomments->id }}"
                                        class="btn btn-sm btn-warning selectcomment-button"><i
                                            class="fa-solid fa-comment-dots"></i> รายละเอียด
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach




                    <div>
                        <i class="fas fa-clock bg-gray"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>
