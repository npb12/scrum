<?php

include("config.php");
include("header.php"); 


$project_order = $_POST['order'];

/*
if($project_order == 0)
{

$count = "SELECT Group, COUNT(*)
FROM table
GROUP BY Group
ORDER BY COUNT(*) DESC";

$count = mysql_query($countquery) or die("Unable to query DB!");

$projectsquery="SELECT projects.projectname, projects.projectid, projects.privacy, projects.description, projects.timestamp
FROM projects
WHERE projects.onoff = '0'";
}
*/
if($project_order == 1)
{
$projectsquery="SELECT projects.projectname, projects.projectid, projects.privacy, projects.description, projects.timestamp
FROM projects
WHERE projects.onoff = '0' AND projectname <> ''
ORDER BY projects.timestamp ASC";
}
if($project_order == 2)
{
$projectsquery="SELECT projects.projectname, projects.projectid, projects.privacy, projects.description, projects.timestamp
FROM projects
WHERE projects.onoff = '0' AND projectname <> ''
ORDER BY projects.timestamp DESC";
}

$projectsresult=mysql_query($projectsquery) or die("Unable to query DB!");

echo"
<div id =\"uheader\">
</div>
<div id=\"projfields\">
<div id=\"fieldshead\">
Search
</div>
<form id=\"uniSearchBox\" action=\"search.php\" name=\"navsearch\" onsubmit=\"return searchValidate()\" method=\"get\">
<input type=\"text\" name=\"query\" id=\"query\" size=\"22\" value=\"\"> 
<input type=\"submit\" id=\"sbutton\" value=\"Search\">
</form>
</div>
<p id=\"headcreate5\"><font size=\"6\" face=\"Garamond\" color=\"#ddd\">SEARCH</font></p>
<p id=\"headcreate4\">Find your next project:</p>	
<div id=\"xline5\"></div>
    <div id=\"sortprojs\">Sort by: 
	<form id=\"frm\" method=\"post\" action=\"projectuorder.php\">
	<select id=\"selectionproj\" onchange=\"onSelectChange();\" name=\"order\">
	<option> </option>
    <option value=\"1\">Acsending</option>
	<option value=\"2\">Decsending</option>
	</select>
	</form>
	</div>
<div id=\"projbody\">

";


while ($row = mysql_fetch_assoc($projectsresult)) 
{
$projectname =  $row["projectname"];
$projectid = $row["projectid"];
$projectprivacy = $row["privacy"];
$description = $row["description"];
$timestamp = $row["timestamp"];


$opquery="SELECT userinfo.fname, userinfo.lname, userinfo.userid
FROM projectmembers, userinfo
WHERE $projectid=projectmembers.projectid AND projectmembers.op = '1' AND projectmembers.userid = userinfo.userid";
$opresult=mysql_query($opquery) or die("Unable to query DB!");

$opp = mysql_fetch_assoc($opresult);

$fname = $opp['fname'];
$lname = $opp['lname'];
$uid = $opp['userid'];


  echo "
  <div id=\"projstream\">
  <div id=\"namenamecontain\">";


if($projectprivacy == 1)
{
  echo "
  <div id=\"titleproj\"><a href='privatedescription.php?id=$projectid' 'alt='$projectname's Project'>$projectname (private)</a></div>";
}
else
{
  echo "
  <div id=\"titleproj\"><a href='projectdescription.php?id=$projectid' 'alt='$projectname's Project'>$projectname</a></div>";
}

  echo "  <div id=\"opname\"><a href='profile.php?id=$uid' 'alt='$fname $lname's Profile'>$fname $lname</a></div></div>
  <div id=\"descriproj\">$description</div>
  
  
  
  <div id=\"needsies\">Needs: ";
     $needsquery="SELECT need
                  FROM needs
                   WHERE projectid = $projectid
				   ORDER BY id DESC";
$needsresult=mysql_query($needsquery) or die("Unable to query DB!");
  
 while ($rowneed = mysql_fetch_assoc($needsresult)) 
{
$need =  $rowneed["need"];
  
 echo "$need ";


} 
echo"  
  </div>
  <div id=\"projtime\">";
  echo date('M j Y g:i A', strtotime($timestamp));
  
  echo"
  </div>";

}

echo"
</div>
<br> <br>
";

?>