<?php
include("authen.php");
include("config.php");


include("header.php"); //Universal Start of Page
include ("projectfunctions.php");
$userid = $_SESSION['userid'];
$projectid = intval($_GET['id']);

$projectsquery2="SELECT projectname, projectid FROM projectmembers WHERE userid = '$userid' AND relation = '1'";
$projectsresult2=mysql_query($projectsquery2) or die("Unable to query DB!");

$p = projectStatus($userid, $projectid);

$projectinfoquery="SELECT * FROM projects WHERE projectid='$projectid'";
$projectinforesult=mysql_query($projectinfoquery);
	
//Check whether query was successful or not
$projectinfo = mysql_fetch_assoc($projectinforesult);

$projectname = $projectinfo['projectname'];
$description = $projectinfo['description'];
$needs = $projectinfo['needs'];
//$details = $projectinfo['details'];

$opinfoquery="SELECT userinfo.fname, userinfo.lname, projectmembers.userid 
FROM projectmembers, userinfo 
WHERE projectmembers.projectid='$projectid' AND projectmembers.userid = userinfo.userid AND projectmembers.op = '1' ";
$opinforesult=mysql_query($opinfoquery);
	
//Check whether query was successful or not
$opinfo = mysql_fetch_assoc($opinforesult);

$fname = $opinfo['fname'];
$lname = $opinfo['lname'];
$uid = $opinfo['userid'];

echo "
<div id =\"uheader\">
<div id=\"spacer\">
<nav id=\"naver\">
	<ul>
		<li><a href=\"#\">My Projects</a>
			<ul>
";


         while ($row7 = mysql_fetch_assoc($projectsresult2)) 
         { 
            $projectname2 =  $row7["projectname"];
			$projectid2 = $row7["projectid"];

            echo "<li><a href='projecthome.php?id=$projectid2'>$projectname2</a></li>";
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
<p id=\"headcreate3\"><font size=\"6\" face=\"Garamond\" color=\"#ddd\">$projectname</font></p>
<p id=\"headcreate4\"></p>	
<div id=\"xline2\"></div>

<br>
<br>";

echo"<div id=\"descontain\">";
   	echo "<div id=\"namepicontain\">";

if (isset($opinfo['defaultpicid']))
{
	$picid = $opinfo['defaultpicid'];
	$picinfoquery = "SELECT ext,width,height FROM pictures WHERE id = '$picid';";
	$result=mysql_query($picinfoquery,$conc) or die("Unable to insert pictureinfo into db");
	
	$picinfo = mysql_fetch_assoc($result);
	$ext = $picinfo['ext'];
	$width = $picinfo['width'];
	$height = $picinfo['height'];
	$picturelocation = "pictures/$picid.$ext";
	echo "<div id=\"oppic\"><img id=\"minipro\" src=\"$picturelocation\"";
	$height=50;
	$width = 40;
	echo "width=\"$width\" height=\"$height\" alt=\"$fname $lname's Profile Picture\" /></div>";
}
else 
{
  $picturelocation = "nopicture.png";
  echo "<div id=\"oppic\"><img id=\"minipro\" src=\"$picturelocation\"";
  echo "width=40 height=50 alt=\"$fname2 $lname2's Profile Picture\" /> </div>";
}

echo "
<div id=\"nameop\"><a href='profile.php?id=$uid' 'alt='$uid Project'>$fname $lname</a></div>
</div>
<div id=\"tailstain\">
<div id=\"descotext\">$description</div>
<div>$fname $lname must give you permission to view this projects details and join the project. Send $fname a view request to gain access.</div>
</div>
<p id=\"styleneeds\">Needs: ";

$needsquery="SELECT need
                  FROM needs
                   WHERE projectid = $projectid";
$needsresult=mysql_query($needsquery) or die("Unable to query DB!");
  
 while ($rowneed = mysql_fetch_assoc($needsresult)) 
{
$need =  $rowneed["need"];
  
 echo "$need ";


} 


echo"
</p>
<br>";

switch ($p)
{	
	case 0:
		echo "<p><button type=\"button\" id=\"joinbutton\" style=\"font: 24px ;\" onclick=\"window.location = 'viewrequest.php?id=$projectid';\">+1 View</button></p>";
		break;
	case 2:
		echo "<p>Your project request is currently pending.</p>";
		break;
}	
echo"
<br>
<br>
</div>
 ";  


?>