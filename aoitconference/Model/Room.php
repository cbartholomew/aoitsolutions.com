<?php
/*
 * $room = new Room(array(
 * 	"ROOM_IDENTITY"  	=> null,
 * 	"VENUE_IDENTITY"  	=> null,
 * 	"NAME"              => null,
 * 	"ROOM_NUMBER"       => null,
 * 	"CAPACITY"          => null
 * ));
 */
class Room extends Venue
{
	public $_roomIdentity;
	public $_venueIdentity;
	public $_name;
	public $_roomNumber;
	public $_capacity;
	
	function __construct($obj) 
	{
		$this->_roomIdentity  	= $obj["ROOM_IDENTITY"];
		$this->_venueIdentity  	= $obj["VENUE_IDENTITY"];
		$this->_roomName  		= $obj["NAME"];
		$this->_roomNumber 		= $obj["ROOM_NUMBER"];
		$this->_capacity  		= $obj["CAPACITY"];
		
		return $this;
	}
	
}
?>