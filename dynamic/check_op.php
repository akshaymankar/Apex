<?php
    session_start();
    include '../conf/mysql.php';
    if (!isset($_POST['opid'])) {
        //die('Error Occurred..!! You are not Supposed to be here.');
        die('0');
    }
    $opid=$_POST['opid'];
    $query="select op_state from output where output_id='$opid'";
    
    $res=mysql_query($query);
    
    if (!$res) {
        //die('Error Occured While fetching from db'.mysql_error());
        die('died');
    }
    $row=mysql_fetch_row($res);

    echo $row[0];
    $_SESSION['opid']=$opid;
?>
