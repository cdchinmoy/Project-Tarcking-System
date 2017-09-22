<?php //echo "<pre>"; print_r($all_user_data); die; ?>
<?php include_once('include/header.php'); ?>

<?php include_once('include/sidebar.php'); ?>
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
                        <h3 class="text-themecolor m-b-0 m-t-0">Employee</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url()."dashboard"; ?>">Home</a></li>
                            <li class="breadcrumb-item active">Employee List</li>
                        </ol>
                    </div>
                    <?php /*?><div class="col-md-6 col-4 align-self-center">
                        <a href="<?php echo base_url()."employee/add_employee"; ?>" class="btn pull-right hidden-sm-down btn-success"> Add Employee</a>
                    </div><?php */?>
                    
                    
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
							/*
							if(isset($this->session->flshdata('success')) && $this->session->flshdata('success') = '1')
							{
								echo $this->session->flshdata('success');
							}
							*/
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
                                                <th>Employee Id</th>
                                                <th>Name</th>
                                                <th>Phone No</th>												
                                                <th>Email Id</th>												
                                                <th>User Type</th>
												<th>Action</th>
                                            </tr>
                                            <tr class="warning no-result">
                                              <td colspan="4"><i class="fa fa-warning"></i> No result</td>
                                            </tr>
                                        </thead>
                                        <tbody>										
										<?php 	
										$i = 1;	
										foreach($all_user_data as $user_data)										
										{ 
																					
										?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $user_data->employee_id; ?></td>												
												<td><?php echo $user_data->name; ?></td>
                                                <td><?php if(!$user_data->phone_no){ echo "N/A"; }else{ echo $user_data->phone_no; } ?></td>
                                                <td><?php echo $user_data->user_email; ?></td>												
												<td>												
												<?php												
												if($user_data->user_type == 2){ echo "Sub Admin"; }												
												if($user_data->user_type == 3){ echo "Employee"; }
												if($user_data->user_type == 4){ echo "HR Admin"; }												
												?>												
												</td>
												<td>												
												<a href="<?php echo base_url().'employee/view_employee/'.$user_data->user_id; ?>">View</a><?php /*?>&nbsp;												
												<a href="<?php echo base_url()."pts/dashboard/delete_employee"; ?>">Delete</a><?php */?>												
												</td>
                                            </tr>
                                        <?php 										
										$i = $i + 1;	
											
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
			
<?php include_once('include/footer.php'); ?> 