<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$user_id = get_user_id(); 
		if($user_id)
		{
			redirect('dashboard');
		}
    }  
    
	public function index()
	{
		
			$this->load->view('login');
		
	}

	public function check_login()
	{
		//print_r($_POST);

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			redirect('login');
		}
		else
		{ 	
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			$userdata = array(
				'username' => $username,
				'password' => $password
				);
					
			$this->security->xss_clean($userdata);			
			
			$generate_password_string = generate_password_string($userdata['password']);
			
			$count = $this->Common_model->get_count('users', array('user_pass' => $generate_password_string, 'user_email'=>$userdata['username']));

			$data = $this->Common_model->get_data('users', array('user_pass' => $generate_password_string, 'user_email'=>$userdata['username']));
			
		
			
			//echo "<pre>"; print_r($data); die;
			$user_id = $data[0]->user_id;
			$user_type_id = $data[0]->user_type; 
			
			if($count > 0)
			{
				$time = microtime(true);
				$log_time = $this->session->set_userdata('log_time', $time);
				$user_id = $this->session->set_userdata('user_id', $user_id);
				$user_type_id = $this->session->set_userdata('user_type_id', $user_type_id);				
				redirect('dashboard');
			}
			else
			{
				redirect('login');
			}
			
			
		}

		//redirect('dashboard');
	}
	
	
	
	public function generate_new_password()
	{
		$this->generate_new_passwords();
	}
	
	private function generate_new_passwords()
	{
		$access_token = $this->uri->segment(3);
		$user_id = $this->uri->segment(4);
		$this->check_valid_user($user_id,$access_token);
		
	}	
	
	public function check_valid_user($id,$token)
	{
		$count = $this->Common_model->get_count('users',array('user_id' => $id,'access_token' => $token));
		$this->data['user_id'] = $id;
		if($count > 0)
		{
			$this->load->view('set_new_password', $this->data);
		}
		else
		{
			redirect('login/page_not_found');
		}
		
	}
	
	
	public function do_generate_new_password()
	{
		
		if($this->input->post())
		{
			$password = $this->input->post('password');
			$conf_password = $this->input->post('conf_password');
			$user_id = $this->input->post('user_id');
			$access_token = access_token();
			
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('conf_password', 'Confirm Password', 'required|matches[password]');
			
			if($this->form_validation->run() == FALSE)
			{
				
				$this->data['user_id'] = $this->input->post('user_id');
				$this->load->view('set_new_password', $this->data);
			}
			else
			{
				
				$this->security->xss_clean($password);		
				
				$this->data['user_pass'] = generate_password_string($password);
				$this->data['access_token'] = $access_token;
				$this->data['user_status'] = '1';
			
				$this->Common_model->update('users', array('user_id' => $user_id), $this->data);
				//$_SESSION['message'] = 'Your password has been set successfully, you can login now.';
				//$this->session->mark_as_flash('item');
				$this->session->set_userdata('message', 'Your password has been set successfully, you can login now.');
				redirect('login');
			}
			
		}
		
	}
	
	public function password_recovery()
	{
		$this->load->view('password_recovery');
	}
	
	public function check_email()
	{
		//print_r($_POST);

		$this->form_validation->set_rules('username', 'Username', 'required');
		
		if($this->form_validation->run() == FALSE)
		{
			redirect('login/password_recovery');
		}
		else
		{
			$username = $this->input->post('username');
			
			$this->security->xss_clean($username);			
			
			$count = $this->Common_model->get_count('users', array('user_email'=>$username));
			$data = $this->Common_model->get_data('users', array('user_email'=>$username));
			
			//echo "<pre>"; print_r($data); die;
			//$user_id = $data[0]->user_id;
			//$user_type_id = $data[0]->user_type; 
			
			if($count > 0)
			{
				$user_id = $data[0]->user_id;
				$access_token = $data[0]->access_token;
				
				$password_link = base_url()."login/generate_new_password/".$access_token."/".$user_id;
					
					/***************************Mail Function Start**************************************/
					
					$subject = "Project Tracking System - Set Password";
					$message = "Hello,\r\nThis is Your Account Recovery Link.\r\nClick the link below and set the new password for your account.\r\n";
					$message .= $password_link;
					
					$this->load->library('email');
					
					$this->email->from('admin@example.com', 'Confidant Media Pvt Ltd.');
					$this->email->to($this->input->post('username'));
					$this->email->cc('another@another-example.com');
					$this->email->bcc('cdchinmoy@gmail.com');

					$this->email->subject($subject);
					$this->email->message($message);

					$this->email->send();				
					/***************************Mail Function End**************************************/				
					
					//$this->session->mark_as_flash('message', 'Account Registerd Successfully!');
					$this->session->set_userdata('message', 'A password recovery link is sent to your email address. Please click the link to recover your Account password!');
					
					redirect('login/password_recovery');
			}
			else
			{
				$this->session->set_userdata('message', 'This e-mail is not valid! ');
					
				redirect('login/password_recovery');
			}
			
		}
	}
	
	public function page_not_found()
	{
		$this->data['message'] = "Page Not Found!";
		$this->load->view('page_not_found', $this->data);
	}
	
	
}
