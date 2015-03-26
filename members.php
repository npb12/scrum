<?php

include("authen.php");
include("config.php");
$userid = $_SESSION['userid'];
include("header.php");

$projectid = intval($_GET['id']);

    //If not own profile, let's look into project status
$projectsquery="SELECT userid, op FROM projectmembers WHERE projectid = '$projectid' AND relation = '1';";
$projectsresult=mysql_query($projectsquery) or die("Unable to query DB!");

$projectsquery7="SELECT projectname, projectid FROM projectmembers WHERE userid = '$userid' AND relation = '1'";
$projectsresult7=mysql_query($projectsquery7) or die("Unable to query DB!");

$projectinfoquery="SELECT projectname, privacy, onoff FROM projects WHERE projectid='$projectid'";
$projectinforesult=mysql_query($projectinfoquery);
	
//Check whether query was successful or not
$projectinfo = mysql_fetch_assoc($projectinforesult);

$projectname = $projectinfo['projectname'];
$onoff = $projectinfo['onoff'];
$privacy = $projectinfo['privacy'];


echo"<html>
<!---Header--->
<head>
<title>
startupstream, a Social Network for everyone
</title>
<!-- Favicon/JavaScript/CSS -->
<link rel=\"shortcut icon\" href=\"favicon.ico\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\" /></head>
";



/*
echo "

<h3>$projectname</h3>
 ";  
*/
 $projectmembquery="SELECT op, relation FROM projectmembers WHERE projectid='$projectid' AND $userid = userid";
 $projectmembresult=mysql_query($projectmembquery);
	
//Check whether query was successful or not
$projectmemb = mysql_fetch_assoc($projectmembresult);

$op = $projectmemb['op'];
$relation = $projectmemb['relation'];

if($relation == 1)
{

echo "
<div id =\"mainhome\">
<div id =\"uheader\">
<div id=\"spacer\">
<nav id=\"naver\">
	<ul>
		<li><a href=\"#\">My Projects</a>
			<ul>
";


         while ($row7 = mysql_fetch_assoc($projectsresult7)) 
         { 
            $projectname7 =  $row7["projectname"];
			$projectid7 = $row7["projectid"];

            echo "<li><a href='projecthome.php?id=$projectid7'>$projectname7</a></li>";
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
<div id=\"homeheadleft\">$projectname</div>


<div class=\"link-list-quad\">";

	echo"<a href=\"projectdescription.php?id=$projectid\">
	 <span class=\"tit2\">Overview</span>
	 </a>";

	 if($op == 1)
	 {
	 echo"
	 <a href=\"#\">Edit</a>";
	 }
	 echo"
	<a href=\"members.php?id=$projectid\"><span class=\"tit2\">Members</span>
	</a>
	<a href=\"projtodos.php?id=$projectid\">Tasks</a>
	<a href=\"folder.php?id=$projectid\">Folder</a>	
</div>
<div id=\"activitystream2\">Post a comment...
			  <div id =\"formposts3\"><form method=\"post\" id=\"profdispatch\" action=\"projcomment.php?recipient=$projectid\" name=\"comments\" onsubmit=\"return validateComment()\">
				<textarea id=\"boxer\" name=\"comment\" cols=\"84\" rows=\"3\">
				</textarea><br>
				<input type=\"submit\" id=\"postbox2\" value=\"Post\" />
			</form></div></div><br>
</div>
<div id=\"bodyhome\"><br><br>";
while ($row = mysql_fetch_assoc($projectsresult)) 
{
$uid =  $row["userid"];
$op2 =  $row["op"];

$namequery = "SELECT fname, lname, defaultpicid FROM userinfo WHERE userid = $uid";
$nameresult=mysql_query($namequery) or die("Unable to query DB!");

$namero = mysql_fetch_assoc($nameresult);

$fname =  $namero['fname'];
$lname =  $namero['lname'];

echo"<div id=\"frand\">";
if($op == 1)
{
echo"<a href='deletemembers.php?pid=$projectid&uid=$uid' id=\"deleteX\">x</a>";
}
if (isset($namero['defaultpicid']))
{
	$picid = $namero['defaultpicid'];
	$picinfoquery = "SELECT ext,width,height FROM pictures WHERE id = '$picid';";
	$result=mysql_query($picinfoquery,$conc) or die("Unable to insert pictureinfo into db");
	
	$picinfo = mysql_fetch_assoc($result);
	$ext = $picinfo['ext'];
	$width = $picinfo['width'];
	$height = $picinfo['height'];
	$picturelocation = "pictures/$picid.$ext";
	echo "<div id=\"commentprofpic\"><img id=\"minipro\" src=\"$picturelocation\"";
	$height=50;
	$width = 40;
	echo "width=\"$width\" height=\"$height\" alt=\"$fname $lname's Profile Picture\" /></div>";
}
else 
{
  $picturelocation = "nopicture.png";
  echo "<div id=\"commentprofpic\"><img id=\"minipro\" src=\"$picturelocation\"";
  echo "width=40 height=50 alt=\"$fname2 $lname2's Profile Picture\" /> </div>";
}
  echo "<div id=\"guts\"><a href='profile.php?id=$uid'>$fname $lname</a>";

if($op2 == 1)
{
  echo "(c)";
}
echo"
</div></div>
";



}
echo "
</div>
</div>

";



}

?>