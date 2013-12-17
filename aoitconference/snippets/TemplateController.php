<?php
class TemplateController
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
			"<TABLE>"
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