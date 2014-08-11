<?php
class CountryController
{		
	public static function Get($country)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["GET_BY_ID"]);

			$rows = query($query,$country->_countryIdentity);

			foreach($rows as $row)
			{			
				$country = new Country($row);
				break;
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}

		return $country;
	}
																
	public static function GetAll()
	{
		$countries = array();
		try
		{
			$query = implode(" ",self::$sqlQueries["GET_ALL"]);

			$rows = query($query);

			foreach($rows as $row)
			{			
				$country = new Country($row);
				array_push($countries,$country);
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}

		return $countries;
	}	
		
	public static function Post($country)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["POST"]);

			query($query,
				  $country->_isoCode,
				  $country->_name);
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);			
			return false;
		}	
		return true;
	}	
	
	public static function Put($country)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["UPDATE"]);

			query($query,
				$country->_isoCode,
				$country->_name,
				$country->_countryIdentity);
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);			
			return false;
		}	
		return true;	
	}
	
	public static function Delete($country)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["DELETE"]);

			query($query,$country->_countryIdentity);
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);			
			return false;
		}	
		return true;
	}
	
	// sql query, done in such a way where it is easier to add fields, if needed
    public static $sqlQueries = array(
		"GET_BY_ID" 	=> array(
			"SELECT",
			"*",
			"FROM",
			"COUNTRIES",
			"WHERE",
			"COUNTRY_IDENTITY = ?"
		),
		"GET_ALL" 	=> array(
			"SELECT",
			"*",
			"FROM",
			"COUNTRIES"
		),
		"POST"  => array(
			"INSERT INTO",
			"COUNTRIES",
			"(ISO_CODE, NAME)",
			"VALUES",
			"(?,?)"
		),
		"UPDATE" => array(
			"UPDATE",
			"COUNTRIES SET",
			"ISO_CODE = ?",
			"NAME = ?", 
			"WHERE",
			"COUNTRY_IDENTITY = ?"
		),
		"DELETE" => array(
			"DELETE FROM",
			"COUNTRIES",
			"WHERE",
			"COUNTRY_IDENTITY = ?"
		)	
	);
}
?>