<?php
class SocialTypeController()
{																	
	public static function Get()
	{ 
		$socialTypes = array();
		try
		{
			$query = implode(" ",self::$sqlQueries["GET"]);
				
			$rows = query($query);
				
			foreach($rows as $row)
			{			
				array_push($socialTypes,new SocialType($row));			
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $socialTypes;
	}	
		
	public static function Post($socialType)
	{
			try
			{
				$query = implode(" ",self::$sqlQueries["POST"]);

				query($query,
					$socialType->_name,       		
					$socialType->_icoUrl,      	
					$socialType->_url,        		
					$socialType->_bannerUrl);    	
					             
			}                           
			catch(Exception $e)
			{
				trigger_error($e->getMessage(), E_USER_ERROR);			
				return false;
			}	
			return true;
	}	
	
	public static function Put($socialType)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["UPDATE"]);

			query($query,
				$socialType->_name,       		
				$socialType->_icoUrl,      	
				$socialType->_url,        		
				$socialType->_bannerUrl);
				$socialType->_socialTypeIdentity);
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);			
			return false;
		}	
		return true;
	}
	
	public static function Delete($socialType)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["DELETE"]);
	
			query($query,$socialType->_socialTypeIdentity);
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
			"SOCIAL_TYPE"
		),
		"POST"  => array(
			"INSERT INTO",
			"SOCIAL_TYPE",
			"(NAME,",
			"ICO_URL,",
			"URL,",
			"BANNER_URL)",
			"VALUES",
			"(?,?,?,?)"
		),
		"UPDATE" => array(
			"UPDATE",
			"SOCIAL_TYPE SET",
			"NAME = ?,", 
			"ICO_URL = ?,",
			"URL = ?,",
			"BANNER_URL = ?",
			"WHERE",
			"SOCIAL_TYPE_IDENTITY = ?"
		),
		"DELETE" => array(
			"DELETE FROM",
			"SOCIAL_TYPE",
			"WHERE",
			"SOCIAL_TYPE_IDENTITY = ?"
		)	
	);
}
?>