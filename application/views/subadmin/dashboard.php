<?php //echo "<pre>";print_r($user_details); die; ?><?php include_once('include/header.php'); ?>

<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->
<?php include_once('include/sidebar.php'); ?>
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
			<h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
				<li class="breadcrumb-item active">Dashboard</li>
			</ol>
		</div>

	</div>

<div class="row">
		<div class="col-sm-4">
			<div class="card">
				<div class="card-block" style="text-align:center; ">
                 <center><div style="color:#903; font-size:24px; font-weight:bolder; margin-bottom:30px; background-color:#0FC; width:80%; box-shadow: 10px 10px 5px #999;">
                Task Notification
                </div></center>
                <div id="tasks_notify">
                	<?php if($task > 0){ echo '<center><a href="task/task_list" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$task.'</div></a></center>' ; } else { echo '<center><div align="center" style="background-color:red; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">0</div></center>'; } ?>
                </div>
                <div>
                	New Notification
                </div>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
			<div class="card">
				<div class="card-block" style="text-align:center; ">
                <center><div style="color:#903; font-size:24px; font-weight:bolder; margin-bottom:30px; background-color:#0FC; width:80%; box-shadow: 10px 10px 5px #999;">
                    	Project Notification
                    </div></center>
                	<div id="projects_notify">
					<?php if($projects > 0){ echo '<center><a href="project/project_list" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$projects.'</div></a></center>' ; } else { echo '<center><div align="center" style="background-color:red; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">0</div></center>'; } ?>
                    </div>
                <div>
                 New Notification
                </div>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
			<div class="card">
				<div class="card-block" style="text-align:center; ">
                <center><div style="color:#903; font-size:24px; font-weight:bolder; margin-bottom:30px; background-color:#0FC; width:80%; box-shadow: 10px 10px 5px #999;">
                    	General Notification
                    </div></center>
                	<div id="general_notify">
					<?php if($general > 0){ echo '<center><a href="notice/notice_board" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$general.'</div></a></center>' ; } else { echo '<center><div align="center" style="background-color:red; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">0</div></center>'; } ?>
                    </div>
                <div>
                 New Notification
                </div>
                </div>
            </div>
        </div>
        
</div>

<div class="row">
	<div class="col-sm-4">
		<div class="card">
			<div class="card-block" style="text-align:center; ">
			<center><div style="color:#903; font-size:24px; font-weight:bolder; margin-bottom:30px; background-color:#0FC; width:80%; box-shadow: 10px 10px 5px #999;">
					Warning Notification
				</div></center>
				<div id="warning_notify">
				<?php if($warning > 0){ echo '<center><a href="document/documents" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$warning.'</div></a></center>' ; } else { echo '<center><div align="center" style="background-color:red; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">0</div></center>'; } ?>
				</div>
			<div>
			 New Notification
			</div>
			</div>
		</div>
	</div>
	
	<div class="col-sm-4">
		<div class="card">
			<div class="card-block" style="text-align:center; ">
			<center><div style="color:#903; font-size:24px; font-weight:bolder; margin-bottom:30px; background-color:#0FC; width:80%; box-shadow: 10px 10px 5px #999;">
					Review Notification
				</div></center>
				<div id="review_notify">
				<?php if($review > 0){ echo '<center><a href="document/documents" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$review.'</div></a></center>' ; } else { echo '<center><div align="center" style="background-color:red; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">0</div></center>'; } ?>
				</div>
			<div>
			 New Notification
			</div>
			</div>
		</div>
	</div>
	
	<div class="col-sm-4">
		<div class="card">
			<div class="card-block" style="text-align:center; ">
			<center><div style="color:#903; font-size:24px; font-weight:bolder; margin-bottom:30px; background-color:#0FC; width:80%; box-shadow: 10px 10px 5px #999;">
					Pay-slip Notification
				</div></center>
				<div id="pay_notify">
				<?php if($payslip > 0){ echo '<center><a href="document/documents" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$payslip.'</div></a></center>' ; } else { echo '<center><div align="center" style="background-color:red; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">0</div></center>'; } ?>
				</div>
			<div>
			 New Notification
			</div>
			</div>
		</div>
	</div>
	
</div>

<!-- Row Last 10 Projects-->
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-block">
					<!--<select class="custom-select pull-right">
						<option selected>January</option>
						<option value="1">February</option>
						<option value="2">March</option>
						<option value="3">April</option>
					</select>-->
					<h4 class="card-title" style="float:left">Projects of the Month</h4>
					<div class="table-responsive m-t-40">
						<table class="table stylish-table">
							<thead>
								<tr>
									<th colspan="2">Name</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Budget</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								 <?php 
								$count = count($project_list); 
								if($count > 0)
								{
									$i = 1;
									foreach($project_list as $list)
									{
								?>  
								<tr>
                                	
									<td style="width:50px;"><span class="round"><?php echo substr($list->project_name, 0, 1); ?></span></td>
                                    <td>
										<h6><?php echo $list->project_name; ?></h6></td>
									<td><?php $date = view_date_format($list->project_start);
														echo $date; ?></td>
									<td><?php $date = view_date_format($list->project_deadline);
														echo $date; ?></td>
														<td>
										<h6>$<?php echo $list->project_valueation; ?></h6></td>
                                    <td><a href="<?php echo base_url()."project/project_details/".$list->project_id; ?>">View</a></td>
								</tr>
                                <?php $i = $i + 1; 
										} 
									}
									else{ 
										echo "<tr><td colspan='9'>No Record Found!</td></tr>"; 
									} ?>
								
							</tbody>
						</table>
						<a href="<?php echo base_url()."project/project_list"; ?>" class="btn pull-right hidden-sm-down btn-success" style="margin-right:55px;"> View All</a>
					</div>
					
				</div>

			</div>
		</div>
	</div><!-- End of Projects-->
	
<!-- Row Todays Tasks-->
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-block">
					<!--<select class="custom-select pull-right">
						<option selected>January</option>
						<option value="1">February</option>
						<option value="2">March</option>
						<option value="3">April</option>
					</select>-->
					<h4 class="card-title" style="float:left">Recent Tasks</h4>
					<div class="table-responsive m-t-40">
						<table class="table stylish-table">
							<thead>
								<tr>
									<th colspan="2">Task Name</th>
									<th>Employee</th>
									<th>Date</th>
									<th>Time</th>
									<th>Action</th>
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
								<tr>
                                	
									<td style="width:50px;"><span class="round"><?php echo substr($list->task_name, 0, 1); ?></span></td>
                                    <td>
										<h6><?php echo $list->task_name; ?></h6><small class="text-muted"><?php echo $list->project_name; ?></small></td>
									<td><?php echo $list->name; ?></td>
									<td><?php $date = view_date_format($list->task_date);
														echo $date; ?></td>
														<td>
										<h6><?php echo $list->calc_task_time; ?></h6></td>
                                    <td><a href="<?php echo base_url()."task/view_task/".$list->task_id; ?>">View</a></td>
								</tr>
                                <?php $i = $i + 1; 
										} 
									}
									else{ 
										echo "<tr><td colspan='9'>No Record Found!</td></tr>"; 
									} ?>
								
							</tbody>
						</table>
						<a href="<?php echo base_url()."task/task_list"; ?>" class="btn pull-right hidden-sm-down btn-success" style="margin-right:55px;"> View All</a>
					</div>
					
				</div>

			</div>
		</div>
	</div><!-- End of Tasks-->


<?php /* ?>
	<!-- Row -->
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-block">
					<select class="custom-select pull-right">
						<option selected>January</option>
						<option value="1">February</option>
						<option value="2">March</option>
						<option value="3">April</option>
					</select>
					<h4 class="card-title">Projects of the Month</h4>
					<div class="table-responsive m-t-40">
						<table class="table stylish-table">
							<thead>
								<tr>
									<th colspan="2">Assigned</th>
									<th>Name</th>
									<th>Budget</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="width:50px;"><span class="round">S</span></td>
									<td>
										<h6>Sunil Joshi</h6><small class="text-muted">Web Designer</small></td>
									<td>Elite Admin</td>
									<td>$3.9K</td>
								</tr>
								<tr class="active">
									<td><span class="round"><img src="<?php echo base_url(); ?>assets/images/users/2.jpg" alt="user" width="50" /></span></td>
									<td>
										<h6>Andrew</h6><small class="text-muted">Project Manager</small></td>
									<td>Real Homes</td>
									<td>$23.9K</td>
								</tr>
								<tr>
									<td><span class="round round-success">B</span></td>
									<td>
										<h6>Bhavesh patel</h6><small class="text-muted">Developer</small></td>
									<td>MedicalPro Theme</td>
									<td>$12.9K</td>
								</tr>
								<tr>
									<td><span class="round round-primary">N</span></td>
									<td>
										<h6>Nirav Joshi</h6><small class="text-muted">Frontend Eng</small></td>
									<td>Elite Admin</td>
									<td>$10.9K</td>
								</tr>
								<tr>
									<td><span class="round round-warning">M</span></td>
									<td>
										<h6>Micheal Doe</h6><small class="text-muted">Content Writer</small></td>
									<td>Helping Hands</td>
									<td>$12.9K</td>
								</tr>
								<tr>
									<td><span class="round round-danger">N</span></td>
									<td>
										<h6>Johnathan</h6><small class="text-muted">Graphic</small></td>
									<td>Digital Agency</td>
									<td>$2.6K</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php */ ?>
	<!-- Row -->
	<!-- ============================================================== -->
	<!-- End PAge Content -->
	<!-- ============================================================== -->
</div>

<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
			
<?php include_once('include/footer.php'); ?> 