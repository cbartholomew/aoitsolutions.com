<?php
function BootstrapNewUser($account)
{
	// create user with default status 
	$defaultStatusNames = array("Pending", "Confirmed", "Cancelled");
	foreach($defaultStatusNames as $statusName)
	{
		// init new topic based on request parameters
		$status = new Status(array(
			"STATUS_IDENTITY"	=> null,
			"ACCOUNT_IDENTITY"  => $account->_identity,
			"NAME"				=> $statusName
		));
		
		// insert the new status
		StatusController::Post($status);	
	}
	
	// create user with default event types 
	$defaultEventTypes  = array("Keynote","Session","Workshop","Code Lab");
	foreach($defaultEventTypes as $eventTypeName)
	{
		// init new topic based on request parameters
		$eventType = new EventType(array(
			"EVENT_TYPE_IDENTITY"	=> null,
			"ACCOUNT_IDENTITY" 		=> $account->_identity,
			"NAME"					=> $eventTypeName
		));
		
		// insert the new event type
		EventTypeController::Post($eventType);	
	}
}
?>