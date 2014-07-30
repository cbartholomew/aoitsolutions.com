<?php

	
	
	

	


function GetStateHTML($venue)
{
	$html = "";
	
	// keeping consistent with the template
	$defaultStateId = 51;
	// get all statuses avaliable by null or or account identity
	$allStates = StateController::GetAll();
	
	// ensure first is selected	
	$selected = "selected='selected'";
	
	if(count($allStates) <= 0)
		return "<option value=0 selected=selected value=''>Problem returning state list!</option>";
	
	// no speaker
	if(!isset($venue))
	{
		foreach($allStates as $state)
		{
			if($state->_stateIdentity == $defaultStateId)
			{
				// make the default state id the default
				$selected = "selected='selected'";
			}
			else 
			{
				$selected = "";
			}
			
			$html .= "<option value='" . $state->_stateIdentity . "' ". $selected .">". $state->_name ."</option>";
		}
	}
	else
	{
		foreach($allStates as $state)
		{
			if($state->_stateIdentity == $venue->_state)
			{
				$selected = "selected='selected'";
			}
			else
			{
				$selected = "";
			}
			
			$html .= "<option value='" . $state->_stateIdentity . "' ". $selected .">". $state->_name ."</option>";	
		}
	}
	
	return $html;
}

function GetSpeakerListViewHTML($userAccess)
{
	// define and init html for speaker
	$html = "";
	
	try
	{					
		// init new speaker array
		$s = new Speaker(array(
			"SPEAKER_IDENTITY"	 => null,
			"ACCOUNT_IDENTITY"   => $userAccess->_accountIdentity,
			"FIRST_NAME"	     => null,
			"LAST_NAME"          => null,
			"EMAIL_ADDRESS"      => null,
			"PUBLIC"             => null,
			"STATUS"             => null,
			"COMPANY"	         => null,
			"JOB_TITLE"	         => null
		));
	
		// get list of speakers by account identity
		$speakers = SpeakerController::Get($s);
	
		if(count($speakers) <= 0)
		{
			$html .= "<tr>";
			$html .= "<td colspan='5'>This account has no speakers available</td>";
			$html .= "</tr>";	
		}
		else
		{
			foreach($speakers as $speaker)
			{
				$btnManageHtml = "<button type='button' onclick='manage(this);' operation='speaker' id='manage_speaker_" . $speaker->_speakerIdentity . "' 
				class='btn btn-default'><i class='glyphicon glyphicon-wrench inverse'></i></button>";
			
				$btnRemoveHtml = "<button type='button' onclick='prompt(this);' operation='speaker' id='delete_speaker_" . $speaker->_speakerIdentity .  "' 
				class='btn btn-default'><i class='glyphicon glyphicon-minus inverse'></i></button>";
			
				$html .= "<tr>";
				$html .= "<td>" . $speaker->_firstName	  . "</td>";
				$html .= "<td>" . $speaker->_lastName	  . "</td>";
				$html .= "<td>" . $speaker->_emailAddress . "</td>";
				$html .= "<td>" . $speaker->_company	  . "</td>";
				$html .= "<td><div class='btn-group btn-group-xs'>" .  $btnManageHtml . $btnRemoveHtml . "</div></td>";		
				$html .= "</tr>";
			}
		}
	}
	catch(Exception $e)
	{
			trigger_error($e->getMessage(), E_USER_ERROR);
	}
	return $html;
}

