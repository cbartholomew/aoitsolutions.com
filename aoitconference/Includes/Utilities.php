<?php
	function PostSessionIdentity($userAccess)
	{		
		if(!UserAccessController::Post($userAccess))
		{
			Redirect("?m=login");
		}
		else
		{
			$_SESSION["identity"] = $userAccess->_accountIdentity;
		}
	}
	function PutSession($userAccess)
	{
		// set the updated last request dttm
		$userAccess->_lastRequestDttm = date('Y-m-d H:i:s');
		
		// error - redirect due to unauthorized
		if(!UserAccessController::Put($userAccess))
		{
			Redirect("?m=login");
		}		
		
	}	
	
	function CheckAuth($userAccess)
	{
		return isset($userAccess->_accountIdentity);		
	}
	
	function GetSession($userAccess)
	{	
		if(!isset($userAccess))
		{
			Redirect("?m=login");
		}
		
		// check if the session even has an identity assigned to it
		if(isset($_SESSION['identity']))
		{
			// check if it's the correct identity based on the database
			$userAccess = UserAccessController::Get($userAccess);
			
			// check if the sesion is expired
			if(IsSessionNotExpired($userAccess))
			{
				return $userAccess;
			}
			else 
			{
				Signout();
			}
		}
	
		return $userAccess;
	}	
	function IsSessionNotExpired($userAccess)
	{
		// get current dttm
		$now = date('Y-m-d H:i:s');	
		
		// get last requested dttm
		$lastRequestedDttm = $userAccess->_lastRequestDttm;
		
		// convert times
		$to_time   = strtotime($now);
		$from_time = strtotime($lastRequestedDttm);
		
		// if the result is more than the constant, expire
		if(round(abs($to_time - $from_time) / 60,2) > SESSION_EXPIRE)
		{
			// session expired
			return false;
		}
				
		// session ok
		return true;
	}	
	/**
     * Logs out current user, if any.  Based on Example #1 at
     * http://us.php.net/manual/en/function.session-destroy.php.
     */
    function Signout()
    {
        // unset any session variables
        unset($_SESSION);
		
        // expire cookie
        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 42000);
        }

        // destroy session
        session_destroy();
		
		Redirect("");
    }	
	function Redirect($destination)
	{
		 // handle URL
	    if (preg_match("/^https?:\/\//", $destination))
	    {
	        header("Location: " . $destination);
	    }
        
	    // handle absolute path
	    else if (preg_match("/^\//", $destination))
	    {
	        $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
	        $host = $_SERVER["HTTP_HOST"];
	        header("Location: $protocol://$host$destination");
	    }
        
	    // handle relative path
	    else
	    {
	        // adapted from http://www.php.net/header
	        $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
	        $host = $_SERVER["HTTP_HOST"];
	        $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	        header("Location: $protocol://$host$path/$destination");
	    }
        
	    // exit immediately since we're redirecting anyway
	    exit;
	}
	
	function GetSocialTypeHTML()
	{
		$html = "";
		$allSocialTypes = SocialTypeController::Get();
		
		if(count($allSocialTypes) <= 0)
			return "<li><a href='#' custom='' class='disabled'>No Social Networks Available</a></li>";
			
		foreach($allSocialTypes as $socialType)
		{
			$html .= "<li><a data-toggle='modal' href=?m=modal&social=" . $socialType->_socialTypeIdentity . "
				    data-target='#mySocialNetworkModal' custom='" . $socialType->_icoUrl . "' id='" 
				  . $socialType->_socialTypeIdentity 
				  . "' class='socialType'>" . $socialType->_name . "</a></li>";
		}
		return $html;
	}
	
	function GetStatusHTML($userAccess,$speaker)
	{
		$html = "";
		
		// get all statuses avaliable by null or or account identity
		$allStatuses = StatusController::Get(new Status(array(
			"STATUS_IDENTITY" 	=> "",
			"ACCOUNT_IDENTITY"  => $userAccess->_accountIdentity,
			"NAME"				=> "")));
		
		// ensure first is selected	
		$selected = "selected='selected'";
		
		if(count($allStatuses) <= 0)
			return "<option>No Statuses Available</option>";
		
		// no speaker
		if(!isset($speaker))
		{
			foreach($allStatuses as $status)
			{
				$html .= "<option value='" . $status->_statusIdentity . "' ". $selected .">". $status->_name ."</option>";
			
				// make only the first one selected
				$selected = "";
			}
		}
		else
		{
			foreach($allStatuses as $status)
			{
				if($status->_statusIdentity == $speaker->_status)
				{
					$selected = "selected='selected'";
				}
				else
				{
					$selected = "";
				}
				
				$html .= "<option value='" . $status->_statusIdentity . "' ". $selected .">". $status->_name ."</option>";	
			}
		}
		
		return $html;
	}
	
	function GetSpeakerListViewHTML($userAccess)
	{
		// define and init html for speaker
		$html = "";
		
		try
		{					
			// init new speaker array
			$s = new Speaker(array(
				"SPEAKER_IDENTITY"	 => null,
				"ACCOUNT_IDENTITY"   => $userAccess->_accountIdentity,
				"FIRST_NAME"	     => null,
				"LAST_NAME"          => null,
				"EMAIL_ADDRESS"      => null,
				"PUBLIC"             => null,
				"STATUS"             => null,
				"COMPANY"	         => null,
				"JOB_TITLE"	         => null
			));
		
			// get list of speakers by account identity
			$speakers = SpeakerController::Get($s);
		
			if(count($speakers) <= 0)
			{
				$html .= "<tr>";
				$html .= "<td colspan='5'>This account has no speakers available</td>";
				$html .= "</tr>";	
			}
			else
			{
				foreach($speakers as $speaker)
				{
					$btnManageHtml = "<button type='button' onclick='manage(this);' operation='speaker' id='manage_" . $speaker->_speakerIdentity . "' 
					class='btn btn-default'><i class='glyphicon glyphicon-wrench inverse'></i></button>";
				
					$btnRemoveHtml = "<button type='button' onclick='delete(this);' operation='speaker' id='delete_" . $speaker->_speakerIdentity .  "' 
					class='btn btn-default'><i class='glyphicon glyphicon-minus inverse'></i></button>";
				
					$html .= "<tr>";
					$html .= "<td>" . $speaker->_firstName	  . "</td>";
					$html .= "<td>" . $speaker->_lastName	  . "</td>";
					$html .= "<td>" . $speaker->_emailAddress . "</td>";
					$html .= "<td>" . $speaker->_company	  . "</td>";
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
	
	function GetSocialOptionsHTML($speakerSocialList)
	{
		$html = "";
		
		
		
	}
	
?>