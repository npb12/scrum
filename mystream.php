<?php

include("authen.php");
include("config.php");
$userid = $_SESSION['userid'];


$projquery = "SELECT projectid, projectname FROM projectmembers WHERE userid=$userid";
$projresult=mysql_query($projquery) or die("Unable to query 1!");
$proj_rows = mysql_num_rows($projresult);

echo"<div id=\"activitystream\">Activity</div>";


if($proj_rows > 0)
{
while($projecto = mysql_fetch_assoc($projresult))
{

$projectnm = $projecto["projectname"];
$projid = $projecto["projectid"];



$commentsquery="SELECT comments.userid, comments.content, comments.timestamp, comments.commentid
FROM comments
WHERE comments.projectid = $projid
ORDER BY timestamp DESC";   //order by date
$commentsresult=mysql_query($commentsquery) or die("Unable to query 2!");

while ($comment = mysql_fetch_assoc($commentsresult)) 
{
$content =  $comment["content"];
$timestamp = $comment["timestamp"];
$commentid = $comment["commentid"];
$uid = $comment["userid"];

$namequery="SELECT fname, lname, defaultpicid
FROM userinfo
WHERE userid=$uid";
$nameresult=mysql_query($namequery) or die("Unable to query 3!");

$name = mysql_fetch_assoc($nameresult);

$fname = $name["fname"];
$lname = $name["lname"];

$fname = ucfirst($fname);
$lname = ucfirst($lname);

 echo "
  <div id=\"comment\">
    <div id =\"pname\"><a href='projecthome.php?id=$projid'>  $projectnm  </a></div>";
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
  echo "<div id=\"guts\"><a href='profile.php?id=$uid'>$fname $lname</a></div>
  <p id=\"procont\">$content</p>
  <div id=\"timestamp\">";
  
  echo date('M j Y g:i A', strtotime($timestamp));

    
  echo "
  </div></div>";
  
$replysquery="SELECT replys.userid, replys.content, replys.timestamp
FROM replys
WHERE replys.commentid = $commentid";   //order by date
$replysresult=mysql_query($replysquery) or die("Unable to query 7!");

while ($reply = mysql_fetch_assoc($replysresult)) 
{
$rcontent =  $reply["content"];
$rtimestamp = $reply["timestamp"];
$uid2 = $reply["userid"];

$namequery2="SELECT fname, lname, defaultpicid
FROM userinfo
WHERE userid=$uid2";
$nameresult2=mysql_query($namequery2) or die("Unable to query 3!");

$name2 = mysql_fetch_assoc($nameresult2);

$fname2 = $name2["fname"];
$lname2 = $name2["lname"];

$fname2 = ucfirst($fname2);
$lname2 = ucfirst($lname2);

echo "<div id=\"reply\">";

if (isset($name2['defaultpicid']))
{
	$picid2 = $name2['defaultpicid'];
	$picinfoquery2 = "SELECT ext,width,height FROM pictures WHERE id = '$picid2';";
	$result2=mysql_query($picinfoquery2);
	
	$picinfo2 = mysql_fetch_assoc($result2);
	$ext2 = $picinfo2['ext'];
	$width2 = $picinfo2['width'];
	$height2 = $picinfo2['height'];
	$picturelocation2 = "pictures/$picid2.$ext2";
	echo "<div id=\"replyprofpic\"><img id=\"minipro\" src=\"$picturelocation2\"";
	$height2=50;
	$width2 = 40;
	echo "width=\"$width2\" height=\"$height2\" alt=\"$fname2 $lname2's Profile Picture\" /></div>";
}
else
{
  $picturelocation2 = "nopicture.png";
  echo "<div id=\"replyprofpic\"><img id=\"minipro\" src=\"$picturelocation2\"";
  echo "width=40 height=50 alt=\"$fname2 $lname2's Profile Picture\" /></div>";
}
echo "<div id=\"guts2\"><a href='profile.php?id=$uid2'>$fname2 $lname2</a></div> 
<p id=\"procont2\">$rcontent</p>
<div id=\"timestamp2\">";
echo date('M j Y g:i A', strtotime($rtimestamp));
echo"
</div>
</div>
";

}
  
  
  echo "<div id =\"formposts\"><form method=\"post\" id=\"profdispatch\" action=\"projreply.php?recipient=$commentid&amp;pid=$projid\" name=\"replys\" onsubmit=\"return validateComment()\">
				<textarea id=\"boxer\" name=\"reply\" cols=\"84\" rows=\"3\">
				</textarea><br>
				<input type=\"submit\" id=\"postbox\" value=\"Reply\" />
			</form></div><br><br>";

}





}
}
else{
echo"
  <div id=\"comment\">
    <div id =\"pname\"></div>";
  echo "<br>
  <p id=\"nocont\">No current Project's</p>";
  


    
  echo "</div>";





}


?>