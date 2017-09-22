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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Update Task</li>
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
								<?php echo form_open('task/do_update_task',array('class' => '','id'=>'update_task')); ?>
                                <input type="hidden" name="task_id" value="<?php echo $task_details[0]->task_id; ?>" />
									<div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Project Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="project_name" placeholder="" class="form-control form-control-line" value="<?php echo $task_details[0]->project_name; ?>">
                                        </div>
                                    </div>
								
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Task Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="task_name" placeholder="" class="form-control form-control-line" value="<?php echo $task_details[0]->task_name; ?>">
                                        </div>
                                    </div>
									
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label for="example-email" class="col-md-12">Task Date</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="" class="form-control form-control-line" name="task_date" id="" value="<?php //echo $task_details[0]->task_date;
											$today = getdate();
											echo $today['mon'].'/'.$today['mday'].'/'.$today['year'];
											?>" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Start Time</label>
                                        <div class="col-md-12">
                                            <input type="text" name="start_time" class="start_time" placeholder="" class="form-control form-control-line" value="<?php echo $task_details[0]->task_start_time; ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-sm-12">End Time</label>
                                        <div class="col-md-12">
                                            <input type="text" name="end_time" class="end_time" placeholder="" class="form-control form-control-line" value="<?php echo $task_details[0]->task_end_time; ?>">
                                        </div>
                                    </div>
									
									<div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-sm-12">Calculate Time</label>
                                        <div class="col-md-12">
                                            <input type="text" name="calculate_time" placeholder="" class="form-control form-control-line" value="<?php echo $task_details[0]->calc_task_time; ?>">
                                        </div>
                                    </div>
									
									
									<div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Task Description</label>
                                        <div class="col-md-12">
											<textarea class="form-control form-control-line" name="task_description"><?php echo $task_details[0]->task_description; ?></textarea>
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
                                            <button class="btn btn-success" onclick="add_employee_func();">Update Task</button>
											
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
<script type="text/javascript">

function add_employee_func()
{
	document.getElementById("update_task").submit();
}

</script>			
			
<?php include_once('include/footer.php'); ?> 