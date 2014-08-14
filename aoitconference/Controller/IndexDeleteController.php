<?php
function handleCreateSpeakerDelete($request,$userAccess)
{
	// create a new speaker in the database
	$newSpeaker = new Speaker(array(
		"SPEAKER_IDENTITY" =>  $request["speaker_identity"],
		"ACCOUNT_IDENTITY" =>  $userAccess->_accountIdentity,
		"FIRST_NAME"	   =>  null,
		"LAST_NAME"   	   =>  null,
		"EMAIL_ADDRESS"    =>  null,
		"PUBLIC"		   =>  null,
		"STATUS"		   =>  null,
		"COMPANY"		   =>  null,
		"JOB_TITLE"		   =>  null
	));
	
	// set return to path
	$returnTo = "#" . $request["return"];
	
	// insert the new speaker
	if(SpeakerController::Delete($newSpeaker))
	{
		$speakerSocialNetworkList = SpeakerSocialController::GetById(new SpeakerSocial(array(
			"SPEAKER_SOCIAL_IDENTITY"	=> null,
			"SPEAKER_IDENTITY"			=> $newSpeaker->_speakerIdentity,
			"SOCIAL_TYPE_IDENTITY"      => null,
			"HANDLE"                    => null,
			"PROFILE_URL"               => null,
			"IS_VIEWABLE"			    => null
		)));
		
		if(count($speakerSocialNetworkList) > 0)
		{
			foreach($speakerSocialNetworkList as $speakerSocialNetwork)
			{
				SpeakerSocialController::Delete($speakerSocialNetwork);
			}
		}
		
		// return back to the tab
		Redirect("?m=create". $returnTo);
	}
	else
	{
		BadRequest();		
	}
}

function handleCreateTopicDelete($request,$userAccess)
{
	// create a new speaker in the database
	$topic = new Topic(array(
		"TOPIC_IDENTITY"	=> $request["topic_identity"],
		"ACCOUNT_IDENTITY"  => $userAccess->_accountIdentity,
		"NAME"				=> null
	));
	
	// set return to path
	$returnTo = "#" . $request["return"];
	
	// insert the new speaker
	if(TopicController::Delete($topic))
	{
		// return back to the tab
		Redirect("?m=create". $returnTo);
	}
	else
	{
		BadRequest();		
	}
}

function handleCreateTrackDelete($request,$userAccess)
{
	// create a new speaker in the database
	$track = new Track(array(
		"TRACK_IDENTITY"	=> $request["track_identity"],
		"ACCOUNT_IDENTITY"  => $userAccess->_accountIdentity,
		"NAME"				=> null
	));
	
	// set return to path
	$returnTo = "#" . $request["return"];
	
	// insert the new speaker
	if(TrackController::Delete($track))
	{
		// return back to the tab
		Redirect("?m=create". $returnTo);
	}
	else
	{
		BadRequest();		
	}
}

function handleCreateStatusDelete($request,$userAccess)
{
	// create a new speaker in the database
	$status = new Status(array(
		"STATUS_IDENTITY"	=> $request["status_identity"],
		"ACCOUNT_IDENTITY"  => $userAccess->_accountIdentity,
		"NAME"				=> null
	));
	
	// set return to path
	$returnTo = "#newstatus";
	
	// insert the new speaker
	if(StatusController::Delete($status))
	{
		// return back to the tab
		Redirect("?m=create". $returnTo);
	}
	else
	{
		BadRequest();		
	}
}

function handleCreateEventTypeDelete($request,$userAccess)
{
	// create a new speaker in the database
	$eventType = new EventType(array(
		"EVENT_TYPE_IDENTITY"	=> $request["eventtype_identity"],
		"ACCOUNT_IDENTITY"  	=> $userAccess->_accountIdentity,
		"NAME"					=> null
	));
	
	// set return to path
	$returnTo = "#eventtype";
	
	// insert the new speaker
	if(EventTypeController::Delete($eventType))
	{
		// return back to the tab
		Redirect("?m=create". $returnTo);
	}
	else
	{
		BadRequest();		
	}
}

function handleCreateVenueDisable($request,$userAccess)
{
	// check if whoever is making the request has access 
	// to actually make these changes (incase of console scripting)
	// by passing the disable
	if(!IsVenueOwner($request,$userAccess))
	{
		if(!IsAccountTypeCanEdit($userAccess))
		{
			// send bad request
			BadRequest();
		}
	}
	// init new venue array
    $venue = new Venue(array(
		"VENUE_IDENTITY" 	=> $request["venue_identity"],
		"ACCOUNT_IDENTITY" 	=> null,
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
	));

	// get full object, including orignal owner
	// as the original account identity is needed
	// by the time the execution is here, we know 
	// this person has access to remove the code
	$venue = VenueController::GetById($venue);

	// set return to path
	$returnTo = "#venue";
	
	// insert the new speaker
	if(VenueController::Disable($venue))
	{
		// return back to the tab
		Redirect("?m=create". $returnTo);
	}
	else
	{
		BadRequest();		
	}

}

/* ATTENTION - DO NOT USE UNLESS YOU REALLY WANT TO PURGE
 * Should not be used unless your intention is to fully
 * delete the venue and her rooms from the system.
 * i.e. choosing to the disable instead of removing
 * to preserve relationships
 */
function handleCreateVenueDelete($request,$userAccess)
{
	// check if whoever is making the request has access 
	// to actually make these changes (incase of console scripting)
	// by passing the disable
	if(!IsVenueOwner($request,$userAccess))
	{
		if(!IsAccountTypeCanEdit($userAccess))
		{
			// send bad request
			BadRequest();
		}
	}
	// init new venue array
    $venue = new Venue(array(
		"VENUE_IDENTITY" 	=> $request["venue_identity"],
		"ACCOUNT_IDENTITY" 	=> null,
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
	));

	// get full object, including orignal owner
	// as the original account identity is needed
	// by the time the execution is here, we know 
	// this person has access to remove the code
	$venue = VenueController::GetById($venue);

	// set return to path
	$returnTo = "#venue";
	
	// insert the new speaker
	if(VenueController::Delete($venue))
	{
		// return back to the tab
		Redirect("?m=create". $returnTo);
	}
	else
	{
		BadRequest();		
	}
}

function handleCreateRoomDelete($request,$userAccess)
{
	
}
?>