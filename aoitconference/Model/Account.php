<?php
/*
 *	$account = new Account(array(
 *		"IDENTITY"					=> null,
 *		"EMAIL_ADDRESS" 			=> null,
 *		"FIRST_NAME" 				=> null,
 *		"LAST_NAME"  				=> null,
 *		"ORGANIZATION_NAME" 		=> null,
 *		"ACCOUNT_TYPE_IDENTITY"  	=> null,
 *		"ACCOUNT_DISABLED" 			=> null
 *	));
 */
class Account
{
	public $_identity;
	public $_firstName;
	public $_lastName;
	public $_emailAddress;
	public $_organizationName;
	public $_accountTypeIdentity;
	public $_accountDisabled;
	
	function __construct($obj) 
	{
		$this->_identity  			 = $obj["IDENTITY"];
		$this->_firstName			 = $obj["FIRST_NAME"];
		$this->_lastName  			 = $obj["LAST_NAME"];
		$this->_organizationName	 = $obj["ORGANIZATION_NAME"];
		$this->_accountTypeIdentity  = $obj["ACCOUNT_TYPE_IDENTITY"];
		$this->_accountDisabled		 = $obj["ACCOUNT_DISABLED"];
		$this->_emailAddress		 = $obj["EMAIL_ADDRESS"];
			 
		return $this;
	}
	
}
?>