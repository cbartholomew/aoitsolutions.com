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
			$html .= "<td colspan='5'>This account has no rooms available</td>";
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

				$btnManageHtml = "<button type='button' " .$editDisabled. " onclick='manage(this);' operation='room' id='manage_room_" . $room->_roomIdentity . "' 
				class='btn btn-default'><i class='glyphicon glyphicon-wrench inverse'></i></button>";

				$btnRemoveHtml = "<button type='button' " .$editDisabled. " onclick='prompt(this);' operation='room' id='delete_room_" . $room->_roomIdentity .  "' 
				class='btn btn-default'><i class='glyphicon glyphicon-minus inverse'></i></button>";

				$html .= "<tr>";
				$html .= "<td>" . $room->_name 	. "</td>";
				$html .= "<td>" . $room->_roomName 	. "</td>";
				$html .= "<td>" . $room->_roomNumber 	. "</td>";
				$html .= "<td>" . $room->_capacity 		. "</td>";
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