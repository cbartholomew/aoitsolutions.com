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
		switch($_POST["method"])
		{
			case "PUT":
				handlePut($_POST);
				return;
			break;	
			case "DELETE":
				handleDelete($_POST);
			break;
			default:
				handlePost($_POST);
				return;
		}
	break;
}

function handlePost($request)
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
			case "registration": 			
				handleAccountRegistrationPost($request);
				return;
			break;
			case "login":
				handleAccountLoginPost($request);
				return;
			break;
			case "create_speaker":
				handleCreateSpeakerPost($request,$userAccess);
				return;
			break;
			default:
				// 
				unset($request["m"]);
				handleGet($request);
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
			case "delete_speaker":
				if(CheckAuth($userAccess))
				{
					handlePromptWithActionGet($request,$userAccess);
					return;
				}
				// I don't want it to loop back to the modal
				$request["m"] = "create";
			break;
			case "manage_speaker":
				if(CheckAuth($userAccess))
				{
					handleManageSpeakerGet($request,$userAccess);
					return;
				}
				else
				{
					NotAuthorized();
					return;
				}
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

function handlePut($request)
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
			case "registration": 			
				return;
			break;
			case "login":
				return;
			break;
			case "create_speaker":
				handleCreateSpeakerPut($request,$userAccess);
				return;
			break;
			default:
				// 
				unset($request["m"]);
				handleGet($request);
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

function handleDelete($request)
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
			case "delete_speaker":
				handleCreateSpeakerDelete($request,$userAccess);
				return;
			break;
			default:
				// 
				unset($request["m"]);
				handleGet($request);
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