<?php
    session_start();
    
    include '../conf/dir.php';

    if (isset($_SESSION['opid'])) {
        $opid=$_SESSION['opid'];
        $file=$OP_DIR.$opid."/".$_SESSION['file'];
        $dirname=$TILE_DIR_DYNAMIC.$opid."/";
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
    

$cmd2 = "grep -e ^%%Page: < $file | grep -o -e '('.*')'";
$cmd2 = " grep -e ^%%Page: < $file | grep -o -e '('.*')'|cut -d \) -f 1|cut -b2-";
ob_start();
	system($cmd2);
	$result=ob_get_contents();
ob_end_clean();

$pageNameList=explode("\n",$result);
array_pop($pageNameList);
    
    opendir($dirname);
    
    echo json_encode($pageNameList);
?>
