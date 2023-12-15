 <!-- Edit  Modal -->
 <div class="fade modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="EditModal">
     <div class="modal-dialog modal-lg" role="document">
         <form id="editdata" class="form" action="" method="POST">
             <div class="modal-content">
                 <div class="modal-header bg-primary">
                     <h4 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-user"></i> แก้ไข้ ผู้ใช้งาน
                     </h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <!-- Modal body -->
                 <div class="modal-body">
                     <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                         <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                         <strong>Success!</strong> Users was edit successfully.
                         <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true"></span>
                         </button>
                     </div>
                     <div id="EditModalBody">
                         <div class="row">
                             <div class="col-xs-12 col-sm-12 col-md-12">
                                 <div class="form-group">
                                     <label for="Name"><i class="fas fa-user"></i> ชื่อ-สกุล :</label>
                                     <input type="text" class="form-control" name="name" id="editName"
                                         value="">
                                 </div>
                             </div>
                             <div class="col-xs-12 col-sm-12 col-md-12">
                                 <div class="form-group">
                                     <label for="Name"><i class="fas fa-at"></i> Username :</label>
                                     <input type="text" class="form-control" name="email" id="editEmail"
                                         value="">
                                 </div>
                             </div>
                             <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-list-ol"></i> Queue:</strong>
                                    <select style="width: 100%;"
                                        class="select2 select2_multiple form-control" id="EditQueue"
                                        name="equeue" multiple="multiple">
                                        {{-- @foreach ($queue as $keyq)
                                            <option value="{{ $keyq->extension }}">{{ $keyq->extension }} ( {{ $keyq->descr }} )
                                            </option>
                                        @endforeach --}}


                                    </select>
                                </div>
                            </div>
                           {{--  <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong><i class="fas fa-list-ol"></i> Agent :</strong>
                                    <select style="width: 100%;" class="select2 select2_single form-control"
                                        id="EditAgent" name="eagent" multiple="multiple">

                                    </select>
                                </div>
                            </div> --}}
                             <div class="col-xs-6 col-sm-6 col-md-6">
                                 <div class="form-group">
                                     <strong><i class="fas fa-list-ol"></i> แผนก:</strong>
                                     <select style="width: 100%;"
                                         class="departmente select2 select2_single form-control" id="EditDepartment"
                                         name="edepartment" multiple="multiple">
                                         @foreach ($department as $key2)
                                             <option value="{{ $key2->id }}">{{ $key2->name }}
                                             </option>
                                         @endforeach


                                     </select>
                                 </div>
                             </div>
                             <div class="col-xs-6 col-sm-6 col-md-6">
                                 <div class="form-group">
                                     <strong><i class="fas fa-list-ol"></i> ตำแหน่ง :</strong>
                                     <select style="width: 100%;" class="positions select2 select2_single form-control"
                                         id="EditPosition" name="eposition" multiple="multiple">
                                     </select>
                                 </div>
                             </div>
                             <div class="col-xs-12 col-sm-12 col-md-12">
                                 <div class="form-group">
                                     <label for="Name"><i class="fas fa-key"></i> รหัสผ่าน:</label>
                                     <input type="password" class="form-control" name="epassword" required
                                         autocomplete="new-password" id="EditPassword">
                                 </div>
                             </div>
                             <div class="col-xs-12 col-sm-12 col-md-12">
                                 <div class="form-group">
                                     <label for="Name"><i class="fas fa-key"></i> ยืนยันรหัสผ่าน:</label>
                                     <input type="password" class="form-control" name="epassword_confirmation"
                                         id="EditPasswordC" required autocomplete="new-password">
                                 </div>
                             </div>

                             <div class="col-xs-12 col-sm-12 col-md-12">
                                 <div class="form-group">
                                     <label for="Name"><i class="fas fa-user-lock"></i> สิทธิ์การใช้งาน :</label>
                                     <select class="form-control" id="editRole" name="role">
                                     </select>
                                 </div>
                             </div>
                         </div>

                     </div>
                 </div>
                 <!-- Modal footer -->
                 <div class="modal-footer">
                     <button type="button" class="btn btn-success" id="SubmitEditForm"><i
                             class="fas fa-download"></i> บันทึกข้อมูล</button>
                     <button type="button" class="btn btn-danger modelClose" data-dismiss="modal"><i
                             class="fas fa-door-closed"></i> ปิดหน้าต่าง</button>
                 </div>
             </div>
         </form>
     </div>
 </div>
