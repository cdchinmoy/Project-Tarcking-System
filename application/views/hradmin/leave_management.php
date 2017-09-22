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
			<h3 class="text-themecolor m-b-0 m-t-0">Leave Management</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
				<li class="breadcrumb-item active">Leaves</li>
			</ol>
		</div>
		<div class="col-md-6 col-4 align-self-center">
		<!--<button type="button" name="my_leaves" data-toggle="collapse" data-target="#my_leaves" onclick="toggler(this)" class="btn btn-primary pull-right ">My Leaves</button>-->  
            <button name="add_leave" type="button" id="add_leave" class="btn pull-right hidden-sm-down btn-success" data-toggle="modal" data-target="#leaveModal">Apply New</button>
        </div>
		
	</div>
	
	<!-- Notice Modal -->
<div class="modal fade" id="leaveModal" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">

	  <!-- Modal content-->
	  <div class="modal-content" id="leaveModal_div">
		<div class="modal-header">
		  <h4 class="modal-title">Leave Application</h4>
		</div>
		<div class="modal-body">
		<div id="feedbackleave_msg"></div>
		<form class="feedbackleave" id="feedbackleave" name="feedbackleave" action="javascript:void(0);" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id = get_user_id(); ?>"/>
			
			<!--<div class="col-md-4 col-4 align-self-center">
			  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" style="width: 300px;">
			</div><br />-->
			<label for="heading" ><h5>Please Apply Below: </h5><h6><p>(Note: all fields are required except attachment)</p></h6></label><hr><br>
			
			<div class="col-md-4 col-4 align-self-center">
			  <textarea class="form-control" name="message" id="message" placeholder="Type your message..." style="width: 300px;" rows="5"></textarea>
			</div><br />
			
			<div class="col-md-4 col-4 align-self-center">
			   <select class="form-control" name="leave_type" style="width: 300px;" id="leave_type">
				 <option value="">Select Leave Type</option>
				 <option value="CL">CL</option>
				 <option value="PL">PL</option>
				 <option value="SL">SL</option>
			   </select>
			</div><br />
			
			<div class="col-md-4 col-4 align-self-center">
			  <input type="text" class="form-control" name="s_date" id="s_date" placeholder="Start Date" style="width: 300px;">
			</div><br />
			
			<div class="col-md-4 col-4 align-self-center">
			  <input type="text" class="form-control" name="e_date" id="e_date" placeholder="End Date" style="width: 300px;">
			</div><br />
			
			<div class="col-md-4 col-4 align-self-center">
			 <input type="file" class="form-control" name="userfile" id="userfile" style="width: 300px;">
			  
			</div><br />
			
			<div class="col-md-4 col-4 align-self-center">
				<button class="form-control btn-success" style="width: 220px;" name="apply_leaves" id="apply_leaves" value="" >Apply</button>
				<!--<input type="submit" class="form-control btn-success" style="width: 220px;"  name="publish_general" value="Publish" id="publish_general">-->
			</div>
			<br><span id="response"></span>
		</form>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.reload()">Close</button>
		</div>
	  </div>
	  
	</div>
</div><!--End Modal -->

<div class="card">	
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'all_leave')" id="defaultOpen">User Leaves</button>
  <button class="tablinks" onclick="openCity(event, 'myleave')">My Leaves</button>
