<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public $dashboard;
	public $user_details;
	
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
				
				break;
				
			case "2":
				$this->dashboard = "subadmin/dashboard";
				$this->profile = "subadmin/profile";
				$this->employee_list = "subadmin/employee_list";
				$this->add_employee = "subadmin/add_employee";
				$this->add_project = "superadmin/add_project";
				$this->project_list = "superadmin/project_list";	
				$this->add_task = "superadmin/add_task";
				$this->task_list = "superadmin/task_list";	
				
				break;
				
			case "3":
				$this->dashboard = "admin/dashboard";
				$this->profile = "admin/profile";
				$this->employee_list = "admin/employee_list";
				$this->add_employee = "admin/add_employee";
				$this->add_project = "superadmin/add_project";
				$this->project_list = "superadmin/project_list";	
				$this->add_task = "superadmin/add_task";
				$this->task_list = "superadmin/task_list";	
				
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
				
				break;
				
			default:
				$page404 = "page404";
		}
		
		$this->data['user_details'] = get_user_details();
		
		
    }  

	public function index()
	{
			
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
	
	
	public function project_list()
	{
		$this->load->view($this->project_list, $this->data);
	}
	public function add_project()
	{
		$this->load->view($this->add_project, $this->data);
	}	
	
	public function task_list()
	{
		$this->load->view($this->task_list, $this->data);
	}
	public function add_task()
	{
		$this->load->view($this->add_task, $this->data);
	}	
	
	
	public function logout()
	{
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_type_id');
		
		$this->session->sess_destroy();
		redirect('login');
	}
	
	
}
