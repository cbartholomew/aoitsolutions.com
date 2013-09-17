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
	
	function ConvertSecondsToTime($seconds)
	{
		$hours = floor($seconds / 3600);
		$mins  = floor(($seconds - ($hours*3600)) / 60);
		$mins  = ($mins == 0) ? "00" : $mins;
		return $hours . ":" . $mins;	
	}
	
	function ConvertTimeToSeconds($time)
	{
		$timeArr = explode(":", $time);
		return (int) $timeArr[0] * 3600 + (int) $timeArr[1] * 60;		
	}
	
	function IsCurrentSlotTime($localTimeInSeconds, $start, $end)
	{
		return ($localTimeInSeconds >= $start && $localTimeInSeconds <= $end) ? true : false;
	}
	
	function GetBackgroundCSS($roomNumber)
	{
		switch($roomNumber) 
		{
			case "202":
				return "room202";
			break;
			case "204":
				return "room204";
			break;
			case "301":
				return "room301";
			break;
			case "302":
				return "room302";
			break;
			case "303":
				return "room303";
			break;
			default:
				return "roomNotActive";
			break;
		}
		
	}
?>