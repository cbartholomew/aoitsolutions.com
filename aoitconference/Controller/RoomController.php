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