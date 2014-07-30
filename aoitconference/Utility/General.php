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

function NotAuthorized()
{
 	// return json instead of re-rendering
 	header('Content-Type: application/json');
	http_response_code(401);
 	print json_encode(array("status" => 401));
}

function BadRequest()
{
 	// return json instead of re-rendering
 	header('Content-Type: text/html');
	
	http_response_code(400);
 	
	exit;
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

?>