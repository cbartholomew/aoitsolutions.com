<?php
	class Account()
	{
		public $_identity;
		public $_firstName;
		public $_lastName;
		
		function __construct($obj) 
		{
			$this->_identity  = $obj["IDENTITY"];
			$this->_firstName = $obj["FIRST_NAME"];
			$this->_lastName  = $obj["LAST_NAME"];
						 
			return this;
		}
		
	}
?>