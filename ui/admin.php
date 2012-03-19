<?php
header("Expires: Thu, 17 May 2001 10:17:17 GMT");    // Date in the past
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
	header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
	header ("Pragma: no-cache");                          // HTTP/1.0
	
	session_start();
	
	
	if (!isset($_SESSION['SESSION'])) 
	{
		require ( "./lib/session_init.php");
    }




$_SESSION['LOGGEDIN'] = true;
$_SESSION['usertype'] = "admin";

//if $_SESSION['usertype'];

//header("Location: logout.php");
// make sure same password or phone number isn't entered twice

//$sql = "INSERT INTO `apex`.`userdata` (`serialnum`, `username`, `password`, `phone`, `usertype`) VALUES (NULL, \'blah\', \'this\', \'9923184428\', \'1\');";

// maximum number of failed attempts

//pipe not allowed in username or password

?>

<html>

<head>

<script type="text/javascript" src="./lib/jquery.js"></script>

<script src="./lib/lightbox.js"></script>

<link rel="stylesheet" href="./css/lightbox.css" type="text/css" media="screen" title="no title" charset="utf-8">

<script language="javascript" type="text/javascript">
<!-- 

var GLOBALUSERID = 0;

var ajaxRequest;

function ajaxFunction(){
	  
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		
				alert("Your browser broke!");
				return false;
			}
		
	
}

ajaxFunction();


ajaxRequest.onreadystatechange=function(){
 if (ajaxRequest.readyState==4){
  if (ajaxRequest.status==200){
   
   document.getElementById("result").innerHTML=ajaxRequest.responseText;

  //alert( document.getElementById("result").innerHTML);
  var resultString = document.getElementById("result").innerHTML;	

if (resultString == "Record Deleted Successfully")
{
$('#throbber').hide();
$('#result').css('display','inline-block');
$('#'+GLOBALUSERID).css('display','none');
return true;
}

if(resultString == "Success")
{
$('#submitbutton').show();
$('#throbber').hide();
$('#result').css('display','inline-block');
return true;
}



if(resultString == "Password Changed")
{
$('#submitbutton').show();
$('#throbber').hide();
$('#result').css('display','inline-block');
return true;
}

if(resultString == " UserInfo Updated")
{
$('#submitbutton').show();
$('#throbber').hide();
$('#result').css('display','inline-block');
return true;
}







var resultArray = resultString.split('|');

if(resultArray[0]!="OK")
{
  $('#result').css('display','inline-block');
}
else
{
	
document.getElementById('useridheader').innerHTML = "User Id : "+resultArray[1];
	
document.getElementById("name").value = resultArray[2];
document.getElementById("phone").value = resultArray[4];

if(resultArray[5]=="user")
{
	document.getElementById("regularuser").checked = true;
}
else if(resultArray[5]=="admin")
{
document.getElementById("adminuser").checked = true;
}

if(resultArray[6]=="nolock")
{
document.getElementById("nolockstatus").checked = true;
}
else if(resultArray[6]=="open")
{
document.getElementById("openlockstatus").checked = true;
}
else if(resultArray[6]=="locked")
{
document.getElementById("lockedlockstatus").checked = true;
}


}
  
  
}//end of ajax status
  else{
   alert("An error has occured while making the request");
  }
 }
}



function failed_retry()
{
alert('hey');
}


function makeRequest()
{

$('#submitbutton').hide();
$('#throbber').show();


var namevalue = encodeURIComponent(document.getElementById("name").value);
var passvalue = encodeURIComponent(document.getElementById("password").value);
var phonevalue = encodeURIComponent(document.getElementById("phone").value);
var usertype = encodeURIComponent($('input:radio[name=usertype]:checked').val());
var lockstatus = encodeURIComponent($('input:radio[name=lockstatus]:checked').val());
var deleteRecord = encodeURIComponent(document.getElementById("deletehidden").value)

var parameters="userid="+GLOBALUSERID+"&name="+namevalue+"&password="+passvalue+"&phone="+phonevalue+"&usertype="+usertype+"&lockstatus="+lockstatus+"&deleteRecord="+deleteRecord;

ajaxRequest.open("POST", "recordUpdater.php", true);
ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
ajaxRequest.send(parameters);

}



function deleteFunction()
{
$('#throbber').show();	
$('#deletebutton').hide();
document.getElementById('deletehidden').value = 'delete';
makeRequest();
return false;
}

