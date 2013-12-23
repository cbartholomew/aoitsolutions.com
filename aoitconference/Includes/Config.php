<?php
// display errors, warnings, and notices
ini_set("display_errors", true);
error_reporting(E_ALL);
session_start();

// includes
require("Constants.php");
require("Utilities.php");
require("DAL.php");

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
?>