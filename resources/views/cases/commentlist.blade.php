<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12" style="min-height: 200px; overflow: auto; max-height: 600px">

                <div class="timeline">

                    <div class="time-label">
                        <span></span>
                    </div>


                    @if (count($casecomment) > 0)
                        @foreach ($casecomment as $casecomments)
                            <div>
                                <i class="fas fa-user bg-red"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i>
                                        {{ $casecomments->created_at }}</span>
                                    <h3 class="timeline-header"><a href="#">{{ $casecomments->agentname }}</a>
                                    </h3>
                                    <div class="timeline-body">
                                        {{ $casecomments->comment }}
                                    </div>
                                    <div class="timeline-footer text-right">
                                        <button type="button" data-comment_id="{{ $casecomments->id }}"
                                            class="btn btn-sm btn-primary selectcomment-button">
                                            <i class="fa-solid fa-comment-dots"></i> รายละเอียด
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div>
                            <i class="fas fa-user bg-green"></i>
                            <div class="timeline-item">
                                <span class="time"></span>
                                <h3 class="timeline-header no-border"> ยังไม่มีรายการแสดงความคิดเห็น</h3>
                            </div>
                        </div>
                    @endif



                    <div>
                        <i class="fas fa-comment-dots bg-gray"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>
