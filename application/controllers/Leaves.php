<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Leaves extends CI_Controller {

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
				$this->notice = "superadmin/notice";
				$this->leave_management = "superadmin/leave_management";
				break;
				
			case "2":
				$this->add_project = "subadmin/add_project";
				$this->project_list = "subadmin/project_list";	
				$this->assign_project = "subadmin/assign_project";
				$this->project_details = "subadmin/project_details";
				$this->filter_project_list = "subadmin/filter_project_list";
				$this->notice = "subadmin/notice";
				$this->leave_management = "subadmin/leave_management";
				break;
				
			case "3":
				/*$this->add_task = "admin/add_task";
				$this->task_list = "admin/task_list";*/
				$this->project_list = "admin/project_list";
				$this->project_details = "admin/project_details";
				$this->notice = "admin/notice";
				$this->leave_management = "admin/leave_management";
				break;
				
			case "4":
				
				$this->project_list = "hradmin/project_list";
				$this->project_details = "hradmin/project_details";
				$this->filter_project_list = "hradmin/filter_project_list";
				$this->notice = "hradmin/notice";
				$this->leave_management = "hradmin/leave_management";
				
				
				//do_add_review_notice
				
				break;
				
			default:
				$page404 = "page404";
		}
		
		$this->data['user_details'] = get_user_details();
		
		
    }  

	
	/* ----Begining of Leaves Section---- */
	
	
	public function leave_management()
	{
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		
		if($user_type_id == 1 || $user_type_id == 4){
			$this->data['casual_leave'] = $this->Common_model->get_data('user_apply_leave',array('user_apply_leave.leave_type'=>'CL'),array('user_apply_leave.leave_id'=>'DESC'),'','',array('user_details'=>'user_details.user_id=user_apply_leave.user_id'));
			$this->data['paid_leave'] = $this->Common_model->get_data('user_apply_leave',array('user_apply_leave.leave_type'=>'PL'),array('user_apply_leave.leave_id'=>'DESC'),'','',array('user_details'=>'user_details.user_id=user_apply_leave.user_id'));
			$this->data['sick_leave'] = $this->Common_model->get_data('user_apply_leave',array('user_apply_leave.leave_type'=>'SL'),array('user_apply_leave.leave_id'=>'DESC'),'','',array('user_details'=>'user_details.user_id=user_apply_leave.user_id'));
			
			$this->data['employee_list'] = $this->Common_model->get_data('user_details',array('users.user_type'=>3),'','','',array('users'=>'users.user_id=user_details.user_id'));
			
			$this->data['leave_list'] = $this->Common_model->get_data('user_apply_leave',array('user_apply_leave.leave_status'=>1),'','','',array('user_details'=>'user_details.user_id=user_apply_leave.user_id'));
			//echo "<pre>"; print_r($data['leave_list']); //die;
			
			$this->data['casual_leaves'] = $this->Common_model->get_data('user_apply_leave',array('user_apply_leave.leave_type'=>'CL','user_id'=>$user_id),array('leave_id'=>'DESC'));
			$this->data['paid_leaves'] = $this->Common_model->get_data('user_apply_leave',array('user_apply_leave.leave_type'=>'PL','user_id'=>$user_id),array('leave_id'=>'DESC'));
			$this->data['sick_leaves'] = $this->Common_model->get_data('user_apply_leave',array('user_apply_leave.leave_type'=>'SL','user_id'=>$user_id),array('leave_id'=>'DESC'));
			
			$this->data['leave_taken'] = $this->Common_model->get_data('user_leave',array('user_id'=>$user_id));
			
			
			$this->load->view($this->leave_management, $this->data);
		}
		
		if($user_type_id == 3 || $user_type_id == 2){
			$this->data['casual_leave'] = $this->Common_model->get_data('user_apply_leave',array('user_apply_leave.leave_type'=>'CL','user_id'=>$user_id),array('leave_id'=>'DESC'));
			$this->data['paid_leave'] = $this->Common_model->get_data('user_apply_leave',array('user_apply_leave.leave_type'=>'PL','user_id'=>$user_id),array('leave_id'=>'DESC'));
			$this->data['sick_leave'] = $this->Common_model->get_data('user_apply_leave',array('user_apply_leave.leave_type'=>'SL','user_id'=>$user_id),array('leave_id'=>'DESC'));
			
			$this->data['leave_taken'] = $this->Common_model->get_data('user_leave',array('user_id'=>$user_id));
			
			$this->load->view($this->leave_management, $this->data);
		}
	
	}
	
	
	public function approve_leave()
	{
		$this->load->helper('url');
		
		$leave_id = $this->uri->segment(3);
		
		$last_query = "UPDATE `user_apply_leave` SET `leave_status` = 1 WHERE `leave_id` = '$leave_id'";
		$query = $this->db->query($last_query);
		
		$get_data = $this->Common_model->get_data('user_apply_leave',array('leave_id'=>$leave_id));
		
		$get_leave =  $this->Common_model->get_data('user_leave',array('user_id'=>$get_data[0]->user_id));
		
		$user = $get_data[0]->user_id;
		$total_cl = $get_leave[0]->used_cl;
		$total_pl = $get_leave[0]->used_pl;
		$total_sl = $get_leave[0]->used_sl;
		print_r( $get_leave);
		if($get_data[0]->leave_type == 'CL'){
			$total_cl = $get_data[0]->leave_total_days + $get_leave[0]->used_cl;
		}
		if($get_data[0]->leave_type == 'PL'){
			$total_pl = $get_data[0]->leave_total_days + $get_leave[0]->used_pl;
		}
		if($get_data[0]->leave_type == 'SL'){
			$total_sl = $get_data[0]->leave_total_days + $get_leave[0]->used_sl;
		}
		//echo $total = $get_data->user_id + $get_leave->used_id
		//echo $total ; die;
		
		$last_update = "INSERT INTO `user_leave` (`user_id`, `used_cl`, `used_pl`, `used_sl`) VALUES(".$user.", ".$total_cl.", ".$total_pl.", ".$total_sl.") ON DUPLICATE KEY UPDATE `used_cl`=".$total_cl.", `used_pl`=".$total_pl.", `used_sl`=".$total_sl;
		$query = $this->db->query($last_update);
		
		redirect('leaves/leave_management');
	}
	
	
	public function decline_leave()
	{
		$leave_id = $this->input->post('leave_id');
		
		$leave_msg = $this->input->post('decline_msg');
		
		$last_query = "UPDATE `user_apply_leave` SET `leave_status` = 2, `decline_note`= '$leave_msg' WHERE `leave_id` = '$leave_id'";
		
		$query = $this->db->query($last_query);
		
		redirect('leaves/leave_management');
	}
	
	
	
	public function do_apply_leave()
	{
		
		$user_id = $this->input->post('user_id');
		 
		$message = $this->input->post('message');
		$leave_type = $this->input->post('leave_type');
		//$s_date = $this->input->post('s_date');
		//$e_date = $this->input->post('e_date');
		
		$sdat = db_date_format($this->input->post('s_date'));
		$edat = db_date_format($this->input->post('e_date'));
		
		$date1 = date_create($sdat);
		$date2 = date_create($edat);
		$diff= date_diff($date1,$date2);
		$total_days = $diff->format("%a"); 
		
		
		if (empty($_FILES['userfile']['name'])) {

			$userfile = "";
			$leave_data['user_id'] = $user_id;
			$leave_data['leave_type'] = $leave_type;
			$leave_data['leave_description'] = $message;
			$leave_data['leave_attachment'] = $userfile;
			$leave_data['leave_added_date'] = date("Y-m-d");
			$leave_data['leave_start_date'] = $sdat;
			$leave_data['leave_end_date'] = $edat;
			$leave_data['leave_total_days'] = $total_days + 1;
			$leave_data['leave_status'] = 0;
			
		
			$insert_id = $this->Common_model->insert('user_apply_leave', $leave_data);
			if($insert_id){
				
				
				$sel_hradmin_arr = $this->Common_model->get_data('users',array('user_type'=>4));

				foreach($sel_hradmin_arr as $sel_hradmin)
				{
					
					$notification_data['reference_id'] = $insert_id;
					$notification_data['reference_name'] = 'leave';
					$notification_data['user_id'] = $sel_hradmin->user_id;
					$notification_data['leave_notification_status'] = '0';
					
					$this->Common_model->insert('leave_notifications', $notification_data);						
					
				}
				echo "Your Notice Published Successfully!";
			}
			else{
				echo "Could not be published due to some errors!";
			}			
		}
		else{
			$config['upload_path'] = './assets/upload/leaves/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png|docx|pdf';
			$new_name = time().$_FILES["userfile"]['name'];
			$config['file_name'] = $new_name;
			
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				echo "error to upload attachement!";
			}
			else
			{
				$filename= $this->upload->data();
				$userfile=$filename['file_name'];
				
				$leave_data['user_id'] = $user_id;
				$leave_data['leave_type'] = $leave_type;
				$leave_data['leave_description'] = $message;
				$leave_data['leave_attachment'] = $userfile;
				$leave_data['leave_added_date'] = date("Y-m-d");
				$leave_data['leave_start_date'] = $sdat;
				$leave_data['leave_end_date'] = $edat;
				$leave_data['leave_total_days'] = $total_days + 1;
				$leave_data['leave_status'] = 0;
			
				$insert_id = $this->Common_model->insert('user_apply_leave', $leave_data);
				if($insert_id){
					
					
					$sel_hradmin_arr = $this->Common_model->get_data('users',array('user_type'=>4));

					foreach($sel_hradmin_arr as $sel_hradmin)
					{
						
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = 'leave';
						$notification_data['user_id'] = $sel_hradmin->user_id;
						$notification_data['leave_notification_status'] = '0';
						
						$this->Common_model->insert('leave_notifications', $notification_data);						
						
					}
					echo "Your Notice Published Successfully!";
				}
				else{
					echo "Could not be published due to some errors!";
				}			
			}
		}
	}
	
	public function calender_leave(){
		
		$data['leave_list'] = $this->Common_model->get_data('user_apply_leave','','','','',array('user_details'=>'user_details.user_id=user_apply_leave.user_id'));
		
		
	}
	
	public function delete_leave()
	{
		$this->load->helper('url');
		
		$leave_id = $this->uri->segment(3);
		
		$del_leave = $this->Common_model->delete('user_apply_leave', array('leave_id' => $leave_id));
		//$del_notification = $this->Common_model->delete('notifications', array('reference_id'=>$task_id));
		
		$this->session->set_userdata('message', 'Leave Deleted Successfully!');
		
		redirect('leaves/leave_management');
	}
}
