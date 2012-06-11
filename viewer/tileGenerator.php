<?php
    session_start();
    if (!isset($_POST['file'])) {
        print_r($_POST);
        die('Error Occured');
    }

    $f=$_POST['file'];
    $l=$_POST['left'];
    $t=$_POST['top'];
    $b=$_POST['bottom'];
    $r=$_POST['right'];
    $z=$_POST['zoom'];
    
    $o=$_POST['output'];
    
    $imgNumber = $_POST['imgNumber'];
    $tiledir = $_POST['tiledir'];

    /**
     * TODO: Read from conf
     **/

$conffile = fopen("/Apex/conf/paths.csv","r");

$flag=0;




while (($data = fgetcsv($conffile, 80, ',', '"') !== FALSE)) 
{
if($data[0]=="TILEMAKER_PATH")
{
$tilemaker = $data[1];
$flag=1;
}
       
    }

if($flag==0)
{
echo "TILEMAKER_PATH not found in /Apex/conf/paths";
}

fclose($conffile);


    $h=256;
    $w=256;

    //$tilemaker = '../executable/tilemaker';
    
exec("mkdir $tiledir/$imgNumber");
    

    if(!is_file("$o$z-0-0.jpg")) {
        $cmd = "$tilemaker -h $h -w $w -l $l -t $t -r $r -b $b -z $z -o $o $f";
	echo $cmd;
        passthru($cmd);
    }
?>