</div>
<div id="all_leave" class="tabcontent">
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-block">
			<h4 class="card-title" style="float:left">Casual Leaves</h4>&nbsp;&nbsp;&nbsp;<!--<button name="add_general" type="button" id="add_general" class="btn hidden-sm-down btn-success add_general" style="font-size:11px;" data-toggle="modal" data-target="#generalModal">Add New</button>-->
				<button type="button" class="btn btn-info pull-right" data-toggle="collapse" data-target="#casual" onclick="toggler(this)" id="casual_btn">+</button>
				  <div id="casual" class="collapse">
					<div class="table-responsive m-t-40">
						<table class="table stylish-table">
							<thead>
								<tr>
									<th>Name</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Status</th>
									<th><center>Action</center></th>
								</tr>
							</thead>
							<tbody id="casual_leave_cont">
							<?php //$task_list = get_main_task_list_by_id($list->project_id); 
									$count = count($casual_leave);
									if($count > 0){
										foreach($casual_leave as $casual){
							 ?>
								<tr>
									<td width="350px"><h5><?php echo $casual->name; ?></h5><small><?php if($casual->employee_designation == 1){echo 'Project Manager';}
																										if($casual->employee_designation == 2){echo 'Employee';}
																										if($casual->employee_designation == 3){echo 'HR Manager';}
																								?></small></td>
									<td><?php $s_date = view_date_format($casual->leave_start_date);
													echo $s_date; ?></td>
									<td><?php $e_date = view_date_format($casual->leave_end_date);
													echo $e_date; ?></td>
									<td>
										<?php 
											if( $casual->leave_status==0){echo 'Pending';}
											if( $casual->leave_status==1){echo 'Approved';}
											if( $casual->leave_status==2){echo 'Declined';}
										?>
									</td>
									<td>
										<button name="casual_view" id="casual_view" data-id="<?php echo $casual->name ?>" data-name-id="<?php echo $casual->leave_type ?>" data-msg-id="<?php echo $casual->leave_description ?>" data-sdate-id="<?php echo $s_date ?>" data-edate-id="<?php echo $e_date ?>" data-days-id="<?php echo $casual->leave_total_days ?>" data-file-id="<?php echo $casual->leave_attachment ?>" data-type-id="Casual Leave Application" class="g_view btn btn-success" data-toggle="modal" data-target="#viewModal">View</button>
										<a href="<?php echo base_url()."leaves/delete_leave/".$casual->leave_id; ?>"><button name="delete_casual" id="delete_casual" class="btn hidden-sm-down btn-danger">Delete</button></a>
										<?php if($casual->leave_status==0){ ?><a href="<?php echo base_url()."leaves/approve_leave/".$casual->leave_id; ?>"><button name="approve_casual" id="approve_casual" class="btn hidden-sm-down btn-prime">Approve</button></a>
										<!--<a href="<?php //echo base_url()."leaves/decline_leave/".$casual->leave_id; ?>">--><button name="decline_casual" id="decline_casual" class="d_note btn hidden-sm-down btn-primary" data-id="<?php echo $casual->leave_id ?>" data-toggle="modal" data-target="#declineModal">Decline</button>
										<?php }?>
									</td>
								</tr>
								<?php
										}
									}
									else
									{ 
										echo "<tr><td colspan='9'>No Record Found!</td></tr>"; 
									} 
									?>
									
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
 </div>
 

 
 <div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-block">
			<h4 class="card-title" style="float:left">Paid Leaves</h4>&nbsp;&nbsp;&nbsp;<!--<button name="add_warning" type="button" id="add_warning" class="btn hidden-sm-down btn-success" style="font-size:11px;" data-toggle="modal" data-target="#warningModal">Add New</button>-->
				<button type="button" class="btn btn-info pull-right" data-toggle="collapse" data-target="#paid" onclick="toggler(this)" id="paid_btn">+</button>
				  <div id="paid" class="collapse">
					<div class="table-responsive m-t-40">
						<table class="table stylish-table">
							<thead>
								<tr>
									<th>Name</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Status</th>
									<th><center>Action</center></th>
								</tr>
							</thead>
							<tbody id="paid_leave_cont">
							<?php //$task_list = get_main_task_list_by_id($list->project_id); 
									$count = count($paid_leave);
									if($count > 0){
										foreach($paid_leave as $paid){
							 ?>
								<tr>
									<td width="350px"><h5><?php echo $paid->name; ?></h5><small><?php if($paid->employee_designation == 1){echo 'Project Manager';}
									if($paid->employee_designation == 2){echo 'Employee';}
									if($paid->employee_designation == 3){echo 'HR Manager';}
							?></small></td>
									<td><?php $s_date = view_date_format($paid->leave_start_date);
													echo $s_date; ?></td>
									<td><?php $e_date = view_date_format($paid->leave_end_date);
													echo $e_date; ?></td>
									<td>
										<?php 
											if( $paid->leave_status==0){echo 'Pending';}
											if( $paid->leave_status==1){echo 'Approved';}
											if( $paid->leave_status==2){echo 'Declined';}
										?>
									</td>
									<td>
										<button name="paid_view" id="paid_view" data-id="<?php echo $paid->name ?>" data-name-id="<?php echo $paid->leave_type ?>" data-msg-id="<?php echo $paid->leave_description ?>" data-sdate-id="<?php echo $s_date ?>" data-edate-id="<?php echo $e_date ?>" data-days-id="<?php echo $paid->leave_total_days ?>" data-file-id="<?php echo $paid->leave_attachment ?>" data-type-id="Paid Leave Application" class="g_view btn btn-success" data-toggle="modal" data-target="#viewModal">View</button>
										<a href="<?php echo base_url()."leaves/delete_leave/".$paid->leave_id; ?>"><button name="delete_paid" id="delete_paid" class="btn hidden-sm-down btn-danger">Delete</button></a>
										<?php if($paid->leave_status==0){ ?><a href="<?php echo base_url()."leaves/approve_leave/".$paid->leave_id; ?>"><button name="approve_paid" id="approve_paid" class="btn hidden-sm-down btn-prime">Approve</button></a>
										<!--<a href="<?php //echo base_url()."leaves/decline_leave/".$paid->leave_id; ?>">--><button name="decline_paid" data-id="<?php echo $paid->leave_id ?>" id="decline_paid" class="d_note btn hidden-sm-down btn-primary" data-toggle="modal" data-target="#declineModal">Decline</button>
										<?php }?>
									</td>
								</tr>
								<?php
										}
									}
									else
									{ 
										echo "<tr><td colspan='9'>No Record Found!</td></tr>"; 
									} 
									?>
									
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
 </div>
 

 
 <div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-block">
			<h4 class="card-title" style="float:left">Sick Leaves</h4>&nbsp;&nbsp;&nbsp;<!--<button name="add_review" type="button" id="add_review" class="btn hidden-sm-down btn-success" style="font-size:11px;" data-toggle="modal" data-target="#reviewModal">Add New</button>-->
				<button type="button" class="btn btn-info pull-right" data-toggle="collapse" data-target="#sick" onclick="toggler(this)" id="sick_btn">+</button>
				  <div id="sick" class="collapse">
					<div class="table-responsive m-t-40">
						<table class="table stylish-table">
							<thead>
								<tr>
									<th>Name</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Status</th>
									<th><center>Action</center></th>
								</tr>
							</thead>
							<tbody id="review_notices_cont">
							<?php //$task_list = get_main_task_list_by_id($list->project_id); 
									$count = count($sick_leave);
									if($count > 0){
										foreach($sick_leave as $sick){
							 ?>
								<tr>
									<td width="350px"><h5><?php echo $sick->name; ?></h5><small><?php if($casual->employee_designation == 1){echo 'Project Manager';}
																										if($casual->employee_designation == 2){echo 'Employee';}
																										if($casual->employee_designation == 3){echo 'HR Manager';}
																								?></small></td>
									<td><?php $s_date = view_date_format($sick->leave_start_date);
													echo $s_date; ?></td>
									<td><?php $e_date = view_date_format($sick->leave_end_date);
													echo $e_date; ?></td>
									<td>
										<?php 
											if( $sick->leave_status==0){echo 'Pending';}
											if( $sick->leave_status==1){echo 'Approved';}
											if( $sick->leave_status==2){echo 'Declined';}
										?>
									</td>
									<td>
										<button name="sick_view" id="sick_view" data-id="<?php echo $sick->name ?>" data-name-id="<?php echo $sick->leave_type ?>" data-msg-id="<?php echo $sick->leave_description ?>" data-sdate-id="<?php echo $s_date ?>" data-edate-id="<?php echo $e_date ?>" data-days-id="<?php echo $sick->leave_total_days ?>" data-file-id="<?php echo $sick->leave_attachment ?>" data-type-id="Sick Leave Application" class="g_view btn btn-success" data-toggle="modal" data-target="#viewModal">View</button>
										<a href="<?php echo base_url()."leave/delete_leave/".$sick->leave_id; ?>"><button name="delete_sick" id="delete_sick" class="btn hidden-sm-down btn-danger">Delete</button></a>
										<?php if($sick->leave_status==0){ ?><a href="<?php echo base_url()."leaves/approve_leave/".$sick->leave_id; ?>"><button name="approve_sick" id="approve_sick" class="btn hidden-sm-down btn-prime">Approve</button></a>
										<!--<a href="<?php //echo base_url()."leaves/decline_leave/".$sick->leave_id; ?>">--><button name="decline_sick" data-id="<?php echo $sick->leave_id ?>" id="decline_sick" class="d_note btn hidden-sm-down btn-primary" data-toggle="modal" data-target="#declineModal">Decline</button>
										<?php }?>
									</td>
								</tr>
								<?php
										}
									}
									else
									{ 
										echo "<tr><td colspan='9'>No Record Found!</td></tr>"; 
									} 
									?>
									
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
 </div>
