<?php


$dbhost = "localhost";
$dbuser = "root";
$dbpass = "blackpearl";
$dbname = "apex";


	//Connect to MySQL Server
$myconnection =   mysql_connect($dbhost, $dbuser, $dbpass);
	//Select Database
mysql_select_db($dbname) or die(mysql_error());
	// Retrieve data from Query String





if(isset($_POST['name']))
{

$userid = $_POST['userid'];
$newusername = $_POST['name'];
$newpassword = $_POST['password'];
$newphone = $_POST['phone'];
$newusertype = $_POST['usertype'];
$newlockstatus = $_POST['lockstatus'];
$deleteRecord = $_POST['deleteRecord'];

if($deleteRecord == "delete")
{

$deleteQuery = "DELETE FROM userdata WHERE serialnum='".$userid."'";

$deleteQueryResult = mysql_query($deleteQuery) or die(mysql_error());

echo "Record Deleted Successfully";

exit();
}


if(strcmp($newpassword,""))
{

$passwordQuery = "UPDATE userdata set password=PASSWORD('".$newpassword."') WHERE serialnum='".$userid."'"; 

$passwordResult = mysql_query($passwordQuery);

echo "Password Changed";

}



$generalQuery = "UPDATE userdata set username='".$newusername."', phone='".$newphone."', usertype='".$newusertype."', locked='".$newlockstatus."' WHERE serialnum = '".$userid."'";

$generalResult = mysql_query($generalQuery);

echo " UserInfo Updated";

exit();









}
else
{

$userid =  $_POST['userid'];

	//build query
	$query = "SELECT * FROM userdata WHERE serialnum = '".$userid."'";
	//Execute query
	$qry_result = mysql_query($query) or die(mysql_error());

if(mysql_affected_rows() != 1)
{
echo "Something Broke ! Userid Mismatch !";
}
else
{

	$response = "OK|";
	
$row = mysql_fetch_array($qry_result);

for($i=0;$i<mysql_num_fields($qry_result);$i++)
{

$response .= "$row[$i]";
if($i!=(mysql_num_fields($qry_result)-1))
{
$response .= "|";
}

}//end of for
echo "$response";
}//end of else

}//end of outer else
mysql_close($myconnection);

?>
