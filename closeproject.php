<?php

include("authen.php");
include("config.php");

$projectid = intval($_GET['id']);





$projectsquery="UPDATE projects SET onoff = '1' WHERE projectid = '$projectid'";
$projectsresult=mysql_query($projectsquery) or die("Unable to query DB!");
header("location: projecthome.php?id=".$projectid);






?>