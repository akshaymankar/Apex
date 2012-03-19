<?php
$username =  $_POST['name'];
$password = $_POST['password'];
$isRemember = $_POST['remember'];
$attempts =  $_POST['attempts'];

$maxAttempts = 3;

	// Escape User Input to help prevent SQL Injection
$username = addslashes($username);
$password = addslashes($password);
$isRemember = addslashes($isRemember);


$dbhost = "localhost";
$dbuser = "root";
$dbpass = "blackpearl";
$dbname = "apex";


	//Connect to MySQL Server
$myconnection = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error in MySQL Connection');
	//Select Database
mysql_select_db($dbname) or die(mysql_error());
	// Retrieve data from Query String


////////////////////////

// to obtain password hash

$passwordHash = "SELECT PASSWORD('".$password."')";

$result = mysql_query($passwordHash);

$hashrow = mysql_fetch_array($result);

$password = $hashrow[0];

///////////////////////


	//build query

if(is_numeric($username))
	$query = "SELECT * FROM userdata WHERE phone = '$username'";
else
{
$query = "SELECT * FROM userdata WHERE username = '$username' ";
}
	//Execute query
$qry_result = mysql_query($query);
if(!$qry_result) die(mysql_error());

if(mysql_affected_rows() == 0)
{
echo "Invalid Username !";
}

	
while($row = mysql_fetch_assoc($qry_result))
{
	
//	print_r($row);


if( $row['locked']=="locked" )
{
echo "locked";
exit();
}

	
	if($row['password'] == $password && $row['usertype'] == "user")
	{
	echo "accepted";
	
	setcookie("remember", $isRemember, time()+60*60*24*7); 
	setcookie("username", $username, time()+60*60*24*7); 
	}
	else if($row['password'] == $password && $row['usertype'] == "admin" )
	{
	echo "acceptedadmin";
	
	setcookie("remember", $isRemember, time()+60*60*24*7); 
	setcookie("username", $username, time()+60*60*24*7); 
	}
	else
	{
	echo "Username and Password didn't match !";

if($attempts >= $maxAttempts && $row['locked'] == "open")
{
	$tempquery = "UPDATE `apex`.`userdata` SET `locked` = 'locked' WHERE `userdata`.`serialnum` = '".$row['serialnum']."'";
	
	$tempresult = mysql_query($tempquery) or die(mysql_error());

	setcookie("locked",$row['username'],time()+60*60*24*7*365);
}


	}
	
}

sleep(1);
mysql_close($myconnection);
exit();
?>
