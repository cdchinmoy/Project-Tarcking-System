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
                        <h3 class="text-themecolor m-b-0 m-t-0">Task</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url()."dashboard"; ?>">Home</a></li>
                            <li class="breadcrumb-item active">Add Task</li>
                        </ol>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                        <a href="<?php echo base_url()."task/task_list"; ?>" class="btn pull-right hidden-sm-down btn-success"> Task List</a>
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
						
							<div style="text-align:center;color:red; margin-top:10px;"><?php echo validation_errors(); ?></div>							

                            <div class="card-block">
								<?php echo form_open('task/do_add_task',array('class' => '','id'=>'add_task')); ?>
                                <input type="hidden" name="user_id" value="<?php echo $user_details[0]->user_id; ?>" />
									<div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Project Name</label>
                                        <div class="col-md-12">
                                            <select class="form-control form-control-line" name="project_id" id="project_id">
												<?php foreach($project_list as $list){ ?>
                                                <option value="<?php echo $list->project_id; ?>"><?php echo $list->project_name; ?></option>
												<?php } ?>
                                            </select>
                                        </div>
                                    </div>
								
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Task Name</label>
                                        <div class="col-md-12">
                                            
                                            <select class="form-control form-control-line" name="task_hidden" id="task_hidden" onchange="task_select()">
                                                <?php foreach($task_list as $list){ ?>
                                                
												<option value="<?php echo $list->task_main_id; ?>"><?php echo $list->task_name; ?></option>
												<?php } ?>
                                            </select>
                                        </div>
                                    </div>
									
                                        <div >
                                        	<input type="hidden" name="task_name" id="task_name" value="" />
                                        </div>
                                   
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label for="example-email" class="col-md-12">Task Date</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="" class="form-control form-control-line" name="task_date" id="" value="<?php $today = getdate(); echo $today['mon'].'/'.$today['mday'].'/'.$today['year']; ?>" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Start Time</label>
                                        <div class="col-md-12">
                                            <input type="text" name="start_time" class="start_time" id="start_time" placeholder="" class="form-control form-control-line" value="<?php echo $this->input->post('start_time'); ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-sm-12">End Time</label>
                                        <div class="col-md-12">
                                            <input type="text" name="end_time" class="end_time" id="end_time" placeholder="" class="form-control form-control-line" value="<?php echo $this->input->post('end_time'); ?>">
                                        </div>
                                    </div>
									
									<div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-sm-12">Calculate Time</label>
                                        <div class="col-md-12">
                                            <input type="text" name="calculate_time" id="calculate_time" placeholder="" class="form-control form-control-line" value="<?php echo $this->input->post('calculate_time'); ?>" onclick="Compare();" readonly>
                                        </div>
                                    </div>
									
									
									<div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Task Description</label>
                                        <div class="col-md-12">
											<textarea class="form-control form-control-line" name="task_description"><?php echo $this->input->post('task_description'); ?></textarea>
                                        </div>
                                    </div>
									
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Task Status</label>
                                        <div class="col-md-12">
											 <select class="form-control form-control-line" name="task_status">
                                                <option value="1">In Progress</option>
												<option value="2">Finished</option>
                                            </select>
                                        </div>
                                    </div>
									
                                    <div class="form-group" style="margin-top:15px;">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" onclick="add_employee_func();">Add Task</button>
											
                                        </div>
                                    </div>
									
								<?php echo form_close(); ?>	
                                
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
            
            <script>

			$(document).ready(function(e) {
				
				var project_id = $("#project_id option:first").val();

				$.ajax({
					type: 'POST',
					data: {project_id: project_id},
					url: "<?php echo base_url()."task/ajax_add_task"; ?>",
					//dataType: 'json',
        			//cache: false,
					success: function(data){
						console.log(data);
						
						$('#task_hidden').html(data);
						var sel_task = document.getElementById('task_hidden');
						var task= sel_task.options[sel_task.selectedIndex].text;
						$('#task_name').val(task);
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
					url: "<?php echo base_url()."task/ajax_add_task"; ?>",
					//dataType: 'json',
        			//cache: false,
					success: function(data){
						console.log(data);
						//$('#task_hidden').html(data[0]);
						$('#task_hidden').html(data);
						var sel_task = document.getElementById('task_hidden');
						var task= sel_task.options[sel_task.selectedIndex].text;
						$('#task_name').val(task);
					}
				});
			}
			</script>
            
            <script>
				function task_select(){
					var sel_task = document.getElementById('task_hidden');
					var task= sel_task.options[sel_task.selectedIndex].text;
					$('#task_name').val(task);
				}
			</script>
            
            
<script type="text/javascript">

function add_employee_func()
{
	document.getElementById("add_task").submit();
}

</script>			
			
<?php include_once('include/footer.php'); ?> 