function GetTopicListViewHTML($userAccess)
{
	// define and init html for speaker
	$html = "";
	
	try
	{					
		// init new speaker array
		$t = new Topic(array(
			"TOPIC_IDENTITY"	 => null,
			"ACCOUNT_IDENTITY"   => $userAccess->_accountIdentity,
			"NAME"	     		 => null
		));
	
		// get list of speakers by account identity
		$topics = TopicController::Get($t);
	
		if(count($topics) <= 0)
		{
			$html .= "<tr>";
			$html .= "<td colspan='2'>This account has no Topics available</td>";
			$html .= "</tr>";	
		}
		else
		{
			foreach($topics as $topic)
			{
				$btnManageHtml = "<button type='button' onclick='manage(this);' operation='topic' id='manage_topic_" . $topic->_topicIdentity . "' 
				class='btn btn-default'><i class='glyphicon glyphicon-wrench inverse'></i></button>";
			
				$btnRemoveHtml = "<button type='button' onclick='prompt(this);' operation='topic' id='delete_topic_" . $topic->_topicIdentity .  "' 
				class='btn btn-default'><i class='glyphicon glyphicon-minus inverse'></i></button>";
			
				$html .= "<tr>";
				$html .= "<td>" . $topic->_name . "</td>";
				$html .= "<td><div class='btn-group btn-group-xs'>" .  $btnManageHtml . $btnRemoveHtml . "</div></td>";		
				$html .= "</tr>";
			}
		}
	}
	catch(Exception $e)
	{
			trigger_error($e->getMessage(), E_USER_ERROR);
	}
	return $html;
}

function GetTrackListViewHTML($userAccess)
{
	// define and init html for speaker
	$html = "";
	
	try
	{					
		// init new speaker array
		$t = new Track(array(
			"TRACK_IDENTITY"	 => null,
			"ACCOUNT_IDENTITY"   => $userAccess->_accountIdentity,
			"NAME"	     		 => null
		));
	
		// get list of speakers by account identity
		$tracks = TrackController::Get($t);
	
		if(count($tracks) <= 0)
		{
			$html .= "<tr>";
			$html .= "<td colspan='2'>This account has no Tracks available</td>";
			$html .= "</tr>";	
		}
		else
		{
			foreach($tracks as $track)
			{
				$btnManageHtml = "<button type='button' onclick='manage(this);' operation='track' id='manage_track_" . $track->_trackIdentity . "' 
				class='btn btn-default'><i class='glyphicon glyphicon-wrench inverse'></i></button>";
			
				$btnRemoveHtml = "<button type='button' onclick='prompt(this);' operation='track' id='delete_track_" . $track->_trackIdentity .  "' 
				class='btn btn-default'><i class='glyphicon glyphicon-minus inverse'></i></button>";
			
				$html .= "<tr>";
				$html .= "<td>" . $track->_name . "</td>";
				$html .= "<td><div class='btn-group btn-group-xs'>" .  $btnManageHtml . $btnRemoveHtml . "</div></td>";	
				$html .= "</tr>";
			}
		}
	}
	catch(Exception $e)
	{
			trigger_error($e->getMessage(), E_USER_ERROR);
	}
	return $html;
}

function GetVenueListViewHTML($userAccess)
{
	$html = "";

	try
	{					
		// init new venue array
    	$v = new Venue(array(
	    	"VENUE_IDENTITY" 	=> null,
	    	"ACCOUNT_IDENTITY" 	=> $userAccess->_accountIdentity,
	    	"NAME"            	=> null,
	    	"IMAGE"            	=> null,
	    	"CAPACITY"         	=> null,
	    	"ADDRESS"           => null,
	    	"CITY"            	=> null,
	      	"STATE"				=> null,
	      	"ZIP"               => null,
	      	"COUNTRY"           => null
	    ));

		// get list of speakers by account identity
		$venues = VenueController::Get($v);

		if(count($venues) <= 0)
		{
			$html .= "<tr>";
			$html .= "<td colspan='7'>This account has no venues available</td>";
			$html .= "</tr>";	
		}
		else
		{
			foreach($venues as $venue)
			{
				$btnManageHtml = "<button type='button' onclick='manage(this);' operation='track' id='manage_venue_" . $venue->_venueIdentity . "' 
				class='btn btn-default'><i class='glyphicon glyphicon-wrench inverse'></i></button>";

				$btnRemoveHtml = "<button type='button' onclick='prompt(this);' operation='track' id='delete_venue_" . $venue->_venueIdentity .  "' 
				class='btn btn-default'><i class='glyphicon glyphicon-minus inverse'></i></button>";

				// create new state variable w/ state id from venue
				$state = new State(array(
					"STATE_IDENTITY"	=> $venue->_state,
					"NAME"				=> null
				));

				// get the state by state identity
				$state = StateController::Get($state);

				$html .= "<tr>";
				$html .= "<td><img  class ='img-thumbnail' src='" . $venue->_image 	. "' alt='" . $venue->_image . "' height=100 width=100 /></td>";
				$html .= "<td>" . $venue->_name 	. "</td>";
				$html .= "<td>" . $venue->_address 	. "</td>";
				$html .= "<td>" . $venue->_city 	. "</td>";
				$html .= "<td name='" . $venue->_state . "'>" . $state->_name	. "</td>";
				$html .= "<td>" . $venue->_zip 		. "</td>";
				$html .= "<td><div class='btn-group btn-group-xs'>" .  $btnManageHtml . $btnRemoveHtml . "</div></td>";	
				$html .= "</tr>";
			}
		}
	}
	catch(Exception $e)
	{
			trigger_error($e->getMessage(), E_USER_ERROR);
	}
	
	return $html;
}

