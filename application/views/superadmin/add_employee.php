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
                            <li class="breadcrumb-item active">Add Employee</li>
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
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
						
							<div style="text-align:center;color:red; margin-top:10px;"><?php echo validation_errors(); ?></div>							
							<?php 							
							if($this->session->flashdata('item'))							
							{								
								echo $this->session->flashdata('item');							
							}							
						?>
                            <div class="card-block">
								<?php echo form_open('employee/do_add_employee',array('class' => '','id'=>'add_employee')); ?>
									<div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Employee Id</label>
                                        <div class="col-md-12">
                                            <input type="text" name="employee_id" placeholder="" class="form-control form-control-line" value="<?php echo $this->input->post('employee_id'); ?>">
                                        </div>
                                    </div>
								
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="full_name" placeholder="" class="form-control form-control-line" value="<?php echo $this->input->post('full_name'); ?>">
                                        </div>
                                    </div>
									
									<div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Designation</label>
                                        <div class="col-sm-12">
                                            <select class="form-control form-control-line" name="employee_designation">
                                                <option value="1">Project Manager</option>
                                                <option value="2">Employee</option>
                                                <option value="3">HR Manager</option>
                                            </select>
                                        </div>
                                    </div>
									
									
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" placeholder="" class="form-control form-control-line" name="email" id="example-email" value="<?php echo $this->input->post('email'); ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Phone No</label>
                                        <div class="col-md-12">
                                            <input type="text" name="phone_no" placeholder="" class="form-control form-control-line" value="<?php echo $this->input->post('phone_no'); ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-sm-12">User Type</label>
                                        <div class="col-sm-12">
                                            <select class="form-control form-control-line" name="user_type">
                                                <option value="2">Sub Admin</option>
                                                <option value="3">User</option>
												<option value="4">HR Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-sm-12">Department</label>
                                        <div class="col-sm-12">
                                            <select class="form-control form-control-line" name="department">
                                                <option value="1">Design & Develpoment</option>
                                                <option value="2">SEO</option>
                                                <option value="3">Contents</option>
                                                <option value="4">Accounts</option>
												<option value="5">Human Resource</option>
                                            </select>
                                        </div>
                                    </div>
                                    
									<div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Salary</label>
                                        <div class="col-md-12">
                                            <input type="text" name="salary" placeholder="" class="form-control form-control-line" value="<?php echo $this->input->post('salary'); ?>">
                                        </div>
                                    </div>
									
									<div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Joining Date</label>
                                        <div class="col-md-12">
                                            <input type="text" name="joining_date" id="joining_date" placeholder="" class="form-control form-control-line" value="<?php echo $this->input->post('joining_date'); ?>">
                                        </div>
                                    </div>
									
                                    <div class="form-group" style="margin-top:15px;">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" onclick="add_employee_func();">Add Employee</button>
											
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
	document.getElementById("add_employee").submit();
}

</script>			
			
<?php include_once('include/footer.php'); ?> 