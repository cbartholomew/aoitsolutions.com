	<div class=""> 
		<div class="row head">
			<div class="col-lg-4"> 
				<?php
					$conference = $agenda["Conference"][$day];
					print("<h1>" . $conference["Day"] . ", " . $conference["Date"]["Month"] . "/" . $conference["Date"]["Day"] . "</h1>"); 
				?>
			</div>
			<div class="col-lg-4"> 
				<?php
					$conference = $agenda["Conference"][$day];
					print("<h1>Agenda: Sessions</h1>");
				?>
			</div>
			<div class="col-lg-2"> 
				<?php
					$conference = $agenda["Conference"][$day];
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
						$conferenceSessions = $agenda["Conference"][$day]["Times"]["Session"];
						
						// get the local time
						$localTime 	= date('H:i', time());
						
						// override to 9:00 am is if it's past 4:20						
						$localTime = "9:00";

												
						foreach($conferenceSessions as $s)
						{	
													
							// convert the local time in seconds
							$localTimeInSeconds = $localTime;
							$agendaStartTime 	= $s["Start"];
							$agendaEndTime	    = $s["End"];
							$full_start_time 	= $s["Start"] . strtolower($s["StartMeridian"]);
							$full_end_time 		= $s["End"]   . strtolower($s["EndMeridian"]);

							// run against the session time to confirm if it's the current slot			
							$isCurrentSlot = IsCurrentSlotTime($localTimeInSeconds,$agendaStartTime,$agendaEndTime);
															
						    // determine which slot gets the active row
							$rowCls	 	= ($isCurrentSlot) ? "activeRow" : "";
							$columnCls 	= ($isCurrentSlot) ? "activeCol" : "";
						
							print("<tr class='" . $rowCls . "'>");								
							print("<td class='" . $columnCls ."'><h4>" 	   . $s["Start"]   . "" . 
								  strtolower($s["StartMeridian"]) . "<br>" . $s["End"] 	   . "" . 
								  strtolower($s["EndMeridian"])   . "</h4></td>");					
							
							
							// for each room - find the matching session							
							for($i=0,$n=$agenda["RoomCount"];$i<$n;$i++)
							{																																		
								// extract the room
								$room = $agenda["Rooms"][$i];	
								
								// set the session search parameters
								$Session->set($full_start_time,	$full_end_time , ConvertDayNoToDayStr($day), $room["Number"]);
								
								// run search
								$Session->get($sessions);
								
								// set the background cls
								$backgroundCls = GetBackgroundCSS($room["Number"]);
								
								// if we found a session, write it - otherwise - apply no info avaliable
								if(isset($Session->item))
								{
									//print_r($Session->item);
									print("<td class='". $columnCls . " " . $backgroundCls . " sessionColumn " . 
									str_replace(":","_",$s["Start"]) . "_" . $Session->item["Room"] ."'>" .
									$Session->item["Name"] ."</td>");
								}
								else
								{																												
										$sessionHtml = "No information available";
																
										// extract the room
										$room = $agenda["Rooms"][$i];																
										print("<td class='". $columnCls . " " . $backgroundCls . " sessionColumn " . 
											   str_replace(":","_",$s["Start"]) . "_" . $room["Number"] ."'>" .
											   $sessionHtml . "</td>");
								}
								
							}
							
							// add final time track																								
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