<?php
class StatusController
{																	
	public static function Get($status)
	{
		$statuses = array();
		try
		{
			$query = implode(" ",self::$sqlQueries["GET"]);
				
			$rows = query($query, $status->_accountIdentity);
				
			foreach($rows as $row)
			{			
				array_push($statuses,new Status($row));			
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $statuses;
	}	
		
	public static function Post($status)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["POST"]);

			query($query,
				$status->_accountIdentity,
				$status->_name);
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);			
			return false;
		}	
		return true;
	}	
	
	public static function Put($status)
	{
			try
			{
				$query = implode(" ",self::$sqlQueries["UPDATE"]);

				query($query,
					$status->_accountIdentity,
					$status->_name,
					$status->_statusIdentity);
			}
			catch(Exception $e)
			{
				trigger_error($e->getMessage(), E_USER_ERROR);			
				return false;
			}	
			return true;	
	}
	
	public static function Delete($status)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["DELETE"]);

			query($query,
				$status->_accountIdentity,
				$status->_statusIdentity);
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
			"STATUS",
			"WHERE",
			"ACCOUNT_IDENTITY = ?",
			"OR",
			"ACCOUNT_IDENTITY IS NULL"
		),
		"POST"  => array(
			"INSERT INTO",
			"STATUS",
			"(ACCOUNT_IDENTITY,",
			"NAME)",
			"VALUES",
			"(?,?)"
		),
		"UPDATE" => array(
			"UPDATE",
			"STATUS SET",
			"ACCOUNT_IDENTITY = ?,", 
			"NAME = ?",
			"WHERE",
			"STATUS_IDENTITY = ?"
		),
		"DELETE" => array(
			"DELETE FROM",
			"STATUS",
			"WHERE",
			"STATUS_IDENTITY = ?",
			"AND",
			"ACCOUNT_IDENTITY = ?",
			"AND",
			"ACCOUNT_IDENTITY IS NOT NULL" 
		)	
	);
}
?>