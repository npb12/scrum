<?php

include("authen.php");
include("config.php");
$userid = intval($_GET['id']);
$myuserid = $_SESSION['userid'];

//If not own profile, let's look into friend status
$userquery="SELECT * FROM userinfo WHERE userid = '$userid';";
$userresult=mysql_query($userquery) or die("Unable to query DB!");

$friendstatus = friendStatus($userid,$myuserid);

$row = mysql_fetch_assoc($userresult);

$location = $row['location'];
$contact = $row['contact'];
$about = $row['about'];
$work = $row['work'];

echo"
<div id =\"usertain\">
<div id=\"headprof\">Location</div>
<div id=\"tainpro\"></div>
";
echo "<div id=\"contprof\">$location<br></div>
      <div id=\"headprof\">Contact</div>
	  <div id=\"tainpro\"></div>
      <div id=\"contprof\">$contact<br></div>
	  <div id=\"headprof\">About</div> 
	  <div id=\"tainpro\"></div>
	  <div id=\"contprof\">$about<br></div> 
	  <div id=\"headprof\">Work</div>
	  <div id=\"tainpro\"></div>
	  <div id=\"contprof\">$work</div>
	  
	  
	  
</div>";


?>