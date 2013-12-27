<?php
/*
 * $conferenceEvent = new ConferenceEvent(array(
 * 		"EVENT_IDENTITY"		=> null,
 * 		"CONFERENCE_IDENTITY"   => null,
 * 		"NAME"                  => null,
 * 		"PANEL_NAME"            => null,
 * 		"PUBLIC"                => null,
 * 		"STATUS_ID"             => null,
 * 		"TYPE_ID"               => null,
 * 		"TRACK_ID"              => null,
 * 		"DAY_NO"                => null,
 * 		"START_TIME"  	       	=> null,
 * 		"END_TIME"          	=> null,
 * 		"ROOM"  	            => null,
 * 		"HASHTAG"           	=> null,
 * 		"ABSTRACT"          	=> null,
 * 		"SUMMARY"          	    => null,
 * 		"EVENT_FULL"     	    => null
 * ));
 */
class ConferenceEvent
{
	public $_eventIdentity;
	public $_conferenceIdentity;
	public $_name;
	public $_panelName;
	public $_public;
	public $_statusIdentity;
	public $_typeIdentity;
	public $_trackIdentity;
	public $_dayNo;
	public $_startTime;
	public $_endTime;
	public $_room;
	public $_hashTag;
	public $_abstract;
	public $_summary;
	public $_eventFull;
	
	function __construct($obj)
	{			
		$this->_eventIdentity		= $obj["EVENT_IDENTITY"];
		$this->_conferenceIdentity  = $obj["CONFERENCE_IDENTITY"];
		$this->_name                = $obj["NAME"];
		$this->_panelName           = $obj["PANEL_NAME"];
		$this->_public              = $obj["PUBLIC"];
		$this->_statusIdentity      = $obj["STATUS_ID"];
		$this->_typeIdentity        = $obj["TYPE_ID"];
		$this->_trackIdentity       = $obj["TRACK_ID"];
		$this->_dayNo               = $obj["DAY_NO"];
		$this->_startTime           = $obj["START_TIME"];
		$this->_endTime             = $obj["END_TIME"];
		$this->_room                = $obj["ROOM"];
		$this->_hashTag             = $obj["HASHTAG"];
		$this->_abstract            = $obj["ABSTRACT"];
		$this->_summary             = $obj["SUMMARY"];
		$this->_eventFull           = $obj["EVENT_FULL"];
		
		return $this;
	}
		
}
?>