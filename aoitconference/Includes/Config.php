<?php
// display errors, warnings, and notices
ini_set("display_errors", true);
error_reporting(E_ALL);
session_start();

// includes
require("Constants.php");
require("Utilities.php");
require("DAL.php");

// Controllers
require("Controller/IndexGetController.php");
require("Controller/IndexPostController.php");
require("Controller/ViewController.php");
require("Controller/AccountController.php");
require("Controller/UserAccessController.php");
require("Controller/SpeakerController.php");
require("Controller/SpeakerSocialController.php");
require("Controller/SocialTypeController.php");
require("Controller/StatusController.php");

// Models
require("Model/View.php");
require("Model/Account.php");
require("Model/UserAccess.php");
require("Model/Speaker.php");
require("Model/SpeakerSocial.php");
require("Model/SocialType.php");
require("Model/Status.php");

?>