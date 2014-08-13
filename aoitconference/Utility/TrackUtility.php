<?php

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

?>