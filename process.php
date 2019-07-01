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
			        <?php if($_SESSION["user_type"]!='Engineer')
                    {
                    ?>
			        <td>
                     <form action='' method="post">

                     <a href="#" data-toggle="modal" data-target="#form_inventory" class="btn btn-info btn-sm edit_cat1" name="Edit">Edit</a>
			        
			        </form>	
			        </td>
			      <?php
			    }
			    else
			    {
			    ?>
                       <td> <a href="request_for_approval.php?serial_no=<?php echo $row["serial_no"];?>" class="btn btn-primary btn-sm ">Request </a>  </td>
                 <?php
			    }
			    ?>
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
			        <form action='' method="post">
			        
			        	<a href="#" data-toggle="modal" data-target="#form_user "class="btn btn-info btn-sm edit_cat1" name="Edit">Edit</a>
			        </form>
			        </td>
			      </tr>
			<?php
			
		}
		
		exit();
	}

if (isset($_POST["updateUser"])) {
	$m = new Manage();
	$result = $m->getSingleRecord("brands","bid",$_POST["id"]);
	echo json_encode($result);
	exit();
}

//Update Record after getting data
if (isset($_POST["update_user"])) {
	$m = new Manage();
	$id = $_POST["bid"];
	$name = $_POST["update_brand"];
	$result = $m->update_record("brands",["bid"=>$id],["brand_name"=>$name,"status"=>1]);
	echo $result;
}

if (isset($_POST["manageLocation"])) {
	$m = new Manage();
	$result = $m->manageRecords("locations");
	$rows = $result["rows"];

	
		foreach ($rows as $row) {
			?>
				<tr>
			        <td><?php echo $row["location_id"]; ?></td>
			        <td><?php echo $row["loc_name"]; ?></td>
			        <td><?php echo $row["Address"]; ?></td>
			        <td><?php echo $row["phone_no"]; ?></td>
			        
			  
			        
			     </tr>
			<?php
			
		}
		
		exit();
	}


if (isset($_POST["getRequest"])) {
	$m = new Manage();
	$result = $m->manageRecords("requests");
	$rows = $result["rows"];

	
		foreach ($rows as $row) {
			?>
				<tr>
					
			        <td><?php echo $row["serial_no"]; ?></td>
                    
			        <td><?php  
                      if($row["status"]=="Pending"){ 
                      	?>
                      	<span style="color: blue">Waiting for approval</span>
                      <?php
                      }
                      if ($row["status"]=="Approved"){   
                      ?>
                        <span style="color: green">Approved</span>
                     <?php
                     }
                     if ($row["status"]=="Not Approved") { ?>
                        <span style="color: red">Not Approved</span>
                      <?php 
                     }
                       ?>
			         </td>
			        <td><?php echo $row["date_requested"]; ?></td>
			        <td><?php echo $row["requested_by"]; ?></td>
			        <td><a href="view_details.php?serial_no=<?php echo $row["serial_no"];?>"  class="btn btn-primary btn-sm ">VIEW DETAILS</a>
			  
			        
			     </tr>
			<?php
			
		}
		
		exit();
	}
    
    if (isset($_POST["getApprovedRequest"])) {
	$m = new Manage();
	$result = $m->getRecords("requests","Approved");
	$rows = $result["rows"];

	
		foreach ($rows as $row) {
			?>
				<tr>
					
			        <td><?php echo $row["serial_no"]; ?></td>
                    
			        <td>
                        <span style="color: green">Approved</span>
                     
			        </td>
			        <td><?php echo $row["date_requested"]; ?></td>
			        <td><?php echo $row["requested_by"]; ?></td>
			        <td><a href="view_details.php?serial_no=<?php echo $row["serial_no"];?>"  class="btn btn-primary btn-sm ">VIEW DETAILS</a>  
			     </tr>
			<?php
			
		}
		
		exit();
	}
	if (isset($_POST["getPendingRequest"])) {
	$m = new Manage();
	$result = $m->getRecords("requests","Pending");
	$rows = $result["rows"];

	
		foreach ($rows as $row) {
			?>
				<tr>
					
			        <td><?php echo $row["serial_no"]; ?></td>
                    
			        <td>
                        <span style="color:blue">Waiting for Approval</span>
                     
			        </td>
			        <td><?php echo $row["date_requested"]; ?></td>
			        <td><?php echo $row["requested_by"]; ?></td>
			        <td><a href="view_details.php?serial_no=<?php echo $row["serial_no"];?>"  class="btn btn-primary btn-sm ">VIEW DETAILS</a>  
			     </tr>
			<?php
			
		}
		
		exit();
	}

	if (isset($_POST["NotApprovedRequest"])) {
	$m = new Manage();
	$result = $m->getRecords("requests","Not Approved");
	$rows = $result["rows"];

	
		foreach ($rows as $row) {
			?>
				<tr>
					
			        <td><?php echo $row["serial_no"]; ?></td>
                    
			        <td>
                        <span style="color: red">Not Approved</span>
                     
			        </td>
			        <td><?php echo $row["date_requested"]; ?></td>
			        <td><?php echo $row["requested_by"]; ?></td>
			        <td><a href="view_details.php?serial_no=<?php echo $row["serial_no"];?>"  class="btn btn-primary btn-sm ">VIEW DETAILS</a>  
			     </tr>
			<?php
			
		}
		
		exit();
	}





if (isset($_POST["serialno"]) AND isset($_POST["locationid"]) AND isset($_POST["bool"])) {
	$m = new Manage();
	$result = $m->insertRequests($_POST["serialno"],$_POST["locationid"],$_POST["bool"],$_POST["datepicker"],$_POST["justification"]);
	echo $result;
	exit();
}

if (isset($_POST["deleteInventory"])) {
	$m = new Manage();
	$result = $m->deleteRecord("inventories","cid",$_POST["id"]);
	echo $result;
}




?>
 