</div>
<div id="myleave" class="tabcontent">
	
<div id="my_leaves" class="" style="background:#ffffff; margin-bottom:50px;">
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-block">
			<h4 class="card-title" style="float:left">My Casual Leaves</h4>&nbsp;&nbsp;&nbsp;Leave Taken - <?php echo $leave_taken[0]->used_cl ?>
				<!--<button type="button" class="btn btn-info pull-right" data-toggle="collapse" data-target="#casual" onclick="toggler(this)" id="casual_btn">+</button>
				  <div id="casual" class="collapse">-->
					<div class="table-responsive m-t-40">
						<table class="table stylish-table">
							<thead>
								<tr>
									<th>Application Date</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="casual_leave_cont">
							<?php //$task_list = get_main_task_list_by_id($list->project_id); 
									$count = count($casual_leaves);
									if($count > 0){
										foreach($casual_leaves as $casuals){
							 ?>
								<tr>
									<td width="350px"><h5><?php $date = view_date_format($casuals->leave_added_date);
													echo $date; ?></h5><small></small></td>
									<td><?php $s_date = view_date_format($casuals->leave_start_date);
													echo $s_date; ?></td>
									<td><?php $e_date = view_date_format($casuals->leave_end_date);
													echo $e_date; ?></td>
									<td>
										<?php 
											if( $casuals->leave_status==0){echo 'Pending';}
											if( $casuals->leave_status==1){echo 'Approved';}
											if( $casuals->leave_status==2){echo 'Declined';}
										?>
									</td>
									<td>
										<button name="casual_view" id="casual_view" data-id="<?php echo $casuals->decline_note ?>" data-name-id="<?php echo $casuals->leave_type ?>" data-msg-id="<?php echo $casuals->leave_description ?>" data-sdate-id="<?php echo $s_date ?>" data-edate-id="<?php echo $e_date ?>" data-days-id="<?php echo $casuals->leave_total_days ?>" data-file-id="<?php echo $casuals->leave_attachment ?>" data-type-id="Casual Leave Application" class="g_view btn btn-success" data-toggle="modal" data-target="#viewModal">View</button>
										<?php 
											/*if( $casual->leave_status==0){
										?><a href="<?php echo base_url()."leaves/delete_leave/".$casual->leave_id; ?>"><button name="delete_casual" id="delete_casual" class="btn hidden-sm-down btn-danger">Delete</button></a>
										<?php } */?>
									</td>
								</tr>
								<?php
										}
									}
									else
									{ 
										echo "<tr><td colspan='9'>No Record Found!</td></tr>"; 
									} 
									?>
									
							</tbody>
						</table>
					</div>
				<!--</div>-->
			</div>
		</div>
	</div>
 </div>
 

 
 <div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-block">
			<h4 class="card-title" style="float:left">My Paid Leaves</h4>&nbsp;&nbsp;&nbsp;Leave Taken - <?php echo $leave_taken[0]->used_pl ?>
				<!--<button type="button" class="btn btn-info pull-right" data-toggle="collapse" data-target="#paid" onclick="toggler(this)" id="paid_btn">+</button>
				  <div id="paid" class="collapse">-->
					<div class="table-responsive m-t-40">
						<table class="table stylish-table">
							<thead>
								<tr>
									<th>Application Date</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="paid_leave_cont">
							<?php //$task_list = get_main_task_list_by_id($list->project_id); 
									$count = count($paid_leaves);
									if($count > 0){
										foreach($paid_leaves as $paids){
							 ?>
								<tr>
									<td width="350px"><h5><?php $date = view_date_format($paids->leave_added_date);
													echo $date; ?></h5><small></small></td>
									<td><?php $s_date = view_date_format($paids->leave_start_date);
													echo $s_date; ?></td>
									<td><?php $e_date = view_date_format($paids->leave_end_date);
													echo $e_date; ?></td>
									<td>
										<?php 
											if( $paids->leave_status==0){echo 'Pending';}
											if( $paids->leave_status==1){echo 'Approved';}
											if( $paids->leave_status==2){echo 'Declined';}
										?>
									</td>
									<td>
										<button name="paid_view" id="paid_view" data-id="<?php echo $paids->decline_note ?>" data-name-id="<?php echo $paids->leave_type ?>" data-msg-id="<?php echo $paids->leave_description ?>" data-sdate-id="<?php echo $s_date ?>" data-edate-id="<?php echo $e_date ?>" data-days-id="<?php echo $paids->leave_total_days ?>" data-file-id="<?php echo $paids->leave_attachment ?>" data-type-id="Paid Leave Application" class="g_view btn btn-success" data-toggle="modal" data-target="#viewModal">View</button>
										<?php 
											/*if( $paid->leave_status==0){
										?><a href="<?php echo base_url()."leaves/delete_leave/".$paid->leave_id; ?>"><button name="delete_paid" id="delete_paid" class="btn hidden-sm-down btn-danger">Delete</button></a>
										<?php }*/ ?>
									</td>
								</tr>
								<?php
										}
									}
									else
									{ 
										echo "<tr><td colspan='9'>No Record Found!</td></tr>"; 
									} 
									?>
									
							</tbody>
						</table>
					</div>
				<!--</div>-->
			</div>
		</div>
	</div>
 </div>
 

 
 <div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-block">
			<h4 class="card-title" style="float:left">My Sick Leaves</h4>&nbsp;&nbsp;&nbsp;Leave Taken - <?php echo $leave_taken[0]->used_sl ?>
				<!--<button type="button" class="btn btn-info pull-right" data-toggle="collapse" data-target="#sick" onclick="toggler(this)" id="sick_btn">+</button>
				  <div id="sick" class="collapse">-->
					<div class="table-responsive m-t-40">
						<table class="table stylish-table">
							<thead>
								<tr>
									<th>Application Date</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="review_notices_cont">
							<?php //$task_list = get_main_task_list_by_id($list->project_id); 
									$count = count($sick_leaves);
									if($count > 0){
										foreach($sick_leaves as $sicks){
							 ?>
								<tr>
									<td width="350px"><h5><?php $date = view_date_format($sicks->leave_added_date);
													echo $date; ?></h5><small></small></td>
									<td><?php $s_date = view_date_format($sicks->leave_start_date);
													echo $s_date; ?></td>
									<td><?php $e_date = view_date_format($sicks->leave_end_date);
													echo $e_date; ?></td>
									<td>
										<?php 
											if( $sicks->leave_status==0){echo 'Pending';}
											if( $sicks->leave_status==1){echo 'Approved';}
											if( $sicks->leave_status==2){echo 'Declined';}
										?>
									</td>
									<td>
										<button name="sick_view" id="sick_view" data-id="<?php echo $sicks->decline_note ?>" data-name-id="<?php echo $sicks->leave_type ?>" data-msg-id="<?php echo $sicks->leave_description ?>" data-sdate-id="<?php echo $s_date ?>" data-edate-id="<?php echo $e_date ?>" data-days-id="<?php echo $sicks->leave_total_days ?>" data-file-id="<?php echo $sicks->leave_attachment ?>" data-type-id="Sick Leave Application" class="g_view btn btn-success" data-toggle="modal" data-target="#viewModal">View</button>
										<?php 
											/*if( $sick->leave_status==0){
										?><a href="<?php echo base_url()."leave/delete_leave/".$sick->leave_id; ?>"><button name="delete_sick" id="delete_sick" class="btn hidden-sm-down btn-danger">Delete</button></a>
										<?php }*/ ?>
									</td>
								</tr>
								<?php
										}
									}
									else
									{ 
										echo "<tr><td colspan='9'>No Record Found!</td></tr>"; 
									} 
									?>
									
							</tbody>
						</table>
					</div>
				<!--</div>-->
			</div>
		</div>
	</div>
 </div>
