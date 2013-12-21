<?php
function handleLandingGet($request,$userAccess)
{
	$arguments = array();
		
	// check if the useraccess to ensure credentials are set
	$viewHtmlPath  = (isset($userAccess->_userAccessIndex)) ? "View/Index/SUB_HEADER_VIEW_AUTH.php" 
															: "View/Index/SUB_HEADER_VIEW_NOAUTH.php";
   	
	// get the sub header information
	$viewHtml = file_get_contents($viewHtmlPath);
   	
	// display message text to user based on if they are logged in or not
	$headerText = "Account";
	
	if(isset($userAccess->_accountIdentity))
	{
		// make new account object
		$account = new Account(array(
			"IDENTITY"					=> $userAccess->_accountIdentity,
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
    
	// blank out return if null
	if(!isset($request["return"]))
	{
		$request["return"] = "";
	}
	
	// make sure that i'm applying the correct header
	array_push($arguments,View::MakeViewArgument("ACCOUNT_DROPDOWN", file_get_contents("View/Index/SUB_HEADER_VIEW_NOAUTH.php")));
	array_push($arguments,View::MakeViewArgument("ACCOUNT_MESSAGE","Account"));
	array_push($arguments,View::MakeViewArgument("RETURN_TO",$request["return"]));
	
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

function handleCreateGet($request,$userAccess)
{
	$arguments = array();
	
	// new array to hold the speaker view arguments
	$speakerViewArguments = array();
	
	// check if the user is logged in or not
	$viewHtmlPath  = (isset($userAccess->_userAccessIndex)) ? "View/Index/SUB_HEADER_VIEW_AUTH.php" : "View/Index/SUB_HEADER_VIEW_NOAUTH.php";
	
	// get the sub header information
	$viewHtml = file_get_contents($viewHtmlPath);
	
	// get the social type and status html
	$socialViewTypeHTML = GetSocialTypeHTML();
	$socialStatusHTML = GetStatusHTML($userAccess);
	
	// push the speaker social html to the argument stack
	array_push($speakerViewArguments,View::MakeViewArgument("SPEAKER_SOCIAL_TYPE", 	$socialViewTypeHTML));
	array_push($speakerViewArguments,View::MakeViewArgument("SPEAKER_STATUS_TYPE", 	$socialStatusHTML));	
		
	// apply special arguments to speaker view only
	$speakerViewController = new ViewController(new View("CREATE_INDEX_SPEAKER_VIEW","Create/CREATE_INDEX_SPEAKER_VIEW.php",$speakerViewArguments));
	
	// speaker create view html
	$speakerCreateViewHTML = $speakerViewController->renderViewHTML(false,false);
		
	// display message text to user based on if they are logged in or not
	$headerText = "Account";
	
	// make new account object
	$account = new Account(array(
		"IDENTITY"					=> $userAccess->_accountIdentity,
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
	
	// get the speaker list view html
	$speakerListViewHTML = GetSpeakerListViewHTML($userAccess);
	
	// push on to the argument stack
	array_push($arguments,View::MakeViewArgument("ACCOUNT_MESSAGE"	,$headerText));
	array_push($arguments,View::MakeViewArgument("ACCOUNT_DROPDOWN"	,$viewHtml));
	array_push($arguments,View::MakeViewArgument("SPEAKER_VIEW"		,$speakerCreateViewHTML));
 	array_push($arguments,View::MakeViewArgument("SPEAKER_LIST_VIEW",$speakerListViewHTML));	
		
	// create new view controller
	$vc = new ViewController(new View("CREATE_INDEX_VIEW","Create/CREATE_INDEX_VIEW.php",$arguments));

	// this method will render w arguments
	print $vc->renderViewHTML(true,true);		

}

function handleSocialModalGet($request)
{
	// pass default "add" text to modal unless it's an updated
	$socialAction = "Add";
	// view arguments array
	$arguments = array();
	// get the social id that was requested
	$socialIdentity  = (isset($request["social"])) ? $request["social"]   : null;
	// if there is a speaker value set - return the speaker information
	$speakerIdentity = (isset($request["speaker"])) ? $request["speaker"] : null;	
	// handle
	$incomingHandle   =  (isset($request["handle"]))  ? $request["handle"]  : "";
	// profile url
	$incomingProfile  =  (isset($request["profile"])) ? $request["profile"] : "";
	// viewability 
	$incomingViewable =  (isset($request["public"]))  ? $request["public"]  : "";
	// handle checked or not checked
	$incomingViewable =  ($incomingViewable == "true") ? "checked" : "";
	
	// make update network if it's an update
	if($incomingHandle != "" || isset($speakerIdentity))
		$socialAction = "Update";

	// speaker modal view
	$socialModalViewHTML  = "";

	// Get the speaker social items
	$socialType = SocialTypeController::GetById(new SocialType(array(
		"SOCIAL_TYPE_IDENTITY" => $socialIdentity,
		"NAME"				   => null,
		"ICO_URL"			   => null,
		"URL"				   => null,
		"BANNER_URL"		   => null,
		"PLACEHOLDER_A"		   => null
	)));

	// push arguments 
	array_push($arguments,View::MakeViewArgument("SOCIAL_HEADER_LOGO",$socialType->_icoUrl));
	array_push($arguments,View::MakeViewArgument("SOCIAL_HEADER_TYPE",$socialType->_name));
	array_push($arguments,View::MakeViewArgument("SOCIAL_PLACEHOLDER_A",$socialType->_placeHolderA));
	array_push($arguments,View::MakeViewArgument("SOCIAL_URL",$socialType->_url));
	
	// these are for the callback
	array_push($arguments,View::MakeViewArgument("SOCIAL_HANDLE" ,$incomingHandle));
	array_push($arguments,View::MakeViewArgument("SOCIAL_PROFILE",$incomingProfile));
	array_push($arguments,View::MakeViewArgument("SOCIAL_PUBLIC" ,$incomingViewable));
	array_push($arguments,View::MakeViewArgument("SOCIAL_ACTION",$socialAction));
	// apply special arguments to speaker view only
	$socialModalViewController = new ViewController(new View("CREATE_INDEX_SOCIAL_VIEW","Create/CREATE_INDEX_SOCIAL_VIEW.php",$arguments));

	// speaker create view html
	$socialModalViewHTML = $socialModalViewController->renderViewHTML(false,false);

	print $socialModalViewHTML;
}

function handleAccountSignoutGet($request)
{
	// unset the header
	unset($request["m"]);
	Signout();
}

?>