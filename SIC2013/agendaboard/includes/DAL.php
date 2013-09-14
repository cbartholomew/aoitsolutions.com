<?php


// Test
define("DB_NAME", 	   "sic206_EE");
define("DB_SERVER",    "localhost");
define("DB_USERNAME",  "root");
define("DB_PASSWORD",  "root");

// Production
// define("DB_NAME", 	   "sic206_EE");
// define("DB_SERVER",    "localhost");
// define("DB_USERNAME",  "sic206_readonly");
// define("DB_PASSWORD",  "wQC4R6jx7Z");
 

// connect to database server
if (($connection = @mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD)) === false)
    echo "Could not connect to database server.";

// select database
if (@mysql_select_db(DB_NAME, $connection) === false)
    echo "Could not select database (" . DB_NAME . ").";

function close_connection()
{
	mysql_close($connection);
}

?>

