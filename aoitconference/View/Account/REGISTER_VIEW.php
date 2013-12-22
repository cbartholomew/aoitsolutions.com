<div class='container'>	
	<div class='col-sm-4'></div>
	<div class='col-sm-4'>
		<form class="form" role="form" action="index.php" method="POST">
		  <input type="hidden" name="method" value="" /> 
		  <input type="hidden" name="m" value="registration" /> 
		  <div class="form-group">
		    <label for="email" class="control-label">Email</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="youremail@domain.com">
		  </div>
		  <div class="form-group">
		    <label for="first_name" class="control-label">First Name</label>
		    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Abe">
		  </div>
		  <div class="form-group">
		    <label for="last_name" class="control-label">Last Name</label>
		    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Lincoln">
		  </div>
		  <div class="form-group">
		    <label for="org_name" class="control-label">Organization Name</label>
		      <input type="text" class="form-control" id="org_name" name="org_name" placeholder="The White House">
		  </div>
		  <div class="form-group">
		    <div class="">
		      <button type="submit" class="btn btn-block btn-primary">Register</button>
		    </div>
		  </div>
		</form>
	</div>
	<div class='col-sm-4'></div>
</div>