</div>	
</div>


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

</div>
 <!--Decline Modal -->
<div class="modal fade" id="declineModal" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">

	  <!-- Modal content-->
	  <div class="modal-content" id="declineModal_div">
		<div class="modal-header">
		  <h4 class="modal-title">Decline Note</h4>
		</div>
		<div class="modal-body">
		<form class="feedbackdecline" id="feedbackdecline" name="feedbackdecline" action="<?php echo base_url()?>leaves/decline_leave" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="leave_id" id="leave_id" value=""/>
			
			<div class="col-md-4 col-4 align-self-center">
			  <textarea class="form-control" name="decline_msg" id="decline_msg" placeholder="Your Note..." rows="5" style="width: 300px;"></textarea>
			</div><br />
		
			<div class="col-md-4 col-4 align-self-center">
				<!--<button class="form-control btn-success" style="width: 220px;" name="publish_general" id="publish_general" value="" >Submit</button>-->
				<input type="submit" class="form-control btn-success" style="width: 220px;"  name="submit" value="Submit" id="submit">
			</div>
		</form>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.reload()">Close</button>
		</div>
	  </div>
	  
	</div>
</div><!--End Modal -->
 

<div class="card">
	<div class="card-block">
		<h4 class="card-title" style="float:left">Leaves Calender</h4>
		
		<br><br>
		<div id="calendar_div" class="">
			<div id="calendar"></div>
		</div>
	</div>
