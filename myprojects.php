<?php

include("authen.php");
include("config.php");
$myuserid = $_SESSION['userid'];
include("header.php");

    //If not own profile, let's look into project status
$projectsquery7="SELECT projectid, projectname FROM projectmembers WHERE userid = '$myuserid' AND relation = '1'";
$projectsresult7=mysql_query($projectsquery7) or die("Unable to query DB!");

echo "
<div id =\"uheader\">
</div>
<p id=\"headcreate3\"><font size=\"6\" face=\"Garamond\" color=\"#ddd\">Portfolio</font></p>
<p id=\"headcreate4\"></p>	
<div id=\"xline2\"></div>

<br>
<br>
<br>
<div id=\"headcontain\">
<div id=\"myprojstitle\">
Project
</div>
<div id=\"myprojsrolehead\">
Role
</div>
</div>";

while ($row7 = mysql_fetch_assoc($projectsresult7)) 
{
$projectid7 =  $row7["projectid"];
$projectname7 =  $row7["projectname"];

$rolequery = "SELECT role FROM roles WHERE projectid = $projectid7 AND userid = $myuserid";
$roleresult=mysql_query($rolequery) or die("Unable to query DB!");

$rolepro = mysql_fetch_assoc($roleresult);

$role =  $rolepro['role'];

echo "
<div id=\"myprojscontain\">
<div id=\"myprojs\">
<a href='projecthome.php?id=$projectid7'>$projectname7</a>
</div>
<div id=\"myprojsrole\">
$role
</div>
</div>
<br>
<br>
";




}
?>