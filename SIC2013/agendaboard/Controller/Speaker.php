<?php		
	class Speaker
	{			
		public static function get($site_id, $channel_id)
		{
			// get that specific static query
			$getQuery = self::$speakerQueries["get"];
			
			// join the array of sql strings using space
			$sql = implode(" ",$getQuery);
			
			try
			{
				// return results based on the site and channel
				return query($sql, $site_id, $channel_id);
			}
			catch (Exception $e)
            {
                // trigger (big, orange) error
                trigger_error($e->getMessage(), E_USER_ERROR);
                exit;
            }	
		}
		
		public static function getByEntryId($entry_id)
		{			
			// get that specific static query
			$getQuery = self::$speakerQueries["getByEntryId"];
			
			// join the array of sql strings using space
			$sql = implode(" ",$getQuery);
			
			try
			{
				// return results based on the site and channel
				return query($sql, $entry_id);
			}
			catch (Exception $e)
            {
                // trigger (big, orange) error
                trigger_error($e->getMessage(), E_USER_ERROR);
                exit;
            }
		}
		
		// sql query, done in such a way where it is easier to add fields, if needed
	    public static $speakerQueries = array(
			"get" => array(
							"SELECT DISTINCT",
							"field_id_72 	as speaker_first_name,",
							"field_id_73    as speaker_last_name,",
							"field_id_179 	as speaker_status,",
							"field_id_76 	as speaker_job_title,",
							"field_id_77 	as speaker_company_name",
							"FROM",
							"exp_channel_data AS ecd",
							"INNER JOIN exp_channel_titles AS ect",
							"ON ecd.entry_id = ect.entry_id",
							"INNER JOIN exp_channels AS ec",
							"ON ecd.channel_id = ec.channel_id",
							"INNER JOIN exp_category_posts as ecp",
							"ON ecp.entry_id = ecd.entry_id",							
							"WHERE",
							"ec.site_id = ?",
							"AND",
							"ec.channel_id = ?"
					 ),
			 "getByEntryId" => array(
			 			"SELECT DISTINCT",
						"field_id_72 	as speaker_first_name,",
						"field_id_73    as speaker_last_name,",
						"field_id_179	as speaker_status,",
						"field_id_76 	as speaker_job_title,",
						"field_id_77 	as speaker_company_name",
						"FROM",
						"exp_channel_data AS ecd",
						"INNER JOIN exp_channel_titles AS ect",
						"ON ecd.entry_id = ect.entry_id",
						"INNER JOIN exp_channels AS ec",
						"ON ecd.channel_id = ec.channel_id",
						"INNER JOIN exp_category_posts as ecp",
						"ON ecp.entry_id = ecd.entry_id",							
						"WHERE",
						"ecd.entry_id = ?"
			 		)
		);
	}
?>