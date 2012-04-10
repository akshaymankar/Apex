<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Admin Page</title>
		<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
                <script type="text/javascript" src="../js/addTemplate.js"></script>
		<script type="text/javascript">
			$(function(){

				// Accordion
				$("#accordion").accordion({ header: "h3" });
				
				//hover states on the static widgets
				$('#dialog_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); }, 
					function() { $(this).removeClass('ui-state-hover'); }
				
			);
                        
                        
                        
                        
                        $("table span").removeClass('ui-icon');
			$("table span").removeClass('ui-icon-triangle-l-e');
                        
                        
                        
                        });
                        
                        function redirectToAddTemplate()
                        {
                        window.location="../addTemplate.php";
                        }
                        
		</script>
		<style type="text/css">
			/*demo page css*/
			body{ font: 62.5% "Trebuchet MS", sans-serif; margin: 50px;}
			.demoHeaders { margin-top: 2em; color:  #00F }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
		
			a.myheader
			{
			font-size:20px;
			}
			
			td
			{
				font-size:15px;
			}	
                        .button_class
                        {
                            width:auto;
                            height: 40px;
                            color: #E70;
                            font-family:  sans-serif;
                            font-size:  x-large;
                        }
                        .parameters
                        {
                            border: #0d3349;
                            border-style:  double;
                            overflow:  auto;
                        }
                        .tr
                        {
                            border-style-inner:  dotted;
                            border-style:  dashed;
                        }
		
                       </style>	
	</head>
	<body>
	<?php
		require_once '../mysql.php';

		$query = "select * from template";
		$res = mysql_query($query);

		if (!$res) {
			die('Error: Failed to fetch parameters.' . mysql_error());
		}
	?>
	
		<!-- Accordion -->
		<h1 class="demoHeaders">Administration</h1>
		<div id="accordion">
	
			 <?php
				
			//echo "<form action='../deleteTemplate.php' method='GET' onsubmit='show_confirm();'";  
                         
			 while ($row = mysql_fetch_assoc($res)) { 
					   
				$id = $row['template_id'];
				$query_parameters = "select * from parameters where template_id='$id'";
				$res1 = mysql_query($query_parameters);

				if (!$res1) {
					die('Error: Failed to fetch parameters.' . mysql_error());
				}
                                        
                                        echo "<div>";
                                        echo "<h3><a href='#' class='myheader'>".$row['name']."</a></h3>";
					echo "<div>";
								
					echo "<table class='parameters'>";
					echo "<th><h3>Parameter_Name</h3></th><th><h3>Parameter_Type</h3></th><th><h3>Delete</h3></th>";									
					while ($row1 = mysql_fetch_assoc($res1)) {
							
						echo '<tr><td>' .$row1['name'] . '</td><td>' . $row1['type'] . '</td>
					
					<td><input type="image" src="../images/delete.png" width="15" height="15" name="id" title="Delete" alt="Delete" value=" '.$row['template_id'].'" /></td></tr>';
					}
					echo "</table>";
					echo "</div>\n</div>";
                                        
									 
			}
                        //echo "</form>";
                        
                        echo "<br /><br /><br /><input type='submit' class='button_class' value='Add Template' onclick='redirectToAddTemplate();' />";

            ?>    
	
