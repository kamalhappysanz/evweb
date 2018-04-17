<div class="main-panel">
   <div class="content">
      <div class="col-md-8">
         <div class="card">
            <div class="header">
               <legend>Create Polling </legend>
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
                       <label class="col-sm-2 control-label">Select Role </label>
                       <div class="col-sm-6">
                          <select name="user_role" id="user_role" class="selectpicker form-control" data-title="Select Role" data-style="btn-default btn-block" data-menu-style="dropdown-blue" onchange="get_class_id()">
                            <?php foreach($get_user_role as $rows_role){ ?>
                               <option value="<?php echo $rows_role->role_id; ?>"><?php echo $rows_role->user_type_name; ?></option>
                          <?php   } ?>
                            </select>
                       </div>
                    </div>
                 </fieldset>


                   <fieldset>
                      <div class="form-group">
                         <label class="col-sm-2 control-label">Poll End date</label>
                         <div class="col-sm-6">
                            <input type="text" name="poll_end_date" class="form-control datepicker" value="">
                         </div>
                      </div>
                   </fieldset>

                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-6">
                           <input type="text" name="poll_title" class="form-control " value="">
                        </div>
                     </div>
                  </fieldset>

                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Question</label>
                        <div class="col-sm-6">
                           <textarea type="text" name="poll_desc" class="form-control" value=""></textarea>
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
                           <button type="submit" id="save" class="btn btn-info btn-fill center">Create  </button>
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
   <div class="content" id="pollview">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="content" id="content1">
                     <div class="fresh-datatables">
                        <legend id="table_poll">View Polling </legend>
                        <table id="example" class="table table-striped table-no-bordered table-hover" cellspacing="0" >
                           <thead>
                              <th data-field="id" class="text-left" data-sortable="true">S.No</th>
                              <th data-field="role_type" class="text-left" data-sortable="true">Role</th>
                              <th data-field="Role" class="text-left" data-sortable="true">Title</th>
                              <th data-field="name" class="text-left" data-sortable="true">Question</th>
                              <th data-field="email" class="text-left" data-sortable="true">Status</th>
                              <th data-field="Section" class="text-left" data-sortable="true">Action</th>
                           </thead>
                           <tbody>
                              <?php
                                 $i=1;
                                 foreach ($get_all_polls as $rows_polls) {

                                 ?>
                              <tr>
                                 <td class="text-left"><?php echo $i; ?></td>
                                 <td class="text-left"><?php echo $rows_polls->user_type_name;  ?></td>
                                 <td class="text-left"><?php echo $rows_polls->poll_title; ?></td>
                                 <td class="text-left"><?php echo $rows_polls->poll_desc; ?></td>
                                 <td class="text-left"><?php if($rows_polls->status=='Active'){ ?>
                                   <button class="btn btn-success btn-fill btn-wd">Active</button>
                                  <?php  }else{?>
                                  <button class="btn btn-danger btn-fill btn-wd">DE-Active</button>

                               <?php	} ?></td>

                                 <td class="text-left"> <a href="<?php echo base_url(); ?>polling/edit_polls/<?php echo base64_encode($rows_polls->id*5678); ?>"><i class="fa fa-edit"></i></a>
                                   <a href="<?php echo base_url(); ?>polling/options/<?php echo base64_encode($rows_polls->id*5678); ?>"><i class="fa fa-list"></i></a></i>
                                 </td>
                               </tr>
                                  <?php  $i++;  }  ?>
                             </tbody>
                           </table>
                              </div>
                              </div>
                              </div>
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
       url: "<?php echo base_url(); ?>polling/create_poll",
        type:'POST',
       data: $('#stafftask').serialize(),
       success: function(response) {

           if(response=="success"){
            //  swal("Success!", "Thanks for Your Note!", "success");
              $('#stafftask')[0].reset();
              swal({
       title: "Wow!",
       text: "Poll Added Successfully!",
       type: "success"
   }, function() {
       window.location = "<?php echo base_url(); ?>polling/home#table_poll";
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
