<?php
/*
 * $accountType = new AccountType(array(
 * 	"ACCOUNT_TYPE_IDENTITY" => null,
 * 	"NAME"                  => null,
 * 	"ENABLED"               => null
 * ));
 */
class AccountType
{
	public $_typeIdentity;
	public $_name;
	public $_enabled;
	
	function __construct($obj) 
	{
		$this->_typeIdentity  = $obj["ACCOUNT_TYPE_IDENTITY"];
		$this->_name 	 	  = $obj["NAME"];
		$this->_enabled  	  = $obj["ENABLED"];
					 
		return $this;
	}
	
}
?>