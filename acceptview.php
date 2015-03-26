<?php

//Include MySQL config info
include("config.php");

//Kick out users who are not logged in
include("authen.php");


$projectid = intval($_GET['pid']);
$userid = intval($_GET['rid']);



$requestquery="UPDATE projectmembers SET relation= '4' WHERE userid = '$userid' AND projectid = '$projectid'";
$result=mysql_query($requestquery,$conc) or die("Unable to send friend request");


	
	

header("location: home.php");






?>