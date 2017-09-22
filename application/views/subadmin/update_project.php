<?php //print_r($project_type); die; ?>

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
                        <h3 class="text-themecolor m-b-0 m-t-0">Project</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url()."dashboard"; ?>">Home</a></li>
                            <li class="breadcrumb-item active">Update Project</li>
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
							/*if($this->session->flashdata('item'))							
							{								
															
							}*/							
							?>
                            <div class="card-block">
								<?php echo form_open('project/do_update_project',array('class' => '','id'=>'update_project')); ?>
								
								<input type="hidden" name="project_id" value="<?php echo $project_details[0]->project_id; ?>">
								
									<div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Project Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="project_name" placeholder="" class="form-control form-control-line" value="<?php echo $project_details[0]->project_name; ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Project Description</label>
                                        <div class="col-md-12">
                                            <textarea name="pro_description" value="<?php echo $project_details[0]->project_description; ?>"></textarea>
                                            </div>
                                    </div>
									
									<?php /* ?><div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Project Type</label>
                                         <div class="col-sm-12">
                                            <select class="form-control form-control-line" name="project_type">
                                               <?php 
											   $count = count($project_type);
											   if($count > 0)
											   {
												   foreach($project_type as $type)
												   { 
												   ?>
												   <option value="<?php echo $type->project_type_id; ?>"><?php echo $type->project_type_name; ?></option>
												   <?php 
												   } 
											   }
											   ?>
                                            </select>
                                        </div>
                                    </div><?php */ ?>
								
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Total Manhour</label>
                                        <div class="col-md-12">
                                            <input type="text" name="total_manhour" placeholder="" class="form-control form-control-line" value="<?php echo $project_details[0]->project_total_manhour; ?>">
                                        </div>
                                    </div>
									
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label for="example-email" class="col-md-12">Project Valuation($)</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="" class="form-control form-control-line" name="project_valuation" id="example-email" value="<?php echo $project_details[0]->project_valueation; ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Project Start Date</label>
                                        <div class="col-md-12">
                                            <input type="text" name="project_start" id="datepicker1" placeholder="" class="form-control form-control-line" value="<?php echo $project_details[0]->project_start; ?>">
                                        </div>
                                    </div>
									
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Project End Date</label>
                                        <div class="col-md-12">
                                            <input type="text" name="project_end" id="datepicker2" placeholder="" class="form-control form-control-line" value="<?php echo $project_details[0]->project_deadline; ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-sm-12">Prject Priroty</label>
                                        <div class="col-sm-12">
                                            <select class="form-control form-control-line" name="project_priroty">
                                                <option value="1" <?php if($project_details[0]->project_priroty == "1"){ echo "selected";} ?>>High</option>
                                                <option value="2" <?php if($project_details[0]->project_priroty == "2"){ echo "selected";} ?>>Mediuam</option>
                                                <option value="3" <?php if($project_details[0]->project_priroty == "3"){ echo "selected";} ?>>Low</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-top:15px;">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" onclick="add_project_func();">Update Project</button>
											
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

function add_project_func()
{
	document.getElementById("update_project").submit();
}

</script>
<script>
	CKEDITOR.replace( 'pro_description' );
</script>			
			
<?php include_once('include/footer.php'); ?> 