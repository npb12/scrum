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
	case 3:
		echo "<h2 align=\"center\" class=\"err\">You have already sent a request to view this project!<br />";
		echo "<button onclick=\"goHome()\">Click here to go back to the homepage</button>";
	
	case 0:
		{	//This completes a project view request
		$projrequestquery="insert into projectmembers(projectid, projectname, userid, op, relation) values('$projectid', '$projectname', '$userid','0','3')";
		$result=mysql_query($projrequestquery,$conc) or die("Unable to send friend request");
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


}

?>