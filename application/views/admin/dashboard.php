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
			<h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
				<li class="breadcrumb-item active">Dashboard</li>
			</ol>
		</div>

	</div>
<div class="row">        
        <div class="col-sm-4">
			<div class="card">
				<div class="card-block" style="text-align:center; ">
                   <center><div style="color:#903; font-size:24px; font-weight:bolder; margin-bottom:30px; background-color:#0FC; width:80%; box-shadow: 10px 10px 5px #999;">
                        Project Notification:
                        </div></center>
                         <div id="projects_notify">
                            <?php if($projects > 0){ echo '<center><a href="project/project_list" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$projects.'</div></a></center>' ; } else { echo '<center><div align="center" style="background-color:red; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">0</div></center>'; } ?>
                    </div>
                <div>
                 New Notification
                </div>
                </div>
            </div>
        </div>
        
		<div class="col-sm-4">
			<div class="card">
				<div class="card-block" style="text-align:center; ">
                <center><div style="color:#903; font-size:24px; font-weight:bolder; margin-bottom:30px; background-color:#0FC; width:80%; box-shadow: 10px 10px 5px #999;">
                    	General Notification
                    </div></center>
                	<div id="general_notify">
					<?php if($general > 0){ echo '<center><a href="notice/notice_board" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$general.'</div></a></center>' ; } else { echo '<center><div align="center" style="background-color:red; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">0</div></center>'; } ?>
                    </div>
                <div>
                 New Notification
                </div>
                </div>
            </div>
        </div>
		
        <div class="col-sm-4">
			<div class="card">
				<div class="card-block" style="text-align:center; ">
                	<center><div style="color:#903; font-size:24px; font-weight:bolder; margin-bottom:30px; background-color:#0FC; width:80%; box-shadow: 10px 10px 5px #999;">
                    	You Are Here
                    </div></center>
                    <div style="margin-bottom:20px; font-weight:bolder; font-size:20px;">
                		Elapsed Time:
                        </div>
                    <div id="times" style="font-size:20px; margin-bottom:35px; font-weight:bold;">
                    	
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="row"> 
	<div class="col-sm-4">
		<div class="card">
			<div class="card-block" style="text-align:center; ">
			<center><div style="color:#903; font-size:24px; font-weight:bolder; margin-bottom:30px; background-color:#0FC; width:80%; box-shadow: 10px 10px 5px #999;">
					Warning Notification
				</div></center>
				<div id="warning_notify">
				<?php if($warning > 0){ echo '<center><a href="document/documents" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$warning.'</div></a></center>' ; } else { echo '<center><div align="center" style="background-color:red; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">0</div></center>'; } ?>
				</div>
			<div>
			 New Notification
			</div>
			</div>
		</div>
	</div>
	
	<div class="col-sm-4">
		<div class="card">
			<div class="card-block" style="text-align:center; ">
			<center><div style="color:#903; font-size:24px; font-weight:bolder; margin-bottom:30px; background-color:#0FC; width:80%; box-shadow: 10px 10px 5px #999;">
					Review Notification
				</div></center>
				<div id="review_notify">
				<?php if($review > 0){ echo '<center><a href="document/documents" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$review.'</div></a></center>' ; } else { echo '<center><div align="center" style="background-color:red; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">0</div></center>'; } ?>
				</div>
			<div>
			 New Notification
			</div>
			</div>
		</div>
	</div>
	
	<div class="col-sm-4">
		<div class="card">
			<div class="card-block" style="text-align:center; ">
			<center><div style="color:#903; font-size:24px; font-weight:bolder; margin-bottom:30px; background-color:#0FC; width:80%; box-shadow: 10px 10px 5px #999;">
					Pay-slip Notification
				</div></center>
				<div id="pay_notify">
				<?php if($payslip > 0){ echo '<center><a href="document/documents" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$payslip.'</div></a></center>' ; } else { echo '<center><div align="center" style="background-color:red; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">0</div></center>'; } ?>
				</div>
			<div>
			 New Notification
			</div>
			</div>
		</div>
	</div>
	
</div>		
		
<div class="card">
	<div class="card-block">
		<h4 class="card-title" style="float:left">Task Calender</h4>
		
		<br><br>
		<div id="calendar_div" class="">
			<div id="calendar"></div>
		</div>
	</div>
</div>
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
			//console.log(data);
			$('#times').html(data);
		}
	});
}

setInterval(function(){
	get_ajax_time();
},500);
</script>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
			
<?php include_once('include/footer.php'); ?> 