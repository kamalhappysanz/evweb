<div class="main-panel">
   <div class="content">
      <div class="col-md-12">
         <div class="card">
            <div class="header">
               <legend>Discussion Forum  <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button></legend>

            </div>

            <div class="content">
              <?php  foreach($res_topic as $rows_topic){} ?>
              <p><b><?php echo $rows_topic->discussion_title; ?></b><br>
              <small style="margin-left:40px;"><?php echo $rows_topic->discussion_topic; ?></small></p>
            </div>
              <div class="content">
              <form method="post" action="" class="form-horizontal" enctype="multipart/form-data" id="stafftask">
                <fieldset>
                   <div class="form-group">
                      <label class="col-sm-1 control-label">comment</label>
                      <div class="col-sm-11">
                        <input type="hidden" name="ds_id" value="<?php echo $this->uri->segment(3); ?>">
                         <textarea type="text" name="discussion_topic" class="form-control" value=""></textarea>
                      </div>
                   </div>
                </fieldset>
                <fieldset>
                   <div class="form-group">
                      <label class="col-sm-1 control-label">&nbsp;</label>
                      <div class="col-sm-11">
                      <input type="submit" name="submit" value="Comment Here" class="btn btn-comment">
                      </div>
                   </div>
                </fieldset>
              </form>
              </div>
         </div>
         <div class="card">
               <div class="col-md-12">
             <h5>View Comments</h5>
             <?php if(empty($res_comment)){ ?>
                <center>  -----No comments------</center>
            <?php }else{
               foreach($res_comment as $rows_comment){ ?>
                 <blockquote>
                    <p><?php  echo $rows_comment->name; ?></p>
                    <small><?php  echo $rows_comment->user_comment; ?>

                    </small>
                     <p class="comment_date"><?php $dateTime = new DateTime($rows_comment->created_at);
               			echo $due_date=date_format($dateTime,'d-m-Y' );  ?></p>
                 </blockquote>
            <?php   }
             } ?>

          </div>
         </div>
         <!-- end card -->
      </div>
   </div>
</div>
<style>
.comment_date{
font-size: 14px;
font-style: italic;
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
   	discussion_topic:{required:true }
   },
   messages: {
   	discussion_topic:"Enter the Discussion"
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
       url: "<?php echo base_url(); ?>discussion/add_comment",
        type:'POST',
       data: $('#stafftask').serialize(),
       success: function(response) {

           if(response=="success"){
              $('#stafftask')[0].reset();
              swal({
                    title: "Success!",
                    text:  "Your comment is Posted",
                    type: "success",
                    timer: 3000,
                    showConfirmButton: false
                });
            window.setTimeout(function(){ } ,3000);
            location.reload();
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
