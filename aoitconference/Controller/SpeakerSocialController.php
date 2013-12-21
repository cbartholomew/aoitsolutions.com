<?php
class SpeakerSocialController
{																	
	public static function Get()
	{
		$speakerSocialNetworksAll = array();
		try
		{
			$query = implode(" ",self::$sqlQueries["GET"]);
				
			$rows = query($query);
				
			foreach($rows as $row)
			{			
				array_push($speakerSocialNetworksAll,new SpeakerSocial($row));			
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $speakerSocialNetworksAll;
	}	
	
	public static function GetById($speaker)
	{
		$speakerSocialNetworks = array();
		try
		{
			$query = implode(" ",self::$sqlQueries["GET_BY_ID"]);
				
			$rows = query($query, $speaker->_speakerIdentity);
				
			foreach($rows as $row)
			{			
				array_push($speakerSocialNetworks,new SpeakerSocial($row));	
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $speakerSocialNetworks;
	}
	
	public static function GetByIdAndType($speaker, $socialType)
	{
		$speakerSocial = null;
		try
		{
			$query = implode(" ",self::$sqlQueries["GET_BY_ID_AND_TYPE"]);
				
			$rows = query($query, $speaker->_speakerIdentity, $socialType->_socialTypeIdentity);
				
			foreach($rows as $row)
			{			
				$speakerSocial = new SpeakerSocial($row);	
				break;
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $speakerSocial;
	}
	
	public static function Post($speakerSocial)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["POST"]);

			query($query,
				$speakerSocial->_speakerIdentity,
				$speakerSocial->_socialTypeIdentity,
				$speakerSocial->_handle,
				$speakerSocial->_profileUrl,
				$speakerSocial->_isViewable);
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);			
			return false;
		}	
		return true;
	}	
	
	public static function Put($speakerSocial)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["UPDATE"]);

			query($query,
				$speakerSocial->_speakerIdentity,
				$speakerSocial->_socialTypeIdentity,
				$speakerSocial->_handle,
				$speakerSocial->_profileUrl,
				$speakerSocial->_isViewable,
				$speakerSocial->_speakerSocialIdentity);
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);			
			return false;
		}	
		return true;		
	}
	
	public static function Delete($speakerSocial)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["DELETE"]);
	
			query($query,$speakerSocial->_speakerSocialIdentity);
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
			"SPEAKER_SOCIAL"
		),
		"GET_BY_ID" => array(
			"SELECT",
			"*",
			"FROM",
			"SPEAKER_SOCIAL",
			"WHERE",
			"SPEAKER_IDENTITY = ?"
		),
		"GET_BY_ID_AND_TYPE" => array(
			"SELECT",
			"*",
			"FROM",
			"SPEAKER_SOCIAL",
			"WHERE",
			"SPEAKER_IDENTITY = ?",
			"AND",
			"SOCIAL_TYPE_IDENTITY = ?"
		),
		"POST"  => array(
			"INSERT INTO",
			"SPEAKER_SOCIAL",
			"(SPEAKER_IDENTITY,",
			"SOCIAL_TYPE_IDENTITY,",
			"HANDLE,",
			"PROFILE_URL,",
			"IS_VIEWABLE)",
			"VALUES",
			"(?,?,?,?,?)"
		),
		"UPDATE" => array(
			"UPDATE",
			"SPEAKER_SOCIAL SET",
			"SPEAKER_IDENTITY = ?,", 
			"SOCIAL_TYPE_IDENTITY = ?,",
			"HANDLE = ?,",
			"PROFILE_URL = ?,",
			"IS_VIEWABLE = ?",
			"WHERE",
			"SPEAKER_SOCIAL_IDENTITY = ?"
		),
		"DELETE" => array(
			"DELETE FROM",
			"SPEAKER_SOCIAL",
			"WHERE",
			"SPEAKER_SOCIAL_IDENTITY = ?"
		)	
	);
}
?>