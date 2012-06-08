<?php
    require_once 'mysql.php';
    //read values and write to db
    
    $template_id=$_POST['template'];
    
    //echo "Template id=$template_id";
    $query="insert into output values('','$template_id','PREPARING')";
    mysql_query($query) or die('Error Occurred !!'.mysql_error());
    
    $query="select LAST_INSERT_ID()";
    $res=mysql_query($query);
    
    if (!$res) {
        die('Error Occurred !!'.mysql_error());
    }

    $row=mysql_fetch_row($res);
    $output_id=$row[0];

    $query="select * from parameters where template_id='$template_id'";
    $res=mysql_query($query);

    if(!$res)
        die('Error Occured !!'.mysql_error());
    
    while($row=mysql_fetch_assoc($res))
    {
        $parameter_id=$row['parameter_id'];
        $query="insert into actual_parameter values('','$parameter_id','$output_id','".$_POST[$parameter_id]."')";
        mysql_query($query) or die('Error Occurred !!'.mysql_error());
    }

    //enqueue request
    //TODO: Read Location of executable from configuration
    $cmd="/var/www/Apex/executable/enqueue $output_id";
    //echo "Command: $cmd";
    exec($cmd);
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Apex: Route 2 Route</title>
        <script type="text/javascript" charset="utf-8" src="result.js"></script>
    </head>
    <body onload="check_op(<?php echo $output_id; ?>)">
        <p>Please wait while the output is ready</p>
    </body>
</html>
