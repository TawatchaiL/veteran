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
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="timeline">

                    <div class="time-label">
                        <span class="bg-red">10 Feb. 2014</span>
                    </div>


                    <div>
                        <i class="fas fa-envelope bg-blue"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                            <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                            <div class="timeline-body">
                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                quora plaxo ideeli hulu weebly balihoo...
                            </div>
                            <div class="timeline-footer">
                                <a class="btn btn-primary btn-sm">Read more</a>
                                <a class="btn btn-danger btn-sm">Delete</a>
                            </div>
                        </div>
                    </div>


                    <div>
                        <i class="fas fa-user bg-green"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                            <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend
                                request</h3>
                        </div>
                    </div>


                    <div>
                        <i class="fas fa-comments bg-yellow"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                            <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                            <div class="timeline-body">
                                Take me to your leader!
                                Switzerland is small and neutral!
                                We are more like Germany, ambitious and misunderstood!
                            </div>
                            <div class="timeline-footer">
                                <a class="btn btn-warning btn-sm">View comment</a>
                            </div>
                        </div>
                    </div>


                    <div class="time-label">
                        <span class="bg-green">3 Jan. 2014</span>
                    </div>


                    <div>
                        <i class="fa fa-camera bg-purple"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> 2 days ago</span>
                            <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                            <div class="timeline-body">
                                <img src="https://placehold.it/150x100" alt="...">
                                <img src="https://placehold.it/150x100" alt="...">
                                <img src="https://placehold.it/150x100" alt="...">
                                <img src="https://placehold.it/150x100" alt="...">
                                <img src="https://placehold.it/150x100" alt="...">
                            </div>
                        </div>
                    </div>


                    <div>
                        <i class="fas fa-video bg-maroon"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> 5 days ago</span>
                            <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>
                            <div class="timeline-body">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item"
                                        src="https://www.youtube.com/embed/tMWkeBIohBs" allowfullscreen></iframe>
                                </div>
                            </div>
                            <div class="timeline-footer">
                                <a href="#" class="btn btn-sm bg-maroon">See comments</a>
                            </div>
                        </div>
                    </div>

                    <div>
                        <i class="fas fa-clock bg-gray"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>
