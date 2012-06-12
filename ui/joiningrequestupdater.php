<?php

$username =  $_POST['name'];
$password = $_POST['password'];

$email =  $_POST['newemail'];
$phone = $_POST['newphone'];


$username = addslashes($username);

$email = addslashes($email);

$phone = addslashes($phone);



require_once('../conf/mysql.php');




if ($username == null || $password == null || $email == null || $phone ==null)
{
echo "Every field is mandatory.";
exit();
}




//build query

$querybyphone = "SELECT * FROM userdata WHERE phone = '$phone'";
$querybyuname = "SELECT * FROM userdata WHERE username = '$username'";

//Execute query

$qry_result_phone = mysql_query($querybyphone) or die(mysql_error());

if(mysql_affected_rows() != 0)
{
echo "Phone exists !";
exit();
}

$qry_result_uname = mysql_query($querybyuname) or die(mysql_error());



if(mysql_affected_rows() != 0)
{
echo "Username exists !";
exit();
}

	
$query = "insert into userpending(username,phone,email,password) values ('".$username."','".$phone."','".$email."','".$password."')";

$qry_result = mysql_query($query) or die(mysql_error());


echo "Request Submitted Successfully.";



mysql_close($myconnection);
exit();
?>
