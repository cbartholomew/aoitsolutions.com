<?php
/* 
* $venue = new Venue(array(
* 	"VENUE_IDENTITY" 	=> null,
* 	"ACCOUNT_IDENTITY" 	=> $userAccess->_accountIdentity,
* 	"NAME"            	=> null,
* 	"IMAGE"            	=> null,
* 	"CAPACITY"         	=> null,
* 	"ADDRESS"           => null,
* 	"CITY"            	=> null,
*   "STATE"				=> null,
*   "ZIP"               => null,
*   "COUNTRY"           => null
* ));
*/
class Venue
{
	public $_venueIdentity;
	public $_accountIdentity;
	public $_name;
	public $_image;
	public $_capacity;
	public $_address;
	public $_city;
	public $_state;
	public $_zip;
	public $_country;
	
	function __construct($obj) 
	{
		$this->_venueIdentity  	= $obj["VENUE_IDENTITY"];
		$this->_accountIdentity = $obj["ACCOUNT_IDENTITY"];
		$this->_name            = $obj["NAME"];
		$this->_image           = $obj["IMAGE"];
		$this->_capacity        = $obj["CAPACITY"];
		$this->_address         = $obj["ADDRESS"];
		$this->_city            = $obj["CITY"];
		$this->_state          	= $obj["STATE"];
		$this->_zip             = $obj["ZIP"];
		$this->_country         = $obj["COUNTRY"];
						 
		return $this;
	}
	
}
?>