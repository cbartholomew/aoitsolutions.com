<?php
class EventTypeController
{																	
	public static function Get($eventType)
	{
		$eventTypes = array();
		try
		{
			$query = implode(" ",self::$sqlQueries["GET"]);
				
			$rows = query($query, $eventType->_accountIdentity);
				
			foreach($rows as $row)
			{			
				array_push($eventTypes,new EventType($row));			
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $eventTypes;
	}	
	
	public static function GetById($eventType)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["GET_BY_ID"]);
				
			$rows = query($query,$eventType->_accountIdentity,$eventType->_eventTypeIdentity);
				
			foreach($rows as $row)
			{	
				$eventType = new EventType($row);		
				break;		
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $eventType;
	}
	
	public static function Post($eventType)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["POST"]);

			query($query,
				$eventType->_accountIdentity,
				$eventType->_name);
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);			
			return false;
		}	
		return true;
	}	
	
	public static function Put($eventType)
	{
			try
			{
				$query = implode(" ",self::$sqlQueries["UPDATE"]);

				query($query,
					$eventType->_accountIdentity,
					$eventType->_name,
					$eventType->_eventTypeIdentity);
			}
			catch(Exception $e)
			{
				trigger_error($e->getMessage(), E_USER_ERROR);			
				return false;
			}	
			return true;	
	}
	
	public static function Delete($eventType)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["DELETE"]);

			query($query,
				$eventType->_eventTypeIdentity,
				$eventType->_accountIdentity);
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
			"EVENT_TYPE",
			"WHERE",
			"ACCOUNT_IDENTITY = ?"
		),
		"GET_BY_ID" => array(
			"SELECT",
			"*",
			"FROM",
			"EVENT_TYPE",
			"WHERE",
			"ACCOUNT_IDENTITY = ?",
			"AND",
			"EVENT_TYPE_IDENTITY = ?"
		),
		"POST"  => array(
			"INSERT INTO",
			"EVENT_TYPE",
			"(ACCOUNT_IDENTITY,",
			"NAME)",
			"VALUES",
			"(?,?)"
		),
		"UPDATE" => array(
			"UPDATE",
			"EVENT_TYPE SET",
			"ACCOUNT_IDENTITY = ?,", 
			"NAME = ?",
			"WHERE",
			"EVENT_TYPE_IDENTITY = ?"
		),
		"DELETE" => array(
			"DELETE FROM",
			"EVENT_TYPE",
			"WHERE",
			"EVENT_TYPE_IDENTITY = ?",
			"AND",
			"ACCOUNT_IDENTITY = ?",
			"AND",
			"ACCOUNT_IDENTITY IS NOT NULL" 
		)	
	);
}
?>