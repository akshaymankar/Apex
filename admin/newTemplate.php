<?php
    //print_r($_GET);
    //print_r($_FILES);
    //print_r($_POST_FILES);
    
    /*if(!isset($_GET['param_name[0]']) && !isset($_GET['param_type[0]'])){
        die('You are not supposed to be here !!');
    }*/

     //$param_name = $_GET['$param_name'];
        
    //foreach($param_name as $x=>$y){
     //   echo "asdasd".$y;
//    }
      
        //if(!$_GET['$param_name'])
        //        die("page died")
        //else{
                foreach ($_GET as $key=>$value){
                    //$$key = $_GET[$key];
                    print "$key is $value<br />";
                }
                
                
        //}  
       
        
?>

