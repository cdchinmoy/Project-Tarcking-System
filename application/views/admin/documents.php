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
			<h3 class="text-themecolor m-b-0 m-t-0">Documents</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url()."dashboard"; ?>">Home</a></li>
				<li class="breadcrumb-item active">Document Management</li>
			</ol>
		</div>
		
	</div>
	
	
	<?php 
	if($this->session->userdata('message'))
	{ ?>
		<div class="alert alert-success">
		  <strong></strong> 
		  <?php 
		  echo $this->session->userdata('message'); 
		  $this->session->unset_userdata('message');
		  ?>
		</div>
	<?php
	}
?>


	
<div class="card">	
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'pay_slip')" id="defaultOpen">Pay Slips</button>
  <button class="tablinks" onclick="openCity(event, 'offer_letter')">Offer Letter</button>
  <button class="tablinks" onclick="openCity(event, 'appt_letter')">Appointment Letter</button>
</div>

<div id="pay_slip" class="tabcontent">
  <h3>Pay Slips</h3>
  <div class="table-responsive m-t-40">
						<table class="table stylish-table">
							<thead>
								<tr>
									<th>Month</th>
									
									<th>Date</th>
									<th>Attachment</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="casual_leave_cont">
							<?php //$task_list = get_main_task_list_by_id($list->project_id); 
									$count = count($pay_slip);
									if($count > 0){
										foreach($pay_slip as $slip){
							 ?>
								<tr <?php if($slip->notification_status ==0){ echo "style='background:#E1E1D2 !important;'"; } ?>>
									<td width="350px"><h5><?php echo $slip->document_month; ?></h5><small><?php //if($slip->employee_designation == 1){echo 'Project Manager';}
																										//if($slip->employee_designation == 2){echo 'Employee';}
																										//if($slip->employee_designation == 3){echo 'HR Manager';}
																								?></small></td>
									
									<td><?php $s_date = view_date_format($slip->document_added_date);
													echo $s_date; ?></td>
									<td>
										<?php if($slip->document_src != ""){?>
											<a target="_blank", href="<?php echo base_url() ?>assets/upload/documents/<?php echo $slip->document_src ?>"><?php echo $slip->document_src ?></a>
										<?php
										} 
										?>
									</td>
									<td>
										<button name="casual_view" id="casual_view" data-id="<?php echo $slip->document_id ?>" data-name-id="<?php echo $slip->document_type ?>" data-msg-id="<?php echo $slip->document_src ?>" data-sdate-id="<?php echo $s_date ?>" data-days-id="<?php echo $slip->document_month ?>" data-file-id="<?php echo $slip->document_src ?>" data-type-id="Pay-Slip" data-nots-id="<?php echo $slip->document_type ?>" class="g_view btn btn-success" data-toggle="modal" data-target="#viewModal">View</button>
										
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

<div id="offer_letter" class="tabcontent">
  <h3>Offer Letter</h3>
  <div class="table-responsive m-t-40">
						<table class="table stylish-table">
							<thead>
								<tr>
									<th>Month</th>
									
									<th>Date</th>
									<th>Attachment</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="paid_leave_cont">
							<?php //$task_list = get_main_task_list_by_id($list->project_id); 
									$count = count($offer_letter);
									if($count > 0){
										foreach($offer_letter as $offer){
							 ?>
								<tr <?php if($offer->notification_status ==0){ echo "style='background:#E1E1D2 !important;'"; } ?>>
									<td width="350px"><h5><?php echo $offer->document_month; ?></h5><small><?php //if($paid->employee_designation == 1){echo 'Project Manager';}
									//if($paid->employee_designation == 2){echo 'Employee';}
									//if($paid->employee_designation == 3){echo 'HR Manager';}
							?></small></td>
									
									<td><?php $s_date = view_date_format($offer->document_added_date);
													echo $s_date; ?></td>
									<td>
										<?php if($offer->document_src != ""){?>
											<a target="_blank", href="<?php echo base_url() ?>assets/upload/documents/<?php echo $offer->document_src ?>"><?php echo $offer->document_src ?></a>
										<?php
										} 
										?>
									</td>
									<td>
										<button name="paid_view" id="paid_view" data-id="<?php echo $offer->document_id ?>" data-name-id="<?php echo $offer->document_type ?>" data-msg-id="<?php echo $offer->document_src ?>" data-sdate-id="<?php echo $s_date ?>" data-days-id="<?php echo $offer->document_month ?>" data-file-id="<?php echo $offer->document_src ?>" data-type-id="Offer Letter" data-nots-id="<?php echo $offer->document_type ?>" class="g_view btn btn-success" data-toggle="modal" data-target="#viewModal">View</button>
										
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

<div id="appt_letter" class="tabcontent">
  <h3>Appointment Letter</h3>
  <div class="table-responsive m-t-40">
						<table class="table stylish-table">
							<thead>
								<tr>
									<th>Month</th>
									
									<th>Date</th>
									<th>Attachment</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="review_notices_cont">
							<?php //$task_list = get_main_task_list_by_id($list->project_id); 
									$count = count($appointment_letter);
									if($count > 0){
										foreach($appointment_letter as $appointment){
							 ?>
								<tr <?php if($appointment->notification_status ==0){ echo "style='background:#E1E1D2 !important;'"; } ?>>
									<td width="350px"><h5><?php echo $appointment->document_month; ?></h5><small><?php //if($casual->employee_designation == 1){echo 'Project Manager';}
																										//if($casual->employee_designation == 2){echo 'Employee';}
																										//if($casual->employee_designation == 3){echo 'HR Manager';}
																								?></small></td>
									
									<td><?php $s_date = view_date_format($appointment->document_added_date);
													echo $s_date; ?></td>
									<td>
										<?php if($appointment->document_src != ""){?>
											<a target="_blank", href="<?php echo base_url() ?>assets/upload/documents/<?php echo $appointment->document_src ?>"><?php echo $appointment->document_src ?></a>
										<?php
										} 
										?>
									</td>
									<td>
										<button name="sick_view" id="sick_view" data-id="<?php echo $appointment->document_id ?>" data-name-id="<?php echo $appointment->document_type ?>" data-msg-id="<?php echo $appointment->document_src ?>" data-sdate-id="<?php echo $s_date ?>" data-days-id="<?php echo $appointment->document_month ?>" data-file-id="<?php echo $appointment->document_src ?>" data-type-id="Appointment Letter" data-nots-id="<?php echo $appointment->document_type ?>" class="g_view btn btn-success" data-toggle="modal" data-target="#viewModal">View</button>
										
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
	
<div class="card">	
	<div class="tab">
	  <button class="tablink" onclick="openNotice(event, 'warnings')" id="defaultOpens">Warnings</button>
	  <button class="tablink" onclick="openNotice(event, 'q_reviews')">Quaterly Reviews</button>
	</div>

	<div id="warnings" class="tabcontents">
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-block">
			<h4 class="card-title" style="float:left">Warnings</h4>&nbsp;&nbsp;&nbsp;<?php /* ?><button name="add_warning" type="button" id="add_warning" class="btn hidden-sm-down btn-success" style="font-size:11px;" data-toggle="modal" data-target="#warningModal">Add New</button><?php */ ?>
				<!--<button type="button" class="btn btn-info pull-right" data-toggle="collapse" data-target="#warning" data-id="">+</button>-->
				  <div id="warning" class="">
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
								<tr <?php if($warning->notification_status ==0){ echo "style='background:#E1E1D2 !important;'"; } ?>>
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
										<button name="warning_view" id="warning_view" data-id="<?php echo $warning->notice_id ?>" data-name-id="<?php echo $warning->notice_name ?>" data-msg-id="<?php echo $warning->notice_message ?>" data-date-id="<?php echo $date ?>" data-file-id="<?php echo $warning->notice_file ?>" data-type-id="Warning Notice" data-nots-id="<?php echo $warning->notice_type ?>" class="g_view btn btn-success" data-toggle="modal" data-target="#noticeModal">View</button>
										<?php /* ?><a href="<?php echo base_url()."notice/delete_notice/".$warning->notice_id; ?>"><button name="delete_warning" id="delete_warning" class="btn hidden-sm-down btn-danger">Delete</button></a><?php */ ?>
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
 <div id="q_reviews" class="tabcontents">
 
 <div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-block">
			<h4 class="card-title" style="float:left">Quaterly Reviews</h4>&nbsp;&nbsp;&nbsp;<?php /* ?><button name="add_review" type="button" id="add_review" class="btn hidden-sm-down btn-success" style="font-size:11px;" data-toggle="modal" data-target="#reviewModal">Add New</button><?php */ ?>
				<!--<button type="button" class="btn btn-info pull-right" data-toggle="collapse" data-target="#review" data-id="">+</button>-->
				  <div id="review" class="">
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
								<tr <?php if($review->notification_status ==0){ echo "style='background:#E1E1D2 !important;'"; } ?>>
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
										<button name="review_view" id="review_view" data-id="<?php echo $review->notice_id ?>" data-name-id="<?php echo $review->notice_name ?>" data-msg-id="<?php echo $review->notice_message ?>" data-date-id="<?php echo $date ?>" data-file-id="<?php echo $review->notice_file ?>" data-type-id="Quarterly Review Notice" data-nots-id="<?php echo $review->notice_type ?>" class="g_view btn btn-success" data-toggle="modal" data-target="#noticeModal">View</button>
										<?php /* ?><a href="<?php echo base_url()."notice/delete_notice/".$review->notice_id; ?>"><button name="delete_review" id="delete_review" class="btn hidden-sm-down btn-danger">Delete</button></a><?php */ ?>
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
 </div>

 <!-- View Modal -->
<div class="modal fade" id="viewModal" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">

	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Documents View</h4>
		</div>
		<div class="modal-body">
		
		<!--<form class="feedback" name="feedback" action="javascript:void(0);" method="POST">-->
			<input type="hidden" name="task_id" id="task_id" value=""/>
			<!--<label for="name" ><h4>Name</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_name" id="notice_name">
			  <!--<input type="text" class="form-control" name="notice_name" id="notice_name" value="" style="width: 300px;">
			</div><br />-->
			<!--<label for="employee" ><h4>Employee</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_user" id="notice_user">
			  <!--<input type="text" class="form-control" name="notice_name" id="notice_name" value="" style="width: 300px;">
			</div><br />-->
			<!--<label for="msg"><h4>Message</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_msg" id="notice_msg">
			  <input type="text" class="form-control" name="notice_msg" id="notice_msg" value="" style="width: 300px;">
			</div><br />-->
			
			<label for="sdate"><h4>Date</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_sdate" id="notice_sdate">
			  <!--<input type="text" class="form-control" name="notice_date" id="notice_date" value="" style="width: 300px;">-->
			</div><br />
			<!--<label for="edate"><h4>End Date</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_edate" id="notice_edate">
			  <input type="text" class="form-control" name="notice_date" id="notice_date" value="" style="width: 300px;">
			</div><br />-->
			<label for="edate"><h4>Month</h4></label>
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
		  <div id="modal_doc_footer">
		  <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
		  </div>
		</div>
	  </div>
	  
	</div>
</div><!--End Modal -->

<!-- Notice View Modal -->
<div class="modal fade" id="noticeModal" role="dialog">
	<div class="modal-dialog">

	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Notice View</h4>
		</div>
		<div class="modal-body">
		
		<!--<form class="feedback" name="feedback" action="javascript:void(0);" method="POST">-->
			<input type="hidden" name="notice_ids" id="notice_ids" value=""/>
			<label for="name" ><h4>Name</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_names" id="notice_names">
			  <!--<input type="text" class="form-control" name="notice_name" id="notice_name" value="" style="width: 300px;">-->
			</div><br />
			<label for="msg"><h4>Message</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_msgs" id="notice_msgs">
			  <!--<input type="text" class="form-control" name="notice_msg" id="notice_msg" value="" style="width: 300px;">-->
			</div><br />
			<!--<label for="employee" ><h4>To Employee</h4></label>
			<div class="col-md-8 col-8 align-self-center" name="notice_user" id="notice_user">
			  <input type="text" class="form-control" name="notice_name" id="notice_name" value="" style="width: 300px;">
			</div><br />-->
			<label for="date"><h4>Date</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_dates" id="notice_dates">
			  <!--<input type="text" class="form-control" name="notice_date" id="notice_date" value="" style="width: 300px;">-->
			</div><br />
			<label for="file"><h4>Attachment</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_files" id="notice_files">
			  <!--<input type="text" class="form-control" name="notice_file" id="notice_file" value="" style="width: 300px;">-->
			</div><br />
			<label for="type"><h4>Type</h4></label>
			<div class="col-md-12 col-12 align-self-center" name="notice_types" id="notice_types">
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
/* Document View Script*/
	$(document).on("click", ".g_view", function () {
		 var notice_ids = $(this).data('id');
		 
		 var name = $(this).data('name-id');
		// alert($(this).data('todo').name);
		 var msg = $(this).data('msg-id');
		 var sdate = $(this).data('sdate-id');
		 var edate = $(this).data('edate-id');
		 var t_days = $(this).data('days-id');
		 var file = $(this).data('file-id');
		 
		if(file){
			 var file ='<a target="_blank", href="<?php echo base_url() ?>assets/upload/documents/'+file+'">'+file+'</a>';
		}
		else{
			 file = "No Attachment!";
		}
		 var type = $(this).data('type-id');
		 
		 var not_type = $(this).data('nots-id');
		 //alert($(this).data('nots-id'));
		 if(not_type=='1'){
			 var not_type ='<a href="<?php echo base_url() ?>document/ajax_payslip/'+notice_ids+'"><button type="button" class="btn btn-danger" >Close</button></a>';
		
		 }
		 if(not_type=='2'){
			 var not_type ='<a href="<?php echo base_url() ?>document/ajax_appointment/'+notice_ids+'"><button type="button" class="btn btn-danger" >Close</button></a>';
		
		 }
		 if(not_type=='3'){
			 var not_type ='<a href="<?php echo base_url() ?>document/ajax_offer_letter/'+notice_ids+'"><button type="button" class="btn btn-danger" >Close</button></a>';
		 }
		 
		 //$(".modal-body #notice_user").html( user );
		 $(".modal-body #notice_name").html( name );
		 $(".modal-body #notice_msg").html( msg );
		 $(".modal-body #notice_sdate").html( sdate );
		 $(".modal-body #notice_edate").html( edate );
		 $(".modal-body #notice_days").html( t_days );
		 $(".modal-body #notice_file").html( file );
		 $(".modal-body #notice_type").html( type );
		 $(".modal-footer #modal_doc_footer").html( not_type );
	});
	/* End */
	
	
	/* Notice View Script*/
	$(document).on("click", ".g_view", function () {
		 var notice_ids = $(this).data('id');
		 
		 var name = $(this).data('name-id');
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
		 if(not_type=='2'){
			 var not_type ='<a href="<?php echo base_url() ?>document/ajax_warning_notice/'+notice_ids+'"><button type="button" class="btn btn-danger" >Close</button></a>';
		
		 }
		 if(not_type=='3'){
			 var not_type ='<a href="<?php echo base_url() ?>document/ajax_review_notice/'+notice_ids+'"><button type="button" class="btn btn-danger" >Close</button></a>';
		 }
		 
		 $(".modal-body #notice_ids").val( notice_ids );
		 $(".modal-body #notice_names").html( name );
		 $(".modal-body #notice_msgs").html( msg );
		 $(".modal-body #notice_dates").html( date );
		 $(".modal-body #notice_files").html( file );
		 $(".modal-body #notice_types").html( type );
		 $(".modal-footer #modal_footer").html( not_type );
	});
	/* End */
</script><!--End-->



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

function openNotice(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontents");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpens").click();

function add_document_func()
{
	
    var document_type = document.forms["add_docs"]["document_type"].value;
	var employee_id = document.forms["add_docs"]["employee_id"].value;
	var document_month = document.forms["add_docs"]["document_month"].value;
	var userfile = document.forms["add_docs"]["userfile"].value;
    if (document_type == "" || employee_id == "" || document_month == "" || userfile == "") {
        alert("All fields must be filled out!");
        return false;
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