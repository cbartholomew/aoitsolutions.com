<?php
	require_once("includes/DAL.php");
	
	class Category
	{
		public static function get()
		{
			$sql = "SELECT * FROM exp_categories";
			try
			{
				return query($sql);
			}
			catch (Exception $e)
            {
                // trigger (big, orange) error
                trigger_error($e->getMessage(), E_USER_ERROR);
                exit;
            }	
		}
	}
?>