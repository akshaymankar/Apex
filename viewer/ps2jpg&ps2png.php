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
    $cmd1 = "gs -sDEVICE=jpeg -r40x40 -sOutputFile=$dirname/%d.jpg < $file";
//    echo $cmd1;
    exec($cmd1);
    
    
    $cmd2 = "gs -sDEVICE=png16m -r300x300 -sOutputFile=$dirname/%d.png < $file";
    exec($cmd2); 
    
    opendir($dirname);
    
    $list=array();
    while($jpgFile=readdir())
    {
		if(preg_match('/.jpg$/',$jpgFile) > 0)
			if($jpgFile!="." && $jpgFile!="..")
				$list[]=$jpgFile;
    }
    
    sort($list);
    
    
    echo json_encode($list);
?>
