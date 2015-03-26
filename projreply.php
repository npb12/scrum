<?php
include("authen.php");
include("config.php");

$userid = $_SESSION['userid'];
$content = mysql_real_escape_string($_POST['reply']); //fix to make sure query is not messed up

if(isset($_GET['recipient']))
{
	//The user is posting on another's wall
	$commentid = intval($_GET['recipient']);
	$projectid = intval($_GET['pid']);
	$sql = "INSERT into replys(commentid, userid,content) values('$commentid', '$userid','$content')";	
	$result=mysql_query($sql,$conc) or die("Unable to insert your posting to $projectid into db");
	header("location: projecthome.php?id=".$projectid);
}
?>