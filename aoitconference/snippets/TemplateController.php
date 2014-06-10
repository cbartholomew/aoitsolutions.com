<?php
class TemplateController
{																	
	public static function Get($obj)
	{
		
	}	
	
	public static function GetById($obj)
	{
		
	}
	
	public static function Post($obj)
	{
		
	}	
	
	public static function Put($obj)
	{
				
	}
	
	public static function Delete($obj)
	{
		
	}
	
	// sql query, done in such a way where it is easier to add fields, if needed
    public static $sqlQueries = array(
		"GET" 	=> array(
			"SELECT",
			"*",
			"FROM",
			"<TABLE>"
		),
		"GET_BY_ID"=> array(
				"SELECT",
				"*",
				"FROM",
				"<TABLE>",
				"WHERE"
				"<COLUMN> = ?"
		),
		"POST"  => array(
			"INSERT INTO",
			"<TABLE>",
			"(<COLUMN_A>,",
			"<COLUMN_B>,",
			"<COLUMN_C>,",
			"<COLUMN_D>)",
			"VALUES",
			"(?,?,?,?)"
		),
		"UPDATE" => array(
			"UPDATE",
			"<TABLE> SET",
			"<COLUMN_A> = ?,", 
			"<COLUMN_B> = ?,",
			"<COLUMN_C> = ?,",
			"<COLUMN_D> = ?",
			"WHERE",
			"<COLUMN> = ?"
		),
		"DELETE" => array(
			"DELETE FROM",
			"<TABLE>",
			"WHERE",
			"<COLUMN> = ?"
		)	
	);
}
?>