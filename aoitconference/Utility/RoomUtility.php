<?php 
function GetRoomListViewHTML($userAccess)
{

	// does the account type have special access
	// make call once above the for loop for 
	// uncessary db callbacks
	$isEditableAccountType = IsAccountTypeCanEdit($userAccess);

	$html = "";
	try
	{	
		// get list of speakers by account identity
		$rooms = RoomController::GetAllRoomsUsingUser($userAccess);

		if(count($rooms) <= 0)
		{
			$html .= "<tr>";
			$html .= "<td colspan='5'>This account has no venues available</td>";
			$html .= "</tr>";	
		}
		else
		{
			foreach($rooms as $room)
			{
				// code to allow or disallow the ability to edit venues
				// this is because venues are global
				$editDisabled = "";

				// override edit if user owns the venue, however.
				if($userAccess->_accountIdentity == $room->_accountIdentity)
				{
					$editDisabled = "";
				}
				else
				{
					// user does not have master/admin account
					if(!$isEditableAccountType)
					{
						$editDisabled = "disabled=disabled";
					}	
				}

				$btnManageHtml = "<button type='button' " .$editDisabled. " onclick='manage(this);' operation='venue' id='manage_venue_" . $venue->_venueIdentity . "' 
				class='btn btn-default'><i class='glyphicon glyphicon-wrench inverse'></i></button>";

				$btnRemoveHtml = "<button type='button' " .$editDisabled. " onclick='prompt(this);' operation='venue' id='delete_venue_" . $venue->_venueIdentity .  "' 
				class='btn btn-default'><i class='glyphicon glyphicon-minus inverse'></i></button>";

				// create new state variable w/ state id from venue
				$state = new State(array(
					"STATE_IDENTITY"	=> $venue->_state,
					"NAME"				=> null
				));

				// get the state by state identity
				$state = StateController::Get($state);

				$html .= "<tr>";
				$html .= "<td><img  class ='img-thumbnail' src='" . $venue->_imageUrl 	. "' alt='" . $venue->_imageUrl . "' height=100 width=100 /></td>";
				$html .= "<td>" . $venue->_name 	. "</td>";
				$html .= "<td>" . $venue->_address 	. "</td>";
				$html .= "<td>" . $venue->_city 	. "</td>";
				$html .= "<td name='" . $venue->_state . "'>" . $state->_name	. "</td>";
				$html .= "<td>" . $venue->_zip 		. "</td>";
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