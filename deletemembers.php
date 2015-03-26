<?php

include("authen.php");
include("config.php");

$uid = intval($_GET['uid']);
$projectid = intval($_GET['pid']);


$sql2 = "DELETE FROM projectmembers
WHERE userid=$uid AND projectid=$projectid;";
$result2 =mysql_query($sql2,$conc);

header("location: members.php?id=$projectid");

?>