//-->
</script>






<script type="text/javascript">
$(function(){
    $('tr:even').addClass('alternateClass');
    $('tr:odd').addClass('mainClass');


//////////////////////////////////////////////////////////////////////////////////


	$("tr td").dblclick(function(){
   $("#change_up").lightbox_me({centered: true, onLoad: function() {
			
			$('#result').css('display','none')
			document.getElementById('name').focus();						
			document.getElementById('deletehidden').value="dont";	
			$('#throbber').hide();
			$('#deletebutton').show();
			$('#submitbutton').show();
	}});

});





    
///////////////////////////////////////////////////////////////////////////////////
$('#usersummarycontainer').click(function(){

$('#usersummarycontainer').addClass('fullviewContainers');
$('#usersummaryheader').addClass('fullviewHeaders');
$('#usersummaryclosebutton').css('display','inline-block');

});


$("#usersummaryclosebutton").live("click",function(){
            $('#usersummarycontainer').toggleClass("fullviewContainers");
            $('#usersummaryheader').toggleClass('fullviewHeaders');
            $('#usersummaryclosebutton').css('display','none');
});


/////////////////////////////////////////////////////////////////////////////////

$('#createusercontainer').click(function(){

$('#createusercontainer').addClass('fullviewContainers');
$('#createuserheader').addClass('fullviewHeaders');
$('#createuserclosebutton').css('display','inline-block');

});


$("#createuserclosebutton").live("click",function(){
            $('#createusercontainer').toggleClass("fullviewContainers");
            $('#createuserheader').toggleClass('fullviewHeaders');
            $('#createuserclosebutton').css('display','none');
});

});



function updateRecord(thisrow)
{				
//$('#submitbutton').hide();
//$('#throbber').show();

GLOBALUSERID = thisrow.id;
var userid=encodeURIComponent(thisrow.id);

var parameters="userid="+userid;

ajaxRequest.open("POST", "recordUpdater.php", true);
ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
ajaxRequest.send(parameters);
				
				     
}

</script>

<style>

table tr td, table tr th {
-moz-border-radius-bottomright:14px;
-webkit-border-bottom-right-radius:14px;
border-bottom-right-radius:14px;

font-family: sans-serif;
font-size: 1.2em;
text-align:center;

padding:5px 15px 5px 15px;

-moz-border-radius-bottomleft:14px;
-webkit-border-bottom-left-radius:14px;
border-bottom-left-radius:14px;


-moz-border-radius-topright:14px;
-webkit-border-top-right-radius:14px;
border-top-right-radius:14px;

-moz-border-radius-topleft:14px;
-webkit-border-top-left-radius:14px;
border-top-left-radius:14px;

}


.alternateClass
{
background-color:#FF4747;
}

.mainClass
{
background-color:#3366FF;
}

.containers
{

background-color:#000000;
border-radius:10px;
overflow:hidden;
height:80px;
width:30%;
cursor:pointer;
margin-bottom : 50px;

/*


-webkit-transition-property: height, width;
   -webkit-transition-duration: .5s; 
	-webkit-transition-timing-function: ease-in;
   -webkit-transition-delay:0.2s;

-moz-transition-property: height,width;
   -moz-transition-duration: .5s;
	-moz-transition-timing-function: ease-in;
   -moz-transition-delay:0.2s;

*/	
}


.fullviewContainers
{
background-color:#FFC98F;
border-radius:10px;

overflow:visible;
height:auto;
padding-bottom:40px;
width:80%;


cursor:auto;
/*
   -webkit-transition-property: height,width;
   -webkit-transition-duration: .5s; 
   -webkit-transition-timing-function: ease-in;
   -webkit-transition-delay: 0.2s;


   -moz-transition-property: height,width;
   -moz-transition-duration: .5s; 
   -moz-transition-timing-function: ease-in;
   -moz-transition-delay: 0.2s;

*/

}

.containerHeaders
{
color:#FFFFFF;
margin-top:2px;
padding-top:21px;
}

.containerHeaders:hover
{
color:yellow;
margin-top:2px;
padding-top:21px;

   -webkit-transition-property: color; 
   -webkit-transition-duration: .4s; 
   -webkit-transition-timing-function: ease-in;
   -webkit-transition-delay:.2s;



   -moz-transition-property: color; 
   -moz-transition-duration: .4s; 
   -moz-transition-timing-function: ease-in;
   -moz-transition-delay: .2s;

}

