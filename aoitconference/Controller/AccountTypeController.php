<?php
class AccountTypeController
{	
	public static function Get($accountType)
	{
		$accountTypes = array();
		
		try
		{
			$query = implode(" ",self::$sqlQueries["GET"]);
				
			$rows = query($query);
				
			foreach($rows as $row)
			{			
				$accountType = new AccountType($row);
				
				array_push($accountTypes, $accountType);			
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $accountTypes;
	}	
	
	public static function GetById($accountType)
	{
		$accountTypeResult = null;
		try
		{
			$query = implode(" ",self::$sqlQueries["GET_BY_ID"]);
				
			$rows = query($query, $account->_typeIdentity);
				
			foreach($rows as $row)
			{			
				$accountTypeResult = new AccountType($row);
				break;			
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $accountTypeResult;
	}
	
	public static function Post($account)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["POST"]);
	
			query($query,
				$account->_name,
				$account->_enabled);
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);			
			return false;
		}	
		return true;
	}	
	
	public static function Put($account)
	{		
		try
		{
			$query = implode(" ",self::$sqlQueries["UPDATE"]);
	
			query($query,
				$account->_name,
				$account->_enabled,
				$account->_accountTypeIdentity);
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);			
			return false;
		}	
		return true;
	}
	
	public static function Delete($account)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["DELETE"]);
	
			query($query,$account->_accountTypeIdentity);
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
			"ACCOUNT_TYPE",
		),
		"GET_BY_ID" => array(
			"SELECT",
			"*",
			"FROM",
			"ACCOUNT_TYPE",
			"WHERE",
			"ACCOUNT_TYPE_IDENTITY = ?"
		),
		"POST"  => array(
			"INSERT INTO",
			"ACCOUNT_TYPE",
			"(NAME,",
			"ENABLED)",
			"VALUES",
			"(?,?)"
		),
		"UPDATE" => array(
			"UPDATE",
			"ACCOUNT_TYPE SET",
			"NAME = ?,", 
			"FIRST_NAME = ?,",
			"ENABLED = ?",
			"WHERE",
			"ACCOUNT_TYPE_IDENTITY = ?"
		),
		"DELETE" => array(
			"DELETE",
			"ACCOUNT_TYPE",
			"WHERE",
			"ACCOUNT_TYPE_IDENTITY = ?"
		)	
	);
}
?>