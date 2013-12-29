<?php 
function handleCreateSpeakerPut($request,$userAccess)
{
	// create a new speaker in the database
	$newSpeaker = new Speaker(array(
		"SPEAKER_IDENTITY" =>  $request["speaker_identity"],
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
	SpeakerController::Put($newSpeaker);
		
	// create new speaker social view for each social network
	$allSpeakerSocial = array();
	
	// update the social types
	$socialTypes = SocialTypeController::Get();
	
	/* 
	 * instead of updating individual ones - delete all and insert new ones
	 * that come in with the request. This is more cleaner than updating individual ones
	 * especially when user removes one after insert is there. 
	 */
	SpeakerSocialController::DeleteAllById($newSpeaker);
	
	// handle social network update and inserts
	foreach($socialTypes as $socialType)
	{
		if(isset($request["$socialType->_socialTypeIdentity"]))
		{
			// check if user has this social type
			$speakerSocial = SpeakerSocialController::GetByIdAndType($newSpeaker, $socialType);
		
			// get the listed network name
			$network = $socialType->_name;
		
			// get each property that was provided
			$handle  = $request[$network . "_handle"];
			$profile = $request[$network . "_url"];
			$public  = $request[$network . "_is_public"];
			
			// insert social network, assume it's new
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
		
	Redirect("?m=create#speaker");	
}

function handleCreateTopicPut($request,$userAccess)
{	
	// init new topic
	$topic = new Topic(array(
		"TOPIC_IDENTITY"	=> $request["topic_identity"],
		"ACCOUNT_IDENTITY"  => $userAccess->_accountIdentity,
		"NAME"				=> $request["topic_name"]
	));
	
	// update the topic 
	TopicController::Put($topic);
	
	// redirect user back to the correct tab
	Redirect("?m=create#topic");
}

function handleCreateTrackPut($request,$userAccess)
{
	// init new topic
	$track = new Track(array(
		"TOPIC_IDENTITY"	=> $request["track_identity"],
		"ACCOUNT_IDENTITY"  => $userAccess->_accountIdentity,
		"NAME"				=> $request["track_name"]
	));
	
	// update the topic 
	TrackController::Put($track);
	
	// redirect user back to the correct tab
	Redirect("?m=create#track");
	
}

function handleCreateStatusPut($request,$userAccess)
{
	// init new topic
	$status = new Status(array(
		"STATUS_IDENTITY"	=> $request["status_identity"],
		"ACCOUNT_IDENTITY"  => $userAccess->_accountIdentity,
		"NAME"				=> $request["status_name"]
	));
	
	// update the topic 
	StatusController::Put($status);
	
	// redirect user back to the correct tab
	Redirect("?m=create#newstatus");
}

function handleCreateEventTypePut($request,$userAccess)
{
	// init new topic
	$eventType = new EventType(array(
		"EVENT_TYPE_IDENTITY"	=> $request["eventtype_identity"],
		"ACCOUNT_IDENTITY"  	=> $userAccess->_accountIdentity,
		"NAME"					=> $request["eventtype_name"]
	));
	
	// update the topic 
	EventTypeController::Put($eventType);
	
	// redirect user back to the correct tab
	Redirect("?m=create#eventtype");
}
?>