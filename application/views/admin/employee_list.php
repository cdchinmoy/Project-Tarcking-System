<?php //echo "<pre>"; print_r($all_user_data); die; ?><?php include_once('include/header.php'); ?>

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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
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
							
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Employee Id</th>
                                                <th>Name</th>
                                                <th>Phone No</th>												<th>Email Id</th>												<th>User Type</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>										
										<?php 	
										$i = 1;	
										foreach($all_user_data as $user_data)										
										{ 
											if($user_data->user_type == 3){											
										?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $user_data->employee_id; ?></td>												
												<td><?php echo $user_data->name; ?></td>
                                                <td><?php if(!$user_data->phone_no){ echo "N/A"; }else{ echo $user_data->phone_no; } ?></td>
                                                <td><?php echo $user_data->user_email; ?></td>												
												<td>												
												<?php 												
												/*if($user_data->user_type == 1){ echo "Super Admin"; }												
												if($user_data->user_type == 2){ echo "Sub Admin"; }*/												
												/*if($user_data->user_type == 3){ */echo "Employee"; //}																								
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
										} 										
										?>
                                        </tbody>
                                    </table>
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
			
<?php include_once('include/footer.php'); ?> 