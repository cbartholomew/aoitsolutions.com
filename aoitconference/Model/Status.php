<?php
class Status
{
	public $_statusIdentity;
	public $_accountIdentity;
	public $_name;
	
	function __construct($obj) 
	{
		$this->_statusIdentity  = $obj["STATUS_IDENTITY"];
		$this->_accountIdentity = $obj["ACCOUNT_IDENTITY"];
		$this->_name  			= $obj["NAME"];
					 
		return $this;
	}
	
}
?>