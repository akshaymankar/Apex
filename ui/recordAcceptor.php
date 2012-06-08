<?php


require_once('./lib/mysql.php');
//require_once('./lib/sessioncode.php');

$requestid = $_POST['requestid'];
$action = $_POST['action'];


if($action == "false")
{

$deleteQuery = "DELETE FROM userpending WHERE requestnumber='".$requestid."'";

$deleteQueryResult = mysql_query($deleteQuery) or die(mysql_error());

echo "Rejected";

mysql_close($myconnection);

exit();
}

if ($action == "true" )
{



$query = "select * from userpending where requestnumber= '".$requestid."'"; 

$queryResult = mysql_query($query) or die(mysql_error());

$pendingrecord = mysql_fetch_assoc($queryResult);



$generalQuery = "INSERT INTO userdata (username,password,phone) VALUES ('".$pendingrecord['username']."','".$pendingrecord['password']."','".$pendingrecord['phone']."')";

$generalResult = mysql_query($generalQuery);




$query = "select serialnum from userdata where username= '".$pendingrecord['username']."'"; 

$queryResult = mysql_query($query) or die(mysql_error());

$temprow = mysql_fetch_assoc($queryResult);

$tempuserid = $temprow['serialnum'];



$remainderQuery = "INSERT INTO moreuserdata VALUES('".$tempuserid."','".$pendingrecord['firstname']."','".$pendingrecord['lastname']."','".$pendingrecord['email']."','".$pendingrecord['location']."')";

mysql_query($remainderQuery) or die(mysql_error());


$deleteQuery = "DELETE FROM userpending WHERE requestnumber='".$requestid."'";

$deleteQueryResult = mysql_query($deleteQuery) or die(mysql_error());



echo "Accepted";

mysql_close($myconnection);

exit();

}




?>
