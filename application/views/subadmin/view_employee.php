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
                        <h3 class="text-themecolor m-b-0 m-t-0">Employee</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url()."dashboard"; ?>">Home</a></li>
                            <li class="breadcrumb-item active">View Employee</li>
                            <li class="breadcrumb-item active"><?php echo $emp_details[0]->name; ?></li>
                        </ol>
                    </div>
					<div class="col-md-6 col-4 align-self-center">
                                            <a href="<?php echo base_url()."employee/employee_list"; ?>" class="btn pull-right hidden-sm-down btn-success"> Employee List</a>
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
                    <div class="col-lg-4 col-xlg-3 col-md-5">
						<div class="row"  style="background:#FFF; margin-bottom:10px;">
							<!-- Column -->
							
								
									<div class="card-block">
										<center class="m-t-30"> <img src="<?php echo base_url(); ?>assets/upload/profile_image/<?php if(!empty($emp_details[0]->user_iamge)){ echo $emp_details[0]->user_iamge; }else {?>noimage.png<?php } ?>" class="img-circle" width="150" />
											<h4 class="card-title m-t-10"><?php echo $emp_details[0]->name; ?></h4>
											<!--<h6 class="card-subtitle">Accoubts Manager Amix corp</h6>
											<div class="row text-center justify-content-md-center">
												<div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">254</font></a></div>
												<div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div>
											</div>-->
										</center>
									</div>
								
							
						</div>
						<div class="row" style="background:#FFF; margin-bottom:10px;">
							<!-- Column -->
							
								
									<div class="card-block">
										<center class="m-t-30"> 
											<h4 class="card-title m-t-10">NOTICES</h4>
											
										</center>
									<div class="card-block">
										<h4 class="card-title m-t-10" style="float:left">General:</h4>
											<button type="button" class="btn btn-info pull-right" data-toggle="collapse" data-target="#general" onclick="toggler(this)" id="general_btn">+</button>
											  <div id="general" class="collapse">
												<div class="table-responsive m-t-40">
													<table class="table stylish-table">
														<thead>
															<tr>
																<th>Subject</th>
																<th>Date</th>
															</tr>
														</thead>
														<tbody>
														<?php 
															$count = count($general_notice);
															if($count > 0){
																foreach($general_notice as $general){
														 ?>
															<tr>
																<td width="520px"><?php echo $general->notice_name; ?></td>
																<td><?php $date = view_date_format($general->notice_date);
																				echo $date; ?></td>
																
																<td>
																	<button name="general_view" id="general_view" data-id="<?php //echo $general->name ?>" data-name-id="<?php echo $general->notice_name ?>" data-msg-id="<?php echo $general->notice_message ?>" data-date-id="<?php echo $date ?>" data-file-id="<?php echo $general->notice_file ?>" data-type-id="general Notice" class="g_view btn btn-success" data-toggle="modal" data-target="#viewModal">View</button>
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
										
										<div class="card-block">
										<h4 class="card-title m-t-10" style="float:left">Warning:</h4>
											<button type="button" class="btn btn-info pull-right" data-toggle="collapse" data-target="#warning" id="warning_btn" onclick="toggler(this)" id="warning_btn">+</button>
											  <div id="warning" class="collapse">
												<div class="table-responsive m-t-40">
													<table class="table stylish-table">
														<thead>
															<tr>
																<th>Subject</th>
																<th>Date</th>
															</tr>
														</thead>
														<tbody>
														<?php 
															$count = count($warning_notice);
															if($count > 0){
																foreach($warning_notice as $warning){
														 ?>
															<tr>
																<td width="520px"><?php echo $warning->notice_name; ?></td>
																<td><?php $date = view_date_format($warning->notice_date);
																				echo $date; ?></td>
																
																<td>
																	<button name="warning_view" id="warning_view" data-id="<?php //echo $warning->name ?>" data-name-id="<?php echo $warning->notice_name ?>" data-msg-id="<?php echo $warning->notice_message ?>" data-date-id="<?php echo $date ?>" data-file-id="<?php echo $warning->notice_file ?>" data-type-id="warning Notice" class="g_view btn btn-success" data-toggle="modal" data-target="#viewModal">View</button>
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
										<div class="card-block">
										<h4 class="card-title m-t-10" style="float:left">Quarterly Review:</h4>
										 <button type="button" class="btn btn-info pull-right" data-toggle="collapse" data-target="#review" id="review_btn" onclick="toggler(this)" id="review_btn">+</button>
											  <div id="review" class="collapse">
												<div class="table-responsive m-t-40">
													<table class="table stylish-table">
														<thead>
															<tr>
																<th>Subject</th>
																<th>Date</th>
															</tr>
														</thead>
														<tbody>
														<?php //$task_list = get_main_task_list_by_id($list->project_id); 
																$count = count($review_notice);
																if($count > 0){
																	foreach($review_notice as $review){
														 ?>
															<tr>
																<td width="520px"><?php echo $review->notice_name; ?></td>
																<td><?php $date = view_date_format($review->notice_date);
																				echo $date; ?></td>
																
																<td>
																	<button name="review_view" id="review_view" data-id="<?php //echo $review->name ?>" data-name-id="<?php echo $review->notice_name ?>" data-msg-id="<?php echo $review->notice_message ?>" data-date-id="<?php echo $date ?>" data-file-id="<?php echo $review->notice_file ?>" data-type-id="Quarterly Review Notice" class="g_view btn btn-success" data-toggle="modal" data-target="#viewModal">View</button>
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
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-block">
                               
                               <?php echo form_open_multipart(); ?>
                                
                                            <input type="hidden" name="userid" placeholder="" class="form-control form-control-line" value="<?php echo $emp_details[0]->user_id; ?>">
                                       
                                    <div class="form-group">
                                        <label for="example-name" class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="example-name" placeholder="" class="form-control form-control-line" value="<?php echo $emp_details[0]->name; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" placeholder="" class="form-control form-control-line" name="example-email" id="example-email" value="<?php echo $emp_details[0]->user_email; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-phone" class="col-md-12">Phone No</label>
                                        <div class="col-md-12">
                                            <input type="text" name="example-phone" placeholder="" class="form-control form-control-line" value="<?php echo $emp_details[0]->phone_no; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-id" class="col-md-12">Employee Id</label>
                                        <div class="col-md-12">
                                             <input type="text" name="example-id" placeholder="" class="form-control form-control-line" value="<?php echo $emp_details[0]->employee_id; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="department-id" class="col-md-12">Employee Department</label>
                                        <div class="col-md-12">
                                             <input type="text" name="department-id" placeholder="" class="form-control form-control-line" value="<?php if($emp_details[0]->department_id==1){ echo 'Design & Development';}else if($emp_details[0]->department_id==2){ echo 'SEO';}else if($emp_details[0]->department_id==3){ echo 'Contents';}else if($emp_details[0]->department_id==4){ echo 'Accounts';}else{ echo 'Human Resource';} ?>" disabled>
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <label class="col-md-12">Salary</label>
                                        <div class="col-md-12">
                                            <input type="text" name="salary" placeholder="" class="form-control form-control-line" value="<?php echo $emp_details[0]->employee_salary; ?>" disabled>
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <label class="col-md-12">Joining Date</label>
                                        <div class="col-md-12">
                                            <input type="text" name="joining_date" placeholder="" class="form-control form-control-line" value="<?php $date = view_date_format($emp_details[0]->joining_date); echo $date; ?>" disabled>
                                        </div>
                                    </div>
									
                                    <div class="form-group">
                                        <label for="address" class="col-md-12">Employee Address</label>
                                        <div class="col-md-12">
                                             <textarea name="address" placeholder="" class="form-control form-control-line" disabled><?php echo $emp_details[0]->address; ?></textarea>
                                        </div>
                                    </div>
                                    <!--<div class="form-group">                                        <label for="userfile" class="col-md-12">Picture</label>                                        <div class="col-md-12">                                             <input type="file" name="userfile" placeholder="" class="form-control form-control-line">                                        </div> -->                                   </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <!--<button class="btn btn-success">Update Profile</button-->
                                        </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                <!--</form>-->
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
				
				
				<div class="card">
					<div class="card-block">
						<h4 class="card-title" style="float:left">Task Calender</h4>
						
						<br><br>
						<div id="calendar_div" class="">
							<div id="calendar_task"></div>
						</div>
					</div>
				</div>
				
				
				<div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">
                            <div class="card-block">	
							<div id="top_x_div" style="width: ; height: 500px;"></div>
							<div id="chart" style="text-align:center; padding-top:20px;">
							<i class="fa fa-bar-chart" style="color:blue;padding-right:15px;" aria-hidden="true">Salary</i>
							<i class="fa fa-bar-chart" style="color:red;padding-right:15px;" aria-hidden="true">Raise%</i>
							<i class="fa fa-bar-chart" style="color:#F4B400;padding-right:15px;" aria-hidden="true">Raise</i>
							</div>
						</div>
					</div>
				</div>
				
				
				
				<!-- View Modal -->
<div class="modal fade" id="viewModal" role="dialog">
	<div class="modal-dialog">

	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Notice View</h4>
		</div>
		<div class="modal-body">
		
		<!--<form class="feedback" name="feedback" action="javascript:void(0);" method="POST">-->
			<input type="hidden" name="task_id" id="task_id" value=""/>
			<label for="name" ><h4>Name</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_name" id="notice_name">
			  <!--<input type="text" class="form-control" name="notice_name" id="notice_name" value="" style="width: 300px;">-->
			</div><br />
			<label for="msg"><h4>Message</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_msg" id="notice_msg">
			  <!--<input type="text" class="form-control" name="notice_msg" id="notice_msg" value="" style="width: 300px;">-->
			</div><br />
			<label for="employee" ><h4>To Employee</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_user" id="notice_user">
			  <!--<input type="text" class="form-control" name="notice_name" id="notice_name" value="" style="width: 300px;">-->
			</div><br />
			<label for="date"><h4>Date</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_date" id="notice_date">
			  <!--<input type="text" class="form-control" name="notice_date" id="notice_date" value="" style="width: 300px;">-->
			</div><br />
			<label for="file"><h4>Attachment</h4></label>
			<div class="col-md-12 col- 12 align-self-center" name="notice_file" id="notice_file">
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
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
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
		 var date = $(this).data('date-id');
		 var file = $(this).data('file-id');
		 
		if(file){
			 var file ='<a target: "_blank", href="<?php echo base_url() ?>assets/upload/notices/'+file+'">'+file+'</a>';
		}
		else{
			 file = "No Attachment!";
		}
		 var type = $(this).data('type-id');
		 $(".modal-body #notice_user").html( user );
		 $(".modal-body #notice_name").html( name );
		 $(".modal-body #notice_msg").html( msg );
		 $(".modal-body #notice_date").html( date );
		 $(".modal-body #notice_file").html( file );
		 $(".modal-body #notice_type").html( type );
	});
	/* End */
</script>
<script>
	function toggler(e) {
		if( e.innerHTML == '+' ) {
			if(e.id == 'general_btn'){
				e.innerHTML = '-'
				//document.getElementById('current_password').type="text";
			}
			if(e.id == 'warning_btn'){
				e.innerHTML = '-'
				//document.getElementById('new_password').type="text";
			}
			if(e.id == 'review_btn'){
				e.innerHTML = '-'
				//document.getElementById('confirm_password').type="text";
			}
		}
		 else {
			 if(e.id == 'general_btn'){
				e.innerHTML = '+'
				//document.getElementById('current_password').type="password";
			 }
			 if(e.id == 'warning_btn'){
				e.innerHTML = '+'
				//document.getElementById('new_password').type="password";
			 }
			 if(e.id == 'review_btn'){
				e.innerHTML = '+'
				//document.getElementById('confirm_password').type="password";
			 }
		}
	}
	
	
</script>				
<?php include_once('include/footer.php'); ?> 