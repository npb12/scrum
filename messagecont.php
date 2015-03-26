<?php

include("authen.php");
include("config.php");
include("header.php");

$userid = $_SESSION['userid'];


$uid = intval($_GET['id']);



$messages="SELECT userid, recipientid, content, timestamp 
FROM messages 
WHERE userid = '$userid' AND recipientid = $uid OR '$userid' = recipientid AND userid = '$uid'";
$messagesres=mysql_query($messages) or die("Unable to query DB!");
$num_rows = mysql_num_rows($messagesres);

$projectsquery="SELECT projectname, projectid FROM projectmembers WHERE userid = '$userid' AND relation = '1'";
$projectsresult=mysql_query($projectsquery) or die("Unable to query DB!");

$messagesquery="SELECT DISTINCT userid, recipientid FROM messages WHERE userid = '$userid' OR '$userid' = recipientid ";
$messagesresult=mysql_query($messagesquery) or die("Unable to query DB!");


echo "
<div id =\"mainhome\">
<div id =\"uheader3\">
<div id=\"spacer\">
<nav id=\"naver\">
	<ul>
		<li><a href=\"#\">My Projects</a>
			<ul>
";


         while ($row = mysql_fetch_assoc($projectsresult)) 
         { 
            $projectname =  $row["projectname"];
			$projectid = $row["projectid"];

            echo "<li><a href='projecthome.php?id=$projectid'>$projectname</a></li>";
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
</div>
</div>
<div id=\"leftmessagediv2\">
<div id=\"homeheadleft\">Messages</div>
<div id=\"tainmessagesdiv\">";
if($num_rows > 0)
{
while ($row2 = mysql_fetch_assoc($messagesresult)) 
{ 
  $uid =  $row2["userid"];
  $rid = $row2["recipientid"];

  if($uid == $userid)
  {
    $sid = $rid;
  }
  else{
    $sid = $uid;
	$userid = $rid;
  }
  
  $namequery2="SELECT fname, lname, defaultpicid 
FROM userinfo
WHERE userid = $sid"; 
$nameresult2=mysql_query($namequery2) or die("Unable to query 7!");

$name2 = mysql_fetch_assoc($nameresult2);

$fname2 = $name2['fname'];
$lname2 = $name2['lname'];

$fname2 = ucfirst($fname2);
$lname2 = ucfirst($lname2);
if (isset($name2['defaultpicid']))
{
	$picid = $name2['defaultpicid'];
	$picinfoquery = "SELECT ext,width,height FROM pictures WHERE id = '$picid';";
	$result=mysql_query($picinfoquery,$conc) or die("Unable to insert pictureinfo into db");
	
	$picinfo = mysql_fetch_assoc($result);
	$ext = $picinfo['ext'];
	$width = $picinfo['width'];
	$height = $picinfo['height'];
	$picturelocation = "pictures/$picid.$ext";
	echo "<div id=\"commentmessagepic\"><img id=\"minipro\" src=\"$picturelocation\"";
	$height=50;
	$width = 40;
	echo "width=\"$width\" height=\"$height\" alt=\"$fname $lname's Profile Picture\" /></div>";
}
else 
{
  $picturelocation = "nopicture.png";
  echo "<div id=\"commentmessagepic\"><img id=\"minipro\" src=\"$picturelocation\"";
  echo "width=40 height=50 alt=\"$fname2 $lname2's Profile Picture\" /> </div>";
}

			

	echo "<div id=\"opname9\"><a name=\"link1\" href='messagecont.php?id=$sid'>$fname2 $lname2</a></div><br>";
}
}
echo"
</div>
</div>



<div id=\"bodymessage\"><br><br>";
while ($row3 = mysql_fetch_assoc($messagesres)) 
{ 
  $uid =  $row3["userid"];
  $rid = $row3["recipientid"];
  $timestamp = $row3["timestamp"];
  $content = $row3["content"];
  
echo"
<div id=\"mymessagestream\">
<div id=\"messagetime\">";
echo date('M j Y g:i A', strtotime($timestamp));

echo"</div>
";

 $namequery2="SELECT fname, lname, defaultpicid 
FROM userinfo
WHERE userid = $uid"; 
$nameresult2=mysql_query($namequery2) or die("Unable to query 7!");

$name2 = mysql_fetch_assoc($nameresult2);

$fname2 = $name2['fname'];
$lname2 = $name2['lname'];

$fname2 = ucfirst($fname2);
$lname2 = ucfirst($lname2);
if (isset($name2['defaultpicid']))
{
	$picid = $name2['defaultpicid'];
	$picinfoquery = "SELECT ext,width,height FROM pictures WHERE id = '$picid';";
	$result=mysql_query($picinfoquery,$conc) or die("Unable to insert pictureinfo into db");
	
	$picinfo = mysql_fetch_assoc($result);
	$ext = $picinfo['ext'];
	$width = $picinfo['width'];
	$height = $picinfo['height'];
	$picturelocation = "pictures/$picid.$ext";
	echo "<div id=\"commentmessagepic\"><img id=\"minipro\" src=\"$picturelocation\"";
	$height=50;
	$width = 40;
	echo "width=\"$width\" height=\"$height\" alt=\"$fname $lname's Profile Picture\" /></div>";
}
else 
{
  $picturelocation = "nopicture.png";
  echo "<div id=\"commentmessagepic\"><img id=\"minipro\" src=\"$picturelocation\"";
  echo "width=40 height=50 alt=\"$fname2 $lname2's Profile Picture\" /> </div>";
}

			

	echo "
	<div id=\"tainmessagescont\"><div id=\"opname1\"><a href='profile.php?id=$sid'>$fname2 $lname2</a></div>";
	echo "$content</div></div>";
}
if($num_rows > 0)
{
echo"
<div id =\"formposts5\">
<form method=\"post\" id=\"profdispatch\" action=\"postDispatch.php?recipient=$sid\" name=\"dispatches\" onsubmit=\"return validateDispatches()\">
					<textarea name=\"dispatch\" id=\"boxer5\" cols=\"80\" rows=\"3\">
					</textarea><br>
					<input type=\"submit\" id=\"postbox5\" value=\"Post\" /></div>";
}
else{
echo"
<div id =\"formposts5\">
<form method=\"post\" id=\"profdispatch\" action=\"postDispatch.php?recipient=$uid\" name=\"dispatches\" onsubmit=\"return validateDispatches()\">
					<textarea name=\"dispatch\" id=\"boxer5\" cols=\"80\" rows=\"3\">
					</textarea><br>
					<input type=\"submit\" id=\"postbox5\" value=\"Post\" /></div>";


}
echo"
</div>
</div>";








?>