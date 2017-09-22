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
                            <li class="breadcrumb-item active">Update Employee</li>
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
								<?php echo form_open('employee/do_update_employee',array('class' => '','id'=>'update_employee')); ?>
								
									<input type="hidden" name="user_id" value="<?php echo $emp_details[0]->user_id; ?>">
								
									<div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Employee Id</label>
                                        <div class="col-md-12">
                                            <input type="text" name="employee_id" placeholder="" class="form-control form-control-line" value="<?php echo $emp_details[0]->employee_id; ?>">
                                        </div>
                                    </div>
								
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="full_name" placeholder="" class="form-control form-control-line" value="<?php echo $emp_details[0]->name; ?>">
                                        </div>
                                    </div>
									
									<div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Designation</label>
                                        <div class="col-sm-12">
										<input type="hidden" name="employee_designation" value="<?php echo $emp_details[0]->employee_designation; ?>">
											<input type="text" placeholder="" class="form-control form-control-line" value="<?php if($emp_details[0]->employee_designation == "1"){ echo "Project Manager";}
																																	if($emp_details[0]->employee_designation == "2"){ echo "Employee";}
																																	if($emp_details[0]->employee_designation == "3"){ echo "HR Manager";}
																																	?>" readonly>
                                            
                                        </div>
                                    </div>
									
									
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" placeholder="" class="form-control form-control-line" name="email" id="example-email" value="<?php echo $emp_details[0]->user_email; ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Phone No</label>
                                        <div class="col-md-12">
                                            <input type="text" name="phone_no" placeholder="" class="form-control form-control-line" value="<?php echo $emp_details[0]->phone_no; ?>">
                                        </div>
                                    </div>
                                    
									<?php if($emp_details[0]->user_type != "1"){ ?>
									
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-sm-12">User Type</label>
                                        <div class="col-sm-12">
										
											<input type="hidden" name="user_type" value="<?php echo $emp_details[0]->user_type; ?>">
											<input type="text" placeholder="" class="form-control form-control-line" value="<?php if($emp_details[0]->user_type == "2"){ echo "Sub Admin";}
																																	if($emp_details[0]->user_type == "3"){ echo "User";}
																																	if($emp_details[0]->user_type == "4"){ echo "HR Admin";}
																																	?>" readonly>
                                            
                                        </div>
                                    </div>
									<?php } ?>
                                    
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-sm-12">Department</label>
                                        <div class="col-sm-12">
                                            <select class="form-control form-control-line" name="department">
                                                <option value="1" <?php if($emp_details[0]->department_id == "1"){ echo "selected";} ?>>Design & Develpoment</option>
                                                <option value="2" <?php if($emp_details[0]->department_id == "2"){ echo "selected";} ?>>SEO</option>
                                                <option value="3" <?php if($emp_details[0]->department_id == "3"){ echo "selected";} ?>>Contents</option>
                                                <option value="4" <?php if($emp_details[0]->department_id == "4"){ echo "selected";} ?>>Accounts</option>
                                            </select>
                                        </div>
                                    </div>
                                    
									<!--<div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Salary</label>
                                        <div class="col-md-12">
                                            <input type="text" name="salary" placeholder="" class="form-control form-control-line" value="<?php //echo $emp_details[0]->employee_salary; ?>">
                                        </div>
                                    </div>-->
									
									<div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Joining Date</label>
                                        <div class="col-md-12">
                                            <input type="text" name="joining_date" id="joining_date" placeholder="" class="form-control form-control-line" value="<?php $date = view_date_format($emp_details[0]->joining_date); echo $date; ?>">
                                        </div>
                                    </div>
									
                                    <div class="form-group" style="margin-top:15px;">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" onclick="add_employee_func();">Update Employee</button>
											
                                        </div>
                                    </div>
									
								<?php echo form_close(); ?>	
                                
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
					
					<!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
					
                        <div class="card">
							
							<div style="text-align:center;color:red; margin-top:10px;"><?php echo validation_errors(); ?></div>							
							
                            <div class="card-block">
							<h4 class="card-title m-t-10" style="float:left">Salary:</h4>
							
								<?php echo form_open('employee/do_update_salary',array('class' => '','id'=>'update_salary')); ?>
								
									<div class="form-group" style="margin-bottom: 10px;">
                                        <label class="col-md-12">Choose Category</label>
										<div class="col-md-12">
											<input type="radio" onClick="get_inc_sal();" name="update_type" id="get_sal" value="inc">Increment Salary<br>
											<input type="radio" onClick="get_upd_sal();" name="update_type" id="get_sal" value="upd"> Update Salary<br>
										</div>
									</div>
									
									
									<input type="hidden" name="user_id" id="user_id" value="<?php echo $emp_details[0]->user_id; ?>">
									<input type="hidden" name="salary_id" id="salary_id" value="<?php echo $emp_details[0]->salary_id; ?>">
									<input type="hidden" name="salary_year" id="salary_year" value="<?php echo $emp_details[0]->salary_year; ?>">
									<div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">Current Salary</label>
                                        <div class="col-md-12">
                                            <input type="text" name="salary" id="cur_salary" placeholder="" class="form-control form-control-line" value="<?php echo $emp_details[0]->employee_salary; ?>" readonly>
                                        </div>
                                    </div>
									
									<div class="form-group" style="margin-bottom: 5px;" id="inc_pr">
                                        <label class="col-md-12">Increment(%)</label>
                                        <div class="col-md-12">
                                            <input type="text" name="salary_percent" id="salary_percent" placeholder="" class="form-control form-control-line" value="">
                                        </div>
                                    </div>
									
									<div class="form-group" style="margin-bottom: 5px;" id="inc_amt">
                                        <label class="col-md-12">Increment(Amount)</label>
                                        <div class="col-md-12">
                                            <input type="text" name="salary_amount" id="salary_amount" placeholder="" class="form-control form-control-line" value="">
                                        </div>
                                    </div>
									
									<div class="form-group" style="margin-bottom: 5px;">
                                        <label class="col-md-12">New Salary</label>
                                        <div class="col-md-12">
                                            <input type="text" name="salary_new" id="salary_new" placeholder="" class="form-control form-control-line" value="">
                                        </div>
                                    </div>
									
                                    <div class="form-group" style="margin-top:15px;display:inline;">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success pull-left " id="update_btn" onclick="add_salary_func();">Submit</button>
											<button type="reset" class="btn btn-success pull-right" id="reset_btn" onclick="reset_func();">Reset</button>
                                        </div>
										
                                    </div>
									
								<?php echo form_close(); ?>	
                                
                            </div>
							
                        </div>
						
						
                    </div>
					
					
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

