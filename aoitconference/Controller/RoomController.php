<?php
class RoomController
{																	
	public static function Get($room)
	{
		$roomList = [];
		
		try
		{
			$query = implode(" ",self::$sqlQueries["GET"]);

			$rows = query($query, $room->_venueIdentity);

			foreach($rows as $row)
			{			
				$room = new Room($row);
				array_push($roomList, $room);
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}

		return $roomList;		
	}	
	
	public static function GetById($room)
	{
		$roomResult = null;
		try
		{
			$query = implode(" ",self::$sqlQueries["GET_BY_ID"]);
				
			$rows = query($query, $room->_roomIdentity);
				
			foreach($rows as $row)
			{			
				$roomResult = new Room($row);
				break;			
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
		
		return $roomResult;
	}
	
	public static function GetUsingUser($room,$userAccess)
	{
		$roomList = array();
		
		try
		{
			$query = implode(" ",self::$sqlQueries["GET_SECURE"]);

			$rows = query($query, $room->_venueIdentity, $userAccess->_accountIdentity);

			foreach($rows as $row)
			{			
				$room = new Room($row);

				$room->
				array_push($roomList, $room);
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}

		return $roomList;		
	}	

	public static function GetAllRoomsUsingUser($userAccess)
	{
		$roomList = array();
		
		try
		{
			$query = implode(" ",self::$sqlQueries["GET_SECURE_ALL"]);

			$rows = query($query,$userAccess->_accountIdentity);

			foreach($rows as $row)
			{			
				$room = new Room($row);

				// ADD EXTENDED PROPERTIES
				$room->_accountIdentity = $row["ACCOUNT_IDENTITY"];
				$room->_name   			= $row["VENUE_NAME"];

				array_push($roomList, $room);
			}
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);
		}

		return $roomList;		
	}	

	public static function Post($room)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["POST"]);

			query($query,
				$room->_roomIdentity,
				$room->_venueIdentity,
				$room->_name,
				$room->_roomNumber,
				$room->_capacity);
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);			
			return false;
		}	
		return true;		
	}	
	
	public static function Put($room)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["UPDATE"]);
	
			query($query,
				$room->_venueIdentity,
				$room->_name,
				$room->_roomNumber,
				$room->_capacity,
				$room->_roomIdentity);
		}
		catch(Exception $e)
		{
			trigger_error($e->getMessage(), E_USER_ERROR);			
			return false;
		}	
		return true;				
	}
	
	public static function Delete($room)
	{
		try
		{
			$query = implode(" ",self::$sqlQueries["DELETE"]);
	
			query($query,$room->_roomIdentity);
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
			"ROOM",
			"WHERE",
			"VENUE_IDENTITY = ?"
		),
		"GET_SECURE" => array(
			"SELECT", 
			"*",
			"FROM", 
			"ROOM AS R",
			"INNER JOIN", 
			"VENUE AS V",
			"ON", 
			"V.VENUE_IDENTITY = R.VENUE_IDENTITY",
			"WHERE", 
			"R.VENUE_IDENTITY = ?",
			"AND",
			"V.ACCOUNT_IDENTITY = ?"
		),
		"GET_SECURE_ALL" => array(
			"SELECT", 
			"R.ROOM_IDENTITY,",
			"R.VENUE_IDENTITY,",
			"R.NAME,",
			"R.ROOM_NUMBER,",
			"R.CAPACITY,",
			"R.VENUE_IDENTITY,",
			"ACCOUNT_IDENTITY,",
			"V.NAME AS VENUE_NAME, ",
			"V.DISABLED AS VENUE_DISABLED",
			"FROM ROOM AS R",
			"INNER JOIN VENUE AS V ON V.VENUE_IDENTITY = R.VENUE_IDENTITY",
			"WHERE (",
			"V.ACCOUNT_IDENTITY = ?",
			"OR V.PUBLIC_USE = TRUE",
			")",
			"AND V.DISABLED = FALSE"
		),
		"GET_BY_ID"=> array(
			"SELECT",
			"*",
			"FROM",
			"ROOM",
			"WHERE",
			"ROOM_IDENTITY = ?"
		),
		"POST"  => array(
			"INSERT INTO",
			"ROOM",
			"(VENUE_IDENTITY,",
			"NAME,",
			"ROOM_NUMBER,",
			"CAPACITY)",
			"VALUES",
			"(?,?,?,?)"
		),
		"UPDATE" => array(
			"UPDATE",
			"ROOM SET",
			"VENUE_IDENTITY = ?,", 
			"NAME = ?,",
			"ROOM_NUMBER = ?,",
			"CAPACITY = ?",
			"WHERE",
			"ROOM_IDENTITY = ?"
		),
		"DELETE" => array(
			"DELETE FROM",
			"ROOM",
			"WHERE",
			"ROOM_IDENTITY = ?"
		)	
	);
}
?>