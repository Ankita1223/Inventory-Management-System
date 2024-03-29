<?php
//profile.php

include_once("./database/db.php");
$db = new Database();
$con = $db->connect();
$query = "
SELECT * FROM users 
WHERE user_id = '".$_SESSION['user_id']."'
";

if (isset($_SESSION['user_id']))
{    

     $userid =$_SESSION['user_id'];
}
$statement = $con->prepare($query);
$statement->execute();
$result = $statement->get_result();
//$result = $statement->mysqli_fetch_assoc();
$name = '';
$email = '';
$user_id = '';
$user_type='';
foreach($result as $row)
{
	$_SESSION["user_name"]=$name = $row['name'];
	$_SESSION["email_id"]=$email = $row['email_id'];
	$_SESSION["user_type"]=$user_type=$row['user_type'];

}
if ($user_type!='Engineer')
{
	exit("You are not an engineer");
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
			<div class="col-md-5">
				<div class="jumbotron">
				    <h2>Welcome <?php echo $user_type; ?>!</h2>
				    <div class="card mx-auto">
				    <div class="card-body">
				    <h4 class="card-title">Profile Info</h4>
				    <p class="card-text"><i class="fa fa-user">&nbsp;</i><?php echo $name; ?></p>
				    <p class="card-text"><i class="fa fa-user">&nbsp;</i><?php echo $user_type; ?></p>
				    <p class="card-text"><i class="fa fa-envelope">&nbsp;</i><?php echo $email; ?></p>
				    <a href="./edit_profile.php?id=<?php echo $userid ;?>" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i>Edit Profile</a>
				  </div>
				</div>
				</div>	
				
				  
				  
			</div>
			   <div class="col-md-7">
					
						
							<div class="card">
						      <div class="card-body">
						        <h4 class="card-title">View Inventories</h4>
						        <p class="card-text">Here you view various inventories and their status</p>
						        <a href="./view_inventories.php" class="btn btn-primary">View Inventories</a>
						     </div>
						    </div>
						
						    <br>
					        <br>
					        <br>
						
							<div class="card">
						      <div class="card-body">
						        <h4 class="card-title">Request for Sending</h4>
						        <p class="card-text">Here you can request for approval</p>
						        <a href="request_for_approval.php" class="btn btn-primary">Request</a>
						     </div>
						    </div>
				</div>	
						
			</div>
		</div>
	</div>
	

	
	

</body>
</html>