</div>

 <!-- View Modal -->
<div class="modal fade" id="viewModal" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">

	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Leave Application View</h4>
		</div>
		<div class="modal-body">
		
		<!--<form class="feedback" name="feedback" action="javascript:void(0);" method="POST">-->
			<input type="hidden" name="task_id" id="task_id" value=""/>
			<!--<label for="name" ><h4>Name</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_name" id="notice_name">
			  <!--<input type="text" class="form-control" name="notice_name" id="notice_name" value="" style="width: 300px;">
			</div><br />-->
			<label for="employee" ><h4>Employee</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_user" id="notice_user">
			  <!--<input type="text" class="form-control" name="notice_name" id="notice_name" value="" style="width: 300px;">-->
			</div><br />
			<label for="msg"><h4>Message</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_msg" id="notice_msg">
			  <!--<input type="text" class="form-control" name="notice_msg" id="notice_msg" value="" style="width: 300px;">-->
			</div><br />
			
			<label for="sdate"><h4>Start Date</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_sdate" id="notice_sdate">
			  <!--<input type="text" class="form-control" name="notice_date" id="notice_date" value="" style="width: 300px;">-->
			</div><br />
			<label for="edate"><h4>End Date</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_edate" id="notice_edate">
			  <!--<input type="text" class="form-control" name="notice_date" id="notice_date" value="" style="width: 300px;">-->
			</div><br />
			<label for="edate"><h4>No. of Days</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_days" id="notice_days">
			  <!--<input type="text" class="form-control" name="notice_date" id="notice_date" value="" style="width: 300px;">-->
			</div><br />
			<label for="file"><h4>Attachment</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_file" id="notice_file">
			  <!--<input type="text" class="form-control" name="notice_file" id="notice_file" value="" style="width: 300px;">-->
			</div><br />
			<label for="type"><h4>Type</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_type" id="notice_type">
			  <!--<input type="text" class="form-control" name="notice_type" id="notice_type" value="" style="width: 300px;">-->
			</div><br />
			
			<!--</form>-->
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		</div>
	  </div>
	  
	</div>
