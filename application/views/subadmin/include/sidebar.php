<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
<!-- Sidebar scroll-->
<div class="scroll-sidebar">
	<!-- Sidebar navigation-->
	<nav class="sidebar-nav">
		<ul id="sidebarnav">
			<li>
				<a href="<?php echo base_url()."dashboard"; ?>" class="waves-effect"><i class="fa fa-clock-o m-r-10" aria-hidden="true"></i>Dashboard <i class="fa fa-bell" style="float:right;color:red;"><div style="display:inline; font-style:italic; font-weight:bolder; font-size:24px; color:darkred; padding-left:5px; text-shadow:5px 5px 10px #333;" id="dash_notify"></div></i></a>
			</li>
			<li>
				<a href="<?php echo base_url()."dashboard/profile"; ?>" class="waves-effect"><i class="fa fa-user m-r-10" aria-hidden="true"></i>Profile</a>
			</li>
			<li>
				<a href="<?php echo base_url()."employee/employee_list"; ?>" class="waves-effect"> <img src="http://exoticapages.ca/pts/assets/upload/profile_image/icon1.png" style="margin-right:9px;" />Employee</a>
			</li>						
			<li>				
				<a href="<?php echo base_url()."project/project_list"; ?>" class="waves-effect"> <img src="http://exoticapages.ca/pts/assets/upload/profile_image/icon2.png" style="margin-right:9px;" />Project</a></li>
            <li>				
				<a href="<?php echo base_url()."task/project_milestone"; ?>" class="waves-effect"> <img src="http://exoticapages.ca/pts/assets/upload/profile_image/icon3.png" style="margin-right:9px;" />Project Milestone</a></li>						
			<li>
				<a href="<?php echo base_url()."task/task_list"; ?>" class="waves-effect"><i class="fa fa-table m-r-10" aria-hidden="true"></i>Task</a>
			</li>
            <li>
				<a href="<?php echo base_url()."task/time_management"; ?>" class="waves-effect"><i class="fa fa-database m-r-10" aria-hidden="true"></i>Time Management</a>
			</li>
			
			<li>
				<a href="<?php echo base_url()."notice/notice_board"; ?>" class="waves-effect"><i class="fa fa-thumb-tack m-r-10" aria-hidden="true"></i>Notice Board</a>
			</li>
			
			<li>
				<a href="<?php echo base_url()."leaves/leave_management"; ?>" class="waves-effect"><i class="fa fa-flag m-r-10" aria-hidden="true"></i>Leave Management</a>
			</li>
			
			<li>
				<a href="<?php echo base_url()."document/documents"; ?>" class="waves-effect"><i class="fa fa-file m-r-10" aria-hidden="true"></i>User Documents</a>
			</li>
			
			<li>
				<a href="<?php echo base_url()."report/report_list"; ?>" class="waves-effect"><i class="fa fa-bar-chart m-r-10" aria-hidden="true"></i>Reports</a>
			</li>
			
			<li>				
			<a href="<?php echo base_url()."dashboard/logout"; ?>" class="waves-effect"><i class="fa fa-info-circle m-r-10" aria-hidden="true" onclick="return confirm('You Want to Logout ?');"></i>Logout</a>			
			</li>						
		</ul>

	</nav>
	<!-- End Sidebar navigation -->
</div>
<script>
function get_dash_notification()
{
	$.ajax({
		url: "<?php echo base_url()."dashboard/ajax_count_list"; ?>",
		type: 'POST',
		dataType: 'json',
        cache: false,
		success: function(data){
			//console.log(data);
			if(data[0] != 0){
				$('#dash_notify').html(data[0]);
			}
			if(data[1] != 0){
				$('#tasks_notify').html(data[1]);
			}
			if(data[2] != 0){
				$('#projects_notify').html(data[2]);
			}
			if(data[3] != 0){
				$('#general_notify').html(data[3]);
			}
			if(data[4] != 0){
				$('#warning_notify').html(data[4]);
			}
			if(data[5] != 0){
				$('#review_notify').html(data[5]);
			}
			if(data[6] != 0){
				$('#pay_notify').html(data[6]);
			}
		}
	});
}

setInterval(function(){
	get_dash_notification();
},5000);
</script>
<!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->