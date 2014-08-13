<?php
function handleAccountRegistrationPost($request)
{
	$account = new Account(array(
		"IDENTITY"					=> null,
		"EMAIL_ADDRESS" 			=> $request["email"],
		"FIRST_NAME" 				=> $request["first_name"],
		"LAST_NAME"  				=> $request["last_name"],
		"ORGANIZATION_NAME" 		=> $request["org_name"],
		"ACCOUNT_TYPE_IDENTITY"  	=> 1,
		"ACCOUNT_DISABLED" 			=> false
	));						
						
	try
	{
		// post the request to the database
		AccountController::Post($account);
		
		// get the information back
		$account = AccountController::Get($account);
		
		// set the user up with some defaults
		BootstrapNewUser($account);
		
		// insert the account into the user_access database
		$lastRequestDttm = date('Y-m-d H:i:s');	
		
		$userAccess = new UserAccess(array(						
			"USER_ACCESS_INDEX" => null,
			"SESSION" 			=> session_id(), 	
			"CREATED_DTTM" 		=> $lastRequestDttm,
			"LAST_REQUEST_DTTM" => $lastRequestDttm,
			"ACCOUNT_IDENTITY" 	=> $account->_identity
		));
		
		PostSessionIdentity($userAccess);
		
		// get user access session
		$userAccess = GetSession($userAccess);
		
		// update the request
		PutSession($userAccess);
		
		// redirect to main page
		Redirect("");
		
	} 
	catch(Exception $e)
	{
		// trigger (big, orange) error
        trigger_error($e->getMessage(), E_USER_ERROR);
	}
}	
	
function handleAccountLoginPost($request)
{
	$arguments = array();

	$account = new Account(array(
		"IDENTITY"					=> null,
		"EMAIL_ADDRESS" 			=> $request["email"],
		"FIRST_NAME" 				=> "",
		"LAST_NAME"  				=> "",
		"ORGANIZATION_NAME" 		=> "",
		"ACCOUNT_TYPE_IDENTITY"  	=> 1,
		"ACCOUNT_DISABLED" 			=> false
	));
	try
	{
		// get the request to the database
		$account = AccountController::Get($account);
		
		// post session identity up
		if(isset($account->_identity))
		{
			// insert the account into the user_access database
			$lastRequestDttm = date('Y-m-d H:i:s');	

			$userAccess = new UserAccess(array(						
				"USER_ACCESS_INDEX" => null,
				"SESSION" 			=> session_id(), 	
				"CREATED_DTTM" 		=> $lastRequestDttm,
				"LAST_REQUEST_DTTM" => $lastRequestDttm,
				"ACCOUNT_IDENTITY" 	=> $account->_identity
			));
			
			// set the session
			PostSessionIdentity($userAccess);
			
			// set redirect route
			$redirectTo = ($request["return"] != "") ? "?m=" . $request["return"] : ""; 

			// redirect back to index
			Redirect($redirectTo);
		}
		else
		{
			// push view arguments on the argument array stack
			array_push($arguments, View::MakeViewArgument("ERROR_STATUS", "has-error"));
			array_push($arguments, View::MakeViewArgument("ACCOUNT_DROPDOWN", file_get_contents("View/Index/SUB_HEADER_VIEW_NOAUTH.php")));
			array_push($arguments, View::MakeViewArgument("ACCOUNT_MESSAGE", "Account"));
			
			// create new view controller
			$reg_view = new ViewController(new View("LOGIN_VIEW","Account/LOGIN_VIEW.php",$arguments));	
			
			// echo register view
			print $reg_view->renderViewHTML(true,true);			
		}
	}
	catch(Exception $e)
	{
		// trigger (big, orange) error
        trigger_error($e->getMessage(), E_USER_ERROR);
	}
}

