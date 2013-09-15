	<div class=""> 
		<div class="row head">
			<div class="col-lg-4"> 
				<?php
					$conference = $agenda["Conference"][0];
					print("<h1>" . $conference["Day"] . ", " . $conference["Date"]["Month"] . "/" . $conference["Date"]["Day"] . "</h1>"); 
				?>
			</div>
			<div class="col-lg-4"> 
				<?php
					$conference = $agenda["Conference"][0];
					print("<h1>Agenda: Sessions</h1>");
				?>
			</div>
			<div class="col-lg-2"> 
				<?php
					$conference = $agenda["Conference"][0];
					print("<h1>Day " . $conference["DayNo"] . "</h1>");
				 ?>		
			</div>
			<div class="col-lg-2">
				<img src="Static/Images/SIC2013-branding.png" alt="2013-branding-B" class="logoC" />
			</div>
		</div>
		<br>
		<div class="agenda">
			<table class="table table-bordered agendaTable">
				<thead>
					<tr>
						<?php	
							print("<th>Track Times</th>");				
							// create the header column, which are the room names
							for($i=0,$n=$agenda["RoomCount"];$i<$n;$i++)
							{
								// extract the room
								$room = $agenda["Rooms"][$i];			
								// write the header	
								print("<th>" . $room["Number"] . " (" . $room["Occupancy"] . " cap)</th>");
							}
							print("<th>Track Times</th>");
						?>
					</tr>
				</thead>
				<tbody>	
					<?php
						$conferenceSessions = $agenda["Conference"][0]["Times"]["Session"];
					
						foreach($conferenceSessions as $s)
						{
							print("<tr>");
							print("<td><h4>" . $s["Start"] . "" . strtolower($s["StartMeridian"]) . "<br>" . $s["End"] . "" . strtolower($s["EndMeridian"]) . "</h4></td>");					
					
							// create inner columns
							foreach ($sessions as $session)
							{
								for($i=0,$n=$agenda["RoomCount"];$i<$n;$i++)
								{
									// extract the room
									$room = $agenda["Rooms"][$i];
									if(ConvertSecondsToTime($session["session_start_time"]) == $s["Start"])
									{
										if($session["session_room"] != "tbd") 
										{
											if( $session["session_room"] == $room["Number"])
											{
												print("<td class='sessionColumn " . str_replace(":","_",$s["Start"]) . "_" . $room["Number"] ."'>" . $session["session_name"] ."</td>");									
											}
										}
									} 																
								}
														
						    }
							print("<td><h4>" . $s["Start"] . "" . strtolower($s["StartMeridian"]) . "<br>" . $s["End"] . "" . strtolower($s["EndMeridian"]) . "</h4></td>");
							print("</tr>");												
						}
					?>
				</tbody>	
			</table>
		</div>
	</div>
	<?php 
		// print("<h1>List of Sessions</h1>");
		// 	foreach ($sessions as $session)
		// 	{
		// 		print($session["session_name"] . "<br>");
		// 	}
		// 	
		// 	print("<h1>List of Speakers</h1>");
		// 	foreach($speakers as $speaker)
		// 	{
		// 		print($speaker["speaker_first_name"] . " " . $speaker["speaker_last_name"] . "<br>");
		// 	}
		// 	
		// 	print("<h1>List of Active/Pending Sponsors</h1>");
		// 	foreach($sponsors as $sponsor)
		// 	{		
		// 		$fileId = -1;
		// 		if(!empty($sponsor["sponsor_account_lead"]))
		// 		{
		// 			$fileId = SplitAndReplace($sponsor["sponsor_account_lead"]," ",0);
		// 		}
		// 		print($fileId . " " . $sponsor["sponsor_link"] . "<br>");
		// 	}
		// 	
		// 	print("<h1>Specific Speaker By Entry Id</h1>");
		// 	foreach($speakerByEntryId as $singleSpeaker)
		// 	{
		// 		print($singleSpeaker["speaker_first_name"] . " " . $singleSpeaker["speaker_last_name"] . "<br>");
		// 	}			
	?>
</div>