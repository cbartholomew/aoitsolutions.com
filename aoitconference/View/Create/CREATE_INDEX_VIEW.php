<div class='container'>
 	<!-- Define create attributes tab-->
	<ul class="nav nav-tabs nav-justified" id="createTabs">
		<li class="active"><a href="#speaker"  data-toggle="tab">Speaker</a></li>
		<li><a href="#topic" 		data-toggle="tab">Topic</a></li>
		<li><a href="#track"  		data-toggle="tab">Track</a></li>
		<li><a href="#newstatus"  	data-toggle="tab">Status</a></li>
		<li><a href="#eventtype"  	data-toggle="tab">Event Type</a></li>
		<li><a href="#venue"  		data-toggle="tab">Venue</a></li>
		<li><a href="#room"  		data-toggle="tab">Rooms</a></li>
	</ul>
	
	<!-- Begin Tab Content-->
	<div class="tab-content">
		
		<!-- Begin Speaker Tab Content-->
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
		<!-- End Speaker Tab Content-->
		
		<!-- Begin Topic Tab Content-->
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
		<!-- End Topic Tab Content-->
		
		<!-- Begin Track Tab Content-->
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
		<!-- End Track Tab Content-->
		
		<!-- Begin Status Tab Content-->
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
		<!-- End Status Tab Content-->
		
		<!-- Begin Event Type Tab Content-->
		<div class="tab-pane fade"  id="eventtype">
			<div id="eventtype_panel" class="panel col-sm-6">
				#EVENT_TYPE_VIEW#
			</div>
			<div class="panel col-sm-6">
			<br>
				<form class="form-horizontal" role="search">
			    	<div class="form-group">
			        	<input id="eventtype_search" type="text" class="form-control col-sm-3" placeholder="Search" />
			      	</div>
			    </form>
				<table class='table table-condensed'>
					<thead>
						<tr>
							<th>Name</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody class="eventtypes">
						#EVENT_TYPE_LIST_VIEW#
					</tbody>					
				</table>
			</div>
		</div>
		<!-- End Event Type Tab Content-->
		
		<!-- Begin Venue Tab Content-->
		<div class="tab-pane fade " id="venue">
			<div id="venue_panel" class="panel col-sm-6">
				#VENUE_VIEW#
			</div>
			<div class="panel col-sm-6">
 				<br>
					<form class="form-horizontal" role="search">
				    	<div class="form-group">
				        	<input id="venue_search" type="text" class="form-control col-sm-3" placeholder="Search" />
				      	</div>
				    </form>
					<table class='table table-condensed'>
						<thead>
							<tr>
								<th>Image</th>
								<th>Name</th>
								<th>Address</th>
								<th>City</th>
								<th>State</th>
								<th>Zip</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody class="venues">
							#VENUE_LIST_VIEW#
						</tbody>					
					</table>
			</div>
		</div>
		<!-- End Venue Tab Content-->

		<!-- Begin Room Tab Content-->
		<div class="tab-pane fade"  id="room">
			<div id="room_panel" class="panel col-sm-6">
				#  v#
			</div>
			<div class="panel col-sm-6">
			<br>
				<form class="form-horizontal" role="search">
			    	<div class="form-group">
			        	<input id="room_search" type="text" class="form-control col-sm-3" placeholder="Search" />
			      	</div>
			    </form>
				<table class='table table-condensed'>
					<thead>
						<tr>
							<th>Venue</th>
							<th>Name</th>
							<th>Number</th>
							<th>Capacity</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody class="rooms">
						#ROOM_LIST_VIEW#
					</tbody>					
				</table>
			</div>
		</div>
		<!-- End Room Tab Content-->
	</div> 
</div>
<!-- End Tab Content-->