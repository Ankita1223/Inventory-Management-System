<div class="modal fade" id="form_employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="employee_form" onsubmit="return false">
          <div class="form-group">
            <label>Employee Name</label>
            <input type="text" class="form-control" name="employee_name" id="employee_name" placeholder="Enter Employee Name">
            <small id="n_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label>Employee Type</label>
            <select name="usertype" class="form-control" id="usertype">
                  <option value="">Choose User Type</option>
                  <option value="Admin">Admin</option>
                  <option value="Employee">Employee</option>
                  <option value="Engineer">Engineer</option>
            </select>
            
          </div>
          <div class="form-group">
            <label>Email Address</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email">
            <small id="e_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password1" id="password1" placeholder="Enter Password">
            <small id="p_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
                <label for="password2">Re-enter Password</label>
                <input type="password" name="password2" class="form-control"  id="password2" placeholder="Password">
                <small id="p2_error" class="form-text text-muted"></small>
          </div>

          <button type="submit" class="btn btn-primary">Add Employee</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>