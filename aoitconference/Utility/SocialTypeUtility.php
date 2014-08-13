<?php
function GetSocialTypeHTML()
{
	$html = "";
	$allSocialTypes = SocialTypeController::Get();
	
	if(count($allSocialTypes) <= 0)
		return "<li><a href='#' custom='' class='disabled'>No Social Networks Available</a></li>";
		
	foreach($allSocialTypes as $socialType)
	{
		// added "type" to reuse modal functionality
		$html .= "<li><a data-toggle='modal' href=?m=modal&type=social&social=" . $socialType->_socialTypeIdentity . "
			    data-target='#mySocialNetworkModal' custom='" . $socialType->_icoUrl . "' id='" 
			  . $socialType->_socialTypeIdentity 
			  . "' class='socialType'>" . $socialType->_name . "</a></li>";
	}
	return $html;
}
?>