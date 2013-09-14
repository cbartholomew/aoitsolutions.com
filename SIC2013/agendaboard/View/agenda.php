<div class='container'>
	<?php 
		print("<h1>List of Sessions</h1>");
		foreach ($sessions as $session)
		{
			print($session["session_name"] . "<br>");
		}
		
		print("<h1>List of Speakers</h1>");
		foreach($speakers as $speaker)
		{
			print($speaker["speaker_first_name"] . " " . $speaker["speaker_last_name"] . "<br>");
		}
		
		print("<h1>Specific Speaker By Entry Id</h1>");
		foreach($speakerByEntryId as $singleSpeaker)
		{
			print($singleSpeaker["speaker_first_name"] . " " . $singleSpeaker["speaker_last_name"] . "<br>");
		}
		
	?>
</div>