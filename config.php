<?php
###Connect to database###
$dbhost = "localhost";
$dbname = "collab_teamup";
$dbuser = "npb12";
$dbpass = "tarheel5";

#
# On Server: username/dbname: socialnetdatab
# Password: Social-net-db1 
#

$conc= mysql_connect ($dbhost, $dbuser, $dbpass) or die("Unable to connect to MySQL");
mysql_select_db($dbname) or die("Unable to connect to $dbname");
?>