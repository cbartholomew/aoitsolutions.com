<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Add Social Network</h4>
      </div>
      <div class="modal-body">
		<div class='row'>
			<div class="col-sm-4">
				<img height="64px" width="64px" src="#SOCIAL_HEADER_LOGO#" />
				<h4>#SOCIAL_HEADER_TYPE#</h4>
			</div>
			<div class="col-sm-8"></div>
		</div>
		<br />
		<form class="form" role="form">
		  <div class="form-group">
		    <label for="handle" class="control-label">Handle</label>
		      <input type="text" class="form-control" id="handle" placeholder="#SOCIAL_PLACEHOLDER_A#">
		  </div>
		  <div class="form-group">
		    <label for="profile_url" class="control-label">Profile URL</label>
		      <input type="text" id="profile_url" class="form-control" id="profile_url" placeholder="#SOCIAL_URL#/#SOCIAL_PLACEHOLDER_A#">
		  </div>
		  <div class="form-group">
		       <label for="is_public" class="control-label">Viewable?</label>
				<div id="is_public" class="btn-group btn-group-lg">
					<button type="button" class="btn btn-success"><i class="glyphicon glyphicon-ok inverse"></i></button>
					<button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-remove inverse"></i></button>
				</div>
		  </div>
		</form>
	  </div>
      <div class="modal-footer">
	    <button type="button" class="btn btn-block btn-info" network='#SOCIAL_HEADER_TYPE#' onclick="addSocialNetwork(this);">Add Network</button>
        <button type="button" class="btn btn-block btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->