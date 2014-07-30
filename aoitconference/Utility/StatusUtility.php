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
?>