function GetRoomListViewHTML($userAccess, $venue)
{

}

function GetStatusListViewHTML($userAccess)
{
	// define and init html for speaker
	$html = "";
	
	try
	{					
		// init new speaker array
		$s = new Status(array(
			"STATUS_IDENTITY"	 => null,
			"ACCOUNT_IDENTITY"   => $userAccess->_accountIdentity,
			"NAME"	     		 => null
		));
	
		// get list of speakers by account identity
		$statuses = StatusController::Get($s);
	
		if(count($statuses) <= 0)
		{
			$html .= "<tr>";
			$html .= "<td colspan='2'>This account has no Statuses available</td>";
			$html .= "</tr>";	
		}
		else
		{
			foreach($statuses as $status)
			{
					$btnManageHtml = "<button type='button' onclick='manage(this);' operation='status' id='manage_status_" . 
					$status->_statusIdentity . "' class='btn btn-default'><i class='glyphicon glyphicon-wrench inverse'></i></button>";
			
					$btnRemoveHtml = "<button type='button' onclick='prompt(this);' operation='status' id='delete_status_" . 
					$status->_statusIdentity . "' class='btn btn-default'><i class='glyphicon glyphicon-minus inverse'></i></button>";
				
					$html .= "<tr>";
					$html .= "<td>" . $status->_name . "</td>";
					$html .= "<td><div class='btn-group btn-group-xs'>" .  $btnManageHtml . $btnRemoveHtml . "</div></td>";	
					$html .= "</tr>";
			}
		}
	}
	catch(Exception $e)
	{
			trigger_error($e->getMessage(), E_USER_ERROR);
	}
	return $html;
}

function GetEventTypeListViewHTML($userAccess)
{
	// define and init html for speaker
	$html = "";
	
	try
	{					
		// init new speaker array
		$eType = new EventType(array(
			"EVENT_TYPE_IDENTITY"	 => null,
			"ACCOUNT_IDENTITY"   	 => $userAccess->_accountIdentity,
			"NAME"	     			 => null
		));
	
		// get list of event types by account identity
		$eventTypes = EventTypeController::Get($eType);
	
		if(count($eventTypes) <= 0)
		{
			$html .= "<tr>";
			$html .= "<td colspan='2'>This account has no event types available</td>";
			$html .= "</tr>";	
		}
		else
		{
			foreach($eventTypes as $eventType)
			{
					$btnManageHtml = "<button type='button' onclick='manage(this);' operation='eventtype' id='manage_eventtype_" . 
					$eventType->_eventTypeIdentity . "' class='btn btn-default'><i class='glyphicon glyphicon-wrench inverse'></i></button>";
			
					$btnRemoveHtml = "<button type='button' onclick='prompt(this);' operation='eventtype' id='delete_eventtype_" . 
					$eventType->_eventTypeIdentity . "' class='btn btn-default'><i class='glyphicon glyphicon-minus inverse'></i></button>";
				
					$html .= "<tr>";
					$html .= "<td>" . $eventType->_name . "</td>";
					$html .= "<td><div class='btn-group btn-group-xs'>" .  $btnManageHtml . $btnRemoveHtml . "</div></td>";	
					$html .= "</tr>";
			}
		}
	}
	catch(Exception $e)
	{
			trigger_error($e->getMessage(), E_USER_ERROR);
	}
	return $html;
}

