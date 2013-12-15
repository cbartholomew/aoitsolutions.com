<div class='container'>	
	<div class='col-sm-4'></div>
	<div class='col-sm-4'>
		<form class="form" role="form" action="index.php" method="POST">
		  <input type="hidden" name="m" value="login" /> 
		  <div class="form-group #ERROR_STATUS#">
		    <label for="email" class="control-label">Email</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="youremail@domain.com">
		  </div>
		  <div class="form-group #ERROR_STATUS#">
		    <label for="password" class="control-label">Password</label>
		    <input type="password" class="form-control" id="password" name="password">
		  </div>
		  <div class="form-group">
		    <div class="">
		      <button type="submit" class="btn btn-block btn-success">Login</button>
		    </div>
		  </div>
		</form>
	</div>
	<div class='col-sm-4'></div>
</div>