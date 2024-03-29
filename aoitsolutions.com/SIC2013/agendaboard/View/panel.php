<div class="innerLeftColumn_#ROOM#">
	<div class='#PANEL_CSS# #EVENT_ID#'>
		<div class="row"> 
			<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 innerRightColumn_#ROOM#'>
				<small class='text-left makesmaller'><label class='#TRACK_LABEL#'>#TRACK#</label></small>
				<small class='text-left makesmaller'><b>#SESSION_NAME#</b></small>
				<br>
				<br>
				#SPEAKER_INFORMATION#		
				<!--<small class='text-left #ROOM_IS_FULL_LABEL#'>#ROOM_IS_FULL_MSG#</small>-->
				<!-- <small class='text-left #STATUS_LABEL#'>#STATUS#</small>-->
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">#TWITTER#</div>
		</div>	
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="#EVENT_ID#_MODAL" tabindex="-1" role="dialog" aria-labelledby="#EVENT_ID#_MODAL_LABEL" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header innerLeftColumnModal_#ROOM#">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">#SESSION_NAME#</h4>
      </div>
      <div class="modal-body">
		<small class='text-left makesmaller'><label class='#TRACK_LABEL#'>#TRACK#</label></small>
	    <h4>Summary</h4>
	   	#SESSION_ABSTRACT#
	    <h5>Topics Covered</h5>
	   	#TOPICS#
	    <h4>Speaker(s)</h4>
	   	#SPEAKER_INFORMATION_MODAL#	
		<h4>More Information</h4>
		<ul>
			<li>#ROOM_NO#</li>
			<li>#TIME#</li>
		 	<li><a href="http://2013.seattleinteractive.com/sessions/#EVENT_ID#" target="_blank">View Full Details</a></li>
		</ul>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
$(".#PANEL_CSS#").on('mouseover',function(){
	$(this).addClass("eventOverlay");
});
$(".#PANEL_CSS#").on('mouseout',function(){
	$(this).removeClass("eventOverlay");
});
$(".#EVENT_ID#").on('click',function(){
	$('##EVENT_ID#_MODAL').modal('show');
});
</script>
