<form id="create_speaker_form" class="form" role="form" action="index.php" method="#METHOD#">
  <input type="hidden" id="m" name="m" value="create_speaker" /> 
  <input type="hidden" id="speaker_identity" name="speaker_identity" value="" /> 
  <input type="hidden" id="speaker_being_updated" value="0" />
  <input type="hidden" id="method" name="method" value="POST" /> 
  <div class="form-group">
    <label for="first_name" class="control-label">First Name</label>
    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="John" 		value="#SPEAKER_FIRST_NAME#" required />
  </div>
  <div class="form-group">
    <label for="last_name" class="control-label">Last Name</label>
    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Kennedy" 		value="#SPEAKER_LAST_NAME#" required />
  </div>
  <div class="form-group">
    <label for="public" class="control-label">Public Viewable</label>
    <select id="public"class="form-control" name="public">
		<option value="0" selected="selected">False</option>
		<option value="1">True</option>
	</select>
  </div>
  <div class="form-group">
    <label for="email" class="control-label">Email</label>
	<input type="email" class="form-control" id="email" name="email" placeholder="youremail@domain.com" value="#SPEAKER_EMAIL#" required />
  </div>
  <div class="form-group">
    <label for="job_title" class="control-label">Job Title</label>
      <input type="text" class="form-control" id="job_title" name="job_title" placeholder="President" 	value="#SPEAKER_JOB_TITLE#" />
  </div>
  <div class="form-group">
      <label for="company" class="control-label">Company</label>
      <input type="text" class="form-control" id="company" name="company" placeholder="Government" 		value="#SPEAKER_COMPANY#" />
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
		#SPEAKER_SOCIAL_OPTIONS#
	</div>
  </div>
  <div class="form-group">
    <label for="status" class="control-label">Speaker Status</label>
    <select id="status"class="form-control" name="status">
		#SPEAKER_STATUS_TYPE#
	</select>
  </div>
  <div class="form-group">
    <div class="btn-controls">
      <button type="submit" class="btn btn-block btn-primary btn-speaker-submit">#ACTION# Speaker</button>
    </div>
  </div>
</form>
<div class="modal fade"  id="mySocialNetworkModal" tabindex="-1" role="dialog" aria-labelledby="mySocialNetworkModalLabel" aria-hidden="true">
</div><!-- /.modal -->