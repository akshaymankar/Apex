<?php
		require_once 'mysql.php';
		
		$id= $_GET['id'];
		echo $id;
		
		$query="delete from template t,parameters p where t.templat_id=p.template_id and template_id="'$id';
		$res=mysql_query($query);
		
		 if (!$res) {
						die('Error: Failed to fetch parameters.'.mysql_error());
		 }
		
?>
