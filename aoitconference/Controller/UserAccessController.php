<?php
class UserAccessController
{																	
	public static function Get($userAccess)
	{
		$userAccessResult = null;
		
		try
		{
			$query = implode(" ",self::$sqlQueries["GET"]);
				
			$rows = query($query, $userAccess->_accountIdentity, $userAccess->_session);
		
			foreach($rows as $row)
			{			
				$userAccessResult = new UserAccess($row);
				break;			
			}
		
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $userAccessResult;
	}	

	public static function Post($userAccess)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["POST"]);
			query($query,$userAccess->_session,$userAccess->_lastRequestDttm,$userAccess->_accountIdentity);
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);		
			return false;
		}
		return true;
	}	

	public static function Put($userAccess)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["UPDATE"]);
			query($query,$userAccess->_lastRequestDttm,$userAccess->_accountIdentity,$userAccess->_session);
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);		
			return false;
		}
		return true;
	}

	public static function Delete()
	{

	}
	
	// sql query, done in such a way where it is easier to add fields, if needed
    public static $sqlQueries = array(
		"GET" 	=> array(
			"SELECT",
			"*",
			"FROM",
			"USER_ACCESS",
			"WHERE",
			"ACCOUNT_IDENTITY = ?",
			"AND",
			"SESSION = ?"
		),
		"POST"  => array(
			"INSERT INTO",
			"USER_ACCESS",			
			"(SESSION,",
			"LAST_REQUEST_DTTM,",
			"ACCOUNT_IDENTITY)",
			"VALUES",
			"(?,?,?)"
		),
		"UPDATE" => array(
			"UPDATE",
			"USER_ACCESS SET",
			"LAST_REQUEST_DTTM = ?",
			"WHERE",
			"ACCOUNT_IDENTITY = ?",
			"AND",
			"SESSION = ?"
		),
		"DELETE" => array(
			"DELETE FROM",
			"USER_ACCESS",
			"WHERE",
			"ACCOUNT_IDENTITY = ?",
			"AND",
			"SESSION = ?"
		)	
	);	
}
?>