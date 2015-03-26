<?php

include("authen.php");
include("config.php");
$userid = $_SESSION['userid'];
$assoc = intval($_GET['id']);


$sql2 = "DELETE FROM relations
WHERE userid1=$assoc AND userid2=$userid OR userid2=$assoc AND userid1=$userid ;";
$result2 =mysql_query($sql2,$conc);

header("location: friends.php");

?>