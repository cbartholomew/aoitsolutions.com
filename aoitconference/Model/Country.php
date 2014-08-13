<?php
/*
 *	$country = new Country(array(
 *		"COUNTRY_IDENTITY"			=> null,
 *		"ISO_CODE" 					=> null,
 *		"NAME" 						=> null
 *	));
 */
class Country
{
	public $_countryIdentity;
	public $_isoCode;
	public $_name;
	
	function __construct($obj) 
	{
		$this->_countryIdentity 	= $obj["COUNTRY_IDENTITY"];
		$this->_isoCode  			= $obj["ISO_CODE"];
		$this->_name  				= $obj["NAME"];

		return $this;
	}
	
}
?>