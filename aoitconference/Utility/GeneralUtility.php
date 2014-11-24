<?php
	
function PostSessionIdentity($userAccess)
{
	if(!UserAccessController::Post($userAccess))
	{
		Redirect("?m=login");
	}
	else
	{
		$_SESSION["identity"] = $userAccess->_accountIdentity;
	}
}

function PutSession($userAccess)
{
	// set the updated last request dttm
	$userAccess->_lastRequestDttm = date('Y-m-d H:i:s');
	
	// error - redirect due to unauthorized
	if(!UserAccessController::Put($userAccess))
	{
		Redirect("?m=login");
	}		
	
}	

function NotAuthorized()
{
 	// return json instead of re-rendering
 	header('Content-Type: application/json');
	http_response_code(401);
 	print json_encode(array("status" => 401));
}

function BadRequest()
{
 	// return json instead of re-rendering
 	header('Content-Type: text/html');
	
	http_response_code(400);
 	
	exit;
}

function CheckAuth($userAccess)
{
	return isset($userAccess->_accountIdentity);		
}

function GetSession($userAccess)
{
	if(!isset($userAccess))
	{
		Redirect("?m=login");
	}
	
	// check if the session even has an identity assigned to it
	if(isset($_SESSION['identity']))
	{
		// check if it's the correct identity based on the database
		$userAccess = UserAccessController::Get($userAccess);
		
		// check if the sesion is expired
		if(IsSessionNotExpired($userAccess))
		{
			return $userAccess;
		}
		else 
		{
			Signout();
		}
	}

	return $userAccess;
}	

function IsSessionNotExpired($userAccess)
{
	// get current dttm
	$now = date('Y-m-d H:i:s');	
	
	// get last requested dttm
	$lastRequestedDttm = $userAccess->_lastRequestDttm;
	
	// convert times
	$to_time   = strtotime($now);
	$from_time = strtotime($lastRequestedDttm);
	
	// if the result is more than the constant, expire
	if(round(abs($to_time - $from_time) / 60,2) > SESSION_EXPIRE)
	{
		// session expired
		return false;
	}
			
	// session ok
	return true;
}	

function Signout()
{
    // unset any session variables
    unset($_SESSION);
	
    // expire cookie
    if (!empty($_COOKIE[session_name()]))
    {
        setcookie(session_name(), "", time() - 42000);
    }

    // destroy session
    session_destroy();
	
	Redirect("");
}	

function Redirect($destination)
{
	 // handle URL
    if (preg_match("/^https?:\/\//", $destination))
    {
        header("Location: " . $destination);
    }
    
    // handle absolute path
    else if (preg_match("/^\//", $destination))
    {
        $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
        $host = $_SERVER["HTTP_HOST"];
        header("Location: $protocol://$host$destination");
    }
    
    // handle relative path
    else
    {
        // adapted from http://www.php.net/header
        $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
        $host = $_SERVER["HTTP_HOST"];
        $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
        header("Location: $protocol://$host$path/$destination");
    }
    
    // exit immediately since we're redirecting anyway
    exit;
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
		case "venue":
			// get topic information
			$modalObject = VenueController::GetById(new Venue(array(
				"VENUE_IDENTITY" 	=> $requestIdentity,
				"ACCOUNT_IDENTITY" 	=> $userAccess->_accountIdentity,
				"NAME"            	=> null,
				"IMAGE"            	=> null,
				"IMAGE_URL"			=> null,
				"CAPACITY"         	=> null,
				"ADDRESS"           => null,
				"CITY"            	=> null,
  				"STATE"				=> null,
  				"ZIP"               => null,
  				"COUNTRY"           => null,
  				"PUBLIC_USE"		=> null,
				"DISABLED"			=> null
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
					new View("DELETE_VENUE_TABLE_VIEW",
							 "Delete/DELETE_VENUE_TABLE_VIEW.php",
							 $arguments));
				
				// get the html from the view controller
				$modalObjectInformation = $modalViewController->renderViewHTML(false,false);
			}
		break;
		// CREATE ONE FOR ROOM
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