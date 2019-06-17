<?php
//profile.php

include_once("./database/db.php");
$db = new Database();
$con = $db->connect();
$userid ='';
if (isset($_SESSION['user_id']))
{    

     $userid =$_SESSION['user_id'];
}
//echo $userid;
 	$query = "
	SELECT * FROM `users`
	WHERE `user_id` = ?";
	$statement = $con->prepare($query);
	$statement->bind_param("i",$userid);

    $statement->execute() or die($con->error);;
    $result = $statement->get_result();
    //$result = $statement->mysqli_fetch_assoc();
    


$name = '';
$email = '';

$user_type='';
foreach($result as $row)
{
	$name = $row['name'];
	$email = $row['email_id'];
	$user_type=$row['user_type'];

}
if ($user_type!='Admin')
{
	exit("You are not an Admin");
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Inventory Management System</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
 	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 	<script type="text/javascript" src="./main.js"></script>
 </head>
<body>
	<!-- Navbar -->
	<?php include_once("./header.php"); ?>
	<br/><br/>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="jumbotron">
				    <h2>Welcome Admin!</h2>
				    <div class="card mx-auto">
				    <div class="card-body">
				    <h4 class="card-title">Profile Info</h4>
				    <p class="card-text"><i class="fa fa-user">&nbsp;</i><?php echo $name; ?></p>
				    <p class="card-text"><i class="fa fa-user">&nbsp;</i><?php echo $user_type; ?></p>
				    <p class="card-text"><i class="fa fa-envelope">&nbsp;</i><?php echo $email; ?></p>
				    <a href="#" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i>Edit Profile</a>
				  </div>
				</div>
				</div>	
				
				  
				  
			</div>
			<div class="col-md-8">
					<div class="row">
						<div class="col-sm-6">
							<div class="card">
						      <div class="card-body">
						        <h4 class="card-title">View Users</h4>
						        <p class="card-text">Here you view information about different users</p>
						        <a href="view_employees.php" class="btn btn-primary">View Employees</a>
						     </div>
						    </div>
						</div>
						<div class="col-sm-6">
							<div class="card">
						      <div class="card-body">
						        <h4 class="card-title">View Inventories</h4>
						        <p class="card-text">Here you can view various inventories and their status</p>
						        <a href="view_inventories.php" class="btn btn-primary">View Inventories</a>
						      </div>
						    </div>
						</div>
					</div>	
					<br>
					<br>
					<div class="row">
						<div class="col-sm-6">
							<div class="card">
						      <div class="card-body">
						        <h4 class="card-title">Add Employees</h4>
						        <p class="card-text">Here you add employees</p>
						        <a href="#" data-toggle="modal" data-target="#form_employee" class="btn btn-primary">Add Employees</a>
						     </div>
						    </div>
						</div>
						
						<div class="col-sm-6">
							<div class="card">
						      <div class="card-body">
						        <h4 class="card-title">Add Inventories</h4>
						        <p class="card-text">Here you can add inventories</p>
						        <a href="#" data-toggle="modal" data-target="#form_inventory" class="btn btn-primary">Add Inventories</a>
						      </div>
						    </div>
						</div>
					</div>
			</div>
		</div>
	</div>
	
 <?php
	//Categpry Form
	include_once("./add_inventories.php");
  ?>
	
<?php
	//Categpry Form
	include_once("./add_employees.php");
 ?>	

</body>
</html>