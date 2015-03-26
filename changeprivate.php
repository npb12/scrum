<?php

include("authen.php");
include("config.php");

$projectid = intval($_GET['id']);


 
$projectsquery="UPDATE projects SET privacy = '1' WHERE projectid = '$projectid'";
$projectsresult=mysql_query($projectsquery) or die("Unable to query DB!");
header("location: projecthome.php?id=".$projectid);






?>