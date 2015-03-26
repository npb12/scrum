<?php
include("authen.php");
include("config.php");

$userid = $_SESSION['userid'];
$content = mysql_real_escape_string($_POST['comment']); //fix to make sure query is not messed up

if(isset($_GET['recipient']))
{
	//The user is posting on another's wall
	$projectid = intval($_GET['recipient']);
	$sql = "INSERT into comments(userid,projectid,content) values('$userid','$projectid','$content')";	
	$result=mysql_query($sql,$conc) or die("Unable to insert your posting to $projectid into db");
	header("location: projecthome.php?id=".$projectid);
}
?>