</div><!--End Modal -->
 
	<!-- Row -->
	<!-- ============================================================== -->
	<!-- End PAge Content -->
	<!-- ============================================================== -->
</div>

<script>
/* Leave Decline Script*/
	$(document).on("click", ".d_note", function () {
		 var leave_id = $(this).data('id');
		 
		 $(".modal-body #leave_id").val( leave_id );
		 
	});
	/* End */
	
	$("#hide").click(function(){
		$("p").hide();
	});

	$("#show").click(function(){
		$("p").show();
	});
</script>


<script>
/* Notice View Script*/
	$(document).on("click", ".g_view", function () {
		 var user = $(this).data('id');
		 if(!user){
			 user='For All';
		 }
		 var name = $(this).data('name-id');
		// alert($(this).data('todo').name);
		 var msg = $(this).data('msg-id');
		 var sdate = $(this).data('sdate-id');
		 var edate = $(this).data('edate-id');
		 var t_days = $(this).data('days-id');
		 var file = $(this).data('file-id');
		 
		if(file){
			 var file ='<a target="_blank", href="<?php echo base_url() ?>assets/upload/leaves/'+file+'">'+file+'</a>';
		}
		else{
			 file = "No Attachment!";
		}
		 var type = $(this).data('type-id');
		 $(".modal-body #notice_user").html( user );
		 $(".modal-body #notice_name").html( name );
		 $(".modal-body #notice_msg").html( msg );
		 $(".modal-body #notice_sdate").html( sdate );
		 $(".modal-body #notice_edate").html( edate );
		 $(".modal-body #notice_days").html( t_days );
		 $(".modal-body #notice_file").html( file );
		 $(".modal-body #notice_type").html( type );
	});
	/* End */
	
	/* General Notice Publish Script */
	$(document).ready(function(){
		$("#casual_btn").trigger('click');
		$("#general_btn").trigger('click');
		$("button#publish_general").click(function(e){
			e.preventDefault();
			
			var subject = $('#subject').val().trim();
			var message = $('#message').val().trim();
			var priority = $('#priority').val().trim();
			//var name = $('#numprod').val().trim();
			//alert(subject);
			if(subject && message && priority){
				
				$('#publish_general').text('Loading...');
				$('#publish_general').prepend('<i class="fa fa-refresh fa-spin"></i>');
				var form = new FormData(document.getElementById('feedbackgeneral'));
				
			   //append files
				var file = document.getElementById('userfile').files[0];
				if (file) {   
					form.append('userfile', file);
				}
				
				$.ajax({
					type: "POST",
					url: "<?php echo base_url().'notice/do_add_general_notice'; ?>",
					data: form,
					cache: false,
					contentType: false, //must, tell jQuery not to process the data
					processData: false,
					success: function(data){

						var data_arr = $.parseJSON(data);
						console.log(data_arr);
						//$("#feedbackgeneral_msg").html(data);
						
						$('#publish_general').text('Publish');
						$("#response").html(data_arr.msg);
						$("#general_notices_cont").html(data_arr.table_data);
						$("#general_btn").trigger( "click" );
						$("#feedbackgeneral")[0].reset();
						$('#response').delay(2000).fadeOut();
						
					}
				});
			}
		});
		
		
        
     
	
	});/* End */
	
	
	/* Warning Notice Publish Script */
	$(document).ready(function(){
		$("button#publish_warning").click(function(e){
			e.preventDefault();
			
			var subject = $('#warning_subject').val().trim();
			var message = $('#warning_message').val().trim();
			var priority = $('#warning_priority').val().trim();
			var user_id = $('#warning_user_id').val().trim();
			var warning_userfile = $('#warning_userfile').val().trim();
			//alert(subject);
			if(subject && message && priority && user_id){
				
				$('#publish_warning').text('Loading...');
				$('#publish_warning').prepend('<i class="fa fa-refresh fa-spin"></i>');
				var form = new FormData(document.getElementById('feedbackwarning'));
				
			   //append files
				var file = document.getElementById('warning_userfile').files[0];
				if (file) {   
					form.append('userfile', file);
					//alert('hi');
				}
				
				//console.log(form.values);
				
				
				
				$.ajax({
					type: "POST",
					url: "<?php echo base_url().'notice/do_add_warning_notice'; ?>",
					data: form,
					cache: false,
					contentType: false, //must, tell jQuery not to process the data
					processData: false,
					success: function(data){
						//console.log(data);
						var data_arr = $.parseJSON(data);
						console.log(data_arr);
						//$("#feedbackgeneral_msg").html(data);
						$('#publish_warning').text('Publish');
						$("#responsewarning").html(data_arr.msg);
						$("#warning_notices_cont").html(data_arr.table_data);
						$("#warning_btn").trigger( "click" );
						$("#feedbackwarning")[0].reset();
						$('#responsewarning').delay(2000).fadeOut();
					}
				});
			}
		});
		
	});/* End */
	
	
	/* Review Notice Publish Script */
	$(document).ready(function(){
		$("button#publish_review").click(function(e){
			e.preventDefault();
			
			var subject = $('#review_subject').val().trim();
			var message = $('#review_message').val().trim();
			var priority = $('#review_priority').val().trim();
			var user_id = $('#review_user_id').val().trim();
			
			if(subject && message && priority && user_id){
				
				$('#publish_review').text('Loading...');
				$('#publish_review').prepend('<i class="fa fa-refresh fa-spin"></i>');
				var form = new FormData(document.getElementById('feedbackreview'));
				
			   //append files
				var file = document.getElementById('review_userfile').files[0];
				if (file) {   
					form.append('userfile', file);
				}
				
				$.ajax({
					type: "POST",
					url: "<?php echo base_url().'notice/do_add_review_notice'; ?>",
					data: form,
					cache: false,
					contentType: false, //must, tell jQuery not to process the data
					processData: false,
					success: function(data){
						//$("#feedbackgeneral_msg").html(data);
						$('#publish_review').text('Publish');
						//$("#responsreview").html(data);
						$("#responsreview").html(data_arr.msg);
						$("#review_notices_cont").html(data_arr.table_data);
						$("#review_btn").trigger( "click" );
						$("#feedbackreview")[0].reset();
						$('#responsreview').delay(2000).fadeOut();
					}
				});
				 //e.preventDefault();
			}
		});
		
	});/* End */
	
