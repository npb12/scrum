<?php	


	
	$friendsstatusquery ="SELECT userid1,userid2 FROM relations where (`userid1` = '$userid' AND relation = '2') OR (`userid2` = '$userid' AND relation = '2');";
	$friendsstatus=mysql_query($friendsstatusquery) or die("Unable to query DB!");
	
	
	while ($row = mysql_fetch_assoc($friendsstatus)) {
	
	    $userx = $row["userid1"];
		$usery = $row["userid2"];
	
	    if($userx == $userid)
		{
		  $associate = $usery;
		}
		else{
		  $associate = $userx;
		}
		
		$namequery14="SELECT fname, lname, defaultpicid 
                   FROM userinfo
		WHERE userid = '$associate'"; 
		$nameresult14=mysql_query($namequery14) or die("Unable to query 7!");

		$name14 = mysql_fetch_assoc($nameresult14);

		$fname14 = $name14['fname'];
		$lname14 = $name14['lname'];

		$fname14 = ucfirst($fname14);
		$lname14 = ucfirst($lname14);
		
		
	
echo"	   <div id=\"frand\">
<a href='deleteassoc.php?id=$associate' id=\"deleteX\">x</a>
";
if (isset($name14['defaultpicid']))
{
	$picid = $name14['defaultpicid'];
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
	echo "width=\"$width\" height=\"$height\" alt=\"$fname14 $lname14's Profile Picture\" /></div>";
}
else 
{
  $picturelocation = "nopicture.png";
  echo "<div id=\"commentprofpic\"><img id=\"minipro\" src=\"$picturelocation\"";
  echo "width=40 height=50 alt=\"$fname14 $lname14's Profile Picture\" /> </div>";
}
  echo "<div id=\"guts\"><a href='profile.php?id=$associate'>$fname14 $lname14</a></div></div>";
	
	
	}
	
	
	
	
?>