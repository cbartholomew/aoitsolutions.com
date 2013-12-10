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
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// get the operation
		
		
	}
	else
	{
		// render the normal index view menu
		
		// create new view controller
		$vc = new ViewController(new View("INDEX_VIEW","INDEX_VIEW.php"));
		
 		// this method will render w/o arguments
		$vc->renderView();	
	}											
?>