<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

	public $dashboard;
	public $user_details;
	public $user_type_id;
	
	public function __construct()
    {
		
        parent::__construct();
		
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
				$this->add_project = "superadmin/add_project";
				$this->project_list = "superadmin/project_list";
				$this->assign_project = "superadmin/assign_project";
				$this->project_details = "superadmin/project_details";
				$this->filter_project_list = "superadmin/filter_project_list";
				$this->update_project = "superadmin/update_project";
				$this->remove_employee = "superadmin/remove_employee";
				
				break;
				
			case "2":
				$this->add_project = "subadmin/add_project";
				$this->project_list = "subadmin/project_list";	
				$this->assign_project = "subadmin/assign_project";
				$this->project_details = "subadmin/project_details";
				$this->filter_project_list = "subadmin/filter_project_list";
				$this->update_project = "subadmin/update_project";
				$this->remove_employee = "subadmin/remove_employee";
				
				break;
				
			case "3":
				/*$this->add_task = "admin/add_task";
				$this->task_list = "admin/task_list";*/
				$this->project_list = "admin/project_list";
				$this->project_details = "admin/project_details";
				break;
				
			case "4":
				//$this->add_project = "subadmin/add_project";
				$this->project_list = "hradmin/project_list";	
				//$this->assign_project = "subadmin/assign_project";
				$this->project_details = "hradmin/project_details";
				$this->filter_project_list = "hradmin/filter_project_list";
				break;
				
			default:
				$page404 = "page404";
		}
		
		$this->data['user_details'] = get_user_details();
		
		
    }  


	public function project_list()
	{
		//echo "hello";die;
		
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		
		$count = $this->Common_model->get_count('projects'); 

		$config['base_url'] = site_url('project/project_list');
		$config['total_rows'] = $count;
		$config['uri_segment']  = 3;
		$config['per_page'] = 30;
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
		
		if($user_type_id == '1')
		{
			$this->pagination->initialize($config);
			
			//$this->data['all_project_data'] = $this->Common_model->get_data('projects',array('notifications.reference_name'=>'projects'),array('projects.project_created_at'=>'DESC'),array('start' => $page,'count' => $config['per_page']),'',array('notifications'=>'notifications.reference_id = projects.project_id'),'projects.project_id');
			
			$query = "SELECT * FROM `projects` JOIN `notifications` ON `notifications`.`reference_id` = `projects`.`project_id` WHERE `notifications`.`reference_name` = 'projects' AND `notifications`.`user_id` = $user_id GROUP BY `projects`.`project_id` ORDER BY `projects`.`project_created_at` DESC LIMIT 30";
			//echo $query; die;
			$query = $this->db->query($query);
			$this->data['all_project_data'] = $query->result_object();
			
			$this->data['pagination_link'] = $this->pagination->create_links();		

		}
		if($user_type_id == '2')
		{
			$this->pagination->initialize($config);
			
			//$this->data['all_project_data'] = $this->Common_model->get_data('projects',array('notifications.reference_name'=>'projects','notifications.user_id'=>$user_id),array('projects.project_created_at'=>'DESC'),array('start' => $page,'count' => $config['per_page']),'',array('notifications'=>'notifications.reference_id = projects.project_id'),'projects.project_id');
			
			$query = "SELECT * FROM `projects` JOIN `notifications` ON `notifications`.`reference_id` = `projects`.`project_id` WHERE `notifications`.`reference_name` = 'projects' AND `notifications`.`user_id` = $user_id GROUP BY `projects`.`project_id` ORDER BY `projects`.`project_created_at` DESC LIMIT 30";
			
			$query = $this->db->query($query);
			$this->data['all_project_data'] = $query->result_object();
			
			//print_r($this->data['all_project_data']); die;
			
			$this->data['pagination_link'] = $this->pagination->create_links();				
		}
		if($user_type_id == '3')
		{
			
			$count = $this->Common_model->get_count('assigned_project', array('assigned_project.employee_id'=>$user_id)); 
			
			$config['total_rows'] = $count;
			
			$this->pagination->initialize($config);

			$this->data['all_project_data'] = $this->Common_model->get_data('projects', array('notifications.reference_name' => 'assigned_project', 'notifications.user_id' => $user_id, 'assigned_project.employee_id'=>$user_id),array('projects.project_created_at'=>'DESC'),array('start' => $page,'count' => $config['per_page']),'', array('assigned_project'=>'assigned_project.project_id =  projects.project_id', 'notifications'=>'notifications.reference_id = projects.project_id'),'','projects.project_id');
			
			//echo $sql = $this->db->last_query(); die;
			
			//$query = "SELECT * FROM `projects` JOIN `notifications` ON `notifications`.`reference_id` = `projects`.`project_id` JOIN `assigned_project` ON `assigned_project`.`project_id` = `projects`.`project_id` WHERE `notifications`.`reference_name` = 'assigned_project' AND `notifications`.`user_id` = $user_id AND `assigned_project`.`employee_id` = $user_id ORDER BY `projects`.`project_created_at` DESC LIMIT 30";
			
			///$query = $this->db->query($query);
			//$this->data['all_project_data'] = $query->result_object();
			
			//print_r($this->data['all_project_data']); die;
			
			$this->data['pagination_link'] = $this->pagination->create_links();	
		}
		
		if($user_type_id == '4')
		{
			$this->pagination->initialize($config);
			
			//$this->data['all_project_data'] = $this->Common_model->get_data('projects',array('notifications.reference_name'=>'projects','notifications.user_id'=>$user_id),array('projects.project_created_at'=>'DESC'),array('start' => $page,'count' => $config['per_page']),'',array('notifications'=>'notifications.reference_id = projects.project_id'),'projects.project_id');
			
			$query = "SELECT * FROM `projects` GROUP BY `projects`.`project_id` ORDER BY `projects`.`project_created_at` DESC LIMIT 30";
			
			$query = $this->db->query($query);
			$this->data['all_project_data'] = $query->result_object();
			
			//print_r($this->data['all_project_data']); die;
			
			$this->data['pagination_link'] = $this->pagination->create_links();				
		}
		
		$this->load->view($this->project_list, $this->data);
	}		
	
	public function add_project()
	{
		$this->data['project_type'] = $this->Common_model->get_data('project_type', array('project_type_status'=>'1'));
		
		$this->load->view($this->add_project, $this->data);
	
	}	
	
	public function do_add_project()
	{
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		
		if($user_type_id==2){
			$this->form_validation->set_rules('project_name', 'Project Name', 'required');
			$this->form_validation->set_rules('total_manhour', 'Total Manhour', 'required');
			$this->form_validation->set_rules('project_start', 'Project Start Date', 'required');
			$this->form_validation->set_rules('project_end', 'Project End Date', 'required');
	
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view($this->add_project, $this->data);
			}
			else
			{	
			
				$dat_start = db_date_format($this->input->post('project_start'));
				$dat_end = db_date_format($this->input->post('project_end'));
				
				$projectdata = array(
				'project_name' => $this->input->post('project_name'),
				'project_description' => $this->input->post('pro_description'),
				'project_total_manhour' => $this->input->post('total_manhour'),
				'project_valueation' => $this->input->post('project_valuation'),
				/*'project_deadline' => $this->input->post('project_deadline'),*/
				'project_start' => $dat_start,
				'project_deadline' => $dat_end,
				'project_priroty' => $this->input->post('project_priroty'),
				);
				
				$this->security->xss_clean($projectdata);	
	
	
				$project_id = $this->Common_model->insert('projects', $projectdata);
				
				$superadmin_id = get_superadmin_id();
										
				$sel_subadmin_arr = $this->Common_model->get_data('users',array('user_type'=>2));

				foreach($sel_subadmin_arr as $sel_subadmin)
				{
					if($sel_subadmin->user_id == $user_id)
					{
						$notification_data['reference_id'] = $project_id;
						$notification_data['reference_name'] = 'projects';
						$notification_data['user_id'] = $sel_subadmin->user_id;
						$notification_data['notification_status'] = '1';
						
						$this->Common_model->insert('notifications', $notification_data);
					}
					else
					{
						$notification_data['reference_id'] = $project_id;
						$notification_data['reference_name'] = 'projects';
						$notification_data['user_id'] = $sel_subadmin->user_id;
						$notification_data['notification_status'] = '0';
						
						$this->Common_model->insert('notifications', $notification_data);						
					}
					

						
				}
				
				$notification_data['reference_id'] = $project_id;
				$notification_data['reference_name'] = 'projects';
				$notification_data['user_id'] = $superadmin_id;
				$notification_data['notification_status'] = '0';
				
				$this->Common_model->insert('notifications', $notification_data);
				
				//print_r($notification_data); die;
				
				if($project_id)
				{
					$this->session->set_userdata('message', 'Project Inserted Successfully!');
					redirect('project/project_list');
				}
				//echo "<pre>"; print_r($userdata);	die;			
			}
		}
		
		if($user_type_id==1){
			$this->form_validation->set_rules('project_name', 'Project Name', 'required');
			$this->form_validation->set_rules('total_manhour', 'Total Manhour', 'required');
			$this->form_validation->set_rules('project_start', 'Project Start Date', 'required');
			$this->form_validation->set_rules('project_end', 'Project End Date', 'required');
	
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view($this->add_project, $this->data);
			}
			else
			{	
				
				//$dat = db_date_format($this->input->post('project_deadline'));
				$dat_start = db_date_format($this->input->post('project_start'));
				$dat_end = db_date_format($this->input->post('project_end'));
				
				$projectdata = array(
				'project_name' => $this->input->post('project_name'),
				'project_description' => $this->input->post('pro_description'),
				'project_total_manhour' => $this->input->post('total_manhour'),
				'project_valueation' => $this->input->post('project_valuation'),
				/*'project_deadline' => $this->input->post('project_deadline'),*/
				//'project_deadline' => $dat,
				'project_start' => $dat_start,
				'project_deadline' => $dat_end,
				'project_priroty' => $this->input->post('project_priroty'),
				);
				
				$this->security->xss_clean($projectdata);	
	
	
				$project_id = $this->Common_model->insert('projects', $projectdata);
				
				$superadmin_id = get_superadmin_id();
				
				
				$sel_subadmin_arr = $this->Common_model->get_data('users',array('user_type'=>2));

				foreach($sel_subadmin_arr as $sel_subadmin)
				{
					$notification_data['reference_id'] = $project_id;
					$notification_data['reference_name'] = 'projects';
					$notification_data['user_id'] = $sel_subadmin->user_id;
					
					$this->Common_model->insert('notifications', $notification_data);
						
				}
				$notification_data['reference_id'] = $project_id;
				$notification_data['reference_name'] = 'projects';
				$notification_data['user_id'] = $superadmin_id;
				$notification_data['notification_status'] = '1';
				
				$this->Common_model->insert('notifications', $notification_data);
		
				if($project_id)
				{
					$this->session->set_userdata('message', 'Project Inserted Successfully!');
					redirect('project/project_list');
				}
				//echo "<pre>"; print_r($userdata);	die;			
			}
		}

	}
	
	
	public function assign_project()
	{
		$this->data['project_list'] = $this->Common_model->get_data('projects', array('project_status'=>'2')); 
		
		$this->data['employee_list'] = $this->Common_model->get_data('users', array('user_details.employee_designation'=>'2', 'users.user_status'=>'1'),'','','',array('user_details'=>'user_details.user_id = users.user_id'));
		
		$this->data['project_manager_list'] = $this->Common_model->get_data('users', array('user_details.employee_designation'=>'1', 'users.user_status'=>'1'),'','','',array('user_details'=>'user_details.user_id = users.user_id'));
		
		//echo "<pre>";print_r($this->data['project_manager_list']); die;
		
		$this->load->view($this->assign_project, $this->data);
	}
	
	public function ajax_assign_project()
	{

		$project_id = $this->input->post('project_id'); 
		$employee_ids = $this->Common_model->get_data('assigned_project', array('project_id'=>$project_id));
	
		
		$s_query = "";
		if(count($employee_ids) > 0)
		{
			foreach($employee_ids as $employee_id)
			{
				$s_query .= "`user_details`.`user_id` != ".$employee_id->employee_id." AND ";
				
			}
		}
		/*else
		{
			$s_query = "";
		}*/

		
		$query_s = "SELECT * FROM `users` INNER JOIN `user_details` ON `users`.`user_id` = `user_details`.`user_id` WHERE $s_query `users`.`user_status`=1 AND `users`.`user_type`=3";

		$query_s = $this->db->query($query_s); 
		//echo $sql = $this->db->last_query(); die;
		
		$employee_list = $query_s->result_object();
		//echo '<pre>';print_r($employee_list); die;

		$ajax_view ='';
		$count = count($employee_list); 
		if($count > 0)
		{
			foreach($employee_list as $list)
			{
				$ajax_view .= '<option value="'.$list->user_id.'">'.$list->name.'</option>';
			}
		}
		echo $ajax_view; //die;
		
	}
	
	
	public function do_assign_project()
	{
		//print_r($_POST); 
		
		$count = count($this->input->post('employee_id'));
		$employee_arr = $this->input->post('employee_id');
		
		//echo "<pre>";print_r($employee_arr); die;
		
		if($count > 0)
		{
			foreach($employee_arr as $employee)
			{
				$this->datas['project_id'] = $this->input->post('project_id');	
				$this->datas['employee_id'] = $employee;
				$this->datas['manager_id'] = $this->input->post('project_manager_id');
				
				$assigned_id = $this->Common_model->insert('assigned_project', $this->datas);
				
				$notification_data['reference_id'] = $this->input->post('project_id');
				$notification_data['reference_name'] = 'assigned_project';
				$notification_data['user_id'] = $employee;
				$notification_data['notification_status'] = '0';
				
				$this->Common_model->insert('notifications', $notification_data);
			}
			
			$this->session->set_userdata('message', 'Project Assigned Successfully!');
			redirect('project/assign_project');
		}
		
	}	
	
	
	public function remove_employee()
	{
		$this->data['project_list'] = $this->Common_model->get_data('projects', array('project_status'=>'2')); 
		
		$this->data['employee_list'] = $this->Common_model->get_data('users', array('user_details.employee_designation'=>'2', 'users.user_status'=>'1'),'','','',array('user_details'=>'user_details.user_id = users.user_id'));
		
		$this->data['project_manager_list'] = $this->Common_model->get_data('users', array('user_details.employee_designation'=>'1', 'users.user_status'=>'1'),'','','',array('user_details'=>'user_details.user_id = users.user_id'));
		
		//echo "<pre>";print_r($this->data['project_manager_list']); die;
		
		$this->load->view($this->remove_employee, $this->data);
	}
	
	public function ajax_remove_employee()
	{

		$project_id = $this->input->post('project_id'); 
		$employee_ids = $this->Common_model->get_data('assigned_project', array('project_id'=>$project_id));
	
		
		
		$ajax_view ='';
		if(count($employee_ids) > 0)
		{	
			$cnt=count($employee_ids);
			$s_query = "";
			$i=0;
			foreach($employee_ids as $employee_id)
			{
				$i++;
				
				$s_query .= "`user_details`.`user_id` = ".$employee_id->employee_id;
				if($i < $cnt){
					$s_query .= " OR";
				}
			}
			$query_s = "SELECT * FROM `users` INNER JOIN `user_details` ON `users`.`user_id` = `user_details`.`user_id` WHERE $s_query AND `users`.`user_type`=3 AND `users`.`user_status`=1";

			$query_s = $this->db->query($query_s); 
			//echo $sql = $this->db->last_query(); die;
			
			$employee_list = $query_s->result_object();
			//echo '<pre>';print_r($employee_list); die;
			$count = count($employee_list);
			
			$ajax_view ='';
			if($count > 0)
			{
				foreach($employee_list as $list)
				{
					$ajax_view .= '<option value="'.$list->user_id.'">'.$list->name.'</option>';
				}
			}
		}
		
		echo $ajax_view; //die;
		
	}

	public function update_assign_project()
	{
		//print_r($_POST); 
		
		$count = count($this->input->post('employee_id'));
		$employee_arr = $this->input->post('employee_id');
		
		//echo "<pre>";print_r($employee_arr); die;
		
		if($count > 0)
		{
			foreach($employee_arr as $employee)
			{
				$project_id = $this->input->post('project_id');	
				$employee_id = $employee;
				//$this->datas['manager_id'] = $this->input->post('project_manager_id');
				
				$assigned_id = $this->Common_model->delete('assigned_project', array('project_id'=>$project_id, 'employee_id'=>$employee_id));
				
			}
			
			$this->session->set_userdata('message', 'Employee Removed Successfully!');
			redirect('project/remove_employee');
		}
		
	}
	
	public function project_details()
	{
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		if($user_type_id == '1')
		{		

			$project_id = $this->uri->segment(3);
			
			$this->data['projects'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id,'reference_id'=>$project_id, 'reference_name'=>'projects','notification_status'=>0));
			
			if($this->data['projects'] > 0)
			{
				$update_notification = $this->Common_model->update('notifications',array('reference_name'=>'projects','user_id'=>$user_id,'reference_id'=>$project_id),array('notification_status'=>'1'));
				
			}
			
			$this->data['project_details'] = $this->Common_model->get_data('projects', array('project_id' => $project_id));
			
			$this->data['assigned_employee'] = $this->Common_model->get_data('projects', array('projects.project_id' => $project_id),'','','', array('assigned_project'=>'assigned_project.project_id = projects.project_id', 'user_details'=>'user_details.user_id = assigned_project.employee_id', 'department'=>'department.department_id = user_details.department_id'));
			
			
			$this->data['manager_details'] = $this->Common_model->get_data('projects', array('projects.project_id' => $project_id),'','','', array('assigned_project'=>'assigned_project.project_id = projects.project_id', 'user_details'=>'user_details.user_id = assigned_project.manager_id'),'','assigned_project.manager_id');
			//$this->data['manager_details'] = $this->Common_model->get_data('user_details', array('employee_designation' => '1'));	

		}		
		
		if($user_type_id == '2')
		{		

			$project_id = $this->uri->segment(3);
			
			$this->data['projects'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id,'reference_id'=>$project_id, 'reference_name'=>'projects','notification_status'=>0));
			
			if($this->data['projects'] > 0)
			{
				$update_notification = $this->Common_model->update('notifications',array('reference_name'=>'projects','user_id'=>$user_id,'reference_id'=>$project_id),array('notification_status'=>'1'));
				
			}
			
			$this->data['project_details'] = $this->Common_model->get_data('projects', array('project_id' => $project_id));
			
			$this->data['assigned_employee'] = $this->Common_model->get_data('projects', array('projects.project_id' => $project_id),'','','', array('assigned_project'=>'assigned_project.project_id = projects.project_id', 'user_details'=>'user_details.user_id = assigned_project.employee_id', 'department'=>'department.department_id = user_details.department_id'));
			
			
			$this->data['manager_details'] = $this->Common_model->get_data('projects', array('projects.project_id' => $project_id),'','','', array('assigned_project'=>'assigned_project.project_id = projects.project_id', 'user_details'=>'user_details.user_id = assigned_project.manager_id'),'','assigned_project.manager_id');	

		}
		
		if($user_type_id == '3')
		{		

			$project_id = $this->uri->segment(3);
			
			$this->data['projects'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id,'reference_id'=>$project_id, 'reference_name'=>'assigned_project','notification_status'=>0));
			
			if($this->data['projects'] > 0)
			{
				$update_notification = $this->Common_model->update('notifications',array('reference_name'=>'assigned_project','user_id'=>$user_id,'reference_id'=>$project_id),array('notification_status'=>'1'));
				
			}
			
			$this->data['project_details'] = $this->Common_model->get_data('projects', array('project_id' => $project_id));
			
			$this->data['assigned_employee'] = $this->Common_model->get_data('projects', array('projects.project_id' => $project_id),'','','', array('assigned_project'=>'assigned_project.project_id = projects.project_id', 'user_details'=>'user_details.user_id = assigned_project.employee_id', 'department'=>'department.department_id = user_details.department_id'));
			
			
			$this->data['manager_details'] = $this->Common_model->get_data('projects', array('projects.project_id' => $project_id),'','','', array('assigned_project'=>'assigned_project.project_id = projects.project_id', 'user_details'=>'user_details.user_id = assigned_project.manager_id'),'','assigned_project.manager_id');	

		}
		
		if($user_type_id == '4')
		{		

			$project_id = $this->uri->segment(3);
			
			$this->data['project_details'] = $this->Common_model->get_data('projects', array('project_id' => $project_id));
			
			$this->data['assigned_employee'] = $this->Common_model->get_data('projects', array('projects.project_id' => $project_id),'','','', array('assigned_project'=>'assigned_project.project_id = projects.project_id', 'user_details'=>'user_details.user_id = assigned_project.employee_id', 'department'=>'department.department_id = user_details.department_id'));
			
			
			$this->data['manager_details'] = $this->Common_model->get_data('projects', array('projects.project_id' => $project_id),'','','', array('assigned_project'=>'assigned_project.project_id = projects.project_id', 'user_details'=>'user_details.user_id = assigned_project.manager_id'),'','assigned_project.manager_id');	

		}
		
		$this->load->view($this->project_details, $this->data);
		
		
	}
	
	
	public function update_project()
	{
		$project_id = $this->uri->segment(3);
		
		$this->data['project_details'] = $this->Common_model->get_data('projects', array('projects.project_id' => $project_id));
		
		$this->load->view($this->update_project, $this->data);
	
	}
	
	public function do_update_project()
	{
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		
		if($user_type_id==2){
			$this->form_validation->set_rules('project_name', 'Project Name', 'required');
			$this->form_validation->set_rules('total_manhour', 'Total Manhour', 'required');
			$this->form_validation->set_rules('project_start', 'Project Start Date', 'required');
			$this->form_validation->set_rules('project_end', 'Project End Date', 'required');
	
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view($this->update_project, $this->data);
			}
			else
			{	
				$projects_id = $this->input->post('project_id');
				
				$dat_start = db_date_format($this->input->post('project_start'));
				$dat_end = db_date_format($this->input->post('project_end'));
				
				$projectdata = array(
				'project_name' => $this->input->post('project_name'),
				'project_description' => $this->input->post('pro_description'),
				'project_total_manhour' => $this->input->post('total_manhour'),
				'project_valueation' => $this->input->post('project_valuation'),
				/*'project_deadline' => $this->input->post('project_deadline'),*/
				'project_start' => $dat_start,
				'project_deadline' => $dat_end,
				'project_priroty' => $this->input->post('project_priroty'),
				);
				
				$this->security->xss_clean($projectdata);	
	
	
				$project_id = $this->Common_model->update('projects',array('project_id' => $projects_id), $projectdata);
				
				/*$superadmin_id = get_superadmin_id();
										
				$sel_subadmin_arr = $this->Common_model->get_data('users',array('user_type'=>2));

				foreach($sel_subadmin_arr as $sel_subadmin)
				{
					if($sel_subadmin->user_id == $user_id)
					{
						$notification_data['reference_id'] = $projects_id;
						$notification_data['reference_name'] = 'projects';
						$notification_data['user_id'] = $sel_subadmin->user_id;
						$notification_data['notification_status'] = '1';
						
						$this->Common_model->insert('notifications', $notification_data);
					}
					else
					{
						$notification_data['reference_id'] = $projects_id;
						$notification_data['reference_name'] = 'projects';
						$notification_data['user_id'] = $sel_subadmin->user_id;
						$notification_data['notification_status'] = '2';
						
						$this->Common_model->insert('notifications', $notification_data);						
					}
					

						
				}
				
				$notification_data['reference_id'] = $projects_id;
				$notification_data['reference_name'] = 'projects';
				$notification_data['user_id'] = $superadmin_id;
				$notification_data['notification_status'] = '2';
				
				$this->Common_model->insert('notifications', $notification_data);*/
				
				//print_r($notification_data); die;
				
				if($project_id)
				{
					$this->session->set_userdata('message', 'Project Updated Successfully!');
					redirect('project/project_list');
				}
				//echo "<pre>"; print_r($userdata);	die;			
			}
		}
		
		if($user_type_id==1){
			$this->form_validation->set_rules('project_name', 'Project Name', 'required');
			$this->form_validation->set_rules('total_manhour', 'Total Manhour', 'required');
			$this->form_validation->set_rules('project_start', 'Project Start Date', 'required');
			$this->form_validation->set_rules('project_end', 'Project End Date', 'required');
	
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view($this->add_project, $this->data);
			}
			else
			{	
				$projects_id = $this->input->post('project_id');
				
				//$dat = db_date_format($this->input->post('project_deadline'));
				$dat_start = db_date_format($this->input->post('project_start'));
				$dat_end = db_date_format($this->input->post('project_end'));
				
				$projectdata = array(
				'project_name' => $this->input->post('project_name'),
				'project_description' => $this->input->post('pro_description'),
				'project_total_manhour' => $this->input->post('total_manhour'),
				'project_valueation' => $this->input->post('project_valuation'),
				/*'project_deadline' => $this->input->post('project_deadline'),*/
				//'project_deadline' => $dat,
				'project_start' => $dat_start,
				'project_deadline' => $dat_end,
				'project_priroty' => $this->input->post('project_priroty'),
				);
				
				$this->security->xss_clean($projectdata);	
	
	
				$project_id = $this->Common_model->update('projects', array('project_id' => $projects_id), $projectdata);
				
				$superadmin_id = get_superadmin_id();
				
				
				$sel_subadmin_arr = $this->Common_model->get_data('users',array('user_type'=>2));

				foreach($sel_subadmin_arr as $sel_subadmin)
				{
					$notification_data['reference_id'] = $projects_id;
					$notification_data['reference_name'] = 'projects';
					$notification_data['user_id'] = $sel_subadmin->user_id;
					$notification_data['notification_status'] = '2';
					$this->Common_model->insert('notifications', $notification_data);
						
				}
				$notification_data['reference_id'] = $projects_id;
				$notification_data['reference_name'] = 'projects';
				$notification_data['user_id'] = $superadmin_id;
				$notification_data['notification_status'] = '1';
				
				$this->Common_model->insert('notifications', $notification_data);
		
				if($project_id)
				{
					$this->session->set_userdata('message', 'Project Updated Successfully!');
					redirect('project/project_list');
				}
				//echo "<pre>"; print_r($userdata);	die;			
			}
		}

	}

	public function delete_project()
	{
		$this->load->helper('url');
		
		$project_id = $this->uri->segment(3);
		$del_projects = $this->Common_model->delete('projects', array('project_id' => $project_id));
		
		$del_assigned = $this->Common_model->delete('assigned_project', array('project_id' => $project_id));
		$del_task = $this->Common_model->delete('task', array('project_id' => $project_id));
		$del_notification = $this->Common_model->delete('notifications', array('reference_id'=>$project_id));
		
	
		$this->session->set_userdata('message', 'Project Deleted Successfully!');
	
		redirect('project/project_list');
	}
	
	
	
	
	function ajax_project_list(){	
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();

		$count = $this->Common_model->get_count('projects');

		$config['base_url'] = site_url('project/project_list');
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
			
			$count = $this->Common_model->get_count('assigned_project', array('assigned_project.employee_id'=>$user_id)); 
			
			$config['total_rows'] = $count;
			
			$this->pagination->initialize($config);

			$all_project_data = $this->Common_model->get_data('projects', array('assigned_project.employee_id'=>$user_id),array('projects.project_created_at'=>'DESC'),array('start' => $page,'count' => $config['per_page']),'', array('assigned_project'=>'assigned_project.project_id =  projects.project_id'),'','projects.project_id');
			
			$update_notification = $this->Common_model->update('notifications',array('reference_name'=>'assigned_project','user_id'=>$user_id),array('notification_status'=>'1'));
			
			$pagination_link = $this->pagination->create_links();
			
			
			
			$ajax_view = '<table class="table table-hover table-bordered results">
							<thead>
								<tr>
									<th>#</th>
									
									<th>Project Name</th>
									<th>Project Type</th>
									
									<th>Project Valueation</th>
									<th>Project Deadline</th>
									<th>Action</th>
								</tr>
								<tr class="warning no-result">
								  <td colspan="4"><i class="fa fa-warning"></i> No result</td>
								</tr>
							</thead>
							<tbody>';
							
							$cont = count($all_project_data);
							if($cont > 0)
							{
								$i = 1;
								foreach($all_project_data as $project_data)
								{

									//$date = view_date_format($list->task_date);    
									$ajax_view .= '<tr id="'.$project_data->project_id.'">
								
									<td>'.$i.'</td>
									<td>'.$project_data->project_name.'</td>
									<td>'.$project_data->project_total_manhour.'</td>
									<td>'.$project_data->project_valueation.'</td>
								    <td>'.$date = view_date_format($project_data->project_deadline).'</td>';
									 
									$base_url = base_url();
									
									$ajax_view .= '<td><a href="'.$base_url.'project/project_details/'.$project_data->project_id.'">View Details</a></td>
		
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
			
			$this->pagination->initialize($config);
			
			$all_project_data = $this->Common_model->get_data('projects','',array('projects.project_created_at'=>'DESC'),array('start' => $page,'count' => $config['per_page']));
			
			$this->data['projects'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'projects','notification_status'=>0));
			
			if($this->data['projects'] > 0)
			{
			
				$update_notification = $this->Common_model->update('notifications',array('reference_name'=>'projects','user_id'=>$user_id),array('notification_status'=>'1'));
			
			$pagination_link = $this->pagination->create_links();
			
			
			
			$ajax_view = '<table class="table table-hover table-bordered results">
							<thead>
								<tr>
									<th>#</th>
									
									<th>Project Name</th>
									<th>Project Type</th>
									
									<th>Project Valueation</th>
									<th>Project Deadline</th>
									<th>Action</th>
								</tr>
								<tr class="warning no-result">
								  <td colspan="4"><i class="fa fa-warning"></i> No result</td>
								</tr>
							</thead>
							<tbody>';
							
							$count = count($all_project_data);
							if($count > 0)
							{
								$i = 1;
								foreach($all_project_data as $project_data)
								{

									//$date = view_date_format($list->task_date);    
									$ajax_view .= '<tr id="'.$project_data->project_id.'">
								
									<td>'.$i.'</td>
									<td>'.$project_data->project_name.'</td>
									<td>'.$project_data->project_total_manhour.'</td>
									<td>'.$project_data->project_valueation.'</td>
								    <td>'.$date = view_date_format($project_data->project_deadline).'</td>';
									 
									$base_url = base_url();
									
									$ajax_view .= '<td><a href="'.$base_url.'project/project_details/'.$project_data->project_id.'">View</a></td>
		
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
			
			$all_project_data = $this->Common_model->get_data('projects','',array('projects.project_created_at'=>'DESC'),array('start' => $page,'count' => $config['per_page']));
			
			$this->data['projects'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'projects','notification_status'=>0));
			
			if($this->data['projects'] > 0)
			{
				$update_notification = $this->Common_model->update('notifications',array('reference_name'=>'projects','user_id'=>$user_id),array('notification_status'=>'1'));
			
			$pagination_link = $this->pagination->create_links();
			
			
			
			$ajax_view = '<table class="table table-hover table-bordered results">
							<thead>
								<tr>
									<th>#</th>
									
									<th>Project Name</th>
									<th>Project Type</th>
									
									<th>Project Valueation</th>
									<th>Project Deadline</th>
									<th>Action</th>
								</tr>
								<tr class="warning no-result">
								  <td colspan="4"><i class="fa fa-warning"></i> No result</td>
								</tr>
							</thead>
							<tbody>';
							
							$count = count($all_project_data);
							if($count > 0)
							{
								$i = 1;
								foreach($all_project_data as $project_data)
								{

									//$date = view_date_format($list->task_date);    
									$ajax_view .= '<tr id="'.$project_data->project_id.'">
								
									<td>'.$i.'</td>
									<td>'.$project_data->project_name.'</td>
									<td>'.$project_data->project_total_manhour.'</td>
									<td>'.$project_data->project_valueation.'</td>
								    <td>'.$date = view_date_format($project_data->project_deadline).'</td>';
									 
									$base_url = base_url();
									
									$ajax_view .= '<td><a href="'.$base_url.'project/project_details/'.$project_data->project_id.'">View</a>&nbsp;|&nbsp;<a href="'.$base_url.'project/delete_project/'.$project_data->project_id.'">Delete</a></td>
		
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
	
	
	public function filter_project_list()
	{
		
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		
		$page =($this->uri->segment(3)) ? $this->uri->segment(3) : 0;		
		
		if($user_type_id == '1' || $user_type_id == '2' || $user_type_id == '4')
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
				
				$query .= " AND `project_created_at`>='$fromdt%' AND `project_created_at`<='$todt%'";
			
			}
			
			
			$project_id = $this->input->post('project_id');
			if( !empty($project_id))
			{
				$project_id = $this->input->post('project_id');
				$query .=" AND `project_id`=$project_id";
			}
			
			$last_query = "SELECT * FROM `projects` WHERE `project_status`>0".$query."  ORDER BY `project_created_at` DESC";
		//	echo $last_query; die;
			$query = $this->db->query($last_query);
			
			$this->data['all_project_data'] = $query->result_object($query);
			
			
			$this->load->view($this->filter_project_list, $this->data);

		}
		/*if($user_type_id == '2')
		{
			$this->pagination->initialize($config);
	
			$query = "SELECT * FROM `projects` JOIN `notifications` ON `notifications`.`reference_id` = `projects`.`project_id` WHERE `notifications`.`reference_name` = 'projects' AND `notifications`.`user_id` = $user_id GROUP BY `projects`.`project_id` ORDER BY `projects`.`project_created_at` DESC";
			
			$query = $this->db->query($query);
			$this->data['all_project_data'] = $query->result_object();
			
			//print_r($this->data['all_project_data']); die;
			
			$this->data['pagination_link'] = $this->pagination->create_links();				
		}*/
		if($user_type_id == '3')
		{
			
			$count = $this->Common_model->get_count('assigned_project', array('assigned_project.employee_id'=>$user_id)); 
			
			$config['total_rows'] = $count;
			
			$this->pagination->initialize($config);

			$this->data['all_project_data'] = $this->Common_model->get_data('projects', array('notifications.reference_name' => 'assigned_project', 'notifications.user_id' => $user_id, 'assigned_project.employee_id'=>$user_id),array('projects.project_created_at'=>'DESC'),array('start' => $page,'count' => $config['per_page']),'', array('assigned_project'=>'assigned_project.project_id =  projects.project_id', 'notifications'=>'notifications.reference_id = projects.project_id'),'','projects.project_id');
			
			
		//	$this->data['pagination_link'] = $this->pagination->create_links();	
		}
		
		//$this->load->view($this->project_list, $this->data);
	
	}
	
	
	
}
