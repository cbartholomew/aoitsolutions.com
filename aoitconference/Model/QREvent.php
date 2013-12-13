<?php
class QREvent
{
	public $_qrIdentity;
	public $_conferenceIdentity;
	public $_endPoint;
	public $_imgSrc;
	
	function __construct($obj) 
	{
		$this->_qrIdentity         = $obj["QR_IDENTITY"];
		$this->_conferenceIdentity = $obj["CONFERENCE_IDENTITY"];
		$this->_endPoint           = $obj["END_POINT"];
		$this->_imgSrc			   = $obj["IMG_SRC"];       
		      	 
		return $this;
	}
	
}
?>