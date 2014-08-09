<?php

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

?>