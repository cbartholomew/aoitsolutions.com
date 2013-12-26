<form id="create_track_form" class="form" role="form" action="index.php" method="#METHOD#">
  <input type="hidden" id="m" name="m" value="create_track" /> 
  <input type="hidden" id="track_identity" name="track_identity" value="" /> 
  <input type="hidden" id="method" name="method" value="POST" /> 
  <div class="form-group">
    <label for="name" class="control-label">Track Name</label>
    <input type="text" class="form-control" id="track_name" name="track_name" placeholder="Executive Branch" value="" required />
  </div>
  <div class="form-group">
    <div class="btn-controls">
      <button type="submit" class="btn btn-block btn-primary btn-track-submit">#ACTION# Track</button>
    </div>
  </div>
</form>