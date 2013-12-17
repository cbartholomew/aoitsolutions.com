<?php
class SocialType
{
	public $_socialTypeIdentity;
	public $_name;
	public $_icoUrl;
	public $_url;
	public $_bannerUrl;
	
	function __construct($obj)
	{
		$this->_socialTypeIdentity 	= $obj["SOCIAL_TYPE_IDENTITY"];
		$this->_name       			= $obj["NAME"];
		$this->_icoUrl      		= $obj["ICO_URL"];
		$this->_url        			= $obj["URL"];
		$this->_bannerUrl    		= $obj["BANNER_URL"];
		
		return $this;
	}	
}

?>