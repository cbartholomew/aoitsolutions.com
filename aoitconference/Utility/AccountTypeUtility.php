<?php
function IsAccountTypeCanEdit($userAccess)
{
	// create new account object
	$account = new Account(array(
		"IDENTITY"					=> $userAccess->_accountIdentity,
		"EMAIL_ADDRESS" 			=> null,
		"FIRST_NAME" 				=> null,
		"LAST_NAME"  				=> null,
		"ORGANIZATION_NAME" 		=> null,
		"ACCOUNT_TYPE_IDENTITY"  	=> null,
		"ACCOUNT_DISABLED" 			=> null
	));

	// get account information
	$account = AccountController::GetById($account);

	// return based on the following if the user has global edit privledges 
	return ($account->_accountTypeIdentity == MASTER || $account->_accountTypeIdentity == ADMINISTRATOR);
}

?>