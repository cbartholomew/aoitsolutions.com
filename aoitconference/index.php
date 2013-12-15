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
	// if there is an m assoicated to request, check what kind
	// otherwise, print the normal landing page
	if(isset($request["m"]))
	{
		switch($request["m"])
		{
			case "login":
				handleAccountLoginGet($request);
			break;
			case "registration":
				handleAccountRegistrationGet($request);
			break;
			case "signout":
				handleAccountSignoutGet($request);
			break;	
			case "create":
				handleCreateGet($request);
			break;		
			default:
				handleGet($request);
		}			
	}
	else
	{     	
		// landing page
		handleLandingGet($request);
	}
}
?>