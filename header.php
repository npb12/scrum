<?php
echo"
<!DOCTYPE html>
<html>
<!---Header--->
<head>
<title>
ScrumBLD, a network for collaboration
</title>
<!-- Favicon/JavaScript/CSS -->
<link rel=\"shortcut icon\" href=\"/favi.ico\" type=\"image/x-icon\">
<link rel=\"icon\" href=\"/favi.ico\" type=\"image/x-icon\">
<script type=\"text/JavaScript\" src=\"js.js\"></script>
<script type=\"text/JavaScript\" src=\"profile.js\"></script>
<script type=\"text/JavaScript\" src=\"friends.js\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"dropdown.css\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"ddmenu.css\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"stylesp.css\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\" />
</head>
<body>
<!---Body--->
<!---- Body Table Begining --->
<!---Navigation Top--->

";
    //Display Login Box if user is not logged in
if(!isset($_SESSION['userid'])) 
{
echo "

        <div id=\"header\">
		<div class=\"section group\">
		<div class=\"col span_1_of_3\" style=\"padding-top:5px;\"><a href='index.php' alt='Brotherhood Homepage'><img src=\"logoimg.png\" alt='Brotherhood Logo' /></a></div>
     	<div class=\"col span_2_of_3\"><form METHOD=\"POST\" action=\"login.php\" name=\"loginbox\" onsubmit=\"return validatelogin()\">
		<div class=\"divgroup\">
		<div class=\"div1\"><input type=\"text\" name=\"email\" placeholder=\"Email\" /></div>  
		<div class=\"div2\"><input type=\"password\"  placeholder=\"Password\" name=\"password\"  /></div>
		<div class=\"div3\"><input type=\"submit\" id=\"loginbutton\" value=\"Log in\" /></div>
		</div></div></form></div>
		</div></div>
		";
}
else //Otherwise, display navigation
{
	$userid = $_SESSION['userid'];
	echo "
	<table id =\"body\" width =\"100%\">
	<tbody>
		<tr><td>
	<div class = \"head\">
<ul class=\"nav\">
	<!---Logout Button--->
	<div id=\"uniLogoutButtonDiv\" >
<nav id=\"thirdnav\">
	<ul>
		<li><a href=\"#\"><div class=\"arrow-down\"></div></a>
			<ul>
			   <li><a href='learnmore.php' alt='About The Network'>About</a></li>
               <li><a href=\"#\" onclick=\"logout()\">logout</a></li>
			   <li><a href='TOS.html' alt='Terms of Service' target='_blank'/>TOS</a></li>
			</ul>
		</li>
	</ul>
</nav>		
</div>
<div id=\"headlefter1\">
   	<li><a class=\"Three-Dee\" href='index.php' alt='Brotherhood Homepage'><img src=\"logoimg.png\" alt='Brotherhood Logo' /></a></li>
</div>
	<div id =\"headlefter2\">
	<li><a href=\"home.php\">Home</a></li>
	<li><a href=\"createproject.php\">Create</a></li>
	<li><a href=\"projects.php\">Projects</a></li>
</div>	
	</ul>
</div>
<table id=\"contentTable\">
<tbody>
    <tr>
      <td>
	";
}

?>