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
	case "POST":
		handlePost($_POST);
	break;
	
	case "PUT":
	break;
	
	case "DELETE":
	break;
	
	case "GET":
		handleGet($_GET);
	break;
}

function handlePost($request)
{
	if(isset($request["operation"]))
	{
		switch($request["operation"])
		{
			case "registration": 			
				handleRegistrationPost($request);
			break;
			case "login":
				handleLoginPost($request);
			break;
		}	
	}	
}

function handleGet($request)
{	
	// make arguments array to hold new view arguments
	$arguments = array();
	
	// make sure that i'm applying the correct header
	array_push($arguments, View::MakeViewArgument("ACCOUNT_DROPDOWN", file_get_contents("View/Index/SUB_HEADER_VIEW_NOAUTH.php")));
	array_push($arguments,View::MakeViewArgument("ACCOUNT_MESSAGE","Account"));
	
	// if there is an operation assoicated to request, check what kind
	// otherwise, print the normal landing page
	if(isset($request["operation"]))
	{
		switch($request["operation"])
		{
			case "login":
				// unset the header
				unset($request["operation"]);
				// blank on the error status for get request
				array_push($arguments, View::MakeViewArgument("ERROR_STATUS", ""));
				// create new view controller
				$reg_view = new ViewController(new View("LOGIN_VIEW","Account/LOGIN_VIEW.php",$arguments));	
				// echo register view
				print $reg_view->renderViewHTML(true,true);
			break;
			case "registration":
				// unset the header
				unset($request["operation"]);
				// create new view controller
				$reg_view = new ViewController(new View("REGISTER_VIEW","Account/REGISTER_VIEW.php",$arguments));	
				// echo register view
				print $reg_view->renderViewHTML(true,true);
			break;
			case "signout":
				// unset the header
				unset($request["operation"]);
				Signout();
			break;
			
			default:
				handleGet($request);
		}			
	}
	else
	{     	
		$arguments = array();
			
		$identity = (isset($_SESSION["identity"])) ? $_SESSION["identity"] : null;
		
		// make new user access object
		$userAccess = new UserAccess(array(						
			"USER_ACCESS_INDEX" => null,
			"SESSION" 			=> session_id(), 	
			"CREATED_DTTM" 		=> null,
			"LAST_REQUEST_DTTM" => null,
			"ACCOUNT_IDENTITY" 	=> $identity
		));
		
		// get user access information		
		$userAccess = GetSession($userAccess);
		
		// check if the user is logged in or not
		$viewHtmlPath  = (isset($userAccess->_userAccessIndex)) ? "View/Index/SUB_HEADER_VIEW_AUTH.php" : "View/Index/SUB_HEADER_VIEW_NOAUTH.php";
       	
		// update the last request dttm
		PutSession($userAccess);
		
		// get the sub header information
		$viewHtml = file_get_contents($viewHtmlPath);
       	
		// display message text to user based on if they are logged in or not
		$headerText = "Account";
		
		if(isset($identity))
		{
			// make new account object
			$account = new Account(array(
				"IDENTITY"					=> $identity,
				"EMAIL_ADDRESS" 			=> null,
				"FIRST_NAME" 				=> null,
				"LAST_NAME"  				=> null,
				"ORGANIZATION_NAME" 		=> null,
				"ACCOUNT_TYPE_IDENTITY"  	=> null,
				"ACCOUNT_DISABLED" 			=> null
			));
		
			// access the acount by the id
			$account = AccountController::GetById($account);
			
			// modify the header text
			$headerText = $account->_firstName . " " . $account->_lastName;
		}
		
		// push on to the argument stack
		array_push($arguments,View::MakeViewArgument("ACCOUNT_MESSAGE",$headerText));
		array_push($arguments,View::MakeViewArgument("ACCOUNT_DROPDOWN",$viewHtml));

		// create new view controller
		$vc = new ViewController(new View("INDEX_VIEW","Index/INDEX_VIEW.php",$arguments));
       
		// this method will render w arguments
		print $vc->renderViewHTML(true,true);
	}
}

function handleRegistrationPost($request)
{
	$account = new Account(array(
		"IDENTITY"					=> null,
		"EMAIL_ADDRESS" 			=> $request["email"],
		"FIRST_NAME" 				=> $request["first_name"],
		"LAST_NAME"  				=> $request["last_name"],
		"ORGANIZATION_NAME" 		=> $request["org_name"],
		"ACCOUNT_TYPE_IDENTITY"  	=> 1,
		"ACCOUNT_DISABLED" 			=> false
	));						
						
	try
	{
		// post the request to the database
		AccountController::Post($account);
		
		// get the information back
		$account = AccountController::Get($account);
		
		// insert the account into the user_access database
		$lastRequestDttm = date('Y-m-d H:i:s');	
		
		$userAccess = new UserAccess(array(						
			"USER_ACCESS_INDEX" => null,
			"SESSION" 			=> session_id(), 	
			"CREATED_DTTM" 		=> $lastRequestDttm,
			"LAST_REQUEST_DTTM" => $lastRequestDttm,
			"ACCOUNT_IDENTITY" 	=> $account->_identity
		));
		
		PostSessionIdentity($userAccess);
		
		// get user access session
		$userAccess = GetSession($userAccess);
		
		// update the request
		PutSession($userAccess);
		
		// redirect to main page
		Redirect("");
		
	} 
	catch(Exception $e)
	{
		// trigger (big, orange) error
        trigger_error($e->getMessage(), E_USER_ERROR);
	}
}		

function handleLoginPost($request)
{
	$arguments = array();

	$account = new Account(array(
		"IDENTITY"					=> null,
		"EMAIL_ADDRESS" 			=> $request["email"],
		"FIRST_NAME" 				=> "",
		"LAST_NAME"  				=> "",
		"ORGANIZATION_NAME" 		=> "",
		"ACCOUNT_TYPE_IDENTITY"  	=> 1,
		"ACCOUNT_DISABLED" 			=> false
	));
	try
	{
		// get the request to the database
		$account = AccountController::Get($account);
		
		// post session identity up
		if(isset($account->_identity))
		{
			// insert the account into the user_access database
			$lastRequestDttm = date('Y-m-d H:i:s');	

			$userAccess = new UserAccess(array(						
				"USER_ACCESS_INDEX" => null,
				"SESSION" 			=> session_id(), 	
				"CREATED_DTTM" 		=> $lastRequestDttm,
				"LAST_REQUEST_DTTM" => $lastRequestDttm,
				"ACCOUNT_IDENTITY" 	=> $account->_identity
			));
			
			// set the session
			PostSessionIdentity($userAccess);
			
			// redirect back to index
			Redirect("");
		}
		else
		{
			// push view arguments on the argument array stack
			array_push($arguments, View::MakeViewArgument("ERROR_STATUS", "has-error"));
			array_push($arguments, View::MakeViewArgument("ACCOUNT_DROPDOWN", file_get_contents("View/Index/SUB_HEADER_VIEW_NOAUTH.php")));
			array_push($arguments, View::MakeViewArgument("ACCOUNT_MESSAGE", "Account"));
			
			// create new view controller
			$reg_view = new ViewController(new View("LOGIN_VIEW","Account/LOGIN_VIEW.php",$arguments));	
			
			// echo register view
			print $reg_view->renderViewHTML(true,true);			
		}
	}
	catch(Exception $e)
	{
		// trigger (big, orange) error
        trigger_error($e->getMessage(), E_USER_ERROR);
	}
}					
?>