function add_salary_func()
{
	//var data_date = document.getElementById("get_sal").value;
	
	//var x = $('input[id=get_sal]:checked', '#update_salary').val();
	
	/*var inc = document.getElementsByName("get_sal")[0];
	var upd = document.getElementsByName("get_sal")[1];
	
	if (inc.checked) {
	  rate_value = inc.value;
	 // alert(rate_value);
	}
	else {
	  rate_value = upd.value;
	  //alert(rate_value);
	}
	alert(rate_value);
	return false;*/
	/*var data_date = document.getElementById("salary_year").value;
	var today = new Date();
	var curt_date = today.getFullYear();
	if(x=="inc"){
		if(data_date == curt_date){
			alert("Please select Update salary Radio button to update previous salary!);
		}
		else{
			document.getElementById("update_salary").submit();
		}
	}
	else{
		document.getElementById("update_salary").submit();
	}*/
	
	document.getElementById("update_salary").submit();
}

</script>

<script>

		
	function get_upd_sal()
	{
		$.ajax({
			type: 'POST',
			data: {salary_id: $("#salary_id").val()},
			url: "<?php echo base_url()."employee/ajax_get_sal"; ?>",
			dataType: 'json',
			cache: false,
			success: function(data){
				//console.log(data);
				
				if(data[0] != 0){
					$('#salary_amount').val(data[0]);
				}
				if(data[1] != 0){
					$('#salary_percent').val(data[1]);
				}
				$('#update_btn').text('Update Salary');
				$('#reset_btn').hide();
				$('#inc_pr').hide();
				$('#inc_amt').hide();
				$('#update_salary :input[value="upd"]').prop('checked', true);
				$('#update_salary :input[value="inc"]').prop('checked', false);
			}
		});
	}
	
	function get_inc_sal()
	{
		$('#inc_pr').show();
		$('#inc_amt').show();
		$('#reset_btn').show();
		$('#update_btn').text('Submit');
		$('#salary_amount').val('');
		$('#salary_percent').val('');
		$('#update_salary :input[value="upd"]').prop('checked', false);
		$('#update_salary :input[value="inc"]').prop('checked', true);
	}
	
	
	function reset_func(){
		$('#salary_amount').val('');
		$('#salary_percent').val('');
		$('#salary_new').val('');
		document.getElementById("salary_amount").readOnly = false;
		document.getElementById("salary_percent").readOnly = false;
		document.getElementById("salary_new").readOnly = false;
	}
	
