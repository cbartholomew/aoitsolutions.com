<?php

function GetVenueListViewHTML($userAccess)
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
	    	"CAPACITY"         	=> null,
	    	"ADDRESS"           => null,
	    	"CITY"            	=> null,
	      	"STATE"				=> null,
	      	"ZIP"               => null,
	      	"COUNTRY"           => null
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
				$btnManageHtml = "<button type='button' onclick='manage(this);' operation='track' id='manage_venue_" . $venue->_venueIdentity . "' 
				class='btn btn-default'><i class='glyphicon glyphicon-wrench inverse'></i></button>";

				$btnRemoveHtml = "<button type='button' onclick='prompt(this);' operation='track' id='delete_venue_" . $venue->_venueIdentity .  "' 
				class='btn btn-default'><i class='glyphicon glyphicon-minus inverse'></i></button>";

				// create new state variable w/ state id from venue
				$state = new State(array(
					"STATE_IDENTITY"	=> $venue->_state,
					"NAME"				=> null
				));

				// get the state by state identity
				$state = StateController::Get($state);

				$html .= "<tr>";
				$html .= "<td><img  class ='img-thumbnail' src='" . $venue->_image 	. "' alt='" . $venue->_image . "' height=100 width=100 /></td>";
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