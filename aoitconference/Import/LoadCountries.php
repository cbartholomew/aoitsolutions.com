<?php
// includes
require("includes/Config.php");

// define the file path
define("FILE_PATH", "countries.txt");

// get the file's data
$file = file_get_contents(FILE_PATH, FILE_USE_INCLUDE_PATH);

// split by new line
$lines = explode("\n", $file);

// for each line... insert country
for ($i=0, $n=count($lines); $i < $n ; $i++) 
{ 
	// split the iso code and name 
	$splits = explode("^",$lines[$i]);

	// load country object
	$country = new Country(array(
		"COUNTRY_IDENTITY"			=> null,
		"ISO_CODE" 					=> $splits[0],
		"NAME" 						=> $splits[1]
	));

	// call post
	$result = CountryController::Post($country);

	// print result
	printf("Country %s has inserted: %i<br>",$country->_name,$result);
}

?>