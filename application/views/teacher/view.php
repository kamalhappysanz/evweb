<style>
.formdesign
{
	padding-bottom:50px;
    padding-top: 10px;
    background-color: rgba(209, 209, 211, 0.11);
    border-radius: 12px;
}
</style>
<div class="main-panel">
   <div class="content">
      <?php if($this->session->flashdata('msg')): ?>
      <div class="alert alert-success">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
         ×</button> <?php echo $this->session->flashdata('msg'); ?>
      </div>
      <?php endif; ?>
      <div class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <div class="card">
                     <div class="content" id="content1">
                        <div class="fresh-datatables">
                           <!-- <h4 class="title" style="padding-bottom: 20px;">List of Teacher</h4> -->
                           <legend>List of Staff
                           <a href="<?php echo base_url(); ?>teacher/view_subject_handling" class="pull-right btn" style="margin-top:-10px;">Teacher Handling Subject</a></legend>
                           <table id="example" class="table table-striped table-no-bordered table-hover" cellspacing="0" >
                              <thead>
                                 <th data-field="id" class="text-left" data-sortable="true">S.No</th>
																 <th data-field="Role" class="text-left" data-sortable="true">Role</th>
                                 <th data-field="name" class="text-left" data-sortable="true">Name</th>
                                 <th data-field="email" class="text-left" data-sortable="true">Email</th>
                                 <th data-field="mobile" class="text-left" data-sortable="true">Mobile</th>
                                 <th data-field="class" class="text-left" data-sortable="true">Class Teacher</th>
                                 <th data-field="status" class="text-left" data-sortable="true">Status</th>
                                 <th data-field="Section" class="text-left" data-sortable="true">Action</th>
                              </thead>
                              <tbody>
                                 <?php
                                    $i=1;
                                    if(!empty($gender)){
                                	}else{
                                    foreach ($result as $rows) {
                                    $stu=$rows->status;
                                    ?>
                                 <tr>
                                    <td class="text-left"><?php echo $i; ?></td>
																		<td class="text-left"><?php if($rows->role_type_id=='5'){echo "Board Memeber";}else{echo "Teacher";} ?></td>
                                    <td class="text-left"><?php echo $rows->name; ?></td>
                                    <td class="text-left"><?php echo $rows->email; ?></td>
                                    <td class="text-left"><?php echo $rows->phone; ?></td>
                                    <td class="text-left"><?php echo $rows->class_name;?>-<?php echo $rows->sec_name; ?></td>
                                    <td><?php
                                       if($stu=='Active'){?>
                                       <button class="btn btn-success btn-fill btn-wd">Active</button>
                                       <?php  }else{?>
                                       <button class="btn btn-danger btn-fill btn-wd">DE-Active</button><?php }
                                          ?>
                                    </td>
                                    <td class="text-left">
                                       <a href="<?php echo base_url(); ?>teacher/get_teacher_id/<?php echo $rows->teacher_id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
																			 <?php if($rows->role_type_id=='5'){

																			 }else{ ?>
																				 <a rel="tooltip" href="#myModal" data-id="<?php echo $rows->teacher_id; ?>" title="Add Subjects" class="open-AddBookDialog btn btn-simple btn-warning btn-icon edit" style="color:#eb34ff;" data-toggle="modal" data-target="#myModal"   >
																				 <i class="fa fa-user-plus">  </i></a>
																		<?php	 } ?>

                                    </td>
                                 </tr>
                                 <?php  $i++;  } } ?>
                              </tbody>
                           </table>
                           <div id="myModal" class="modal fade" role="dialog">
                              <div class="modal-dialog">
                                 <!-- Modal content-->
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                       <h4 class="modal-title">Add Subject To Teacher</h4>
                                    </div>
                                    <div class="modal-body">
                                       <form action="" method="post" class="form-horizontal" id="subject_handling_form">
                                          <fieldset>
                                             <div class="form-group">
                                                <label class="col-sm-4 control-label">Select Subject</label>
                                                <div class="col-sm-6">
                                                   <select  name="subject_id" id="subject_id"  data-title="Select Subject" class="selectpicker" data-style=" btn-block" data-menu-style="dropdown-blue" onchange="getListClass()">
                                                      <?php foreach ($resubject as $rows) {  ?>
                                                      <option value="<?php echo $rows->subject_id; ?>"><?php echo $rows->subject_name; ?></option>
                                                      <?php      } ?>
                                                   </select>
                                                   <input type="hidden" name="teacher_id" id="teacher_id" class="form-control" value="">
                                                </div>
                                             </div>
                                             <div class="form-group">
                                                <label class="col-sm-4 control-label">Select Class</label>
                                                <div class="col-sm-6">
                                                   <select   name="class_master_id" id="class_master_id" class="form-control">
                                                   </select>
                                                </div>
                                             </div>
                                             <div class="form-group">
                                                <label class="col-sm-4 control-label">Select Status</label>
                                                <div class="col-sm-6">
                                                   <select   name="status" id="status" class="form-control">
                                                      <option value="Active">Active</option>
                                                      <option value="Deactive">Deactive</option>
                                                   </select>
                                                </div>
                                             </div>
                                             <div class="form-group">
                                                <label class="col-sm-4 control-label">&nbsp;</label>
                                                <div class="col-sm-6">
                                                   <button type="submit" id="save" class="btn btn-info btn-fill center">Save </button>
                                                </div>
                                             </div>
                                          </fieldset>
                                       </form>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
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
</div>
<script type="text/javascript">
   function getListClass(){

   var subject_id=$('#subject_id').val();
   //alert(subject_id);
   $.ajax({
   url:'<?php echo base_url(); ?>classmanage/getListClass',
   method:"POST",
   data:{subject_id:subject_id},
   dataType: "JSON",
   cache: false,
   success:function(data)
   {
   var stat=data.status;
   $("#class_master_id").empty();
   if(stat=="success"){
   var res=data.res;
   //alert(res.length);
   var len=res.length;

   for (i = 0; i < len; i++) {
   $('<option>').val(res[i].class_master_id).text(res[i].class_name + res[i].sec_name).appendTo('#class_master_id');
   }

   }else{
   $("#class_master_id").empty();
   }
   }
   });

   }
   $('#subject_handling_form').validate({ // initialize the plugin
     rules: {
         subject_id:{required:true },
         class_master_id:{required:true },

     },
     messages: {
           subject_id: "Select Subject",
           class_master_id:"Select Class"

         },
       submitHandler: function(form) {
         //alert("hi");
         swal({
                       title: "Are you sure?",
                       text: "You Want confirm  this form",
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
            url: "<?php echo base_url(); ?>teacher/subject_handling",
             type:'POST',
            data: $('#subject_handling_form').serialize(),
            success: function(response) {
              //alert(response);
                if(response=="success"){
                 //  swal("Success!", "Thanks for Your Note!", "success");
                   $('#subject_handling_form')[0].reset();
                   swal({
            title: "Wow!",
            text: "Subject Added Successfully!",
            type: "success"
        }, function() {
          location.reload();
        });
                }else{
                  sweetAlert("Oops...",response, "error");
                }
            }
        });
      }else{
          swal("Cancelled", "Process Cancel :)", "error");
      }
    });
   }
   });



   $(document).on("click", ".open-AddBookDialog", function () {
        var eventId = $(this).data('id');
        $(".modal-body #teacher_id").val( eventId );
   });

	  $('#teachermenu').addClass('collapse in');
      $('#teacher').addClass('active');
      $('#teacher2').addClass('active');

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


</script>
