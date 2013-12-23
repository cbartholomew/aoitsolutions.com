<div class='container'>
	<ul class="nav nav-tabs nav-justified" id="createTabs">
		<li class="active"><a href="#speaker"  data-toggle="tab">Speaker</a></li>
		<li><a href="#topic" 	data-toggle="tab">Topic</a></li>
		<li><a href="#track"  	data-toggle="tab">Track</a></li>
		<li><a href="#newstatus"  	data-toggle="tab">Status</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane fade in active" id="speaker">
			<div id="speaker_panel" class="panel col-sm-6">
				#SPEAKER_VIEW#
			</div>
			<div class="panel col-sm-6">
			<br>
				<form class="form-horizontal" role="search">
			    	<div class="form-group">
			        	<input id="speaker_search" type="text" class="form-control col-sm-3" placeholder="Search" />
			      	</div>
			    </form>
				<!--Auto Render This -->
				<table class='table table-condensed'>
					<thead>
						<tr>
							<th>First</th>
							<th>Last</th>
							<th>Email</th>
							<th>Company</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody class="speakers">
						#SPEAKER_LIST_VIEW#
					</tbody>					
				</table>
			</div>
		</div>
		<div class="tab-pane fade"  id="topic">
			<div id="topic_panel" class="panel col-sm-6">
				#TOPIC_VIEW#
			</div>
			<div class="panel col-sm-6">
			<br>
				<form class="form-horizontal" role="search">
			    	<div class="form-group">
			        	<input id="topic_search" type="text" class="form-control col-sm-3" placeholder="Search" />
			      	</div>
			    </form>
				<table class='table table-condensed'>
					<thead>
						<tr>
							<th>Name</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody class="topics">
						#TOPIC_LIST_VIEW#
					</tbody>					
				</table>
			</div>
		</div>
		<div class="tab-pane fade"  id="track">
			<div id="track_panel" class="panel col-sm-6">
				#TRACK_VIEW#
			</div>
			<div class="panel col-sm-6">
			<br>
				<form class="form-horizontal" role="search">
			    	<div class="form-group">
			        	<input id="track_search" type="text" class="form-control col-sm-3" placeholder="Search" />
			      	</div>
			    </form>
				<table class='table table-condensed'>
					<thead>
						<tr>
							<th>Name</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody class="tracks">
						#TRACK_LIST_VIEW#
					</tbody>					
				</table>
			</div>
		</div>
		<div class="tab-pane fade"  id="newstatus">
			<div id="status_panel" class="panel col-sm-6">
				#STATUS_VIEW#
			</div>
			<div class="panel col-sm-6">
			<br>
				<form class="form-horizontal" role="search">
			    	<div class="form-group">
			        	<input id="status_search" type="text" class="form-control col-sm-3" placeholder="Search" />
			      	</div>
			    </form>
				<table class='table table-condensed'>
					<thead>
						<tr>
							<th>Name</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody class="allstatus">
						#STATUS_LIST_VIEW#
					</tbody>					
				</table>
			</div>
		</div>
	</div>
</div>