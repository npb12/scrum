<?php
function projectStatus($userid,$projectid)
{
		/****relations table: 
	0 = userid1 requested by userid2
	1 = Nothing, held in reserve for follow feature later on
	2 = friends with eachother 
	*****/
	$addprojectquery="SELECT relation FROM projectmembers WHERE userid = '$userid' AND projectid = '$projectid'"; 
	$addprojectresult=mysql_query($addprojectquery);
	
	$row = mysql_fetch_assoc($addprojectresult);
	
	$relationNum = $row['relation'];
	
	if(!mysql_num_rows($addprojectresult))
    {
		return 0;//not a member, send request
			echo "No Relation";
			exit(); 
	
	}
	else
	{
		switch ($relationNum)
			{	
				case 3:
					return 3;   //pending view request
					break;
				case 1:
  					return 1; //already a member
  					break;			
				case 0:
					return 2; //pending request
					break;
				case 4: 
				    return 4; //description is open to user
					break;
			}
	
	
	}
	
	

	


}
?>