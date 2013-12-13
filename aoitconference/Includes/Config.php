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
require("Controller/ViewController.php");
require("Controller/AccountController.php");
require("Controller/UserAccessController.php");

// Models
require("Model/View.php");
require("Model/Account.php");
require("Model/UserAccess.php");
?>