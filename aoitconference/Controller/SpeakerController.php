<?php
class SpeakerController
{																	
	public static function Get($speaker)
	{
		$speakers = array();
		try
		{
			$query = implode(" ",self::$sqlQueries["GET"]);
				
			$rows = query($query, $speaker->_accountIdentity);
				
			foreach($rows as $row)
			{			
				array_push($speakers,new Speaker($row));		
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $speakers;
	}	
	
	public static function GetById($speaker)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["GET"]);
				
			$rows = query($query, $speaker->_speakerIdentity, $speaker->_accountIdentity);
				
			foreach($rows as $row)
			{			
				$speaker = new Account($row);
				break;			
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $speaker;
	}
		
	public static function Post($speaker)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["POST"]);
	
			query($query,
				$speaker->_accountIdentity,
				$speaker->_firstName,      
				$speaker->_lastName,       
				$speaker->_emailAddress,   
				$speaker->_public,         
				$speaker->_status,         
				$speaker->_company,        
				$speaker->_jobTitle);   
				   
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);			
			return false;
		}	
		return true;
	}	
	
	public static function Put($speaker)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["UPDATE"]);

			query($query,
				$speaker->_accountIdentity,
				$speaker->_firstName,      
				$speaker->_lastName,       
				$speaker->_emailAddress,   
				$speaker->_public,         
				$speaker->_status,         
				$speaker->_company,        
				$speaker->_jobTitle,
				$speaker->_speakerIdentity,
				$speaker->_accountIdentity);
				
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);			
			return false;
		}	
		return true;	
	}
	
	public static function Delete($speaker)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["DELETE"]);
	
			query($query,$speaker->_speakerIdentity,
				$speaker->_accountIdentity);
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
			"SPEAKER",
			"WHERE",
			"ACCOUNT_IDENTITY = ?"
		),
		"GET_BY_ID" => array(
			"SELECT",
			"*",
			"FROM",
			"SPEAKER",
			"WHERE",
			"SPEAKER_IDENTITY = ?",
			"AND",
			"ACCOUNT_IDENTITY = ?"
		),
		"POST"  => array(
			"INSERT INTO",
			"SPEAKER",
			"(ACCOUNT_IDENTITY,",
			"FIRST_NAME,",
			"LAST_NAME,",
			"EMAIL_ADDRESS,",
			"PUBLIC,",
			"STATUS,",
			"COMPANY,",
			"JOB_TITLE)",
			"VALUES",
			"(?,?,?,?,?,?,?,?,?)"
		),
		"UPDATE" => array(
			"UPDATE",
			"SPEAKER SET",			
			"ACCOUNT_IDENTITY = ?,",
			"FIRST_NAME = ?,", 
			"EMAIL_ADDRESS = ?,",
			"PUBLIC = ?,",
			"STATUS = ?,",
			"COMPANY = ?,",
			"JOB_TITLE = ?",
			"WHERE",
			"SPEAKER_IDENTITY = ?",
			"AND",
			"ACCOUNT_IDENTITY = ?"
		),
		"DELETE" => array(
			"DELETE FROM",
			"SPEAKER",
			"WHERE",
			"SPEAKER_IDENTITY = ?",
			"AND",
			"ACCOUNT_IDENTITY = ?"
		)	
	);
}
?>