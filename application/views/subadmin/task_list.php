<?php //echo $count = count($task_list);  die; ?>

<?php include_once('include/header.php'); ?>

<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->
<?php include_once('include/sidebar.php'); ?>
<!-- ============================================================== -->

   <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Task</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url()."dashboard"; ?>">Home</a></li>
                            <li class="breadcrumb-item active">Task List</li>
                        </ol>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                        <a href="<?php echo base_url()."task/add_task"; ?>" class="btn pull-right hidden-sm-down btn-success"> Add Task</a>
                    </div>
                    <br />
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    <div class="col-sm-12">
                     <div class="card">
                        
                        
                        <div class="card-block">
                        
                        
                        <?php echo form_open('task/filter_task_list',array('class' => '','id'=>'task_list')); ?>
                        
                  			<div class="" style="float:left;">
                                <div class="col-md-4 col-4 align-self-center">
                                    <input type="text" class="form-control" name="datefilter" placeholder="Date" style="width: 270px;">
                            </div>
                            </div>
                            
                            <div class="" style="float:left;">
                                <div class="col-md-4 col-4 align-self-center">
                                   
                                    <select class="form-control" name="project_id" style="width: 250px;">
                                    			<option value="">Project Name</option>
                                               <?php 
											   $count = count($project_list);
											   if($count > 0)
											   {
												   foreach($project_list as $list)
												   { 
												   ?>
												   <option value="<?php echo $list->project_id; ?>"><?php echo $list->project_name; ?></option>
												   <?php 
												   } 
											   }
											   ?>
                                            </select>
                                </div>
                            </div>
                            
							<div class="" style="float:left;">
                                <div class="col-md-3 col-4 align-self-center">
                                    <!--<input type="text" class="form-control" name="employee_id" placeholder="Employee Name" style="width: 240px;">-->
                                    <select class="form-control" name="status_id" style="width: 170px;">
                                    	<option value="">Status</option>
                                        <option value="0">Pending</option>
										<option value="1">Waiting for approval</option>
										<option value="2">Approved</option>
                                    </select>
                                </div>
                            </div>
							
                            <div class="" style="float:left;">
                                <div class="col-md-4 col-4 align-self-center">
                                    <input type="submit" class="form-control btn-success" style="width: 150px;" name="search" value="Filter" >
                                </div>
                            </div>
                            
                            <?php echo form_close(); ?>
                          
                         </div>
                         
                         </div>
                        <div class="card">
                            <div class="card-block">
							
							<?php 
							if($this->session->userdata('message'))
							{ ?>
								<div class="alert alert-success">
								  <strong>Success!</strong> 
								  <?php 
								  echo $this->session->userdata('message'); 
								  $this->session->unset_userdata('message');
								  ?>
								</div>
							<?php
							}
							?>
							
                                <div class="table-responsive" id="task_table">
                                    <div class="col-md-6 col-4 align-self-center">
                                        <input type="text" class="search form-control" placeholder="What you looking for?">
                                    </div>
                                    <span class="counter pull-right"></span>
                                    <table class="table table-hover table-bordered results">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Employee Name</th>
                                                <th>Project Name</th>
                                                <th>Task Name</th>
												<th>Date</th>
												<!--<th>Start Time</th>
												<th>End Time</th>-->
												<th>Total Time</th>
                                                <th>Task Status</th>
                                                <th>Review Status</th>
                                                <th>Grade</th>
												<th>Action</th>
                                            </tr>
                                            <tr class="warning no-result">
                                              <td colspan="4"><i class="fa fa-warning"></i> No result</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php 
											$count = count($task_list); 
											if($count > 0)
											{
												$i = 1;
												foreach($task_list as $list)
												{

											?>  
                                            
                                            <tr id="trid_<?php echo $list->task_id; ?>" <?php if($list->notification_status ==0){ echo "style='background:#E1E1D2 !important;'"; } ?>>
											
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $list->name; ?></td>
                                                <td><?php echo $list->project_name; ?></td>
                                                <td><?php echo $list->task_name; ?></td>
												<td><?php $date = view_date_format($list->task_date);
														echo $date; ?></td>
												<?php /*?><td><?php echo $list->task_start_time; ?></td>
                                                <td><?php echo $list->task_end_time; ?></td><?php */?>
                                                <td><?php echo $list->calc_task_time; ?></td>
                                                <td><?php if($list->task_status==1){echo 'In Progress';} else { echo 'Finished'; } ?></td>
                                                
                                                <td><?php 
														if($list->manager_status==0){ echo 'Pending';} 
														elseif($list->manager_status==1){echo 'Waiting for approval';} 
														else{echo 'Approved';} 
													?>
                                                </td>
                                                <td><?php echo $list->manager_score.' /10'; ?></td>
                                                <td><a href="<?php echo base_url()."task/view_task/".$list->task_id; ?>">View</a>
                                                <?php 
												if($list->manager_status!=2)
												{ 
												?>
												<button type="button" data-id="<?php echo $list->task_id; ?>" class="review btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Remarks</button>
												<?php 
												}
												?></td>
												<?php /*?><?php 
												if($list->task_final_update == "0")
												{ 
												?>
												|<a href="<?php echo base_url()."task/update_task/".$list->task_id; ?>">Update</a></td>
												<?php 
												}
												?><?php */?>
												
												
                                            </tr>
												<?php 
													$i = $i + 1; 

												} 
												}
												else
												{ 
													echo "<tr><td colspan='9'>No Record Found!</td></tr>"; 
												} 
												?>
											
                                        </tbody>
                                    </table>
                                    <?php echo $pagination_link; ?>
                                </div>
								
								<script>
								
								time = new Date();
								
								//alert(time);
								
								</script>
								
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            

          <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Task Remarks</h4>
                </div>
                <div class="modal-body">
                <div id="feedback"></div>
                <form class="feedback" name="feedback" action="javascript:void(0);" method="POST">
                	<input type="hidden" name="task_id" id="task_id" value=""/>
                  	<div class="col-md-4 col-4 align-self-center">
                       <select class="form-control" name="manager_status" style="width: 300px;">
                         <option value="">Status</option>
                         <option value="0">Pending</option>
                         <option value="1">Waiting for Approval</option>
                         <option value="2">Approved</option>
                       </select>
                  	</div><br /><br />
                  	<div class="col-md-4 col-4 align-self-center">
                      <input type="text" class="form-control" name="grade" placeholder="Grade/Score" style="width: 300px;">
                	</div><br /><br />
                    <div class="col-md-4 col-4 align-self-center">
                        <button class="form-control btn-success" style="width: 220px;" name="remarks" id="remarks" value="" >Submit</button>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.reload()">Close</button>
                </div>
              </div>
              
            </div>
          </div><!--End Modal -->
            <!-- Modal Script -->
			<script>
				$(document).on("click", ".review", function () {
					 var taskId = $(this).data('id');
					 $(".modal-body #task_id").val( taskId );
				});
				
				$(document).ready(function(){
					$("button#remarks").click(function(){
						$.ajax({
							type: "POST",
							url: "<?php echo base_url()."task/ajax_task_remark"; ?>",
							data: $('form.feedback').serialize(),
							success: function(message){
								$("#feedback").html(message);
								//$("#myModal").modal('hide');
							}
						});
					});
				});
			</script><!--End-->
            
            <script>
				$(document).ready(function() {
				  $(".search").keyup(function () {
					var searchTerm = $(".search").val();
					var listItem = $('.results tbody').children('tr');
					var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
					
				  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
						return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
					}
				  });
					
				  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
					$(this).attr('visible','false');
				  });
				
				  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
					$(this).attr('visible','true');
				  });
				
				  var jobCount = $('.results tbody tr[visible="true"]').length;
					$('.counter').text(jobCount + ' item');
				
				  if(jobCount == '0') {$('.no-result').show();}
					else {$('.no-result').hide();}
						  });
				});
			</script>
            
           <!-- date range picker -->
			<script type="text/javascript">
				$(function() {
				
				  $('input[name="datefilter"]').daterangepicker({
					  autoUpdateInput: false,
					  locale: {
						  cancelLabel: 'Clear'
					  }
				  });
				
				  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
					  var dt = $(this).val(picker.startDate.format('DD/MM/YYYY') + '-' + picker.endDate.format('DD/MM/YYYY'));
					 // doSearch(dt);
					// get_dateWise_task_list(dt);
				  });
				
				  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
					  $(this).val('');
				  });
				
				});
			
			/*function get_ajax_task_list()
			{
				$.ajax({
					url: "<?php echo base_url()."task/ajax_task_list"; ?>",
					type: 'POST',
					success: function(data){
						console.log(data);
						if(data != '0'){
							$('#task_table').html(data);
						}
					}
				});
			}

				setTimeout(function(){
                    get_ajax_task_list();
                },3000);*/
				
			</script>
			
<?php include_once('include/footer.php'); ?> 