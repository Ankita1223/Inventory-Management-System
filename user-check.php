<?php
include_once("./database/db.php");
$db = new Database();
$con = $db->connect();
//include_once("./admin_dashboard.php");
$sql = $con->prepare("SELECT user_type FROM users where  email_id=?");
if (isset($_POST["email"]))
{
  $email=$_POST["email"];
}
$sql->bind_param("s",$email);
$result=$sql->execute() or die($con->error);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "abc"   ;    

    if ($row["user_type"] == "Admin")
    {
    	include_once("./admin_dashboard.php");
    }
    else if ($row["user_type"] == "Employee")
    {
    	include_once("./employee_dashboard.php");
    }
    else
    {
        include_once("./engineer_dashboard.php");
    }
}
$con->close();
?>

