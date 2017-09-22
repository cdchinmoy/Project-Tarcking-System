<?php
$host = "localhost";
$user = "exoticap_ptsuser";
$pass = "rw&774UZ9XG=";

	date_default_timezone_set("Asia/Kolkata");
	
try {
    $conn = new PDO("mysql:host=$host;dbname=exoticap_pts", $user, $pass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo "Connected successfully"; 
	
	$sql = "SELECT * FROM task WHERE task_final_update='0'";
	$result = $conn->query($sql);
	//print_r($result);
	//print $result->rowCount(); //die;
	if ($result->rowCount() > 0) {
	  
		// output data of each row
		while($row = $result->fetch()) {
			$task_id = $row["task_id"];
					
			$task_post_time = $row["task_added_time"];
		
			$strStart = date("Y-m-d H:i:s");
			$strEnd = $task_post_time;
			$dteStart = new DateTime($strStart); 
			$dteEnd   = new DateTime($strEnd); 
			$dteDiff  = $dteStart->diff($dteEnd);
			$diffmin = $dteDiff->format("%I");	
			
			//echo $diffmin; die;	
	
			if($diffmin > 30)
			{
				$sql = "UPDATE task SET task_final_update='1' WHERE task_id=".$task_id;
				
				 $stmt = $conn->prepare($sql);

   				// $stmt->execute();
				if ($stmt->execute() === TRUE) {
					//echo "Record updated successfully";
				} else {
					//echo "Error updating record: " . $conn->error;
				}
			}
			else
			{
				echo "Time less then recuired time";
			}
		}
	
	} 
	else {
		echo "0 results";
	}
}
catch(PDOException $e)
{
    die( /*"Connection failed: " . $e->getMessage()*/);
}
?>