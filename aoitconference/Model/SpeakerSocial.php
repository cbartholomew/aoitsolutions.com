<?php
/*
 *	$speakerSocial = new SpeakerSocial(array(
 *		"SPEAKER_SOCIAL_IDENTITY" 	=> null,
 *		"SPEAKER_IDENTITY"			=> null,
 *		"SOCIAL_TYPE_IDENTITY"		=> null,
 *		"HANDLE"					=> null,
 *		"PROFILE_URL"				=> null,
 *		"IS_VIEWABLE"				=> null
 *	));
 */
class SpeakerSocial
{
	public $_speakerSocialIdentity;
	public $_speakerIdentity;
	public $_socialTypeIdentity;
	public $_handle;
	public $_profileUrl;
	public $_isViewable;
	
	function __construct($obj)
	{
		$this->_speakerSocialIdentity 	= $obj["SPEAKER_SOCIAL_IDENTITY"];
		$this->_speakerIdentity      	= $obj["SPEAKER_IDENTITY"];
		$this->_socialTypeIdentity      = $obj["SOCIAL_TYPE_IDENTITY"];
		$this->_handle               	= $obj["HANDLE"];
		$this->_profileUrl				= $obj["PROFILE_URL"];
		$this->_isViewable            	= $obj["IS_VIEWABLE"];
		
		return $this;
	}	
}

?>