function GetPromptPath($requestedAction)
{
	$name   	= "";
	$filePath   = "";
	
	switch($requestedAction)
	{
		case "delete":
			$name = "GENERIC_DELETE_MODAL_VIEW";
			$filePath = "Prompt/GENERIC_DELETE_MODAL_VIEW.php";
		break;
		
		case "alert":
			$name = "GENERIC_ALERT_MODAL_VIEW";
			$filePath = "Prompt/GENERIC_ALERT_MODAL_VIEW.php";
		break;
	}
	
	return array(
		"name" => $name,
		"filePath" => $filePath
	);
}

function GetPromptObject($userAccess, $requestAction, $requestType, $requestIdentity)
{
	$arguments = array();
	
	$modalObject = null;
	$modalObjectName = "";
	$modalObjectType = "";
	$modalObjectInformation = "";
	$modalObjectIdentity	= "";
	$modalObjectAction		= "";
	
	// assign variables
	$modalObjectType   		= $requestType;
	$modalObjectAction 		= $requestAction;
	$modalObjectIdentity	= $requestIdentity;
	
		
	switch($requestType)
	{
		case "speaker":
			// get speaker from controller
			$modalObject = SpeakerController::GetById(new Speaker(array(
				"SPEAKER_IDENTITY"	 => $requestIdentity,
				"ACCOUNT_IDENTITY"   => $userAccess->_accountIdentity,
				"FIRST_NAME"	     => null,
				"LAST_NAME"          => null,
				"EMAIL_ADDRESS"      => null,
				"PUBLIC"             => null,
				"STATUS"             => null,
				"COMPANY"	         => null,
				"JOB_TITLE"	         => null
			)));
			
			if(isset($modalObject))
			{
				$modalObjectName   = $modalObject->_firstName . " " . $modalObject->_lastName;
				
				// create the request action
				switch($requestAction)
				{
					case "delete":
						$modalObjectAction = "purge(this);";  
					break;
					case "alert":
						$modalObjectAction = "alertUser(this);";  
					break;
				}
				
				// push the view arguments in the array
				array_push($arguments,View::MakeViewArgument("MODAL_OBJECT_FIRST_NAME",$modalObject->_firstName));
				array_push($arguments,View::MakeViewArgument("MODAL_OBJECT_LAST_NAME",$modalObject->_lastName));
				array_push($arguments,View::MakeViewArgument("MODAL_OBJECT_EMAIL_ADDRESS",$modalObject->_emailAddress));
				array_push($arguments,View::MakeViewArgument("MODAL_OBJECT_REQUEST_IDENTITY",$requestIdentity));
				
				// apply special arguments to speaker list view
				$modalViewController = new ViewController(
					new View("DELETE_SPEAKER_MODAL_VIEW",
							 "Delete/DELETE_SPEAKER_TABLE_VIEW.php",
							 $arguments));
				
				// get the html from the view controller
				$modalObjectInformation = $modalViewController->renderViewHTML(false,false);
			}
		break;
		case "topic":
			// get topic information
			$modalObject = TopicController::GetById(new Topic(array(
				"TOPIC_IDENTITY"	=> $requestIdentity,
				"ACCOUNT_IDENTITY"  => $userAccess->_accountIdentity,
				"NAME"				=> null
			)));
			
			if(isset($modalObject))
			{
				$modalObjectName   = $modalObject->_name;
				
				// create the request action
				switch($requestAction)
				{
					case "delete":
						$modalObjectAction = "purge(this);";  
					break;
					case "alert":
						$modalObjectAction = "alertUser(this);";  
					break;
				}
				
				// push the view arguments in the array
				array_push($arguments,View::MakeViewArgument("MODAL_OBJECT_NAME",$modalObject->_name));
				array_push($arguments,View::MakeViewArgument("MODAL_OBJECT_REQUEST_IDENTITY",$requestIdentity));
				
				// apply special arguments to speaker list view
				$modalViewController = new ViewController(
					new View("DELETE_TOPIC_TABLE_VIEW",
							 "Delete/DELETE_TOPIC_TABLE_VIEW.php",
							 $arguments));
				
				// get the html from the view controller
				$modalObjectInformation = $modalViewController->renderViewHTML(false,false);
			}
		break;
		case "track":
			// get topic information
			$modalObject = TrackController::GetById(new Track(array(
				"TRACK_IDENTITY"	=> $requestIdentity,
				"ACCOUNT_IDENTITY"  => $userAccess->_accountIdentity,
				"NAME"				=> null
			)));
			
			if(isset($modalObject))
			{
				$modalObjectName   = $modalObject->_name;
				
				// create the request action
				switch($requestAction)
				{
					case "delete":
						$modalObjectAction = "purge(this);";  
					break;
					case "alert":
						$modalObjectAction = "alertUser(this);";  
					break;
				}
				
				// push the view arguments in the array
				array_push($arguments,View::MakeViewArgument("MODAL_OBJECT_NAME",$modalObject->_name));
				array_push($arguments,View::MakeViewArgument("MODAL_OBJECT_REQUEST_IDENTITY",$requestIdentity));
				
				// apply special arguments to speaker list view
				$modalViewController = new ViewController(
					new View("DELETE_TRACK_TABLE_VIEW",
							 "Delete/DELETE_TRACK_TABLE_VIEW.php",
							 $arguments));
				
				// get the html from the view controller
				$modalObjectInformation = $modalViewController->renderViewHTML(false,false);
			}
		break;
		case "status":
			// get topic information
			$modalObject = StatusController::GetById(new Status(array(
				"STATUS_IDENTITY"	=> $requestIdentity,
				"ACCOUNT_IDENTITY"  => $userAccess->_accountIdentity,
				"NAME"				=> null
			)));
			
			if(isset($modalObject))
			{
				$modalObjectName   = $modalObject->_name;
				
				// create the request action
				switch($requestAction)
				{
					case "delete":
						$modalObjectAction = "purge(this);";  
					break;
					case "alert":
						$modalObjectAction = "alertUser(this);";  
					break;
				}
				
				// push the view arguments in the array
				array_push($arguments,View::MakeViewArgument("MODAL_OBJECT_NAME",$modalObject->_name));
				array_push($arguments,View::MakeViewArgument("MODAL_OBJECT_REQUEST_IDENTITY",$requestIdentity));
				
				// apply special arguments to speaker list view
				$modalViewController = new ViewController(
					new View("DELETE_STATUS_TABLE_VIEW",
							 "Delete/DELETE_STATUS_TABLE_VIEW.php",
							 $arguments));
				
				// get the html from the view controller
				$modalObjectInformation = $modalViewController->renderViewHTML(false,false);
			}
		break;
		case "eventtype":
			// get topic information
			$modalObject = EventTypeController::GetById(new EventType(array(
				"EVENT_TYPE_IDENTITY"	=> $requestIdentity,
				"ACCOUNT_IDENTITY"  	=> $userAccess->_accountIdentity,
				"NAME"					=> null
			)));
			
			if(isset($modalObject))
			{
				$modalObjectName   = $modalObject->_name;
				
				// create the request action
				switch($requestAction)
				{
					case "delete":
						$modalObjectAction = "purge(this);";  
					break;
					case "alert":
						$modalObjectAction = "alertUser(this);";  
					break;
				}
				
				// push the view arguments in the array
				array_push($arguments,View::MakeViewArgument("MODAL_OBJECT_NAME",$modalObject->_name));
				array_push($arguments,View::MakeViewArgument("MODAL_OBJECT_REQUEST_IDENTITY",$requestIdentity));
				
				// apply special arguments to speaker list view
				$modalViewController = new ViewController(
					new View("DELETE_EVENT_TYPE_TABLE_VIEW",
							 "Delete/DELETE_EVENT_TYPE_TABLE_VIEW.php",
							 $arguments));
				
				// get the html from the view controller
				$modalObjectInformation = $modalViewController->renderViewHTML(false,false);
			}
		break;
	}
	
	return array(
		"MODAL_OBJECT_NAME"			=>$modalObjectName,
		"MODAL_OBJECT_TYPE" 		=>$modalObjectType,
		"MODAL_OBJECT_INFORMATION" 	=>$modalObjectInformation ,
		"MODAL_OBJECT_IDENTITY" 	=>$modalObjectIdentity,	
		"MODAL_OBJECT_ACTION"		=>$modalObjectAction		
	);
	
}
?>