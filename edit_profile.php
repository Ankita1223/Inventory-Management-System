<?php
//profile.php

include_once("./database/db.php");

/*if(!isset($_SESSION['type']))
{
	header("location:login.php");
}*/
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
	$_SESSION["name"]=$name = $row['name'];
	$_SESSION["email_id"]=$email = $row['email_id'];
	$_SESSION["user_type"]=$user_type=$row['user_type'];

}


include_once('./header.php');

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
 	<script>
$(document).ready(function(){
	
	//alert("Ankita");
	$('#edit_profile_form').on('submit', function(){
		status=true;
		if($('#user_new_password').val() != '')
		{   

			if($('#user_new_password').val() != $('#user_re_enter_password').val())
			{
				$('#p_error').html("<span class='text-danger'>Password Not Match</span>");
				alert("Password Not Match")
				status=false;  
				return false;//write this statement otherwise page will be refreshed automatically and Password Not Match will disappear from p_error
			}
			else
			{   
				status=true;
				$('#p_error').html('');
			}
		}
		//$('#edit_prfile').attr('disabled', 'disabled');
		if (status)//don't write (status==true),write(status)
		{

	    //alert("Ankita")
		//var form_data = 
		//$('#user_re_enter_password').attr('required',false);
		$.ajax({
			url:"http://localhost/inventory_management_system/edit.php",
			method:"POST",
			data:$("#edit_profile_form").serialize(),
			success:function(data)
			{
				//$('#edit_prfile').attr('disabled', false);
				alert("Profile Edited Successfully!");
				$('#user_new_password').val('');
				$('#user_re_enter_password').val('');
				$('#message').html(data);

			}
		})
	  }
	  
	})
})
</script>
 </head>
 <body>
 	   <br>
 	    <div class="container">
		<div class="card ">
			<div class="card-header">Edit Profile</div>
			<div class="card-body">
				<form method="post" id="edit_profile_form">
					<span id="message"></span>
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="user_name" id="user_name" class="form-control" value="<?php echo $_SESSION["name"]; ?>" >
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="user_email" id="user_email" class="form-control" value="<?php echo $_SESSION["email_id"]; ?>" >
					</div>
					<hr />
					<label>Leave Password blank if you do not want to change</label>
					<div class="form-group">
						<label>New Password</label>
						<input type="password" name="user_new_password" id="user_new_password" class="form-control" >
					</div>
					<div class="form-group">
						<label>Re-enter Password</label>
						<input type="password" name="user_re_enter_password" id="user_re_enter_password" class="form-control" >
						<small id="p_error"  class="form-text text-muted"></small>	
					</div>
					<div class="form-group">
						 <button class="btn btn-primary" type="submit" name="submit">Edit</button>
					</div>
				</form>
			</div>
		</div>
	</div>


</body>
</html>
			
