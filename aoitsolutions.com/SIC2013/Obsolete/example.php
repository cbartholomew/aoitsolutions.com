<?
require_once(dirname(__FILE__) . "/includes/DAL.php");

$sql = "SELECT * FROM  exp_categories";

$result = mysql_query($sql) or die (show_error('Problem with pulling boards by state'));
	// push the boards onto the array stack LIFO
	if (mysql_num_rows($result) > 0) 
	{
	   while($row = mysql_fetch_array($result))
	   {	   
			echo $row["cat_name"];
	   }	
	}
	
	
	// // connect to database server
	// if (($connection = @mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD)) === false)
	//     echo "Could not connect to database server.";
	// 
	// // select database
	// if (@mysql_select_db(DB_NAME, $connection) === false)
	//     echo "Could not select database (" . DB_NAME . ").";
	
	// function close_connection()
	// {
	// 	mysql_close($connection);
	// }
?>