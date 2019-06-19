<?php

/**
* 
*/
class DBOperation
{
	
	private $con;

	function __construct()
	{
		include_once("./database/db.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function addInventory($type,$brand,$serial_no,$status,$name,$user_type,$userid){
		//$time_now=mktime(date('h')+5,date('i')+30,date('s'));
		date_default_timezone_set("Asia/Kolkata");
       // $last_login = date('d-m-Y H:i');
		$last_login = date("Y-m-d H:i:s");
		$addedby=$name."(".$user_type.")";
		$pre_stmt = $this->con->prepare("INSERT INTO `inventories`(`serial_no`, `type`,`brand`, `status`,`added_on`,`added_by`,`user_id`)
		 VALUES (?,?,?,?,?,?,?)");
		
		$pre_stmt->bind_param("ssssssi",$serial_no,$type,$brand,$status,$last_login,$addedby,$userid);
		$result = $pre_stmt->execute() or die($this->con->error);
		if ($result) {
			return "INVENTORY_ADDED";
		}else{
			return 0;
		}

	}
}

?>
