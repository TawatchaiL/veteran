<div class="modal fade" id="ToolbarModal">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">{{-- <i class="fas fa-wrench"></i> --}} <i class="fas fa-spin fa-gear"></i> Agent ToolBar [
                    {{ $temporaryPhone }} ]</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <input {{-- <?= $outbound_dis ?> --}} style="height:50px" type="number" class="form-control"
                                    maxlength="11" id="dial_number" name="dial_number" value=""
                                    placeholder="กรอกเบอร์" />
                            </div>
                            <div class="mx-1">
                                <button {{-- <?= $outbound_dis ?> --}}
                                    class="btn btn-lg custom-button btn-success button_dial"><i
                                        class="fa-solid fa-phone-volume"></i> รับสาย</button>
                            </div>
                            <div class="mx-1">
                                <button {{-- <?= $outbound_dis ?> --}}
                                    class="btn btn-lg custom-button btn-success button_dial"><i
                                        class="fas fa-phone-square"></i> โทรออก</button>
                            </div>
                            <div class="mx-1">
                                {{--  <button  <?= $outbound_dis ?>  class="btn btn-lg btn-warning button_tranfer"><i
                                        class="fas fa-random"></i> โอนสาย</button> --}}
                                <div class="btn-group">
                                    <button type="button"
                                        class="btn btn-lg btn-success custom-button dropdown-toggle dropdown-icon"
                                        data-toggle="dropdown">
                                        <i class="fas fa-random"></i> โอนสาย <span class="sr-only">Toggle
                                            Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item button_tranfer" href="#"><i
                                                class="fas fa-random"></i> Blind Tranfer</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item button_atx_tranfer" href="#"><i
                                                class="fas fa-random"></i> Attendant Tranfer</a>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-1">
                                <button {{-- <?= $outbound_dis ?> --}}
                                    class="btn btn-lg custom-button btn-success button_conf"><i class="fas fa-star"></i>
                                    ประเมิน</button>
                            </div>
                            <div class="mx-1">
                                <button {{-- <?= $outbound_dis ?> --}}
                                    class="btn btn-lg custom-button btn-success button_conf"><i
                                        class="fas fa-handshake"></i> ประชุมสาย</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="btn-group float-left {{-- <?= $break_class ?> --}}" id="break_group">
                    <button type="button" id="btn-pause"
                        class="btn btn-lg btn-warning custom-button  mx-1 dropdown-toggle dropdown-icon"
                        data-toggle="dropdown">
                        <i class="fas fa-pause"></i> พัก <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">

                        <a class="dropdown-item button_break" href="#" data-id="1"><i class="fas fa-pause"></i>
                            ทานข้าว</a>
                        <a class="dropdown-item button_break" href="#" data-id="2"><i class="fas fa-pause"></i>
                            เข้าห้องน้ำ</a>
                        <a class="dropdown-item button_break" href="#" data-id="3"><i class="fas fa-pause"></i>
                            ประชุม</a>
                        <div class="dropdown-divider"></div>


                    </div>
                </div>
                <button class="btn btn-lg btn-warning custom-button float-left mx-1 button_unbreak"><i
                        class="fas fa-clock"></i>
                    หยุดพัก </button>
                <button class="btn btn-lg btn-warning custom-button float-left mx-1 button_unbreak"><i
                        class="fas fa-clock"></i>
                    UnWarp </button>

                <button class="btn btn-lg btn-danger custom-button float-right" id="btn-system-logout">
                    <i class="fas fa-power-off"></i>
                    ออกจากระบบ
                </button>
                <button {{-- <?= $logoff_dis ?> --}} id="btn-agent-logout"
                    class="btn btn-lg btn-secondary custom-button float-right"><i class="fas fa-power-off"></i>
                    ไม่พร้อมรับสาย </button>
                <button {{-- <?= $logoff_dis ?> --}} id="btn-agent-login"
                    class="btn btn-lg btn-success custom-button mx-1 float-right"><i class="fas fa-plug"></i>
                    พร้อมรับสาย </button>


                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
