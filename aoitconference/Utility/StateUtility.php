<?php

function GetStateHTML($venue)
{
	$html = "";
	
	// keeping consistent with the template
	$defaultStateId = 51;
	// get all statuses avaliable by null or or account identity
	$allStates = StateController::GetAll();
	
	// ensure first is selected	
	$selected = "selected='selected'";
	
	if(count($allStates) <= 0)
		return "<option value=0 selected=selected value=''>Problem returning state list!</option>";
	
	// no speaker
	if(!isset($venue))
	{
		foreach($allStates as $state)
		{
			if($state->_stateIdentity == $defaultStateId)
			{
				// make the default state id the default
				$selected = "selected='selected'";
			}
			else 
			{
				$selected = "";
			}
			
			$html .= "<option value='" . $state->_stateIdentity . "' ". $selected .">". $state->_name ."</option>";
		}
	}
	else
	{
		foreach($allStates as $state)
		{
			if($state->_stateIdentity == $venue->_state)
			{
				$selected = "selected='selected'";
			}
			else
			{
				$selected = "";
			}
			
			$html .= "<option value='" . $state->_stateIdentity . "' ". $selected .">". $state->_name ."</option>";	
		}
	}
	
	return $html;
}

?>