.fullviewHeaders
{
color:#000000;
margin-top:2px;
padding-top:21px;
}


.closebutton
{
float:right;

	height:35px;
	width:35px;
	padding-right:2px;
	padding-top:2px;
cursor:pointer;
}

</style>

</head>

<body>

<form action="logout.php" method ="POST">

<input type="submit" ></input>

<p id="temp"></p>

</form>

<center>

<div id="usersummarycontainer" class="containers" >
	
<img id = "usersummaryclosebutton" src="resource/close_button.png" class="closebutton" style ="display:none;cursor:pointer;" />

<center>
<h1 id="usersummaryheader" class="containerHeaders">User Summary</h1>
</center>

<?php


$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "apex";


	//Connect to MySQL Server
mysql_connect($dbhost, $dbuser, $dbpass);
	//Select Database
mysql_select_db($dbname) or die(mysql_error());
	// Retrieve data from Query String

	//build query


	$query = "SELECT * FROM userdata";

	//Execute query
$qry_result = mysql_query($query) or die(mysql_error());

if(mysql_affected_rows() == 0)
{
echo "<center><h1>Something broke !</h1></center>";
}


echo '<table cellpadding="5" cellspacing="5" width="50%" align="center">';
echo "<tr style=\"background-color:yellow;\">";
echo "<th>User&nbsp;Id</th>";
echo "<th>Username</th>";
echo "<th>Password</th>";
echo "<th>Phone</th>";
echo "<th>Type</th>";
echo "<th>Lock</th>";
echo "</tr>";


while($row = mysql_fetch_array($qry_result))
{
echo "<tr id='".$row['serialnum']."' style=\"cursor:pointer\"ondblclick=\"updateRecord(this);\">";


for($i=0;$i<mysql_num_fields($qry_result);$i++)
{
echo "<td>";
echo "$row[$i]";
echo "</td>";
}

echo "</tr>";

}

/*
*/
?>
</table>
</div>
</center>

<center>
<div id="createusercontainer" class="containers" >
	
<img id="createuserclosebutton" src="resource/close_button.png" class="closebutton" style ="display:none;cursor:pointer;" />

<center>
<h1 id="createuserheader" class="containerHeaders">Create User</h1>
</center>

</div>
</center>



<div id="change_up">

<img class="closebutton" style="display:inline-block;margin-right:-53px;margin-top:-12px" src="resource/close_button.png" onclick="$('#change_up').trigger('close');" />

<center>

<h3 id="useridheader"></h3>
</center>
<form id="changeRecord" method="post" action="recordUpdater.php">

<strong>

<label for="userNameBox">Username: </label>
<input type="text" name="userNameBox" id="name" tabindex="10" placeholder="or Enter Phone number" required>
<br />       
<br />
<label for="passWordBox">Password: </label>
&nbsp;<input type="text" name="passWordBox" id="password" placeholder="Set new Password" tabindex="20" />
<br />
<br />


<label for="phoneBox">Phone: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="phoneBox" id="phone" tabindex="30" />
<br />       
<br />

<label for="usertype">User Type: </label>
</br>
</strong>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id = "regularuser" name="usertype" value="user" > Regular User </input> <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="adminuser" name="usertype" value="admin" > Admin </input>


<strong>
<br />
<label for="lockstatus">Lock setting: </label>
</br>
</strong>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id = "nolockstatus" name="lockstatus" value="nolock" > No Locking </input> <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="openlockstatus" name="lockstatus" value="open"> Open </input><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id = "lockedlockstatus" name="lockstatus" value="locked" > Locked </input> <br />


<center>
<p style="text-align:center;border-radius:10px;background-color:red;color:white;display:none;width:auto;padding:10px;margin-bottom:0px;" id="result">blah</p>
</center>


<center>
	
	<div style="position:relative;">


<input type="hidden" id = "deletehidden" value="dont" />
                        <a class="formbuttons"  href="#" tabindex="90"  id="deletebutton" onclick="deleteFunction();" >Delete Record</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="formbuttons"  href="#" tabindex="100" id="submitbutton" onclick="makeRequest();return false;" >Log In</a>
                                                                                            
                        <img style="display:none;position:absolute;top:10px;" id="throbber" src="resource/ajax-loader.gif" />
        </div>                
                        
</center>

</form>

</body>
</html>
