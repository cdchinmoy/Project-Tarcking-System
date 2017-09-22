<?php
ob_start();

include_once('Common_model.php');

class Cron {
	
	public function __construct()
    {
		date_default_timezone_set("Asia/Kolkata");
    }  

	public function index()
	{
		
		$task_list = $this->get_data('task', array('task.task_final_update' => '0'),'','','', array('projects' => 'projects.project_id = task.project_id'));
		/*
		if(count($task_list) > 0)
		{
			foreach($task_list as $list)
			{
				$task_id = $list->task_id;
				
				$task_post_time = $list->task_added_time;

				$strStart = date("Y-m-d H:i:s"); 
				$strEnd = $task_post_time;
				$dteStart = new DateTime($strStart); 
				$dteEnd   = new DateTime($strEnd); 
				$dteDiff  = $dteStart->diff($dteEnd);
				$diffmin = $dteDiff->format("%I");		

				if($diffmin > 3)
				{
					$task_list = $this->Common_model->update('task', array('task_id'=>$task_id), array('task_final_update'=>'1'));
				}
				
			}
		
		}
		*/

		
	}
	

}

$obj = new Cron();
