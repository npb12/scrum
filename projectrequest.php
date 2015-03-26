<?php

//Include MySQL config info
include("config.php");

//Kick out users who are not logged in
include("authen.php");



$myuserid = $_SESSION['userid'];

$projectquery3="SELECT projectid, projectname FROM projectmembers WHERE userid = '$myuserid' AND op = '1'"; 
$projectresult3=mysql_query($projectquery3);


	
while($row3 = mysql_fetch_assoc($projectresult3))
{	

	$projectname4 = $row3['projectname'];
	$projectid4 = $row3['projectid'];

	$requestquery3 = "SELECT userid FROM projectmembers WHERE projectid = '$projectid4' AND relation = '0'";
	$requestresult3=mysql_query($requestquery3) or die("Unable to query for user!");
	
	while($row32 = mysql_fetch_assoc($requestresult3))
	{
   
	$rid = $row32['userid'];
	    $namequery9 = "SELECT fname, lname FROM userinfo WHERE userid = $rid";
		$nameresult9=mysql_query($namequery9);
		$row33 = mysql_fetch_assoc($nameresult9);

		$fname4 = $row33['fname'];
		$lname4 = $row33['lname'];
		
		$fname4 = ucfirst($fname4);
        $lname4 = ucfirst($lname4);
		
		echo "<li id=\"projreqdiv\"><a href='profile.php?id=$myuserid'>$fname4 $lname4</a> wants to join $projectname4   ";
		echo " <button type=\"button\" id=\"postbox3\" style=\"font: 24px ;\" onclick=\"window.location = 'deny.php?rid=$rid&amp;pid=$projectid4;';\">Deny</button>";
		echo "<button type=\"button\" id=\"postbox3\" style=\"font: 24px ;\" onclick=\"window.location = 'accept.php?rid=$rid&amp;pid=$projectid4;';\">Accept</button> </li>";
		
	}
	
	
	$requestquery2 = "SELECT userid FROM projectmembers WHERE projectid = '$projectid4' AND relation = '3'";
	$requestresult2=mysql_query($requestquery2) or die("Unable to query for user!");
	while($row34 =  mysql_fetch_assoc($requestresult2))
	{
	    $rid2 = $row34['userid'];
	    $namequery2 = "SELECT fname, lname FROM userinfo WHERE userid = $rid2";
		$nameresult2=mysql_query($namequery2);
		$row34 = mysql_fetch_assoc($nameresult2);
		
		$fname = $row34['fname'];
		$lname = $row34['lname'];
		
		$fname = ucfirst($fname);
        $lname = ucfirst($lname);
		
		echo "<li id=\"projreqdiv\"><a href='profile.php?id=$myuserid'>$fname $lname</a> wants to view $projectname4's details   ";
		echo " <button type=\"button\" id=\"postbox3\" style=\"font: 24px ;\" onclick=\"window.location = 'deny.php?rid=$rid2&amp;pid=$projectid4;';\">Deny</button>";
        echo "<button type=\"button\" id=\"postbox3\" style=\"font: 24px ;\" onclick=\"window.location = 'acceptview.php?rid=$rid2&amp;pid=$projectid4;';\">Accept</button></li> ";
	
	}


}









		




?>