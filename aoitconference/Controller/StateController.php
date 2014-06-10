<?php
class StateController
{		
	public static function Get($state)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["GET_BY_ID"]);

			$rows = query($query,$state->_stateIdentity);

			foreach($rows as $row)
			{			
				$state = new State($row);
				break;
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}

		return $state;
	}
																
	public static function GetAll()
	{
		$states = [];
		try
		{
			$query = implode(" ",self::$sqlQueries["GET_ALL"]);

			$rows = query($query);

			foreach($rows as $row)
			{			
				$state = new State($row);
				array_push($states,$state);
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}

		return $states;
	}	
		
	public static function Post($state)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["POST"]);

			query($query,
				  $state->_name);
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);			
			return false;
		}	
		return true;
	}	
	
	public static function Put($state)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["UPDATE"]);

			query($query,
				$state->_name,
				$state->_stateIdentity);
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);			
			return false;
		}	
		return true;	
	}
	
	public static function Delete($state)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["DELETE"]);

			query($query,$state->_stateIdentity);
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
			"STATE",
			"WHERE",
			"STATE_IDENTITY = ?"
		),
		"GET_ALL" 	=> array(
			"SELECT",
			"*",
			"FROM",
			"STATE"
		),
		"POST"  => array(
			"INSERT INTO",
			"STATE",
			"(NAME)",
			"VALUES",
			"(?)"
		),
		"UPDATE" => array(
			"UPDATE",
			"STATE SET",
			"NAME = ?", 
			"WHERE",
			"STATE_IDENTITY = ?"
		),
		"DELETE" => array(
			"DELETE FROM",
			"STATE",
			"WHERE",
			"STATE_IDENTITY = ?"
		)	
	);
}
?>