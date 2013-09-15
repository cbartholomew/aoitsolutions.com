<?php		
	class Sponsor
	{			
		public static function get($site_id, $channel_id)
		{
			// get that specific static query
			$getQuery = self::$sponsorQueries["get"];
			
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
		
		public static function getSponsorFileById($file_id)
		{			
			// get that specific static query
			$getQuery = self::$sponsorQueries["getSponsorFileById"];
			
			// join the array of sql strings using space
			$sql = implode(" ",$getQuery);
			
			try
			{
				// return results based on the site and channel
				return query($sql, $file_id);
			}
			catch (Exception $e)
            {
                // trigger (big, orange) error
                trigger_error($e->getMessage(), E_USER_ERROR);
                exit;
            }
		}
		
		// sql query, done in such a way where it is easier to add fields, if needed
	    public static $sponsorQueries = array(
			"get" => array(
							"SELECT",
							"field_id_180 as sponsor_status					,",
							"field_id_159 as sponsor_account_lead			,",
							"field_id_160 as sponsor_ask_amount				,",
							"field_id_98  as sponsor_logo_web				,",
							"field_id_99  as sponsor_logos_print			,",
							"field_id_100 as sponsor_link					,",
							"field_id_101 as sponsor_contact_info			,",
							"field_id_102 as sponsor_dollar_amount			,",
							"field_id_103 as sponsor_commitment_date		,",
							"field_id_104 as sponsor_thank_you_sent_date	,",
							"field_id_106 as sponsor_pack_sent_date			,",
							"field_id_108 as sponsor_logo_received			,",
							"field_id_109 as sponsor_number_of_comps		,",
							"field_id_110 as sponsor_comp_coupon_code		,",
							"field_id_111 as sponsor_receive_discount		,",
							"field_id_112 as sponsor_discount_coupon_code	,",
							"field_id_113 as sponsor_comp_discount_notes	,",
							"field_id_114 as sponsor_app_spec_sent_date		,",
							"field_id_115 as sponsor_date_ad_received		,",
							"field_id_116 as sponsor_ad_size				,",
							"field_id_148 as sponsor_attendees				,",
							"field_id_149 as sponsor_final_payment_received	,",
							"field_id_118 as sponsor_ad_notes				,",
							"field_id_119 as sponsor_tote_bag_offered		,",
							"field_id_120 as sponsor_tote_bag_accepted		,",
							"field_id_121 as sponsor_tote_bag_details		,",
							"field_id_122 as exhibit_space_offered			,",
							"field_id_124 as exhibit_furniture_rental		,",
							"field_id_125 as exhibit_space_number			,",
							"field_id_126 as exhibit_space_confirmation		,",
							"field_id_127 as exhibit_space_deadline_confirmat,",
							"field_id_147 as exhibit_space_notes			,",
							"field_id_129 as sponsor_logo_placement		    ,",
							"field_id_130 as sponsor_profile				,",
							"field_id_131 as sponsor_general_notes			,",
							"field_id_150 as sponsor_deposit_received		,",
							"field_id_151 as sponsor_final_payment_amount	,",
							"field_id_133 as sponsor_website_banner			,",
							"field_id_134 as sponsor_verbal_recognition		,",
							"field_id_135 as sponsor_onsite_meeting_room	,",
							"field_id_152 as sponsor_deposit_amount		    ,",
							"field_id_137 as sponsor_award_ceremony			,",
							"field_id_138 as sponsor_logo_notes				,",
							"field_id_146 as sponsor_discount_amount		,",
							"field_id_153 as exhibit_tier_1					,",
							"field_id_154 as exhibit_space_size				,",
							"field_id_164 as sponsor_street_address			,",
							"field_id_165 as sponsor_city					,",
							"field_id_166 as sponsor_state					,",
							"field_id_167 as sponsor_zip					,",
							"field_id_168 as sponsor_contact_notes			,",
							"field_id_170 as sponsor_country				,",
							"field_id_174 as sponsor_visible				,",
							"field_id_175 as sponsor_level					,",
							"field_id_181 as sponsor_contract				,",
							"field_id_182 as sponsor_leave_behind			,",
							"field_id_183 as sponsor_leave_behind_notes		 ",
							"FROM  exp_channel_data AS ecd                   ",
							"WHERE ecd.site_id 	 	= ?                      ",
							"AND   ecd.field_id_180 in ('active','pending')  ",
							"AND   ecd.channel_id 	= ?                      ",
					 ),
			 "getSponsorFileById" => array(
			 			"SELECT", 
						"*", 
						"FROM",
						"exp_files",
						"WHERE", 
						"file_id = ?"
			 		)
		);
	}
?>