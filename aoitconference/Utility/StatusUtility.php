<?php
function GetStatusHTML($userAccess,$speaker)
{
	$html = "";
	
	// get all statuses avaliable by null or or account identity
	$allStatuses = StatusController::Get(new Status(array(
		"STATUS_IDENTITY" 	=> "",
		"ACCOUNT_IDENTITY"  => $userAccess->_accountIdentity,
		"NAME"				=> "")));
	
	// ensure first is selected	
	$selected = "selected='selected'";
	
	if(count($allStatuses) <= 0)
		return "<option>No Statuses Available</option>";
	
	// no speaker
	if(!isset($speaker))
	{
		foreach($allStatuses as $status)
		{
			$html .= "<option value='" . $status->_statusIdentity . "' ". $selected .">". $status->_name ."</option>";
		
			// make only the first one selected
			$selected = "";
		}
	}
	else
	{
		foreach($allStatuses as $status)
		{
			if($status->_statusIdentity == $speaker->_status)
			{
				$selected = "selected='selected'";
			}
			else
			{
				$selected = "";
			}
			
			$html .= "<option value='" . $status->_statusIdentity . "' ". $selected .">". $status->_name ."</option>";	
		}
	}
	
	return $html;
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

?>