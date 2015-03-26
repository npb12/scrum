<?php
include("authen.php");
include("config.php");
$userid = $_SESSION['userid'];

$projectsquery2="SELECT projectname, projectid FROM projectmembers WHERE userid = '$userid' AND relation = '1'";
$projectsresult2=mysql_query($projectsquery2) or die("Unable to query DB!");
echo "
<head>
</head>
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
<div id=\"projcreat\">
<p id=\"headcreate\"><font size=\"6\" face=\"Garamond\" color=\"#ddd\">CREATE</font></p>
<p id=\"headcreate2\">Bring your idea to life:</p>

<div id=\"xline\"></div>
<div id=\"projspace\">
<form name=\"projcreate\" src=\"myScript.js\" METHOD=\"POST\" onsubmit=\"return validateprojcreate()\" action=\"createproject.php\">
<table id = \"projfrm\">
  <tbody>
    <tr>
		<td>Team name*</td>
	</tr>
    <tr>
      <td><label><textarea type=\"text\" id=\"formregname\" name=\"projectname\" maxlength=\"20\" /></textarea></label></td>
    </tr>
	<tr>
		<td>Team members (skills desired)*</td>
	</tr>
    <tr>
      <td><label><textarea type=\"text\" id=\"formregmem\"  name=\"needs\" /></textarea></label></td>
    </tr>
    <tr>
		<td>Project description (500 character limit)*</td>
	</tr>
	<tr>
      <td><label><textarea id=\"formregprojdescription\" cols=\"160\" rows=\"10\" name=\"description\" maxlength=\"500\" ></textarea></label></td>
    </tr>
	    <tr>
		<td>Details*</td>
	</tr>
    <tr>
      <td><label><textarea type=\"text\" id=\"formregdetails\" name=\"details\" ></textarea></label></td>
    </tr>
	<tr>
		<td>Your role in team*</td>
	</tr>
	<tr>
      <td><label><textarea type=\"text\" id=\"formregoprole\" name=\"role\" /></textarea></td>
    </tr>
	<tr>
    <td>Who can view your posting?: 
	<select id=\"select\" name=\"privacy\">
    <option value=\"0\">Public</option>
    <option value=\"1\">Private</option>
	</select>
	</td>
	</tr>
	<tr>
      <td><input type=\"submit\" id=\"createbutton\" value=\"Create\" /></form></td>
    </tr>
    <tr>
      <td>By clicking \"Create\", you <br/>agree to the <a href=\"TOS.html\" />Terms of Service</a>.</td>
    </tr>
  </tbody>
</table>
</div>
</div>";
?>