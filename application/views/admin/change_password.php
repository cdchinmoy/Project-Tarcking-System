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
			<h3 class="text-themecolor m-b-0 m-t-0">Change Password</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
				<li class="breadcrumb-item active">Update Password</li>
			</ol>
		</div>

	</div>
<div class="row">
		 <div class="col-lg-10 col-xlg-11 col-md-9">
                        <div class="card">
                        <?php 
							if($this->session->userdata('message'))
							{ ?>
								<div class="alert alert-warning">
                                	
								  <strong>Warning!</strong> 
								  <?php 
								  echo $this->session->userdata('message'); 
								  $this->session->unset_userdata('message');
								  ?>
								</div>
							<?php
							}
							?>
                            
                            <div class="card-block">
                                <?php echo form_open_multipart('dashboard/do_change_password'); ?>
                                
                                  <input type="hidden" name="userid" placeholder="" class="form-control form-control-line" value="<?php echo $user_id; ?>">
                                       
                                <div class="form-group">
                                    <label for="example-name" class="col-md-12">Current Password</label>
                                    <div class="col-md-9" style="float:left">
                                        <input type="password" name="current_password" id="current_password" placeholder="" class="form-control form-control-line" value="" >
                                    </div>
                                    <div class="col-md-3"  style="float:left;">
                                    	<button type="button" name="show_current" id="show_current" onclick="toggler(this)" class="btn btn-success fa fa-eye">Show</button>
                                    </div>
                                </div><br />
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">New Password</label>
                                    <div class="col-md-9" style="float:left;">
                                        <input type="password" placeholder="New Password" class="form-control form-control-line" name="new_password" id="new_password" value="" >
                                    </div>
                                    <div class="col-md-3" style="float:left;">
                                    	<button type="button" name="show_new" id="show_new" onclick="toggler(this)" class="btn btn-success fa fa-eye">Show</button>
                                    </div>
                                </div><br />
                                <div class="form-group">
                                    <label for="example-phone" class="col-md-12">Confirm New Password</label>
                                    <div class="col-md-9" style="float:left;">
                                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm New Password" class="form-control form-control-line" value="">
                                    </div>
                                    <div class="col-md-3" style="float:left;">
                                    	<button type="button" name="show_confirm" id="show_confirm" onclick="toggler(this)" class="btn btn-success fa fa-eye">Show</button>
                                    </div>
                                </div>
                                <br />
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">Update Password</button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
	<!-- Row -->
    
    <script>
		function toggler(e) {
			if( e.innerHTML == 'Show' ) {
				if(e.id == 'show_current'){
					e.innerHTML = 'Hide'
					document.getElementById('current_password').type="text";
				}
				if(e.id == 'show_new'){
					e.innerHTML = 'Hide'
					document.getElementById('new_password').type="text";
				}
				if(e.id == 'show_confirm'){
					e.innerHTML = 'Hide'
					document.getElementById('confirm_password').type="text";
				}
			}
			 else {
				 if(e.id == 'show_current'){
					e.innerHTML = 'Show'
					document.getElementById('current_password').type="password";
				 }
				 if(e.id == 'show_new'){
					e.innerHTML = 'Show'
					document.getElementById('new_password').type="password";
				 }
				 if(e.id == 'show_confirm'){
					e.innerHTML = 'Show'
					document.getElementById('confirm_password').type="password";
				 }
			}
		}
		
		
	</script>
	<!-- ============================================================== -->
	<!-- End PAge Content -->
	<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
			
<?php include_once('include/footer.php'); ?> 