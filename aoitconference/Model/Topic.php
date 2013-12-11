<?php
	class Topic()
	{
		public $_topicIdentity;
		public $_conferenceIdentity;
		public $_name;
		
		function __construct($obj) 
		{
			$this->_trackIdentity  = $obj["TOPIC_IDENTITY"];
			$this->_conferenceIdentity = $obj["CONFERENCE_IDENTITY"];
			$this->_name  = $obj["NAME"];
						 
			return this;
		}
		
	}
?>