<div class="main-panel">
   <div class="content">
      <div class="col-md-8">
         <div class="card">
            <div class="header">
               <legend>Create Study Material</legend>
            </div>
            <?php if($this->session->flashdata('msg')): ?>
            <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
               ×</button> <?php echo $this->session->flashdata('msg'); ?>
            </div>
            <?php endif; ?>
            <div class="content">
               <form method="post" action="" class="form-horizontal" enctype="multipart/form-data" id="stafftask">
                 <fieldset>
                    <div class="form-group">
                       <label class="col-sm-2 control-label">Select Class </label>
                       <div class="col-sm-6">
                          <select name="class_id" id="class_id" class="selectpicker form-control" data-title="Select Class" data-style="btn-default btn-block" data-menu-style="dropdown-blue" onchange="get_class_id()">
                            <?php foreach($getall_class as $rows_class){ ?>
                               <option value="<?php echo $rows_class->class_sec_id; ?>"><?php echo $rows_class->class_name; ?>&nbsp; - &nbsp;<?php echo $rows_class->sec_name; ?></option>
                          <?php   } ?>
                            </select>
                       </div>
                    </div>
                 </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Select Subject</label>
                        <div class="col-sm-6">
                            <select name="subject_id" id="subject_id" class=" form-control">
                            </select>
                        </div>

                     </div>
                  </fieldset>


                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-6">
                           <input type="text" name="e_title" class="form-control " value="">
                        </div>
                     </div>
                  </fieldset>

                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-6">
                           <textarea type="text" name="e_desc" class="form-control" value=""></textarea>
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
                        </div>
                     </div>
                  </fieldset>


                  <fieldset>
                     <div class="form-group">

                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-4">
                           <button type="submit" id="save" class="btn btn-info btn-fill center">Add Material </button>
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
   function get_class_id(){

   var class_id=$('#class_id').val();
  // alert(user_role);
   $.ajax({
   url:'<?php echo base_url(); ?>studymaterial/get_subject_for_class',
   method:"POST",
   data:{class_id:class_id},
   dataType: "JSON",
   cache: false,
   success:function(data)
   {

   var stat=data.status;

   $("#subject_id").empty();
   if(stat=="success"){
   var res=data.res;
   //alert(res.length);
   var len=res.length;

   for (i = 0; i < len; i++) {
     // alert(res[i].name);
   $('<option>').val(res[i].subject_id).text(res[i].subject_name).appendTo('#subject_id');
   }

   }else{
   $("#subject_id").empty();
   }
   }
   });

   }


   $(document).ready(function () {


   $('#stafftask').validate({ // initialize the plugin
   rules: {
     class_id:{required:true },
 	   subject_id:{required:true },
     e_title:{required:true },
   	e_desc:{required:true },

   	status:{required:true }
   },
   messages: {
    class_id:"Select Class",
   	subject_id: "Select Subject",
   	e_title: "Enter title",
   	e_desc: "Enter details",
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
       url: "<?php echo base_url(); ?>studymaterial/create_material",
        type:'POST',
       data: $('#stafftask').serialize(),
       success: function(response) {

           if(response=="success"){
            //  swal("Success!", "Thanks for Your Note!", "success");
              $('#stafftask')[0].reset();
              swal({
       title: "Wow!",
       text: "Material Added Successfully!",
       type: "success"
   }, function() {
       window.location = "<?php echo base_url(); ?>studymaterial/view";
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




   $().ready(function(){
   $('#studymenu').addClass('collapse in');

   $('#study').addClass('active');
   $('#study1').addClass('active');
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
