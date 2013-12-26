<form id="create_status_form" class="form" role="form" action="index.php" method="#METHOD#">
  <input type="hidden" id="m" name="m" value="create_status" /> 
  <input type="hidden" id="status_identity" name="status_identity" value="" /> 
  <input type="hidden" id="method" name="method" value="POST" /> 
  <div class="form-group">
    <label for="name" class="control-label">Status Name</label>
    <input type="text" class="form-control" id="status_name" name="status_name" placeholder="In Progress" value="" required />
  </div>
  <div class="form-group">
    <div class="btn-controls">
      <button type="submit" class="btn btn-block btn-primary btn-status-submit">#ACTION# Status</button>
    </div>
  </div>
</form>