<?php //echo "<pre>"; print_r($leave_list); die; ?>

<!DOCTYPE html>
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
	
	<link href="<?php echo base_url(); ?>assets/jquery-ui/jquery-ui.css" id="theme" rel="stylesheet">

	<style>
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
    

    <!--<script src="js/jquery.js"></script>-->
	<script src="<?php echo base_url(); ?>assets/js/timepicki.js"></script>
    
    <script src="<?php echo base_url(); ?>assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>		
	<script src="<?php echo base_url(); ?>assets/jquery-ui/jquery-ui.js"></script>
	
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
  <!--  <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	
	<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" /> -->

	<?php if(isset($leave_list)){ ?>
	<script>
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
				<?php $count = count($leave_list);
					if($count > 0){
						$i=0;
						foreach($leave_list as $leave){
							
							$datetime = new DateTime($leave->leave_end_date);
							$datetime->modify('+1 day');
							$leave_end_date = $datetime->format('Y-m-d');
							
							?>
						{
							title: '<?php echo $leave->name.'\r\n'.$leave->leave_type; ?>',
							//url: 'http://google.com/',
							start: '<?php echo $leave->leave_start_date; ?>',
							end: '<?php echo $leave_end_date; ?>'
						}
					<?php 
						$i++;
						if($i < $count){
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

<!---  Salary Chart --->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php 
if(isset($salary_result)){
 $cnt = count($salary_result);
	if($cnt > 0) { ?>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Year', 'Salary', 'Raise Percentage', 'Raise Amount'],
		  <?php 
			$i=0;
			 $cnt = count($salary_result);
			
				foreach($salary_result as $result) {
					$i++;
					?>
					['<?php echo $result->salary_year ?>','<?php echo "RS. ".$result->salary_amount ?>',<?php echo $result->salary_raise_percent ?>,'<?php echo $result->salary_raise ?>']
					<?php
					if($i < $cnt){
						echo ",";
					}
					
				}
				
			?>
          
        ]);
	  
        var options = {
          title: 'Salary (Yearly)',
          width: 900,
          legend: { position: 'none' },
          chart: { title: 'Salary (Yearly)',
                   subtitle: 'popularity by percentage' },
		vAxis: {
            minValue:0
		},
          bars: 'vartical', // Required for Material Bar Charts.
          axes: {
            x: {
             // 0: { side: 'top', label: ''} // Top x-axis.
			  0: { side: 'bottom', label: 'Year'}
            },
			y: {
             // 0: { side: 'top', label: ''} // Top x-axis.
			  
			  0: { side: 'left', label: 'Salary (In INR)'},
			  1: { side: 'right', label: 'Raise in %(Percent)'}
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>
	<?php } else {?>
		<script>
				document.getElementById("chart").innerHTML ="No Record Found!";
		</script>
		<?php
	}
}?>
<!---- End Salary Chart ---->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tableExport.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.base64.js"></script>	
	
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
			<li>
				<div id="times" style="font-size:15px; float:right; /*margin-right:50px; margin-bottom:35px;*/font-weight:bold; ">
                </div>
			</li>
			<li class="nav-item dropdown">
			
				<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url(); ?>assets/upload/profile_image/<?php if(!empty($user_details[0]->user_iamge)){ echo $user_details[0]->user_iamge; }else {?>noimage.png<?php } ?>" alt="user" class="profile-pic m-r-5" /><?php echo $user_details[0]->name; ?></a>
				
			</li>
		</ul>
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
</nav>
</header>				