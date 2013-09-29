<?php

	function SplitAndReplace($input, $dilimiter, $returnIndex) 
	{
		try
		{
			$outputArr = array();
			
			// parse out input based on the dilimeter 
			$outputArr = explode($dilimiter, $input);
			
			// once we have an array, pull the index that you want
			$output = $outputArr[$returnIndex];
			
			// scrub the characters that you don't want
			$output = ScrubBrackets($output);
			
			return $output;
			
		}
		catch(Exception $e)
		{
			return $output;
		}	
	}
	
	function ScrubBrackets($input)
	{
		$input = str_replace("[", "" , $input);
		$input = str_replace("]", "" , $input);
		
		$output = $input;
		
		return $output;		
	}
	
	function ConvertDayNoToDayStr($input)
	{
		$output = "Day One";
		switch($input)
		{
			case "0":
				$output = "Day One";
			break;
			case "1":
				$output = "Day Two";
			break;
			case "2":
				$output = "Day Three";
			break;
		}
		return $output;
	}
	
	function ConvertDayStrToDayNo($input)
	{
		$output = 0;
		switch($input)
		{
			case "Day One":
				$output = 0;
			break;
			case "Day Two":
				$output = 1;
			break;
			case "Day Three":
				$output = 2;
			break;
		}
		return $output;
	}
	
	function ConvertSecondsToTime($seconds)
	{
		$hours = floor($seconds / 3600);
		$mins  = floor(($seconds - ($hours*3600)) / 60);
		$mins  = ($mins == 0) ? "00" : $mins;
		return $hours . ":" . $mins;	
	}
	
	function ConvertTimeToSeconds($time)
	{
			
		$time = str_replace("am","",$time);
		$time = str_replace("pm","",$time);
		$timeArr = explode(":", $time);
		return (int) $timeArr[0] * 3600 + (int) $timeArr[1] * 60;		
	}
		
	function IsCurrentSlotTime($localTimeInSeconds, $start, $end)
	{
		return ($localTimeInSeconds >= $start && $localTimeInSeconds <= $end) ? true : false;
	}
	
	function cmp($a, $b)
	{
		$a_room = explode(" ",$a["Room"]);
		$b_room = explode(" ",$b["Room"]);
			
		if ($a_room == $b_room) 
		{
	        return 0;
	    }	
	    return ($a_room < $b_room) ? -1 : 1;
	}
	
	function SortRooms($input)
	{
		$output = $input;
		
		usort($output, "cmp");
		
		return $output;
	}
	
	function GetBackgroundCSS($roomNumber)
	{
		switch($roomNumber) 
		{
			case "Room 202":
				return "room202";
			break;
			case "Room 204":
				return "room204";
			break;
			case "Room 301":
				return "room301";
			break;
			case "Room 302":
				return "room302";
			break;
			case "Room 303":
				return "room303";
			break;
			case "Room LL2":
				return "roomLLß2";
			break;
			case "tbd":					
			default:
				return "roomNotActive";
			break;
		}
		
	}
?>