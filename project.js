function printProjectsList(projectid)
{
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() 
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{ 
				var xml_doc = xmlhttp.responseXML;
				var proj_list = xml_doc.getElementsByTagName('project');
				if (proj_list.length> 0)
				{
					var projecthtml = "<p></p><h2>You have " + proj_list.length + " project's</h2>";
					for(var i = 0; i < proj_list.length; i += 1)
					{
						var projectid = proj_list[i].getElementsByTagName('projectid')[0].textContent;
						var projectname = proj_list[i].getElementsByTagName('projectname')[0].textContent;
						projecthtml += "<tr><td><a href='profile.php?id=" + projectid + "' 'alt='" + projectname + "\'s Profile'><h3>"  + projectname  + "</h3></a></td><td>";
						
						 projecthtml += "</td></tr>";
				
					} 
					projecthtml += "</table>";
					document.getElementById('projectslist').innerHTML = projecthtml;
	
				}
				else
				{
					document.getElementById('projectslist').innerHTML = "<h3>You have no projects :(</h3>";
				} 
			}

	}
	xmlhttp.open("GET","projects.php?id=" + projectid, true)
	xmlhttp.send()
}