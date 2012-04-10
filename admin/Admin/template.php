<?php
		require_once 'mysql.php';
		
		$query="select * from template";
		$res=mysql_query($query);
		
		 if (!$res) {
						die('Error: Failed to fetch parameters.'.mysql_error());
		 }
		 
		 function getparameters($id){
				
				$query_parameters="select * from parameters where template_id='$id'";
				$res1=mysql_query($query_parameters);
				
				while($row1=$mysql_fetch_assoc($res1))
				{
					$str = $row1['name']+" ";
				}
						
						echo $str;
						return $str;
		 }//end of function getparameters
?>
	<html>
			<head>
			<meta http-equiv="content-type" content="text/html; charset=utf-8" />
					<Title>Admin</Title>
			</head>
		<body>
			<form action='AddTemplate.php' method='post'>
				<table>
						<th>Templates</th><th>Parameters</th>
						<?php
						while($row=mysql_fetch_assoc($res)){ ?>
							<tr> <td><a href='modifyTemplate.php?id=<?php echo $row['template_id']; ?>'> <?php echo $row['name']; ?></td></a> <td><?php //getparameters($row['template_id']); ?> </td></tr>
						
						<?php } ?>
				
				</table>
						<p><input type="submit" value="Add" /></p>
			</form>	
			<form action='DeleteTemplate.php' method='post'>
					<p><input type="submit" value="Delete"  onclick="show_confirm()" /></p>
			</form>	
		</body>
	</html>
	
	<script language="javaScript" type="text/javascript" >
			function show_confirm()
			{
				
				var r=confirm("Press a button!");
				if (r==true)
				  {
				  alert("You pressed OK!");
				  }
				else
				  {
					return false;  
				  //alert("You pressed Cancel!");
				  //window.location = self.location.reload(true); 
				  }
				  //window.location = confirm("Would you like to Update") ? "DeleTemplate.php" : self.location;
			}
	</script>
