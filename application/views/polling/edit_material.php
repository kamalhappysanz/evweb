<div class="main-panel">
   <div class="content">
      <div class="col-md-8">
         <div class="card">
            <div class="header">
               <legend>Edit  Polling </legend>
            </div>
            <?php if($this->session->flashdata('msg')): ?>
            <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
               ×</button> <?php echo $this->session->flashdata('msg'); ?>
            </div>
            <?php endif; ?>
            <div class="content">
              <?php  foreach($res as $rows){} ?>
               <form method="post" action="" class="form-horizontal" enctype="multipart/form-data" id="stafftask" name="form_edit">
                 <fieldset>
                    <div class="form-group">
                       <label class="col-sm-2 control-label">Select Role </label>
                       <div class="col-sm-6">
                          <select name="user_role" id="user_role" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue" onchange="get_class_id()">
                            <?php foreach($get_user_role as $rows_role){ ?>
                               <option value="<?php echo $rows_role->role_id; ?>"><?php echo $rows_role->user_type_name; ?></option>
                          <?php   } ?>
                            </select>
                            <script language="JavaScript">document.form_edit.user_role.value="<?php echo $rows->user_role; ?>";</script>
                       </div>
                    </div>
                 </fieldset>


                   <fieldset>
                      <div class="form-group">
                         <label class="col-sm-2 control-label">Poll End date</label>
                         <div class="col-sm-6">
                           <?php $dateTime = new DateTime($rows->poll_due_date);
                             $due_date=date_format($dateTime,'d-m-Y' ); ?>
                            <input type="text" name="poll_end_date" class="form-control datepicker" value="<?php echo $due_date;  ?>">
                         </div>
                      </div>
                   </fieldset>

                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-6">
                           <input type="text" name="poll_title" class="form-control " value="<?php echo $rows->poll_title;  ?>">
                            <input type="hidden" name="id" class="form-control " value="<?php echo $rows->id;  ?>">
                        </div>
                     </div>
                  </fieldset>

                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Question</label>
                        <div class="col-sm-6">
                           <textarea type="text" name="poll_desc" class="form-control" value=""><?php echo $rows->poll_desc;  ?></textarea>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-6">
                          <select name="status" id="status" class=" form-control">
                            <option value="Active">Active</option>
                            <option value="Deactive">Deactive</option>

                          </select>
                            <script language="JavaScript">document.form_edit.status.value="<?php echo $rows->status; ?>";</script>
                        </div>
                     </div>
                  </fieldset>


                  <fieldset>
                     <div class="form-group">

                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-4">
                           <button type="submit" id="save" class="btn btn-info btn-fill center">Update Poll  </button>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group"></div>
                  </fieldset>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<style>
#class_tutor_teacher {
  display:none;
}
</style>
<script type="text/javascript">

   $(document).ready(function () {


   $('#stafftask').validate({ // initialize the plugin
   rules: {
     user_role:{required:true },
 	   poll_end_date:{required:true },
     poll_title:{required:true },
   	poll_desc:{required:true },

   	status:{required:true }
   },
   messages: {
    user_role:"Select Role",
   	poll_end_date: "Select Date",
   	poll_title: "Enter title",
   	poll_desc: "Enter question",
   	status:"Select Status "
  },
  submitHandler: function(form) {
    //alert("hi");
    swal({
                  title: "Are you sure?",
                  text: "You Want Confirm this form",
                  type: "success",
                  showCancelButton: true,
                  confirmButtonColor: '#DD6B55',
                  confirmButtonText: 'Yes, I am sure!',
                  cancelButtonText: "No, cancel it!",
                  closeOnConfirm: false,
                  closeOnCancel: false
              },
              function(isConfirm) {
                  if (isConfirm) {
   $.ajax({
       url: "<?php echo base_url(); ?>polling/update_poll",
        type:'POST',
       data: $('#stafftask').serialize(),
       success: function(response) {

           if(response=="success"){
            //  swal("Success!", "Thanks for Your Note!", "success");
              $('#stafftask')[0].reset();
              swal({
       title: "Wow!",
       text: "Poll Updated Successfully!",
       type: "success"
   }, function() {
       window.location = "<?php echo base_url(); ?>polling/home#pollview";
   });
           }else{
             sweetAlert("Oops...", "Something went wrong!", "error");
           }
       }
   });
 }else{
     swal("Cancelled", "Process Cancel :)", "error");
 }
});
}
   });
   });
   $('#example').DataTable({
 		  fixedHeader: true,
 		dom: 'lBfrtip',
 		buttons: [
               {
                   extend: 'excelHtml5',
                   exportOptions: {
                       columns: ':visible'
                   }
               },
               {
                   extend: 'pdfHtml5',
                   exportOptions: {
                       columns: ':visible'
                   }
               },
               'colvis'
           ],
 		"pagingType": "full_numbers",
 		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
 		responsive: true,
 		language: {
 		search: "_INPUT_",
 		searchPlaceholder: "Search records",
 		}
 	});



   $().ready(function(){
   $('#pollmenu').addClass('collapse in');

   $('#polling').addClass('active');
   $('#poll1').addClass('active');
   $('.datepicker').datetimepicker({
   format: 'DD-MM-YYYY',
   icons: {
   time: "fa fa-clock-o",
   date: "fa fa-calendar",
   up: "fa fa-chevron-up",
   down: "fa fa-chevron-down",
   previous: 'fa fa-chevron-left',
   next: 'fa fa-chevron-right',
   today: 'fa fa-screenshot',
   clear: 'fa fa-trash',
   close: 'fa fa-remove'
   }
   });
   });
</script>
