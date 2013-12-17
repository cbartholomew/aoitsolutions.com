<?php
class SpeakerSocial
{
	public $_speakerSocialIdentity;
	public $_speakerIdentity;
	public $_socialTypeId;
	public $_handle;
	public $_isViewable;
	
	function __construct($obj)
	{
		$this->_speakerSocialIdentity 	= $obj["SPEAKER_SOCIAL_IDENTITY"];
		$this->_speakerIdentity      	= $obj["SPEAKER_IDENTITY"];
		$this->_socialTypeId         	= $obj["SOCIAL_TYPE_ID"];
		$this->_handle               	= $obj["HANDLE"];
		$this->_isViewable            	= $obj["IS_VIEWABLE"];
		
		return $this;
	}	
}

?>