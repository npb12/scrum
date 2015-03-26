<?php
###Connect to database###
$dbhost = "localhost";
$dbname = "your_db_name";
$dbuser = "your_db_username";
$dbpass = "your_db_password";


$conc= mysql_connect ($dbhost, $dbuser, $dbpass) or die("Unable to connect to MySQL");
mysql_select_db($dbname) or die("Unable to connect to $dbname");
?>
