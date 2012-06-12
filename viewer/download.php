<?php
    if(!isset($_GET['file']))
        die("Error Occured!");

    $file=$_GET['file'];
    $prefix=basename(dirname($file),".ps");
    $pageTitle = $_GET['pageTitle'];
    header('Content-type: application/postscript');
    header("Content-Disposition: attachment; filename=\"$prefix-$pageTitle.ps\"");
    readfile($file);
?>
