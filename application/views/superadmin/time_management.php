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
			<h3 class="text-themecolor m-b-0 m-t-0">Time Management</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url()."dashboard"; ?>">Home</a></li>
				<li class="breadcrumb-item active">Total Manhour<?php 
					$count = count($latest_project); 
					if($count > 0)
					{
						echo ' - spent on '.$latest_project[0]->project_name;
					}
				?>
				</li>
			</ol>
		</div>
	</div>

<div class="row">
    <!-- column -->
    <div class="col-sm-12">
     <div class="card">
        
        
        <div class="card-block">
        
        <?php echo form_open('task/time_management_filter',array('class' => '','id'=>'task_time_management')); ?>
           
  			<div class="" style="float:left;">
                <div class="col-md-3 col-3 align-self-center">
                   
                    <select class="form-control" name="project_id" style="width: 230px;" id="project_id">
                       <option value="1">All Project</option>
                       <?php 
                       $count = count($project_list);
                       if($count > 0)
                       {
                           foreach($project_list as $list)
                           { 
                           ?>
                           <option value="<?php echo $list->project_id; ?>"><?php echo $list->project_name; ?></option>
                           <?php 
                           } 
                       }
                       ?>
                    </select>
                </div>
            </div>         
           
           <div class="" style="float:left;">
                <div class="col-md-3 col-3 align-self-center">
                    <!--<input type="text" class="form-control" name="employee_id" placeholder="Employee Name" style="width: 240px;">-->
                     <select class="form-control" name="employee_id" style="width: 180px;" id="employee_id">
                                <option value="">Employee Name</option>
                               <?php 
                               $count = count($employee_list);
                               if($count > 0)
                               {
                                   foreach($employee_list as $list)
                                   { 
                                        if($list->user_type != 1){
                                   ?>
                                        <option value="<?php echo $list->user_id; ?>"><?php echo $list->name; ?></option>
                                   <?php 
                                        }
                                   } 
                               }
                               ?>
                     </select>
                </div>
            </div>
           
           
           
           <div class="" style="float:left;">
                <div class="col-md-3 col-3 align-self-center">
                    <input type="text" class="form-control" name="datefilter" placeholder="Date" style="width: 190px;">
            	</div>
            </div>
  
            <div class="" style="float:left;">
				<div class="col-md-3 col-4 align-self-center">
					
					<select class="form-control" name="status_id" style="width: 170px;">
						<option value="">Status</option>
						<option value="1">In Progress</option>
						<option value="2">Finished</option>
					</select>
				</div>
			</div>
            
            <div class="" style="float:left;">
                <div class="col-md-3 col-3 align-self-center">
                    <input type="submit" class="form-control btn-success" style="width: 80px;" name="search" value="Filter" >
                </div>
            </div>
            
         <?php echo form_close(); ?>
          
      </div>
         
</div>



<?php 

	$main_task_list = get_default_task_list_by_id($latest_project[0]->project_id); 
	$count = count($main_task_list); //die;
	
	//print_r($main_task_list);
	
	if($count > 0){
		$time = 0;
		foreach($main_task_list as $main_task){
			$aa = get_total_time_by_id($main_task->task_main_id, $main_task->project_id);
			if($aa > 0){
	
			?>
<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-block">
                <h4 class="card-title" style="float:left"><?php echo $main_task->task_name; ?> (Manhour : <?php echo $t_time = get_total_time_by_id($main_task->task_main_id, $main_task->project_id); $time = $time + $t_time; ?> HOUR)</h4>
                    <?php /* ?><button type="button" class="btn btn-info pull-right" data-toggle="collapse" data-target="#<?php echo $main_task->task_main_id; ?>" onclick="toggler(this)" id="<?php echo $main_task->task_name; ?>">+</button><?php */ ?>
                      <div id="<?php echo $main_task->task_main_id; ?>" class="">
                        <div class="table-responsive m-t-40">
                            <table class="table stylish-table">
                                <thead>
                                    <tr>
                                        <th>Employee Name</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $task_list = get_all_task_by_id($main_task->task_main_id); 
										$count = count($task_list);
										if($count > 0){
											foreach($task_list as $task){
								 ?>
                                    <tr>
                                        <td width="520px"><?php echo $task->name; ?></td>
                                        <td><?php $date = view_date_format($task->task_date);
														echo $date; ?></td>
                                        <td><?php if( $task->task_status==1){echo 'In Progress';}else {echo 'Finished';} ?></td>
                                        <td><?php echo $task->calc_task_time." Hour"; ?></td>
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
        
          <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                		<h4 class="card-title" style="float:right; margin-right:50px;"><?php echo $latest_project[0]->project_name ;?> : Total Manhour - <?php echo $time; ?> HOUR</h4>
                        
                   
                </div>
            </div>
        <?php 
	}
	else {
		echo '<div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                		<h4 class="card-title" style="float:right; margin-right:50px;"> NO RECORD FOUND!</h4>
                        
                   
                </div>
            </div>';
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


$(function() {

  $('input[name="datefilter"]').daterangepicker({
	  autoUpdateInput: false,
	  locale: {
		  cancelLabel: 'Clear'
	  }
  });

  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
	  var dt = $(this).val(picker.startDate.format('DD/MM/YYYY') + '-' + picker.endDate.format('DD/MM/YYYY'));
	 // doSearch(dt);
	// get_dateWise_task_list(dt);
  });

  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
	  $(this).val('');
  });

});
</script>

 <script>

	$(document).ready(function(e) {
		
		var project_id = $("#project_id option:first").val();
	
		$.ajax({
			type: 'POST',
			data: {project_id: project_id},
			url: "<?php echo base_url()."task/ajax_get_employee"; ?>",
			//dataType: 'json',
			//cache: false,
			success: function(data){
				console.log(data);
				
				$('#employee_id').html(data);
				//var sel_emp = document.getElementById('employee_id');
				//var emp= sel_emp.options[sel_emp.selectedIndex].text;
				//$('#task_name').val(emp);
			}
		});
				  
	});
				
	$("#project_id").on("change", function(){
			var selected = $(this).val();
			//$("#employee_id").html("You selected: " + selected);
			ajax_get_task_selected(selected);
		});
		
	function ajax_get_task_selected(opts)
	{
		$.ajax({
			type: 'POST',
			data: {project_id: opts},
			url: "<?php echo base_url()."task/ajax_get_employee"; ?>",
			//dataType: 'json',
			//cache: false,
			success: function(data){
				console.log(data);
				//$('#task_hidden').html(data[0]);
				$('#employee_id').html(data);
				//var sel_task = document.getElementById('task_hidden');
				//var task= sel_task.options[sel_task.selectedIndex].text;
				//$('#task_name').val(task);
			}
		});
	}
</script>
	
<script>
	/*function task_select(){
		var sel_task = document.getElementById('task_hidden');
		var task= sel_task.options[sel_task.selectedIndex].text;
		$('#task_name').val(task);
	}*/
</script>
<script>
	function toggler(e) {
		var ids = e.id;
		if( e.innerHTML == '+' ) {
			e.innerHTML = '-';
		}
		 else {
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