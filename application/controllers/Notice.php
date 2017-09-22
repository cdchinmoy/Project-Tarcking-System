<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Notice extends CI_Controller {

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
				$this->ajax_general_notice = "superadmin/ajax_general_notice";
				
				break;
				
			case "2":
				$this->add_project = "subadmin/add_project";
				$this->project_list = "subadmin/project_list";	
				$this->assign_project = "subadmin/assign_project";
				$this->project_details = "subadmin/project_details";
				$this->filter_project_list = "subadmin/filter_project_list";
				$this->notice = "subadmin/notice";
				$this->ajax_general_notice = "subadmin/ajax_general_notice";
				
				break;
				
			case "3":
				/*$this->add_task = "admin/add_task";
				$this->task_list = "admin/task_list";*/
				$this->project_list = "admin/project_list";
				$this->project_details = "admin/project_details";
				$this->notice = "admin/notice";
				$this->ajax_general_notice = "admin/ajax_general_notice";
				
				break;
				
			case "4":
				
				$this->project_list = "hradmin/project_list";
				$this->project_details = "hradmin/project_details";
				$this->filter_project_list = "hradmin/filter_project_list";
				$this->notice = "hradmin/notice";
				$this->ajax_general_notice = "hradmin/ajax_general_notice";
				
				
				//do_add_review_notice
				
				break;
				
			default:
				$page404 = "page404";
		}
		
		$this->data['user_details'] = get_user_details();
		
		
    }  

	
	/* ----Begining of Notice Section---- */
	
	public function notice_board()
	{
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		
		if($user_type_id == 1 || $user_type_id == 2 || $user_type_id == 4){
			/*$this->data['general_notice'] = $this->Common_model->get_data('notices',array('notice_type'=>1),array('notice_id'=>'DESC'));
			$this->data['warning_notice'] = $this->Common_model->get_data('notices',array('notices.notice_type'=>2),array('notices.notice_id'=>'DESC'),'','',array('user_details'=>'user_details.user_id=notices.user_id'));
			$this->data['review_notice'] = $this->Common_model->get_data('notices',array('notices.notice_type'=>3),array('notices.notice_id'=>'DESC'),'','',array('user_details'=>'user_details.user_id=notices.user_id'));*/
			
			$query = "SELECT * FROM `notices` JOIN `notifications` ON `notifications`.`reference_id` = `notices`.`notice_id` WHERE `notifications`.`reference_name` = 'general' AND `notifications`.`user_id` = $user_id GROUP BY `notices`.`notice_id` ORDER BY `notices`.`notice_id` DESC";
			
			$query = $this->db->query($query);
			$this->data['general_notice'] = $query->result_object();
			
			$this->data['project_list'] = $this->Common_model->get_data('projects');
			
			$this->data['employee_list'] = $this->Common_model->get_data('user_details',array('users.user_type'=>3),'','','',array('users'=>'users.user_id=user_details.user_id'));
			
			
			$this->load->view($this->notice, $this->data);
		}
		
		if($user_type_id == 3){
			/*$this->data['general_notice'] = $this->Common_model->get_data('notices',array('notice_type'=>1),array('notice_id'=>'DESC'));
			$this->data['warning_notice'] = $this->Common_model->get_data('notices',array('notice_type'=>2,'user_id'=>$user_id),array('notices.notice_id'=>'DESC'));
			$this->data['review_notice'] = $this->Common_model->get_data('notices',array('notice_type'=>3,'user_id'=>$user_id),array('notices.notice_id'=>'DESC') );*/
			
			$query = "SELECT * FROM `notices` JOIN `notifications` ON `notifications`.`reference_id` = `notices`.`notice_id` WHERE `notifications`.`reference_name` = 'general' AND `notifications`.`user_id` = $user_id GROUP BY `notices`.`notice_id` ORDER BY `notices`.`notice_id` DESC";
			
			$query = $this->db->query($query);
			$this->data['general_notice'] = $query->result_object();
			
			$this->load->view($this->notice, $this->data);
		}
	
	}
	
	public function do_add_general_notice()
	{
		
		//$count = count($this->input->post('employee_id'));
		//$employee_arr = $this->input->post('employee_id');
		
		//echo "<pre>";print_r($employee_arr); die;
		
		
		$subject = $this->input->post('subject'); 
		$message = $this->input->post('message');
		$priority = $this->input->post('priority');
		
		$notice_type = $this->input->post('notice_type'); 
		
		if (empty($_FILES['userfile']['name'])) {
			//$insert_id_arr = array();
			//foreach($employee_arr as $employee)
			//{
		
			$usernotice = "";
			$notice_data['user_id'] = '0';
			$notice_data['notice_name'] = $subject;
			$notice_data['notice_message'] = $message;
			$notice_data['notice_date'] = date("Y-m-d");
			$notice_data['notice_type'] = $notice_type;
			$notice_data['notice_priority'] = $priority;
			$notice_data['notice_file'] = $usernotice;
		
			$insert_id = $this->Common_model->insert('notices', $notice_data);
			
			
			//array_push($insert_id_arr, $insert_id);
			//}
			
			if($insert_id){
				
				//$superadmin_id = get_superadmin_id();
				$user_id = get_user_id();
				
				$sel_user_arr = $this->Common_model->get_data('users');

				foreach($sel_user_arr as $sel_user)
				{
					if($sel_user->user_id == $user_id){
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = 'general';
						$notification_data['user_id'] = $sel_user->user_id;
						$notification_data['notification_status'] = '1';
						
						$this->Common_model->insert('notifications', $notification_data);
					}else{
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = 'general';
						$notification_data['user_id'] = $sel_user->user_id;
						$notification_data['notification_status'] = '0';
						
						$this->Common_model->insert('notifications', $notification_data);

					}
						
				}
				
				$dataz['msg'] = "Your Notice Published Successfully!";
			}
			else{
				$dataz['msg'] = "Could not be published due to some errors!";
			}			
		}
		else{
			$config['upload_path'] = './assets/upload/notices/';
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
				$usernotice=$filename['file_name'];
				
				$notice_data['user_id'] = 0;
				$notice_data['notice_name'] = $subject;
				$notice_data['notice_message'] = $message;
				$notice_data['notice_date'] = date("Y-m-d");
				$notice_data['notice_type'] = $notice_type;
				$notice_data['notice_priority'] = $priority;
				$notice_data['notice_file'] = $usernotice;
			
				$insert_id = $this->Common_model->insert('notices', $notice_data);
				if($insert_id){
					
					$user_id = get_user_id();
				
				$sel_user_arr = $this->Common_model->get_data('users');

				foreach($sel_user_arr as $sel_user)
				{
					if($sel_user->user_id == $user_id){
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = 'general';
						$notification_data['user_id'] = $sel_user->user_id;
						$notification_data['notification_status'] = '1';
						
						$this->Common_model->insert('notifications', $notification_data);
					}else{
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = 'general';
						$notification_data['user_id'] = $sel_user->user_id;
						$notification_data['notification_status'] = '0';
						
						$this->Common_model->insert('notifications', $notification_data);

					}
						
				}
					
					$dataz['msg'] = "Your Notice Published Successfully!";
				}
				else{
					$dataz['msg'] = "Could not be published due to some errors!";
				}			
			}
		}
	

		//$dataz['msg'] = "Your Notice Published Successfully!";

		$notice_data = $this->Common_model->get_data('notices',array('notice_type'=>'1'),array('notice_id'=>'DESC'));
		
		//$notice_data2 = json_encode($notice_data);
		$table_data = "";
		foreach($notice_data as $data)
		{
			$date = view_date_format($data->notice_date);
							
			if( $data->notice_priority==1){ $priroty = "Normal"; }
			if( $data->notice_priority==2){ $priroty = "Medium"; }
			if( $data->notice_priority==3){ $priroty = "High"; }
			
			$base_url = base_url()."notice/delete_notice/".$data->notice_id; 
			
			$table_data .= '<tr>
			<td width="520px">'.$data->notice_name.'</td>
			<td>'.$date.'</td>
			<td>'.$priroty.'</td>
			<td>
				<button name="general_view" id="general_view" data-name-id="'.$data->notice_name.'" data-msg-id="'.$data->notice_message.'" data-date-id="'.$date.'" data-file-id="'.$data->notice_file.'" data-type-id="General Notice" class="g_view btn btn-success" data-toggle="modal" data-target="#viewModal">View</button>
				<a href="'.$base_url.'"><button name="delete_general" id="delete_general" class="btn hidden-sm-down btn-danger">Delete</button></a>
			</td>
			</tr>';
		}
		
		$dataz['table_data'] = $table_data;
		echo json_encode($dataz); 
		
	
	}
	
	public function do_add_warning_notice()
	{
		
		$user_id = $this->input->post('warning_user_id');
		$subject = $this->input->post('warning_subject'); 
		$message = $this->input->post('warning_message');
		$priority = $this->input->post('warning_priority');
		$notice_type = $this->input->post('notice_type'); 
		// echo "<pre>"; print_r($_POST);
		if (empty($_FILES['userfile']['name'])) {

			$usernotice = "";
			$notice_data['user_id'] = $user_id;
			$notice_data['notice_name'] = $subject;
			$notice_data['notice_message'] = $message;
			$notice_data['notice_date'] = date("Y-m-d");
			$notice_data['notice_type'] = $notice_type;
			$notice_data['notice_priority'] = $priority;
			$notice_data['notice_file'] = $usernotice;
		
			$insert_id = $this->Common_model->insert('notices', $notice_data);
			if($insert_id){
				$dataz['msg'] = "Your Notice Published Successfully!";
			}
			else{
				$dataz['msg'] = "Could not be published due to some errors!";
			}			
		}
		else{

			$config['upload_path'] = './assets/upload/notices/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png|docx|pdf';
			$new_name = time().$_FILES['userfile']['name'];
			$config['file_name'] = $new_name;
			
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				echo "error to upload attachement!";
			}
			else
			{
				$filename= $this->upload->data();
				$usernotice=$filename['file_name'];
				
				$notice_data['user_id'] = $user_id;
				$notice_data['notice_name'] = $subject;
				$notice_data['notice_message'] = $message;
				$notice_data['notice_date'] = date("Y-m-d");
				$notice_data['notice_type'] = $notice_type;
				$notice_data['notice_priority'] = $priority;
				$notice_data['notice_file'] = $usernotice;
			
				//echo "<pre>";print_r($notice_data); die;
			
				$insert_id = $this->Common_model->insert('notices', $notice_data);
				if($insert_id){
					$dataz['msg'] = "Your Notice Published Successfully!";
				}
				else{
					$dataz['msg'] = "Could not be published due to some errors!";
				}			
			}
		}
		
		$notice_data = $this->Common_model->get_data('notices',array('notice_type'=>2),array('notices.notice_id'=>'DESC'),'','',array('user_details'=>'user_details.user_id=notices.user_id'));
		
		//$notice_data2 = json_encode($notice_data);
		$table_data = "";
		foreach($notice_data as $data)
		{
			$date = view_date_format($data->notice_date);
							
			if( $data->notice_priority==1){ $priroty = "Normal"; }
			if( $data->notice_priority==2){ $priroty = "Medium"; }
			if( $data->notice_priority==3){ $priroty = "High"; }
			
			$base_url = base_url()."notice/delete_notice/".$data->notice_id; 
			
			$table_data .= '<tr>
			<td width="520px">'.$data->notice_name.'</td>
			<td>'.$date.'</td>
			<td>'.$priroty.'</td>
			<td>
				<button name="warning_view" id="warning_view" data-name-id="'.$data->notice_name.'" data-msg-id="'.$data->notice_message.'" data-date-id="'.$date.'" data-file-id="'.$data->notice_file.'" data-type-id="Warning Notice" class="g_view btn btn-success" data-toggle="modal" data-target="#viewModal">View</button>
				<a href="'.$base_url.'"><button name="delete_warning" id="delete_warning" class="btn hidden-sm-down btn-danger">Delete</button></a>
			</td>
			</tr>';
		}
		
		$dataz['table_data'] = $table_data;
		echo json_encode($dataz);
	
	}
	
	public function do_add_review_notice()
	{
		
		$user_id = $this->input->post('review_user_id');
		$subject = $this->input->post('review_subject'); 
		$message = $this->input->post('review_message');
		$priority = $this->input->post('review_priority');
		//$notice_file = $this->input->post('notice_file');
		$notice_type = $this->input->post('notice_type'); 
		
		if (empty($_FILES['userfile']['name'])) {

			$usernotice = "";
			$notice_data['user_id'] = $user_id;
			$notice_data['notice_name'] = $subject;
			$notice_data['notice_message'] = $message;
			$notice_data['notice_date'] = date("Y-m-d");
			$notice_data['notice_type'] = $notice_type;
			$notice_data['notice_priority'] = $priority;
			$notice_data['notice_file'] = $usernotice;
		
			$insert_id = $this->Common_model->insert('notices', $notice_data);
			if($insert_id){
				$dataz['msg'] = "Your Notice Published Successfully!";
			}
			else{
				$dataz['msg'] = "Could not be published due to some errors!";
			}			
		}
		else{
			$config['upload_path'] = './assets/upload/notices/';
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
				$usernotice=$filename['file_name'];
				
				$notice_data['user_id'] = $user_id;
				$notice_data['notice_name'] = $subject;
				$notice_data['notice_message'] = $message;
				$notice_data['notice_date'] = date("Y-m-d");
				$notice_data['notice_type'] = $notice_type;
				$notice_data['notice_priority'] = $priority;
				$notice_data['notice_file'] = $usernotice;
			
				$insert_id = $this->Common_model->insert('notices', $notice_data);
				if($insert_id){
					$dataz['msg'] = "Your Notice Published Successfully!";
				}
				else{
					$dataz['msg'] = "Could not be published due to some errors!";
				}			
			}
		}
		
		$notice_data = $this->Common_model->get_data('notices',array('notice_type'=>3),array('notices.notice_id'=>'DESC'),'','',array('user_details'=>'user_details.user_id=notices.user_id'));
		
		//$notice_data2 = json_encode($notice_data);
		$table_data = "";
		foreach($notice_data as $data)
		{
			$date = view_date_format($data->notice_date);
							
			if( $data->notice_priority==1){ $priroty = "Normal"; }
			if( $data->notice_priority==2){ $priroty = "Medium"; }
			if( $data->notice_priority==3){ $priroty = "High"; }
			
			$base_url = base_url()."notice/delete_notice/".$data->notice_id; 
			
			$table_data .= '<tr>
			<td width="520px">'.$data->notice_name.'</td>
			<td>'.$date.'</td>
			<td>'.$priroty.'</td>
			<td>
				<button name="review_view" id="review_view" data-name-id="'.$data->notice_name.'" data-msg-id="'.$data->notice_message.'" data-date-id="'.$date.'" data-file-id="'.$data->notice_file.'" data-type-id="Review Notice" class="g_view btn btn-success" data-toggle="modal" data-target="#viewModal">View</button>
				<a href="'.$base_url.'"><button name="delete_review" id="delete_review" class="btn hidden-sm-down btn-danger">Delete</button></a>
			</td>
			</tr>';
		}
		
		$dataz['table_data'] = $table_data;
		echo json_encode($dataz); 
	
	}
	
	public function delete_notice()
	{
		$this->load->helper('url');
		
		$notice_id = $this->uri->segment(3);
		
		$del_notice = $this->Common_model->delete('notices', array('notice_id' => $notice_id));
		//$del_notification = $this->Common_model->delete('notifications', array('reference_id'=>$task_id));
		
		$this->session->set_userdata('message', 'Notice Deleted Successfully!');
		
		redirect('notice/notice_board');
	}
	
	
	function ajax_general_notice(){	
		
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();

		/*if($user_type_id == 4)
		{
			$general_notice = $this->Common_model->get_data('notices',array('notices.notice_type'=>1),array('notices.notice_id'=>'DESC'));
			
			$this->data['general'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'general','notification_status'=>0));
			
			if($this->data['general'] > 0)
			{
				$update_notification = $this->Common_model->update('notifications',array('reference_name'=>'general','user_id'=>$user_id),array('notification_status'=>'1'));
			
			$ajax_view = '<table class="table stylish-table">
							<thead>
								<tr>
									<th>Notice Name</th>
									<th>Date</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="general_notices_cont">';
							
							$count = count($general_notice);
							if($count > 0){
								foreach($general_notice as $general){

									//$date = view_date_format($list->task_date);    
									$ajax_view .= '<tr id="">
									<td width="520px">'.$general->notice_name.'</td>
									<td>'.$date = view_date_format($general->notice_date).'</td>';
									
									if( $general->notice_priority==1){$priority = 'Normal';}
									if( $general->notice_priority==2){$priority = 'Medium';}
									if( $general->notice_priority==3){$priority = 'High';}
									
									$ajax_view .= '<td>'.$priority.'</td>';
									 
									$base_url = base_url();
									
									$ajax_view .= '<td><button name="general_view" id="general_view" data-name-id="'.$general->notice_name.'" data-msg-id="'.$general->notice_message.'" data-date-id="'.$date.'" data-file-id="'.$general->notice_file.'" data-type-id="General Notice" class="g_view btn btn-success" data-toggle="modal" data-target="#viewModal">View</button>
										<a href="'.$base_url().'notice/delete_notice/'.$general->notice_id.'"><button name="delete_general" id="delete_general" class="btn hidden-sm-down btn-danger">Delete</button></a></td>
									</tr>';							 
								} 
		
							}
							else
							{ 
								$ajax_view .=  '<tr><td colspan="9">No Record Found!</td></tr>'; 
							} 
						
						
							$ajax_view .= '</tbody>
							</table>';
							
					echo $ajax_view;	
			}
		else{
				echo "0";
			}

		}
		
		
		if($user_type_id == 3)
		{
			$general_notice = $this->Common_model->get_data('notices',array('notices.notice_type'=>1),array('notices.notice_id'=>'DESC'));
			
			$this->data['general'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'general','notification_status'=>0));
			
			if($this->data['general'] > 0)
			{
				$update_notification = $this->Common_model->update('notifications',array('reference_name'=>'general','user_id'=>$user_id),array('notification_status'=>'1'));
			
			$ajax_view = '<table class="table stylish-table">
							<thead>
								<tr>
									<th>Notice Name</th>
									<th>Date</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="general_notices_cont">';
							
							$count = count($general_notice);
							if($count > 0){
								foreach($general_notice as $general){

									//$date = view_date_format($list->task_date);    
									$ajax_view .= '<tr id="">
									<td width="520px">'.$general->notice_name.'</td>
									<td>'.$date = view_date_format($general->notice_date).'</td>';
									
									if( $general->notice_priority==1){$priority = 'Normal';}
									if( $general->notice_priority==2){$priority = 'Medium';}
									if( $general->notice_priority==3){$priority = 'High';}
									
									$ajax_view .= '<td>'.$priority.'</td>';
									 
									$base_url = base_url();
									
									$ajax_view .= '<td><button name="general_view" id="general_view" data-name-id="'.$general->notice_name.'" data-msg-id="'.$general->notice_message.'" data-date-id="'.$date.'" data-file-id="'.$general->notice_file.'" data-type-id="General Notice" class="g_view btn btn-success" data-toggle="modal" data-target="#viewModal">View</button>
										</td>
									</tr>';							 
								} 
		
							}
							else
							{ 
								$ajax_view .=  '<tr><td colspan="9">No Record Found!</td></tr>'; 
							} 
						
						
							$ajax_view .= '</tbody>
							</table>';
							
					echo $ajax_view;	
			}
		else{
				echo "0";
			}

		}
		
		
		
		
		
		
		if($user_type_id == 2)
		{
			
			$general_notice = $this->Common_model->get_data('notices',array('notices.notice_type'=>1),array('notices.notice_id'=>'DESC'));
			
			$this->data['general'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'general','notification_status'=>0));
			
			if($this->data['general'] > 0)
			{
				$update_notification = $this->Common_model->update('notifications',array('reference_name'=>'general','user_id'=>$user_id),array('notification_status'=>'1'));
			
			//$pagination_link = $this->pagination->create_links();
			
			
			
			$ajax_view = '<table class="table stylish-table">
							<thead>
								<tr>
									<th>Notice Name</th>
									<th>Date</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="general_notices_cont">';
							
							$count = count($general_notice);
							if($count > 0){
								foreach($general_notice as $general){

									//$date = view_date_format($list->task_date);    
									$ajax_view .= '<tr id="">
									<td width="520px">'.$general->notice_name.'</td>
									<td>'.$date = view_date_format($general->notice_date).'</td>';
									
									if( $general->notice_priority==1){$priority = 'Normal';}
									if( $general->notice_priority==2){$priority = 'Medium';}
									if( $general->notice_priority==3){$priority = 'High';}
									
									$ajax_view .= '<td>'.$priority.'</td>';
									 
									$base_url = base_url();
									
									$ajax_view .= '<td><button name="general_view" id="general_view" data-name-id="'.$general->notice_name.'" data-msg-id="'.$general->notice_message.'" data-date-id="'.$date.'" data-file-id="'.$general->notice_file.'" data-type-id="General Notice" class="g_view btn btn-success" data-toggle="modal" data-target="#viewModal">View</button>
										<a href="'.$base_url().'notice/delete_notice/'.$general->notice_id.'"><button name="delete_general" id="delete_general" class="btn hidden-sm-down btn-danger">Delete</button></a></td>
		
									</tr>';							 
								} 
		
							}
							else
							{ 
								$ajax_view .=  '<tr><td colspan="9">No Record Found!</td></tr>'; 
							} 
						
						
							$ajax_view .= '</tbody>
							</table>';
							
					echo $ajax_view;	
			}
		else{
				echo "0";
			}
		

		}


		if($user_type_id == 1)
		{
		
			$general_notice = $this->Common_model->get_data('notices',array('notices.notice_type'=>1),array('notices.notice_id'=>'DESC'));
			
			$this->data['general'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id, 'reference_name'=>'general','notification_status'=>0));
			
			if($this->data['general'] > 0)
			{
				$update_notification = $this->Common_model->update('notifications',array('reference_name'=>'general','user_id'=>$user_id),array('notification_status'=>'1'));
			
			//$pagination_link = $this->pagination->create_links();
			
			
			
			$ajax_view = '<table class="table stylish-table">
							<thead>
								<tr>
									<th>Notice Name</th>
									<th>Date</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="general_notices_cont">';
							
							$count = count($general_notice);
							if($count > 0){
								foreach($general_notice as $general){

									//$date = view_date_format($list->task_date);    
									$ajax_view .= '<tr id="">
									<td width="520px">'.$general->notice_name.'</td>
									<td>'.$date = view_date_format($general->notice_date).'</td>';
									
									if( $general->notice_priority==1){$priority = 'Normal';}
									if( $general->notice_priority==2){$priority = 'Medium';}
									if( $general->notice_priority==3){$priority = 'High';}
									
									$ajax_view .= '<td>'.$priority.'</td>';
									 
									$base_url = base_url();
									
									$ajax_view .= '<td><button name="general_view" id="general_view" data-name-id="'.$general->notice_name.'" data-msg-id="'.$general->notice_message.'" data-date-id="'.$date.'" data-file-id="'.$general->notice_file.'" data-type-id="General Notice" class="g_view btn btn-success" data-toggle="modal" data-target="#viewModal">View</button>
										<a href="'.$base_url().'notice/delete_notice/'.$general->notice_id.'"><button name="delete_general" id="delete_general" class="btn hidden-sm-down btn-danger">Delete</button></a></td>
		
									</tr>';							 
								} 
		
							}
							else
							{ 
								$ajax_view .=  '<tr><td colspan="9">No Record Found!</td></tr>'; 
							} 
						
						
							$ajax_view .= '</tbody>
							</table>';
							
					echo $ajax_view;	
			}
		else{
				echo "0";
			}
		}*/
		
		$this->load->helper('url');
		
		$notice_id = $this->uri->segment(3);
		
		//if($user_type_id == 4)
		//{
			//$general_notice = $this->Common_model->get_data('notices',array('notices.notice_type'=>1),array('notices.notice_id'=>'DESC'));
			
			$this->data['general'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id,'reference_id'=>$notice_id, 'reference_name'=>'general','notification_status'=>0));
			
			if($this->data['general'] > 0)
			{
				$update_notification = $this->Common_model->update('notifications',array('reference_name'=>'general','user_id'=>$user_id,'reference_id'=>$notice_id),array('notification_status'=>'1'));
				
				//redirect('document/documents');
			}
			redirect('notice/notice_board');
	}
	
	public function ajax_get_employee()
	{

		$project_id = $this->input->post('project_id');
			
		if($project_id == '1'){
			$employee_ids = $this->Common_model->get_data('assigned_project');
		}
		else{
			$employee_ids = $this->Common_model->get_data('assigned_project', array('project_id'=>$project_id));
		}
	
		
		
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
					$ajax_view .= '<option value="'.$list->user_id.'" selected>'.$list->name.'</option>';
				}
			}
		}
		
		echo $ajax_view; //die;
		
	}
	
}
