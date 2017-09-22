<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public $dashboard;
	public $user_details;
	public $user_type_id;
	public $log_time;
	
	public function __construct()
    {
		
        parent::__construct();
		
		$this->load->model('Common_model');
		
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
	
		if(!isset($user_id))
		{
			redirect('login');
		}

		switch ($user_type_id) 
		{
			case "1":
				$this->dashboard = "superadmin/dashboard";
				$this->profile = "superadmin/profile";
				$this->employee_list = "superadmin/employee_list";
				$this->add_employee = "superadmin/add_employee";
				$this->add_project = "superadmin/add_project";
				$this->project_list = "superadmin/project_list";
				$this->add_task = "superadmin/add_task";
				$this->task_list = "superadmin/task_list";
				$this->search_result = "superadmin/search_result";
				$this->change_password = "superadmin/change_password";
								
				
				break;
				
			case "2":
				$this->dashboard = "subadmin/dashboard";
				$this->profile = "subadmin/profile";
				$this->employee_list = "subadmin/employee_list";
				$this->add_employee = "subadmin/add_employee";
				$this->add_project = "subdmin/add_project";
				$this->project_list = "subadmin/project_list";	
				$this->add_task = "subadmin/add_task";
				$this->task_list = "subadmin/task_list";
				$this->search_result = "subadmin/search_result";
				$this->change_password = "subadmin/change_password";	
				
				break;
				
			case "3":
				$this->dashboard = "admin/dashboard";
				$this->profile = "admin/profile";
				$this->employee_list = "admin/employee_list";
				$this->add_employee = "admin/add_employee";
				$this->add_project = "admin/add_project";
				$this->project_list = "admin/project_list";	
				$this->add_task = "admin/add_task";
				$this->task_list = "admin/task_list";
				$this->search_result = "admin/search_result";
				$this->change_password = "admin/change_password";	
				
				break;
				
			case "4":
				$this->dashboard = "hradmin/dashboard";
				$this->profile = "hradmin/profile";
				$this->employee_list = "hradmin/employee_list";
				$this->add_employee = "hradmin/add_employee";
				$this->add_project = "hradmin/add_project";
				$this->project_list = "hradmin/project_list";	
				$this->add_task = "hradmin/add_task";
				$this->task_list = "hradmin/task_list";
				$this->search_result = "hradmin/search_result";
				$this->change_password = "hradmin/change_password";	
				
				break;
				
			default:
				$page404 = "page404";
		}
		
		$this->data['user_details'] = get_user_details();
		
		
    }  

	public function index()
	{
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		$superadmin_id = get_superadmin_id();
		if($user_type_id==1){
			$this->data['task'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'task','notification_status'=>0));
			
			$this->data['projects'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'projects','notification_status'=>0));
			
			$this->data['general'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'general','notification_status'=>0));
			
			$this->data['warning'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'warning','notification_status'=>0));
			
			$this->data['review'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'review','notification_status'=>0));
			
			$this->data['payslip'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'payslip','notification_status'=>0));
			
			//print_r($this->data['projects']); die;
			$current_date = date('Y-m-d');
			$before_current_date = date('Y-m-d', strtotime('-30 days'));
			//$this->data['project_list'] = $this->Common_model->get_data('projects',array());
			//$last_query = "SELECT * FROM `projects` WHERE `project_created_at`>='$before_current_date' AND `project_created_at`<='$current_date' ORDER BY `project_id` DESC";
			$last_query = "SELECT * FROM `projects` ORDER BY `project_id` DESC LIMIT 6";
			//echo $last_query; die;
			$query = $this->db->query($last_query);
			
			$this->data['project_list'] = $query->result_object($query);
			
			$this->data['task_list'] = $this->Common_model->get_data('task',array('task.task_date'=>$current_date),array('task.task_id'=>'DESC'),'','', array('projects' =>'projects.project_id = task.project_id','user_details' => 'user_details.user_id = task.user_id'));
		}
		if($user_type_id==2){
			$this->data['task'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'task','notification_status'=>0));
			
			$this->data['projects'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'projects','notification_status'=>0));
			
			$this->data['general'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'general','notification_status'=>0));
			
			$this->data['warning'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'warning','notification_status'=>0));
			
			$this->data['review'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'review','notification_status'=>0));
			
			$this->data['payslip'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'payslip','notification_status'=>0));
			
			$current_date = date('Y-m-d');
			$before_current_date = date('Y-m-d h:i:s', strtotime('-5 days'));
			//$this->data['project_list'] = $this->Common_model->get_data('projects',array());
			//$last_query = "SELECT * FROM `projects` WHERE `project_created_at`>='$before_current_date' AND `project_created_at`<='$current_date' ORDER BY `project_id` DESC";
			$last_query = "SELECT * FROM `projects` ORDER BY `project_id` DESC LIMIT 6";
			//echo $last_query; die;
			$query = $this->db->query($last_query);
			
			$this->data['project_list'] = $query->result_object($query);
			//print_r($this->data['projects']); die;
			
			$this->data['task_list'] = $this->Common_model->get_data('task',array('task.task_date'=>$current_date),array('task.task_id'=>'DESC'),'','', array('projects' =>'projects.project_id = task.project_id','user_details' => 'user_details.user_id = task.user_id'));
			
		}
		if($user_type_id==3){
			//$this->data['task'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'task','notification_status'=>0));
			
			$this->data['projects'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'assigned_project','notification_status'=>0));
			
			$this->data['general'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'general','notification_status'=>0));
			
			$this->data['warning'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'warning','notification_status'=>0));
			
			$this->data['review'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'review','notification_status'=>0));
			
			$this->data['payslip'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'payslip','notification_status'=>0));
			//print_r($this->data['projects']); die;
			
			//$this->task_time_calender();
			$this->data['task_calender'] = $this->Common_model->get_data('task',array('user_id'=>$user_id));
		}
		
		if($user_type_id==4){
			$this->data['task'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'task','notification_status'=>0));
			
			$this->data['projects'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'projects','notification_status'=>0));
			
			$this->data['general'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'general','notification_status'=>0));
			
			$this->data['warning'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'warning','notification_status'=>0));
			
			$this->data['review'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'review','notification_status'=>0));
			
			$this->data['payslip'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'payslip','notification_status'=>0));
			
			$current_date = date('Y-m-d');
			$before_current_date = date('Y-m-d h:i:s', strtotime('-5 days'));
			//$this->data['project_list'] = $this->Common_model->get_data('projects',array());
			//$last_query = "SELECT * FROM `projects` WHERE `project_created_at`>='$before_current_date' AND `project_created_at`<='$current_date' ORDER BY `project_id` DESC";
			$last_query = "SELECT * FROM `projects` ORDER BY `project_id` DESC LIMIT 6";
			//echo $last_query; die;
			$query = $this->db->query($last_query);
			
			$this->data['project_list'] = $query->result_object($query);
			//print_r($this->data['projects']); die;
			
			$this->data['task_list'] = $this->Common_model->get_data('task',array('task.task_date'=>$current_date),array('task.task_id'=>'DESC'),'','', array('projects' =>'projects.project_id = task.project_id','user_details' => 'user_details.user_id = task.user_id'));
			
			
			$this->data['leave_list'] = $this->Common_model->get_data('user_apply_leave',array('user_apply_leave.leave_status'=>1),'','','',array('user_details'=>'user_details.user_id=user_apply_leave.user_id'));
		
		}
		$this->load->view($this->dashboard, $this->data);
	}
	
	public function profile()
	{
		$this->load->view($this->profile, $this->data);
	}	
	
	public function employee_list()
	{
		$this->data['all_user_data'] = $this->Common_model->get_data('users','','','','', array('user_details'=>'user_details.user_id = users.user_id'));
		
		$this->load->view($this->employee_list, $this->data);
	}		
	
	public function add_employee()
	{
		$this->load->view($this->add_employee, $this->data);
	
	}	
	
	public function do_add_employee()
	{
		$this->form_validation->set_rules('full_name', 'Name', 'required');
		$this->form_validation->set_rules('user_type', 'User type', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view($this->add_employee, $this->data);
		}
		else
		{	
	
			$flag = is_email_new($this->input->post('email'));
			if($flag == TRUE)
			{
				$access_token = access_token();
				$pass = generate_password_string($access_token);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				
				$userdata = array(
				'access_token' => $access_token,
				'user_pass' => $pass,
				'user_type' => $this->input->post('user_type'),
				'user_email' => $this->input->post('email'),
				'user_ip' => $ip_address
				);

				$this->security->xss_clean($userdata);			
				//echo "<pre>"; print_r($userdata);	die;
				$insert_id = $this->Common_model->insert('users', $userdata);
				if($insert_id)
				{
					
					$userdetailsdata = array(
					'user_id' => $insert_id,
					'employee_id' => $this->input->post('employee_id'),
					'name' => $this->input->post('full_name'),
					/*'user_email' => $this->input->post('email'),
					'phone_no' => $this->input->post('phone_no'),
					'address' => $this->input->post('user_type'),
					'user_iamge' => $this->input->post('user_iamge'),*/
					);					
					$this->security->xss_clean($userdetailsdata);	
					
					$user_details_id = $this->Common_model->insert('user_details', $userdetailsdata);
					
					$password_link = base_url()."login/generate_new_password/".$access_token."/".$insert_id;
					
					/***************************Mail Function Start**************************************/
					
					$subject = "Project Tracking System - Set Password";
					$message = "<h1>Your Account has been created successfully.</h1> <p>Click the link below and set the password for you account.</p>";
					$message .= $password_link;
					
					$this->load->library('email');
					
					$this->email->from('admin@example.com', 'Confidant Media Pvt Ltd.');
					$this->email->to($this->input->post('email'));
					$this->email->cc('another@another-example.com');
					$this->email->bcc('cdchinmoy@gmail.com');

					$this->email->subject($subject);
					$this->email->message($message);

					$this->email->send();				
					/***************************Mail Function End**************************************/				
					$_SESSION['message'] = 'Account Registerd Successfully!';
					$this->session->set_flashdata('item', $_SESSION['message']);
					redirect($this->employee_list);
				}
				else
				{
					echo "Database insert error!"; die;
				}
			
			
			}
			else
			{
				$_SESSION['message'] = 'Email id already with us!';
				$this->session->set_flashdata('item',$_SESSION['message']);
				$this->load->view($this->add_employee, $this->data);			
			}
			
		}	

	}
	
	
	public function change_password(){
		$this->data['user_id'] = get_user_id();
		$this->load->view($this->change_password, $this->data);
	}
	
	public function do_change_password(){
		
		$this->form_validation->set_rules('current_password', 'Current Password', 'required');
		$this->form_validation->set_rules('new_password', 'New Password', 'required');
		$this->form_validation->set_rules('confirm_password', 'Confirm New Password', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata('message', 'One/many of your password field is/are empty!');
			redirect('dashboard/change_password');
		}
		else
		{
			$userid = $this->input->post('userid');
			$current_password= $this->input->post('current_password');
			$new_password= $this->input->post('new_password');
			$confirm_password= $this->input->post('confirm_password');
			
			$user = $this->Common_model->get_data('users',array('user_id'=>$userid));
			//echo $user[0]->user_pass;
			 $current_pass = generate_password_string($current_password);
			
			if(($user[0]->user_pass) === $current_pass){
				if($new_password === $confirm_password){
					
					$new_pass = generate_password_string($new_password);
					
					$data = array(
					'user_pass' => $new_pass
					);
				
					$this->Common_model->update('users', array('user_id' => $userid), $data);
					
					$this->session->set_userdata('message', 'Password Updated Successfully!');
					redirect('dashboard/profile');
				}
				$this->session->set_userdata('message', 'New Password does not matches to Confirm New Password!');
				redirect('dashboard/change_password');
			}
			$this->session->set_userdata('message', 'you have typed wrong Current Password!');
			redirect('dashboard/change_password');
		}
		
	}
	
	public function logout()
	{
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_type_id');
		
		$this->session->sess_destroy();
		redirect('login');
	}
	
	public function do_update(){
		$this->form_validation->set_rules('example-name', 'Full Name', 'required');
		$this->form_validation->set_rules('example-email', 'Email', 'required');
		$this->form_validation->set_rules('example-phone', 'Phone No', 'required');
		$this->form_validation->set_rules('example-id', 'Employee Id', 'required');
		$this->form_validation->set_rules('address', 'Employee Address', 'required');
		
		if($this->form_validation->run() === FALSE){
			$this->load->view($this->profile, $this->data);
		}
		else{
			$userid = $this->input->post('userid');
			$username= $this->input->post('example-name');
			$useremail= $this->input->post('example-email');
			$userphone= $this->input->post('example-phone');
			$empid= $this->input->post('example-id');
			$address= $this->input->post('address');
			
			$config['upload_path']          = './assets/upload/profile_image/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
			$new_name = time().$_FILES["userfile"]['name'];
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
			
			
			
			if ( ! $this->upload->do_upload())
			{
				$user= $this->Common_model->get_data('user_details', array('user_id'=> $userid));
				
				if(empty($user[0]->user_iamge)){
					
					$error = array('error' => $this->upload->display_errors());

					$this->load->view($this->profile, $this->data);
				}
				
				$data = array(
				'employee_id' => $empid,
				'name' => $username,
				'phone_no' => $userphone,
				'address' => $address
				);
				
				$this->Common_model->update('user_details', array('user_id' => $userid), $data);
				
				redirect('dashboard/profile');
					
			}
            else
			{
				$filename= $this->upload->data();
				$userpics=$filename['file_name'];
				//$access_token = access_token();
				//$userpic=$access_token.$userpics;
				$data = array(
				'employee_id' => $empid,
				'name' => $username,
				'phone_no' => $userphone,
				'address' => $address,
				'user_iamge' => $userpics
				);
				
				$this->Common_model->update('user_details', array('user_id' => $userid), $data);
				//$this->load->view($this->profile, $this->data);
				redirect('dashboard/profile');
				//profile();
			}
		}
	}
	
	public function search_result(){
		
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		$superadmin_id = get_superadmin_id();
		
		if($user_type_id == 1)
		{
			
			$query = "";
			$keys = $this->input->post('keys');
			if($keys && $keys!="")
			{
				/*//if (preg_match("/".$keys."/i", "PHP is the web scripting language of choice.")) {
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
				
				$query .= " AND `task`.`task_date`>='$fromdt' AND `task`.`task_date`<='$todt'";*/
				$this->data['keyword'] = $keys;
				
				$project_query = "SELECT * FROM `projects` WHERE `project_id` LIKE '%$keys%' OR `project_name` LIKE '%$keys%' OR `project_description` LIKE '%$keys%' OR `project_valueation` LIKE '%$keys%' OR `project_deadline` LIKE '%$keys%'";
				
				$query = $this->db->query($project_query);
				$this->data['project_list'] = $query->result_object($query);
				
				
				$employee_query = "SELECT * FROM `users` INNER JOIN `user_details` ON `user_details`.`user_id`=`users`.`user_id` INNER JOIN `department` ON `department`.`department_id`=`user_details`.`department_id` WHERE `user_details`.`name` LIKE '%$keys%' OR `user_details`.`employee_id` LIKE '%$keys%' OR `user_details`.`address` LIKE '%$keys%' OR `department`.`department_name` LIKE '%$keys%' OR `users`.`user_email` LIKE '%$keys%'";
				
				$query = $this->db->query($employee_query);
				$this->data['employee_list'] = $query->result_object($query);
				
				
				
				$task_query = "SELECT * FROM `task` INNER JOIN `projects` ON `projects`.`project_id`=`task`.`project_id` INNER JOIN `user_details` ON `user_details`.`user_id`=`task`.`user_id` WHERE `task`.`project_id` LIKE '%$keys%' OR `projects`.`project_name` LIKE '%$keys%' OR `user_details`.`name` LIKE '%$keys%' OR `task`.`task_name` LIKE '%$keys%' OR `task`.`task_description` LIKE '%$keys%' OR `task`.`task_date` LIKE '%$keys%' GROUP BY `task`.`task_name`";
				
				$query = $this->db->query($task_query);
				$this->data['task_list'] = $query->result_object($query);
				
				$this->load->view($this->search_result, $this->data);
				
			}
			else
			{
				redirect('dashboard');
			}
			
		}
		
		if($user_type_id == 2)
		{
			
			$query = "";
			$keys = $this->input->post('keys');
			if($keys && $keys!="")
			{
				$this->data['keyword'] = $keys;
				
				$project_query = "SELECT * FROM `projects` WHERE `project_id` LIKE '%$keys%' OR `project_name` LIKE '%$keys%' OR `project_description` LIKE '%$keys%' OR `project_valueation` LIKE '%$keys%' OR `project_deadline` LIKE '%$keys%'";
				
				$query = $this->db->query($project_query);
				$this->data['project_list'] = $query->result_object($query);
				
				
				$employee_query = "SELECT * FROM `users` INNER JOIN `user_details` ON `user_details`.`user_id`=`users`.`user_id` INNER JOIN `department` ON `department`.`department_id`=`user_details`.`department_id` WHERE (`user_details`.`user_id`!=$superadmin_id) AND (`user_details`.`name` LIKE '%$keys%' OR `user_details`.`employee_id` LIKE '%$keys%' OR `user_details`.`address` LIKE '%$keys%' OR `department`.`department_name` LIKE '%$keys%' OR `users`.`user_email` LIKE '%$keys%')";
				
				$query = $this->db->query($employee_query);
				$this->data['employee_list'] = $query->result_object($query);
				
				
				
				$task_query = "SELECT * FROM `task` INNER JOIN `projects` ON `projects`.`project_id`=`task`.`project_id` INNER JOIN `user_details` ON `user_details`.`user_id`=`task`.`user_id` WHERE (`task`.`user_id`=$user_id) AND (`task`.`project_id` LIKE '%$keys%' OR `projects`.`project_name` LIKE '%$keys%' OR `user_details`.`name` LIKE '%$keys%' OR `task`.`task_name` LIKE '%$keys%' OR `task`.`task_description` LIKE '%$keys%' OR `task`.`task_date` LIKE '%$keys%') GROUP BY `task`.`task_name`";
				
				$query = $this->db->query($task_query);
				$this->data['task_list'] = $query->result_object($query);
				
				$this->load->view($this->search_result, $this->data);
				
			}
			else
			{
				redirect('dashboard');
			}
			
		}
		
		
		if($user_type_id == 3)
		{
			
			$query = "";
			$keys = $this->input->post('keys');
			if($keys && $keys!="")
			{
				$this->data['keyword'] = $keys;
				
				$project_query = "SELECT * FROM `projects` INNER JOIN `assigned_project` ON `assigned_project`.`project_id`=`projects`.`project_id` WHERE (`assigned_project`.`employee_id`=$user_id) AND (`projects`.`project_id` LIKE '%$keys%' OR `projects`.`project_name` LIKE '%$keys%' OR `projects`.`project_description` LIKE '%$keys%' OR `projects`.`project_valueation` LIKE '%$keys%' OR `projects`.`project_deadline` LIKE '%$keys%')";
				
				$query = $this->db->query($project_query);
				$this->data['project_list'] = $query->result_object($query);
				
				$task_query = "SELECT * FROM `task` INNER JOIN `projects` ON `projects`.`project_id`=`task`.`project_id` INNER JOIN `user_details` ON `user_details`.`user_id`=`task`.`user_id` WHERE (`task`.`user_id`=$user_id) AND (`task`.`project_id` LIKE '%$keys%' OR `projects`.`project_name` LIKE '%$keys%' OR `user_details`.`name` LIKE '%$keys%' OR `task`.`task_name` LIKE '%$keys%' OR `task`.`task_description` LIKE '%$keys%' OR `task`.`task_date` LIKE '%$keys%') GROUP BY `task`.`task_name`";
				
				$query = $this->db->query($task_query);
				$this->data['task_list'] = $query->result_object($query);
				
				$this->load->view($this->search_result, $this->data);
				
			}
			else
			{
				redirect('dashboard');
			}
			
		}
		
	}
	
	
	public function ajax_count_list()
	{
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		$superadmin_id = get_superadmin_id();
		
		if($user_type_id==1){
			$task = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'task','notification_status'=>0));
			
			$projects = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'projects','notification_status'=>0, 'notification_status'=>2));
			
			if($task > 0 ){
				
				$ajax_task = '<center><a href="task/task_list" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$task.'</div></a></center>' ;
			}else{
				$ajax_task = 0;
			}
			
			if($projects > 0 ){
				
				$ajax_project = '<center><a href="project/project_list" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$projects.'</div></a></center>' ;
			}else{
				$ajax_project = 0;
			}
			
			$general = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'general','notification_status'=>0));
			if($general > 0 ){
				
				$ajax_general = '<center><a href="notice/notice_board" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$general.'</div></a></center>' ;
			}else{
				$ajax_general = 0;
			}
			
			$warning = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'warning','notification_status'=>0));
			if($warning > 0 ){
				
				$ajax_warning = '<center><a href="document/documents" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$warning.'</div></a></center>' ;
			}else{
				$ajax_warning = 0;
			}
			
			$review = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'review','notification_status'=>0));
			if($review > 0 ){
				
				$ajax_review = '<center><a href="document/documents" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$review.'</div></a></center>' ;
			}else{
				$ajax_review = 0;
			}
			
			$payslip = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'payslip','notification_status'=>0));
			if($payslip > 0 ){
				
				$ajax_payslip = '<center><a href="document/documents" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$payslip.'</div></a></center>' ;
			}else{
				$ajax_payslip = 0;
			}
			
			$ajax_notification = $task + $projects + $general + $warning + $review + $payslip;
			
			$ajax_notification_array = array($ajax_notification, $ajax_task, $ajax_project, $ajax_general, $ajax_warning, $ajax_review, $ajax_payslip);
			echo json_encode($ajax_notification_array);
		}
		
		if($user_type_id==2){
			$task = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'task','notification_status'=>0));
			
			if($task > 0 ){
				
				$ajax_task = '<center><a href="task/task_list" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$task.'</div></a></center>' ;
			}else{
				$ajax_task = 0;
			}
			
			$projects = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'projects','notification_status'=>0, 'notification_status'=>2));
			
			if($projects > 0 ){
				
				$ajax_project = '<center><a href="project/project_list" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$projects.'</div></a></center>' ;
			}else{
				$ajax_project = 0;
			}
			
			$general = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'general','notification_status'=>0));
			
			if($general > 0 ){
				
				$ajax_general = '<center><a href="notice/notice_board" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$general.'</div></a></center>' ;
			}else{
				$ajax_general = 0;
			}
			
			$warning = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'warning','notification_status'=>0));
			if($warning > 0 ){
				
				$ajax_warning = '<center><a href="document/documents" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$warning.'</div></a></center>' ;
			}else{
				$ajax_warning = 0;
			}
			
			$review = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'review','notification_status'=>0));
			if($review > 0 ){
				
				$ajax_review = '<center><a href="document/documents" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$review.'</div></a></center>' ;
			}else{
				$ajax_review = 0;
			}
			
			$payslip = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'payslip','notification_status'=>0));
			if($payslip > 0 ){
				
				$ajax_payslip = '<center><a href="document/documents" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$payslip.'</div></a></center>' ;
			}else{
				$ajax_payslip = 0;
			}
			
			$ajax_notification =  $task + $projects + $general + $warning + $review + $payslip;
			
			$ajax_notification_array = array($ajax_notification, $ajax_task, $ajax_project, $ajax_general, $ajax_warning, $ajax_review, $ajax_payslip);
			echo json_encode($ajax_notification_array);
		}
		
		if($user_type_id==3){
			
			$projects = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'assigned_project','notification_status'=>0));
			
			if($projects > 0 ){
				
				$ajax_project = '<center><a href="project/project_list" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$projects.'</div></a></center>' ;
			}else{
				$ajax_project = 0;
			}
			
			$general = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'general','notification_status'=>0));
			if($general > 0 ){
				
				$ajax_general = '<center><a href="notice/notice_board" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$general.'</div></a></center>' ;
			}else{
				$ajax_general = 0;
			}
			
			$warning = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'warning','notification_status'=>0));
			if($warning > 0 ){
				
				$ajax_warning = '<center><a href="document/documents" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$warning.'</div></a></center>' ;
			}else{
				$ajax_warning = 0;
			}
			
			$review = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'review','notification_status'=>0));
			if($review > 0 ){
				
				$ajax_review = '<center><a href="document/documents" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$review.'</div></a></center>' ;
			}else{
				$ajax_review = 0;
			}
			
			$payslip = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'payslip','notification_status'=>0));
			if($payslip > 0 ){
				
				$ajax_payslip = '<center><a href="document/documents" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$payslip.'</div></a></center>' ;
			}else{
				$ajax_payslip = 0;
			}
			
			$ajax_notification = $projects + $general + $warning + $review + $payslip;
			
			$ajax_notification_array = array($ajax_notification, $ajax_project, $ajax_general, $ajax_warning, $ajax_review, $ajax_payslip );
			echo json_encode($ajax_notification_array);
		}
		
		if($user_type_id==4){
			$task = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'task','notification_status'=>0));
			
			if($task > 0 ){
				
				$ajax_task = '<center><a href="task/task_list" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$task.'</div></a></center>' ;
			}else{
				$ajax_task = 0;
			}
			
			$projects = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'projects','notification_status'=>0));
			
			if($projects > 0 ){
				
				$ajax_project = '<center><a href="project/project_list" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$projects.'</div></a></center>' ;
			}else{
				$ajax_project = 0;
			}
			
			$general = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'general','notification_status'=>0));
			if($general > 0 ){
				
				$ajax_general = '<center><a href="notice/notice_board" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$general.'</div></a></center>' ;
			}else{
				$ajax_general = 0;
			}
			
			$warning = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'warning','notification_status'=>0));
			if($warning > 0 ){
				
				$ajax_warning = '<center><a href="document/documents" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$warning.'</div></a></center>' ;
			}else{
				$ajax_warning = 0;
			}
			
			$review = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'review','notification_status'=>0));
			if($review > 0 ){
				
				$ajax_review = '<center><a href="document/documents" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$review.'</div></a></center>' ;
			}else{
				$ajax_review = 0;
			}
			
			$payslip = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'payslip','notification_status'=>0));
			if($payslip > 0 ){
				
				$ajax_payslip = '<center><a href="document/documents" style="text-decoration:none;"><div align="center" style="background-color:green; height:60px ; width:60px; alignment-adjust:middle; border-radius:30px; color:#FFF; font-size:24px; font-weight:bolder; margin-top:30px; margin-bottom:30px; line-height:60px; text-shadow:5px 5px 10px #000;">'.$payslip.'</div></a></center>' ;
			}else{
				$ajax_payslip = 0;
			}
			
			$ajax_notification =  $general + $warning + $review + $payslip;
			
			$ajax_notification_array = array($ajax_notification, $ajax_general, $ajax_warning, $ajax_review, $ajax_payslip);
			echo json_encode($ajax_notification_array);
		}
		
	}
	
	public function elapsed_time(){
		// microtime(true) returns the unix timestamp plus milliseconds as a float
		$starttime = get_log_time();
		/* do stuff here */
		$endtime = microtime(true);
		$timediff = $endtime - $starttime;
	
		$h = floor($timediff / 3600);
		$timediff -= $h * 3600;
		$m = floor($timediff / 60);
		$timediff -= $m * 60;
		
		echo $ajax_time = $h.' : '.sprintf('%02d', $m).' : '.sprintf('%02d', $timediff);
	}
	
	private function task_time_calender()
	{
		//$this->session->unset_userdata('filter_employee_id');
		
		$user_id = get_user_id();
		//$user_type_id = get_user_type_id();
		
			$this->data['task_calender'] = $this->Common_model->get_data('task',array('user_id'=>$user_id));
			//$this->data['employee_list'] = $this->Common_model->get_data('users','','','','',array('user_details'=>'user_details.user_id=users.user_id'));
			
			
	}
	
}
