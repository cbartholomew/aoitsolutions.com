<div class='container'>
	<ul class="nav nav-tabs nav-justified">
		<li class="active"><a href="#speaker"  data-toggle="tab">Speaker</a></li>
		<li><a href="#topic" 	data-toggle="tab">Topic</a></li>
		<li><a href="#track"  	data-toggle="tab">Track</a></li>
		<li><a href="#status"  	data-toggle="tab">Status</a></li>
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
			        <input id="search" type="text" class="form-control col-sm-3" placeholder="Search" />
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
							<th>Action</th>
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
				
			</div>
			<div class="panel col-sm-6">
				
			</div>
		</div>
		<div class="tab-pane fade"  id="track">
			<div class="panel col-sm-6">
				
			</div>
			<div class="panel col-sm-6">
				
			</div>
		</div>
		<div class="tab-pane fade"  id="status">
			<div class="panel col-sm-6">
				
			</div>
			<div class="panel col-sm-6">
				
			</div>
		</div>
	</div>
</div>