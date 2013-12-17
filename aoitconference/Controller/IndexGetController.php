<?php
function handleLandingGet($request)
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

function handleAccountLoginGet($request)
{
	// make arguments array to hold new view arguments
	$arguments = array();

	// make sure that i'm applying the correct header
	array_push($arguments,View::MakeViewArgument("ACCOUNT_DROPDOWN", file_get_contents("View/Index/SUB_HEADER_VIEW_NOAUTH.php")));
	array_push($arguments,View::MakeViewArgument("ACCOUNT_MESSAGE","Account"));
	
	// unset the header
	unset($request["m"]);
	// blank on the error status for get request
	array_push($arguments, View::MakeViewArgument("ERROR_STATUS", ""));
	// create new view controller
	$reg_view = new ViewController(new View("LOGIN_VIEW","Account/LOGIN_VIEW.php",$arguments));	
	// echo register view
	print $reg_view->renderViewHTML(true,true);
}

function handleAccountRegistrationGet($request)
{
	// make arguments array to hold new view arguments
	$arguments = array();

	// make sure that i'm applying the correct header
	array_push($arguments,View::MakeViewArgument("ACCOUNT_DROPDOWN", file_get_contents("View/Index/SUB_HEADER_VIEW_NOAUTH.php")));
	array_push($arguments,View::MakeViewArgument("ACCOUNT_MESSAGE","Account"));
	
	// unset the header
	unset($request["m"]);
	// create new view controller
	$reg_view = new ViewController(new View("REGISTER_VIEW","Account/REGISTER_VIEW.php",$arguments));	
	// echo register view
	print $reg_view->renderViewHTML(true,true);	
}

function handleAccountSignoutGet($request)
{
	// unset the header
	unset($request["m"]);
	Signout();
}

function handleCreateGet($request)
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
		
	// speaker create view html
	// $speakerCreateViewHTML = //file_get_contents("View/Create/CREATE_INDEX_SPEAKER_VIEW.php");
	
	// new array to hold the speaker view arguments
	$speakerViewArguments = array();
	
	// push the speaker social html to the argument stack
	array_push($speakerViewArguments,View::MakeViewArgument("SPEAKER_SOCIAL_TYPE",GetSocialTypeHTML()));
	array_push($speakerViewArguments,View::MakeViewArgument("SPEAKER_STATUS_TYPE",GetStatusHTML($userAccess)));	
		
	// apply special arguments to speaker view only
	$speakerViewController = new ViewController(new View("CREATE_INDEX_SPEAKER_VIEW","Create/CREATE_INDEX_SPEAKER_VIEW.php",$speakerViewArguments));
	
	// speaker create view html
	$speakerCreateViewHTML = $speakerViewController->renderViewHTML(false,false);
	
	// speaker modal view
	$speakerModalViewHTML  = file_get_contents("View/Create/CREATE_INDEX_SOCIAL_VIEW.php");
	
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
		
		// push on to the argument stack
		array_push($arguments,View::MakeViewArgument("ACCOUNT_MESSAGE"	,$headerText));
		array_push($arguments,View::MakeViewArgument("ACCOUNT_DROPDOWN"	,$viewHtml));
		array_push($arguments,View::MakeViewArgument("SPEAKER_MODAL"	,$speakerModalViewHTML));
		array_push($arguments,View::MakeViewArgument("SPEAKER_VIEW"		,$speakerCreateViewHTML));
  		
		
		// create new view controller
		$vc = new ViewController(new View("CREATE_INDEX_VIEW","Create/CREATE_INDEX_VIEW.php",$arguments));

		// this method will render w arguments
		print $vc->renderViewHTML(true,true);
		
	}
	else
	{
		Redirect("");	
	}
}

?>