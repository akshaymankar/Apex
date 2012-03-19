<?php
    session_start();
    session_destroy();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Beautiful Fixed Slide Out Navigation - Codrops</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" href="css/page.css" type="text/css" charset="utf-8"/>
    </head>
    <style>
        body{
            background:#E7F2F9 ;
            font-family:Arial;
            height:2000px;
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
    <body>
   
        <ul id="navigation">
            <li class="home"><a href=""><span>Home</span></a></li>
            <li class="myaccount"><a href=""><span>My Account</span></a></li>

            
			<li class="download"><a href=""><span>Download</span></a></li>
            <li class="print"><a href=""><span>Print</span></a></li>



			<!--
            <li class="search"><a href=""><span>Search</span></a></li>
            <li class="rssfeed"><a href=""><span>Rss Feed</span></a></li>
   
           --!>

		   <li class="about"><a href=""><span>Help</span></a></li>
           <li class="contact"><a href=""><span>Contact</span></a></li>
		   <li class="signout"><a href=""><span>Sign out</span></a></li>
        </ul>
        
        Plese Select type of Output:
        <ul>
            <li><a href="../dynamic/">Dynamic Graph</a></li>
            <li><a href="../static/staticFileSelector.php">Static Graphs</a></li>
        </ul>
        
        <script type="text/javascript" src="./lib/jquery.js"></script>
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
    </body>
</html>
