<?php
function handleAccountRegistrationPost($request)
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
function handleAccountLoginPost($request)
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
			
			// set redirect route
			$redirectTo = ($request["return"] != "") ? "?m=" . $request["return"] : ""; 

			// redirect back to index
			Redirect($redirectTo);
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