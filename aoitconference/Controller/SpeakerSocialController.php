<?php
class SpeakerSocialController()
{																	
	public static function Get()
	{
		
	}	
	
	public static function Post()
	{
		
	}	
	
	public static function Put()
	{
				
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
			"SPEAKER_SOCIAL"
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
			"(?,?,?,?)"
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