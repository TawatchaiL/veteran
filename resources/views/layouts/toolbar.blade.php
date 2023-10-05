@php
    switch ($temporaryPhoneStatusID) {
        case 0:
            $dial_number = '';
            $dial_button = '';
            $transfer_button = '';
            $performance_button = 'disabled';
            $conf_button = '';
            $break_button = 'disabled';
            $break_button_class = '';
            $unbreak_button = 'disabled';
            $unbreak_button_class = 'd-none';
            $logout_button = '';
            $logout_button_class = '';
            $logoff_button = 'disabled';
            $logoff_button_class = 'd-none';
            $login_button = '';
            $login_button_class = '';
            break;
        case 1:
            $dial_number = '';
            $dial_button = '';
            $transfer_button = '';
            $performance_button = '';
            $conf_button = '';
            $break_button = '';
            $break_button_class = '';
            $unbreak_button = 'disabled';
            $unbreak_button_class = 'd-none';
            $logout_button = 'disabled';
            $logout_button_class = '';
            $logoff_button = '';
            $logoff_button_class = '';
            $login_button = '';
            $login_button_class = 'd-none';
            break;
        case 2:
            $dial_number = '';
            $dial_button = '';
            $transfer_button = '';
            $performance_button = 'disabled';
            $conf_button = '';
            $break_button = '';
            $break_button_class = 'd-none';
            $unbreak_button = '';
            $unbreak_button_class = '';
            $logout_button = 'disabled';
            $logout_button_class = '';
            $logoff_button = '';
            $logoff_button_class = 'd-none';
            $login_button = '';
            $login_button_class = 'd-none';
            break;
        case 3:
            break;
        default:
            break;
    }
@endphp
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
                                <input {{ $dial_number }} style="height:70px" type="number" class="form-control"
                                    maxlength="11" id="dial_number" name="dial_number" value=""
                                    placeholder="กรอกเบอร์" />
                            </div>
                            {{-- <div class="mx-1">
                                <button
                                    class="btn custom-button btn-success button_dial"><i
                                        class="fa-solid fa-phone-volume"></i> รับสาย</button>
                            </div> --}}
                            <div class="mx-1">
                                <button {{ $dial_button }} id="dial_button" name="dial_button"
                                    class="btn custom-button btn-success"><i class="fas fa-phone-square"></i>
                                    โทรออก</button>
                            </div>
                            <div class="mx-1">
                                {{--  <button  <?= $outbound_dis ?>  class="btn btn-warning button_tranfer"><i
                                        class="fas fa-random"></i> โอนสาย</button> --}}
                                <div class="btn-group">
                                    <button type="button" id="tranfer_button" {{ $transfer_button }}
                                        class="btn btn-success custom-button dropdown-toggle dropdown-icon"
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
                                <button {{ $performance_button }} id="performance_button"
                                    class="btn custom-button btn-success button_conf"><i class="fas fa-star"></i>
                                    ประเมิน</button>
                            </div>
                            <div class="mx-1">
                                <button {{ $conf_button }} id="conf_button"
                                    class="btn custom-button btn-success button_conf"><i class="fas fa-handshake"></i>
                                    ประชุมสาย</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="btn-group float-left {{ $break_button_class }}" id="break_group">
                    <button type="button" id="btn-pause" {{ $break_button }}
                        class="btn btn-warning custom-button  mx-1 dropdown-toggle dropdown-icon"
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
                <button {{ $unbreak_button }}
                    class="{{ $unbreak_button_class }} btn btn-warning custom-button float-left mx-1 button_unbreak"
                    id="btn-unbreak"><i class="fas fa-clock"></i>
                    หยุดพัก </button>
                {{--  <button class="btn btn-warning custom-button float-left mx-1 button_unbreak"><i
                        class="fas fa-clock"></i>
                    UnWarp </button> --}}
                <div class="mx-1 px-1">
                    <button {{ $logout_button }}
                        class="{{ $logout_button_class }} btn btn-danger custom-button float-right"
                        id="btn-system-logout">
                        <i class="fas fa-power-off"></i>
                        ออกจากระบบ
                    </button>
                </div>
                <div class="mx-1 px-1">
                    <button {{ $logoff_button }} id="btn-agent-logout"
                        class="{{ $logoff_button_class }} btn btn-secondary custom-button float-right"><i
                            class="fas fa-power-off"></i>
                        ไม่พร้อมรับสาย </button>
                </div>
                <div class="mx-1 px-1">
                    <button {{ $login_button }} id="btn-agent-login"
                        class="{{ $login_button_class }} btn btn-success custom-button mx-1 float-right"><i
                            class="fas fa-plug"></i>
                        พร้อมรับสาย </button>
                </div>


                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
