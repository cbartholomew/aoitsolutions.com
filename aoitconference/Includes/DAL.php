<?php
// Switch for production
$isProd = false;

// based on the value above, swap constants files
$DAL_SETTINGS_FILE = ($isProd) ? "dalSettingsProd.php" : "dalSettingsTest.php";
	
require_once($DAL_SETTINGS_FILE);

/**
 * Executes SQL statement, possibly with parameters, returning
 * an array of all rows in result set or false on (non-fatal) error.
 */
function query(/* $sql [, ... ] */)
{
    // SQL statement
    $sql = func_get_arg(0);

    // parameters, if any
    $parameters = array_slice(func_get_args(), 1);

    // try to connect to database
    static $handle;
    if (!isset($handle))
    {
        try
        {
            // connect to database
            $handle = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_SERVER, DB_USERNAME, DB_PASSWORD);

            // ensure that PDO::prepare returns false when passed invalid SQL
            $handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
        }
        catch (Exception $e)
        {
            // trigger (big, orange) error
            trigger_error($e->getMessage(), E_USER_ERROR);
            exit;
        }
    }

    // prepare SQL statement
    $statement = $handle->prepare($sql);

    if ($statement === false)
    {
        //trigger (big, orange) error
		$error_info = $handle->errorInfo();
        trigger_error($error_info[2], E_USER_ERROR);
        exit;
    }

    // execute SQL statement
    $results = $statement->execute($parameters);

    // return result set's rows, if any
    if ($results !== false)
    {
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    else
    {
        return false;
    }
}

?>

