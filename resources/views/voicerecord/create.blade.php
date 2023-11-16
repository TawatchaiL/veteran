<div class="modal fade" id="CreateModal">
    <div class="modal-dialog modal-xxxl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="fa-solid fa-volume-high"></i> <span id="vioc_name">
                        09999999-1002-2023-08-01-110000.wav </span> </h4>
                <div class="closew"> <i class="fa-solid fa-clock"></i> ความยาว <span id="duration">00:00:00</span> นาที
                </div>


                {{-- <button type="button" class="close modelClose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>
            <div class="modal-body">
                {{-- @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong>Something went wrong.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">

                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>

                {{-- <label>
                    Zoom: <input type="range" min="10" max="1000" value="100" />
                </label> --}}
                <div class="row ">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="row float-lg-left">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button class="btn btn-warning btn-lg" id="backward"> <i
                                        class="fa-solid fa-backward"></i></button>
                                <button class="btn btn-warning btn-lg" id="play"><i class="fa-solid fa-play"></i> /
                                    <i class="fa-solid fa-pause"></i></button>
                                <button class="btn btn-warning btn-lg" id="stop"><i
                                        class="fa-solid fa-stop"></i></button>
                                <button class="btn btn-warning btn-lg" id="forward"><i
                                        class="fa-solid fa-forward"></i></button>

                                <button id="toggleMuteBtn" class="btn btn-primary">Toggle Mute</button>
                                <button id="setMuteOnBtn" class="btn btn-primary">
                                    Mute <i class="glyphicon glyphicon-volume-off"></i>
                                </button>

                                <button id="setMuteOffBtn" class="btn btn-primary">
                                    Unmute <i class="glyphicon glyphicon-volume-up"></i>
                                </button>

                            </div>
                        </div>
                        <div class="row float-lg-right">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <label>
                                    <input type="checkbox" id="loop" checked="${loop}" />
                                    วนซ้ำในกรอบ
                                </label>
                                {{--  <label>
                    <input type="checkbox" id="pitch" checked />
                    Preserve pitch
                </label> --}}
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <label for="speed" class="d-block">
                                    ความเร็ว: <span id="rate">1.00</span>x
                                </label><input type="range" id="speed" min="0" max="4"
                                    step="1" value="2" />

                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <label for="volume" class="d-block">
                                    ระดับเสียง: <span id="vol">4.00</span>
                                </label><input id="volume" type="range" min="0" max="1"
                                    value="1" step="0.1" />

                            </div>

                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div id="waveform">
                            <!-- the waveform will be rendered here -->
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-success btn-lg mx-auto" id="waveform-time-indicator">
                                <i class="fa-solid fa-clock"></i> <span class="time">00:00:00</span>
                            </button>
                        </div>
                    </div>
                </div>

                <form action="#">
                    @csrf
                    <input type="hidden" id="call_recording_id" value="">
                    <input type="hidden" id="uniqueid" value="">

                    <div class="row" id="custom-dialog" style="display: none;">
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="content-input">ระบุ Comment:</label>
                                <input type="text" id="content-input" class="form-control">
                            </div>

                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <button type="button" class="btn btn-success" id="add-content-button"><i
                                        class="fas fa-download"></i> บันทึก</button>
                                <button type="button" class="btn btn-danger" id="canclecomment"><i
                                        class="fas fa-door-closed"></i> ยกเลิก</button>
                            </div>
                        </div>
                    </div>
                </form>



                {!! Form::open(['method' => 'POST', 'class' => 'form']) !!}
                {{-- <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <i class="fa-solid fa-file-audio"></i>
                                09999999-1002-2023-08-01-110000.wav
                                <audio controls>
                                    <source src="" type="audio/ogg">
                                    <source src="" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong><i class="fas fa-list-ol"></i> Comment:</strong>
                            {!! Form::textarea('address', null, [
                                'rows' => 4,
                                'id' => 'AddAddress',
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                    </div>
                </div> --}}
                {!! Form::close() !!}
            </div>
            <div class="modal-footer {{-- justify-content-between --}}">
                <button type="button" class="btn btn-success" id="SubmitDownloadForm"><i class="fas fa-download"></i>
                    Download</button>
                <button type="button" class="btn btn-danger modelClose" data-dismiss="modal"><i
                        class="fas fa-door-closed"></i> ปิดหน้าต่าง</button>
            </div>
        </div>
    </div>
</div>
