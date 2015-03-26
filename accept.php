<?php

//Include MySQL config info
include("config.php");

//Kick out users who are not logged in
include("authen.php");

include ("friendingfunctions.php");


$projectid = intval($_GET['pid']);
$userid = intval($_GET['rid']);


$requestquery="UPDATE projectmembers SET relation= '1' WHERE userid = '$userid' AND projectid = '$projectid'";
$result=mysql_query($requestquery,$conc) or die("Unable to send friend request");

$sql2 = "insert into roles(projectid, userid) values('$projectid','$userid')";
$result2 =mysql_query($sql2,$conc);

$addassoquery="select userid from projectmembers where $projectid = projectid AND $userid != userid";
$addassoresult=mysql_query($addassoquery);
	

	while($row = mysql_fetch_assoc($addassoresult))
	{	
	$userid2 = $row['userid'];
	$f = friendStatus($userid, $userid2);
	if($f == 0)
	{
		$sql3 = "insert into relations(userid1, userid2, relation) values('$userid','$userid2', '2')";
		$result3 =mysql_query($sql3,$conc);	
	}
	
	}
	
	
	

header("location: home.php");






?>