</script>
<script>
$(document).ready(function(e) {
	$('#update_salary :input[value="inc"]').prop('checked', true);	
		
	$("#salary_percent").on("change", function(){
		var x = $('input[id=get_sal]:checked', '#update_salary').val();
		//alert(x );
		if(x=="inc"){
			var salary_percent = $('#salary_percent').val();
			if( salary_percent != ''){
				
				var cur_salary = $('#cur_salary').val();
				//alert(cur_salary);
				//var salary_percent = $('#salary_percent').val();
				var salary_amount = $('#salary_amount').val();
				var inc_amount = (cur_salary * salary_percent) / 100;
				var new_sal = parseInt(cur_salary) + parseInt(inc_amount);
				
				$('#salary_amount').val(inc_amount);
				document.getElementById("salary_amount").readOnly = true;
				$('#salary_new').val(new_sal);
				document.getElementById("salary_new").readOnly = true;
				//alert(inc_amount);
			}
		}
		
		
	});
	
	$("#salary_amount").on("change", function(){
		var x = $('input[id=get_sal]:checked', '#update_salary').val();
		//alert(x );
		if(x=="inc"){
			var salary_amount = $('#salary_amount').val();
			if( salary_amount != ''){
				
				var cur_salary = $('#cur_salary').val();
				//alert(cur_salary);
				var salary_percent = $('#salary_percent').val();
				
				var inc_percent = (100 * salary_amount) / cur_salary;
				var inc_rounded = roundTo(inc_percent,2);
				var new_sal = parseInt(cur_salary) + parseInt(salary_amount);
				
				$('#salary_percent').val(inc_rounded);
				document.getElementById("salary_percent").readOnly = true;
				//alert(inc_amount);
				$('#salary_new').val(new_sal);
				document.getElementById("salary_new").readOnly = true;
			}
			
			function roundTo(n, digits) {
				if (digits === undefined) {
					digits = 0;
				}

				var multiplicator = Math.pow(10, digits);
				n = parseFloat((n * multiplicator).toFixed(11));
				return (Math.round(n) / multiplicator).toFixed(2);
			}
		}
		
		
		
		
	});
	
	$("#salary_new").on("change", function(){
		var x = $('input[id=get_sal]:checked', '#update_salary').val();
		//alert(x );
		
		if(x=="upd"){
			var salary_new = $('#salary_new').val();
			if( salary_new != ''){
				
				var cur_salary = $('#cur_salary').val();
				
				var base_salary = parseInt(salary_new) - parseInt(cur_salary);
				
				
				//alert(cur_salary);
				//var salary_percent = $('#salary_percent').val();
				var salary_amount = $('#salary_amount').val();
				
				var base_salary = parseInt(cur_salary) - parseInt(salary_amount);
				
				var new_amount = parseInt(salary_new) - parseInt(base_salary);
				
				var inc_percent = (100 * new_amount) / base_salary;
				var inc_rounded = roundTo(inc_percent,2);
				
				$('#salary_amount').val(new_amount);
				document.getElementById("salary_amount").readOnly = true;
				$('#salary_percent').val(inc_rounded);
				//document.getElementById("salary_new").readOnly = true;
				//alert(inc_amount);
			}
			function roundTo(n, digits) {
				if (digits === undefined) {
					digits = 0;
				}

				var multiplicator = Math.pow(10, digits);
				n = parseFloat((n * multiplicator).toFixed(11));
				return (Math.round(n) / multiplicator).toFixed(2);
			}
		}
		
	});
	
		
		
});
		</script>
			
			
<?php include_once('include/footer.php'); ?> 