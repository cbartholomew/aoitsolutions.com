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
						// get all conference sessions										
						$conferenceSessions = $agenda["Conference"][0]["Times"]["Session"];
						
						// get the local time
						$localTime 	= date('H:i', time());
						
						// override for testing
						$localTime = "9:00";
												
						foreach($conferenceSessions as $s)
						{	
							// convert the local time in seconds
							$localTimeInSeconds = ConvertTimeToSeconds($localTime);
							$agendaStartTime 	= ConvertTimeToSeconds($s["Start"]);
							$agendaEndTime	    = ConvertTimeToSeconds($s["End"]);

							// run against the session time to confirm if it's the current slot			
							$isCurrentSlot = IsCurrentSlotTime($localTimeInSeconds,$agendaStartTime,$agendaEndTime);
															
						    // determine which slot gets the active row
							$rowCls	 	= ($isCurrentSlot) ? "activeRow" : "";
							$columnCls 	= ($isCurrentSlot) ? "activeCol" : "";
						
							print("<tr class='" . $rowCls . "'>");								
							print("<td class='" . $columnCls ."'><h4>" 	   . $s["Start"]   . "" . 
								  strtolower($s["StartMeridian"]) . "<br>" . $s["End"] 	   . "" . 
								  strtolower($s["EndMeridian"])   . "</h4></td>");					
							
							// Template used for testing until they enter the data
							for($i=0,$n=$agenda["RoomCount"];$i<$n;$i++)
							{			
								$backgroundCls = GetBackgroundCSS($room["Number"]);
								
								$sessionHtml = "TBD";
														
								// extract the room
								$room = $agenda["Rooms"][$i];																
								print("<td class='". $columnCls . " " . $backgroundCls . " sessionColumn " . 
									   str_replace(":","_",$s["Start"]) . "_" . $room["Number"] ."'>" .
									   $sessionHtml . "</td>");
							} 
							// Production 
							// create inner columns
							// foreach ($sessions as $session)
							// {
							// 	for($i=0,$n=$agenda["RoomCount"];$i<$n;$i++)
							// 	{									
							// 		// extract the room
							// 		$room = $agenda["Rooms"][$i];		
							// 		
							// 		// get the background cls for the column;							
							// 		$backgroundCls = GetBackgroundCSS($room["Number"]);
							// 		
							// 		if(ConvertSecondsToTime($session["session_start_time"]) == $s["Start"])
							// 		{
							// 			if($session["session_room"] != "tbd") 
							// 			{
							// 				if( $session["session_room"] == $room["Number"])
							// 				{
							// 					print("<td class='". $columnCls . " " . $backgroundCls . " sessionColumn " . 
							// 						  str_replace(":","_",$s["Start"]) . "_" . $room["Number"] ."'>" .
							// 						  $session["session_name"] ."</td>");									
							// 				}
							// 			}
							// 		} 																
							// 	}													
							// 						    }
							print("<td class='" . $columnCls ."'><h4>" . $s["Start"] . "" . 
								  strtolower($s["StartMeridian"]) . "<br>" . $s["End"] . "" . 
								  strtolower($s["EndMeridian"]) . "</h4></td>");
							
							print("</tr>");												
						}
					?>
				</tbody>	
			</table>
		</div>
	</div>
	<script>
	    function exposeCurrentTimeSlot() { 
	        $(".currentRow").addClass("activeRow");
	        $(".currentCol").addClass("activeCol");
	        $(".currentRow").children().each(function () { 
	            $(this).addClass("activeBorder");
	        });
	        var properties = {
	            //height: '225px' 
	           	paddingTop: "25px",
				paddingBottom: "25px"
	        };
	        var el = $(".activeCol");
			// 50 minutes, i.e. 3,000,000 million miliseconds, divided by 5000 miliseconds = 600 pulses per 50 minutes
	        el.pulse(properties, { duration: 5000, pulses: 600 });
	    }   
	 	$(document).ready(function(){
			exposeCurrentTimeSlot();
		});
	</script>
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