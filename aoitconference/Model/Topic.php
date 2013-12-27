<?php
/*
 * $topic = new Topic(array(
 * 		"TOPIC_IDENTITY"	=> null,
 * 		"ACCOUNT_IDENTITY"  => $userAccess->_accountIdentity,
 * 		"NAME"				=> null
 * ));
 */
class Topic
{
	public $_topicIdentity;
	public $_accountIdentity;
	public $_name;
	
	function __construct($obj) 
	{
		$this->_topicIdentity  = $obj["TOPIC_IDENTITY"];
		$this->_accountIdentity = $obj["ACCOUNT_IDENTITY"];
		$this->_name  = $obj["NAME"];
					 
		return $this;
	}
	
}
?>