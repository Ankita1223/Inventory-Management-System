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

}	

	
?>