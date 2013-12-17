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
	
	function CheckIdentity($identity)
	{
		if(@isset($identity))
		{
			Redirect("");
		}
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
				//Redirect("?m=login");
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
			$html .= "<li><a href='#' custom='" . $socialType->_icoUrl . "' id='" 
				  . $socialType->_socialTypeIdentity 
				  . "' class='socialType'>" . $socialType->_name . "</a></li>";
		}
		return $html;
	}
	
	function GetStatusHTML($userAccess)
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
			
		foreach($allStatuses as $status)
		{
			$html .= "<option value='" . $status->_statusIdentity . "' ". $selected .">". $status->_name ."</option>";
			
			// make only the first one selected
			$selected = "";
		}
		return $html;
	}
?>