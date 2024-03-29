<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Confirm Deletion of #MODAL_OBJECT_NAME# ?</h4>
		</div>
	<div class="modal-body">
		<div class="alert alert-danger">
			<p>
				<b>Attention! This operation <i>cannot</i> be undone!</b>
			</p>
			<p>
				 Once this #MODAL_OBJECT_TYPE# is deleted, all associated items to this #MODAL_OBJECT_TYPE# 
			    will be unlinked.
			</p>
			<p>
				 <i>i.e. Deleting a speaker will remove the speaker from a session for any given conference.</i>
			</p>
		</div>
		<p>You are deleting the following #MODAL_OBJECT_TYPE#:
		<br />
		#MODAL_OBJECT_INFORMATION#
	</div>
	<div class="modal-footer">
		<div class="col-sm-6">
			<button type="button" class="btn btn-block btn-danger" data-dismiss="modal" onclick="">No, Cancel</button>
		</div>
		<div class="col-sm-6">
			<form id="delete_#MODAL_OBJECT_TYPE#_form" class="form" role="form" action="index.php" method="POST">
			  <input type="hidden" id="m" name="m" value="delete_#MODAL_OBJECT_TYPE#" /> 
			  <input type="hidden" id="#MODAL_OBJECT_TYPE#_identity" name="#MODAL_OBJECT_TYPE#_identity" value="#MODAL_OBJECT_IDENTITY#" /> 
			  <input type="hidden" id="method" name="method" value="DELETE" />
			  <input type="hidden" id="return" name="return" value="#MODAL_OBJECT_TYPE#" />
			  <button type="submit" class="btn btn-block btn-success" id="#MODAL_OBJECT_IDENTITY#">Yes, Remove</button>
		</div>
	</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->