<?php


$userquery="SELECT * FROM userinfo WHERE userid='$userid'";
$userresult=mysql_query($userquery) or die('Unable to check for requests');
$userinfo = mysql_num_rows($userresult);

$rowd = mysql_fetch_assoc($userresult);


$location = $rowd['location'];
$contact = $rowd['contact'];
$about = $rowd['about'];
$work = $rowd['work'];



echo "
<form name=\"proupdate\" src=\"myScript.js\" METHOD=\"POST\" onsubmit=\"return validateprojcreate()\" action=\"updateprofile.php\">
<table id = \"projfrm\">
  <tbody>
	<tr>
      <td><label><textarea type=\"text\" placeholder=\"Location\" id=\"formregmem\" name=\"location\" />$location</textarea></td>
    </tr>
	<tr>
      <td><label><textarea type=\"text\" id=\"formregoprole\" placeholder=\"Contact Information\" name=\"contact\" />$contact</textarea></label></td>
    </tr>
	<tr>
      <td><label><textarea id=\"formregprojdescription\" cols=\"160\" rows=\"10\"  placeholder=\"About (500 character limit)\" name=\"about\" maxlength=\"500\" >$about</textarea></label></td>
    </tr>
 
    <tr>
      <td><label><textarea type=\"text\" id=\"formregdetails\" placeholder=\"Work (Portfolio, links to work, repository etc.)\" name=\"work\" >$work</textarea></label></td>
    </tr>
	<tr>
      <td><input type=\"submit\" id=\"updatebutton\" value=\"Update\" /></form></td>
    </tr>
  </tbody>
</table>";
?>