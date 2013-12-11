<?php
	class Status()
	{
		public $_statusIdentity;
		public $_conferenceIdentity;
		public $_name;
		
		function __construct($obj) 
		{
			$this->_identity  = $obj["STATUS_IDENTITY"];
			$this->_conferenceIdentity = $obj["CONFERENCE_IDENTITY"];
			$this->_name  = $obj["NAME"];
						 
			return this;
		}
		
	}
?>