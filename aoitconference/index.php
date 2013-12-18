<?php
/**
 * Index.php
 *
 * Christopher Bartholomew
 * cbartholomew@gmail.com
 * 
 * Main index controller
 */
require("includes/Config.php");

switch($_SERVER["REQUEST_METHOD"])
{
	case "GET":
		handleGet($_GET);
	break;
	case "POST":
		handlePost($_POST);
	break;
	case "PUT":
	break;	
	case "DELETE":
	break;	
}

function handlePost($request)
{
	if(isset($request["m"]))
	{
		switch($request["m"])
		{
			case "registration": 			
				handleAccountRegistrationPost($request);
			break;
			case "login":
				handleAccountLoginPost($request);
			break;
			default:
				// 
				unset($request["m"]);
				handleGet($request);
		}	
	}	
}

function handleGet($request)
{	
	// identity
	$identity = (isset($_SESSION["identity"])) ? $_SESSION["identity"] : null;
	
	// get credentials
	// make new user access object
	$userAccess = new UserAccess(array(						
		"USER_ACCESS_INDEX" => null,
		"SESSION" 			=> session_id(), 	
		"CREATED_DTTM" 		=> null,
		"LAST_REQUEST_DTTM" => null,
		"ACCOUNT_IDENTITY" 	=> $identity
	));
	
	// if there is an m assoicated to request, check what kind
	// otherwise, print the normal landing page			
	if(isset($userAccess->_accountIdentity))
	{
		// get user access information and check if it's expired	
		$userAccess = GetSession($userAccess);

		// update the last request dttm
		PutSession($userAccess);	
	}

	if(isset($request["m"]))
	{				
		switch($request["m"])
		{
			case "login":
				handleAccountLoginGet($request);				
				return;
			break;
			case "registration":
				handleAccountRegistrationGet($request);
				return;
			break;
			case "signout":
				handleAccountSignoutGet($request);
				return;
			break;	
			case "create":
				if(CheckAuth($userAccess))
				{
					handleCreateGet($request,$userAccess);				
					return;
				}
			break;		
			case "modal":
				if(CheckAuth($userAccess))
				{
					handleSocialModalGet($request);
					return;
				}
				// I don't want it to loop back to the modal
				$request["m"] = "create";
			break;
			default:
				// unset request
				unset($request["m"]);
				handleGet($request);
				return;
		}	
		
		Redirect("?m=login&return=" . $request["m"]);	
	}
	else
	{     	
		// landing page
		handleLandingGet($request,$userAccess);
		return;
	}	
			
}

?>