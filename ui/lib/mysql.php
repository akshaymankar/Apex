<?php
    $db_host='localhost';
    $db_port=3306;
    $db_user='root';
    $db_password='mostwanted';
    $db_name='apex';

    $myconnection = mysql_connect("$db_host:$db_port",$db_user,$db_password);
    mysql_select_db($db_name);
?>
