<?php

function GetTopicListViewHTML($userAccess)
{
	// define and init html for speaker
	$html = "";
	
	try
	{					
		// init new speaker array
		$t = new Topic(array(
			"TOPIC_IDENTITY"	 => null,
			"ACCOUNT_IDENTITY"   => $userAccess->_accountIdentity,
			"NAME"	     		 => null
		));
	
		// get list of speakers by account identity
		$topics = TopicController::Get($t);
	
		if(count($topics) <= 0)
		{
			$html .= "<tr>";
			$html .= "<td colspan='2'>This account has no Topics available</td>";
			$html .= "</tr>";	
		}
		else
		{
			foreach($topics as $topic)
			{
				$btnManageHtml = "<button type='button' onclick='manage(this);' operation='topic' id='manage_topic_" . $topic->_topicIdentity . "' 
				class='btn btn-default'><i class='glyphicon glyphicon-wrench inverse'></i></button>";
			
				$btnRemoveHtml = "<button type='button' onclick='prompt(this);' operation='topic' id='delete_topic_" . $topic->_topicIdentity .  "' 
				class='btn btn-default'><i class='glyphicon glyphicon-minus inverse'></i></button>";
			
				$html .= "<tr>";
				$html .= "<td>" . $topic->_name . "</td>";
				$html .= "<td><div class='btn-group btn-group-xs'>" .  $btnManageHtml . $btnRemoveHtml . "</div></td>";		
				$html .= "</tr>";
			}
		}
	}
	catch(Exception $e)
	{
			trigger_error($e->getMessage(), E_USER_ERROR);
	}
	return $html;
}

?>