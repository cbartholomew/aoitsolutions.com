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
	$sessions 	= Session::get(2,16);
	$speakers 	= Speaker::get(2,17);
	$sponsors   = Sponsor::get(2,18);
	$speakerByEntryId = Speaker::getByEntryId(600);
	
	$json_data = file_get_contents('Configuration/Agenda.json');
	$agenda    = json_decode($json_data,true);
	
	$arguments = array(
				"sessions"   		=> $sessions,
				"speakers" 	 		=> $speakers,
				"sponsors"			=> $sponsors,
				"speakerByEntryId"  => $speakerByEntryId,
				"agenda"			=> $agenda
			);
	
	$viewManager->renderView("agenda",$arguments);
?>