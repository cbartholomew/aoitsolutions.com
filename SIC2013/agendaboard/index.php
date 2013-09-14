<?php
	require("includes/config.php");
	require("Model/ViewManager.php");
	require("Controller/Category.php");
	require("Controller/Session.php");
	require("Controller/Speaker.php");
	
	// make new view manager
	$viewManager = new ViewManager();
	
	// get business objects by site_id and channel id
	$sessions 	= Session::get(2,16);
	$speakers 	= Speaker::get(2,17);
	$speakerByEntryId = Speaker::getByEntryId(600);
	
	$arguments = array(
				"sessions"   		=> $sessions,
				"speakers" 	 		=> $speakers,
				"speakerByEntryId"  => $speakerByEntryId
			);
	
	$viewManager->renderView("agenda",$arguments);
?>