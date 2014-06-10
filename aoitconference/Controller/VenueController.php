<?php
class VenueController
{																	
	public static function Get($venue)
	{
		$venueList = [];
		try
		{
			$query = implode(" ",self::$sqlQueries["GET"]);

			$rows = query($query, $venue->_accountIdentity);

			foreach($rows as $row)
			{			
				$venue = new Venue($row);
				array_push($venueList,$venue);			
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		return $venueList;
	}	
	
	public static function GetById($venue)
	{
		$venueResult = null;
		try
		{
			$query = implode(" ",self::$sqlQueries["GET_BY_ID"]);

			$rows = query($query, $venue->_venueResult);

			foreach($rows as $row)
			{			
				$venueResult = new Venue($row);
				break;		
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		return $venueResult;		
	}
	
	public static function Post($venue)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["POST"]);
	
			query($query,
				$venue->_accountIdentity,
				$venue->_name,
				$venue->_image,
				$venue->_capacity,
				$venue->_address,
				$venue->_city,
				$venue->_state,
				$venue->_zip,
				$venue->_country);
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);			
			return false;
		}	
		return true;		
	}	
	
	public static function Put($venue)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["UPDATE"]);
	
			query($query,
				$venue->_accountIdentity,
				$venue->_name,
				$venue->_image,
				$venue->_capacity,
				$venue->_address,
				$venue->_city,
				$venue->_state,
				$venue->_zip,
				$venue->_country,
				$venue->_venueIdentity);
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);			
			return false;
		}	
		return true;				
	}
	
	public static function Delete($venue)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["DELETE"]);
	
			query($query,$venue->_venueIdentity);
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
		"GET" 	=> array(
			"SELECT",
			"*",
			"FROM",
			"VENUE",
			"WHERE",
			"ACCOUNT_IDENTITY = ?"
		),
		"GET_BY_ID"=> array(
			"SELECT",
			"*",
			"FROM",
			"VENUE",
			"WHERE",
			"VENUE_IDENTITY = ?"
		),
		"POST"  => array(
			"INSERT INTO",
			"VENUE",
			"(ACCOUNT_IDENTITY,",
			"NAME,",
			"IMAGE,",
			"CAPACITY,",
			"ADDRESS,",
			"CITY,",
			"STATE,",
			"ZIP,",
			"COUNTRY)",
			"VALUES",
			"(?,?,?,?,?,?,?,?,?,?)"
		),
		"UPDATE" => array(
			"UPDATE",
			"VENUE SET",
			"ACCOUNT_IDENTITY = ?,", 
			"NAME = ?,",
			"IMAGE = ?,",
			"CAPACITY = ?,",
			"ADDRESS = ?,",
			"CITY = ?,",
			"STATE = ?,",
			"ZIP = ?,",
			"COUNTRY = ?",
			"WHERE",
			"VENUE_IDENTITY = ?"
		),
		"DELETE" => array(
			"DELETE FROM",
			"VENUE",
			"WHERE",
			"VENUE_IDENTITY = ?"
		)	
	);
}
?>