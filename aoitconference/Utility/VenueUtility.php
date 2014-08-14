<?php

function CheckVenueImage($imageUrl)
{
	return (strlen($imageUrl) <= 0) ? NO_IMAGE_FOUND : $imageUrl;
}

function GetVenueImageBase64($venue)
{
 	
	$imageUrl = (!isset($venue->_imageUrl)) ? NO_IMAGE_FOUND : $venue->_imageUrl;
	$imageData = "";

	try {
		$imageData = file_get_contents($imageUrl);
	} catch (Exception $e) {
		$imageData = file_get_contents(NO_IMAGE_FOUND);
	}

	return base64_encode($imageData);	 
}

function GetVenueSelectListViewHTML($userAccess)
{
	$html = "";

	try
	{					
		// init new venue array
    	$v = new Venue(array(
	    	"VENUE_IDENTITY" 	=> null,
	    	"ACCOUNT_IDENTITY" 	=> $userAccess->_accountIdentity,
	    	"NAME"            	=> null,
	    	"IMAGE"            	=> null,
	    	"IMAGE_URL"			=> null,
	    	"CAPACITY"         	=> null,
	    	"ADDRESS"           => null,
	    	"CITY"            	=> null,
	      	"STATE"				=> null,
	      	"ZIP"               => null,
	      	"COUNTRY"           => null,
	      	"PUBLIC_USE"		=> null,
	      	"DISABLED"			=> null
	    ));

		// get list of speakers by account identity
		$venues = VenueController::Get($v);

		if(count($venues) <= 0)
		{
			$html .= "<option selected=selected>No available venues.</option>";
		}
		else
		{
			foreach($venues as $venue)
			{
				$html .= "<option value='" . $venue->_venueIdentity . "'>";
				$html .= $venue->_name;
				$html .= "</option>";
			}
		}
	}
	catch(Exception $e)
	{
			trigger_error($e->getMessage(), E_USER_ERROR);
	}

	return $html;
}

function GetVenueListViewHTML($userAccess)
{

	// does the account type have special access
	// make call once above the for loop for 
	// uncessary db callbacks
	$isEditableAccountType = IsAccountTypeCanEdit($userAccess);

	$html = "";
	try
	{					
		// init new venue array
    	$v = new Venue(array(
	    	"VENUE_IDENTITY" 	=> null,
	    	"ACCOUNT_IDENTITY" 	=> $userAccess->_accountIdentity,
	    	"NAME"            	=> null,
	    	"IMAGE"            	=> null,
	    	"IMAGE_URL"			=> null,
	    	"CAPACITY"         	=> null,
	    	"ADDRESS"           => null,
	    	"CITY"            	=> null,
	      	"STATE"				=> null,
	      	"ZIP"               => null,
	      	"COUNTRY"           => null,
	      	"PUBLIC_USE"		=> null,
	      	"DISABLED"			=> null
	    ));

		// get list of speakers by account identity
		$venues = VenueController::Get($v);

		if(count($venues) <= 0)
		{
			$html .= "<tr>";
			$html .= "<td colspan='7'>This account has no venues available</td>";
			$html .= "</tr>";	
		}
		else
		{
			foreach($venues as $venue)
			{
				// code to allow or disallow the ability to edit venues
				// this is because venues are global
				$editDisabled = "";

				// override edit if user owns the venue, however.
				if($userAccess->_accountIdentity == $venue->_accountIdentity)
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


function IsVenueOwner($request,$userAccess)
{
	// checking ownership 
	$venue = VenueController::GetById(new Venue(array(
	    	"VENUE_IDENTITY" 	=> $request["venue_identity"],
	    	"ACCOUNT_IDENTITY" 	=> null,
	    	"NAME"            	=> null,
	    	"IMAGE"            	=> null,
	    	"IMAGE_URL"			=> null,
	    	"CAPACITY"         	=> null,
	    	"ADDRESS"           => null,
	    	"CITY"            	=> null,
	      	"STATE"				=> null,
	      	"ZIP"               => null,
	      	"COUNTRY"           => null,
	      	"PUBLIC_USE"		=> null,
	      	"DISABLED"			=> null
	)));

	// return true if venue owner
	return ($venue->_accountIdentity == $userAccess->_accountIdentity);
}

?>