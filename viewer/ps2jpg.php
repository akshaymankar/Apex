<?php
    session_start();
    if (isset($_SESSION['opid'])) {
        $opid=$_SESSION['opid'];
        $file="../output/dynamic/$opid/".$_SESSION['file'];
        $dirname="../tile/dynamic/$opid";
    }
    else {
        
        if(isset($_GET['file'])) {
            $file=$_GET['file'];
            $dirname=$_GET['tiledir'];
        }
        else {
            print_r($_GET);
            die('Died');
        }
    }
    exec("mkdir $dirname");
    $cmd1 = "gs -sDEVICE=jpeg -r16x16 -sOutputFile=$dirname/%d.jpg < $file";
    exec($cmd1);



//    echo $cmd1;

//grep -o -e (.*);

$cmd2 = "grep -e ^%%Page: < $file | grep -o -e '('.*')'";
ob_start();
system($cmd2);
$result=ob_get_contents();
ob_end_clean();

$pageNameList=explode("\n",$result);
array_pop($pageNameList);
//passthru($cmd2);
    
    
   // $cmd2 = "gs -sDEVICE=png16m -r300x300 -sOutputFile=$dirname/%d.png < $file";
    //exec($cmd2); 
    
    opendir($dirname);
    
    /*
    $fileNamelist=array();
    while($jpgFile=readdir())
    {
		if(preg_match('/.jpg$/',$jpgFile) > 0)
			if($jpgFile!="." && $jpgFile!="..")
				$fileNamelist[]=$jpgFile;
    }
    
    sort($fileNamelist);
    $list[]=$result;
    */
    
    echo json_encode($pageNameList);
?>
