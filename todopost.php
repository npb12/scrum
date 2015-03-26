<?php
include("authen.php");
include("config.php");

$userid = $_SESSION['userid'];
$content = mysql_real_escape_string($_POST['comment']); //fix to make sure query is not messed up

if(isset($_GET['recipient']))
{
	//The user is posting on another's wall
	$projectid = intval($_GET['recipient']);
	$sql = "INSERT into todos(userid,projectid,todo) values('$userid','$projectid','$content')";	
	$result=mysql_query($sql,$conc) or die("Unable to insert your posting to $projectid into db");
	header("location: projtodos.php?id=".$projectid);
}
?>