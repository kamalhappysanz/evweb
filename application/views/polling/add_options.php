<div class="main-panel">
   <div class="content">
      <div class="col-md-12">
         <div class="card">

            <?php if($this->session->flashdata('msg')): ?>
            <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
               ×</button> <?php echo $this->session->flashdata('msg'); ?>
            </div>
            <?php endif; ?>


         </div>
         <!-- end card -->
      </div>

   <div class="content">
      <div class="col-md-12">
         <div class="card">
            <div class="header">
               <legend>Add Options to Poll</legend>
            </div>

            <div class="content">
               <form method="post" action="<?php echo base_url(); ?>polling/addoptions" class="form-horizontal" enctype="multipart/form-data" id="stafftask">
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Add Options </label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="poll_options" required>
                          <input type="hidden" class="form-control" name="poll_id" value="<?php echo $this->uri->segment(3);?>">
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
                           <button type="submit" id="save" class="btn btn-info btn-fill center">Add Option</button>
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
                                 <legend>View Option </legend>
                                 <table id="example1" class="table table-striped table-no-bordered table-hover" cellspacing="0" >
                                    <thead>
                                       <th data-field="id" class="text-left" data-sortable="true">S.No</th>
                                       <th data-field="Role" class="text-left" data-sortable="true">Video</th>
                                       <th data-field="email" class="text-left" data-sortable="true">Status</th>

                                    </thead>
                                    <tbody>
                                       <?php
                                          $i=1;
                                          foreach($res_option as $rows_option){
                                          ?>
                                       <tr>
                                          <td class="text-left"><?php echo $i; ?></td>
                                          <td class="text-left"><?php echo $rows_option->poll_options; ?></td>
                                          <td class="text-left"><?php   if($rows_option->status=='Active'){ ?>
                                           <button class="btn btn-success btn-fill btn-wd" onclick="stat(<?php echo $rows_option->id; ?>,'Deactive')">Active</button>
                                          <?php  }else{?>
                                          <button class="btn btn-danger btn-fill btn-wd" onclick="stat(<?php echo $rows_option->id; ?>,'Active')">DE-Active</button>

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
  url:'<?php echo base_url(); ?>polling/changepolling_status',
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
     poll_options:{required:true,
                  remote: {
                url: "<?php echo base_url(); ?>polling/check_option_exist/<?php echo $this->uri->segment(3);  ?>",
                type: "post"
             }
           },
    	status:{required:true }
   },
   messages: {
    poll_options:{
          required: "Please enter Poll option",
          remote: "This Option Already exist"
    },
   	status:"Select Status Name"
  }
   });
   });


   $().ready(function(){
   $('#pollmenu').addClass('collapse in');

   $('#polling').addClass('active');
   $('#poll1').addClass('active');

   });


   $('#example').DataTable({ });
    $('#example1').DataTable({ });

</script>
