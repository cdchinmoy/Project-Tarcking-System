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
                        <h3 class="text-themecolor m-b-0 m-t-0">Projects</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url()."dashboard"; ?>">Home</a></li>
                            <li class="breadcrumb-item active">Assign Project</li>
                        </ol>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                        <a href="<?php echo base_url()."project/project_list"; ?>" class="btn pull-right hidden-sm-down btn-success"> Project List</a>
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
                            <div class="card-block">
								
								<?php echo form_open('project/do_assign_project',array('class' => '','id'=>'assign_project')); ?>
									
									<div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-sm-12">Select Project</label>
                                        <div class="col-sm-12">
                                            <select class="form-control form-control-line" name="project_id" id="project_id">
												<?php foreach($project_list as $list){ ?>
                                                <option value="<?php echo $list->project_id; ?>"><?php echo $list->project_name; ?></option>
												<?php } ?>
                                            </select>
                                        </div>
                                    </div>								
									
									<div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-sm-12">Select Employee</label>
                                        <div class="col-sm-12" >
                                            <select multiple class="form-control form-control-line" name="employee_id[]" id="employee_id">
                                                <?php foreach($employee_list as $list){ ?>
												<option value="<?php echo $list->user_id; ?>"><?php echo $list->name; ?></option>
												<?php } ?>
                                            </select>
                                        </div>
                                    </div>
								
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label for="example-email" class="col-md-12">Project Manager</label>
                                        <div class="col-sm-12">
                                            <select class="form-control form-control-line" name="project_manager_id">
												<?php foreach($project_manager_list as $list){ ?>
                                                <option value="<?php echo $list->user_id; ?>"><?php echo $list->name; ?></option>
												<?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" style="margin-top:15px;">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" onclick="add_employee_func();">Assign Project</button>
											
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
					url: "<?php echo base_url()."project/ajax_assign_project"; ?>",
					success: function(data){
						console.log(data);
						$('#employee_id').html(data);
					}
				});
				          
            });
						
			$("#project_id").on("change", function(){
					var selected = $(this).val();
					//$("#employee_id").html("You selected: " + selected);
					get_ajax_assign_project(selected);
     		 	});
				
			function get_ajax_assign_project(opts)
			{
				$.ajax({
					type: 'POST',
					data: {project_id: opts},
					url: "<?php echo base_url()."project/ajax_assign_project"; ?>",
					success: function(data){
						console.log(data);
						$('#employee_id').html(data);
					}
				});
			}
			</script>
    
<script type="text/javascript">

function add_employee_func()
{
	document.getElementById("assign_project").submit();
}

</script>			
			
<?php include_once('include/footer.php'); ?> 