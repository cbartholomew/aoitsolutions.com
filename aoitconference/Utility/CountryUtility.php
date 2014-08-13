<?php
function GetCountryHTML($venue)
{
	$html = "";
	
	// keeping consistent with the template
	$defaultCountryId = 231;
	// get all statuses avaliable by null or or account identity
	$allCountries = CountryController::GetAll();
	
	// ensure first is selected	
	$selected = "selected='selected'";
	
	if(count($allCountries) <= 0)
		return "<option value=0 selected=selected value=''>Problem returning country list!</option>";
	
	// no speaker
	if(!isset($venue))
	{
		foreach($allCountries as $country)
		{
			if($country->_countryIdentity == $defaultCountryId)
			{
				// make the default country id the default
				$selected = "selected='selected'";
			}
			else 
			{
				$selected = "";
			}
			
			$html .= "<option value='" . $country->_countryIdentity . "' ". $selected .">". $country->_name ."</option>";
		}
	}
	else
	{
		foreach($allCountries as $country)
		{
			if($country->_countryIdentity == $venue->_country)
			{
				$selected = "selected='selected'";
			}
			else
			{
				$selected = "";
			}
			
			$html .= "<option value='" . $country->_countryIdentity . "' ". $selected .">". $country->_name ."</option>";	
		}
	}
	
	return $html;
}


?>