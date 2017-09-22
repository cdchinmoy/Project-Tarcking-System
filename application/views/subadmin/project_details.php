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
                        <h3 class="text-themecolor m-b-0 m-t-0">Projects</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url()."dashboard"; ?>">Home</a></li>
                            <li class="breadcrumb-item active">Project Details</li>
                        </ol>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                        <a href="<?php echo base_url()."project/project_list"; ?>" class="btn pull-right hidden-sm-down btn-success"> Project List</a>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">

                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">

                            <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                           
										    <tr>
                                                <td style="width: 30%; font-weight:bold; padding:20px 0 20px 30px;">Project Name</td>
												<td style="padding:20px 0 20px 50px;"><?php echo $project_details[0]->project_name; ?></td>
                                            </tr>

											<tr>
                                                <td style="width: 30%; font-weight:bold; padding:20px 0 20px 30px;">Project Description</td>
												<td style="padding:20px 15px 20px 50px;" align="justify"><?php echo $project_details[0]->project_description; ?></td>
                                            </tr>
                                            
										    <tr>
                                                <td style="width: 30%; font-weight:bold;padding:20px 0 20px 30px;">Total Manhour</td>
												<td style="padding:20px 0 20px 50px;"><?php echo $project_details[0]->project_total_manhour." HR"; ?></td>
                                            </tr>
											
										    <tr>
                                                <td style="width: 30%; font-weight:bold;padding:20px 0 20px 30px;">Project Valuation</td>
												<td style="padding:20px 0 20px 50px;"><?php echo $project_details[0]->project_valueation; ?></td>
                                            </tr>

										    <tr>
                                                <td style="width: 30%; font-weight:bold;padding:20px 0 20px 30px;">Project Start Date</td>
												<td style="padding:20px 0 20px 50px;"><?php 
												$date = view_date_format($project_details[0]->project_start);
												echo $date; ?></td>
                                            </tr>

										    <tr>
                                                <td style="width: 30%; font-weight:bold;padding:20px 0 20px 30px;">Project End Date</td>
												<td style="padding:20px 0 20px 50px;"><?php 
												$date = view_date_format($project_details[0]->project_deadline);
												echo $date; ?></td>
                                            </tr>

										    <tr>
                                                <td style="width: 30%; font-weight:bold; padding:20px 0 20px 30px;">Project Priroty</td>
												<td style="padding:20px 0 20px 50px;"><?php if($project_details[0]->project_priroty==1){echo "High";}
																							if($project_details[0]->project_priroty==2){echo "Medium";}
																							if($project_details[0]->project_priroty==3){echo "Low";}
																					?></td>
                                            </tr>
											
										    <tr>
                                                <td style="width: 30%; font-weight:bold;padding:20px 0 20px 30px;">Project Status</td>
												<td style="padding:20px 0 20px 50px;"><?php if($project_details[0]->project_status==1){echo "Finished";}
																							if($project_details[0]->project_status==2){echo "Ongoing";}
																							if($project_details[0]->project_status==3){echo "Cancelled";}
																					?></td>
                                            </tr>											
											
                                        </tbody>
                                    </table>
                                </div>
								
                        </div>
                    </div>
					
					
					<div class="col-lg-4 col-xlg-9 col-md-7">
                        <div class="card">

                            <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
											<thead>
											<tr>
												<td style="text-align:center;" colspan="2">
													<h2>Project Members</h2>
												</td>
											</tr>
											</thead>
											
											<?php if($assigned_employee){ ?>
											
											<tr>
											<td style="padding-left:20px;">
												<?php if($manager_details[0]->user_iamge){ ?>
												<img style="width: 40px;border-radius: 100%;" src='<?php echo base_url()."assets/upload/profile_image/".$manager_details[0]->user_iamge; ?>'>
												<?php }else{ ?>
												<img style="width: 40px;border-radius: 100%;" src='<?php echo base_url()."assets/upload/profile_image/noimage.png" ?>'>												
												<?php } ?>
												</td>
											<td style="padding-top: 15px;">
											<?php echo $manager_details[0]->name." - <b>Project Manager</b>"; ?>
											</td>
											</tr>
											
                                           <?php foreach($assigned_employee as $employee){ ?>
										    <tr>
												
                                                <td style="padding-left:20px;">
												<?php if($employee->user_iamge){ ?>
												<img style="width: 40px;border-radius: 100%;" src='<?php echo base_url()."assets/upload/profile_image/".$employee->user_iamge; ?>'>
												<?php }else{ ?>
												<img style="width: 40px;border-radius: 100%;" src='<?php echo base_url()."assets/upload/profile_image/noimage.png" ?>'>												
												<?php } ?>
												</td>
												
												<td style="padding-top: 20px;"><?php echo $employee->name; ?> - <?php echo $employee->department_name; ?></td>
												
                                            </tr>
										   <?php } ?>
										   
											<?php }else{ echo "<tr><td style='text-align:center;'>No Record Found!</td></tr>"; } ?>
											
                                        </tbody>
                                    </table>
                                </div>
								
                        </div>
                    </div>
					
					
					
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
	
			
<?php include_once('include/footer.php'); ?> 