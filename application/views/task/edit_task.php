<div class="main-panel">
   <div class="content">
      <div class="col-md-8">
         <div class="card">
            <div class="header">
               <legend>Edit  Task to Staff</legend>
            </div>
            <?php if($this->session->flashdata('msg')): ?>
            <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
               ×</button> <?php echo $this->session->flashdata('msg'); ?>
            </div>
            <?php endif; ?>
            <div class="content">
              <?php  foreach($res as $rows){} ?>
               <form method="post" action="" class="form-horizontal" enctype="multipart/form-data" id="stafftask" name="stafftask">
                 <fieldset>
                    <div class="form-group">
                       <label class="col-sm-2 control-label">Select Role </label>
                       <div class="col-sm-6">
                          <select name="user_role" id="role_type_id" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue" onchange="get_user_list()">
                            <?php foreach($res_user_role as $res_user_role_name){ ?>
                               <option value="<?php echo $res_user_role_name->role_id; ?>"><?php echo $res_user_role_name->user_type_name; ?></option>
                          <?php   } ?>
                            </select>
                             <script language="JavaScript">document.stafftask.user_role.value="<?php echo $rows->user_role; ?>";</script>
                       </div>
                    </div>
                 </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Select User</label>
                        <div class="col-sm-6">
                          <?php  if($rows->user_role=='5'){ ?>
                            <select name="user_id" id="user_id" class=" form-control">
                              <?php foreach($res_staff as $result_of_staff){ ?>
                                  <option value="<?php echo $result_of_staff->user_id; ?>"><?php echo $result_of_staff->name; ?></option>
                            <?php  } ?>

                            </select>
                            <script language="JavaScript">document.stafftask.user_id.value="<?php echo $rows->task_to_user_id; ?>";</script>
                        <?php  }else{ ?>
                          <select name="user_id" id="user_id" class=" form-control">
                            <?php foreach($res_teacher as $result_of_teacher){ ?>
                                <option value="<?php echo $result_of_teacher->user_id; ?>"><?php echo $result_of_teacher->name; ?></option>
                          <?php  } ?>
                          </select>
                          <script language="JavaScript">document.stafftask.user_id.value="<?php echo $rows->task_to_user_id; ?>";</script>
                      <?php    } ?>

                        </div>

                     </div>
                  </fieldset>


                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Due Date</label>
                        <div class="col-sm-6">
                          <?php  $dateTime = new DateTime($rows->due_date_task);
                            $due_date=date_format($dateTime,'d-m-Y' );

                           ?>
                           <input type="text" name="due_date" class="form-control datepicker" value="<?php   echo $due_date;   ?>">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-6">
                           <input type="text" name="task_title" class="form-control" value="<?php echo $rows->task_title; ?>">
                                <input type="hidden" name="id" class="form-control" value="<?php echo $rows->id; ?>">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-6">
                           <textarea type="text" name="task_desc" class="form-control" value=""><?php echo $rows->task_desc; ?></textarea>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-6">
                          <select name="status" id="status" class=" form-control">
                            <option value="assigned">Assigned</option>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="incomplete">In complete</option>
                            <option value="onhold">on Hold</option>
                          </select>
                            <script language="JavaScript">document.stafftask.status.value="<?php echo $rows->status; ?>";</script>
                        </div>
                     </div>
                  </fieldset>


                  <fieldset>
                     <div class="form-group">

                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-4">
                           <button type="submit" id="save" class="btn btn-info btn-fill center">Update  Task </button>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group"></div>
                  </fieldset>
               </form>
            </div>
         </div>
         <!-- end card -->
      </div>
   </div>
</div>
<style>
#class_tutor_teacher {
  display:none;
}
</style>
<script type="text/javascript">
   function get_user_list(){

   var user_role=$('#role_type_id').val();
  // alert(user_role);
   $.ajax({
   url:'<?php echo base_url(); ?>stafftask/get_user_list',
   method:"POST",
   data:{user_role:user_role},
   dataType: "JSON",
   cache: false,
   success:function(data)
   {

   var stat=data.status;

   $("#user_id").empty();
   if(stat=="success"){
   var res=data.res;
   //alert(res.length);
   var len=res.length;

   for (i = 0; i < len; i++) {
     // alert(res[i].name);
   $('<option>').val(res[i].user_id).text(res[i].name).appendTo('#user_id');
   }

   }else{
   $("#user_id").empty();
   }
   }
   });

   }


   $(document).ready(function () {


   $('#stafftask').validate({ // initialize the plugin
   rules: {
     user_role:{required:true },
 	   user_id:{required:true },
     task_title:{required:true },
   	task_desc:{required:true },
   	due_date:{required:true },
   	status:{required:true }
   },
   messages: {
    user_role:"Select Role",
   	user_id: "Select User",
   	task_title: "Enter title",
   	task_desc: "Enter details",
   	due_date:"Enter Due Date",
   	status:"Select Status Name"
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
       url: "<?php echo base_url(); ?>stafftask/update_task",
        type:'POST',
       data: $('#stafftask').serialize(),
       success: function(response) {

           if(response=="success"){
            //  swal("Success!", "Thanks for Your Note!", "success");
              $('#stafftask')[0].reset();
              swal({
       title: "Wow!",
       text: "Task Updated Successfully!",
       type: "success"
   }, function() {
       window.location = "<?php echo base_url(); ?>stafftask/view";
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

   $('#role_type_id').on('change', function () {
       if(this.value === "2"){
           $("#class_tutor_teacher").show();
       } else {
           $("#class_tutor_teacher").hide();
       }
   });



   $().ready(function(){
   $('#taskmenu').addClass('collapse in');

   $('#task').addClass('active');
   $('#task1').addClass('active');
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
