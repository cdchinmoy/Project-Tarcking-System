<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {

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
				$this->documents = "superadmin/documents";
				$this->do_add_document = "superadmin/do_add_document";
				$this->do_add_warning_notice = "superadmin/do_add_warning_notice";
				$this->do_add_review_notice = "superadmin/do_add_review_notice";
				$this->delete_notice = "superadmin/delete_notice";
				$this->ajax_warning_notice = "superadmin/ajax_warning_notice";
				$this->ajax_review_notice = "superadmin/ajax_review_notice";
				$this->ajax_payslip = "superadmin/ajax_payslip";
				break;
				
			case "2":
				$this->add_project = "subadmin/add_project";
				$this->project_list = "subadmin/project_list";	
				$this->assign_project = "subadmin/assign_project";
				$this->project_details = "subadmin/project_details";
				$this->filter_project_list = "subadmin/filter_project_list";
				$this->notice = "subadmin/notice";
				$this->leave_management = "subadmin/leave_management";
				$this->documents = "subadmin/documents";
				$this->do_add_document = "subadmin/do_add_document";
				$this->do_add_warning_notice = "subadmin/do_add_warning_notice";
				$this->do_add_review_notice = "subadmin/do_add_review_notice";
				$this->delete_notice = "subadmin/delete_notice";
				$this->ajax_warning_notice = "subadmin/ajax_warning_notice";
				$this->ajax_review_notice = "subadmin/ajax_review_notice";
				$this->ajax_payslip = "subadmin/ajax_payslip";
				break;
				
			case "3":
				/*$this->add_task = "admin/add_task";
				$this->task_list = "admin/task_list";*/
				$this->project_list = "admin/project_list";
				$this->project_details = "admin/project_details";
				$this->notice = "admin/notice";
				$this->leave_management = "admin/leave_management";
				$this->documents = "admin/documents";
				$this->do_add_document = "admin/do_add_document";
				$this->delete_notice = "admin/delete_notice";
				$this->ajax_warning_notice = "admin/ajax_warning_notice";
				$this->ajax_review_notice = "admin/ajax_review_notice";
				$this->ajax_payslip = "admin/ajax_payslip";
				break;
				
			case "4":
				
				//$this->project_list = "hradmin/project_list";
				//$this->project_details = "hradmin/project_details";
				//$this->filter_project_list = "hradmin/filter_project_list";
				//$this->notice = "hradmin/notice";
				//$this->leave_management = "hradmin/leave_management";
				$this->documents = "hradmin/documents";
				$this->do_add_document = "hradmin/do_add_document";
				$this->do_add_warning_notice = "hradmin/do_add_warning_notice";
				$this->do_add_review_notice = "hradmin/do_add_review_notice";
				$this->delete_notice = "hradmin/delete_notice";
				$this->ajax_warning_notice = "hradmin/ajax_warning_notice";
				$this->ajax_review_notice = "hradmin/ajax_review_notice";
				$this->ajax_payslip = "hradmin/ajax_payslip";
				
				break;
				
			default:
				$page404 = "page404";
		}
		
		$this->data['user_details'] = get_user_details();
		
		
    }  

	
	/* ----Begining of Document Section---- */
	
	
	public function documents()
	{
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		
		if($user_type_id == 1 || $user_type_id == 4){
			//$this->data['pay_slip'] = $this->Common_model->get_data('documents',array('documents.document_type'=>1),array('documents.document_id'=>'DESC'),'','',array('user_details'=>'user_details.user_id=documents.user_id'));
			//$this->data['appointment_letter'] = $this->Common_model->get_data('documents',array('documents.document_type'=>2),array('documents.document_id'=>'DESC'),'','',array('user_details'=>'user_details.user_id=documents.user_id'));
			//$this->data['offer_letter'] = $this->Common_model->get_data('documents',array('documents.document_type'=>3),array('documents.document_id'=>'DESC'),'','',array('user_details'=>'user_details.user_id=documents.user_id'));
			
			$slip_query = "SELECT * FROM `documents` JOIN `notifications` ON `notifications`.`reference_id` = `documents`.`document_id` JOIN `user_details` ON `user_details`.`user_id` = `documents`.`user_id` WHERE `notifications`.`reference_name` = 'payslip' AND `notifications`.`user_id` = $user_id GROUP BY `documents`.`document_id` ORDER BY `documents`.`document_id` DESC";
			
			$slip_query = $this->db->query($slip_query);
			$this->data['pay_slip'] = $slip_query->result_object();
			
			$appointment_query = "SELECT * FROM `documents` JOIN `notifications` ON `notifications`.`reference_id` = `documents`.`document_id` JOIN `user_details` ON `user_details`.`user_id` = `documents`.`user_id` WHERE `notifications`.`reference_name` = 'appointment' AND `notifications`.`user_id` = $user_id GROUP BY `documents`.`document_id` ORDER BY `documents`.`document_id` DESC";
			
			$appointment_query = $this->db->query($appointment_query);
			$this->data['appointment_letter'] = $appointment_query->result_object();
			
			$offer_query = "SELECT * FROM `documents` JOIN `notifications` ON `notifications`.`reference_id` = `documents`.`document_id` JOIN `user_details` ON `user_details`.`user_id` = `documents`.`user_id` WHERE `notifications`.`reference_name` = 'offerletter' AND `notifications`.`user_id` = $user_id GROUP BY `documents`.`document_id` ORDER BY `documents`.`document_id` DESC";
			
			$offer_query = $this->db->query($offer_query);
			$this->data['offer_letter'] = $offer_query->result_object();
			
			//$this->data['warning_notice'] = $this->Common_model->get_data('notices',array('notices.notice_type'=>2),array('notices.notice_id'=>'DESC'),'','',array('user_details'=>'user_details.user_id=notices.user_id'));
			//$this->data['review_notice'] = $this->Common_model->get_data('notices',array('notices.notice_type'=>3),array('notices.notice_id'=>'DESC'),'','',array('user_details'=>'user_details.user_id=notices.user_id'));
			$query = "SELECT * FROM `notices` JOIN `notifications` ON `notifications`.`reference_id` = `notices`.`notice_id` JOIN `user_details` ON `user_details`.`user_id` = `notices`.`user_id` WHERE `notifications`.`reference_name` = 'warning' AND `notifications`.`user_id` = $user_id GROUP BY `notices`.`notice_id` ORDER BY `notices`.`notice_id` DESC";
			
			$query = $this->db->query($query);
			$this->data['warning_notice'] = $query->result_object();
			
			$querys = "SELECT * FROM `notices` JOIN `notifications` ON `notifications`.`reference_id` = `notices`.`notice_id` JOIN `user_details` ON `user_details`.`user_id` = `notices`.`user_id` WHERE `notifications`.`reference_name` = 'review' AND `notifications`.`user_id` = $user_id GROUP BY `notices`.`notice_id` ORDER BY `notices`.`notice_id` DESC";
			
			$querys = $this->db->query($querys);
			$this->data['review_notice'] = $querys->result_object();
			
			$this->data['employee_list'] = $this->Common_model->get_data('user_details','','','','',array('users'=>'users.user_id=user_details.user_id'));
			$this->data['user_list'] = $this->Common_model->get_data('user_details',array('users.user_type'=>3),'','','',array('users'=>'users.user_id=user_details.user_id'));
			//$this->data['leave_list'] = $this->Common_model->get_data('user_apply_leave',array('user_apply_leave.leave_status'=>1),'','','',array('user_details'=>'user_details.user_id=user_apply_leave.user_id'));
			//echo "<pre>"; print_r($data['leave_list']); //die;
			
			$this->load->view($this->documents, $this->data);
		}
		
		if($user_type_id == 3){
			//$this->data['pay_slip'] = $this->Common_model->get_data('documents',array('documents.document_type'=>1,'user_id'=>$user_id),array('document_id'=>'DESC'));
			//$this->data['appointment_letter'] = $this->Common_model->get_data('documents',array('documents.document_type'=>2,'user_id'=>$user_id),array('document_id'=>'DESC'));
			//$this->data['offer_letter'] = $this->Common_model->get_data('documents',array('documents.document_type'=>3,'user_id'=>$user_id),array('document_id'=>'DESC'));
			
			$slip_query = "SELECT * FROM `documents` JOIN `notifications` ON `notifications`.`reference_id` = `documents`.`document_id` WHERE `notifications`.`reference_name` = 'payslip' AND `notifications`.`user_id` = $user_id GROUP BY `documents`.`document_id` ORDER BY `documents`.`document_id` DESC";
			
			$slip_query = $this->db->query($slip_query);
			$this->data['pay_slip'] = $slip_query->result_object();
			
			$appointment_query = "SELECT * FROM `documents` JOIN `notifications` ON `notifications`.`reference_id` = `documents`.`document_id` WHERE `notifications`.`reference_name` = 'appointment' AND `notifications`.`user_id` = $user_id GROUP BY `documents`.`document_id` ORDER BY `documents`.`document_id` DESC";
			
			$appointment_query = $this->db->query($appointment_query);
			$this->data['appointment_letter'] = $appointment_query->result_object();
			
			$offer_query = "SELECT * FROM `documents` JOIN `notifications` ON `notifications`.`reference_id` = `documents`.`document_id` WHERE `notifications`.`reference_name` = 'offerletter' AND `notifications`.`user_id` = $user_id GROUP BY `documents`.`document_id` ORDER BY `documents`.`document_id` DESC";
			
			$offer_query = $this->db->query($offer_query);
			$this->data['offer_letter'] = $offer_query->result_object();
			
			//$this->data['warning_notice'] = $this->Common_model->get_data('notices',array('notice_type'=>2,'user_id'=>$user_id),array('notices.notice_id'=>'DESC'));
			//$this->data['review_notice'] = $this->Common_model->get_data('notices',array('notice_type'=>3,'user_id'=>$user_id),array('notices.notice_id'=>'DESC') );
			$query = "SELECT * FROM `notices` JOIN `notifications` ON `notifications`.`reference_id` = `notices`.`notice_id` WHERE `notifications`.`reference_name` = 'warning' AND `notifications`.`user_id` = $user_id GROUP BY `notices`.`notice_id` ORDER BY `notices`.`notice_id` DESC";
			
			$query = $this->db->query($query);
			$this->data['warning_notice'] = $query->result_object();
			
			$querys = "SELECT * FROM `notices` JOIN `notifications` ON `notifications`.`reference_id` = `notices`.`notice_id` WHERE `notifications`.`reference_name` = 'review' AND `notifications`.`user_id` = $user_id GROUP BY `notices`.`notice_id` ORDER BY `notices`.`notice_id` DESC";
			
			$querys = $this->db->query($querys);
			$this->data['review_notice'] = $querys->result_object();
			
			//$this->data['leave_taken'] = $this->Common_model->get_data('user_leave',array('user_id'=>$user_id));
			
			$this->load->view($this->documents, $this->data);
		}
		
		if($user_type_id == 2){
			//$this->data['pay_slip'] = $this->Common_model->get_data('documents',array('documents.document_type'=>1,'user_id'=>$user_id),array('document_id'=>'DESC'));
			//$this->data['appointment_letter'] = $this->Common_model->get_data('documents',array('documents.document_type'=>2,'user_id'=>$user_id),array('document_id'=>'DESC'));
			//$this->data['offer_letter'] = $this->Common_model->get_data('documents',array('documents.document_type'=>3,'user_id'=>$user_id),array('document_id'=>'DESC'));
			$slip_query = "SELECT * FROM `documents` JOIN `notifications` ON `notifications`.`reference_id` = `documents`.`document_id` WHERE `notifications`.`reference_name` = 'payslip' AND `notifications`.`user_id` = $user_id GROUP BY `documents`.`document_id` ORDER BY `documents`.`document_id` DESC";
			
			$slip_query = $this->db->query($slip_query);
			$this->data['pay_slip'] = $slip_query->result_object();
			
			$appointment_query = "SELECT * FROM `documents` JOIN `notifications` ON `notifications`.`reference_id` = `documents`.`document_id` WHERE `notifications`.`reference_name` = 'appointment' AND `notifications`.`user_id` = $user_id GROUP BY `documents`.`document_id` ORDER BY `documents`.`document_id` DESC";
			
			$appointment_query = $this->db->query($appointment_query);
			$this->data['appointment_letter'] = $appointment_query->result_object();
			
			$offer_query = "SELECT * FROM `documents` JOIN `notifications` ON `notifications`.`reference_id` = `documents`.`document_id` WHERE `notifications`.`reference_name` = 'offerletter' AND `notifications`.`user_id` = $user_id GROUP BY `documents`.`document_id` ORDER BY `documents`.`document_id` DESC";
			
			$offer_query = $this->db->query($offer_query);
			$this->data['offer_letter'] = $offer_query->result_object();
			
			//$this->data['warning_notice'] = $this->Common_model->get_data('notices',array('notices.notice_type'=>2),array('notices.notice_id'=>'DESC'),'','',array('user_details'=>'user_details.user_id=notices.user_id'));
			//$this->data['review_notice'] = $this->Common_model->get_data('notices',array('notices.notice_type'=>3),array('notices.notice_id'=>'DESC'),'','',array('user_details'=>'user_details.user_id=notices.user_id'));
			$query = "SELECT * FROM `notices` JOIN `notifications` ON `notifications`.`reference_id` = `notices`.`notice_id` JOIN `user_details` ON `user_details`.`user_id` = `notices`.`user_id` WHERE `notifications`.`reference_name` = 'warning' AND `notifications`.`user_id` = $user_id GROUP BY `notices`.`notice_id` ORDER BY `notices`.`notice_id` DESC";
			
			$query = $this->db->query($query);
			$this->data['warning_notice'] = $query->result_object();
			
			$querys = "SELECT * FROM `notices` JOIN `notifications` ON `notifications`.`reference_id` = `notices`.`notice_id` JOIN `user_details` ON `user_details`.`user_id` = `notices`.`user_id` WHERE `notifications`.`reference_name` = 'review' AND `notifications`.`user_id` = $user_id GROUP BY `notices`.`notice_id` ORDER BY `notices`.`notice_id` DESC";
			
			$querys = $this->db->query($querys);
			$this->data['review_notice'] = $querys->result_object();
			
			
			$this->data['employee_list'] = $this->Common_model->get_data('user_details',array('users.user_type'=>3),'','','',array('users'=>'users.user_id=user_details.user_id'));
			
			//$this->data['leave_taken'] = $this->Common_model->get_data('user_leave',array('user_id'=>$user_id));
			
			$this->load->view($this->documents, $this->data);
		}
	
	}
	
	
	
	public function do_add_document()
	{
		
		$user_id = $this->input->post('employee_id');
		 
		$document_month = $this->input->post('document_month');
		$document_type = $this->input->post('document_type');
		
		$sdat = db_date_format($this->input->post('document_date'));
		
		if (empty($_FILES['userfile']['name'])) {
			
		}
			$config['upload_path'] = './assets/upload/documents/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png|docx|pdf';
			$new_name = time().$_FILES["userfile"]['name'];
			$config['file_name'] = $new_name; 
			
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				$this->session->set_userdata('message', 'Error in uploading attachment!');
				redirect('document/documents');
			}
			else
			{
				$filename= $this->upload->data();
				$userfile=$filename['file_name'];
				
				$document_data['user_id'] = $user_id;
				$document_data['document_type'] = $document_type;
				$document_data['document_month'] = $document_month;
				
				$document_data['document_added_date'] = date("Y-m-d");
				$document_data['document_src'] = $userfile;
				$document_data['document_status'] = 0;
			
				$insert_id = $this->Common_model->insert('documents', $document_data);
				if($insert_id){
					if($document_type=='1'){
						$doc_name = "payslip";
					}
					if($document_type=='2'){
						$doc_name = "appointment";
					}
					if($document_type=='3'){
						$doc_name = "offerletter";
					}
					
					$userid = get_user_id();
					$user_type_id = get_user_type_id();
					
					$hr_id = get_hr_id();
					if($hr_id == $userid){
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = $doc_name;
						$notification_data['user_id'] = $hr_id;
						$notification_data['notification_status'] = '1';
						
						$this->Common_model->insert('notifications', $notification_data);
					}else{
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = $doc_name;
						$notification_data['user_id'] = $hr_id;
						$notification_data['notification_status'] = '0';
						
						$this->Common_model->insert('notifications', $notification_data);
					}
						
					$superadmin_id = get_superadmin_id();
					if($superadmin_id == $userid){
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = $doc_name;
						$notification_data['user_id'] = $superadmin_id;
						$notification_data['notification_status'] = '1';
						
						$this->Common_model->insert('notifications', $notification_data);
					}else{
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = $doc_name;
						$notification_data['user_id'] = $superadmin_id;
						$notification_data['notification_status'] = '0';
						
						$this->Common_model->insert('notifications', $notification_data);
					}
					
					/*$sel_subadmin_arr = $this->Common_model->get_data('users',array('user_type'=>2));

					foreach($sel_subadmin_arr as $sel_subadmin)
					{
						if($sel_subadmin->user_id == $userid){
							$notification_data['reference_id'] = $insert_id;
							$notification_data['reference_name'] = $doc_name;
							$notification_data['user_id'] = $sel_subadmin->user_id;
							$notification_data['notification_status'] = '1';
							
							$this->Common_model->insert('notifications', $notification_data);
						}
						else{
							$notification_data['reference_id'] = $insert_id;
							$notification_data['reference_name'] = $doc_name;
							$notification_data['user_id'] = $sel_subadmin->user_id;
							$notification_data['notification_status'] = '0';
							
							$this->Common_model->insert('notifications', $notification_data);
						}
							
					}*/
					
					$notification_data['reference_id'] = $insert_id;
					$notification_data['reference_name'] = $doc_name;
					$notification_data['user_id'] = $user_id;
					$notification_data['notification_status'] = '0';
					$this->Common_model->insert('notifications', $notification_data);
					
					$this->session->set_userdata('message', 'Document Added Successfully!');
					redirect('document/documents');
				}
				else{
					$this->session->set_userdata('message', 'Error in Publishing!');
					redirect('document/documents');
				}			
			}
		//}
	}
	
	
	function ajax_payslip(){	
		
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		
		$this->load->helper('url');
		
		$documents_id = $this->uri->segment(3);
		
		//if($user_type_id == 4)
		//{
			//$general_notice = $this->Common_model->get_data('notices',array('notices.notice_type'=>1),array('notices.notice_id'=>'DESC'));
			
			$this->data['payslip'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id,'reference_id'=>$documents_id, 'reference_name'=>'payslip','notification_status'=>0));
			
			if($this->data['payslip'] > 0)
			{
				$update_notification = $this->Common_model->update('notifications',array('reference_name'=>'payslip','user_id'=>$user_id,'reference_id'=>$documents_id),array('notification_status'=>'1'));
				
				//redirect('document/documents');
			}
			redirect('document/documents');
		//}
	}
	
	function ajax_appointment(){	
		
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		
		$this->load->helper('url');
		
		$documents_id = $this->uri->segment(3);
		
		//if($user_type_id == 4)
		//{
			//$general_notice = $this->Common_model->get_data('notices',array('notices.notice_type'=>1),array('notices.notice_id'=>'DESC'));
			
			$this->data['appointment'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id,'reference_id'=>$documents_id, 'reference_name'=>'appointment','notification_status'=>0));
			
			if($this->data['appointment'] > 0)
			{
				$update_notification = $this->Common_model->update('notifications',array('reference_name'=>'appointment','user_id'=>$user_id,'reference_id'=>$documents_id),array('notification_status'=>'1'));
				
				//redirect('document/documents');
			}
			redirect('document/documents');
		//}
	}
	
	function ajax_offer_letter(){	
		
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		
		$this->load->helper('url');
		
		$documents_id = $this->uri->segment(3);
		
		//if($user_type_id == 4)
		//{
			//$general_notice = $this->Common_model->get_data('notices',array('notices.notice_type'=>1),array('notices.notice_id'=>'DESC'));
			
			$this->data['offer_letter'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id,'reference_id'=>$documents_id, 'reference_name'=>'offerletter','notification_status'=>0));
			
			if($this->data['offer_letter'] > 0)
			{
				$update_notification = $this->Common_model->update('notifications',array('reference_name'=>'offerletter','user_id'=>$user_id,'reference_id'=>$documents_id),array('notification_status'=>'1'));
				
				//redirect('document/documents');
			}
			redirect('document/documents');
		//}
	}
	
	
	public function delete_document()
	{
		$this->load->helper('url');
		
		$document_id = $this->uri->segment(3);
		
		$del_document = $this->Common_model->delete('documents', array('document_id' => $document_id));
		//$del_notification = $this->Common_model->delete('notifications', array('reference_id'=>$task_id));
		
		$this->session->set_userdata('message', 'Document Deleted Successfully!');
		
		redirect('leaves/leave_management');
	}
	
	
	/*----------------------  Start Notice Section  ---------------------------------*/
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
				
				$userid = get_user_id();
				$user_type_id = get_user_type_id();
				
				$hr_id = get_hr_id();
					if($hr_id == $userid){
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = 'warning';
						$notification_data['user_id'] = $hr_id;
						$notification_data['notification_status'] = '1';
						
						$this->Common_model->insert('notifications', $notification_data);
					}else{
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = 'warning';
						$notification_data['user_id'] = $hr_id;
						$notification_data['notification_status'] = '0';
						
						$this->Common_model->insert('notifications', $notification_data);
					}
					
				$superadmin_id = get_superadmin_id();
				if($superadmin_id == $userid){
					$notification_data['reference_id'] = $insert_id;
					$notification_data['reference_name'] = 'warning';
					$notification_data['user_id'] = $superadmin_id;
					$notification_data['notification_status'] = '1';
					
					$this->Common_model->insert('notifications', $notification_data);
				}else{
					$notification_data['reference_id'] = $insert_id;
					$notification_data['reference_name'] = 'warning';
					$notification_data['user_id'] = $superadmin_id;
					$notification_data['notification_status'] = '0';
					
					$this->Common_model->insert('notifications', $notification_data);
				}
				
				$sel_subadmin_arr = $this->Common_model->get_data('users',array('user_type'=>2));

				foreach($sel_subadmin_arr as $sel_subadmin)
				{
					if($sel_subadmin->user_id == $userid){
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = 'warning';
						$notification_data['user_id'] = $sel_subadmin->user_id;
						$notification_data['notification_status'] = '1';
						
						$this->Common_model->insert('notifications', $notification_data);
					}
					else{
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = 'warning';
						$notification_data['user_id'] = $sel_subadmin->user_id;
						$notification_data['notification_status'] = '0';
						
						$this->Common_model->insert('notifications', $notification_data);
					}
						
				}
				
				$notification_data['reference_id'] = $insert_id;
				$notification_data['reference_name'] = 'warning';
				$notification_data['user_id'] = $user_id;
				$notification_data['notification_status'] = '0';
				$this->Common_model->insert('notifications', $notification_data);
				
				
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
					
					$userid = get_user_id();
					$user_type_id = get_user_type_id();
					
					$hr_id = get_hr_id();
					if($hr_id == $userid){
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = 'warning';
						$notification_data['user_id'] = $hr_id;
						$notification_data['notification_status'] = '1';
						
						$this->Common_model->insert('notifications', $notification_data);
					}else{
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = 'warning';
						$notification_data['user_id'] = $hr_id;
						$notification_data['notification_status'] = '0';
						
						$this->Common_model->insert('notifications', $notification_data);
					}
					
					$superadmin_id = get_superadmin_id();
					if($superadmin_id == $userid){
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = 'warning';
						$notification_data['user_id'] = $superadmin_id;
						$notification_data['notification_status'] = '1';
						
						$this->Common_model->insert('notifications', $notification_data);
					}else{
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = 'warning';
						$notification_data['user_id'] = $superadmin_id;
						$notification_data['notification_status'] = '0';
						
						$this->Common_model->insert('notifications', $notification_data);
					}
					
					$sel_subadmin_arr = $this->Common_model->get_data('users',array('user_type'=>2));

					foreach($sel_subadmin_arr as $sel_subadmin)
					{
						if($sel_subadmin->user_id == $userid){
							$notification_data['reference_id'] = $insert_id;
							$notification_data['reference_name'] = 'warning';
							$notification_data['user_id'] = $sel_subadmin->user_id;
							$notification_data['notification_status'] = '1';
							
							$this->Common_model->insert('notifications', $notification_data);
						}
						else{
							$notification_data['reference_id'] = $insert_id;
							$notification_data['reference_name'] = 'warning';
							$notification_data['user_id'] = $sel_subadmin->user_id;
							$notification_data['notification_status'] = '0';
							
							$this->Common_model->insert('notifications', $notification_data);
						}
							
					}
					
					$notification_data['reference_id'] = $insert_id;
					$notification_data['reference_name'] = 'warning';
					$notification_data['user_id'] = $user_id;
					$notification_data['notification_status'] = '0';
					$this->Common_model->insert('notifications', $notification_data);
					
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
			
			$base_url = base_url()."document/delete_notice/".$data->notice_id; 
			
			$table_data .= '<tr>
			<td width="520px">'.$data->notice_name.'</td>
			<td>'.$date.'</td>
			<td>'.$priroty.'</td>
			<td>
				<button name="warning_view" id="warning_view" data-id="'.$data->name.'" data-name-id="'.$data->notice_name.'" data-msg-id="'.$data->notice_message.'" data-date-id="'.$date.'" data-file-id="'.$data->notice_file.'" data-type-id="Warning Notice" class="g_view btn btn-success" data-toggle="modal" data-target="#noticeModal">View</button>
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
				
				$userid = get_user_id();
				$user_type_id = get_user_type_id();
				
				$hr_id = get_hr_id();
				if($hr_id == $userid){
					$notification_data['reference_id'] = $insert_id;
					$notification_data['reference_name'] = 'review';
					$notification_data['user_id'] = $hr_id;
					$notification_data['notification_status'] = '1';
					
					$this->Common_model->insert('notifications', $notification_data);
				}else{
					$notification_data['reference_id'] = $insert_id;
					$notification_data['reference_name'] = 'review';
					$notification_data['user_id'] = $hr_id;
					$notification_data['notification_status'] = '0';
					
					$this->Common_model->insert('notifications', $notification_data);
				}
				
				$superadmin_id = get_superadmin_id();
					if($superadmin_id == $userid){
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = 'review';
						$notification_data['user_id'] = $superadmin_id;
						$notification_data['notification_status'] = '1';
						
						$this->Common_model->insert('notifications', $notification_data);
					}else{
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = 'review';
						$notification_data['user_id'] = $superadmin_id;
						$notification_data['notification_status'] = '0';
						
						$this->Common_model->insert('notifications', $notification_data);
					}
					
					$sel_subadmin_arr = $this->Common_model->get_data('users',array('user_type'=>2));

					foreach($sel_subadmin_arr as $sel_subadmin)
					{
						if($sel_subadmin->user_id == $userid){
							$notification_data['reference_id'] = $insert_id;
							$notification_data['reference_name'] = 'review';
							$notification_data['user_id'] = $sel_subadmin->user_id;
							$notification_data['notification_status'] = '1';
							
							$this->Common_model->insert('notifications', $notification_data);
						}
						else{
							$notification_data['reference_id'] = $insert_id;
							$notification_data['reference_name'] = 'review';
							$notification_data['user_id'] = $sel_subadmin->user_id;
							$notification_data['notification_status'] = '0';
							
							$this->Common_model->insert('notifications', $notification_data);
						}
							
					}
					
					$notification_data['reference_id'] = $insert_id;
					$notification_data['reference_name'] = 'review';
					$notification_data['user_id'] = $user_id;
					$notification_data['notification_status'] = '0';
					$this->Common_model->insert('notifications', $notification_data);
					
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
					
					$userid = get_user_id();
					$user_type_id = get_user_type_id();
				
					
					$hr_id = get_hr_id();
					if($hr_id == $userid){
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = 'review';
						$notification_data['user_id'] = $hr_id;
						$notification_data['notification_status'] = '1';
						
						$this->Common_model->insert('notifications', $notification_data);
					}else{
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = 'review';
						$notification_data['user_id'] = $hr_id;
						$notification_data['notification_status'] = '0';
						
						$this->Common_model->insert('notifications', $notification_data);
					}
					
					$superadmin_id = get_superadmin_id();
					if($superadmin_id == $userid){
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = 'review';
						$notification_data['user_id'] = $superadmin_id;
						$notification_data['notification_status'] = '1';
						
						$this->Common_model->insert('notifications', $notification_data);
					}else{
						$notification_data['reference_id'] = $insert_id;
						$notification_data['reference_name'] = 'review';
						$notification_data['user_id'] = $superadmin_id;
						$notification_data['notification_status'] = '0';
						
						$this->Common_model->insert('notifications', $notification_data);
					}
					
					$sel_subadmin_arr = $this->Common_model->get_data('users',array('user_type'=>2));

					foreach($sel_subadmin_arr as $sel_subadmin)
					{
						if($sel_subadmin->user_id == $userid){
							$notification_data['reference_id'] = $insert_id;
							$notification_data['reference_name'] = 'review';
							$notification_data['user_id'] = $sel_subadmin->user_id;
							$notification_data['notification_status'] = '1';
							
							$this->Common_model->insert('notifications', $notification_data);
						}
						else{
							$notification_data['reference_id'] = $insert_id;
							$notification_data['reference_name'] = 'review';
							$notification_data['user_id'] = $sel_subadmin->user_id;
							$notification_data['notification_status'] = '0';
							
							$this->Common_model->insert('notifications', $notification_data);
						}
							
					}
					
					$notification_data['reference_id'] = $insert_id;
					$notification_data['reference_name'] = 'review';
					$notification_data['user_id'] = $user_id;
					$notification_data['notification_status'] = '0';
					$this->Common_model->insert('notifications', $notification_data);
					
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
			
			$base_url = base_url()."document/delete_notice/".$data->notice_id; 
			
			$table_data .= '<tr>
			<td width="520px">'.$data->notice_name.'</td>
			<td>'.$date.'</td>
			<td>'.$priroty.'</td>
			<td>
				<button name="review_view" id="review_view" data-id="'.$data->name.'" data-name-id="'.$data->notice_name.'" data-msg-id="'.$data->notice_message.'" data-date-id="'.$date.'" data-file-id="'.$data->notice_file.'" data-type-id="Review Notice" class="g_view btn btn-success" data-toggle="modal" data-target="#noticeModal">View</button>
				<a href="'.$base_url.'"><button name="delete_review" id="delete_review" class="btn hidden-sm-down btn-danger">Delete</button></a>
			</td>
			</tr>';
		}
		
		$dataz['table_data'] = $table_data;
		echo json_encode($dataz); 
	
	}
	
	
	
	function ajax_warning_notice(){	
		
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		
		$this->load->helper('url');
		
		$notice_id = $this->uri->segment(3);
		
		//if($user_type_id == 4)
		//{
			//$general_notice = $this->Common_model->get_data('notices',array('notices.notice_type'=>1),array('notices.notice_id'=>'DESC'));
			
			$this->data['warning'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id,'reference_id'=>$notice_id, 'reference_name'=>'warning','notification_status'=>0));
			
			if($this->data['warning'] > 0)
			{
				$update_notification = $this->Common_model->update('notifications',array('reference_name'=>'warning','user_id'=>$user_id,'reference_id'=>$notice_id),array('notification_status'=>'1'));
				
				//redirect('document/documents');
			}
			redirect('document/documents');
		//}
	}
	
	function ajax_review_notice(){	
		
		$user_id = get_user_id();
		$user_type_id = get_user_type_id();
		
		$this->load->helper('url');
		
		$notice_id = $this->uri->segment(3);
		
		//if($user_type_id == 4)
		//{
			//$general_notice = $this->Common_model->get_data('notices',array('notices.notice_type'=>1),array('notices.notice_id'=>'DESC'));
			
			$this->data['review'] = $this->Common_model->get_count('notifications',array('user_id'=>$user_id,'reference_id'=>$notice_id, 'reference_name'=>'review','notification_status'=>0));
			
			if($this->data['review'] > 0)
			{
				$update_notification = $this->Common_model->update('notifications',array('reference_name'=>'review','user_id'=>$user_id,'reference_id'=>$notice_id),array('notification_status'=>'1'));
				
				//redirect('document/documents');
			}
			redirect('document/documents');
		//}
	}
	
	
	
	public function delete_notice()
	{
		$this->load->helper('url');
		
		$notice_id = $this->uri->segment(3);
		
		$del_notice = $this->Common_model->delete('notices', array('notice_id' => $notice_id));
		//$del_notification = $this->Common_model->delete('notifications', array('reference_id'=>$task_id));
		
		$this->session->set_userdata('message', 'Notice Deleted Successfully!');
		
		redirect('document/documents');
	}
	/*--------------------------------  End Notice Section  ----------------------------------------*/
}
