

<?php 
include_once("./database/db.php");
$db = new Database();
$con = $db->connect();
$sql = "SELECT serial_no FROM inventories";
$result = $con->query($sql);
if($result->num_rows > 0){
      while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
      }
    }


?>

<!DOCTYPE html>
<html>

<head>
      <title>Request_for_Approval</title>
      <!----
       <link rel="stylesheet" href="../css/bootstrap.min.css">
      -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	 <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
      
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
       <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <!---
 	   <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     --->
 	   <script type="text/javascript" src="./main.js"></script>
     
</head>
<body>

<?php include_once("./header1.php");?>
<style>
form {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>

<span class="border ">
<div class="col-4 offset-4">
<form  id="request_for_approval"  onsubmit="return false">
  <fieldset>
  <legend> REQUEST FOR APPROVAL </legend>
  <hr>
  <div class="form-group">
    <label for="serialno">Serial Number</label>
    <select class="form-control" id="serialno" name="serialno">
    <option value="">Choose Serial Number</option>
    <?php
    foreach ($rows as $row) {
    ?>
       <option>  <?php echo $row["serial_no"] ?></option>;
    <?php
    } 
    ?> 
    </select>

  </div>
  <div class="form-group">
    <label for="locationid">Location Id</label>
    <select class="form-control" id="locationid" name="locationid">
      <option value="">Choose Location Id</option>
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
      <option>6</option>
      <option>7</option>
      <option>8</option>
      <option>9</option>
      <option>10</option>
      <option>11</option>
      <option>12</option>
      <option>13</option>
      <option>14</option>
      <option>15</option>
      <option>16</option>
      <option>17</option>
      <option>18</option>
      <option>19</option>
      <option>20</option>
      <option>21</option>
    </select>
  </div>
  <div class="form-group" >
    <label for="bool">Retunable</label>
    <select class="form-control" id="bool" name="bool">
      <option value="">Choose Option</option>
      <option>Yes</option>
      <option>No</option>
    </select>
  </div>
  <div class="form-group">
    <label for="date_of_return">Enter date of return(if returnable)</label>
    <input id="datepicker" name="datepicker">
    
    <script>
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            showOtherMonths: true
        });
    </script>
  
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>

  </fieldset>

</form>
</div>
</span>


</body>
</html>