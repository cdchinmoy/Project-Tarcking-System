<?php //echo "<pre>"; print_r($task_calender);die; ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/timepicki.css">
    <title>Project Tracking System</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?php echo base_url(); ?>assets/css/colors/blue.css" id="theme" rel="stylesheet">
	
	<link href="<?php echo base_url(); ?>assets/jquery-ui/jquery-ui.min.css" id="theme" rel="stylesheet">
	
    
    <style>
		/*.highlited_rows{background:#0F9 !important;}*/
		.results tr[visible='false'],
		.no-result{
		  display:none;
		}
		
		.results tr[visible='true']{
		  display:table-row;
		}
		
		.counter{
		  padding:8px; 
		  color:#ccc;
		}
	</style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url(); ?>assets/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url(); ?>assets/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?php echo base_url(); ?>assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- Flot Charts JavaScript -->
    <script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <!--<script src="<?php echo base_url(); ?>assets/plugins/flot.tooltip/js/flot-data.js"></script>-->
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
    
    <!--<script src="js/jquery.js"></script>-->
	<script src="<?php echo base_url(); ?>assets/js/timepicki.js"></script>
    
    <script src="<?php echo base_url(); ?>assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>		
	<script src="<?php echo base_url(); ?>assets/jquery-ui/jquery-ui.min.js"></script>
    
    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />	
	
	<!------------Event Calender Start------------------>
	
	<link href='<?php echo base_url(); ?>assets/event_calender/fullcalendar.min.css' rel='stylesheet' />
	<link href='<?php echo base_url(); ?>assets/event_calender/fullcalendar.print.min.css' rel='stylesheet' media='print' />
	<script src='<?php echo base_url(); ?>assets/event_calender/lib/moment.min.js'></script>
	<!--<script src='<?php //echo base_url(); ?>assets/event_calender/lib/jquery.min.js'></script>-->
	<script src='<?php echo base_url(); ?>assets/event_calender/fullcalendar.min.js'></script>
	
	<!--------------Event Calender End------------------>
	
    <!-- Include Date Range Picker -->
  <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	
	<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

	<?php if(isset($task_calender)){ ?>
	<script type="text/javascript">
	var date = '<?php echo date('Y-m-d'); ?>';

	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: date,
			navLinks: true, // can click day/week names to navigate views
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
				<?php $cont = count($task_calender);
					if($cont > 0){
						$i=0;
						foreach($task_calender as $time){
							
							//$datetime = new DateTime($time->leave_end_date);
							//$datetime->modify('+1 day');
							//$leave_end_date = $datetime->format('Y-m-d');
							
							?>
						{
							title: '<?php echo $time->task_name.'\r\n'.$time->calc_task_time; ?>', 
							//url: 'http://google.com/',
							start: '<?php echo $time->task_date; ?>',
							end: '<?php echo $time->task_date; ?>'
						}
					<?php 
						$i++;
						if($i < $cont){
							echo ",";
						}
					}
				}
				?>
			]
			
		});
		
	});

</script>
<style>

	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}

</style>
<?php } ?>
	
	<!--- Document TAB Start --->

<style>

/* Style the tab */
div.tab {
	
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #1ea89a;
}

/* Style the buttons inside the tab */
div.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
div.tab button:hover {
    background-color: #227067;
}

/* Create an active/current tablink class */
div.tab button.active {
	color: floralwhite;
    background-color: #195952;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
</style>
<!--- Document TAB End --->	

</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url()."dashboard"; ?>">
                        
                        <!-- Logo text -->
                        <span>
                            <!-- dark Logo text -->
                            <img src="<?php echo base_url(); ?>assets/images/logo-text.png" alt="homepage" style="width: 199px;" class="dark-logo" />
                        </span>
                    </a>
                </div>


	<!-- ============================================================== -->
	<!-- End Logo -->
	<!-- ============================================================== -->
	<div class="navbar-collapse">
		<!-- ============================================================== -->
		<!-- toggle and nav items -->
		<!-- ============================================================== -->
		<ul class="navbar-nav mr-auto mt-md-0 ">
			<!-- This is  -->
			<li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
			<li class="nav-item hidden-sm-down">
				<form class="app-search p-l-20" method="post" id="search" action="<?php echo base_url().'dashboard/search_result'?>">
		<input type="text" class="form-control" id="keys" placeholder="Search for..." name="keys"><a class="srh-btn" id="result"><i class="ti-search"></i></a>
				</form>
			</li>
		</ul>
        <script>
		$(document).ready(function() {
			$("#keys").keyup(function () {
				var str = $('#keys').val();
				if(/^[a-zA-Z0-9- ]*$/.test(str) == false) {
					alert('Your search string contains illegal characters.');
					$("#keys").val('');
				}
			});
		});
        </script>
		<script>
			var form = document.getElementById("search");

			document.getElementById("result").addEventListener("click", function () {
				if((document.getElementById("keys").value)=='' || (document.getElementById("keys").value).startsWith('/')){
			  		//
					alert("Please Fill All Required Field");
     				return false;
				}else{
					form.submit();
				}
			});
				
		</script>
		<!-- ============================================================== -->
		<!-- User profile and search -->
		<!-- ============================================================== -->
		<ul class="navbar-nav my-lg-0">
			
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url(); ?>assets/upload/profile_image/<?php if(!empty($user_details[0]->user_iamge)){ echo $user_details[0]->user_iamge; }else {?>noimage.png<?php } ?>" alt="user" class="profile-pic m-r-5" /><?php echo $user_details[0]->name; ?></a>
			</li>
		</ul>
	</div>
	
</nav>
</header>				