<?php
    
    if(!isset($_POST['file']))
        die(json_encode (Array(1,"File Not Found !","post"=>$_POST,"file"=>$_FILES)));
    
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
?>
