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

	public function addInventory($type,$brand,$serial_no,$status){
		$pre_stmt = $this->con->prepare("INSERT INTO `inventories`(`serial_no`, `type`,`brand`, `status`)
		 VALUES (?,?,?,?)");
		
		$pre_stmt->bind_param("ssss",$serial_no,$type,$brand,$status);
		$result = $pre_stmt->execute() or die($this->con->error);
		if ($result) {
			return "INVENTORY_ADDED";
		}else{
			return 0;
		}

	}
}

?>
