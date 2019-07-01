<?php
$success = "";
$error_message = "";
$type="";
$password="";
$pass_hash="";
$password1='';
$password2='';
//$email_id="";


$conn = mysqli_connect("localhost","root","","inventory_management_system");
session_start();
if(isset($_POST["email"]))
{
	
    $_SESSION["email_id"]= $_POST["email"];

}
if(isset($_POST["submit_email"])) {
  
	$result = mysqli_query($conn,"SELECT * FROM users WHERE email_id='" . $_POST["email"] . "'") or die(mysqli_error($conn));
	$count  = mysqli_num_rows($result);
	if($count) {
		// generate OTP
		$otp = rand(100000,999999);
		// Send OTP
		require_once("mail_function.php");
		$mail_status = sendOTP($_POST["email"],$otp);
		
		if($mail_status == 1) {
			$result = mysqli_query($conn,"INSERT INTO otp_expiry(otp,is_expired,create_at) VALUES ('" . $otp . "', 0, '" . date("Y-m-d H:i:s"). "')");
			$current_id = mysqli_insert_id($conn);
			if(!empty($current_id)) {
				$success=1;
			}
		}
	} else {
		$error_message = "Email not exists!";
	}
}
if(isset($_POST["submit_otp"])) {
	$result = mysqli_query($conn,"SELECT * FROM otp_expiry WHERE otp='" . $_POST["otp"] . "' AND is_expired!=1 AND NOW() <= DATE_ADD(create_at, INTERVAL 24 HOUR)");
	$count  = mysqli_num_rows($result);
	if(!empty($count)) {
		$result = mysqli_query($conn,"UPDATE otp_expiry SET is_expired = 1 WHERE otp = '" . $_POST["otp"] . "'");
		$success = 2;	
	} else {
		$success =1;
		$error_message = "Invalid OTP!";
	}	
}
if(isset($_POST["pass_set"])) {

		          $password1 = $_POST['password1'];

                  $password2 = $_POST['password2'];
     				if($password != $password2) {

     					die ('Passwords didn\'t match');

     				}
               
	     $password=$_POST["password1"];
			$pass_hash = password_hash($password,PASSWORD_BCRYPT,["cost"=>8]);
	     
		$result = mysqli_query($conn,"UPDATE `users` set `password`='".$pass_hash."' WHERE `email_id`='".$_SESSION["email_id"]."'") or die(mysqli_error($conn));

		$result1 = mysqli_query($conn,"SELECT  `user_type` from `users` WHERE `email_id`='".$_SESSION["email_id"]."'")or die(mysqli_error($conn));
		$count1=mysqli_num_rows($result1) ;
		
		if($result)
		{    
			 $rows=mysqli_fetch_array($result1);
			 $type=$rows["user_type"];
			?>
			<div class="alert alert-danger">
           Password Set!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
         <?php
		}
		else
		{
			?>
			<div class="alert alert-danger">
           Failed to set Password!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <?php
		}

		if ($type=="Admin")
		{
			header('Location: adminlogin.php');
		}

		if ($type=="Employee")
		{
			header('Location: employeelogin.php');
		}

		if ($type=="Engineer")
		{
			header('Location: engineerlogin.php');
		}

        


}
?>

<html>
<head>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Set New Password</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
 	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 	<script type="text/javascript" src="./main.js"></script>
 <style>
 
 
 	body {background-color: plum;}

 </style>


</head>
<body>
	<?php
		if(!empty($error_message)) {
	?>
	<br/><br/>
	<div class="container">
	<div class="alert alert-danger">
  Invalid OTP!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
</div>
	<?php
		}
	?>

<form name="frmUser" method="post" action="" >

		<?php 
			if(!empty($success == 1)) { 
		?>
	  <br/><br/>
    
		<div class="container">
		<div class="card mx-auto" style="width: 30rem;">
		      <div class="card-body">
		        
		          
		          <div class="form-group">
		            <label for="otp">Enter OTP</label>
		            <p style="color:#31ab00;">Check your email for the OTP</p>
		            <input type="text" name="otp" class="form-control" id="otp" aria-describedby="emailHelp" placeholder="Enter otp" required>
		          </div>
		          
		          
		          <button type="submit" name="submit_otp" class="btn btn-primary">Submit</button>
		          
		        
		      </div>
	      
	        
	      </div>
	    </div>
		
	
		
		<?php 
			} else if ($success == 2) {
        ?>
  
		<div class="container">
			<div class="alert alert-success" >
                <strong>Welcome,</strong>  You have successfully loggedin!Set your Password
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
        </div>
		<div class="card mx-auto" style="width: 30rem;">
		      <div class="card-body">
		        
		          
		          <div class="form-group">
		            <label for="email">Email address</label>
		            <input type="email" name="email1" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo $_SESSION["email_id"];?> " disabled>
		          </div>
		          <div class="form-group">
		            <label for="password1">Password</label>
		            <input type="password" name="password1" class="form-control"  id="password1" placeholder="Password" required>
		            <small id="p1_error" class="form-text text-muted"></small>
		          </div>
		          <div class="form-group">
		            <label for="password2">Re-enter Password</label>
		            <input type="password" name="password2" class="form-control"  id="password2" placeholder="Password" required>
		            <small id="p2_error" class="form-text text-muted"></small>
		          </div>
		          
		          <button type="submit" name="pass_set" class="btn btn-primary">Submit</button>
		          
		           
		      </div>
	      
	        
	      </div>
	    </div>
	
      
		<?php
			}
			else {
		?>
       
	<br/><br/>
     <br/><br/>
     <br/><br/>
		<div class="container">
		<div class="card mx-auto" style="width: 30rem;">
		      <div class="card-body">
		        
		          
		          <div class="form-group">
		            <label for="email">Enter your Login Email</label>
		            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
		          </div>
		          
		          
		          <button type="submit" name="submit_email" class="btn btn-primary">Submit</button>
		          
		      
		      </div>
	      
	        
	      </div>
	    </div>
		
		
		
		<?php 
			}
		?>
	
</form>
</body>
</html>