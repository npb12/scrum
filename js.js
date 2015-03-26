/***Prints The Days on the Registration Form***/
function printDays()
{
for(i=0;i<31;i++){ 
var dateVar = 1 + i; 
document.write('<option value=\"' + dateVar + '\">' + dateVar + '</option>'); 
}
}

/***Prints The Years on the Registration Form***/
function printYears()
{
for(i=0;i<83;i++)
{ 
var dateVar = 1930 + i; 
document.write('<option value=\"' + dateVar + '\">' + dateVar + '</option>'); 
}
}

/***Validates The Inputted Registration Form***/
function validateregform()
{
var fname=document.forms["register"]["fname"].value;
var lname=document.forms["register"]["lname"].value;
var email=document.forms["register"]["email"].value;
var pwd1=document.forms["register"]["pwd"].value;
var pwd2=document.forms["register"]["pwd2"].value;
//var birthyear = parseInt(document.forms["register"]["year"].value);
//var birthmonth = parseInt(document.forms["register"]["month"].value) - 1;
//var birthday = parseInt(document.forms["register"]["day"].value);

if (fname==null || fname=="")
  {
  alert("First name must be filled in");
  return false;
  }
  if (lname==null || lname=="")
  {
  alert("Last name must be filled in");
  return false;
  }
  if (email==null || email=="")
  {
  alert("Email must be filled in");
  return false;
  }
  var atpos=email.indexOf("@");
   var dotpos=email.lastIndexOf(".");
   if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) //Checks if @ is first character, if email is @. or if the . is not in the string
  	{
  		alert("Not a valid e-mail address");
  		return false;
  	}
  if (pwd1 != pwd2)
  {
  alert("Passwords don't match");
  return false;
  }

  
  	//Minimum Age to Allow on the Site. Due to Children's Online Privacy Protection, this is 13
 /*	var min_age = 13;

	var submitteddate = new Date((birthyear + min_age), birthmonth, birthday); //get date in JS format
	var today = new Date;

	if ( (today.getTime() - submitteddate.getTime()) < 0) { //If thier age is less than 13, this will return false
		alert("Sorry! Due to the Children's Online Privacy Protection Act, you must be 13 years old to join the Brotherhood.");
		return false;
		}
		*/
}

/***Validates The Login Box***/
function validatelogin()
{
var pwd=document.forms["loginbox"]["password"].value;
var email=document.forms["loginbox"]["email"].value;

if (pwd==null || pwd=="")
  {
  alert("Please fill in your password.");
  return false;
  }
if (email==null || email=="")
{
  alert("Email must be filled in.");
  return false;
}


}

function validatetodo()
{
var todo=document.forms["createtodo"]["todo"].value;

if (todo==null || todo=="")
  {
  alert("Please fill in a todo.");
  return false;
  }


}

function validateprojcreate()
{
var projectname=document.forms["projcreate"]["projectname"].value;
var description=document.forms["projcreate"]["description"].value;
var needs=document.forms["projcreate"]["needs"].value;


if (projectname==null || projectname=="")
  {
  alert("Project name must be filled in!");
  return false;
  }
  if (description==null || description=="")
  {
  alert("Must have a description!");
  return false;
  }
  if (needs==null || needs=="")
  {
  alert("You must have software requirements to attract team members!");
  return false;
  }
   if (role==null || role=="")
  {
  alert("You must have a role for yourself within the team!");
  return false;
  }

}

function validateDispatches()
{
var text=document.forms["dispatches"]["dispatch"].value;
if (text==null || text=="")
	{
  alert("Please type something to post!");
  return false;
  }
}

function validateComment()
{
var text=document.forms["comments"]["comment"].value;
if (text==null || text=="")
	{
  alert("Please type something to post!");
  return false;
  }
}

function handleUserInfoChangers()
{
	var changerequest = new XMLHttpRequest();
	xmlhttp.open("GET", "get_data.php", true);
	xmlhttp.send();
}

function goHome()
{
window.location = "home.php";
}

function logout()
{
window.location = "logout.php";
}

function goToMyFriends()
{
window.location = "friends.php";
}

function goToMyRequests()
{
window.location = "requests.php";
}

function goToCreateProject()
{
window.location = "createproject.php";
}

function goToProjects()
{
window.location = "projects.php";
}

function goToProjectsU()
{
window.location = "projectsu.php";
}

function goToMyProjects()
{
window.location = "myprojects.php";
}

function goToPrivateProjects()
{
window.location = "privateaccepted.php";
}

function goToLearnMore()
{
window.location = "learnmore.php";
}

function goToopenproject(projectid)
{
window.location = "openproject.php?id="+projectid;
}

