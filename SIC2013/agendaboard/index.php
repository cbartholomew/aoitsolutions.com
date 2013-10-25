<?php
	require("includes/config.php");
	require("Model/ViewManager.php");
	require("Model/TwitterSearchAPI.php");
	require("Controller/Session.php");
	
	// get date from query string - change to actual date before conference	
	$dayNo =  (isset($_GET["dayno"])) ? $_GET["dayno"] : 0;
	
	// make new view manager
	$viewManager = new ViewManager();
	
	// get the agenda board configuration
	$agenda_uri  = (IS_PROD) ? JSON_AGENDA_PROD_URI : JSON_AGENDA_URI;
	$agenda_json = file_get_contents($agenda_uri);
	$agenda      = json_decode($agenda_json,true);
	
	// get the sessions via json
	$session_uri  = (IS_PROD) ? JSON_SESSION_PROD_URI : JSON_SESSION_TEST_URI;
	$session_json = file_get_contents($session_uri);
	$sessions     = json_decode($session_json, true);
	$session = new Session(count($sessions["Sessions"]));
	
	// get current header
	$headerImage = GetHeader($dayNo);
	
	// pass the arguments to the view
	$arguments = array(
				"sessions"   		=> $sessions["Sessions"],
				"agenda"			=> $agenda,
				"headerImage"		=> $headerImage,
				"day"				=> $dayNo,
				"session"			=> $session,
				"viewManager"		=> $viewManager				
			);
	// render view
	$viewManager->renderView("agenda",$arguments);
	//$viewManager->renderView("agendatest",$arguments);	
?>