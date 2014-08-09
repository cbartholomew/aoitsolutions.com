<?php
function GetEventTypeListViewHTML($userAccess)
{
	// define and init html for speaker
	$html = "";
	
	try
	{					
		// init new speaker array
		$eType = new EventType(array(
			"EVENT_TYPE_IDENTITY"	 => null,
			"ACCOUNT_IDENTITY"   	 => $userAccess->_accountIdentity,
			"NAME"	     			 => null
		));
	
		// get list of event types by account identity
		$eventTypes = EventTypeController::Get($eType);
	
		if(count($eventTypes) <= 0)
		{
			$html .= "<tr>";
			$html .= "<td colspan='2'>This account has no event types available</td>";
			$html .= "</tr>";	
		}
		else
		{
			foreach($eventTypes as $eventType)
			{
					$btnManageHtml = "<button type='button' onclick='manage(this);' operation='eventtype' id='manage_eventtype_" . 
					$eventType->_eventTypeIdentity . "' class='btn btn-default'><i class='glyphicon glyphicon-wrench inverse'></i></button>";
			
					$btnRemoveHtml = "<button type='button' onclick='prompt(this);' operation='eventtype' id='delete_eventtype_" . 
					$eventType->_eventTypeIdentity . "' class='btn btn-default'><i class='glyphicon glyphicon-minus inverse'></i></button>";
				
					$html .= "<tr>";
					$html .= "<td>" . $eventType->_name . "</td>";
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

function GetPromptPath($requestedAction)
{
	$name   	= "";
	$filePath   = "";
	
	switch($requestedAction)
	{
		case "delete":
			$name = "GENERIC_DELETE_MODAL_VIEW";
			$filePath = "Prompt/GENERIC_DELETE_MODAL_VIEW.php";
		break;
		
		case "alert":
			$name = "GENERIC_ALERT_MODAL_VIEW";
			$filePath = "Prompt/GENERIC_ALERT_MODAL_VIEW.php";
		break;
	}
	
	return array(
		"name" => $name,
		"filePath" => $filePath
	);
}

?>