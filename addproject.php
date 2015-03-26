<?php

//Include MySQL config info
include("config.php");

//Kick out users who are not logged in
include("authen.php");

//Library of Friend Functions
include("projectfunctions.php");

//Check to see if user requested exists
$projectid = intval($_GET['id']);


$userid = $_SESSION['userid'];

$projectquery="SELECT projectname FROM projectmembers WHERE projectid = '$projectid'"; 
$projectresult=mysql_query($projectquery);
	
$row = mysql_fetch_assoc($projectresult);
	
$projectname = $row['projectname'];

//Get the current relation status
$p = projectStatus($userid,$projectid);

//Based on this relation status, do what is appriopate. 
switch ($p)
{	
	case 0:
		{	//This completes a project request
		$projrequestquery="insert into projectmembers(projectid, projectname, userid, op, relation) values('$projectid', '$projectname', '$userid','0','0')";
		$result=mysql_query($projrequestquery,$conc) or die("Unable to send sez");
		header("location: projects.php"); //Redirect back to user's profile
		}
		break;
	case 1:
		{//already a member, to home
		echo "<h2 align=\"center\" class=\"err\">You are already a member of this project!<br />";
		echo "<button onclick=\"goHome()\">Click here to go back to the homepage</button>";
		include ('footer.php'); 
		}
		break;
	case 2:
		{//pending request
		echo "<h2 align=\"center\" class=\"err\">You have sent a request for this project!<br />";
		echo "<button onclick=\"goHome()\">Click here to go back to the homepage</button>";
		include ('footer.php'); 
	}
		break;
	case 3:
		{//view request pending
		echo "<h2 align=\"center\" class=\"err\">Your view request is currently pending!<br />";
		echo "<button onclick=\"goHome()\">Click here to go back to the homepage</button>";
		include ('footer.php'); 
	}
		break;
	case 4:
		{//private view approved
		$updatequery="UPDATE projectmembers SET relation = '0' WHERE userid = $userid AND projectid = $projectid;";
		$updateresult=mysql_query($updatequery,$conc) or die("Unable to send friend request");
		header("location: projects.php"); //Redirect back to user's profile
	}
		break;


}