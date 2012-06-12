<?php
    $db_host='localhost';
    $db_port=3306;
    $db_user='root';
    $db_password='apex123';
    $db_name='dbApex';

    $myconnection = mysql_connect("$db_host:$db_port",$db_user,$db_password) or die(mysql_error());
    mysql_select_db($db_name);
?>
