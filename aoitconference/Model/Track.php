<?php
	class Track()
	{
		public $_trackIdentity;
		public $_conferenceIdentity;
		public $_name;
		
		function __construct($obj) 
		{
			$this->_trackIdentity  = $obj["TRACK_IDENTITY"];
			$this->_conferenceIdentity = $obj["CONFERENCE_IDENTITY"];
			$this->_name  = $obj["NAME"];
						 
			return this;
		}
		
	}
?>