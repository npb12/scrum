<?php
session_start();

###Connect to database###
include("config.php");

$userid = $_SESSION['userid'];


/*
if(isset($_POST['location']))
{
	$location = $_POST['location'];
	$sql = "UPDATE userinfo SET location = '$location' WHERE userid = $userid;";
	$result=mysql_query($sql,$conc) or die("Unable to insert userinfo into db");
	header("location: home.php");
}

if(isset($_POST['about']))
{
	$about = $_POST['about'];
	$sql = "UPDATE userinfo SET about = '$about' WHERE userid = $userid;";
	$result=mysql_query($sql,$conc) or die("Unable to insert userinfo into db");
	header("location: home.php");
}
if(isset($_POST['work']))
{
	$work = $_POST['work'];
	$sql = "UPDATE userinfo SET work =$workwhere userid = $userid;";
	$result=mysql_query($sql,$conc) or die("Unable to insert userinfo into db");
	header("location: home.php");
}
if(isset($_POST['contact']))
{
	$contact = $_POST['contact'];
	$sql = "UPDATE userinfo SET contact = $contact WHERE userid = $userid;";
	$result=mysql_query($sql,$conc) or die("Unable to insert userinfo into db");
	header("location: home.php");
}
*/

$location = mysql_real_escape_string($_POST['location']);
$contact = mysql_real_escape_string($_POST['contact']);
$about = mysql_real_escape_string($_POST['about']);
$work = mysql_real_escape_string($_POST['work']);

	$sql = "UPDATE userinfo SET contact = '$contact', location = '$location', about = '$about', work = '$work' WHERE userid = $userid";
	$result=mysql_query($sql,$conc) or die("Unable to insert userinfo into db");
	header("location: home.php");


?>