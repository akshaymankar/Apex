<?php
    if(isset($_GET['dir']) && isset($_GET['file1']) && isset($_GET['file2']))
    {
		$dir = $_GET['dir'];
		$file1 = $_GET['file1'];
		$file2 = $_GET['file2'];
	}
    else
    {
		print_r($_GET);
        die('Died');
    }

   
    $dirname = "../tile/static/"."$file2";
    
    
    if(!is_dir($dirname))
    {
		exec("mkdir $dirname");


		$tempInputFileName = "$dir"."/"."$file1";
		$tempOutputFileName = "$dirname"."/"."$file2";

		$cmd1="exec 2>&1;gunzip -c $tempInputFileName > $tempOutputFileName";
		echo $cmd1;
		passthru($cmd1) or die("jhol");
	}    
?>
