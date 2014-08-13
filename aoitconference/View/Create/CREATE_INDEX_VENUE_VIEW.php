<form id="create_venue_form" class="form" role="form" action="index.php" method="#METHOD#">
  <input type="hidden" id="m" name="m" value="create_venue" /> 
  <input type="hidden" id="venue_identity" name="venue_identity" value="" /> 
  <input type="hidden" id="venue_being_updated" value="0" />
  <input type="hidden" id="venue_method" name="method" value="POST" /> 

  <div class="form-group">
    <label for="venue_name" class="control-label">Name</label>
    <input type="text" class="form-control" id="venue_name" name="venue_name" placeholder="White House" 		value="#VENUE_NAME#" required />
  </div>
	
  <div class="form-group">
    <label for="venue_capacity" class="control-label">Capacity</label>
    <input type="number" class="form-control" id="venue_capacity" name="venue_capacity" placeholder="999" value="#VENUE_CAPACITY#" />
  </div>

  <div class="form-group">
    <label for="venue_address" class="control-label">Address</label>
    <input type="text" class="form-control" id="venue_address" name="venue_address" placeholder="1600 Pennsylvania Ave NW" value="#VENUE_ADDRESS#" required/>
  </div>

  <div class="form-group">
    <label for="venue_city" class="control-label">City</label>
      <input type="text" class="form-control" id="venue_city" name="venue_city" placeholder="Washington" value="#VENUE_CITY#" required />
  </div>

  <div class="form-group">
      <label for="venue_state" class="control-label">State</label>
      <select id="venue_state" class="form-control" name="venue_state" required>
		#VENUE_STATE_LIST#
	  </select>
  </div>

  <div class="form-group">
    <label for="venue_zip" class="control-label">Zip</label>
	<input type="number" class="form-control" id="venue_zip" name="venue_zip" placeholder="20500" value="#VENUE_ZIP#" required/>
  </div>
  
  <div class="form-group">
      <label for="venue_country" class="control-label">Country</label>
      <select id="venue_country"class="form-control" name="venue_country" required>
    #VENUE_COUNTRY_LIST#
    </select>
  </div>

  <div class="form-group">
    <label for="venue_image_url" class="control-label">Image URL</label>
    <input type="text" class="form-control" id="venue_image_url" name="venue_image_url" placeholder="http://upload.wikimedia.org/wikipedia/commons/a/af/WhiteHouseSouthFacade.JPG" value="#VENUE_IMAGE#" />
  </div>

  <div class="form-group">
    <label for="venue_preview" class="control-label">Preview</label><br>
    <img class="img-thumbnail" id="venue_preview" src="http://upload.wikimedia.org/wikipedia/commons/a/af/WhiteHouseSouthFacade.JPG" alt="whitehouse" height="200" width="200" />
  </div>

  <div class="form-group">
    <label for="venue_public_use" class="control-label">Public Viewable</label>
    <select id="venue_public_use" class="form-control" name="venue_public_use">
      <option value="1" selected="selected">Yes</option>
      <option value="0">No</option>
    </select>
  </div>

  <div class="form-group">
    <div class="btn-controls">
      <button type="submit" class="btn btn-block btn-primary btn-venue-submit">#ACTION# Venue</button>
    </div>
  </div>

</form>
<!-- /.modal -->