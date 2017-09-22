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
                        <h3 class="text-themecolor m-b-0 m-t-0">Project Milestone</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Add Task</li>
                        </ol>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                        <a href="<?php echo base_url()."task/project_milestone"; ?>" class="btn pull-right hidden-sm-down btn-success"> Milestones</a>
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
							<div style="text-align:center;color:red; margin-top:10px;"><?php echo validation_errors(); ?></div>							

                            <div class="card-block">
								<?php echo form_open('task/do_add_main_task',array('class' => '','id'=>'add_main_task')); ?>
                                <input type="hidden" name="user_id" value="<?php echo $user_details[0]->user_id; ?>" />
									<div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Project Name</label>
                                        <div class="col-md-12">
                                            <select class="form-control form-control-line" name="project_id">
												<?php foreach($project_list as $list){ ?>
                                                <option value="<?php echo $list->project_id; ?>"><?php echo $list->project_name; ?></option>
												<?php } ?>
                                            </select>
                                        </div>
                                    </div>
								
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Task Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="task_name" placeholder="" class="form-control form-control-line" value="<?php echo $this->input->post('task_name'); ?>">
                                        </div>
                                    </div>
									<div class="form-group" style="margin-bottom: 5px;">
                                        <label for="example-email" class="col-md-12">Task Deadline</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="" class="form-control form-control-line" name="task_deadline" id="task_deadline">
                                        </div>
                                    </div>
                                   
									
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Task Status</label>
                                        <div class="col-md-12">
											 <select class="form-control form-control-line" name="task_status">
                                                <option value="1">Active</option>
												<option value="2">Inactive</option>
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
<script type="text/javascript">

function add_employee_func()
{
	document.getElementById("add_main_task").submit();
}

</script>
		
			
<?php include_once('include/footer.php'); ?> 