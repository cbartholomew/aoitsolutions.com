<form class="form" role="form" action="index.php" method="POST">
  <input type="hidden" name="m" value="create_speaker" /> 
  <div class="form-group">
    <label for="first_name" class="control-label">First Name</label>
    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="John">
  </div>
  <div class="form-group">
    <label for="last_name" class="control-label">Last Name</label>
    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Kennedy">
  </div>
  <div class="form-group">
    <label for="public" class="control-label">Public Viewable</label>
    <select id="public"class="form-control" name="public">
		<option value="false" selected="selected">False</option>
		<option value="true">True</option>
	</select>
  </div>
  <div class="form-group">
    <label for="email" class="control-label">Email</label>
	<input type="email" class="form-control" id="email" name="email" placeholder="youremail@domain.com">
  </div>
  <div class="form-group">
    <label for="job_title" class="control-label">Job Title</label>
      <input type="text" class="form-control" id="job_title" name="job_title" placeholder="President">
  </div>
  <div class="form-group">
    <label for="company" class="control-label">Company</label>
      <input type="text" class="form-control" id="company" name="company" placeholder="Government">
  </div>
  <div class="form-group">
	<!-- Split button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
	    Add Social Network Information <span class="caret"></span>
	  <span class="sr-only">Social Networks</span>
	  </button>
	  <ul class="dropdown-menu" role="menu">
	    #SPEAKER_SOCIAL_TYPE#
	  </ul>
	</div>
	<div class="social_options">
	</div>
  </div>
  <div class="form-group">
    <label for="status" class="control-label">Speaker Status</label>
    <select id="status"class="form-control" name="status">
		#SPEAKER_STATUS_TYPE#
	</select>
  </div>
  <div class="form-group">
    <div class="">
      <button type="submit" class="btn btn-block btn-primary">Add Speaker</button>
    </div>
  </div>
</form>
<div class="modal fade"  id="mySocialNetworkModal" tabindex="-1" role="dialog" aria-labelledby="mySocialNetworkModalLabel" aria-hidden="true">
  
</div><!-- /.modal -->