<?php


include("authen.php");
include("config.php");

$myuserid = $_SESSION['userid'];







$messagesquery="SELECT userid, recipientid 
FROM messages 
WHERE userid = '$myuserid' OR '$myuserid' = recipientid";
$messagesresult=mysql_query($messagesquery) or die("Unable to query DB!");



echo"
<div id=\"tainmessagesdiv2\">";
while ($row22 = mysql_fetch_assoc($messagesresult)) 
{ 
  $ud =  $row22["userid"];
  $rid = $row22["recipientid"];
  

  if($ud == $myuserid)
  {
  
    $sid = $rid;
  }
  else{
    $sid = $ud;
	$myuserid = $rid;
  }

$namequery22="SELECT fname, lname, defaultpicid 
FROM userinfo
WHERE userid = $sid"; 
$nameresult22=mysql_query($namequery22) or die("Unable to query 7!");


$name22 = mysql_fetch_assoc($nameresult22);

$fname22 = $name22['fname'];
$lname22 = $name22['lname'];

$fname22 = ucfirst($fname22);
$lname22 = ucfirst($lname22);

if (isset($name22['defaultpicid']))
{
	$picid21 = $name22['defaultpicid'];
	$picinfoquery12 = "SELECT ext,width,height FROM pictures WHERE id = '$picid21';";
	$result12=mysql_query($picinfoquery12,$conc) or die("Unable to insert pictureinfo into db");
	
	$picinfo12 = mysql_fetch_assoc($result12);
	$ext12 = $picinfo12['ext'];
	$width12 = $picinfo12['width'];
	$height12 = $picinfo12['height'];
	$picturelocation12 = "pictures/$picid21.$ext12";
	echo "<div id=\"commentmessagepic\"><img id=\"minipro\" src=\"$picturelocation12\"";
	$height12=50;
	$width12 = 40;
	echo "width=\"$width12\" height=\"$height12\" alt=\"$fname2 $lname2's Profile Picture\" /></div>";
}
else 
{
  $picturelocation12 = "nopicture.png";
  echo "<div id=\"commentmessagepic\"><img id=\"minipro\" src=\"$picturelocation12\"";
  echo "width=40 height=50 alt=\"$fname22 $lname22's Profile Picture\" /> </div>";
}

			

	echo "<div id=\"opname2\"><a name=\"link1\" href='messagecont.php?id=$sid'>$fname22 $lname22</a></div>";

}

echo"
</div>
";



?>