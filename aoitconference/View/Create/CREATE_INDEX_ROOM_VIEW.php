<form id="create_room_form" class="form" role="form" action="index.php" method="#METHOD#">
  <input type="hidden" id="m" name="m" value="create_room" /> 
  <input type="hidden" id="room_identity" name="room_identity" value="" /> 
  <input type="hidden" id="room_method" name="method" value="POST" /> 
  	<div class="form-group">
	<label for="room_veune" class="control-label">Select Venue</label>
     <select id="room_venue" class="form-control" name="room_venue" required>
		#ROOM_VENUE_LIST#
	 </select>
	</div>
	<div class="form-group">
		<label for="" class="control-label">Venue not listed? <a href="#venue">Create one</a></label>
	<div class="form-group">
	</div>
	<label for="roomName" class="control-label">Room Name</label>
		<input type="text" id="roomName" class="form-control" placeholder="Oval Office" value="#ROOM_NAME#" />
	</div>
	<div class="form-group">
	<label for="roomNumber" class="control-label">Room Number</label>
		<input type="text" id="roomNumber" class="form-control" placeholder="100A" value="#ROOM_NUMBER#" />
	</div>
	<div class="form-group">
	<label for="roomCapacity" class="control-label">Capacity</label>
		<input type="number" id="roomCapacity" class="form-control" placeholder="500" value="#ROOM_CAPACITY#" />
	</div>
  <div class="form-group">
    <div class="btn-controls">
      <button type="submit" class="btn btn-block btn-primary btn-eventtype-submit">#ROOM_ACTION# Room</button>
    </div>
  </div>
</form>
