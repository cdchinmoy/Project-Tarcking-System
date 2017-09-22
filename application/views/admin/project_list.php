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
                    <div class="col-md-8 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Project</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url()."dashboard"; ?>">Home</a></li>
                            <li class="breadcrumb-item active">Project List</li>
                        </ol>
                    </div>
					
                    <?php /*?><div class="col-md-2 col-2 align-self-center">
                        <a href="<?php echo base_url()."project/add_project"; ?>" class="btn pull-right hidden-sm-down btn-success"> Add Project</a>
                    </div>
					
                    <div class="col-md-2 col-2 align-self-center">
						<a href="<?php echo base_url()."project/assign_project"; ?>" class="btn pull-right hidden-sm-down btn-success"> Assign Project</a>
                    </div>	<?php */?>
                    <br />
                    <div class="col-md-6 col-4 align-self-center">
                        <input type="text" class="search form-control" placeholder="What you looking for?">
                    </div>
                    <span class="counter pull-right"></span>				
					
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
                                    <table class="table table-hover table-bordered results">
                                        
										<thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Project Name</th>
												<th>Project Type</th>
                                                <th>Project Valueation</th>
                                                <th>Project Deadline</th>
												<th>Action</th>
                                            </tr>
                                            <tr class="warning no-result">
                                              <td colspan="4"><i class="fa fa-warning"></i> No result</td>
                                            </tr>
                                        </thead>
										
                                        <tbody>
										<?php 
										$count = count($all_project_data);
										if($count > 0)
										{
											$i = 1;
											foreach($all_project_data as $project_data)
											{
											?>
												<tr <?php if($project_data->notification_status ==0){ echo "style='background:#E1E1D2 !important;'"; } ?>>
													<td><?php echo $i; ?></td>
													<td><?php echo $project_data->project_name; ?></td>
													<td><?php echo $project_data->project_total_manhour; ?></td>
													<td><?php echo $project_data->project_valueation; ?></td>
													<td><?php $date = view_date_format($project_data->project_deadline);
														echo $date; ?></td>
													<td><?php echo "<a href='".base_url()."project/project_details/".$project_data->project_id."'>View Details</a>"; ?></td>
												</tr>
											<?php 
											$i = $i + 1;
											}
										} 
										else
										{	
											echo "<tr><td colspan='5'>";
											echo "No Project Found!";
											echo "</tr></td>";
										}
										?>
										</tbody>
                                    </table>
                                    <?php echo $pagination_link; ?>
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
            <script>
				/*function get_ajax_project_list()
				{
					$.ajax({
						url: "<?php echo base_url()."project/ajax_project_list"; ?>",
						type: 'POST',
						success: function(data){
							console.log(data);
							$('#task_table').html(data);
						}
					});
				}

				setTimeout(function(){
					get_ajax_project_list();
				},5000);*/
			</script>
			
<?php include_once('include/footer.php'); ?> 