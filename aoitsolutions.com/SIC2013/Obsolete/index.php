<?php
	require("includes/config.php");
	require("Model/ViewManager.php");
	require("Controller/Category.php");
	require("Controller/Session.php");
	require("Controller/Speaker.php");
	require("Controller/Sponsor.php");
	
	// make new view manager
	$viewManager = new ViewManager();
	
	// get business objects by site_id and channel id
	// OBSOLETE - JSON Direct URL covers this
	$sessions 	= Session::get(2,16);
	$speakers 	= Speaker::get(2,17);
	$sponsors   = Sponsor::get(2,18);
	$speakerByEntryId = Speaker::getByEntryId(600);

	
	// get the agenda board configuration
	$agenda_json = file_get_contents('Configuration/Agenda.json');
	$agenda    = json_decode($agenda_json,true);
	
	
	
	// pass the arguments to the view
	$arguments = array(
				"sessions"   		=> $sessions,
				"speakers" 	 		=> $speakers,
				"sponsors"			=> $sponsors,
				"speakerByEntryId"  => $speakerByEntryId,
				"agenda"			=> $agenda
			);
	// render view
	$viewManager->renderView("agenda",$arguments);
	// Template used for testing until they enter the data
	// for($i=0,$n=$agenda["RoomCount"];$i<$n;$i++)
	// {			
	// 	$backgroundCls = GetBackgroundCSS($room["Number"]);
	// 	
	// 	$sessionHtml = "TBD";
	// 							
	// 	// extract the room
	// 	$room = $agenda["Rooms"][$i];																
	// 	print("<td class='". $columnCls . " " . $backgroundCls . " sessionColumn " . 
	// 		   str_replace(":","_",$s["Start"]) . "_" . $room["Number"] ."'>" .
	// 		   $sessionHtml . "</td>");
	// }
?>
