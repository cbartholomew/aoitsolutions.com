<?php
class TopicController
{																	
	public static function Get($topic)
	{
		$topics = array();
		try
		{
			$query = implode(" ",self::$sqlQueries["GET"]);
				
			$rows = query($query, $topic->_accountIdentity);
				
			foreach($rows as $row)
			{			
				array_push($topics,new Topic($row));			
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $topics;
	}
		
	public static function GetById($topic)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["GET_BY_ID"]);
				
			$rows = query($query,$topic->_accountIdentity,$topic->_topicIdentity);
				
			foreach($rows as $row)
			{	
				$topic = new Topic($row);		
				break;		
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $topic;
	}
		
	public static function Post($topic)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["POST"]);

			query($query,
				$topic->_accountIdentity,
				$topic->_name);
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);			
			return false;
		}	
		return true;
	}	
	
	public static function Put($topic)
	{
			try
			{
				$query = implode(" ",self::$sqlQueries["UPDATE"]);

				query($query,
					$topic->_accountIdentity,
					$topic->_name,
					$topic->_topicIdentity);
			}
			catch(Exception $e)
			{
				trigger_error($e->getMessage(), E_USER_ERROR);			
				return false;
			}	
			return true;	
	}
	
	public static function Delete($topic)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["DELETE"]);

			query($query,
				$topic->_accountIdentity,
				$topic->_topicIdentity);
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
			"TOPIC",
			"WHERE",
			"ACCOUNT_IDENTITY = ?"
		),
		"GET_BY_ID" => array(
			"SELECT",
			"*",
			"FROM",
			"TOPIC",
			"WHERE",
			"ACCOUNT_IDENTITY = ?",
			"AND",
			"TOPIC_IDENTITY = ?"
		),
		"POST"  => array(
			"INSERT INTO",
			"TOPIC",
			"(ACCOUNT_IDENTITY,",
			"NAME)",
			"VALUES",
			"(?,?)"
		),
		"UPDATE" => array(
			"UPDATE",
			"TOPIC SET",
			"ACCOUNT_IDENTITY = ?,", 
			"NAME = ?",
			"WHERE",
			"TOPIC_IDENTITY = ?"
		),
		"DELETE" => array(
			"DELETE FROM",
			"TOPIC",
			"WHERE",
			"TOPIC_IDENTITY = ?",
			"AND",
			"ACCOUNT_IDENTITY = ?",
			"AND",
			"ACCOUNT_IDENTITY IS NOT NULL" 
		)	
	);
}
?>