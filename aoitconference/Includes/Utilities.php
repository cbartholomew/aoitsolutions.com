<?php









function GetRoomListViewHTML($userAccess, $venue)
{

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