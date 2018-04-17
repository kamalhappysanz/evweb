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
													 <legend>View study Material </legend>
                           <table id="example" class="table table-striped table-no-bordered table-hover" cellspacing="0" >
                              <thead>
                                 <th data-field="id" class="text-left" data-sortable="true">S.No</th>
																 <th data-field="role_type" class="text-left" data-sortable="true">Class id</th>
																 <th data-field="Role" class="text-left" data-sortable="true">Subject</th>
                                 <th data-field="name" class="text-left" data-sortable="true">Title</th>
                                 <th data-field="email" class="text-left" data-sortable="true">Status</th>
                                 <th data-field="mobile" class="text-left" data-sortable="true">Created by</th>
                                 <th data-field="Section" class="text-left" data-sortable="true">Action</th>
                              </thead>
                              <tbody>
                                 <?php
                                    $i=1;
                                  	foreach ($res as $rows) {

                                    ?>
                                 <tr>
                                    <td class="text-left"><?php echo $i; ?></td>
																		<td class="text-left"><?php echo $rows->class_name; echo "-"; echo $rows->sec_name  ?></td>
                                    <td class="text-left"><?php echo $rows->subject_name; ?></td>
                                    <td class="text-left"><?php echo $rows->e_title; ?></td>
                                    <td class="text-left"><?php if($rows->status=='Active'){ ?>
																			<button class="btn btn-success btn-fill btn-wd">Active</button>
																	 	 <?php  }else{?>
																	 	 <button class="btn btn-danger btn-fill btn-wd">DE-Active</button>

																	<?php	} ?></td>
                                    <td class="text-left"><?php echo $rows->name;?></td>

                                    <td class="text-left"> <a href="<?php echo base_url(); ?>studymaterial/edit_material/<?php echo base64_encode($rows->id*5678); ?>"><i class="fa fa-edit"></i></a>
																			<a href="<?php echo base_url(); ?>studymaterial/contents/<?php echo base64_encode($rows->id*5678); ?>"><i class="fa fa-list"></i></a></i>

 </td>
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

<script type="text/javascript">
	 $('#studymenu').addClass('collapse in');
   $('#study').addClass('active');
   $('#study2').addClass('active');

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
