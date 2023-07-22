 <!-- Edit  Modal -->
 <div class="fade modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
 id="EditModal">
 <div class="modal-dialog modal-lg" role="document">
     <form id="editdata" class="form" action="" method="POST">
         <div class="modal-content">
             <div class="modal-header bg-info">
                 <h4 class="modal-title" id="exampleModalLongTitle">แก้ไข ผู้ใช้งาน</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <!-- Modal body -->
             <div class="modal-body">
                 <div class="alert alert-danger alert-dismissible fade show" role="alert"
                     style="display: none;">
                     <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="alert alert-success alert-dismissible fade show" role="alert"
                     style="display: none;">
                     <strong>Success!</strong> Users was edit successfully.
                     <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true"></span>
                     </button>
                 </div>
                 <div id="EditModalBody">

                 </div>
             </div>
             <!-- Modal footer -->
             <div class="modal-footer">
                 <button type="button" class="btn btn-success" id="SubmitEditForm">บันทึก</button>
                 <button type="button" class="btn btn-danger modelClose"
                     data-dismiss="modal">ปิด</button>
             </div>
         </div>
     </form>
 </div>
</div>
