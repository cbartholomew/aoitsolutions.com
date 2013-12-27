<?php
/*
 * $qrEvent = new QREvent(array(
 * 		"QR_IDENTITY"				=> null,
 * 		"CONFERENCE_IDENTITY"  		=> null,
 * 		"CONFERENCE_EVENT_IDENTITY"	=> null,
 * 		"END_POINT"          		=> null,
 * 		"IMG_SRC"            		=> null
 * ));
*/
class QREvent
{
	public $_qrIdentity;
	public $_conferenceIdentity;
	public $_conferenceEventIdentity;
	public $_endPoint;
	public $_imgSrc;
	
	function __construct($obj) 
	{
		$this->_qrIdentity         		= $obj["QR_IDENTITY"];
		$this->_conferenceIdentity 		= $obj["CONFERENCE_IDENTITY"];
		$this->_conferenceEventIdentity = $obj["CONFERENCE_EVENT_IDENTITY"];
		$this->_endPoint           		= $obj["END_POINT"];
		$this->_imgSrc			   		= $obj["IMG_SRC"];       
		      	 
		return $this;
	}
	
}
?>