</script><!--End-->

<script>
	/*function msg(){
		var r = confirm('Are you sure to delete selected tasks?');
		if(r){
			window.location.href ="<?php echo base_url(); ?>task/delete_task/<?php echo $list->task_id; ?>";
		}
		else {
			window.location.href ="<?php echo base_url(); ?>task/task_list";
		}
	}*/
</script>

<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

<script>
	function toggler(e) {
		if( e.innerHTML == '+' ) {
			if(e.id == 'casual_btn'){
				e.innerHTML = '-'
				//document.getElementById('current_password').type="text";
			}
			if(e.id == 'paid_btn'){
				e.innerHTML = '-'
				//document.getElementById('new_password').type="text";
			}
			if(e.id == 'sick_btn'){
				e.innerHTML = '-'
				//document.getElementById('confirm_password').type="text";
			}
		}
		 else {
			 if(e.id == 'casual_btn'){
				e.innerHTML = '+'
				//document.getElementById('current_password').type="password";
			 }
			 if(e.id == 'paid_btn'){
				e.innerHTML = '+'
				//document.getElementById('new_password').type="password";
			 }
			 if(e.id == 'sick_btn'){
				e.innerHTML = '+'
				//document.getElementById('confirm_password').type="password";
			 }
		}
	}
	
	
</script>

<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
			
<?php include_once('include/footer.php'); ?> 