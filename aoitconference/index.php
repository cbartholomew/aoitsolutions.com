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
	break;
	
	case "PUT":
	break;
	
	case "DELETE":
	break;
	
	case "GET":
		handleGetRequests($_GET);
	break;
}

function handleGetRequests($request)
{
	if(isset($request["operation"]))
	{
		switch($request["operation"])
		{
			case "login":
				echo "login";
			break;
		}	
	}
	else
	{
		// make arguments array to hold new view arguments
		$arguments = array();
       
		// check if the user is logged in or not
		$viewHtmlPath  = (isset($_SESSION['identity'])) ? "View/SUB_HEADER_VIEW_AUTH.php" : "View/SUB_HEADER_VIEW_NOAUTH.php";
       
		// get the sub header information
		$viewHtml = file_get_contents($viewHtmlPath);
       
		// push on to the argument stack
		array_push($arguments,View::MakeViewArgument("ACCOUNT_DROPDOWN",$viewHtml));
       
		// create new view controller
		$vc = new ViewController(new View("INDEX_VIEW","INDEX_VIEW.php",$arguments));
       
		// this method will render w arguments
		print $vc->renderViewHTML(true,true);
	}
}							
?>