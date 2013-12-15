<div class="modal fade"  id="mySocialNetworkModal" tabindex="-1" role="dialog" aria-labelledby="mySocialNetworkModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Add Social Network: #TYPE# </h4>
      </div>
      <div class="modal-body">
			<div class='row'>
				<div class="col-sm-6">
					<img src="" />
				</div>
				<div class="col-sm-6">
					<label>#TYPE#</label>
				</div>
			</div>
			<form class="form" role="form">
			  <div class="form-group">
			    <label for="handle" class="control-label">Handle</label>
			      <input type="text" class="form-control" id="handle" placeholder="@HonestAbeUSA">
			  </div>
			  <div class="form-group">
			    <label for="profile_url" class="control-label">Profile URL</label>
			      <input type="text" id="profile_url" class="form-control" id="profile_url" placeholder="https://<socialnetwork>/<profile>">
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
	    <button type="button" class="btn btn-block btn-info">Add Network</button>
        <button type="button" class="btn btn-block btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->