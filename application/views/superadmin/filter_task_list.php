<?php //echo "<pre>"; print_r($user_details); die; ?>

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
                        <a href="<?php echo base_url()."task/task_list"; ?>" class="btn pull-right hidden-sm-down btn-success"> Task List</a>
                    </div>
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
                        
                        
                        <div class="card-block" >
                        
                        
                        <?php echo form_open('task/filter_task_list',array('class' => '','id'=>'task_list')); ?>
                        
                  			<div class="" id="task_table" style="float:left;">
                                <div class="col-md-3 col-4 align-self-center">
                                    <input type="text" class="form-control" name="datefilter" placeholder="Date" style="width: 190px;">
                            </div>
                            </div>
                            <div class="" id="task_table" style="float:left;">
                                <div class="col-md-3 col-4 align-self-center">
                                     <select class="form-control" name="employee_id" style="width: 180px;">
                                        <option value="">Employee Name</option>
                                       <?php 
                                       $count = count($employee_list);
                                       if($count > 0)
                                       {
                                           foreach($employee_list as $list)
                                           { 
                                                if($list->user_type != 1){
                                           ?>
                                                <option value="<?php echo $list->user_id; ?>"><?php echo $list->name; ?></option>
                                           <?php 
                                                }
                                           } 
                                       }
                                       ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="" id="task_table" style="float:left;">
                                <div class="col-md-3 col-4 align-self-center">
                                    <select class="form-control" name="project_id" style="width: 230px;">
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
							
                            <div class="" id="task_table" style="float:left;">
                                <div class="col-md-3 col-4 align-self-center">
                                    <input type="submit" class="form-control btn-success" style="width: 80px;" name="search" value="Filter" >
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
                                    <table class="table table-hover table-bordered results" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Employee Name</th>
                                                <th>Project Name</th>
                                                <th>Task Name</th>
												<th>Date</th>
												
												<th>Total Time(Hr)</th>
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
                                            
                                            <tr <?php //if($list->notification_status ==0){ echo "style='background:#0F9 !important;'"; } ?>>
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
                                                <td><a class="view" href="<?php echo base_url()."task/view_task/".$list->task_id; ?>">View</a>&nbsp;|&nbsp;<a class="delete" href="<?php echo base_url()."task/delete_task/".$list->task_id; ?>">Delete</a></td>
                                            </tr>
												<?php $i = $i + 1; } }else{ echo "<tr><td colspan='9'>No Record Found!</td></tr>"; } ?>
											
                                        </tbody>
                                    </table>
                                    
									<?php //echo $pagination_link; ?>
									
                                </div>
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
      
	  
				function doSearch(dt) {
					var frs = dt.val();
					var fr = frs.split("-");
					var d1 = fr[0].split("/");
					console.log(d1.toString());
					var d2 = fr[1].split("/");
					console.log(d2);
					var from = new Date(d1[2], d1[1]-1, d1[0]);  
					var to   = new Date(d2[2], d2[1]-1, d2[0]);
					console.log(from);
					console.log(to);
					
					
					var targetTable = document.getElementById('datatable');
					//alert(targetTable);
					console.log(targetTable.rows.length);
					var targetTableColCount;
					for (var rowIndex = 0; rowIndex < targetTable.rows.length; rowIndex++) {
						var rowData = [];
						if (rowIndex == 0) {
							targetTableColCount = targetTable.rows.item(rowIndex).cells.length;
							continue; 
						}
						if (rowIndex == 1) {
							continue; 
						}
						console.log(targetTableColCount);
						for (var colIndex = 0; colIndex < targetTableColCount; colIndex++) {
							rowData.push(targetTable.rows.item(rowIndex).cells.item(colIndex).textContent);
							//console.log(rowData);
						}
						console.log(rowData);
						
						var c = rowData[4].toString().split("/");
						console.log(c);
						var check = new Date(c[2], c[1]-1, c[0]);
						console.log(check);
						
						if ((check >= from) && (check <= to))
								targetTable.rows.item(rowIndex).style.display = 'table-row';
							else
								targetTable.rows.item(rowIndex).style.display = 'none'; 
						
						/*for(var i=0;i<rowData.length;i++){
							var c = rowData[4].toString().split("/");
							alert(c);
							var check = new Date(c[2], c[1]-1, c[0]);
							alert(check);
							if ((check >= from) && (check <= to))
								targetTable.rows.item(rowIndex).style.display = 'table-row';
							else
								targetTable.rows.item(rowIndex).style.display = 'none';                    
						}*/
			
					}
				}
			</script><!-- end search -->
            
			 <script>
				function msg(){
					var r = confirm('Are you sure to delete selected tasks?');
					if(r){
						window.location.href ="<?php echo base_url(); ?>task/delete_task/<?php echo $list->task_id; ?>";
					}
					else {
						window.location.href ="<?php echo base_url(); ?>task/task_list";
					}
				}

			
			function get_ajax_task_list()
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
                },3000);
				
				
			function get_dateWise_task_list(dt){
				var frs = dt.val();
				var fr = frs.split("-");
				var d1 = fr[0].split("/");
				console.log(d1.toString());
				var d2 = fr[1].split("/");
				$.post('<?php echo base_url()."task/dateWise_task_list"; ?>', { field1: "hello", field2 : "hello2"}, 
					function(returnedData){
						 console.log(returnedData);
						 $('#task_table').html(returnedData);
				});
			}
			</script>
            
            
            
<?php include_once('include/footer.php'); ?> 