<?php
/**
 * Export to PHP Array plugin for PHPMyAdmin
 * @author Geoffray Warnants
 * @version 0.2b
 */

//
// Database "sic206_EE"
//
$exp_channel_fields_session = array(
  array('field_id'=>40,'field_name'=>'session_day','field_label'=>'Session Day'),
  array('field_id'=>41,'field_name'=>'session_name','field_label'=>'Session Name'),
  array('field_id'=>42,'field_name'=>'session_start_time','field_label'=>'Start Time'),
  array('field_id'=>43,'field_name'=>'session_end_time','field_label'=>'End Time'),
  array('field_id'=>44,'field_name'=>'session_description','field_label'=>'Session Description'),
  array('field_id'=>45,'field_name'=>'session_description_edit','field_label'=>'Description Ready for Editing?'),
  array('field_id'=>46,'field_name'=>'session_room','field_label'=>'Session Room'),
  array('field_id'=>49,'field_name'=>'session_take_aways','field_label'=>'Take Aways'),
  array('field_id'=>50,'field_name'=>'session_development_notes','field_label'=>'Development Notes'),
  array('field_id'=>51,'field_name'=>'session_speakers','field_label'=>'Speakers'),
  array('field_id'=>52,'field_name'=>'session_moderator','field_label'=>'Moderator'),
  array('field_id'=>53,'field_name'=>'session_moderator_info_sent','field_label'=>'Moderator Info Sent?'),
  array('field_id'=>54,'field_name'=>'session_note_takers','field_label'=>'Note Takers'),
  array('field_id'=>55,'field_name'=>'session_liasons','field_label'=>'Liasons'),
  array('field_id'=>59,'field_name'=>'session_logistics_contact','field_label'=>'Logistics Contact'),
  array('field_id'=>60,'field_name'=>'session_next_steps','field_label'=>'Next Steps'),
  array('field_id'=>61,'field_name'=>'session_room_set_up_type','field_label'=>'Room Set-up Type'),
  array('field_id'=>62,'field_name'=>'session_room_setup_notes','field_label'=>'Room Setup Notes'),
  array('field_id'=>63,'field_name'=>'session_stage_setup_notes','field_label'=>'Stage Setup Notes'),
  array('field_id'=>64,'field_name'=>'session_av_form_received','field_label'=>'AV Form Received?'),
  array('field_id'=>65,'field_name'=>'session_av_requirements_checklis','field_label'=>'AV Requirements Checklist'),
  array('field_id'=>66,'field_name'=>'session_summary','field_label'=>'Session Summary'),
  array('field_id'=>67,'field_name'=>'session_av_notes','field_label'=>'AV Notes'),
  array('field_id'=>68,'field_name'=>'session_av_form_sent','field_label'=>'AV Form Sent?'),
  array('field_id'=>69,'field_name'=>'session_video_highlight_link','field_label'=>'Video Highlight Link'),
  array('field_id'=>140,'field_name'=>'session_thought_leaders','field_label'=>'Thought Leaders'),
  array('field_id'=>156,'field_name'=>'session_general_notes','field_label'=>'General Notes'),
  array('field_id'=>157,'field_name'=>'session_is_sponsored','field_label'=>'Session is Sponsored'),
  array('field_id'=>158,'field_name'=>'session_sponsor','field_label'=>'Session Sponsor'),
  array('field_id'=>177,'field_name'=>'session_visible','field_label'=>'Visible on site'),
  array('field_id'=>178,'field_name'=>'session_status','field_label'=>'Session Status'),
  array('field_id'=>185,'field_name'=>'session_topics','field_label'=>'Topics'),
  array('field_id'=>206,'field_name'=>'session_presentations','field_label'=>'Presentations'),
  array('field_id'=>207,'field_name'=>'session_lav_mic','field_label'=>'Lav Mic'),
  array('field_id'=>208,'field_name'=>'session_wired_handheld_mic','field_label'=>'Wired Handheld Mic'),
  array('field_id'=>209,'field_name'=>'session_wireless_handheld_mic','field_label'=>'Wireless Handheld Mic'),
  array('field_id'=>210,'field_name'=>'session_projector','field_label'=>'Projector'),
  array('field_id'=>211,'field_name'=>'session_video_screens','field_label'=>'Video Screens'),
  array('field_id'=>212,'field_name'=>'session_lcd_screen','field_label'=>'LCD Screen'),
  array('field_id'=>213,'field_name'=>'session_dedicated_ethernet_cable','field_label'=>'Dedicated Ethernet Cable'),
  array('field_id'=>214,'field_name'=>'session_podium','field_label'=>'Podium'),
  array('field_id'=>215,'field_name'=>'session_cocktail_round','field_label'=>'Cocktail Round'),
  array('field_id'=>216,'field_name'=>'session_coffee_table','field_label'=>'Coffee Table'),
  array('field_id'=>217,'field_name'=>'session_club_chairs','field_label'=>'Club Chairs'),
  array('field_id'=>218,'field_name'=>'session_high_boy_table','field_label'=>'High Boy Table')
);

