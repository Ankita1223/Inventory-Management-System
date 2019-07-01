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

<div class="modal fade" id="form_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="update_brand_form" onsubmit="return false">
          <div class="form-group">
            <label>User Name</label>
            
            <input type="text" class="form-control" name="update_name" id="update_name">
            <small id="n_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label>User Type</label>
            
            <input type="text" class="form-control" name="update_type" id="update_type" placeholder="Enter type">
            <small id="t_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label>Email</label>

          
            <input type="email" class="form-control" name="update_email" id="update_email" placeholder="Enter email">
            <small id="e_error" class="form-text text-muted"></small>
          </div>
        
          <button type="submit" class="btn btn-primary">Edit</button>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>