<?php

include("authen.php");
include("config.php");

$id = intval($_GET['id']);
$projectid = intval($_GET['pid']);


$sql2 = "DELETE FROM todos
WHERE id=$id;";
$result2 =mysql_query($sql2,$conc);

header("location: projtodos.php?id=$projectid");

?>