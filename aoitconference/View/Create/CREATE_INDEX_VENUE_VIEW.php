<form id="create_venue_form" class="form" role="form" action="index.php" method="#METHOD#">
  <input type="hidden" id="m" name="m" value="create_venue" /> 
  <input type="hidden" id="venue_identity" name="venue_identity" value="" /> 
  <input type="hidden" id="venue_being_updated" value="0" />
  <input type="hidden" id="venue_method" name="method" value="POST" /> 

  <div class="form-group">
    <label for="Name" class="control-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="White House" 		value="#VENUE_NAME#" required />
  </div>
	
  <div class="form-group">
    <label for="public" class="control-label">Capacity</label>
	<input type="number" class="form-control" id="capacity" name="capacity" placeholder="999" value="#VENUE_CAPACITY#" />
  </div>

  <div class="form-group">
    <label for="address" class="control-label">Address</label>
	<input type="text" class="form-control" id="address" name="address" placeholder="1600 Pennsylvania Ave NW" value="#VENUE_ADDRESS#" />
  </div>

  <div class="form-group">
    <label for="city" class="control-label">City</label>
      <input type="text" class="form-control" id="city" name="city" placeholder="Washington" value="#VENUE_CITY#" />
  </div>

  <div class="form-group">
      <label for="state" class="control-label">State</label>
      <select id="state"class="form-control" name="state">
		#VENUE_STATE_LIST#
	  </select>
  </div>

  <div class="form-group">
    <label for="zip" class="control-label">Zip</label>
	<input type="number" class="form-control" id="zip" name="zip" placeholder="20500" value="#VENUE_ZIP#" />
  </div>
  
  <div class="form-group">
      <label for="country" class="control-label">Country</label>
      <select id="country"class="form-control" name="country">
    #VENUE_COUNTRY_LIST#
    </select>
  </div>

  <div class="form-group">
    <label for="image" class="control-label">Image URL</label>
    <input type="text" class="form-control" id="image" name="image" placeholder="http://upload.wikimedia.org/wikipedia/commons/a/af/WhiteHouseSouthFacade.JPG" value="#VENUE_IMAGE#" />
  </div>

  <div class="form-group">
    <label for="Preview" class="control-label">Preview</label><br>
    <img class="img-thumbnail" src="http://upload.wikimedia.org/wikipedia/commons/a/af/WhiteHouseSouthFacade.JPG" alt="whitehouse" height="200" width="200" />
  </div>

  <div class="form-group">
    <div class="btn-controls">
      <button type="submit" class="btn btn-block btn-primary btn-venue-submit">#ACTION# Venue</button>
    </div>
  </div>

</form>
<!-- /.modal -->