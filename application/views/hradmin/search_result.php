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
			<h3 class="text-themecolor m-b-0 m-t-0">Search</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
				<li class="breadcrumb-item active"><b>Searched Results for keyword '<?php if(!empty($keyword)){ echo $keyword;} ?>'</b></li>
			</ol>
		</div>

	</div>
      
<div class="row">  
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block" style="/*text-align:center;*/ ">
               <h4 class="card-title">Projects List</h4>
                   <div class="table-responsive m-t-40">
						<table class="table stylish-table">
							<thead>
								<tr>
									<th>#</th>
                                    <th colspan="2">Project Name</th>
                                    <!--<th>Project Name</th>-->
                                    <!--<th>Project Type</th>-->
                                    <th>Project Valueation</th>
                                    <th>Project Deadline</th>
                                    <th>Action</th>
								</tr>
							</thead>
							<tbody>
                            <?php 
								$count = count($project_list);
								if($count > 0)
								{
									$i = 1;
									foreach($project_list as $project_data)
									{
									?>
								<tr>
                                	<td><?php echo $i ?></td>
									<td style="width:30px;"><span class="round"><?php echo substr($project_data->project_name, 0, 1); ?></span></td>
                                    <td><h6><?php echo $project_data->project_name; ?></h6></td>
									<td><?php echo $project_data->project_valueation; ?></td>
									<td><?php $date = view_date_format($project_data->project_deadline);
														echo $date; ?></td>
                              		<td><?php echo "<a href='".base_url()."project/project_details/".$project_data->project_id."'>View</a>"; ?></td>
								</tr>
								<!--<tr class="active">
									<td>2</td>
									<td style="width:30px;"><span class="round">B</span></td>
                                    <td><h6>Bus Ticket Booking</h6></td>
									<td>5000</td>
									<td>25/09/2017</td>
                                    <td><a href="">View</a></td>
								</tr>-->
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
                          </div>
            </div>
        </div>
    </div>
</div>
        
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block" style="/*text-align:center; */">
                <h4 class="card-title">Employee List</h4>
                    <div class="table-responsive m-t-40">
						<table class="table stylish-table">
							<thead>
								<tr>
									<th>#</th>
                                    <th colspan="2">Employee Name</th>
                                   <!-- <th>Employee Name</th>-->
                                    <!--<th>Project Type</th>-->
                                    <th>Employee ID</th>
                                    <th>User Type</th>
                                    <th>Action</th>
								</tr>
							</thead>
							<tbody>
                            <?php 
								$count = count($employee_list);
								if($count > 0)
								{
									$i = 1;
									foreach($employee_list as $user_data)
									{
									?>
								<tr>
                                	<td><?php echo $i ?></td>
									<td><span class="round"><img src="<?php echo base_url(); ?>assets/upload/profile_image/<?php if(!empty($user_data->user_iamge)){ echo $user_data->user_iamge; }else {?>noimage.png<?php } ?>" alt="user" width="50" /></span></td>
									<td>
										<h6><?php echo $user_data->name; ?></h6><small class="text-muted">Web Designer</small></td>
                                    <td><?php echo $user_data->employee_id; ?></td>
									<td><?php 												
												if($user_data->user_type == 1){ echo "Super Admin"; }												
												if($user_data->user_type == 2){ echo "Sub Admin"; }												
												if($user_data->user_type == 3){ echo "Employee"; }																								
												?>	</td>
									<td><a href="<?php echo base_url().'employee/view_employee/'.$user_data->user_id; ?>">View</a></td>
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
                          </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-block" style="/*text-align:center; */">
                    <h4 class="card-title">Tasks List</h4>
                    <div class="table-responsive m-t-40">
						<table class="table stylish-table">
							<thead>
								<tr>
									<th>#</th>
                                    <th colspan="2">Task Name</th>
                                   <!-- <th>Employee Name</th>-->
                                    <!--<th>Project Type</th>-->
                                    <th>Date</th>
                                    <th>Status</th>
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
                                	<td><?php echo $i; ?></td>
									<td style="width:50px;"><span class="round"><?php echo substr($list->task_name, 0, 1); ?></span></td>
                                    <td>
										<h6><?php echo $list->task_name; ?></h6><small class="text-muted"><?php echo $list->project_name; ?></small></td>
									<td><?php $date = view_date_format($list->task_date);
														echo $date; ?></td>
									<td><?php if($list->task_status==1){echo 'In Progress';} else { echo 'Finished'; } ?></td>
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
                          </div>
                </div>
            </div>
        </div>
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
<!-- footer -->
<!-- ============================================================== -->
			
<?php include_once('include/footer.php'); ?> 