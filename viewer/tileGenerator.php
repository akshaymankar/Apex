<?php

session_start();

include '../conf/dir.php';

if (!isset($_POST['file'])) {
    print_r($_POST);
    die('Error Occured');
}

$f = $_POST['file'];
$l = $_POST['left'];
$t = $_POST['top'];
$b = $_POST['bottom'];
$r = $_POST['right'];
$z = $_POST['zoom'];
$o = $_POST['output'];

$imgNumber = $_POST['imgNumber'];
$tiledir = $_POST['tiledir'];

$h = 256;
$w = 256;

$tilemaker = $TILEMAKER_DIR;


exec("mkdir $tiledir/$imgNumber");


if (!is_file("$o$z-0-0.jpg")) {
    $cmd = "$tilemaker -h $h -w $w -l $l -t $t -r $r -b $b -z $z -o $o $f";
    echo $cmd;

    passthru($cmd);
}
?>
