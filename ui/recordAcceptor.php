<?php


require_once('../conf/mysql.php');
//require_once('./lib/sessioncode.php');

$requestid = $_POST['requestid'];
$action = $_POST['action'];


if($action == "false")
{

$deleteQuery = "DELETE FROM userpending WHERE userid='".$requestid."'";

$deleteQueryResult = mysql_query($deleteQuery) or die(mysql_error());

echo "Rejected";

mysql_close($myconnection);

exit();
}

if ($action == "true" )
{



$query = "select * from userpending where userid= '".$requestid."'"; 

$queryResult = mysql_query($query) or die(mysql_error());

$pendingrecord = mysql_fetch_assoc($queryResult);



$generalQuery = "INSERT INTO userdata (username,password,phone,email) VALUES ('".$pendingrecord['username']."','".$pendingrecord['password']."','".$pendingrecord['phone']."','".$pendingrecord['email']."')";

$generalResult = mysql_query($generalQuery);


$deleteQuery = "DELETE FROM userpending WHERE userid='".$requestid."'";
$deleteQueryResult = mysql_query($deleteQuery) or die(mysql_error());


echo "Accepted";

mysql_close($myconnection);

exit();

}




?>
