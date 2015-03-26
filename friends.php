<?php

//Include MySQL config info
include("config.php");

//Kick out users who are not logged in
include("authen.php");

$userid = $_SESSION['userid'];

//Start printing the page
include("header.php"); //Universal Start of Page

$namequery12="SELECT fname, lname, defaultpicid 
FROM userinfo
WHERE userid = '$userid'"; 
$nameresult12=mysql_query($namequery12) or die("Unable to query 7!");

$name12 = mysql_fetch_assoc($nameresult12);

$fname12 = $name12['fname'];
$lname12 = $name12['lname'];

$fname12 = ucfirst($fname12);
$lname12 = ucfirst($lname12);

$projectsquery3="SELECT projectname, projectid FROM projectmembers WHERE userid = '$userid' AND relation = '1'";
$projectsresult3=mysql_query($projectsquery3) or die("Unable to query DB!");

echo "
<div id =\"mainhome\">
<div id =\"uheader\">
<div id=\"spacer\">
<nav id=\"naver\">
	<ul>
		<li><a href=\"#\">My Projects</a>
			<ul>
";


         while ($row4 = mysql_fetch_assoc($projectsresult3)) 
         { 
            $projectname4 =  $row4["projectname"];
			$projectid4 = $row4["projectid"];

            echo "<li><a href='projecthome.php?id=$projectid4'>$projectname4</a></li>";
         }  
echo"	    </ul>
		</li>
	</ul>
</nav>
<nav id=\"secondnav\">
	<ul>
		<li><a href=\"#\">Requests</a>
			<ul>";

        include("requests.php");

echo"	  </ul>
		</li>
	</ul>
</nav>
<nav id=\"messnav\">
	<ul>
		<li><a href=\"#\">Messages</a>
			<ul>";

        include("mymessages.php");

echo"	  </ul>
		</li>
	</ul>
</nav>
</div>
</div>	 
<div id=\"lefthome\">
<div id=\"homeheadleft\">$fname12 $lname12</div>
<div id=\"picdiv\">
";
if (isset($name12['defaultpicid']))
{
	$picid = $name12['defaultpicid'];
	$picinfoquery = "SELECT ext,width,height FROM pictures WHERE id = '$picid';";
	$result=mysql_query($picinfoquery,$conc) or die("Unable to insert pictureinfo into db");
	
	$picinfo = mysql_fetch_assoc($result);
	$ext = $picinfo['ext'];
	$width = $picinfo['width'];
	$height = $picinfo['height'];
	$picturelocation = "pictures/$picid.$ext";
	echo "<img id=\"propic\" style=\"float: top;\" src=\"$picturelocation\"";
    $newwidth=90;
	$height=($height/$width)*$newwidth;
	$width = $newwidth;
	echo "width=\"$width\" height=\"$height\" alt=\"$fname12 $lname12's Profile Picture\" />";
}
else{
  $picturelocation = "nopicture.png";
  echo "<img id=\"propic\" src=\"$picturelocation\"";
  echo "width=90 height=100 alt=\"$fname12 $lname12's Profile Picture\" />";

}
echo "
</div>
<div class=\"link-list-quad\">
	<a href=\"profile.php?id=$userid\">
	 <span class=\"tit2\">Profile</span>
	 </a>
	<a href=\"friends.php\"><span class=\"tit2\">Associates</span>
	</a>
	<a href=\"todos.php\">Tasks</a>
	<a href=\"privateaccepted.php\"><span class=\"tit2\">Private Views</span>
	</a>  
	
	
</div>

</div>
<div id=\"bodyhome\"><br><br><div id=\"assbody\">";
include ("associates.php");
echo "
</div>
</div>
</div>

";



//Print off the Universal Footer of the page
?>