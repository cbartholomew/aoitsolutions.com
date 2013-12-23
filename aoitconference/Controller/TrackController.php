<?php
class TrackController
{																	
	public static function Get($track)
	{
		$tracks = array();
		try
		{
			$query = implode(" ",self::$sqlQueries["GET"]);
				
			$rows = query($query, $track->_accountIdentity);
				
			foreach($rows as $row)
			{			
				array_push($tracks,new Track($row));			
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $tracks;
	}	
		
	public static function Post($track)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["POST"]);

			query($query,
				$track->_accountIdentity,
				$track->_name);
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);			
			return false;
		}	
		return true;
	}	
	
	public static function Put($track)
	{
			try
			{
				$query = implode(" ",self::$sqlQueries["UPDATE"]);

				query($query,
					$track->_accountIdentity,
					$track->_name,
					$track->_trackIdentity);
			}
			catch(Exception $e)
			{
				trigger_error($e->getMessage(), E_USER_ERROR);			
				return false;
			}	
			return true;	
	}
	
	public static function Delete($track)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["DELETE"]);

			query($query,
				$track->_accountIdentity,
				$track->_trackIdentity);
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
			"TRACK",
			"WHERE",
			"ACCOUNT_IDENTITY = ?",
			"OR",
			"ACCOUNT_IDENTITY IS NULL"
		),
		"POST"  => array(
			"INSERT INTO",
			"TRACK",
			"(ACCOUNT_IDENTITY,",
			"NAME)",
			"VALUES",
			"(?,?)"
		),
		"UPDATE" => array(
			"UPDATE",
			"TRACK SET",
			"ACCOUNT_IDENTITY = ?,", 
			"NAME = ?",
			"WHERE",
			"TRACK_IDENTITY = ?"
		),
		"DELETE" => array(
			"DELETE FROM",
			"TRACK",
			"WHERE",
			"TRACK_IDENTITY = ?",
			"AND",
			"ACCOUNT_IDENTITY = ?",
			"AND",
			"ACCOUNT_IDENTITY IS NOT NULL" 
		)	
	);
}
?>