<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12" style="overflow: auto; height: 600px">

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
