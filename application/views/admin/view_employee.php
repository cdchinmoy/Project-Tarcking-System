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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">View Employee</li>
                            <li class="breadcrumb-item active"><?php echo $emp_details[0]->name; ?></li>
                        </ol>
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
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-block">
                                <center class="m-t-30"> <img src="<?php echo base_url(); ?>assets/upload/profile_image/<?php if(!empty($emp_details[0]->user_iamge)){ echo $emp_details[0]->user_iamge; }else {?>noimage.png<?php } ?>" class="img-circle" width="150" />
                                    <h4 class="card-title m-t-10"><?php echo $emp_details[0]->name; ?></h4>
                                    <!--<h6 class="card-subtitle">Accoubts Manager Amix corp</h6>
                                    <div class="row text-center justify-content-md-center">
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">254</font></a></div>
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div>
                                    </div>-->
                                </center>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-block">
                               
                               <?php echo form_open_multipart(); ?>
                                
                                            <input type="hidden" name="userid" placeholder="" class="form-control form-control-line" value="<?php echo $emp_details[0]->user_id; ?>">
                                       
                                    <div class="form-group">
                                        <label for="example-name" class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="example-name" placeholder="" class="form-control form-control-line" value="<?php echo $emp_details[0]->name; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" placeholder="" class="form-control form-control-line" name="example-email" id="example-email" value="<?php echo $emp_details[0]->user_email; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-phone" class="col-md-12">Phone No</label>
                                        <div class="col-md-12">
                                            <input type="text" name="example-phone" placeholder="" class="form-control form-control-line" value="<?php echo $emp_details[0]->phone_no; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-id" class="col-md-12">Employee Id</label>
                                        <div class="col-md-12">
                                             <input type="text" name="example-id" placeholder="" class="form-control form-control-line" value="<?php echo $emp_details[0]->employee_id; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="col-md-12">Employee Address</label>
                                        <div class="col-md-12">
                                             <textarea name="address" placeholder="" class="form-control form-control-line" disabled><?php echo $emp_details[0]->address; ?></textarea>
                                        </div>
                                    </div>
                                    <!--<div class="form-group">                                        <label for="userfile" class="col-md-12">Picture</label>                                        <div class="col-md-12">                                             <input type="file" name="userfile" placeholder="" class="form-control form-control-line">                                        </div> -->                                   </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <!--<button class="btn btn-success">Update Profile</button-->
                                        </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                <!--</form>-->
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
			
<?php include_once('include/footer.php'); ?> 