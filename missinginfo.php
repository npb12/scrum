<?php
//Get our userid
$userid = $_SESSION['userid'];

//Get Info about this user
$userinfoquery="SELECT * FROM userinfo WHERE userid='$userid'";
$userinforesult = mysql_query($userinfoquery);
$userinfo = mysql_fetch_assoc($userinforesult);

//Check for Requests
$requestsquery="SELECT * FROM relations WHERE userid1='$userid' and relation='0';";
$requestsresult=mysql_query($requestsquery) or die('Unable to check for requests');
$numberofrequests = mysql_num_rows($requestsresult);

//If there are requests, bug user about it
if ($numberofrequests)
{
		echo "<h3>You have $numberofrequests Request(s)!</h3><table id='requeststable' class='requesttable'><tr>";
		$thecount = 0;
		
		//Print off the first three requests
		for ($thecount; ($thecount < 3) && ($thecount < $numberofrequests); $thecount++) 
		{
			//Get the data
			$row = mysql_fetch_assoc($requestsresult);
			
			//Get Info about this user
			$requesterid =  $row["userid2"];
			$requesterquery="SELECT * FROM userinfo WHERE userid='$requesterid'";
			$requesterresult=mysql_query($requesterquery) or die("Unable to query for user!");
			$requesterinfo = mysql_fetch_assoc($requesterresult);	
			$fname = $requesterinfo['fname'];
			$lname = $requesterinfo['lname'];
				
			//Print Table Content
			echo "<tr><td>
				<h3><a href='profile.php?id=$requesterid' 'alt='$fname $lname's Profile'>$fname $lname</a></h3><td>
				<button type=\"button\" onclick=\"window.location = 'addfriend.php?id=$requesterid';\">Approve</button> <button type=\"button\" onclick=\"window.location = 'denyrequest.php?id=$requesterid';\">Deny</button>
				</td></tr>";
		}
		echo "</table>";
		
		//If there are more request, give user option to go to that page
		if (($numberofrequests - $thecount) != 0)
			echo "<hr><button type=\"button\" onclick=\"goToMyRequests()\">See all $numberofrequests requests</button>";
}
/*
if (!isset($userinfo['defaultpicid']))
{
	echo "<hr><h3>Upload a profile picture!</h3>";
	include ("profpicform.php");
	echo "<hr>";
}
*/
if(!isset($userinfo['location']))
{
	echo "<h3>Location</h3><form name=\"input\" onsubmit=\"return validatemissinginfolocation()\" action=\"updateprofile.php\" method=\"get\"> <input type=\"text\" name=\"location\" /><input type=\"submit\" value=\"Submit\"/></form>";
}
if(!isset($userinfo['about']))
{
	echo "<h3>About</h3><form name=\"input\" onsubmit=\"return validatemissinginfoabout()\" action=\"updateprofile.php\" method=\"get\"><input type=\"text\" name=\"about\" /><input type=\"submit\" value=\"Submit\"/></form>";
}
if(!isset($userinfo['work']))
{
echo "<h3>Work/Portfolio</h3><form name=\"input\" onsubmit=\"return validatemissinginfowork()\" action=\"updateprofile.php\" method=\"get\"> <input type=\"text\" name=\"work\" /><input type=\"submit\" value=\"Submit\"/></form>";
}
if(!isset($userinfo['contact']))
{
	echo "<h3>Contact info</h3><form name=\"input\" onsubmit=\"return validatemissinginfocontact()\" action=\"updateprofile.php\" method=\"get\"> <input type=\"text\" name=\"contact\" /><input type=\"submit\" value=\"Submit\"/></form>";
}

?>