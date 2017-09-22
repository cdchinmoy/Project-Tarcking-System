<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public $dashboard;
	public $user_details;
	public $user_type_id;
	
	public function __construct()
    {
		
        parent::__construct();
		
		date_default_timezone_set("Asia/Kolkata");
		
		
		$this->load->model('Common_model');
		$this->load->library('pagination');
		
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
	
		if(!isset($user_id))
		{
			redirect('login');
		}

		switch ($user_type_id) 
		{
			case "1":
				$this->add_task = "superadmin/add_task";
				$this->report = "superadmin/report";	
				$this->do_add_task = "superadmin/do_add_task";
				$this->view_task = "superadmin/view_task";		
				$this->filter_report = "superadmin/filter_report";
				$this->gen_report = "superadmin/gen_report";
				/*$this->project_milestone = "superadmin/project_milestone";
				$this->time_management = "superadmin/time_management";
				$this->time_management_filter = "superadmin/time_management_filter";
				$this->filter_project_milestone = "superadmin/filter_project_milestone";*/
				
				break;
				
			case "2":
				$this->add_task = "subadmin/add_task";
				$this->task_list = "subadmin/task_list";	
				$this->do_add_task = "subadmin/do_add_task";		
				$this->view_task = "subadmin/view_task";
				$this->update_task = "subadmin/update_task";
				$this->do_update_task = "admin/do_update_task";
				$this->filter_task_list = "subadmin/filter_task_list";
				$this->project_milestone = "subadmin/project_milestone";
				$this->add_main_task = "subadmin/add_main_task";
				$this->do_add_main_task = "subadmin/do_add_main_task";
				$this->time_management = "subadmin/time_management";
				$this->time_management_filter = "subadmin/time_management_filter";
				$this->filter_project_milestone = "subadmin/filter_project_milestone";
				$this->report = "subadmin/report";	
				$this->filter_report = "subadmin/filter_report";
				$this->gen_report = "subadmin/gen_report";
				
				
				break;
				
			case "3":
				$this->add_task = "admin/add_task";
				$this->task_list = "admin/task_list";	
				$this->do_add_task = "admin/do_add_task";
				$this->view_task = "admin/view_task";
				$this->update_task = "admin/update_task";		
				$this->do_update_task = "admin/do_update_task";
				$this->filter_task_list = "admin/filter_task_list";
				
				break;
				
				
			case "4":
				//$this->add_task = "hradmin/add_task";
				$this->task_list = "hradmin/task_list";	
				//$this->do_add_task = "hradmin/do_add_task";
				$this->view_task = "hradmin/view_task";		
				$this->filter_task_list = "hradmin/filter_task_list";
				$this->project_milestone = "hradmin/project_milestone";
				$this->time_management = "hradmin/time_management";
				$this->time_management_filter = "hradmin/time_management_filter";
				$this->report = "hradmin/report";	
				$this->filter_report = "hradmin/filter_report";
				$this->gen_report = "hradmin/gen_report";
				
				break;
				
			default:
				$page404 = "page404";
		}
		
		$this->data['user_details'] = get_user_details();
		
    }  


	/*public function task_list()
	{
		$this->data['all_task_data'] = $this->Common_model->get_data('users','','','','', array('user_details'=>'user_details.user_id = users.user_id'));
		
		$this->load->view($this->task_list, $this->data);
	}*/		
	
	public function add_task()
	{
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		if($user_type_id == 2)
		{
			$this->data['project_list'] = $this->Common_model->get_data('projects', array('project_status'=>'2'));
			$this->load->view($this->add_task, $this->data);
		}	
		if($user_type_id == 3)
		{
			
			$this->data['project_list'] = $this->Common_model->get_data('projects', array('projects.project_status'=>'2','assigned_project.employee_id'=>$user_id),'','','',array('assigned_project'=>'assigned_project.project_id =  projects.project_id'),'','projects.project_id');
			
			//print_r($this->data['project_list']); die;
			
			$this->load->view($this->add_task, $this->data);
		}
	}	
	
	public function do_add_task()
	{
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		if($user_type_id == 2 || $user_type_id == 3)
		{		
			//echo "<pre>";// print_r($_POST); die;
			
			$this->form_validation->set_rules('project_id', 'Project Name', 'required');
			$this->form_validation->set_rules('task_hidden', 'Task Name', 'required');
			$this->form_validation->set_rules('task_date', 'Task Date', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view($this->add_task, $this->data);
			}
			else
			{	
				$task_data['task_main_id'] = $this->input->post('task_hidden');
				$dat = db_date_format($this->input->post('task_date'));
				$task_data['user_id'] = $this->input->post('user_id');
				$task_data['project_id'] = $this->input->post('project_id');
				$task_data['task_name'] = $this->input->post('task_name');
				$task_data['task_date'] = $dat;
				$task_data['task_start_time'] = $this->input->post('start_time');
				$task_data['task_end_time'] = $this->input->post('end_time');
				$task_data['calc_task_time'] = $this->input->post('calculate_time');
				$task_data['task_description'] = $this->input->post('task_description');
				$task_data['task_status'] = $this->input->post('task_status');
				
				$task_data['task_added_time'] = date("Y-m-d h:i:s");
				
				$insert_ids = $this->Common_model->insert('task', $task_data);
				
				$superadmin_id = get_superadmin_id();
				
				$sel_subadmin_arr = $this->Common_model->get_data('users',array('user_type'=>2));

				foreach($sel_subadmin_arr as $sel_subadmin)
				{
					if($sel_subadmin->user_id == $user_id)
					{
						$notification_data['reference_id'] = $insert_ids;
						$notification_data['reference_name'] = 'task';
						$notification_data['user_id'] = $sel_subadmin->user_id;
						$notification_data['notification_status'] = '1';
						
						$this->Common_model->insert('notifications', $notification_data);
					}
					else
					{
						$notification_data['reference_id'] = $insert_ids;
						$notification_data['reference_name'] = 'task';
						$notification_data['user_id'] = $sel_subadmin->user_id;
						$notification_data['notification_status'] = '0';
						
						$this->Common_model->insert('notifications', $notification_data);						
					}
					

						
				}
									
				$notification_data['reference_id'] = $insert_ids;
				$notification_data['reference_name'] = 'task';
				$notification_data['user_id'] = $superadmin_id;
				$notification_data['notification_status'] = '0';
				
				$this->Common_model->insert('notifications', $notification_data);
				
				$this->session->set_userdata('message', 'Task Submitted Successfully!');
				redirect('task/task_list');
			}	
		}
		

		
	}
	
	public function ajax_add_task()
	{

		$project_id = $this->input->post('project_id'); 
		$task_main_ids = $this->Common_model->get_data('task_main', array('project_id'=>$project_id));
	
		$ajax_task ='';
		$ajax_view ='';
		$count = count($task_main_ids); 
		if($count > 0)
		{
			foreach($task_main_ids as $list)
			{
				//$ajax_task .= '<input type="text" name="task_hidden" value="'. $list->task_name.'">';
				$ajax_view .= '<option value="'.$list->task_main_id.'">'.$list->task_name.'</option>';
			}
		}
		echo $ajax_view; //die;
		/*$ajax_selected_array = array($ajax_task, $ajax_view);
			echo json_encode($ajax_selected_array);*/
		
	}
	
	public function ajax_get_employee()
	{

		$project_id = $this->input->post('project_id'); 
		$user_ids= array();
		if($project_id == '1'){
			$user_ids = $this->Common_model->get_data('user_details');
		}
		else{
			$user_ids = $this->Common_model->get_data('user_details', array('assigned_project.project_id'=>$project_id),'','','',array('assigned_project'=>'assigned_project.employee_id=user_details.user_id'));
		}
	//echo $user_ids ; die;
		//$ajax_task ='';
		$ajax_view ='';
		$count = count($user_ids); 
		if($count > 0)
		{
			$ajax_view .='<option value="">Employee Name</option>';
								
			foreach($user_ids as $list)
			{
				//$ajax_task .= '<input type="text" name="task_hidden" value="'. $list->task_name.'">';
				$filter_employee_id = $this->session->userdata('filter_employee_id');
				$selected = "";
				if($filter_employee_id == $list->user_id)
				{
					$selected = "selected";	
				}
				$ajax_view .= '<option '.$selected.' value="'.$list->user_id.'">'.$list->name.'</option>';
			}
		}
		echo $ajax_view;// die;
		/*$ajax_selected_array = array($ajax_task, $ajax_view);
			echo json_encode($ajax_selected_array);*/
		
	}
	
	public function report_list()
	{
		$userid = get_user_id();
		$user_type_id = get_user_type_id();

		$count = $this->Common_model->get_count('task');

		$config['base_url'] = site_url('task/task_list');
		$config['total_rows'] = $count;
		$config['per_page'] = 30;
		$config['uri_segment']  = 3;
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';		

		
		$page =($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		
		
		if($user_type_id == 2)
		{
			//$count = $this->Common_model->get_count('task', array('user_id' => $userid),'','','', array('projects' => 'projects.project_id = task.project_id')); 
			//$config['total_rows'] = $count;
			
			$this->pagination->initialize($config);
			
			$this->data['project_list'] = $this->Common_model->get_data('projects');
			
			//$this->data['task_list'] = $this->Common_model->get_data('task', array('user_id' => $userid),array('task.task_added_time'=>'DESC'),array('start' => $page,'count' => $config['per_page']),'', array('projects' => 'projects.project_id = task.project_id'));
			///print_r($this->data['task_list']);
			//$this->data['employee_list'] = $this->Common_model->get_data('users',array('users.user_type'=>'2','users.user_type'=>'3'),'','','',array('user_details'=>'user_details.user_id=users.user_id'));
			//echo"<pre>";print_r($this->data['employee_list']); die;
			$last_query= "SELECT * FROM `users` INNER JOIN `user_details` ON `users`.`user_id`=`user_details`.`user_id` WHERE `users`.`user_type`='2' OR `users`.`user_type`='3'";
			$query = $this->db->query($last_query);
			
			$this->data['employee_list'] = $query->result_object($query);
			
			$this->data['task_list'] = $this->Common_model->get_data('task',array('notifications.reference_name'=>'task','notifications.user_id'=>$userid),array('task.task_id'=>'DESC'),array('start' => $page,'count' => $config['per_page']),'', array('projects' =>'projects.project_id = task.project_id','user_details' => 'user_details.user_id = task.user_id','notifications'=>'notifications.reference_id = task.task_id'));
			
			//echo $this->db->last_query();
			//echo"<pre>";print_r($this->data['task_list']); die;
			
			$this->data['pagination_link'] = $this->pagination->create_links();
			$this->load->view($this->report, $this->data);
		}


		if($user_type_id == 1)
		{
			
			$this->pagination->initialize($config);
			
			$this->data['project_list'] = $this->Common_model->get_data('projects');
			$this->data['employee_list'] = $this->Common_model->get_data('users','','','','',array('user_details'=>'user_details.user_id=users.user_id'));
			
			$this->data['task_list'] = $this->Common_model->get_data('task',array('notifications.reference_name'=>'task','notifications.user_id'=>$userid),array('task.task_id'=>'DESC'),array('start' => $page,'count' => $config['per_page']),'', array('projects' =>'projects.project_id =task.project_id','user_details' => 'user_details.user_id = task.user_id','notifications'=>'notifications.reference_id = task.task_id'));
			//echo "<pre>"; print_r($this->data['task_list']); die;
			$this->data['pagination_link'] = $this->pagination->create_links();
			$this->load->view($this->report, $this->data);
		}	
		
		
		if($user_type_id == 4)
		{
			
			$this->pagination->initialize($config);
			
			$this->data['project_list'] = $this->Common_model->get_data('projects');
			//$this->data['employee_list'] = $this->Common_model->get_data('users',array('users.user_type'=>'2','users.user_type'=>'3'),'','','',array('user_details'=>'user_details.user_id=users.user_id'));
			
			$last_query= "SELECT * FROM `users` INNER JOIN `user_details` ON `users`.`user_id`=`user_details`.`user_id` WHERE `users`.`user_type`='2' OR `users`.`user_type`='3'";
			$query = $this->db->query($last_query);
			
			$this->data['employee_list'] = $query->result_object($query);
			
			
			$this->data['task_list'] = $this->Common_model->get_data('task','',array('task.task_id'=>'DESC'),array('start' => $page,'count' => $config['per_page']),'', array('projects' =>'projects.project_id =task.project_id','user_details' => 'user_details.user_id = task.user_id'));
			//echo "<pre>"; print_r($this->data['task_list']); die;
			$this->data['pagination_link'] = $this->pagination->create_links();
			$this->load->view($this->report, $this->data);
		}
	}
	
	
	
	
	
	
	public function filter_report()
	{
		$userid = get_user_id();
		$user_type_id = get_user_type_id();

		//$count = $this->Common_model->get_count('task');	

		
		$page =($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		
		
		
		if($user_type_id == 2)
		{
			
			$this->data['project_list'] = $this->Common_model->get_data('projects');
			//$this->data['employee_list'] = $this->Common_model->get_data('users',array('users.user_type'=>'2','users.user_type'=>'3'),'','','',array('user_details'=>'user_details.user_id=users.user_id'));
			$last_query= "SELECT * FROM `users` INNER JOIN `user_details` ON `users`.`user_id`=`user_details`.`user_id` WHERE `users`.`user_type`='2' OR `users`.`user_type`='3'";
			$querys = $this->db->query($last_query);
			
			$this->data['employee_list'] = $querys->result_object($querys);
			
			
			$query = "";
			$date = $this->input->post('datefilter');
			if( !empty($date))
			{
				
				$date_range = $this->input->post('datefilter');
				$from_arr = explode("-", $date_range);
				$from = $from_arr[0];
				$to = $from_arr[1];
				
				$frm_arr = explode('/',$from);
				$fromdt = $frm_arr[2]."-".$frm_arr[1]."-".$frm_arr[0];
				
				$to_arr = explode('/',$to);
				$todt = $to_arr[2]."-".$to_arr[1]."-".$to_arr[0];
				
				$from_dt = db_date_format($from);
				$to_dt = db_date_format($to);
				
				$query .= " AND `task`.`task_date`>='$fromdt' AND `task`.`task_date`<='$todt'";
			
			}
			
			//$task_data['task_end_time'] = $this->input->post('end_time');
			$employee_id =$this->input->post('employee_id');
			if( !empty($employee_id))
			{
				$user_id = $this->input->post('employee_id');
				$query .=" AND `user_details`.`user_id`=$user_id";
			}
			
			$project_id = $this->input->post('project_id');
			if( !empty($project_id))
			{
				$project_id = $this->input->post('project_id');
				$query .=" AND `projects`.`project_id`=$project_id";
			}
			
			$status_id = $this->input->post('status_id');
			if( !empty($status_id))
			{
				$status_id = $this->input->post('status_id');
				$query .=" AND `task`.`manager_status`=$status_id";
			}
			
			$last_query = "SELECT * FROM `task` INNER JOIN `projects` ON `projects`.`project_id`=`task`.`project_id` INNER JOIN `user_details` ON `user_details`.`user_id`=`task`.`user_id` WHERE `projects`.`project_status`>0".$query."  ORDER BY `task`.`task_id` DESC";
			//echo $last_query; die;
			$query = $this->db->query($last_query);
			
			$this->data['task_list'] = $query->result_object($query);
			
			
			$this->load->view($this->filter_report, $this->data);
		}


		if($user_type_id == 1)
		{
			
			$this->data['project_list'] = $this->Common_model->get_data('projects');
			$this->data['employee_list'] = $this->Common_model->get_data('users','','','','',array('user_details'=>'user_details.user_id=users.user_id'));
			
			$query = "";
			$date = $this->input->post('datefilter');
			if( !empty($date))
			{
				
				$date_range = $this->input->post('datefilter');
				$from_arr = explode("-", $date_range);
				$from = $from_arr[0];
				$to = $from_arr[1];
				
				$frm_arr = explode('/',$from);
				$fromdt = $frm_arr[2]."-".$frm_arr[1]."-".$frm_arr[0];
				
				$to_arr = explode('/',$to);
				$todt = $to_arr[2]."-".$to_arr[1]."-".$to_arr[0];
				
				$from_dt = db_date_format($from);
				$to_dt = db_date_format($to);
				
				$query .= " AND `task`.`task_date`>='$fromdt' AND `task`.`task_date`<='$todt'";
			
			}
			
			//$task_data['task_end_time'] = $this->input->post('end_time');
			$employee_id =$this->input->post('employee_id');
			if( !empty($employee_id))
			{
				$user_id = $this->input->post('employee_id');
				$query .=" AND `user_details`.`user_id`=$user_id";
			}
			
			$project_id = $this->input->post('project_id');
			if( !empty($project_id))
			{
				$project_id = $this->input->post('project_id');
				$query .=" AND `projects`.`project_id`=$project_id";
			}
			
			$status_id = $this->input->post('status_id');
			if( !empty($status_id))
			{
				$status_id = $this->input->post('status_id');
				$query .=" AND `task`.`manager_status`=$status_id";
			}
			
			$last_query = "SELECT * FROM `task` INNER JOIN `projects` ON `projects`.`project_id`=`task`.`project_id` INNER JOIN `user_details` ON `user_details`.`user_id`=`task`.`user_id` WHERE `projects`.`project_status`>0".$query."  ORDER BY `task`.`task_id` DESC";
			//echo $last_query; die;
			$query = $this->db->query($last_query);
			
			$this->data['task_list'] = $query->result_object($query);
			
			
			$this->load->view($this->filter_report, $this->data);
		}

		if($user_type_id == 4)
		{
			$this->data['project_list'] = $this->Common_model->get_data('projects');
			//$this->data['employee_list'] = $this->Common_model->get_data('users',array('users.user_type'=>'2','users.user_type'=>'3'),'','','',array('user_details'=>'user_details.user_id=users.user_id'));
			$last_query= "SELECT * FROM `users` INNER JOIN `user_details` ON `users`.`user_id`=`user_details`.`user_id` WHERE `users`.`user_type`='2' OR `users`.`user_type`='3'";
			$querys = $this->db->query($last_query);
			
			$this->data['employee_list'] = $querys->result_object($querys);
			
			
			$query = "";
			$date = $this->input->post('datefilter');
			if( !empty($date))
			{
				
				$date_range = $this->input->post('datefilter');
				$from_arr = explode("-", $date_range);
				$from = $from_arr[0];
				$to = $from_arr[1];
				
				$frm_arr = explode('/',$from);
				$fromdt = $frm_arr[2]."-".$frm_arr[1]."-".$frm_arr[0];
				
				$to_arr = explode('/',$to);
				$todt = $to_arr[2]."-".$to_arr[1]."-".$to_arr[0];
				
				$from_dt = db_date_format($from);
				$to_dt = db_date_format($to);
				
				$query .= " AND `task`.`task_date`>='$fromdt' AND `task`.`task_date`<='$todt'";
			
			}
			
			//$task_data['task_end_time'] = $this->input->post('end_time');
			$employee_id =$this->input->post('employee_id');
			if( !empty($employee_id))
			{
				$user_id = $this->input->post('employee_id');
				$query .=" AND `user_details`.`user_id`=$user_id";
			}
			
			$project_id = $this->input->post('project_id');
			if( !empty($project_id))
			{
				$project_id = $this->input->post('project_id');
				$query .=" AND `projects`.`project_id`=$project_id";
			}
			
			$status_id = $this->input->post('status_id');
			if( !empty($status_id))
			{
				$status_id = $this->input->post('status_id');
				$query .=" AND `task`.`manager_status`=$status_id";
			}
			
			$last_query = "SELECT * FROM `task` INNER JOIN `projects` ON `projects`.`project_id`=`task`.`project_id` INNER JOIN `user_details` ON `user_details`.`user_id`=`task`.`user_id` WHERE `projects`.`project_status`>0".$query."  ORDER BY `task`.`task_id` DESC";
			//echo $last_query; die;
			$query = $this->db->query($last_query);
			
			$this->data['task_list'] = $query->result_object($query);
			
			
			$this->load->view($this->filter_report, $this->data);
		}
		
	}
	
	public function gen_report(){
		
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=data.csv');

		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		// output the column headings
		fputcsv($output, array('Employee', 'Project', 'Task Name', 'Date', 'Total Time(Hr)', 'Task Status', 'Review Status', 'Score'));

		// fetch the data

		$last_query = 'SELECT `user_details`.`name`,`projects`.`project_name`,`task`.`task_name`,`task`.`task_date`,`task`.`calc_task_time`,`task`.`task_status`,`task`.`manager_status`,`task`.`manager_score` FROM `task` INNER JOIN `projects` ON `projects`.`project_id`=`task`.`project_id` INNER JOIN `user_details` ON `user_details`.`user_id`=`task`.`user_id` ORDER BY `task`.`task_id` DESC';
		
		$query = $this->db->query($last_query);
		
		$data=array();
		foreach($query->result_array() as $key=>$item)
        {
			//echo "<pre>";print_r($item->task_status);
			
            if($item['task_status'] == '1'){
				$stat = "In Progress";
				//$item['task_status'] = $stat;
				$item['task_status'] = $stat;
				
			}
			else{
				$stat = "Finished";
				$item['task_status'] = $stat;
			}
			
			if($item['manager_status'] == '0'){
				$stat = "Pending";
				//$item['task_status'] = $stat;
				$item['manager_status'] = $stat;
				
			}
			if($item['manager_status'] == '1'){
				$stat = "Waiting For Approval";
				//$item['task_status'] = $stat;
				$item['manager_status'] = $stat;
				
			}
			if($item['manager_status'] == '2'){
				$stat = "Approved";
				//$item['task_status'] = $stat;
				$item['manager_status'] = $stat;
				
			}
			
			$data[] = $item;
        }


		
		foreach($data as $row){
			//print_r($row);
			fputcsv($output, $row);
		}

		
	}
	
	
}
