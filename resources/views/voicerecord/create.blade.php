<div class="modal fade" id="CreateModal">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="fa-solid fa-volume-high"></i> Play & Comment</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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

                <div id="custom-dialog" style="display: none;">
                    <label for="content-input">Enter Content:</label>
                    <input type="text" id="content-input">
                    <button id="add-content-button">Add Content</button>
                </div>

                <label>
                    Zoom: <input type="range" min="10" max="1000" value="100" />
                </label>
                <button id="play">Play/Pause</button>
                <button id="backward">Backward 5s</button>
                <button id="forward">Forward 5s</button>
                <label>
                    Playback rate: <span id="rate">2.00</span>x
                </label>

                <label>
                    0.25x <input type="range" id="speed" min="0" max="4" step="1"
                        value="2" />
                    4x
                </label>

                <label>
                    <input type="checkbox" id="pitch" checked />
                    Preserve pitch
                </label>
                <label>
                    <input type="checkbox" id="loop" checked="${loop}" />
                    Loop regions
                </label>
                <div id="waveform">
                    <!-- the waveform will be rendered here -->
                </div>

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
                <button type="button" class="btn btn-success" id="SubmitCreateForm"><i class="fas fa-download"></i>
                    บันทึกข้อมูล</button>
                <button type="button" class="btn btn-danger modelClose" data-dismiss="modal"><i
                        class="fas fa-door-closed"></i> ปิดหน้าต่าง</button>
            </div>
        </div>
    </div>
</div>
