<?php

//Include MySQL config info
include("config.php");

//Kick out users who are not logged in
include("authen.php");

//Check to see if user exists
$query = $_GET['query'];


//echo $query;
$queryterms = explode(" ",$query);

if(count($queryterms) > 0)
{
		$searchterm = $queryterms[0];
        header("location: projectsearch.php?searchterm=$searchterm");
}

?>