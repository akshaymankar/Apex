<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Admin Page</title>
		<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" />	
		<!--<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>-->
                <link type="text/css" href="accordion/css/alert.css" rel="stylesheet" />	
                
                <style type="text/css">
			/*demo page css*/
			
                </style>
        </head>
<body>        
<?php
    
    require_once '../dynamic/mysql.php';
    if(!isset($_FILES['file']))
        die(json_encode (Array(1,"File Not Found !")));
    
     
    if($_FILES['file']['type'] != 'application/zip')
        die(json_encode (Array(2,"File is Not a Zip Archive !!")));
    
       /*
            * TODO: Use Configuration to save uplaoded file
        */
    
    $target_file= "uploads/".$_FILES['file'][name];
           
    if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
        echo json_encode(Array(0,$target_file));
    }
    else{
        die(json_encode(Array(3,"Error Occured while saving !!\nPlease Contact Site Admin !")));
    }
    
    $file=$_FILES['file'][name];
    $unzip_path="/usr/bin/unzip";
    
    // TODO: Use Configuration to save unzipped Files
       
        
        //$cmd="$unzip_path -d ./uploads/  $target_file";
        //echo "<br />Executing: $cmd";
        //exec($cmd);
    
        $cmd="gunzip -c $target_file > ./uploads/ ";
        echo "<br /> Executing: $cmd";
        exec($cmd);
    
        
    $file_Extract=substr_replace($target_file, '',-3);
      
    $file_Extract="/var/www/Apex_notGit/Admin/makefile/myMakefile";
    
    $cmd='make -f '.$file_Extract.' 2>&1';
    
    ob_flush();
    ob_start();
    
    passthru($cmd,&$return_var);
    
    $content_grabbed=ob_get_contents();
    ob_end_clean();
    
    if($return_var>=1){
            //echo "Error Occured while making of file!!!! please check file.<br />";
            //echo $return_var."<br />";
            //echo $content_grabbed;
            // $content_grabbed= substr($content_grabbed, strlen($cmd)-1);
        
            errorprint($content_grabbed);
    }
    else{
            echo "Successful completion <br />";
            echo $return_var;
    }
        
    $template_name = $_POST['template_name'];
    $count = $_POST['largestId'];
    $template_id=$_POST['templateId'];
        
    $cmd="insert into template values('','$template_name','$target_file','IMAGE','temp.cpp')";
    $res= mysql_query($cmd);
        
     if (!$res) {
         errorprint(mysql_error());    
                    die('Error: Failed to fetch parameters.'.mysql_error());
     }

     $no=mysql_insert_id();

    for($i=0;$i<=largestId;$i++){
         $param_name = $_POST['param_name'][$i];
         $param_type = $_POST['param_type'][$i];
        
        //echo "Swapnil $param_name And $param_type";
        $cmd="insert into parameters values('','$param_name','$param_type','i+1','$no')";
        $res1=mysql_query($cmd);
        if (!$res1) {
                       die('Error: Failed to fetch parameters.'.mysql_error());
        }
    }
    
?>
    <?php
        function errorprint($str){
                   echo'<div class="ui-widget">';
                        echo'<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> ';
                            echo'<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> ';
                            echo'<strong>Alert! </strong>'. $str.'.</p>';
                        echo'</div>';
                    echo'</div>';    
        }
        
    ?>
     
</body>
</html>