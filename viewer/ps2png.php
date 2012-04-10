<?php
    session_start();
    if (isset($_SESSION['opid'])) {
        $opid=$_SESSION['opid'];
        $file="../output/dynamic/$opid/".$_SESSION['file'];
        $dirname="../tile/dynamic/$opid/";
        $pageNo="1";//error
    }
    else {
        
        if(isset($_GET['file'])) {
            $file=$_GET['file'];
            $dirname=$_GET['tiledir'];
            $pageNo=$_GET['pageNo'];
        }
        else {
            print_r($_GET);
            die('Died');
        }
    }
   
   
    ////exec("mkdir $dirname");
    
    
    $outputFile = "$dirname"."$pageNo";
    
    if($pageNo<10)
    {
		$singlePagePsFile = $dirname.$pageNo."_000".$pageNo.".ps";
	}
	else if($pageNo>=10 && $pageNo<100)
    {
		$singlePagePsFile = $dirname.$pageNo."_00".$pageNo.".ps";
	}
	else if($pageNo>=100 && $pageNo<1000)
    {
		$singlePagePsFile = $dirname.$pageNo."_0".$pageNo.".ps";
	}
	else if($pageNo>=1000 && $pageNo<10000)
    {
		$singlePagePsFile = $dirname.$pageNo."_".$pageNo.".ps";
	}
	
	
	if(!is_file($singlePagePsFile))
	{
		$cmd1 = "pssplit $pageNo $file $outputFile";
		exec($cmd1);
    } 
    
    
	if(!is_file($outputFile.".png"))
	{
		$cmd2 = "gs -sDEVICE=png16m -r300x300 -sOutputFile=$outputFile.png < $singlePagePsFile";
		exec($cmd2); 
	}
?>
