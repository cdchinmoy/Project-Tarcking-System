<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

	public $dashboard;
	public $user_details;
	
	public function __construct()
    {
		
        parent::__construct();
		
		$this->load->model('Common_model');
		$this->load->library('pagination');
		//$this->load->library('fusioncharts');
		
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
				$this->view_employee = "superadmin/view_employee";
				$this->update_employee = "superadmin/update_employee";
				$this->do_update_salary = "superadmin/do_update_salary";
				
				break;
				
			case "2":
				$this->dashboard = "subadmin/dashboard";
				$this->profile = "subadmin/profile";
				$this->employee_list = "subadmin/employee_list";
				/*$this->add_employee = "subadmin/add_employee";*/
				$this->add_project = "subadmin/add_project";
				$this->project_list = "subadmin/project_list";	
				$this->add_task = "subadmin/add_task";
				$this->task_list = "subadmin/task_list";	
				$this->view_employee = "subadmin/view_employee";
				break;
				
			case "3":
				$this->dashboard = "admin/dashboard";
				$this->profile = "admin/profile";
				/*$this->employee_list = "admin/employee_list";
				$this->add_employee = "admin/add_employee";
				$this->add_project = "admin/add_project";*/
				$this->project_list = "admin/project_list";	
				$this->add_task = "admin/add_task";
				$this->task_list = "admin/task_list";	
				
				break;
				
			case "4":
				$this->dashboard = "hradmin/dashboard";
				$this->profile = "hradmin/profile";
				$this->employee_list = "hradmin/employee_list";
				/*$this->add_employee = "hradmin/add_employee";*/
				$this->add_project = "hradmin/add_project";
				$this->project_list = "hradmin/project_list";	
				$this->add_task = "hradmin/add_task";
				$this->task_list = "hradmin/task_list";	
				$this->view_employee = "hradmin/view_employee";
				break;
				
			default:
				$page404 = "page404";
		}
		
		$this->data['user_details'] = get_user_details();
		
		
    }  


	public function employee_list()
	{
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		$count = $this->Common_model->get_count('users'); 

		$config['base_url'] = base_url().'employee/employee_list';
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
		
		if($user_type_id == 1){
			
			$count = $this->Common_model->get_count('users'); 
			$config['total_rows'] = $count;
			
			$this->pagination->initialize($config);
			
			
			$this->data['all_user_data'] = $this->Common_model->get_data('users','',array('user_details.user_id'=>'DESC'),array('start' => $page,'count' => $config['per_page']),'', array('user_details'=>'user_details.user_id = users.user_id'));
			
			$this->data['pagination_link'] = $this->pagination->create_links();
			$this->load->view($this->employee_list, $this->data);
		}
		
		if($user_type_id == 2){
			
			$query_c = "SELECT * FROM `users` INNER JOIN `user_details` ON `users`.`user_id` = `user_details`.`user_id` WHERE (`users`.`user_type`=2 OR `users`.`user_type`=3) AND `users`.`user_id`!=$user_id";

			$query_c = $this->db->query($query_c); 
			
			$count = $query_c->num_rows(); 
		
			$config['total_rows'] = $count;
			$this->pagination->initialize($config);
			
			$query_s = "SELECT * FROM `users` INNER JOIN `user_details` ON `users`.`user_id` = `user_details`.`user_id` WHERE (`users`.`user_type`=2 OR `users`.`user_type`=3) AND `users`.`user_id`!=$user_id ORDER BY `user_details`.`user_id` DESC LIMIT  $page, ".$config['per_page'];

			$query_s = $this->db->query($query_s); 
			
			$this->data['all_user_data'] = $query_s->result_object();
			
			$this->data['pagination_link'] = $this->pagination->create_links();
			$this->load->view($this->employee_list, $this->data);
		}
		
		if($user_type_id == 4){
			
			$query_c = "SELECT * FROM `users` INNER JOIN `user_details` ON `users`.`user_id` = `user_details`.`user_id` WHERE (`users`.`user_type`=2 OR `users`.`user_type`=3) AND `users`.`user_id`!=$user_id";

			$query_c = $this->db->query($query_c); 
			
			$count = $query_c->num_rows(); 
		
			$config['total_rows'] = $count;
			$this->pagination->initialize($config);
			
			$query_s = "SELECT * FROM `users` INNER JOIN `user_details` ON `users`.`user_id` = `user_details`.`user_id` WHERE (`users`.`user_type`=2 OR `users`.`user_type`=3) AND `users`.`user_id`!=$user_id ORDER BY `user_details`.`user_id` DESC LIMIT  $page, ".$config['per_page'];

			$query_s = $this->db->query($query_s); 
			
			$this->data['all_user_data'] = $query_s->result_object();
			
			$this->data['pagination_link'] = $this->pagination->create_links();
			$this->load->view($this->employee_list, $this->data);
		}
		
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
					$join_date = db_date_format($this->input->post('joining_date'));
					
					$userdetailsdata = array(
					'user_id' => $insert_id,
					'employee_id' => $this->input->post('employee_id'),
					'name' => $this->input->post('full_name'),
					'employee_designation' => $this->input->post('employee_designation'),
					'phone_no' => $this->input->post('phone_no'),
					'department_id' => $this->input->post('department'),
					'employee_salary'=> $this->input->post('salary'),
					'joining_date' => $join_date,
					/*'user_email' => $this->input->post('email'),
					'phone_no' => $this->input->post('phone_no'),
					'address' => $this->input->post('user_type'),
					'user_iamge' => $this->input->post('user_iamge'),*/
					);					
					$this->security->xss_clean($userdetailsdata);	
					
					$user_details_id = $this->Common_model->insert('user_details', $userdetailsdata);
					
					
					$userleavedata = array(
					'user_id' => $insert_id,
					'used_cl' => 0,
					'used_pl' => 0,
					'used_sl' => 0
					);
					$user_leave_id = $this->Common_model->insert('user_leave', $userleavedata);
					
					$yr = date('Y');
					$current_date = date('Y-m-d');
					
					$salary_data = array(
					'user_id' => $insert_id,
					'salary_amount'=> $this->input->post('salary'),
					'salary_year' => $yr,
					'salary_raise' => 0,
					'salary_raise_percent' => 0,
					'salary_added_date' => $current_date
					);
					
					$salary_id = $this->Common_model->insert('user_salary', $salary_data);
					
					
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
					
					//$this->session->mark_as_flash('message', 'Account Registerd Successfully!');
					$this->session->set_userdata('message', 'Account Registerd Successfully!');
					
					redirect('employee/employee_list');
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
	
	
	public function update_employee()
	{
		$user_id = $this->uri->segment(3);
		
		$this->data['emp_details'] = $this->Common_model->get_data('user_details', array('user_details.user_id' => $user_id),array('user_salary.salary_id'=>'DESC'),'','', array('users' => 'user_details.user_id = users.user_id','user_salary'=>'user_salary.user_id = users.user_id'));
		
		$this->load->view($this->update_employee, $this->data);
	
	}	
	
	public function do_update_employee()
	{

		$this->form_validation->set_rules('full_name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view($this->update_employee, $this->data);
		}
		else
		{	
	
			$user_id = $this->input->post('user_id');
			
			$userdata = array();
			if(!$this->input->post('user_type') == 2 && $this->input->post('user_type') == 3)
			{
				$userdata = array(
				'user_type' => $this->input->post('user_type'),
				'user_email' => $this->input->post('email'),
				);				
			}
			else
			{
				$userdata = array(
				'user_email' => $this->input->post('email') 
				);					
			}

			$this->security->xss_clean($userdata);			
			//echo "<pre>"; print_r($userdata);	die;
			$this->Common_model->update('users',array('user_id' => $user_id) ,$userdata);
			
			$joining_date = db_date_format($this->input->post('joining_date'));
			$userdetailsdata = array(
			'employee_id' => $this->input->post('employee_id'),
			'name' => $this->input->post('full_name'),
			'employee_designation' => $this->input->post('employee_designation'),
			'phone_no' => $this->input->post('phone_no'),
			'department_id' => $this->input->post('department'),
			//'employee_salary'=> $this->input->post('salary'),
			'joining_date'=> $joining_date
			);					
			$this->security->xss_clean($userdetailsdata);	
			
			$user_details_id = $this->Common_model->update('user_details',array('user_id' => $user_id) ,$userdetailsdata);
			
			$this->session->set_userdata('message', 'Account Updated Successfully!');
			
			redirect('employee/employee_list');


			
		}	

	}	
	
	public function ajax_get_sal(){
		
		//$user_id = get_user_id();
		//$user_type_id = get_user_type_id();
		$salary_id = $this->input->post('salary_id');
		
		$query = "SELECT * FROM `user_salary` WHERE `salary_id` = $salary_id";
		//echo $query; die;
		$query = $this->db->query($query);
		$salary_data = $query->result_object();
		
		$sal_raise = $salary_data[0]->salary_raise;
		//echo $sal_raise;die;
		$sal_percent = $salary_data[0]->salary_raise_percent;
		//echo $sal_percent;die;
		//$ajax_data =  $task + $projects + $general + $warning + $review + $payslip;
			
		$ajax_data_array = array($sal_raise, $sal_percent);
		echo json_encode($ajax_data_array);
	}
	
	public function do_update_salary(){
		$this->form_validation->set_rules('salary', 'Current Salary', 'required');
		$this->form_validation->set_rules('salary_percent', 'Increment', 'required');
		$this->form_validation->set_rules('salary_amount', 'Amount', 'required');
		$this->form_validation->set_rules('salary_new', 'Increment', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view($this->update_employee, $this->data);
		}
		else
		{	
	
			$user_id = $this->input->post('user_id');
			$salary_id = $this->input->post('salary_id');
			
			$update_type = $this->input->post('update_type');
			
			if($update_type == "inc"){
			
				$userdetailsdata = array(
				
				'employee_salary'=> $this->input->post('salary_new')
				
				);					
				$this->security->xss_clean($userdetailsdata);	
				
				$user_details_id = $this->Common_model->update('user_details',array('user_id' => $user_id) ,$userdetailsdata);
			
				$yr = date('Y');
				$current_date = date('Y-m-d');
				
				$salary_data = array(
				'user_id' => $user_id,
				'salary_amount'=> $this->input->post('salary_new'),
				'salary_year' => $yr,
				'salary_raise' => $this->input->post('salary_amount'),
				'salary_raise_percent' => $this->input->post('salary_percent'),
				'salary_added_date' => $current_date
				);
				
				$salary_id = $this->Common_model->insert('user_salary', $salary_data);
				
				$this->session->set_userdata('message', 'Account Updated Successfully!');
			
				redirect('employee/employee_list');

			}
			
			if($update_type == "upd"){
			
				$userdetailsdata = array(
				'employee_salary'=> $this->input->post('salary_new')
				
				);					
				$this->security->xss_clean($userdetailsdata);	
				
				$user_details_id = $this->Common_model->update('user_details',array('user_id' => $user_id) ,$userdetailsdata);
			
				$yr = date('Y');
				$current_date = date('Y-m-d');
				
				$salary_data = array(
				'user_id' => $user_id,
				'salary_amount'=> $this->input->post('salary_new'),
				'salary_year' => $yr,
				'salary_raise' => $this->input->post('salary_amount'),
				'salary_raise_percent' => $this->input->post('salary_percent'),
				'salary_added_date' => $current_date
				);
				
				$salary_id = $this->Common_model->update('user_salary' ,array('salary_id' => $salary_id), $salary_data);
				
				$this->session->set_userdata('message', 'Account Updated Successfully!');
			
				redirect('employee/employee_list');

			}
			
			
		}
	}
	
	public function view_employee()
	{

		$userid = $this->uri->segment(3);
		$this->data['emp_details'] = $this->Common_model->get_data('user_details', array('user_details.user_id' => $userid),'','','', array('users' => 'user_details.user_id = users.user_id'));
		$this->data['general_notice'] = $this->Common_model->get_data('notices',array('notice_type'=>1),array('notice_id'=>'DESC'));
		$this->data['warning_notice'] = $this->Common_model->get_data('notices',array('notice_type'=>2,'user_id'=>$userid),array('notices.notice_id'=>'DESC'));
		$this->data['review_notice'] = $this->Common_model->get_data('notices',array('notice_type'=>3,'user_id'=>$userid),array('notices.notice_id'=>'DESC') );
		
		$this->data['task_calender'] = $this->Common_model->get_data('task',array('user_id'=>$userid));
		
		$this->data['salary_result'] = $this->Common_model->get_data('user_salary',array('user_id'=>$userid));
		

		$this->load->view($this->view_employee, $this->data);
	}
	
	
	
    
	public function delete_employee()
	{

		$userid = $this->uri->segment(3);
		$del_usr = $this->Common_model->delete('users', array('user_id' => $userid));
		$del_usr_det = $this->Common_model->delete('user_details', array('user_id' => $userid));
		$del_assigned = $this->Common_model->delete('assigned_project', array('employee_id' => $userid));
		$del_task = $this->Common_model->delete('task', array('user_id' => $userid));

		$this->session->set_userdata('message', 'Employee Deleted Successfully!');
		
		redirect('employee/employee_list');
	}
	
	
}
