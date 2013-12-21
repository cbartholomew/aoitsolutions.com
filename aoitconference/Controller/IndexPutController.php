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
			
			// if user has this social type - update
			if(isset($speakerSocial))
			{
				// set new properties 
				$speakerSocial->_handle 	= $handle;
				$speakerSocial->_profileUrl = $profile;
				$speakerSocial->_isViewable = $public;
				
				// update the social network
				SpeakerSocialController::Put($speakerSocial);
			}
			else
			{
				// insert social network, it looks as though it's new
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
	}
	
	Redirect("?m=create");	
}
?>