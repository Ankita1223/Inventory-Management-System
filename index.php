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
 	<link rel="stylesheet" type="text/css" href="./includes/style.css">
 	
 </head>
 <style>
  body {background-color: #F5F5F5;}
 </style>
<body>

<div class="jumbotron" style="background-color: #DB7093">
  <h1 class="display-4"><center>Inventory Management System </center></h1>

 </div>
<!--
<ul class="list-group list-group-flush">
  <a href="./login.php" class="list-group-item list-group-item-action "><center>Admin</center></a>
  <a href="./login.php" class="list-group-item list-group-item-action"><center>Employee</center></a>
  <a href="./login.php" class="list-group-item list-group-item-action"><center>Engineer</center></a>
</ul>
-->
<div class="card-deck" >
  <div class="card bg-danger">
    <div class="card-body text-center">
      <a href="./adminlogin.php" class="card-text">Admin</a>
    </div>
  </div>
  <div class="card bg-warning">
    <div class="card-body text-center">
      <a href="./employeelogin.php" class="card-text">Employee</a>
    </div>
  </div>
  <div class="card bg-success">
    <div class="card-body text-center">
      <a href="./engineerlogin.php" class="card-text">Engineer</a>
    </div>
  </div>
  <br>
  <br>
  <!---
  <div class="card card-body bg-light">
     Click <a href='#'>here</a> to Login using OTP and then set New Password</div>
--->
</div>

</body>

</html>