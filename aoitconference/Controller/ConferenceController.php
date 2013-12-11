<?php
class ConferenceController()
{																	
	function Get()
	{
		
	}	
		
	function Post()
	{
		
	}	
	
	function Put()
	{
				
	}
	
	function Delete()
	{
		
	}
	
	// sql query, done in such a way where it is easier to add fields, if needed
    public static $sqlQueries = array(
		"GET" 	=> array(
			"SELECT",
			"*",
			"FROM",
			"CONFERENCE"
		),
		"POST"  => array(
			"INSERT INTO",
			"CONFERENCE",
			"(CONFERENCE_IDENTITY,",
			"ACCOUNT_IDENTITY,",
			"NAME,",
			"START_DATE,",
			"END_DATE,",
			"NUMBER_OF_DAYS)",
			"VALUES",
			"(?,?,?,?,?,?)"
		),
		"UPDATE" => array(
			"UPDATE",
			"CONFERENCE SET",
			"NAME = ?,", 
			"START_DATE = ?,",
			"END_DATE = ?,",
			"NUMBER_OF_DAYS = ?",
			"WHERE",
			"CONFERENCE_IDENTITY = ?",
			"AND",
			"ACCOUNT_IDENTITY = ?"
		),
		"DELETE" => array(
			"DELETE FROM",
			"CONFERENCE",
			"WHERE",
			"CONFERENCE_IDENTITY = ?",
			"AND",
			"ACCOUNT_IDENTITY = ?"
		)	
	);
}
?>