function goTocloseproject(projectid)
{
window.location = "closeproject.php?id="+projectid;
}

function goTopublic(projectid)
{
window.location = "changepublic.php?id="+projectid;
}

function goToprivate(projectid)
{
window.location = "changeprivate.php?id="+projectid;
}


function onSelectChange(){
 document.getElementById('frm').submit();
}

function validatemissinginfoabout()
{
	var about=document.forms["missinginfo"]["about"].value;
	if (about==null || "about"=="")
  	{
  		alert("Add info about yourself");
  		return false;
  	}
}

function validatemissinginfowork()
{
	var work=document.forms["missinginfo"]["work"].value;
	if (work==null || work=="")
  	{
  		alert("Add links to your work");
  		return false;
  	}
}

function validatemissinginfocontact()
{
	var nickname=document.forms["missinginfo"]["contact"].value;
	if (contact==null || contact=="")
  	{
  		alert("Add your contact info");
  		return false;
  	}
}

function validatemissinginfolocation()
{
	var nickname=document.forms["missinginfo"]["location"].value;
	if (location==null || location=="")
  	{
  		alert("Add your contact info");
  		return false;
  	}
}

function searchValidate()
{
	var searchterms=document.forms["navsearch"]["query"].value;
	if (searchterms==null || searchterms=="")
	{
		alert("You must type in a search term to search!");
		return false;
	}
	else 
	{
		var numOfWords = (searchterms.split(" ")).length
		if (numOfWords>2)
		{	
			alert("Please type in only up to two search terms!");
			return false;
		}
	}
}

function printFriendsListold(userid)
{
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function()
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{ 
			xmlDoc = xmlhttp.responseXML;
			var root = xmlDoc.documentElement;
			var friends = root.getElementsByTagName("friend");
			document.write("<table border=\"1\"><tbody><tr><th>Userid</th><th>First Name</th><th>Last Name</th>");
			for(var i = 0; i < friends.length; i += 1)
			{
				var fuserid = friends[i].getElementsByTagName("userid");
				var fname = friends[i].getElementsByTagName("fname");
				var lname = friends[i].getElementsByTagName("lname");
				document.write("<tr><td>");
				document.write(fuserid[0].textContent);
				document.write("</td><td>");
				document.write(fname[0].textContent);
				document.write("</td><td>");
				document.write(lname[0].textContent);
				document.write("</td></tr>");
			}
			document.write("</tbody></table>");
			}

	}
	var fListURL="getfriends.php?id=" + userid;
	xmlhttp.open("GET", fListURL, true)
	xmlhttp.send()
}

function checkProfilePicUpload()
{
	var fileUploadDoc = document.getElementById('upload_filename');
	var fileName = fileUploadDoc.value;
	var extension = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG" )
	{
	return true;
	} 
	else
	{
	alert("Upload Gif or Jpg images only");
	fileUploadDoc.focus();
	return false;
	}
}

/******Profile Navigation*******/
function showFriendsTab()
{
	//Show Selected Tab
	document.getElementById('friendsTab').style.display = '';
	
	//Hide deselected Tabs
	document.getElementById('userinfoTab').style.display = 'none';
	document.getElementById('dispatchesTab').style.display = 'none';

}

function showUserinfoTab()
{
	//Show Selected Tab
	document.getElementById('userinfoTab').style.display = '';
	
	//Hide deselected Tabs
	document.getElementById('friendsTab').style.display = 'none';
	document.getElementById('dispatchesTab').style.display = 'none';
	
}

function showDispatchesTab()
{
	//Show Selected Tab
	document.getElementById('dispatchesTab').style.display = '';
	
	//Hide deselected Tabs
	document.getElementById('friendsTab').style.display = 'none';
	document.getElementById('userinfoTab').style.display = 'none';
	
}



/**
 * I required this snipp.it due to the new format of dates from the v2 API and found
 * a great example so thought I'd share.
 * Credit to:
 *  - fest (http://snippets.dzone.com/user/fest)
 *  - post: http://snippets.dzone.com/posts/show/4132
 **/
function mysqlTimeStampToDate(timestamp) {
    //function parses mysql datetime string and returns javascript Date object
    //input has to be in this format: 2007-06-05 15:26:02
    var regex=/^([0-9]{2,4})-([0-1][0-9])-([0-3][0-9]) (?:([0-2][0-9]):([0-5][0-9]):([0-5][0-9]))?$/;
    var parts=timestamp.replace(regex,"$1 $2 $3 $4 $5 $6").split(' ');
    return new Date(parts[0],parts[1]-1,parts[2],parts[3],parts[4],parts[5]);
}
