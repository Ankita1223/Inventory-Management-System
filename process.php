<?php

include_once("./user.php");
include_once("./db_operation.php");
include_once("./manage.php");
//echo "Test";
//For Registration Processsing
if (isset($_POST["username"]) AND isset($_POST["email"])) {
	$user = new User();
	$result = $user->createUserAccount($_POST["username"],$_POST["email"],$_POST["password1"],$_POST["usertype"]);
	echo $result;
	exit();
}

//For Login Processing
if (isset($_POST["log_email"]) AND isset($_POST["log_password"])) {
	$user = new User();
	$result = $user->userLogin($_POST["log_email"],$_POST["log_password"]);
	echo $result;
	exit();
}

//For adding new inventory
if (isset($_POST["inventory_type"]) AND isset($_POST["brand"])) {
	$obj = new DBOperation();
	$result = $obj->addInventory($_POST["inventory_type"],
							$_POST["brand"],
							$_POST["serial_no"],$_POST["status"],$_SESSION["name"],$_SESSION["user_type"],$_SESSION["user_id"]);

	echo $result;
	exit();
}

#for adding employee
if (isset($_POST["employee_name"]) AND isset($_POST["usertype"])) {
	$user = new User();
	$result = $user->createUserAccount($_POST["employee_name"],$_POST["email"],$_POST["password1"],$_POST["usertype"]);
	echo $result;
	exit();
}


if (isset($_POST["manageInventory"])) {
	$m = new Manage();
	$result = $m->manageRecords("inventories");
	$rows = $result["rows"];

	
		foreach ($rows as $row) {
			?>
				<tr>
			        <td><?php echo $row["type"]; ?></td>
			        <td><?php echo $row["brand"]; ?></td>
			        <td><?php echo $row["serial_no"]; ?></td>
			        <td><?php echo $row["status"]; ?></td>
			        if($_SESSION["user_type"]=="Engineer"){ exit();}
			        <td>
                    
			        	<a href="#" did1="<?php echo $row['user_id']; ?>" class="btn btn-danger btn-sm del_cat1">Obsolete</a>
			        	<a href="#" eid="<?php echo $row['serial_no']; ?>" data-toggle="modal" data-target="#form_category" class="btn btn-info btn-sm edit_cat">Edit</a>
			        </td>
			      </tr>
			<?php
			
		}
		
		exit();
	}

if (isset($_POST["manageEmployee"])) {
	$m = new Manage();
	$result = $m->manageRecords("users");
	$rows = $result["rows"];

	
		foreach ($rows as $row) {
			?>
				<tr>
			        <td><?php echo $row["user_id"]; ?></td>
			        <td><?php echo $row["user_type"]; ?></td>
			        <td><?php echo $row["name"]; ?></td>
			        <td><?php echo $row["email_id"]; ?></td>
			  
			        <td>
			        	<a href="#" did1="<?php echo $row['user_id']; ?>" class="btn btn-danger btn-sm del_cat1">Delete</a>
			        	<a href="#" eid1="<?php echo $row['user_id']; ?>" data-toggle="modal" data-target="#form_category" class="btn btn-info btn-sm edit_cat1">Edit</a>
			        </td>
			      </tr>
			<?php
			
		}
		
		exit();
	}


if (isset($_POST["deleteInventory"])) {
	$m = new Manage();
	$result = $m->deleteRecord("inventories","cid",$_POST["id"]);
	echo $result;
}

?>
?>