$exp_channel_fields_speaker = array(
  array('field_id'=>70,'field_name'=>'speaker_head_shot','field_label'=>'Head Shot'),
  array('field_id'=>71,'field_name'=>'speaker_prefix','field_label'=>'Prefix'),
  array('field_id'=>72,'field_name'=>'speaker_first_name','field_label'=>'First Name'),
  array('field_id'=>73,'field_name'=>'speaker_last_name','field_label'=>'Last Name'),
  array('field_id'=>74,'field_name'=>'speaker_date_invited','field_label'=>'Date Invited'),
  array('field_id'=>75,'field_name'=>'speaker_date_follow_up','field_label'=>'Date Follow-up'),
  array('field_id'=>76,'field_name'=>'speaker_job_title','field_label'=>'Job Title'),
  array('field_id'=>77,'field_name'=>'speaker_company_name','field_label'=>'Company Name'),
  array('field_id'=>78,'field_name'=>'speaker_company_type','field_label'=>'Company Type'),
  array('field_id'=>79,'field_name'=>'speaker_street_address','field_label'=>'Street Address'),
  array('field_id'=>80,'field_name'=>'speaker_country','field_label'=>'Country'),
  array('field_id'=>81,'field_name'=>'speaker_geo_breakdown','field_label'=>'Geo Breakdown'),
  array('field_id'=>82,'field_name'=>'speaker_primary_email_address','field_label'=>'Primary Email Address'),
  array('field_id'=>83,'field_name'=>'speaker_handler_email_address','field_label'=>'Speaker Handler Email Address'),
  array('field_id'=>84,'field_name'=>'speaker_phone_number','field_label'=>'Phone Number'),
  array('field_id'=>85,'field_name'=>'speaker_gender','field_label'=>'Gender'),
  array('field_id'=>86,'field_name'=>'speaker_meal_preference','field_label'=>'Meal Preference'),
  array('field_id'=>87,'field_name'=>'speaker_biography','field_label'=>'Biography'),
  array('field_id'=>88,'field_name'=>'speaker_bio_final','field_label'=>'Bio Final?'),
  array('field_id'=>89,'field_name'=>'speaker_comp_registration','field_label'=>'Comp Registration?'),
  array('field_id'=>90,'field_name'=>'speaker_attendance','field_label'=>'Attendance'),
  array('field_id'=>91,'field_name'=>'speaker_arrival_date','field_label'=>'Arrival Date'),
  array('field_id'=>92,'field_name'=>'speaker_departure_date','field_label'=>'Departure Date'),
  array('field_id'=>93,'field_name'=>'speaker_hotel_comped','field_label'=>'Hotel Comped?'),
  array('field_id'=>94,'field_name'=>'speaker_hotel_nights','field_label'=>'Hotel Nights'),
  array('field_id'=>95,'field_name'=>'speaker_confirmation_number','field_label'=>'Confirmation Number'),
  array('field_id'=>96,'field_name'=>'speaker_flight_comped','field_label'=>'Flight Comped?'),
  array('field_id'=>139,'field_name'=>'speaker_company_website','field_label'=>'Speaker/Company website'),
  array('field_id'=>143,'field_name'=>'speaker_handler_phone_number','field_label'=>'Speaker Handler Phone'),
  array('field_id'=>144,'field_name'=>'speaker_handler_name','field_label'=>'Speaker Handler Name'),
  array('field_id'=>145,'field_name'=>'speaker_sponsor','field_label'=>'Speaker Sponsor'),
  array('field_id'=>155,'field_name'=>'speaker_general_notes','field_label'=>'General Notes'),
  array('field_id'=>161,'field_name'=>'speaker_city','field_label'=>'City'),
  array('field_id'=>162,'field_name'=>'speaker_state','field_label'=>'State'),
  array('field_id'=>163,'field_name'=>'speaker_zip','field_label'=>'Zip Code'),
  array('field_id'=>171,'field_name'=>'speaker_link_website','field_label'=>'Personal Website'),
  array('field_id'=>172,'field_name'=>'speaker_link_linkedin','field_label'=>'Linked In'),
  array('field_id'=>173,'field_name'=>'speaker_link_twitter','field_label'=>'Twitter'),
  array('field_id'=>176,'field_name'=>'speaker_visible','field_label'=>'Visible on site'),
  array('field_id'=>179,'field_name'=>'speaker_status','field_label'=>'Speaker Status'),
  array('field_id'=>184,'field_name'=>'speaker_link_slideshare','field_label'=>'Slideshare'),
  array('field_id'=>189,'field_name'=>'speaker_link_instagram','field_label'=>'Instagram Handle'),
  array('field_id'=>190,'field_name'=>'speaker_release_form','field_label'=>'Speaker Release Form'),
  array('field_id'=>191,'field_name'=>'speaker_hotel_name_address','field_label'=>'Hotel Name and Address'),
  array('field_id'=>192,'field_name'=>'speaker_hotel_info','field_label'=>'Hotel Info'),
  array('field_id'=>193,'field_name'=>'speaker_flight_info','field_label'=>'Flight Info'),
  array('field_id'=>194,'field_name'=>'speaker_guest_first_name','field_label'=>'Guest First Name'),
  array('field_id'=>195,'field_name'=>'speaker_guest_last_name','field_label'=>'Guest Last Name'),
  array('field_id'=>196,'field_name'=>'speaker_guest_job_title','field_label'=>'Guest Job Title'),
  array('field_id'=>197,'field_name'=>'speaker_guest_company','field_label'=>'Guest Company'),
  array('field_id'=>198,'field_name'=>'speaker_guest_street_address','field_label'=>'Guest Street Address'),
  array('field_id'=>199,'field_name'=>'speaker_guest_city','field_label'=>'Guest City'),
  array('field_id'=>200,'field_name'=>'speaker_guest_state','field_label'=>'Guest State'),
  array('field_id'=>201,'field_name'=>'speaker_guest_zip_code','field_label'=>'Guest Zip Code'),
  array('field_id'=>202,'field_name'=>'speaker_guest_country','field_label'=>'Guest Country'),
  array('field_id'=>203,'field_name'=>'speaker_guest_phone','field_label'=>'Guest Phone'),
  array('field_id'=>204,'field_name'=>'speaker_guest_email','field_label'=>'Guest Email'),
  array('field_id'=>205,'field_name'=>'speaker_guest_pass_type','field_label'=>'Guest Pass Type')
);

