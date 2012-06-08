  <title>Apex - </title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" href="./css/page.css" type="text/css" charset="utf-8"/>
  	
<link rel="shortcut icon" href="../favicon.ico"> </link>

  	
    	<script type="text/javascript" src="./lib/jquery.js"></script>
    	<script type="text/javascript" src="./lib/print.js"></script>
        
            
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
