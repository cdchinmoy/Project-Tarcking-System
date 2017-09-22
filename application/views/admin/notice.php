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
			<h3 class="text-themecolor m-b-0 m-t-0">Notice Board</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url()."dashboard"; ?>">Home</a></li>
				<li class="breadcrumb-item active">Notices</li>
			</ol>
		</div>
		<?php /* ?><div class="col-md-6 col-4 align-self-center">
            <a href="<?php echo base_url()."task/add_main_task"; ?>" class="btn pull-right hidden-sm-down btn-success"> Add Task</a>
        </div><?php */ ?>
	</div>


<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-block">
			<h4 class="card-title" style="float:left">General Notices</h4>&nbsp;&nbsp;&nbsp;<?php /* ?><button name="add_general" type="button" id="add_general" class="btn hidden-sm-down btn-success" style="font-size:11px;" data-toggle="modal" data-target="#generalModal">Add New</button><?php */ ?>
				<button type="button" class="btn btn-info pull-right" data-toggle="collapse" data-target="#general" id="general_btn">+</button>
				  <div id="general" class="collapse">
					<div class="table-responsive m-t-40" id="general_notice_table">
						<table class="table stylish-table">
							<thead>
								<tr>
									<th>Notice Name</th>
									<th>Date</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="general_notices_cont">
							<?php 
									$count = count($general_notice);
									if($count > 0){
										foreach($general_notice as $general){
							 ?>
								<tr <?php if($general->notification_status ==0){ echo "style='background:#E1E1D2 !important;'"; } ?>>
									<td width="520px"><?php echo $general->notice_name; ?></td>
									<td><?php $date = view_date_format($general->notice_date);
													echo $date; ?></td>
									<td>
										<?php 
											if( $general->notice_priority==1){echo 'Normal';}
											if( $general->notice_priority==2){echo 'Medium';}
											if( $general->notice_priority==3){echo 'High';}
										?>
									</td>
									<td>
										<button name="general_view" id="general_view" data-id="<?php echo $general->notice_id ?>" data-name-id="<?php echo $general->notice_name ?>" data-msg-id="<?php echo $general->notice_message ?>" data-date-id="<?php echo $date ?>" data-file-id="<?php echo $general->notice_file ?>" data-type-id="General Notice" data-nots-id="<?php echo $general->notice_type ?>" class="g_view btn btn-success" data-toggle="modal" data-target="#viewModal">View</button>
										
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
 
 
		  
 <!--General Notice Modal -->
<?php /* ?><div class="modal fade" id="generalModal" role="dialog">
	<div class="modal-dialog">

	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">General Notice</h4>
		</div>
		<div class="modal-body">
		<div id="feedbackgeneral_msg"></div>
		<form class="feedbackgeneral" id="feedbackgeneral" name="feedbackgeneral" action="javascript:void(0);" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="notice_type" id="notice_type" value="1"/>
			
			<div class="col-md-4 col-4 align-self-center">
			  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" style="width: 300px;">
			</div><br />
			
			<div class="col-md-4 col-4 align-self-center">
			  <textarea class="form-control" name="message" id="message" placeholder="Type your notice..." style="width: 300px;" rows="5"></textarea>
			</div><br />
			
			<div class="col-md-4 col-4 align-self-center">
			   <select class="form-control" name="priority" style="width: 300px;" id="priority">
				 <option value="">Select Priority</option>
				 <option value="1">Normal</option>
				 <option value="2">Medium</option>
				 <option value="3">High</option>
			   </select>
			</div><br />
			
			<div class="col-md-4 col-4 align-self-center">
			 <input type="file" class="form-control" name="userfile" id="userfile" style="width: 300px;">
			  <!-- <input type="file" name="userfile" id="userfile" class="form-control">-->
			</div><br />
			
			<div class="col-md-4 col-4 align-self-center">
				<button class="form-control btn-success" style="width: 220px;" name="publish_general" id="publish_general" value="" >Publish</button>
				<!--<input type="submit" class="form-control btn-success" style="width: 220px;"  name="publish_general" value="Publish" id="publish_general">-->
			</div>
			<br><span id="response"></span>
		</form>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		</div>
	  </div>
	  
	</div>
</div><!--End Modal --><?php */ ?>
            
 
 
 
 <?php /* ?>
 <div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-block">
			<h4 class="card-title" style="float:left">Warnings</h4>&nbsp;&nbsp;&nbsp;<button name="add_warning" type="button" id="add_warning" class="btn hidden-sm-down btn-success" style="font-size:11px;" data-toggle="modal" data-target="#warningModal">Add New</button>
				<button type="button" class="btn btn-info pull-right" data-toggle="collapse" data-target="#warning" data-id="">+</button>
				  <div id="warning" class="collapse">
					<div class="table-responsive m-t-40">
						<table class="table stylish-table">
							<thead>
								<tr>
									<th>Notice Name</th>
									<th>Date</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php //$task_list = get_main_task_list_by_id($list->project_id); 
									$count = count($warning_notice);
									if($count > 0){
										foreach($warning_notice as $warning){
							 ?>
								<tr>
									<td width="520px"><?php echo $warning->notice_name; ?></td>
									<td><?php $date = view_date_format($warning->notice_date);
													echo $date; ?></td>
									<td>
										<?php 
											if( $warning->notice_priority==1){echo 'Normal';}
											if( $warning->notice_priority==2){echo 'Medium';}
											if( $warning->notice_priority==3){echo 'High';}
										?>
									</td>
									<td>
										<button name="warning_view" id="warning_view" data-id="<?php //echo $warning->name ?>" data-name-id="<?php echo $warning->notice_name ?>" data-msg-id="<?php echo $warning->notice_message ?>" data-date-id="<?php echo $date ?>" data-file-id="<?php echo $warning->notice_file ?>" data-type-id="Warning Notice" class="g_view btn btn-success" data-toggle="modal" data-target="#viewModal">View</button>
										<a href="<?php echo base_url()."notice/delete_notice/".$warning->notice_id; ?>"><button name="delete_warning" id="delete_warning" class="btn hidden-sm-down btn-danger">Delete</button></a>
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
 
 
 <!-- Modal -->
 <?php /* ?> <div class="modal fade" id="warningModal" role="dialog">
	<div class="modal-dialog">
	
	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Warning Notice</h4>
		</div>
		<div class="modal-body">
		<form class="feedbackwarning" name="feedbackwarning" id="feedbackwarning" action="javascript:void(0);" method="POST">
			<input type="hidden" name="notice_type" id="notice_type" value="2"/>
			<div class="col-md-4 col-4 align-self-center">
			   <select class="form-control" name="warning_user_id" id="warning_user_id" style="width: 300px;" required>
				<option value="">Select Employee</option>
				<?php 
				   $count = count($employee_list);
				   if($count > 0)
				   {
					   foreach($employee_list as $list)
					   { 
					   ?>
					   <option value="<?php echo $list->user_id; ?>"><?php echo $list->name; ?></option>
					   <?php 
					   } 
				   }
				?>
			   </select>
			</div><br />
			<div class="col-md-4 col-4 align-self-center">
			  <input type="text" class="form-control" name="warning_subject" id="warning_subject" placeholder="Subject" style="width: 300px;">
			</div><br />
			
			<div class="col-md-4 col-4 align-self-center">
			  <textarea class="form-control" name="warning_message" id="warning_message" placeholder="Type your notice..." style="width: 300px;" rows="5"></textarea>
			</div><br />
			
			<div class="col-md-4 col-4 align-self-center">
			   <select class="form-control" name="warning_priority" id="warning_priority" style="width: 300px;">
				 <option value="">Select Priority</option>
				 <option value="1">Normal</option>
				 <option value="2">Medium</option>
				 <option value="3">High</option>
			   </select>
			</div><br />
			
			<div class="col-md-4 col-4 align-self-center">
			  <input type="file" class="form-control" name="userfile" id="warning_userfile" style="width: 300px;">
			</div><br />
			
			<div class="col-md-4 col-4 align-self-center">
				<button class="form-control btn-success" style="width: 220px;" name="publish_warning" id="publish_warning" value="" >Publish</button>
			</div>
			<br><span id="responsewarning"></span>
			</form>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		</div>
	  </div>
	  
	</div>
 </div><!--End Modal --><?php */ ?>
 
 <?php /* ?>
 <div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-block">
			<h4 class="card-title" style="float:left">Quaterly Reviews</h4>&nbsp;&nbsp;&nbsp;<button name="add_review" type="button" id="add_review" class="btn hidden-sm-down btn-success" style="font-size:11px;" data-toggle="modal" data-target="#reviewModal">Add New</button>
				<button type="button" class="btn btn-info pull-right" data-toggle="collapse" data-target="#review" data-id="">+</button>
				  <div id="review" class="collapse">
					<div class="table-responsive m-t-40">
						<table class="table stylish-table">
							<thead>
								<tr>
									<th>Notice Name</th>
									<th>Date</th>
									<th>Status</th>
									<th>Action</th>
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
										<?php 
											if( $review->notice_priority==1){echo 'Normal';}
											if( $review->notice_priority==2){echo 'Medium';}
											if( $review->notice_priority==3){echo 'High';}
										?>
									</td>
									<td>
										<button name="review_view" id="review_view" data-id="<?php //echo $review->name ?>" data-name-id="<?php echo $review->notice_name ?>" data-msg-id="<?php echo $review->notice_message ?>" data-date-id="<?php echo $date ?>" data-file-id="<?php echo $review->notice_file ?>" data-type-id="Quarterly Review Notice" class="g_view btn btn-success" data-toggle="modal" data-target="#viewModal">View</button>
										<a href="<?php echo base_url()."notice/delete_notice/".$review->notice_id; ?>"><button name="delete_review" id="delete_review" class="btn hidden-sm-down btn-danger">Delete</button></a>
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
 </div><?php */ ?>

 <!-- Modal -->
 <?php /* ?> <div class="modal fade" id="reviewModal" role="dialog">
	<div class="modal-dialog">
	
	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Quarterly Review Notice</h4>
		</div>
		<div class="modal-body">
		<form class="feedbackreview" name="feedbackreview" id="feedbackreview" action="javascript:void(0);" method="POST">
			<input type="hidden" name="notice_type" id="notice_type" value="3"/>
			<div class="col-md-4 col-4 align-self-center">
				<select class="form-control" name="review_user_id" id="review_user_id" style="width: 300px;">
					<option value="">Select Employee</option>
					<?php 
					   $count = count($employee_list);
					   if($count > 0)
					   {
						   foreach($employee_list as $list)
						   { 
						   ?>
						   <option value="<?php echo $list->user_id; ?>"><?php echo $list->name; ?></option>
						   <?php 
						   } 
					   }
					?>
				</select>
			</div><br />
			<div class="col-md-4 col-4 align-self-center">
			  <input type="text" class="form-control" name="review_subject" id="review_subject" placeholder="Subject" style="width: 300px;">
			</div><br />
			
			<div class="col-md-4 col-4 align-self-center">
			  <textarea class="form-control" name="review_message" id="review_message" placeholder="Type your notice..." style="width: 300px;" rows="5"></textarea>
			</div><br />
			
			<div class="col-md-4 col-4 align-self-center">
			   <select class="form-control" name="review_priority" id="review_priority" style="width: 300px;">
				 <option value="">Select Priority</option>
				 <option value="1">Normal</option>
				 <option value="2">Medium</option>
				 <option value="3">High</option>
			   </select>
			</div><br />
			
			<div class="col-md-4 col-4 align-self-center">
			  <input type="file" class="form-control" name="userfile" id="review_userfile" style="width: 300px;">
			</div><br />
			
			<div class="col-md-4 col-4 align-self-center">
				<button class="form-control btn-success" style="width: 220px;" name="publish_review" id="publish_review" value="" >Publish</button>
			</div>
			<br><span id="responsreview"></span>
			</form>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		</div>
	  </div>
	  
	</div>
</div><!--End Modal --><?php */ ?>
 

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
			<!--<label for="employee" ><h4>To Employee</h4></label>
			<div class="col-md-8 col-8 align-self-center" name="notice_user" id="notice_user">
			  <input type="text" class="form-control" name="notice_name" id="notice_name" value="" style="width: 300px;">
			</div><br />-->
			<label for="date"><h4>Date</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_date" id="notice_date">
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
		  <div id="modal_footer">
		  <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
		  </div>
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
/* Notice View Script*/
	$(document).on("click", ".g_view", function () {
		 var notice_ids = $(this).data('id');
		 /*if(!user){
			 user='For All';
		 }*/
		 var name = $(this).data('name-id');
		// alert($(this).data('todo').name);
		 var msg = $(this).data('msg-id');
		 var date = $(this).data('date-id');
		 var file = $(this).data('file-id');
		 
		if(file){
			 var file ='<a target="_blank", href="<?php echo base_url() ?>assets/upload/notices/'+file+'">'+file+'</a>';
		}
		else{
			 file = "No Attachment!";
		}
		 var type = $(this).data('type-id');
		 
		 var not_type = $(this).data('nots-id');
		 //alert($(this).data('nots-id'));
		 if(not_type=='1'){
			 var not_type ='<a href="<?php echo base_url() ?>notice/ajax_general_notice/'+notice_ids+'"><button type="button" class="btn btn-danger" >Close</button></a>';
		
		 }
		 
		 //$(".modal-body #notice_user").html( user );
		 $(".modal-body #notice_name").html( name );
		 $(".modal-body #notice_msg").html( msg );
		 $(".modal-body #notice_date").html( date );
		 $(".modal-body #notice_file").html( file );
		 $(".modal-body #notice_type").html( type );
		 $(".modal-footer #modal_footer").html( not_type );
	});
	/* End */
	
	/* General Notice Publish Script */
	$(document).ready(function(){
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
						//$("#feedbackgeneral_msg").html(data);
						$('#publish_general').text('Publish');
						$("#response").html(data);
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
						console.log(data);
						//$("#feedbackgeneral_msg").html(data);
						$('#publish_warning').text('Publish');
						$("#responsewarning").html(data);
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
						$("#responsreview").html(data);
						//$('body').load(window.location.href,'body');
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
/*function get_ajax_general_notice()
{
	$.ajax({
		url: "<?php echo base_url()."notice/ajax_general_notice"; ?>",
		type: 'POST',
		success: function(data){
			console.log(data);
			console.log("hello");
			if(data != '0'){
				$('#general_notice_table').html(data);
			}
		}
	});
}

setTimeout(function(){
	get_ajax_general_notice();
},3000);*/
</script>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
			
<?php include_once('include/footer.php'); ?> 