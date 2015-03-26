<?php
include("authen.php");
include("config.php");

include("header.php"); //Universal Start of Page
$userid = $_SESSION['userid'];
$uid = intval($_GET['id']);
include("friendingfunctions.php");

$namequery="SELECT fname, lname, defaultpicid 
FROM userinfo
WHERE userid = '$uid'"; 
$nameresult=mysql_query($namequery) or die("Unable to query 7!");

$name = mysql_fetch_assoc($nameresult);

$fname = $name['fname'];
$lname = $name['lname'];

$fname = ucfirst($fname);
$lname = ucfirst($lname);

$f = friendStatus($uid,$userid);

$projectsquery2="SELECT projectname, projectid FROM projectmembers WHERE userid = '$userid' AND relation = '1'";
$projectsresult2=mysql_query($projectsquery2) or die("Unable to query DB!");

$projectsquery="SELECT projectname, projectid FROM projectmembers WHERE userid = '$userid' AND relation = '1'";
$projectsresult=mysql_query($projectsquery) or die("Unable to query DB!");

echo "
<div id =\"mainhome\">
<div id =\"uheader\">
<div id=\"spacer\">
<nav id=\"naver\">
	<ul>
		<li><a href=\"#\">My Projects</a>
			<ul>
";


         while ($row2 = mysql_fetch_assoc($projectsresult2)) 
         { 
            $projectname2 =  $row2["projectname"];
			$projectid2 = $row2["projectid"];

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
</div>";

if($userid == $uid)
{

echo"
<div id=\"lefthome\">
<div id=\"homeheadleft\">$fname $lname</div>
<div id=\"picdiv2\">
";
if (isset($name['defaultpicid']))
{
	$picid = $name['defaultpicid'];
	$picinfoquery = "SELECT ext,width,height FROM pictures WHERE id = '$picid';";
	$result=mysql_query($picinfoquery,$conc) or die("Unable to insert pictureinfo into db");
	
	$picinfo = mysql_fetch_assoc($result);
	$ext = $picinfo['ext'];
	$width = $picinfo['width'];
	$height = $picinfo['height'];
	$picturelocation = "pictures/$picid.$ext";
	echo "<img id=\"propic\" style=\"float: top;\" src=\"$picturelocation\"";
	if ($width > 200)
    {
    $newwidth=200;
	$height=($height/$width)*$newwidth;
	$width = $newwidth;
	}
	echo "width=\"$width\" height=\"$height\" alt=\"$fname $lname's Profile Picture\" />";
}
else{
  $picturelocation = "nopicture.png";
  echo "<img id=\"propic\" src=\"$picturelocation\"";
  echo "width=90 height=100 alt=\"$fname2 $lname2's Profile Picture\" />";

}
echo "
</div>";
include ("profpicform.php");
echo"<div class=\"link-list-quad\">
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
<div id=\"bodyhome2\"><br><br>";
include ("proform.php");
echo "
</div>";
}
else{

echo"
<div id=\"lefthome\">
<div id=\"homeheadleft\">$fname $lname</div>
<div id=\"picdiv\">
";
if (isset($name['defaultpicid']))
{
	$picid = $name['defaultpicid'];
	$picinfoquery = "SELECT ext,width,height FROM pictures WHERE id = '$picid';";
	$result=mysql_query($picinfoquery,$conc) or die("Unable to insert pictureinfo into db");
	
	$picinfo = mysql_fetch_assoc($result);
	$ext = $picinfo['ext'];
	$width = $picinfo['width'];
	$height = $picinfo['height'];
	$picturelocation = "pictures/$picid.$ext";
	echo "<img id=\"propic\" style=\"float: top;\" src=\"$picturelocation\"";
	if ($width > 200)
    {
    $newwidth=200;
	$height=($height/$width)*$newwidth;
	$width = $newwidth;
	}
	echo "width=\"$width\" height=\"$height\" alt=\"$fname $lname's Profile Picture\" />";
}
else{
  $picturelocation = "nopicture.png";
  echo "<img id=\"propic\" src=\"$picturelocation\"";
  echo "width=90 height=100 alt=\"$fname2 $lname2's Profile Picture\" />";

}

echo "
</div>
<div class=\"link-list-quad\">";
if($f == 0)
{
echo"<div style=\"padding-bottom:10px;\"><button type=\"button\" id=\"addass\" style=\"font: 24px ;\" onclick=\"window.location = 'addfriend.php?id=$uid';\">Add</button></div>";	
}
echo"
 <a href=\"messagecont.php?id=$uid\">Message</a>
</div>

</div>
<div id=\"bodyhome\"><br><br>";
include ("getuserinfo.php");
echo "
</div>";





}
echo"
</div>

";
?>