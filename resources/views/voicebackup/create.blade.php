<div class="modal fade" id="CreateModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="fas fa-list-ol"></i> เพิ่มรายการ Export ไฟล์บันทึกเสียง</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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


                {{-- 'route' => 'users.store', --}}
                {!! Form::open(['method' => 'POST', 'class' => 'form']) !!}
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong><i class="fas fa-list-ol"></i> ชื่อรายการ:</strong>
                            {!! Form::text('name', null, ['id' => 'AddName', 'placeholder' => 'Name', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong><i class="fas fa-calendar"></i> จากวันที่:</strong>
                            @php
                                $datethai = date('Y-m-d') . ' ' . date('H:i:s');
                            @endphp
                            {!! Form::text('start_date', $datethai, [
                                'id' => 'AddSDate',
                                'placeholder' => '',
                                'class' => 'datepick form-control',
                            ]) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong><i class="fas fa-calendar"></i> ถึงวันที่:</strong>
                            @php
                                 $datethai = date('Y-m-d') . ' ' . date('H:i:s');
                            @endphp
                            {!! Form::text('end_date', $datethai, [
                                'id' => 'AddEDate',
                                'placeholder' => '',
                                'class' => 'datepick form-control',
                            ]) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong><i class="fas fa-list-ol"></i> เบอร์ที่ติดต่อ:</strong>
                            {!! Form::text('src', null, ['id' => 'AddSrc', 'placeholder' => 'เบอร์ที่ติดต่อ', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong><i class="fas fa-list-ol"></i> Agent:</strong>
                            <select style="width: 100%;" class="select2 select2_single form-control" id="AddAgent"
                                name="agent" multiple="multiple">
                                @can('voice-record-supervisor')
                                    <option value="" selected>ทั้งหมด</option>
                                @endcan
                                @foreach ($agent as $agen)
                                    @can('voice-record-supervisor')
                                        <option value="{{ $agen->id }}">
                                            {{ $agen->name ?? 'ไม่พบเบอร์โทรศัพท์' }}
                                        </option>
                                    @else
                                        @if (Auth::user()->id == $agen->id)
                                            <option value="{{ $agen->id }}">
                                                {{ $agen->name ?? 'ไม่พบเบอร์โทรศัพท์' }}
                                            </option>
                                        @endif
                                    @endcan
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong><i class="fas fa-list-ol"></i> ประเภทการโทร:</strong>
                            <select style="width: 100%;" class="select2 select2_single form-control" id="AddCtype"
                                name="ctype" multiple="multiple">
                                <option value="">ทั้งหมด</option>
                                <option value="1"> สายเข้า</option>
                                <option value="2"> โทรออก</option>
                                <option value="3"> ภายใน</option>
                            </select>
                        </div>
                    </div>
                </div>

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
