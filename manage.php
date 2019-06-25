<?php

/**
* 
*/
class Manage
{
	
	private $con;

	function __construct()
	{
		include_once("./database/db.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function manageRecords($table){
	
		
		$sql = "SELECT * FROM ".$table." ";
		
		$result = $this->con->query($sql) or die($this->con->error);
		$rows = array();
		if($result->num_rows > 0){
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
		}
		return ["rows"=>$rows];

	}

	public function getRecords($table,$status){
	
		
		$sql = "SELECT * FROM ".$table." WHERE status='".$status."'";
		
		$result = $this->con->query($sql) or die($this->con->error);
		$rows = array();
		if($result->num_rows > 0){
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
		}
		return ["rows"=>$rows];

	}
 
	/*public function updateRecords($status){
	
		
			$pre_stmt = $con->prepare("UPDATE `requests` SET `status`='".$status."' where `serial_no`='".$serial_no."'");
			//$pre_stmt->bind_param("ssss",$username,$email,$pass_hash,$usertype);
			$result = $pre_stmt->execute() or die($this->con->error);
			if($result)
			{
			
				alert("Record Updted Successfully!");
			
			}
			
			else
			{
			
				alert("Some Error");
			
			}
			

	}*/
	public function insertRequests($serialno,$locationid,$bool,$date){
	
	
		date_default_timezone_set("Asia/Kolkata");
		$datereq = date("Y-m-d H:i:s");
		//echo $datereq;
		$reqby=$_SESSION["user_name"];
		//echo $reqby;
		$status="Pending";
		//$approved_by="N.A";
		//$date_approved="";
		$sql = "INSERT INTO `requests`(`serial_no`, `requested_by`, `date_requested`, `location_going`,`Returnable`,`date_of_return`,`status`)
			 VALUES (?,?,?,?,?,?,?)";
		
       
		
		$pre_stmt = $this->con->prepare($sql);
		//$pre_stmt = $this->con->query($sql) or die($this->con->error);
		$pre_stmt->bind_param("sssssss",$serialno,$reqby,$datereq,$locationid,$bool,$date,$status);
		$result=$pre_stmt->execute() or die($this->con->error);
		//$result=$pre_stmt->get_result();
			if ($result) {
				return "Success!";
				
			}else{
				return "SOME_ERROR";
			}
		
	}



}	

	
?>