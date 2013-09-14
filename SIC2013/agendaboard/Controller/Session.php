<?php		
	class Session
	{	
		// sql query, done in such a way where it is easier to add fields, if needed
	    public static $sessionQueries = array(
			"get" => array(
							"SELECT",
							"field_id_40  as session_day,",
							"field_id_41  as session_name,",
							"field_id_42  as session_start_time,",
							"field_id_43  as session_end_time,",
							"field_id_44  as session_description,",
							"field_id_46  as session_room,",
							"field_id_51  as session_speakers,",
							"field_id_52  as session_moderator,",
							"field_id_185 as session_topics,",
							"field_id_157 as session_is_sponsored,",
							"field_id_158 as session_sponsor,",
							"field_id_177 as session_visible,",
							"field_id_178 as session_status",
							"FROM",
							"exp_channel_data AS ecd",
							"WHERE",
							"ecd.site_id = ?",
							"AND",
							"ecd.channel_id = ?"
					 )
		);	
		
		public static function get($site_id, $channel_id)
		{
			// get that specific static query
			$getQuery = self::$sessionQueries["get"];
			
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
	}
?>