<?php
include_once("./database/db.php");
$db = new Database();
$con = $db->connect();
$query = "
SELECT * FROM requests 
WHERE serial_no = '".$_GET['serial_no']."'
";
 
$statement = $con->prepare($query);
$statement->execute();
$result = $statement->get_result();
$requested_by = '';
$approved_by = '';
$date_approved = '';
$date_requested='';
$location_id='';
$Returnable='';
$return_date='';
$status='';
$brand = '';
$name='';
$loc_name='';
$Address='';
$type='';
$justification='';
$remarks='';
foreach($result as $row)
{
	$requested_by = $row['requested_by'];
	$approved_by = $row['approved_by'];
	$date_approved=$row['date_approved'];
	$date_requested=$row['date_requested'];
    $location_id=$row['location_going'];
    $Returnable=$row['Returnable'];
    $return_date=$row['date_of_return'];
    $status=$row['status'];
    $justification=$row['justification'];
    $remarks=$row['remarks'];
}

$serialno=$_GET['serial_no'];
$sql="SELECT p.type,p.brand,r.loc_name,r.Address from inventories p,locations r WHERE p.serial_no='".$serialno."' AND  r.location_id='".$location_id."'";

//$statement = $con->prepare($sql);
//$statement->bind_param("sii",$serial_no,$approved_by,$location_id);

//$statement->execute() or die($con->error);

//$result = $statement->get_result();
$result = $con->query($sql);


foreach($result as $row)
{
	
   $brand = $row['brand'];
   
   $loc_name=$row['loc_name'];
   $Address=$row['Address'];
   $type=$row["type"];

}


$sql="SELECT q.name from  users q  WHERE q.user_id='".$approved_by."' ";
$result = $con->query($sql);

foreach($result as $row)
{
$name=$row['name'];
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
 	<script type="text/javascript" src="./manage.js"></script>
 	
 </head>
<body>
	<!-- Navbar -->
	<?php include_once("./header2.php"); ?>
	<?php


if(isset($_POST['approved']))
{
  
  $stat="Approved";
  date_default_timezone_set("Asia/Kolkata");
  $dateapp = date("Y-m-d H:i:s");
    //echo $datereq;
  $approved_by=$_SESSION["user_id"];
  $remarks=$_POST["remarks"];
  //$comment=$_POST['comment'];
  //$id=$_POST['id'];
  //echo "Ankita";
 // $serial_no=$__GET["serial_no"];
   $query="UPDATE `requests` set `status`='".$stat."' ,`date_approved`='".$dateapp."',`approved_by`='".$approved_by."',`remarks`='".$remarks."' WHERE `serial_no`='".$serialno."'";
  //echo "HI";
  $statement = $con->prepare($query);
    $result=$statement->execute();
    
  
  if($result){
    echo "Row Updated successfully!";
    
  }else{
    echo "Data not Updated, please try again!";
  }

  $query="UPDATE `inventories` set `status`='Went for Repairing'  WHERE `serial_no`='".$serialno."'";
  $statement = $con->prepare($query);
  $result=$statement->execute();
   //header("location:http:view_details.php");
  header("refresh:0");


}
if(isset($_POST['rejected']))
{
  $stat= "Not Approved";
  $remarks=$_POST["remarks"];
  //$comment=$_POST['comment'];
  //$id=$_POST['id'];
  
  //$query="UPDATE `applied_leave` set `status`='$status', `comment`='$comment' where `id`='$id'";
   $query="UPDATE `requests` set `status`='".$stat."' ,`remarks`='".$remarks."' WHERE `serial_no`='".$serialno."'";
  //echo "HI";
  $statement = $con->prepare($query);
    $result=$statement->execute();
    
  
  if($result){
    echo "Row Updated successfully!";
    
  }else{
    echo "Data not Updated, please try again!";
  }
   //header("location:http://localhost/inventory_management_system/view_details.php");
  header("refresh:0");
}



?>

	<br/><br/>
	<div class="container">
<div class="card" id="requests">
  <div class="card-header">
    REQUEST DETAILS
  </div>
  <div class="card-body" >
  	<!---
    <blockquote class="blockquote mb-0">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
      
    </blockquote>
    --->
    <?php $serial_no=$_GET["serial_no"];?>
    <ul class="list-group list-group-horizontal list-group-flush ">
  		<li class="list-group-item"><div class="row"><div class="col-md-4"><pre><b>Serial Number:</b><?php echo $serial_no ?></pre></div><div class="col-md-4"><pre><b>Inventory type:</b><?php echo $type ?></pre></div><div class="col-md-4"><pre><b>Brand:</b><?php echo $brand ?></pre></div></div></li>
  		<li class="list-group-item"><div class="row"><div class="col-md-4"><pre><b>Date Requested:</b><?php echo $date_requested ?></pre></div><div class="col-md-4"><pre><b>Requested by:</b><?php echo $requested_by ?></pre></div><div class="col-md-4"><pre><b>Status:</b><?php echo $status ?></pre></div></div></li>
  		<li class="list-group-item"><div class="row"><div class="col-md-4"><pre><b>Approved_by:</b><?php echo $name ?></pre></div><div class="col-md-4"><pre><b>Date Approved:</b><?php echo $date_approved ?></pre></div><div class="col-md-4"><pre><b>User Id Approved:</b><?php echo $approved_by ?></pre></div></div></li>
  		<li class="list-group-item"><div class="row"><div class="col-md-4"><pre><b>Location Id:</b><?php echo $location_id ?></pre></div><div class="col-md-4"><pre><b>Location Name:</b><?php echo $loc_name ?></pre></div><div class="col-md-4"><pre><b>Address:</b><?php echo $Address ?></pre></div></div></li>
  		<li class="list-group-item"><div class="row"><div class="col-md-6"><pre><b>Returnable:</b><?php echo $Returnable ?></pre></div><div class="col-md-6"><pre><b>Date of Return:</b><?php echo $return_date ?></pre></div></div></li>
  		<li class="list-group-item"><div class="row"><div class="col-md-6"><pre><b>Justification:</b><?php echo $justification ?></pre></div>
      <?php 
      if($status!='Pending')
      {
       ?>
        <div class="col-md-6"><pre><b>Remarks:</b><?php echo $remarks ?></pre></div></div></li>
      <?php
      }                         
       ?>
	</ul>

	<?php
  	if(($_SESSION["user_type"]!="Engineer") AND($status=='Pending') )
    {
     ?>
      <button type="submit" class="btn btn-primary"  name="takeaction" data-toggle="modal" data-target="#form_action">TAKE ACTION</button>
   <form method="post" action="" >
  <div class="modal" tabindex="-1" role="dialog" id="form_action">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Take Action Here</h5>
      </div>
      <div class="modal-body">

      
      <label for="remarks"><b>Remarks:</b></label><textarea class="form-control" name="remarks" id="remarks" rows="3"></textarea>
    </div>
     <div class="modal-footer">
  		<button type="submit" class="btn btn-primary"  name="approved" >Approve</button>
  		<button  type="submit" class="btn btn-primary"  name="rejected" >Reject</button>
     </div>
    </div>
  </div>
</div>
  		
     </form>

  	<?php
  	}
  	?>


  </div>
  
</div>
</div>
</body>
</html>