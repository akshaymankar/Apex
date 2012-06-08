<?php
print_r($GET);
if(!isset($_GET['id'])){
       die('You are not supposed to be here !!');
    }
        require_once 'mysql.php';

        $id= $_GET['id'];
        echo $id;

        $query="delete from template where template_id='$id'";
        $res=mysql_query($query);

         if (!$res) {
                        die('Error: Failed to fetch parameters.'.mysql_error());
         }
		
?>
