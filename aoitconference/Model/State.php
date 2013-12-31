<?php
/*
 *	$state = new State(array(
 *		"STATE_IDENTITY"	=> null,
 *		"NAME"				=> null
 *	));
 */
class State
{
	public $_stateIdentity;
	public $_name;
	
	function __construct($obj) 
	{
		$this->_stateIdentity  = $obj["STATE_IDENTITY"];
		$this->_name           = $obj["NAME"];
			 
		return $this;
	}
	
}
?>