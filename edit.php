<?php

//edit_profile.php

include_once('./database/db.php');

if(isset($_POST['user_name']))
{
	if($_POST["user_new_password"] != '')
	{
		$query = "
		UPDATE users  SET 
			name = '".$_POST["user_name"]."', 
			email_id = '".$_POST["user_email"]."', 
			password = '".password_hash($_POST["user_new_password"], PASSWORD_DEFAULT)."' 
			WHERE user_id = '".$_SESSION["user_id"]."'
		";
	}
	else
	{
		$query = "
		UPDATE users  SET 
			name = '".$_POST["user_name"]."', 
			email_id = '".$_POST["user_email"]."'
			WHERE user_id = '".$_SESSION["user_id"]."'
		";
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	if(isset($result))
	{
		echo '<div class="alert alert-success">Profile Edited</div>';
	}
}

?>