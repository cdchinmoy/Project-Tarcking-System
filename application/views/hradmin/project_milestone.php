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
			<h3 class="text-themecolor m-b-0 m-t-0">Project Milestone</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url()."dashboard"; ?>">Home</a></li>
				<li class="breadcrumb-item active">Milestone</li>
			</ol>
		</div>
		<?php /* ?><div class="col-md-6 col-4 align-self-center">
            <a href="<?php echo base_url()."task/add_main_task"; ?>" class="btn pull-right hidden-sm-down btn-success"> Add Task</a>
        </div><?php */ ?>
	</div>


<?php 
	$count = count($project_list); 
	if($count > 0)
	{
		$i = 1;
		foreach($project_list as $list)
		{
	
?>
<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-block">
                <h4 class="card-title" style="float:left"><?php echo $list->project_name; ?></h4>
                    <button type="button" class="btn btn-info pull-right" data-toggle="collapse" data-target="#<?php echo $list->project_id; ?>" onclick="toggler(this)" id="<?php echo $list->project_name; ?>">+</button>
                      <div id="<?php echo $list->project_id; ?>" class="collapse">
                        <div class="table-responsive m-t-40">
                            <table class="table stylish-table">
                                <thead>
                                    <tr>
                                        <th>Task Name</th>
                                        <th>Deadline</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $task_list = get_main_task_list_by_id($list->project_id); 
										$count = count($task_list);
										if($count > 0){
											foreach($task_list as $task){
								 ?>
                                    <tr>
                                        <td width="520px"><?php echo $task->task_name; ?></td>
                                        <td><?php $date = view_date_format($task->task_main_deadline);
														echo $date; ?></td>
                                        <td><?php if( $task->task_main_status==1){echo 'Active';}else {echo 'Inactive';} ?></td>
                                        <!--<td><button name="task_action" id="task_action" class="btn hidden-sm-down btn-success">Deactivate</button></td>-->
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
<?php
		}
	}
	?>

	<!-- Row -->
	<!-- ============================================================== -->
	<!-- End PAge Content -->
	<!-- ============================================================== -->
</div>
<script>
function get_ajax_time()
{
	$.ajax({
		url: "<?php echo base_url()."dashboard/elapsed_time"; ?>",
		type: 'POST',
        cache: false,
		success: function(data){
			console.log(data);
			$('#times').html(data);
		}
	});
}

/*setInterval(function(){
	get_ajax_time();
},500);*/
</script>

<script>
	function toggler(e) {
		var ids = e.id;
		if( e.innerHTML == '+' ) {
			e.innerHTML = '-';
			/*if(e.id == 'general_btn'){
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
			}*/
		}
		 else {
			 /*if(e.id == 'general_btn'){
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
			 }*/
			 e.innerHTML = '+'
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