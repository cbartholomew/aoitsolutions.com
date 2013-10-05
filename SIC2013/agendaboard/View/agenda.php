	<div class=""> 
		<div class="row head">
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"> 
				<?php
					$conference = $agenda["Conference"][$day];
					print("<h1>" . $conference["Day"] . ", " . $conference["Date"]["Month"] . "/" . $conference["Date"]["Day"] . "</h1>"); 
				?>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"> 
				<?php
					$conference = $agenda["Conference"][$day];
					print("<h1>Agenda: Sessions</h1>");
				?>
			</div>
			<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"> 
				<?php
					$conference = $agenda["Conference"][$day];
					print("<h1>Day " . $conference["DayNo"] . "</h1>");
				 ?>		
			</div>
			<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
				<img src="Static/Images/SIC2013-branding.png" alt="2013-branding-B" class="logoC" />
			</div>
		</div>
		<br>
		<div class="agenda">
			<table class="table table-bordered table-condensed agendaTable">
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
						$localTime = "10:10";
												
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
						    
							// make active anchor id to go to
							$rowId = ($isCurrentSlot) ? "ACTIVE" : "";
							 
						
							// begin laying out the table track frame
							print("<tr id=". $rowId ." class='" . $rowCls . "'>");								
							print("<td class='" . $columnCls ."'><h4>" 	   . $s["Start"]   . "" . 
								  strtolower($s["StartMeridian"]) . "<br>" . $s["End"] 	   . "" . 
								  strtolower($s["EndMeridian"])   . "</h4></td>");					
							
							
							// for each room - find the matching session							
							for($i=0,$n=$agenda["RoomCount"];$i<$n;$i++)
							{																																		
								// extract the room
								$room = $agenda["Rooms"][$i];	
								
								// set the session search parameters
								$session->set($full_start_time,	$full_end_time , ConvertDayNoToDayStr($day), $room["Number"]);
								
								// run search
								$session->get($sessions);
								
								// set the background cls
								$backgroundCls = GetBackgroundCSS($room["Number"]);
								
								// set up input argument variables								
								$sessionName = "No Session Avaliable";
								$speakerHtml = "<ul><li>N/A</li></ul>";
								$track 		 = "N/A";
								$status		 = "N/A";
								$statusCSS 	 = "statusLabelConfirmedFalse";
								
								// if we found a session, write it - otherwise - apply no info avaliable
								if(isset($session->item))
								{
									// name of session
									$sessionName = $session->item["Name"];
								    // handles multiple speakers html
								    $speakerHtml = GetMultiSpeakerHTML($session->item["Speakers"], true);
									// set track and status
									$track 		 = $session->item["Track"];
									$status		 = $session->item["Status"];
									
									// set status css
									$statusCSS = "statusLabelConfirmedTrue";
									
									// get the status, place has false if not confirmed
									if($session->item["Status"] != "Confirmed")
										$statusCSS = "statusLabelConfirmedFalse";						
								}
								
								// print start column
								print("<td class='". $columnCls . " " . $backgroundCls . " sessionColumn " . 
								str_replace(":","_",$s["Start"]) . "_" . str_replace(" ", "_",$session->item["Room"]) ."'>");

								// set arguments up for mypanel view replace
								$arguments = array(
									ViewManager::MakeViewArgument("SESSION_NAME",$sessionName ),
							   		ViewManager::MakeViewArgument("ROOM", $backgroundCls),						
							   		ViewManager::MakeViewArgument("SPEAKER_INFORMATION",$speakerHtml),
							   		ViewManager::MakeViewArgument("TRACK", $track),
							   		ViewManager::MakeViewArgument("STATUS", $status),
									ViewManager::MakeViewArgument("STATUS_LABEL",$statusCSS)
								);			
														
								// get the view html only w/ no header or footer
								$panelHtml = $viewManager->renderViewHTML("panel",$arguments, false, false);
								
								// print the html of the session
								print($panelHtml);
								
								// apply column end element
								print("</td>");

							}
							
							// add final time track																								
							print("<td class='" . $columnCls ."'><h4>" . $s["Start"] . "" . 
								  strtolower($s["StartMeridian"]) . "<br>" . $s["End"] . "" . 
								  strtolower($s["EndMeridian"]) . "</h4></td>");
								
							// track end
							print("</tr>");												
						}
					?>
				</tbody>	
			</table>
		</div>
	</div>
</div>