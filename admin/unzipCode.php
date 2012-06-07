<?php
    if(!isset($_POST['filename']))
        die(json_encode (Array(1,"File name not found")));
    
    $file=$_POST['filename'];
    $unzip_path="/usr/bin/unzip";
    /*
* TODO: Use Configuration to save unzipped Files
*/
    $cmd="$unzip_path -d uploads/ $file";
    echo "Executing: $cmd";
    exec($cmd);
?>
