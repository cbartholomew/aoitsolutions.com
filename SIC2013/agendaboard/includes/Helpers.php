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

?>