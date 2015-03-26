<?php
include("authen.php");
include("config.php");


$userid = $_SESSION['userid'];


if(isset($_POST['projectname']))
{
  $projectname = mysql_real_escape_string($_POST['projectname']);
     
}
if(isset($_POST['description']))
{
  $description = mysql_real_escape_string($_POST['description']);
}
if(isset($_POST['needs']))
{
  $needs = mysql_real_escape_string($_POST['needs']);
}
if(isset($_POST['details']))
{
  $details = mysql_real_escape_string($_POST['details']);

}
if(isset($_POST['role']))
{
  $role = mysql_real_escape_string($_POST['role']);

}

if(isset($_POST['privacy']))
{
  $privacy = mysql_real_escape_string($_POST['privacy']);

}









 

$sql="select * from projects where projectname='$projectname'";
$result=mysql_query($sql,$conc) or die("Unable to query db for existing project");
if (mysql_num_rows($result) > 0)
	{
	include("header.php"); //Universal Start of Page
	//echo "A user already created a project with this name! Please use another name for your project.";
	include("projectform.php");
	//Print off the Universal Footer of the page
	}
else {
#Insert into projects Table
$sql = "insert into projects(projectname, description, details, privacy) values('$projectname','$description','$details', '$privacy')";
$result=mysql_query($sql,$conc) or die("Unable to insert project into db");

$autoid = mysql_insert_id();


$sql2 = "insert into projectmembers(projectid, projectname, userid, op, relation) values('$autoid','$projectname','$userid', '1', '1')";
$result2 =mysql_query($sql2,$conc) or die("Unable to insert loginifo projectmembers");



$sql42 = "insert into roles(userid, projectid, role) values('$userid', '$autoid', '$role')";
$result42 =mysql_query($sql42,$conc) or die("Unable to insert into roles");


$need = explode(" ", $needs);
$count = count($need);

while($count >= 0)
{
$nee = $need[$count];
$sql10 = "insert into needs(projectid, need) values('$autoid', '$nee')";
$result10 =mysql_query($sql10,$conc) or die("Unable to insert into needs");

$count = $count -1;
}



header("location: projecthome.php?id=".$autoid);

}


?>