// sic206_EE.exp_channels
$exp_channels = array(
  array('channel_name'=>'sessions','channel_id'=>16,'channel_title'=>'SIC 2013 Sessions','channel_url'=>'http://2013.seattleinteractive.com/sessions/'),
  array('channel_name'=>'speakers','channel_id'=>17,'channel_title'=>'SIC 2013 Speakers','channel_url'=>'http://2013.seattleinteractive.com/speakers/'),
  array('channel_name'=>'sponsors','channel_id'=>18,'channel_title'=>'SIC 2013 Sponsors','channel_url'=>'http://2013.seattleinteractive.com/sponsors/'),
  array('channel_name'=>'static','channel_id'=>20,'channel_title'=>'SIC 2013','channel_url'=>'http://2013.seattleinteractive.com/')
);

$exp_channel_fields_sponsor = array(
  array('field_id'=>180,'field_name'=>'sponsor_status'					,'field_label'=>'Sponsor Status'),
  array('field_id'=>159,'field_name'=>'sponsor_account_lead'			,'field_label'=>'Account Lead'),
  array('field_id'=>160,'field_name'=>'sponsor_ask_amount'				,'field_label'=>'Sponsorship Ask Amount'),
  array('field_id'=>98, 'field_name'=>'sponsor_logo_web'				,'field_label'=>'Logo (web)'),
  array('field_id'=>99, 'field_name'=>'sponsor_logos_print'				,'field_label'=>'Logos (print)'),
  array('field_id'=>100,'field_name'=>'sponsor_link'					,'field_label'=>'Sponsor Link'),
  array('field_id'=>101,'field_name'=>'sponsor_contact_info'			,'field_label'=>'Contact Info'),
  array('field_id'=>102,'field_name'=>'sponsor_dollar_amount'			,'field_label'=>'Sponsorship Dollar Amount'),
  array('field_id'=>103,'field_name'=>'sponsor_commitment_date'			,'field_label'=>'Commitment Date'),
  array('field_id'=>104,'field_name'=>'sponsor_thank_you_sent_date'		,'field_label'=>'Thank You Sent Date'),
  array('field_id'=>106,'field_name'=>'sponsor_pack_sent_date'			,'field_label'=>'Sponsor Pack Sent Date'),
  array('field_id'=>108,'field_name'=>'sponsor_logo_received'			,'field_label'=>'Logo Received?'),
  array('field_id'=>109,'field_name'=>'sponsor_number_of_comps'			,'field_label'=>'Number of Comps'),
  array('field_id'=>110,'field_name'=>'sponsor_comp_coupon_code'		,'field_label'=>'Comp Coupon Code'),
  array('field_id'=>111,'field_name'=>'sponsor_receive_discount'		,'field_label'=>'Receive Discount?'),
  array('field_id'=>112,'field_name'=>'sponsor_discount_coupon_code'	,'field_label'=>'Discount Coupon Code'),
  array('field_id'=>113,'field_name'=>'sponsor_comp_discount_notes'		,'field_label'=>'Comp & Discount Notes'),
  array('field_id'=>114,'field_name'=>'sponsor_app_spec_sent_date'		,'field_label'=>'App Spec Sent Date'),
  array('field_id'=>115,'field_name'=>'sponsor_date_ad_received'		,'field_label'=>'Date Ad Received'),
  array('field_id'=>116,'field_name'=>'sponsor_ad_size'					,'field_label'=>'Ad Size'),
  array('field_id'=>148,'field_name'=>'sponsor_attendees'				,'field_label'=>'Company Attendees'),
  array('field_id'=>149,'field_name'=>'sponsor_final_payment_received'	,'field_label'=>'Final Payment Received'),
  array('field_id'=>118,'field_name'=>'sponsor_ad_notes'				,'field_label'=>'Ad Notes'),
  array('field_id'=>119,'field_name'=>'sponsor_tote_bag_offered'		,'field_label'=>'Tote Bag Offered?'),
  array('field_id'=>120,'field_name'=>'sponsor_tote_bag_accepted'		,'field_label'=>'Tote Bag Accepted?'),
  array('field_id'=>121,'field_name'=>'sponsor_tote_bag_details'		,'field_label'=>'Tote Bag Details'),
  array('field_id'=>122,'field_name'=>'exhibit_space_offered'			,'field_label'=>'Exhibit Space Offered?'),
  array('field_id'=>124,'field_name'=>'exhibit_furniture_rental'		,'field_label'=>'Furniture Rental?'),
  array('field_id'=>125,'field_name'=>'exhibit_space_number'			,'field_label'=>'Exhibit Space Number'),
  array('field_id'=>126,'field_name'=>'exhibit_space_confirmation'		,'field_label'=>'Exhibit Space Confirmation'),
  array('field_id'=>127,'field_name'=>'exhibit_space_deadline_confirmat','field_label'=>'Exhibit Space Deadline Confirmation'),
  array('field_id'=>147,'field_name'=>'exhibit_space_notes'				,'field_label'=>'Exhibit Space Notes'),
  array('field_id'=>129,'field_name'=>'sponsor_logo_placement'			,'field_label'=>'Logo Placement'),
  array('field_id'=>130,'field_name'=>'sponsor_profile'					,'field_label'=>'Sponsor Profile'),
  array('field_id'=>131,'field_name'=>'sponsor_general_notes'			,'field_label'=>'General Sponsor Notes'),
  array('field_id'=>150,'field_name'=>'sponsor_deposit_received'		,'field_label'=>'Deposit Received'),
  array('field_id'=>151,'field_name'=>'sponsor_final_payment_amount'	,'field_label'=>'Final Payment Amount'),
  array('field_id'=>133,'field_name'=>'sponsor_website_banner'			,'field_label'=>'Website Banner?'),
  array('field_id'=>134,'field_name'=>'sponsor_verbal_recognition'		,'field_label'=>'Verbal Recognition?'),
  array('field_id'=>135,'field_name'=>'sponsor_onsite_meeting_room'		,'field_label'=>'Onsite Meeting Room?'),
  array('field_id'=>152,'field_name'=>'sponsor_deposit_amount'			,'field_label'=>'Deposit Dollar Amount'),
  array('field_id'=>137,'field_name'=>'sponsor_award_ceremony'			,'field_label'=>'Award Ceremony?'),
  array('field_id'=>138,'field_name'=>'sponsor_logo_notes'				,'field_label'=>'Logo Notes'),
  array('field_id'=>146,'field_name'=>'sponsor_discount_amount'			,'field_label'=>'Discount Amount'),
  array('field_id'=>153,'field_name'=>'exhibit_tier_1'					,'field_label'=>'Tier 1 Upgrade'),
  array('field_id'=>154,'field_name'=>'exhibit_space_size'				,'field_label'=>'Exhibit Space Size'),
  array('field_id'=>164,'field_name'=>'sponsor_street_address'			,'field_label'=>'Street Address'),
  array('field_id'=>165,'field_name'=>'sponsor_city'					,'field_label'=>'City'),
  array('field_id'=>166,'field_name'=>'sponsor_state'					,'field_label'=>'State'),
  array('field_id'=>167,'field_name'=>'sponsor_zip'						,'field_label'=>'Zip Code'),
  array('field_id'=>168,'field_name'=>'sponsor_contact_notes'			,'field_label'=>'Contact Notes'),
  array('field_id'=>170,'field_name'=>'sponsor_country'					,'field_label'=>'Country'),
  array('field_id'=>174,'field_name'=>'sponsor_visible'					,'field_label'=>'Visible on site'),
  array('field_id'=>175,'field_name'=>'sponsor_level'					,'field_label'=>'Sponsor Level'),
  array('field_id'=>181,'field_name'=>'sponsor_contract'				,'field_label'=>'Sponsor Contract'),
  array('field_id'=>182,'field_name'=>'sponsor_leave_behind'			,'field_label'=>'Leave Behind'),
  array('field_id'=>183,'field_name'=>'sponsor_leave_behind_notes'		,'field_label'=>'Leave Behind Notes')
);
