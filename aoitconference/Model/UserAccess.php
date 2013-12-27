<?php
/*
 * 	$userAccess = new UserAccess(array(						
 *		"USER_ACCESS_INDEX" => null,
 *		"SESSION" 			=> session_id(), 	
 *		"CREATED_DTTM" 		=> null,
 *		"LAST_REQUEST_DTTM" => null,
 *		"ACCOUNT_IDENTITY" 	=> $account->_identity
 *	));
 */
class UserAccess
{
	public $_userAccessIndex;
	public $_session;
	public $_createdDttm;
	public $_lastRequestDttm;
	public $_accountIdentity;
	
	function __construct($obj)
	{
		$this->_userAccessIndex  = $obj["USER_ACCESS_INDEX"];
		$this->_session          = $obj["SESSION"];
		$this->_createdDttm      = $obj["CREATED_DTTM"];
		$this->_lastRequestDttm  = $obj["LAST_REQUEST_DTTM"];
		$this->_accountIdentity  = $obj["ACCOUNT_IDENTITY"];
		
		return $this;
	}	
}

?>