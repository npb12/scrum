<?php

//Start Session
session_start();

//Include Config
include("config.php");

//Print Page
include("header.php");

if(!isset($_SESSION['userid']))
{
	include ('regform.php'); 
}
else
{
	echo "<button onclick=\"goHome()\">Click here to go back to the homepage</button>";
}
include ('footer.php'); 
?>