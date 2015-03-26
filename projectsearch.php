<?php

include("authen.php");
include("config.php");
include("header.php"); 
$userid = $_SESSION['userid'];



$searchterm = htmlspecialchars($_GET["searchterm"]);




$needssquery="SELECT projectid
FROM needs
WHERE need LIKE '%$searchterm%' AND projectname <> ''";
$needsresult=mysql_query($needssquery) or die("Unable to query!");





echo"
<div id =\"uheader\">
</div>
<div id=\"projfields\">
<div id=\"fieldshead\">
Search
</div>
<form id=\"uniSearchBox\" action=\"search.php\" name=\"navsearch\" onsubmit=\"return searchValidate()\" method=\"get\">
<input type=\"text\" name=\"query\" id=\"query\" size=\"22\" value=\"\"> 
<input type=\"submit\" value=\"Search\">
</form>
</div>
<p id=\"headcreate5\"><font size=\"6\" face=\"Garamond\" color=\"#ddd\">SEARCH</font></p>
<p id=\"headcreate4\">Find your next project:</p>	
<div id=\"xline5\"></div>
    <p id=\"sortprojs\">Sort by: 
	<select id=\"selectionproj\" name=\"projsearch\">
	<option> </option>
    <option value=\"1\">Acsending</option>
	<option value=\"1\">Decsending</option>
	</select>
	</p>
<div id=\"projbody\">

";
while($nee = mysql_fetch_assoc($needsresult))
{


$projectid =  $nee["projectid"];


$projectsquery="SELECT projectname, privacy, description, timestamp
FROM projects
WHERE projectid = $projectid AND onoff = '0'";
$projectsresult=mysql_query($projectsquery) or die("Unable to query DB!");

while ($row = mysql_fetch_assoc($projectsresult)) 
{
$projectname =  $row["projectname"];
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
  $needsquery2="SELECT need
                  FROM needs
                   WHERE projectid = $projectid
				   ORDER BY id DESC";
$needsresult2=mysql_query($needsquery2) or die("Unable to query DB!");
  
 while ($rowneed = mysql_fetch_assoc($needsresult2)) 
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

}

echo"
</div>
<br> <br>
";
?>