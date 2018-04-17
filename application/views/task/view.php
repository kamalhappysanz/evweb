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
													 <legend>View Staff Task </legend>
                           <table id="example" class="table table-striped table-no-bordered table-hover" cellspacing="0" >
                              <thead>
                                 <th data-field="id" class="text-left" data-sortable="true">S.No</th>
																 <th data-field="role_type" class="text-left" data-sortable="true">Role</th>
																 <th data-field="Role" class="text-left" data-sortable="true">Name</th>
                                 <th data-field="name" class="text-left" data-sortable="true">Title</th>
                                 <th data-field="email" class="text-left" data-sortable="true">Due date</th>
                                 <th data-field="mobile" class="text-left" data-sortable="true">Status</th>
                                 <th data-field="Section" class="text-left" data-sortable="true">Action</th>
                              </thead>
                              <tbody>
                                 <?php
                                    $i=1;
                                  	foreach ($res as $rows) {

                                    ?>
                                 <tr>
                                    <td class="text-left"><?php echo $i; ?></td>
																		<td class="text-left"><?php if($rows->user_role=='5'){echo "Board Memeber";}else{echo "Teacher";} ?></td>
                                    <td class="text-left"><?php echo $rows->name; ?></td>
                                    <td class="text-left"><?php echo $rows->task_title; ?></td>
                                    <td class="text-left"><?php echo $rows->due_date_task; ?></td>
                                    <td class="text-left"><?php $sta=$rows->status;
																		if($sta=="assigned"){ ?>
																			<button type="button" class="btn  assign">Assigned</button>
																	<?php	}else if($sta=="pending"){ ?>
																			<button type="button" class="btn  pending">Pending</button>
																	<?php	}else if($sta=="completed"){ ?>
																			<button type="button" class="btn  completed">Completed</button>
																	<?php	}else if($sta=="incomplete"){ ?>
																			<button type="button" class="btn  incompleted">In Completed</button>
																	<?php	}else if($sta=="onhold"){ ?>
																			<button type="button" class="btn  onhold">On Hold</button>
																	<?php	}else{ ?>

																	<?php	} ?></td>

                                    <td class="text-left"> <a href="<?php echo base_url(); ?>stafftask/edit_task/<?php echo $rows->id ?>"><i class="fa fa-edit"></i></a> </td>
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
</div>
<style>
.btn{
	border: none;
	color:#fff;
}
.assign{
		background-color: #f58341;
}
.pending{
	background-color: #cedc28;
}
.incomplete{
	background-color: #bf2026;
}
.completed{
background-color: #4da246;
}.onhold{
background-color:  #d95583;
}

</style>
<script type="text/javascript">
	 $('#taskmenu').addClass('collapse in');
   $('#task').addClass('active');
   $('#task2').addClass('active');

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
