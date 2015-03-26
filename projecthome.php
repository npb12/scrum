<?php
include("authen.php");
include("config.php");






include("header.php"); //Universal Start of Page
$userid = $_SESSION['userid'];
$projectid = intval($_GET['id']);

$projectinfoquery="SELECT projectname, privacy, onoff FROM projects WHERE projectid='$projectid'";
$projectinforesult=mysql_query($projectinfoquery);

$projectsquery2="SELECT projectname, projectid FROM projectmembers WHERE userid = '$userid' AND relation = '1'";
$projectsresult2=mysql_query($projectsquery2) or die("Unable to query DB!");
	
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
include ("projectstream.php");
echo "
</div>
</div>

";
echo "</td></tr></tbody></table><!----End of Content Table--->";



}
else if ($relation == 4)
{
  $projectinfoquery="SELECT description, needs, details
  FROM projects
  WHERE $projectid = projectid";
  $projectinforesult=mysql_query($projectinfoquery);
  $projectinfo = mysql_fetch_assoc($projectinforesult);
  
  	$desc = $projectinfo['description'];
	$needs = $projectinfo['needs'];
	$details = $projectinfo['details'];
	$privacy = $projectinfo['privacy'];
	
echo "<p>$desc</p>
	<p>$needs</p>
	<p>$details</p>
	<br>";
	
	
	echo "<h1>Click to request to join this project</h1><button type=\"button\" style=\"font: 24px ;\" onclick=\"window.location = 'addproject.php?id=$projectid';\">+1 Join</button>";
  


}
else{

echo "<h2>You must be a member of this project to view this page</h2>";

}
 



?>

