<div class="main-panel">
   <div class="content">
      <div class="col-md-12">
         <div class="card">
            <div class="header">
               <legend>Upload File for Study material</legend>
            </div>
            <?php if($this->session->flashdata('msg')): ?>
            <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
               ×</button> <?php echo $this->session->flashdata('msg'); ?>
            </div>
            <?php endif; ?>
            <div class="content">
               <form method="post" action="<?php echo base_url(); ?>studymaterial/uploadfile" class="form-horizontal" enctype="multipart/form-data" id="stafftask">
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Upload file</label>
                        <div class="col-sm-6">
                          <input type="file" class="form-control" name="e_learn_file" accept=".pdf,.doc" required>
                          <input type="hidden" class="form-control" name="e_learn_id" value="<?php echo $this->uri->segment(3);?>">
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
                           <button type="submit" id="save" class="btn btn-info btn-fill center">Upload file</button>
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
                        <div class="card">
                           <div class="content" id="content1">
                              <div class="fresh-datatables">
                                 <legend>View File </legend>
                                 <table id="example" class="table table-striped table-no-bordered table-hover" cellspacing="0" >
                                    <thead>
                                       <th data-field="id" class="text-left" data-sortable="true">S.No</th>
                                       <th data-field="Role" class="text-left" data-sortable="true">File</th>
                                       <th data-field="email" class="text-left" data-sortable="true">Status</th>
                                    </thead>
                                    <tbody>
                                       <?php
                                          $i=1;
                                          foreach($res_file as $rows_file){



                                          ?>
                                       <tr>
                                          <td class="text-left"><?php echo $i; ?></td>
                                          <td class="text-left"><a href="<?php echo base_url(); ?>assets/material/<?php echo $rows_file->e_learn_file; ?>" target="_blank">Click to view</a></td>
                                          <td class="text-left"><?php if($rows_file->status=='Active'){ ?>
      																			<button class="btn btn-success btn-fill btn-wd" onclick="file_stat(<?php echo $rows_file->id; ?>,'Deactive')">Active</button>
      																	 	 <?php  }else{?>
      																	 	 <button class="btn btn-danger btn-fill btn-wd" onclick="file_stat(<?php echo $rows_file->id; ?>,'Active')">DE-Active</button>

      																	<?php	} ?></td>
                                       </tr>
                                       <?php  $i++;  }   ?>
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
   <div class="content">
      <div class="col-md-12">
         <div class="card">
            <div class="header">
               <legend>Add Video link</legend>
            </div>
            <?php if($this->session->flashdata('msg')): ?>
            <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
               ×</button> <?php echo $this->session->flashdata('msg'); ?>
            </div>
            <?php endif; ?>
            <div class="content">
               <form method="post" action="<?php echo base_url(); ?>studymaterial/videolink" class="form-horizontal" enctype="multipart/form-data" id="stafftask">
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Add video link</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="e_learn_video_link" required>
                          <input type="hidden" class="form-control" name="e_learn_id" value="<?php echo $this->uri->segment(3);?>">
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
                           <button type="submit" id="save" class="btn btn-info btn-fill center">Upload Link</button>
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
                        <div class="card">
                           <div class="content" id="content1">
                              <div class="fresh-datatables">
                                 <legend>View Videos </legend>
                                 <table id="example1" class="table table-striped table-no-bordered table-hover" cellspacing="0" >
                                    <thead>
                                       <th data-field="id" class="text-left" data-sortable="true">S.No</th>
                                       <th data-field="Role" class="text-left" data-sortable="true">Video</th>
                                       <th data-field="email" class="text-left" data-sortable="true">Status</th>
                                    </thead>
                                    <tbody>
                                       <?php
                                          $i=1;
                                          foreach($res_video as $rows_video){
                                          ?>
                                       <tr>
                                          <td class="text-left"><?php echo $i; ?></td>
                                          <td class="text-left"><a href="https://www.youtube.com/watch?v=<?php echo $rows_video->e_learn_video_link; ?>" target="_blank">View Video</a></td>
                                          <td class="text-left"><?php   if($rows_video->status=='Active'){ ?>
                                           <button class="btn btn-success btn-fill btn-wd" onclick="stat(<?php echo $rows_video->id; ?>,'Deactive')">Active</button>
                                          <?php  }else{?>
                                          <button class="btn btn-danger btn-fill btn-wd" onclick="stat(<?php echo $rows_video->id; ?>,'Active')">DE-Active</button>

                                       <?php	} ?></td>
                                       </tr>
                                       <?php  $i++;  }   ?>
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

function stat(sel,stat){
  $.ajax({
  url:'<?php echo base_url(); ?>studymaterial/changestatus_video',
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

function file_stat(sel,stat){
  $.ajax({
  url:'<?php echo base_url(); ?>studymaterial/changestatus_file',
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




   $().ready(function(){
   $('#studymenu').addClass('collapse in');

   $('#study').addClass('active');
   $('#study2').addClass('active');

   });


   $('#example').DataTable({ });
    $('#example1').DataTable({ });

</script>