function handleCreateSpeakerPost($request,$userAccess)
{
	// create a new speaker in the database
	$newSpeaker = new Speaker(array(
		"SPEAKER_IDENTITY" =>  null,
		"ACCOUNT_IDENTITY" =>  $userAccess->_accountIdentity,
		"FIRST_NAME"	   =>  $request["first_name"],
		"LAST_NAME"   	   =>  $request["last_name"],
		"EMAIL_ADDRESS"    =>  $request["email"],
		"PUBLIC"		   =>  $request["public"],
		"STATUS"		   =>  $request["status"],
		"COMPANY"		   =>  $request["company"],
		"JOB_TITLE"		   =>  $request["job_title"]
	));
	
	// insert the new speaker
	SpeakerController::Post($newSpeaker);
	
	// set the identity of the current speaker
	$newSpeaker->_speakerIdentity = getLastId();
	
	// create new speaker social view for each social network
	$allSpeakerSocial = array();
	
	$socialTypes = SocialTypeController::Get();
	
	foreach($socialTypes as $socialType)
	{
		if(isset($request["$socialType->_socialTypeIdentity"]))
		{
			// get the listed network name
			$network = $socialType->_name;
			
			// get each property that was provided
			$handle  = $request[$network . "_handle"];
			$profile = $request[$network . "_url"];
			$public  = $request[$network . "_is_public"];
			
			// insert or replace the social network name
			$speakerSocialType = new SpeakerSocial(array(
				"SPEAKER_SOCIAL_IDENTITY" 	=> null,
				"SPEAKER_IDENTITY"			=> $newSpeaker->_speakerIdentity,
				"SOCIAL_TYPE_IDENTITY"		=> $socialType->_socialTypeIdentity,
				"HANDLE"					=> $handle,
				"PROFILE_URL"				=> $profile,
				"IS_VIEWABLE"				=> $public
			));
			
			// insert social network associated to the speaker identity
			SpeakerSocialController::Post($speakerSocialType);
		}	
	}
	
	Redirect("?m=create");	
}

function handleCreateTopicPost($request,$userAccess)
{
	// init new topic based on request parameters
	$topic = new Topic(array(
		"TOPIC_IDENTITY"	=> null,
		"ACCOUNT_IDENTITY"  => $userAccess->_accountIdentity,
		"NAME"				=> $request["topic_name"]
	));
	
 	// insert the new topic
	TopicController::Post($topic);
	
	// redirect back to topic page
	Redirect("?m=create#topic");
}

function handleCreateTrackPost($request,$userAccess) 
{
	// init new topic based on request parameters
	$track = new Track(array(
		"TRACK_IDENTITY"	=> null,
		"ACCOUNT_IDENTITY"  => $userAccess->_accountIdentity,
		"NAME"				=> $request["track_name"]
	));
	
 	// insert the new topic
	TrackController::Post($track);
	
	// redirect back to topic page
	Redirect("?m=create#track");
}

function handleCreateStatusPost($request,$userAccess)
{
	// init new topic based on request parameters
	$status = new Status(array(
		"STATUS_IDENTITY"	=> null,
		"ACCOUNT_IDENTITY"  => $userAccess->_accountIdentity,
		"NAME"				=> $request["status_name"]
	));
	
 	// insert the new topic
	StatusController::Post($status);
	
	// redirect back to topic page
	Redirect("?m=create#newstatus");
}

function handleCreateEventTypePost($request,$userAccess)
{
	// init new topic based on request parameters
	$eventType = new EventType(array(
		"EVENT_TYPE_IDENTITY"	=> null,
		"ACCOUNT_IDENTITY"  	=> $userAccess->_accountIdentity,
		"NAME"					=> $request["eventtype_name"]
	));
	
 	// insert the new topic
	EventTypeController::Post($eventType);
	
	// redirect back to topic page
	Redirect("?m=create#eventtype");
}

function handleCreateVenuePost($request,$userAccess)
{
	// check if image is blank
	$imageUrl = CheckVenueImage($request["image_url"]);

	// init new venue based on request parameters
	$venue = new Venue(array(
		"VENUE_IDENTITY" 	=> null,
		"ACCOUNT_IDENTITY" 	=> $userAccess->_accountIdentity,
		"NAME"            	=> $request["name"],
		"IMAGE"            	=> $imageUrl,
		"IMAGE_URL"			=> $imageUrl,
		"CAPACITY"         	=> $request["capacity"],
		"ADDRESS"           => $request["address"],
		"CITY"            	=> $request["city"],
  		"STATE"				=> $request["state"],
  		"ZIP"               => $request["zip"],
  		"COUNTRY"           => $request["country"],
  		"PUBLIC_USE"		=> $request["public_use"]
	));

	// insert the new venue
	VenueController::Post($venue);

	// redirect back to the vendue page
	Redirect("?m=create#venue");

}

?>