<?php
// display errors, warnings, and notices
ini_set("display_errors", true);
error_reporting(E_ALL);
session_start();

// includes
require("Constants.php");
require("DAL.php");

// Utility
require("Utility/GeneralUtility.php");
require("Utility/EventTypeUtility.php");
require("Utility/RoomUtility.php");
require("Utility/SocialTypeUtility.php");
require("Utility/SpeakerUtility.php");
require("Utility/StateUtility.php");
require("Utility/StatusUtility.php");
require("Utility/TopicUtility.php");
require("Utility/TrackUtility.php");
require("Utility/UserUtility.php");
require("Utility/VenueUtility.php");
require("Utility/CountryUtility.php");
require("Utility/AccountTypeUtility.php");

// Main Controllers
require("Controller/IndexGetController.php");
require("Controller/IndexPostController.php");
require("Controller/IndexPutController.php");
require("Controller/IndexDeleteController.php");
require("Controller/ViewController.php");

// Model Controllers
require("Controller/AccountController.php");
require("Controller/UserAccessController.php");
require("Controller/SpeakerController.php");
require("Controller/SpeakerSocialController.php");
require("Controller/SocialTypeController.php");
require("Controller/StatusController.php");
require("Controller/TopicController.php");
require("Controller/TrackController.php");
require("Controller/EventTypeController.php");
require("Controller/StateController.php");
require("Controller/VenueController.php");
require("Controller/RoomController.php");
require("Controller/CountryController.php");

// Models
require("Model/View.php");
require("Model/Account.php");
require("Model/UserAccess.php");
require("Model/Speaker.php");
require("Model/SpeakerSocial.php");
require("Model/SocialType.php");
require("Model/Status.php");
require("Model/Topic.php");
require("Model/Track.php");
require("Model/EventType.php");
require("Model/State.php");
require("Model/Venue.php");
require("Model/Room.php");
require("Model/Country.php");
?>