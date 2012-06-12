<?php

if (!isset($_GET['file']))
    die("Error Occured!");

$file = $_GET['file'];
$prefix = basename(dirname($file), ".ps");
$pageTitle = $_GET['pageTitle'];
$fmt = $_GET['format'];
if($fmt=='ps'){
    header('Content-type: application/postscript');
    header("Content-Disposition: attachment; filename=\"$prefix-$pageTitle.ps\"");
    readfile($file);
}else if($fmt=='pdf'){
    header('Content-type: application/pdf');
    
    header("Content-Disposition: attachment; filename=\"$prefix-$pageTitle.pdf\"");
    $opFile=time()."_$prefix-$pageTitle.pdf";
    exec("ps2pdf \"$file\" \"$opFile\"");
    readfile($opFile);
    exec("rm \"$opFile\"");
}
?>
