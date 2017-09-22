<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

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
				$this->task_list = "superadmin/task_list";	
				$this->do_add_task = "superadmin/do_add_task";
				$this->view_task = "superadmin/view_task";		
				$this->filter_task_list = "superadmin/filter_task_list";
				$this->project_milestone = "superadmin/project_milestone";
				$this->time_management = "superadmin/time_management";
				$this->time_management_filter = "superadmin/time_management_filter";
				$this->filter_project_milestone = "superadmin/filter_project_milestone";
				
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
	
	public function task_list()
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
		
		
		if($user_type_id == 3)
		{
			$count = $this->Common_model->get_count('task', array('user_id' => $userid),'','','', array('projects' => 'projects.project_id = task.project_id')); 
			$config['total_rows'] = $count;
			
			$this->pagination->initialize($config);
			
			$this->data['project_list'] = $this->Common_model->get_data('projects',array('assigned_project.employee_id'=>$userid),'','','',array('assigned_project' => 'assigned_project.project_id = projects.project_id'));
			
			$this->data['task_list'] = $this->Common_model->get_data('task', array('user_id' => $userid),array('task.task_id'=>'DESC'),array('start' => $page,'count' => $config['per_page']),'', array('projects' => 'projects.project_id = task.project_id'));
			///print_r($this->data['task_list']);
			$this->data['pagination_link'] = $this->pagination->create_links();
			$this->load->view($this->task_list, $this->data);
		}
		
		
		if($user_type_id == 2)
		{
			//$count = $this->Common_model->get_count('task', array('user_id' => $userid),'','','', array('projects' => 'projects.project_id = task.project_id')); 
			//$config['total_rows'] = $count;
			
			$this->pagination->initialize($config);
			
			$this->data['project_list'] = $this->Common_model->get_data('projects');
			
			//$this->data['task_list'] = $this->Common_model->get_data('task', array('user_id' => $userid),array('task.task_added_time'=>'DESC'),array('start' => $page,'count' => $config['per_page']),'', array('projects' => 'projects.project_id = task.project_id'));
			///print_r($this->data['task_list']);
			
			$this->data['task_list'] = $this->Common_model->get_data('task',array('notifications.reference_name'=>'task','notifications.user_id'=>$userid),array('task.task_id'=>'DESC'),array('start' => $page,'count' => $config['per_page']),'', array('projects' =>'projects.project_id = task.project_id','user_details' => 'user_details.user_id = task.user_id','notifications'=>'notifications.reference_id = task.task_id'));
			
			//echo $this->db->last_query();
			//echo"<pre>";print_r($this->data['task_list']); die;
			
			$this->data['pagination_link'] = $this->pagination->create_links();
			$this->load->view($this->task_list, $this->data);
		}


		if($user_type_id == 1)
		{
			
			$this->pagination->initialize($config);
			
			$this->data['project_list'] = $this->Common_model->get_data('projects');
			$this->data['employee_list'] = $this->Common_model->get_data('users','','','','',array('user_details'=>'user_details.user_id=users.user_id'));
			
			$this->data['task_list'] = $this->Common_model->get_data('task',array('notifications.reference_name'=>'task','notifications.user_id'=>$userid),array('task.task_id'=>'DESC'),array('start' => $page,'count' => $config['per_page']),'', array('projects' =>'projects.project_id =task.project_id','user_details' => 'user_details.user_id = task.user_id','notifications'=>'notifications.reference_id = task.task_id'));
			//echo "<pre>"; print_r($this->data['task_list']); die;
			$this->data['pagination_link'] = $this->pagination->create_links();
			$this->load->view($this->task_list, $this->data);
		}	
		
		
		if($user_type_id == 4)
		{
			
			$this->pagination->initialize($config);
			
			$this->data['project_list'] = $this->Common_model->get_data('projects');
			$this->data['employee_list'] = $this->Common_model->get_data('users','','','','',array('user_details'=>'user_details.user_id=users.user_id'));
			
			$this->data['task_list'] = $this->Common_model->get_data('task','',array('task.task_id'=>'DESC'),array('start' => $page,'count' => $config['per_page']),'', array('projects' =>'projects.project_id =task.project_id','user_details' => 'user_details.user_id = task.user_id'));
			//echo "<pre>"; print_r($this->data['task_list']); die;
			$this->data['pagination_link'] = $this->pagination->create_links();
			$this->load->view($this->task_list, $this->data);
		}
	}
	
	public function view_task()
	{
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		$task_id = $this->uri->segment(3);
		
		if($user_type_id == '1')
		{
		
			
			$this->data['tasks'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id,'reference_id'=>$task_id, 'reference_name'=>'task','notification_status'=>0));
			
			if($this->data['tasks'] > 0)
			{
				$update_notification = $this->Common_model->update('notifications',array('reference_name'=>'task','user_id'=>$user_id,'reference_id'=>$task_id),array('notification_status'=>'1'));
				
			}
			
			$this->data['task_details'] = $this->Common_model->get_data('task', array('task_id' => $task_id),'','','', array('projects' => 'projects.project_id = task.project_id','user_details' => 'user_details.user_id = task.user_id'));

		}		
		
		if($user_type_id == '2')
		{		
			$this->data['tasks'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id,'reference_id'=>$task_id, 'reference_name'=>'task','notification_status'=>0));
			
			if($this->data['tasks'] > 0)
			{
				$update_notification = $this->Common_model->update('notifications',array('reference_name'=>'task','user_id'=>$user_id,'reference_id'=>$task_id),array('notification_status'=>'1'));
				
			}
			
			$project_id = $this->uri->segment(3);
			
			$this->data['task_details'] = $this->Common_model->get_data('task', array('task.task_id' => $task_id),'','','', array('projects' => 'projects.project_id = task.project_id','user_details' => 'user_details.user_id = task.user_id'));
			
			
				

		}
		
		if($user_type_id == '3')
		{		
	
			$project_id = $this->uri->segment(3);
			
			$this->data['tasks'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id,'reference_id'=>$task_id, 'reference_name'=>'task','notification_status'=>0));
			
			if($this->data['tasks'] > 0)
			{
				$update_notification = $this->Common_model->update('notifications',array('reference_name'=>'task','user_id'=>$user_id,'reference_id'=>$task_id),array('notification_status'=>'1'));
				
			}
			
			$this->data['task_details'] = $this->Common_model->get_data('task', array('task.task_id' => $task_id),'','','', array('projects' => 'projects.project_id = task.project_id','user_details' => 'user_details.user_id = task.user_id'));
			
			//print_r($this->data['task_details']); die;
				

		}
		
		if($user_type_id == '4')
		{		
						
			$this->data['task_details'] = $this->Common_model->get_data('task', array('task_id' => $task_id),'','','', array('projects' => 'projects.project_id = task.project_id','user_details' => 'user_details.user_id = task.user_id'));

		}
		
		$this->load->view($this->view_task, $this->data);
		
		
	}
	public function update_task()
	{
		$user_type_id = get_user_type_id();
		$task_id = $this->uri->segment(3);
		
		if($user_type_id == '2')
		{		

			//$project_id = $this->uri->segment(3);
			
			$this->data['task_details'] = $this->Common_model->get_data('task', array('task.task_id' => $task_id),'','','', array('projects' => 'projects.project_id = task.project_id','user_details' => 'user_details.user_id = task.user_id'));
			
			//print_r($this->data['task_details']); die;
				

		}
		
		if($user_type_id == '3')
		{		

			//$project_id = $this->uri->segment(3);
			
			$this->data['task_details'] = $this->Common_model->get_data('task', array('task.task_id' => $task_id),'','','', array('projects' => 'projects.project_id = task.project_id','user_details' => 'user_details.user_id = task.user_id'));
			
			//print_r($this->data['task_details']); die;
				

		}
		
		$this->load->view($this->update_task, $this->data);
		
		
	}
	
	public function do_update_task()
	{
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		if($user_type_id == 2 || $user_type_id == 3)
		{		
			//echo "<pre>";// print_r($_POST); die;
			
			$this->form_validation->set_rules('project_name', 'Project Name', 'required');
			$this->form_validation->set_rules('task_name', 'Task Name', 'required');
			//$this->form_validation->set_rules('task_date', 'Task Date', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view($this->add_task, $this->data);
			}
			else
			{	
				 $dat = db_date_format($this->input->post('task_date'));// die;
				$data['task_id'] = $this->input->post('task_id');
				/*$task_data['project_id'] = $this->input->post('project_id');*/
				$task_data['task_name'] = $this->input->post('task_name');
				$task_data['task_date'] = $dat;
				$task_data['task_start_time'] = $this->input->post('start_time');
				$task_data['task_end_time'] = $this->input->post('end_time');
				$task_data['calc_task_time'] = $this->input->post('calculate_time');
				$task_data['task_description'] = $this->input->post('task_description');
				$task_data['task_status'] = $this->input->post('task_status');
				
				$this->Common_model->update('task', array('task_id'=>$data['task_id']), $task_data);
				
				$this->session->set_userdata('message', 'Task Updated Successfully!');
				
				redirect('task/task_list');
			}	
		}
		

		
	}
	function ajax_task_list(){
		
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
		
		if($user_type_id == 3)
		{
			$count = $this->Common_model->get_count('task', array('user_id' => $userid),'','','', array('projects' => 'projects.project_id = task.project_id')); 
			$config['total_rows'] = $count;
			
			$this->pagination->initialize($config);
			
			
			$task_list = $this->Common_model->get_data('task', array('user_id' => $userid),array('task.task_id'=>'DESC'),array('start' => $page,'count' => $config['per_page']),'', array('projects' => 'projects.project_id = task.project_id'));
			
			$pagination_link = $this->pagination->create_links();
			
			
			
				$ajax_view = '<table class="table table-hover table-bordered results" id="datatable">
							<thead>
								<tr>
									<th>#</th>
									<!--<th>Employee Name</th>-->
									<th>Project Name</th>
									<th>Task Name</th>
									<th>Date</th>
									<th>Start Time</th>
									<th>End Time</th>
									<th>Total Time</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
								<tr class="warning no-result">
								  <td colspan="4"><i class="fa fa-warning"></i> No result</td>
								</tr>
							</thead>
							<tbody>';
							
							$count = count($task_list); 
							if($count > 0)
							{
								$i = 1;
								foreach($task_list as $list)
								{

									$date = view_date_format($list->task_date);    
									$ajax_view .= '<tr id="'.$list->task_id.'">
								
									<td>'.$i.'</td>
		
									<td>'.$list->project_name.'</td>
									<td>'.$list->task_name.'</td>
									<td>'.$date.'</td>
									<td>'.$list->task_start_time.'</td>
									<td>'.$list->task_end_time.'</td>
									<td>'.$list->calc_task_time.'</td>';
								
									
									if($list->task_status==1){ $task_sattus = "In Progress";} else { $task_sattus = "Finished"; } 
									if($list->task_final_update == "0")
									{
										$update_button = '|<a href="'.base_url().'task/update_task/'.$list->task_id.'">Update</a>';
									}
									else
									{
										$update_button = '';
									}
								
									$base_url = base_url();
									$ajax_view .= '<td>'.$task_sattus.'</td>
									<td><a href="'.$base_url.'task/view_task/'.$list->task_id.'">View</a>'.$update_button.'</td>
		
									</tr>';
									
									$i = $i + 1; 

								} 
							}
							else
							{ 
								$ajax_view .=  '<tr><td colspan="9">No Record Found!</td></tr>'; 
							} 
						
						
							$ajax_view .= '</tbody>
							</table>'.$pagination_link;
							
					echo $ajax_view;	
			
			
			
		}
		
		if($user_type_id == 2)
		{
			//$count = $this->Common_model->get_count('task', array('user_id' => $userid),'','','', array('projects' => 'projects.project_id = task.project_id')); 
			//$config['total_rows'] = $count;
			
			$this->pagination->initialize($config);
			
			
			//$task_list = $this->Common_model->get_data('task', array('user_id' => $userid),array('task.task_added_time'=>'DESC'),array('start' => $page,'count' => $config['per_page']),'', array('projects' => 'projects.project_id = task.project_id'));
			
			$task_list = $this->Common_model->get_data('task','',array('task.task_id'=>'DESC'),array('start' => $page,'count' => $config['per_page']),'', array('projects' => 'projects.project_id = task.project_id','user_details' => 'user_details.user_id = task.user_id'));
			
			
			$this->data['task'] = $this->Common_model->get_count('notifications',array('user_id'=>$userid, 'reference_name'=>'task','notification_status'=>0));
			
			if($this->data['task'] > 0)
			{
			
				$update_notification = $this->Common_model->update('notifications',array('reference_name'=>'task', 'user_id'=>$userid),array('notification_status'=>'1'));
			
				$pagination_link = $this->pagination->create_links();
			
			
			
				$ajax_view = '<div class="col-md-6 col-4 align-self-center">
                                    <input type="text" class="search form-control" placeholder="What you looking for?">
                                </div>
                                <span class="counter pull-right"></span>
								<table class="table table-hover table-bordered results" id="datatable">
							<thead>
								<tr>
									<th>#</th>
									<th>Employee Name</th>
									<th>Project Name</th>
									<th>Task Name</th>
									<th>Date</th>
									<th>Total Time</th>
									<th>Task Status</th>
									<th>Review Status</th>
                                    <th>Grade</th>
									<th>Action</th>
								</tr>
								<tr class="warning no-result">
								  <td colspan="4"><i class="fa fa-warning"></i> No result</td>
								</tr>
							</thead>
							<tbody>';
							
							$count = count($task_list); 
							if($count > 0)
							{
								$i = 1;
								foreach($task_list as $list)
								{

									$date = view_date_format($list->task_date);    
									$ajax_view .= '<tr id="'.$list->task_id.'">
								
									<td>'.$i.'</td>
									<td>'.$list->name.'</td>
									<td>'.$list->project_name.'</td>
									<td>'.$list->task_name.'</td>
									<td>'.$date.'</td>
									<td>'.$list->calc_task_time.'</td>';
									
									if($list->task_status==1){ $task_sattus = "In Progress";} else { $task_sattus = "Finished"; }								
									if($list->manager_status==0){ $review_status = 'Pending';} 
											elseif($list->manager_status==1){$review_status = 'Waiting for approval';} 
											else{$review_status = 'Approved';}
									
									/* 
									if($list->task_final_update == "0")
									{
										$update_button = '|<a href="'.base_url().'task/update_task/'.$list->task_id.'">Update</a>';
									}
									else
									{
										$update_button = '';
									}*/
								
									$base_url = base_url();
									$ajax_view .= '<td>'.$task_sattus.'</td>
													<td>'.$review_status.'</td>
													<td>'.$list->manager_score.' /10</td>
									<td><a href="'.$base_url.'task/view_task/'.$list->task_id.'">View</a>';
									if($list->manager_status!=2)
									{ 
									$ajax_view .= '<button type="button" data-id="'.$list->task_id.'" class="review btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Remarks</button>';
									
									}
						
									$ajax_view .= '</td>
		
									</tr>';
									
									$i = $i + 1; 

								} 
							}
							else
							{ 
								$ajax_view .=  '<tr><td colspan="9">No Record Found!</td></tr>'; 
							} 
						
						
							$ajax_view .= '</tbody>
							</table>'.$pagination_link;
							
					echo $ajax_view;	
				}
				else{
					echo "0";
				}
			
			
		}


		if($user_type_id == 1)
		{
			
			$this->pagination->initialize($config);
			
			$task_list = $this->Common_model->get_data('task','',array('task.task_id'=>'DESC'),array('start' => $page,'count' => $config['per_page']),'', array('projects' => 'projects.project_id = task.project_id','user_details' => 'user_details.user_id = task.user_id'));
			
			$this->data['task'] = $this->Common_model->get_count('notifications',array('user_id'=>$userid, 'reference_name'=>'task','notification_status'=>0));
			
			if($this->data['task'] > 0)
			{
			
				$update_notification = $this->Common_model->update('notifications',array('reference_name'=>'task', 'user_id'=>$userid),array('notification_status'=>'1'));
			
			$pagination_link = $this->pagination->create_links();
			
			
			
			$ajax_view = '<div class="col-md-6 col-4 align-self-center">
							<input type="text" class="search form-control" placeholder="What you looking for?">
							</div>
							<span class="counter pull-right"></span>
							<table class="table table-hover table-bordered results" id="datatable">
							<thead>
								<tr>
									<th>#</th>
									<th>Employee Name</th>
									<th>Project Name</th>
									<th>Task Name</th>
									<th>Date</th>
									<th>Total Time</th>
									<th>Task Status</th>
									<th>Review Status</th>
                                    <th>Grade</th>
									<th>Action</th>
								</tr>
								<tr class="warning no-result">
								  <td colspan="4"><i class="fa fa-warning"></i> No result</td>
								</tr>
							</thead>
							<tbody>';
							
							$count = count($task_list); 
							if($count > 0)
							{
								$i = 1;
								foreach($task_list as $list)
								{

									$date = view_date_format($list->task_date);    
									$ajax_view .= '<tr id="'.$list->task_id.'">
								
									<td>'.$i.'</td>
									<td>'.$list->name.'</td>
									<td>'.$list->project_name.'</td>
									<td>'.$list->task_name.'</td>
									<td>'.$date.'</td>
									<td>'.$list->calc_task_time.'</td>';
								
									
									if($list->task_status==1){ $task_sattus = "In Progress";} else { $task_sattus = "Finished"; }
									if($list->manager_status==0){ $review_status = 'Pending';} 
											elseif($list->manager_status==1){$review_status = 'Waiting for approval';} 
											else{$review_status = 'Approved';}
									 
									$base_url = base_url();
									$ajax_view .= '<td>'.$task_sattus.'</td>
													<td>'.$review_status.'</td>
													<td>'.$list->manager_score.' /10</td>
									<td><a class="view" href="'.$base_url.'task/view_task/'.$list->task_id.'">View</a>&nbsp;|&nbsp;<a class="delete" href="'.$base_url.'task/delete_task/'.$list->task_id.'">Delete</a></td>
		
									</tr>';							 
							
									$i = $i + 1; 	
				

								} 
		
							}
							else
							{ 
								$ajax_view .=  '<tr><td colspan="9">No Record Found!</td></tr>'; 
							} 
						
						
							$ajax_view .= '</tbody>
							</table>'.$pagination_link;
							
					echo $ajax_view;
			}
			else{
				echo "0";
			}

		}	

	}
	
	
	
	
	public function filter_task_list()
	{
		$userid = get_user_id();
		$user_type_id = get_user_type_id();

		//$count = $this->Common_model->get_count('task');	

		
		$page =($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		
		if($user_type_id == 3)
		{
			
			$this->data['project_list'] = $this->Common_model->get_data('projects',array('assigned_project.employee_id'=>$userid),'','','',array('assigned_project' => 'assigned_project.project_id = projects.project_id'));
			
			
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
			/*$employee_id =$this->input->post('employee_id');
			if( !empty($employee_id))
			{
				$user_id = $this->input->post('employee_id');
				$query .=" AND `user_details`.`user_id`=$user_id";
			}*/
			
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

			//$this->data['task_list'] = $this->Common_model->get_data('task', array('task.user_id' => $userid),array('task.task_added_time'=>'DESC'),'','', array('projects' => 'projects.project_id = task.project_id'));
			///print_r($this->data['task_list']);
			
			$last_query = "SELECT * FROM `task` INNER JOIN `projects` ON `projects`.`project_id`=`task`.`project_id` WHERE `task`.`user_id`=$userid AND `projects`.`project_status`>0".$query."  ORDER BY `task`.`task_id` DESC";
			
			//echo $last_query; die;
			$query = $this->db->query($last_query);
			
			$this->data['task_list'] = $query->result_object($query);
			
			$this->load->view($this->filter_task_list, $this->data);
		}
		
		
		if($user_type_id == 2)
		{
			
			$this->data['project_list'] = $this->Common_model->get_data('projects');
			
			
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
			
			//$last_query = "SELECT * FROM `task` INNER JOIN `projects` ON `projects`.`project_id`=`task`.`project_id` WHERE `task`.`user_id`=$userid AND `projects`.`project_status`>0".$query."  ORDER BY `task`.`task_added_time` DESC";
			$last_query = "SELECT * FROM `task` INNER JOIN `projects` ON `projects`.`project_id`=`task`.`project_id` INNER JOIN `user_details` ON `user_details`.`user_id`=`task`.`user_id` WHERE `projects`.`project_status`>0".$query."  ORDER BY `task`.`task_id` DESC";
			
			//echo $last_query; die;
			$query = $this->db->query($last_query);
			
			$this->data['task_list'] = $query->result_object($query);
			
			$this->load->view($this->filter_task_list, $this->data);
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
			
			
			$this->load->view($this->filter_task_list, $this->data);
		}

		if($user_type_id == 4)
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
			
			$last_query = "SELECT * FROM `task` INNER JOIN `projects` ON `projects`.`project_id`=`task`.`project_id` INNER JOIN `user_details` ON `user_details`.`user_id`=`task`.`user_id` WHERE `projects`.`project_status`>0".$query."  ORDER BY `task`.`task_id` DESC";
			
			$query = $this->db->query($last_query);
			
			$this->data['task_list'] = $query->result_object($query);
			
			
			$this->load->view($this->filter_task_list, $this->data);
		}
		
	}
	
	
	public function ajax_task_remark()
	{
		$data['task_id'] = $this->input->post('task_id');
		$manager_status = $this->input->post('manager_status');
		$grade = $this->input->post('grade');
		if(empty($manager_status) && empty($grade)){
			echo 'Please Fill up One of the Fields!';
		}
		else {
			if(empty($manager_status)){
				$task_data['manager_status'] = 0;
			}
			else{
				$task_data['manager_status'] = $this->input->post('manager_status');
			}
			if(empty($grade)){
				$task_data['manager_score'] = 0;
			}
			else{
				$task_data['manager_score'] = $this->input->post('grade');
			}
			
			$this->Common_model->update('task', array('task_id'=>$data['task_id']), $task_data);
			echo 'Remarks Submitted Successfully!';
		}
	
	}
	

	
	
	
	public function project_milestone()
	{
		$task_array = array();
		$this->data['project_list'] = $this->Common_model->get_data('projects', array('project_status'=>'2'));
		/*
		$project_list = $this->Common_model->get_data('projects', array('project_status'=>'2'));
		foreach($project_list as $project){
			
			$task_list = $this->Common_model->get_data('task', array('task.project_id'=>$project->project_id),'','','',array('projects'=>'projects.project_id =  task.project_id'));
			$this->data['task_array'] = array_push($task_array,$task_list);
		}*/
		//echo "<pre>";  print_r($this->data['task_array']); die;
		$this->load->view($this->project_milestone, $this->data);
	}
	
	
	public function filter_project_milestone()
	{
		
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		
		$page =($this->uri->segment(3)) ? $this->uri->segment(3) : 0;		
		
		if($user_type_id == '1' || $user_type_id == '2')
		{
			$this->form_validation->set_rules('project_id', 'Project Name', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				redirect('task/project_milestone');
			}
			else
			{	
				$project_id = $this->input->post('project_id');
				if( !empty($project_id))
				{
					$project_id = $this->input->post('project_id');
					$this->data['project_list'] = $this->Common_model->get_data('projects',array('project_id'=>$project_id));
				}
				$this->data['project_data'] = $this->Common_model->get_data('projects', array('project_status'=>'2'));
				$this->load->view($this->filter_project_milestone, $this->data);
			}

		}
		
	
	}
	
	
	
	public function add_main_task()
	{
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		if($user_type_id == 2)
		{
			$this->data['project_list'] = $this->Common_model->get_data('projects', array('project_status'=>'2'));
			$this->load->view($this->add_main_task, $this->data);
		}	
		/*if($user_type_id == 3)
		{
			$this->data['project_list'] = $this->Common_model->get_data('projects', array('projects.project_status'=>'2','assigned_project.employee_id'=>$user_id),'','','',array('assigned_project'=>'assigned_project.project_id =  projects.project_id'),'','projects.project_id');
			
			//print_r($this->data['project_list']); die;
			
			$this->load->view($this->add_main_task, $this->data);
		}*/
	}	
	
	public function do_add_main_task()
	{
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		if($user_type_id == 2)
		{		
			//echo "<pre>";// print_r($_POST); die;
			
			$this->form_validation->set_rules('project_id', 'Project Name', 'required');
			$this->form_validation->set_rules('task_name', 'Task Name', 'required');
			$this->form_validation->set_rules('task_deadline', 'Task Deadline', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view($this->add_main_task, $this->data);
			}
			else
			{	
				$dat = db_date_format($this->input->post('task_deadline'));
				//$task_data['user_id'] = $this->input->post('user_id');
				$task_data['project_id'] = $this->input->post('project_id');
				$task_data['task_name'] = $this->input->post('task_name');
				$task_data['task_main_deadline'] = $dat;
				//$task_data['task_start_time'] = $this->input->post('start_time');
				//$task_data['task_end_time'] = $this->input->post('end_time');
				//$task_data['calc_task_time'] = $this->input->post('calculate_time');
				//$task_data['task_description'] = $this->input->post('task_description');
				$task_data['task_main_status'] = $this->input->post('task_status');
				
				//$task_data['task_added_time'] = date("Y-m-d h:i:s");
				
				$insert_ids = $this->Common_model->insert('task_main', $task_data);
				
				$superadmin_id = get_superadmin_id();
				
				//$sel_subadmin_arr = $this->Common_model->get_data('users',array('user_type'=>2));

				/*foreach($sel_subadmin_arr as $sel_subadmin)
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
				
				$this->Common_model->insert('notifications', $notification_data);*/
				
				$this->session->set_userdata('message', 'Task Added Successfully!');
				redirect('task/add_main_task');
			}	
		}
		

		
	}
	
	public function time_management()
	{
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		if($user_type_id == 2 || $user_type_id == 1 || $user_type_id == 4)
		{
			$this->data['project_list'] = $this->Common_model->get_data('projects');
			$this->data['employee_list'] = $this->Common_model->get_data('users','','','','',array('user_details'=>'user_details.user_id=users.user_id'));
			
			$last_query = "SELECT * FROM `projects` LIMIT 1";
			//$last_query = "SELECT * FROM `projects` INNER JOIN `task` ON `task`.`project_id`=`projects`.`project_id` WHERE `projects`.`project_status`>0 GROUP BY `task`.`task_main_id` ORDER BY `task`.`task_id` DESC";
			
			
			$query = $this->db->query($last_query);
			
			$this->data['latest_project'] = $query->result_object($query);
			

			$all_task = $this->Common_model->get_data('task');
			$time_array = array();
			$total_time = 0;
			foreach($all_task as $task){
				$time = $task->calc_task_time;
				$total_time = $total_time + $time;
			}
			
			$this->data['total_time'] = $total_time;
			
			$this->load->view($this->time_management, $this->data);
		}	
		
		/*if($user_type_id == 3)
		{
			
			$this->data['project_list'] = $this->Common_model->get_data('projects', array('projects.project_status'=>'2','assigned_project.employee_id'=>$user_id),'','','',array('assigned_project'=>'assigned_project.project_id =  projects.project_id'),'','projects.project_id');
			
			
			$this->load->view($this->time_management, $this->data);
		}*/
	}
	
	
	public function time_management_filter()
	{
		$this->session->unset_userdata('filter_employee_id');
		
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		if($user_type_id == 2 || $user_type_id == 1 || $user_type_id == 4)
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
			$userid='';
			if( !empty($employee_id))
			{
				$userid = $this->input->post('employee_id');
				//echo $userid; die;
				
				$this->session->set_userdata('filter_employee_id',$userid);
				
				$query .=" AND `user_details`.`user_id`=$userid";
			}
			
			$project_id = $this->input->post('project_id');
			
			
			
			if( !empty($project_id))
			{
				$project_id = $this->input->post('project_id');
				if($project_id == '1'){
					
					$sel_projects = $this->Common_model->get_data("projects");
					//$sel_projects = "SELECT `project_id` FROM `projects`";
					//$sel_projects = $this->db->query($sel_projects);
			
					//$all_project = $query->result_object($sel_projects);
					$cnt = count($sel_projects);
					$i=0;
					$query .= " AND ";
					foreach($sel_projects as $project_id){
						$i++;
						$query .="`projects`.`project_id`=".$project_id->project_id;
						if($i < $cnt){
							$query .=" OR ";
						}
					}
					
					//$query .=" AND `projects`.`project_id`=$project_id";
				}
				else{
				
					$query .=" AND `projects`.`project_id`=$project_id";
				}
			}
			
			$status_id = $this->input->post('status_id');
			if( $status_id >= 1)
			{
				$status_id = $this->input->post('status_id');
				$query .=" AND `task`.`task_status`=$status_id";
			}
			
			$last_query = "SELECT * FROM `projects` INNER JOIN `task` ON `task`.`project_id`=`projects`.`project_id` INNER JOIN `user_details` ON `user_details`.`user_id`=`task`.`user_id` WHERE `projects`.`project_status`>0".$query." GROUP BY `task`.`task_main_id` ORDER BY `task`.`task_id` DESC";
			
			//echo $last_query; die;
			$query = $this->db->query($last_query);
			
			$this->data['latest_project'] = $query->result_object($query);
			$this->data['employee'] = $userid;
			
			//print_r($this->data['latest_project']); die;
			
//$this->load->view($this->filter_task_list, $this->data);
			$this->load->view($this->time_management_filter, $this->data);
		}	
		/*if($user_type_id == 3)
		{
			
			$this->data['project_list'] = $this->Common_model->get_data('projects', array('projects.project_status'=>'2','assigned_project.employee_id'=>$user_id),'','','',array('assigned_project'=>'assigned_project.project_id =  projects.project_id'),'','projects.project_id');
			
			//print_r($this->data['project_list']); die;
			
			$this->load->view($this->time_management, $this->data);
		}*/
	}
	
	
	

	public function delete_task()
	{
		$this->load->helper('url');
		
		$task_id = $this->uri->segment(3);
		
		$del_task = $this->Common_model->delete('task', array('task_id' => $task_id));
		$del_notification = $this->Common_model->delete('notifications', array('reference_id'=>$task_id));
		
		$this->session->set_userdata('message', 'Task Deleted Successfully!');
		
		redirect('task/task_list');
	}
	
}
