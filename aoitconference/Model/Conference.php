<?php

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
		
		return this;
	}

?>