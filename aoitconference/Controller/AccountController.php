<?php
class AccountController()
{	
	function Get($input)
	{
		$getQuery = self::$sqlQueries["GET"];
		
		$query = implode(" ", $getQuery);
		
		$rows = query($query, $input["EMAIL"]);
		
		$account = null;
		
		foreach($rows as $row)
		{			
			$account = new Account($row);
			break;			
		}
		
		return $account;
	}	
		
	function Post($input)
	{
		$getQuery = self::$sqlQueries["POST"];
		
		$query = implode(" ",$getQuery);
		
		query($query,$input["EMAIL"],$input["FIRST"],$input["LAST"],$input["ORG"],$input["TYPE"],$input["DISABLED"]);	
	}	
	
	function Put()
	{
		$query = self::$sqlQueries["UPDATE"];
	}
	
	function Delete()
	{
		$query = self::$sqlQueries["DELETE"];
	}
	
	// sql query, done in such a way where it is easier to add fields, if needed
    public static $sqlQueries = array(
		"GET" 	=> array(
			"SELECT",
			"*",
			"FROM",
			"ACCOUNT",
			"WHERE",
			"EMAIL_ADDRESS = ?"
		),
		"POST"  => array(
			"INSERT INTO",
			"ACCOUNT",
			"(EMAIL_ADDRESS,",
			"FIRST_NAME,",
			"LAST_NAME,",
			"ORGANIZATION_NAME",
			"ACCOUNT_TYPE_IDENTITY,",
			"ACCOUNT_DISABLED)",
			"VALUES",
			"(?,?,?,?,?,?)"
		),
		"UPDATE" => array(
			"UPDATE",
			"ACCOUNT SET",
			"EMAIL_ADDRESS = ?,", 
			"FIRST_NAME = ?,",
			"LAST_NAME = ?,",
			"ORGANIZATION_NAME = ?,",
			"ACCOUNT_TYPE_IDENTITY = ?,",
			"ACCOUNT_DISABLED = 0"
			"WHERE",
			"IDENTITY = ?"
		),
		"DELETE" => array(
			"UPDATE",
			"ACCOUNT",
			"SET",
			"ACCOUNT_DISABLED = ?"
		)	
	);
}
?>