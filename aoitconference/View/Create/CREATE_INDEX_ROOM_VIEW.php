<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Add Room</h4>
      </div>
      <div class="modal-body">
		<form class="form" role="form">
			<div class="form-group">
		    	<label for="roomName" class="control-label">Room Name</label>
		      	<input type="text" id="roomName" class="form-control" placeholder="Oval Office" value="#ROOM_NAME#" />
		  	</div>
			<div class="form-group">
		    	<label for="roomNumber" class="control-label">Room Number</label>
		      	<input type="number" id="roomNumber" class="form-control" placeholder="100" value="#ROOM_NUMBER#" />
		  	</div>
		  	<div class="form-group">
		    	<label for="roomCapacity" class="control-label">Capacity</label>
		      	<input type="number" id="roomCapacity" class="form-control" placeholder="500" value="#ROOM_CAPACITY#" />
		  	</div>
		</form>
	  </div>
      <div class="modal-footer">
	    <button type="button" class="btn btn-block btn-info" onclick="">#ROOM_ACTION# Room</button>
        <button type="button" class="btn btn-block btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->