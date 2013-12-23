<?php
class Track
{
	public $_trackIdentity;
	public $_accountIdentity;
	public $_name;
	
	function __construct($obj) 
	{
		$this->_trackIdentity  = $obj["TRACK_IDENTITY"];
		$this->_accountIdentity = $obj["ACCOUNT_IDENTITY"];
		$this->_name  = $obj["NAME"];
					 
		return $this;
	}
	
}
?>