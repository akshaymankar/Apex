<?php

require_once('../lib/sessioncode.php');
?>

<html>
    <head>
        <title>Apex - </title>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

<link rel="stylesheet" href="../css/page.css" type="text/css" charset="utf-8"/>
    	
<link rel="shortcut icon" href="/Apex/ui/favicon.ico"> </link>


<script type="text/javascript" src="../lib/jquery.js"></script>

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
            }
        


a
{
color:white;
}

.containers
{

background-color:#000000;
border-radius:10px;
overflow:hidden;
height:80px;
width:30%;
cursor:pointer;
margin-bottom : 50px;
padding-top:20px;
padding-bottom:2px;

}


.containerHeaders
{
color:#FFFFFF;
font-size:3em;
}

.containerHeadersHover
{
color:yellow;
font-size:3em;


   -webkit-transition-property: color; 
   -webkit-transition-duration: .4s; 
   -webkit-transition-timing-function: ease-in;
   -webkit-transition-delay:.2s;



   -moz-transition-property: color; 
   -moz-transition-duration: .4s; 
   -moz-transition-timing-function: ease-in;
   -moz-transition-delay: .2s;

}



</style>

</head>        
        
<body>
   
        <ul id="navigation">
           <li class="home"><a href="http://grapes-3.tifr.res.in/" target="_blank"><span>Home</span></a></li>
           <li class="about"><a href="/Apex/Others/Help.html"><span>Help</span></a></li>
           <li class="contact"><a href="/Apex/Others/Contact.html"><span>Contact</span></a></li>
	   <li class="signout"><a href="javascript:void(0);" onclick = "document.forms['logout'].submit();"><span>Sign out</span></a></li>
        </ul>
        
<form style="display:none;" action="../lib/logout.php" name="logout" method="POST"></form>

<br />
<br />

<br />
<br />

<br />
<br />

<center>



<div class="containers" >
	
<center>
<a class="containerHeaders" style= "text-decoration:none;" href="../../dynamic/">Dynamic Plots</a>
</center>

</div>

<div class="containers" >
	
<center>
<a class="containerHeaders" style= "text-decoration:none;" href="../../static/index.php">Static Plots</a>
</center>

</div>

</center>


<script type="text/javascript">

$('.containers a').mouseenter(function()
{
if($('.containerHeaders').hasClass('containerHeadersHover'))
{
return false;
}

$(this).toggleClass('containerHeadersHover');
});


$('.containers a').mouseleave(function()
{
if($('.containerHeaders').hasClass('containerHeadersHover'))
{

$(this).toggleClass('containerHeadersHover');
}

});



</script>
</body>

</html>
