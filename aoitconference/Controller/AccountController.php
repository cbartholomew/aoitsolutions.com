<?php
class AccountController
{	
	public static function Get($account)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["GET"]);
				
			$rows = query($query, $account->_emailAddress);
				
			foreach($rows as $row)
			{			
				$account = new Account($row);
				break;			
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $account;
	}	
	
	public static function GetById($account)
	{
		$accountResult = null;
		try
		{
			$query = implode(" ",self::$sqlQueries["GET_BY_ID"]);
				
			$rows = query($query, $account->_identity);
				
			foreach($rows as $row)
			{			
				$accountResult = new Account($row);
				break;			
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $accountResult;
	}
	
	public static function Post($account)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["POST"]);
	
			query($query,
				$account->_emailAddress,
				$account->_firstName,
				$account->_lastName,
				$account->_organizationName,
				$account->_accountTypeIdentity,
				$account->_accountDisabled);
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
				$account->_emailAddress,
				$account->_firstName,
				$account->_lastName,
				$account->_organizationName,
				$account->_accountTypeIdentity,
				$account->_accountDisabled,
				$account->_identity);
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
	
			query($query,$account->_identity);
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
			"ACCOUNT",
			"WHERE",
			"EMAIL_ADDRESS = ?"
		),
		"GET_BY_ID" => array(
			"SELECT",
			"*",
			"FROM",
			"ACCOUNT",
			"WHERE",
			"IDENTITY = ?"
		),
		"POST"  => array(
			"INSERT INTO",
			"ACCOUNT",
			"(EMAIL_ADDRESS,",
			"FIRST_NAME,",
			"LAST_NAME,",
			"ORGANIZATION_NAME,",
			"ACCOUNT_TYPE_IDENTITY,",
			"ACCOUNT_DISABLED)",
			"VALUES",
			"(?,?,?,?,?,?)"
		),
		"UPDATE" => array(
			"UPDATE",
			"ACCOUNT SET",
			"EMAIL_ADDRESS = ?,", 
			"FIRST_NAME = ?,",
			"LAST_NAME = ?,",
			"ORGANIZATION_NAME = ?,",
			"ACCOUNT_TYPE_IDENTITY = ?,",
			"ACCOUNT_DISABLED = 0",
			"WHERE",
			"IDENTITY = ?"
		),
		"DELETE" => array(
			"UPDATE",
			"ACCOUNT",
			"SET",
			"ACCOUNT_DISABLED = ?"
		)	
	);
}
?>