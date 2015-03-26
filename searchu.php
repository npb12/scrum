<?php

//Include MySQL config info
include("config.php");


//Check to see if user exists
$query = $_GET['query'];


//echo $query;
$queryterms = explode(" ",$query);

if(count($queryterms) > 0)
{
		$searchterm = $queryterms[0];
        header("location: projectusearch.php?searchterm=$searchterm");
}

?>