<?php
/*
 * $conference = new Conference(array(
 * 	"CONFERENCE_IDENTITY" => null,
 * 	"ACCOUNT_IDENTITY"    => $userAccess->_accountIdentity,
 * 	"NAME"                => null,
 * 	"START_DATE"          => null,
 * 	"END_DATE"            => null,
 * 	"NUMBER_OF_DAYS"	  => null
 * ));
*/
class Conference
{
	public $_conferenceIdentity;
	public $_accountIdentity;
	public $_name;
	public $_startDate;
	public $_endDate;
	public $_numberOfDays;

	function __construct($obj) 
	{
		
		$this->_conferenceIdentity = $obj["CONFERENCE_IDENTITY"];
		$this->_accountIdentity    = $obj["ACCOUNT_IDENTITY"];
		$this->_name               = $obj["NAME"];
		$this->_startDate          = $obj["START_DATE"];
		$this->_endDate            = $obj["END_DATE"];
		$this->_numberOfDays       = $obj["NUMBER_OF_DAYS"];
		
		return $this;
	}
}
?>