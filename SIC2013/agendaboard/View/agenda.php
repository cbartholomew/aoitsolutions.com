	<div class=""> 
		<div class="row head">
			
		</div>
		<br>
		<div class="agenda">
			<table class="table table-bordered table-condensed agendaTable">
				<thead>
					<tr>
						<?php	
							print("<th class='defaultHeaderBackground'>Times</th>");				
							// create the header column, which are the room names
							for($i=0,$n=$agenda["RoomCount"];$i<$n;$i++)
							{
								// extract the room
								$room = $agenda["Rooms"][$i];	
								$roomHeaderCSS = GetBackgroundHeaderCSS($room["Number"]);		
								// write the header	
								print("<th class=' ". $roomHeaderCSS . "'>" . $room["Short"] . "</th>");
							}
							print("<th class='defaultHeaderBackground'>Times</th>");
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
							print("<td class='trackTimes " . $columnCls ."'><h4>" 	   . $s["Start"]   . "" . 
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
								$sessionName 		= "";
								$speakerHtml 		= "";
								$speakerModalHtml 	= "No Speaker Information Available";
								$track 		 		= "";
								$roomIsFullMSG  	= "";
								$roomIsFullCSS 		= "";
								$trackCSS   		= "";
								$sessionAbstract	= "No Session Available";
								$panelCSS			= "mypanel_inactive";
								$sessionId			= "999";
								$topicHtml			= "";
								$fullModalTime		= "";
								// depreciated
								$status		 	= "";
								$statusCSS 	 	= "";
								
								// if we found a session, write it - otherwise - apply no info avaliable
								if(isset($session->item))
								{
									// session id
									$sessionId = $session->item["Event ID"];									
									// assign the abstract
									$sessionAbstract = $session->item["Abstract"];									
									// name of session
									$sessionName = iconv("UTF-8", "CP1252", $session->item["Name"]);
								    // handles multiple speakers html
								    $speakerHtml = GetMultiSpeakerHTML($session->item["Speakers"], true);
									// uses LI version for speaker information
									$speakerModalHtml = GetMultiSpeakerHTMLFull($session->item["Speakers"], true);
									// set track and status
									$track 		 = $session->item["Track"];
									// handle topic
									$topicHtml = GetTopicMultiHtml($session->item["Topics"]);
									// set status & label css
									$trackCSS  = GetTrackLabelCSS($track);																		
									// room availability
									$roomAvailability =  GetIsRoomFullText($session->item["Full"]);														
									// set time
									$fullModalTime	= $session->item["Start Time"] . " - " . $session->item["End Time"];
																									
									// get the status, place has false if not confirmed
 									if($rowCls == "activeRow")
									{						
										// set the css and message
										$roomIsFullCSS = $roomAvailability["CSS"];
										$roomIsFullMSG = $roomAvailability["MSG"];
										$panelCSS 	   = "mypanel";									
									}
									
								}
								
								// print start column
								print("<td class=' myPanelTd ". $columnCls . " " . $backgroundCls . " sessionColumn " . 
								str_replace(":","_",$s["Start"]) . "_" . str_replace(" ", "_",$session->item["Room"]) ."'>");
								
								// set arguments up for mypanel view replace
								$arguments = array(
									ViewManager::MakeViewArgument("SESSION_NAME",$sessionName ),
							   		ViewManager::MakeViewArgument("ROOM", $backgroundCls),						
							   		ViewManager::MakeViewArgument("SPEAKER_INFORMATION",$speakerHtml),
							   		ViewManager::MakeViewArgument("TRACK", $track),
									ViewManager::MakeViewArgument("TRACK_LABEL", $trackCSS),
							   		ViewManager::MakeViewArgument("ROOM_IS_FULL_MSG", $roomIsFullMSG),
									ViewManager::MakeViewArgument("ROOM_IS_FULL_LABEL",$roomIsFullCSS),
									ViewManager::MakeViewArgument("PANEL_CSS",$panelCSS),
									ViewManager::MakeViewArgument("EVENT_ID",$sessionId),
									ViewManager::MakeViewArgument("SESSION_ABSTRACT",$sessionAbstract),
									ViewManager::MakeViewArgument("SPEAKER_INFORMATION_MODAL",$speakerModalHtml),
									ViewManager::MakeViewArgument("TOPICS",$topicHtml),
									ViewManager::MakeViewArgument("TIME",$fullModalTime)
								);			
								
								$twitterPanelHtml = "";
								
								if($rowCls == "activeRow")
								{
									$roomHashTag = $session->item["Hashtag"];
									
									$tweets = GetTweetsByHashEventTag($session->item["Hashtag"]);
									
									$tweetHtml = "";		
									foreach($tweets as $tweet)
									{	
										$tweetArguments = array(
										 	ViewManager::MakeViewArgument("TWITTER_HANDLE","@" . $tweet->user->screen_name),
										 	ViewManager::MakeViewArgument("TWITTER_TEXT",$tweet->text),
											ViewManager::MakeViewArgument("TWITTER_TWEET_ID", $tweet->id_str)									
										);									
										$tweetHtml .= $viewManager->renderViewHTML("tweet",$tweetArguments, false, false);					
									}
									
									$twitterArguments = array(
										ViewManager::MakeViewArgument("TWEETS",$tweetHtml),
										ViewManager::MakeViewArgument("TWITTER_HASH",$roomHashTag)
									);
									
									// make html
									$twitterPanelHtml = $viewManager->renderViewHTML("twitterpanel",$twitterArguments, false, false);															
								}	
								
								// push tweets on the stack
								array_push($arguments,ViewManager::MakeViewArgument("TWITTER",$twitterPanelHtml));		
												
								// get the view html only w/ no header or footer
								$panelHtml = $viewManager->renderViewHTML("panel",$arguments, false, false);
								
								// print the html of the session
								print($panelHtml);
								
								// apply column end element
								print("</td>");
							}
							
							// add final time track																								
							print("<td class=trackTimes'" . $columnCls ."'><h4>" . $s["Start"] . "" . 
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