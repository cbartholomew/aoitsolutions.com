<?php	
class Speaker
{
	public $_speakerIdentity;
	public $_accountIdentity;
	public $_firstName;
	public $_lastName;
	public $_emailAddress;
	public $_public;
	public $_status;
	public $_company;
	public $_jobTitle;
	
	function __construct($obj)
	{
	 	$this->_speakerIdentity    = $obj["SPEAKER_IDENTITY"]; 
		$this->_accountIdentity    = $obj["ACCOUNT_IDENTITY"]; 
	 	$this->_firstName          = $obj["FIRST_NAME"]; 		   
	 	$this->_lastName           = $obj["LAST_NAME"]; 
		$this->_emailAddress       = $obj["EMAIL_ADDRESS"]; 		   
	 	$this->_public             = $obj["PUBLIC"]; 			   
	 	$this->_status             = $obj["STATUS"]; 			   
	 	$this->_company            = $obj["COMPANY"];		   
	 	$this->_jobTitle           = $obj["JOB_TITLE"];		
		
		return $this;
	}
	                   		
}
?>