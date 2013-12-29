<?php
/*
 *	$eventType = new EventType(array(
 *		"EVENT_TYPE_IDENTITY"	=> null,
 *		"ACCOUNT_IDENTITY"  	=> $userAccess->_accountIdentity,
 *		"NAME"					=> null
 *	));
 */
class EventType
{
	public $_eventTypeIdentity;
	public $_accountIdentity;
	public $_name;
	
	function __construct($obj) 
	{
		$this->_eventTypeIdentity = $obj["EVENT_TYPE_IDENTITY"];
		$this->_accountIdentity   = $obj["ACCOUNT_IDENTITY"];
		$this->_name              = $obj["NAME"];
					 
		return $this;
	}
	
}
?>