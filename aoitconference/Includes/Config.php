<?php
// display errors, warnings, and notices
ini_set("display_errors", true);
error_reporting(E_ALL);
session_start();
require("Constants.php");
require("Utilities.php");
require("DAL.php");
require("Controller/ViewController.php");
require("Model/View.php");

?>