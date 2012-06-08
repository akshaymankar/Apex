<?php
//TODO : Insert Session Code here.
require_once('../lib/sessioncode.php');
?>

<html>
    <head>
        <title>Apex - </title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" href="../css/page.css" type="text/css" charset="utf-8"/>
    	
<link rel="shortcut icon" href="/Apex/ui/favicon.ico"> </link>


    	<script type="text/javascript" src="../lib/jquery.js"></script>
    	<script type="text/javascript" src="../lib/print.js"></script>
        
            
        <script type="text/javascript">
            $(function() {
                var d=300;
                $('#navigation a').each(function(){
                    $(this).stop().animate({
                        'marginTop':'-80px'
                    },d+=150);
                });

                $('#navigation > li').hover(
                function () {
                    $('a',$(this)).stop().animate({
                        'marginTop':'-2px'
                    },200);
                },
                function () {
                    $('a',$(this)).stop().animate({
                        'marginTop':'-80px'
                    },200);
                }
            );
            });
        </script>

 
    <style>
        body{
            background:#E7F2F9 ;
            font-family:Arial;
            /*height:2000px;*/
            }
        
        
		.printable {
			border: 0px dotted #CCCCCC ;
			padding: 10px 10px 10px 10px ;
			}


        a.back{
            width:256px;
            height:73px;
            position:absolute;
            bottom:15px;
            right:15px;
            background:#fff url(codrops_back.png) no-repeat top left;
        }
        a.dry{
            position:absolute;
            bottom:15px;
            left:15px;
            text-align:left;
            font-size:12px;
            color:#ccc;
            text-transform:uppercase;
            text-decoration:none;
        }

    </style>
        
</head>        
        
<body>
   
  <!-- TODO : Fill in the HREFs below-->  
   
        <ul id="navigation">
            <li class="home"><a href=""><span>Home</span></a></li>
            <li class="myaccount"><a href=""><span>My Account</span></a></li>
            
			<li class="download"><a href=""><span>Download</span></a></li>
            <li class="print"><a href="#" id="printbutton"><span>Print</span></a></li>
<!--

           <li class="search"><a href=""><span>Search</span></a></li>
            <li class="rssfeed"><a href=""><span>Rss Feed</span></a></li>
  
 -->
		   <li class="about"><a href=""><span>Help</span></a></li>
           <li class="contact"><a href=""><span>Contact</span></a></li>
		   <li class="signout"><a href="#" onclick = "document.forms['logout'].submit();"><span>Sign out</span></a></li>
        </ul>
        
<form style="display:none;" action="../lib/logout.php" name="logout" method="POST"></form>

	
<!--// TODO : YOUR CODE HERE.-->
<br/><br/><br/>
Plese Select type of Output:
        <ul>
            <li><a href="../../dynamic/">Dynamic Graph</a></li>

            <li><a href="../../static/index.php">Static Graphs</a></li>
        </ul>


</body>

</html>
