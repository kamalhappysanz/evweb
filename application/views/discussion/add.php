<div class="main-panel">
   <div class="content">
      <div class="col-md-12">
         <div class="card">
            <div class="header">
               <legend>Create Topic</legend>
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
                        <label class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-6">
                           <input type="text" name="discussion_title" class="form-control" value="">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-8">
                           <textarea type="text" name="discussion_topic" class="form-control" value=""></textarea>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">

                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-4">
                           <button type="submit" id="save" class="btn btn-info btn-fill center">Create topic </button>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group"></div>
                  </fieldset>
               </form>
            </div>
            <div class="content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="">
                           <div class="content" id="content1">
                              <div class="fresh-datatables">
                                 <legend>View Latest topic </legend>
                                 <table id="example" class="table table-striped table-no-bordered table-hover" cellspacing="0" >
                                    <thead>
                                       <th data-field="id" class="text-left" data-sortable="true" style="width:100px;">S.No</th>
                                       <th data-field="role_type" class="text-left" data-sortable="true" style="width:100px;">User type</th>
                                       <th data-field="role_type" class="text-left" data-sortable="true" style="width:100px;">Created By</th>
                                       <th data-field="Role" class="text-left" data-sortable="true" style="width:450px;">Title & topic</th>
                                       <th data-field="mobile"  data-sortable="true">Status</th>

                                    </thead>
                                    <tbody>
                                       <?php
                                          $i=1;
                                          foreach ($res as $rows) {

                                          ?>
                                       <tr>
                                          <td class="text-left"><?php echo $i; ?></td>
                                          <td class="text-left"><?php echo $rows->user_type_name; ?></td>
                                          <td class="text-left"><?php echo $rows->name; ?></td>
                                          <td class="text-left"><a href="<?php echo base_url();  ?>discussion/viewtopic/<?php echo base64_encode($rows->id*5678); ?>"><b><?php echo $rows->discussion_title; ?></b><br>
                                         <small style="color:#000;"><?php echo $rows->discussion_topic; ?></small></a>
                                          </td>
                                          <td class="text-left"><?php   if($rows->status=='Active'){ ?>
                                           <button class="btn btn-success btn-fill btn-wd" onclick="stat(<?php echo $rows->id; ?>,'Deactive')">Active</button>
                                          <?php  }else{?>
                                          <button class="btn btn-danger btn-fill btn-wd" onclick="stat(<?php echo $rows->id; ?>,'Active')">DE-Active</button>

                                       <?php	} ?></td>
                                            <!-- <td class="text-left">
                                              <a href="<?php echo base_url(); ?>discussion/editcomment/<?php echo $rows->id ?>"><i class="fa fa-edit"></i></a>
                                            </td> -->

                                       </tr>
                                       <?php  $i++;  }  ?>
                                    </tbody>
                                 </table>
                                    </div>
                           </div>
                           <div id="editor"></div>
                           <!-- end content-->
                        </div>
                        <!--  end card  -->
                     </div>
                     <!-- end col-md-12 -->
                  </div>
                  <!-- end row -->
               </div>
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

   $('#example').DataTable({

   });

   function stat(sel,stat){
     $.ajax({
     url:'<?php echo base_url(); ?>discussion/changediscussion_status',
     method:"POST",
     data:{sel:sel,stat:stat},
     cache: false,
     success:function(data)
     {
       if(data=="success"){
            swal({
           title: "Wow!",
           text: "Updated!",
           type: "success"
           }, function() {
           location.reload();
           });
       }else{
         sweetAlert("Oops...",data, "error");
       }
     }
     });
   }

   $(document).ready(function () {


   $('#stafftask').validate({ // initialize the plugin
   rules: {
     discussion_title:{required:true },
    	discussion_topic:{required:true }
   },
   messages: {
    discussion_title:"Enter Title",
   	discussion_topic:"Enter the details"
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
       url: "<?php echo base_url(); ?>discussion/create_topic",
        type:'POST',
       data: $('#stafftask').serialize(),
       success: function(response) {

           if(response=="success"){
            //  swal("Success!", "Thanks for Your Note!", "success");
              $('#stafftask')[0].reset();
              swal({
       title: "Wow!",
       text: "Topic Added Successfully!",
       type: "success"
   }, function() {
       window.location = "<?php echo base_url(); ?>discussion/home";
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
   $('#discussionmenu').addClass('collapse in');

   $('#discussion').addClass('active');
   $('#discussion1').addClass('active');

   });
</script>
