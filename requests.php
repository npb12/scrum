<?php

//Include MySQL config info
include("config.php");

//Kick out users who are not logged in
include("authen.php");


 //Universal Start of Page



$myuserid = $_SESSION['userid'];
$requestsquery="SELECT * FROM relations WHERE userid1='$myuserid' and relation='0';";
$requestsresult=mysql_query($requestsquery) or die('Unable to check for requests');
$numberofrequests = mysql_num_rows($requestsresult);



if ($numberofrequests)
{

		 while ($row = mysql_fetch_assoc($requestsresult)) 
		{
			//Get Info about this user
		$requesterid =  $row["userid2"];
		$requesterquery="SELECT * FROM userinfo WHERE userid='$requesterid'";
		$requesterresult=mysql_query($requesterquery) or die("Unable to query for user!");
		$requesterinfo = mysql_fetch_assoc($requesterresult);	
	
		//Check whether query was successful or not
		$fname8 = $requesterinfo['fname'];
		$lname8 = $requesterinfo['lname'];
		
		$fname8 = ucfirst($fname8);
        $lname8 = ucfirst($lname8);
		
		
		//Print Table Content
		echo "<li id=\"projassdiv\"><a href='profile.php?id=$requesterid'>$fname8 $lname8</a> wants to be an associate  ";
    	echo " <button type=\"button\" id=\"postbox3\"  onclick=\"window.location = 'denyrequest.php?id=$requesterid';\">Deny</button> <button type=\"button\" id=\"postbox3\" onclick=\"window.location = 'addfriend.php?id=$requesterid';\">Accept</button></li>";
		}
}


while ($row5 = mysql_fetch_assoc($requestsresult)) {
    echo $row5["userid"];
    echo $row5["fullname"];
    echo $row5["userstatus"];
}


include("projectrequest.php");
?>