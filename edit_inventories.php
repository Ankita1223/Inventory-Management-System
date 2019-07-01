<div class="modal fade" id="form_inventory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Inventory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="update_brand_form" onsubmit="return false">
          <div class="form-group">
            <label>Brand</label>
            
            <input type="text" class="form-control" name="update_brand" id="update_brand">
            <small id="n_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label>Inventory Type</label>
            
            <input type="text" class="form-control" name="update_type" id="update_type" placeholder="Enter type">
            <small id="t_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label>Serial Number</label>

          
            <input type="email" class="form-control" name="update_serialno" id="update_serialno" placeholder="Enter serialno">
            <small id="e_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" id="status">
                  <option value="">Choose Status</option>
                  <option value="Already Occupied">Already Occupied</option>
                  <option value="Available">Available</option>
                  <option value="Available">Obsolete</option>
                  
            </select>
            
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