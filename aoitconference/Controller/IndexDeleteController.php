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
?>