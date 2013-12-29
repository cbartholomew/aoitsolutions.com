<form id="create_eventtype_form" class="form" role="form" action="index.php" method="#METHOD#">
  <input type="hidden" id="m" name="m" value="create_eventtype" /> 
  <input type="hidden" id="eventtype_identity" name="eventtype_identity" value="" /> 
  <input type="hidden" id="eventtype_method" name="method" value="POST" /> 
  <div class="form-group">
    <label for="name" class="control-label">Event Type Name</label>
    <input type="text" class="form-control" id="eventtype_name" name="eventtype_name" placeholder="Session" value="" required />
  </div>
  <div class="form-group">
    <div class="btn-controls">
      <button type="submit" class="btn btn-block btn-primary btn-eventtype-submit">#ACTION# Event Type</button>
    </div>
  </div>
</form>