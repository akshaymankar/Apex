<?php    
    session_start();

    include '../dynamic/mysql.php';

    if(!isset($_SESSION['opid'])) {
        //print_r($_SESSION);
        if(isset($_GET['filetype']) && isset($_GET['filename']))
        {
            $fileType=$_GET['filetype'];
            $fileName="../tile/static/".$_GET['filename']."/".$_GET['filename'];
            $tiledir="../tile/static/".$_GET['filename']."/";
        }
        else
        {
            print_r($_GET);
            die('Died');
        }
    }
    else
    {
        $opid=$_SESSION['opid'];
        
        $query="select op_filename from template,output where output.template_id=template.template_id and output_id='$opid'";

        $res = mysql_query($query);
        if (!$res) {
            die('Error Occured while getting output file'.mysql_error());
        }

        $row=mysql_fetch_row($res);
        if(!$row){
            die('Error Occured while getting output file name'.$query);
        }
        /**
         * TODO: Read opdir from config
         **/
        $opdir='../output/dynamic/';
        $_SESSION['file']=$row[0];
        $fileName="$opdir/$opid/".$row[0];
        $tiledir="../tile/dynamic/$opid/";
    }
?>
<html>
<head>
    <title>APEX : CheBoZ</title>


	<style type="text/css">
	<!--   @import url(CSS/zoom.css);-->
	<!--   @import url(CSS/pan.css);-->
	<!--   @import url(CSS/buttonControls.css);-->
    </style>

    
    <script type="text/javascript" src="script/zoom.js"></script>    
    <script type="text/javascript" src="script/eventUtil.js"></script>
    <script type="text/javascript" src="script/pan.js"></script>    
    <script type="text/javascript" src="script/buttonControls.js"></script>    
    
    
	<style type="text/css">

	div#docviewer
	{
		background-color:blue;
		float:left;
		overflow:auto;
		border:5px;
		border-color:black;
		border-style:solid;
		padding:10px;
		margin:0; 
	}

	.docviewerthumbnails
	{
		display:inline;
		margin-right:25px;
		height: 300px;
	}
	
	div#main 
	{
		font-family: sans-serif;
		margin: 0;
		padding: 10px 0px 10px 0px;
		color: #000000;
		background-color: #FFFFFF;
		font-size: 0.7em;
		border: 5px;
		border-color:black;
		border-style:solid;
	}
	
	</style>
    
    
    <?php
		//$dirHandle = opendir("/var/www/Apex/chebo");
	?>
    
         
	<script type="text/javascript">
	
	var URL = "";
	var PREFIX = 'tile-';
	var WIDTH = 3250;
	var HEIGHT = 3750;
	var TILESIZE = 256;
	var EXTENSION = '.jpg';
	
	
	var GLO_MainFileDir = "";
	var GLO_TileFileDir = "";

    var GLO_ImgNumber=1;
	
	xhr = false;
    
    if (window.XMLHttpRequest)
		xhr = new XMLHttpRequest();	//For every browser other than IE
    else if (window.ActiveXObject)
		xhr = new ActiveXObject("Microsoft.XMLHTTP");	//For IE 7+
      
      
    function ps2jpg()
    {
		//var filename =  document.getElementById("opFile").value;
        var psfile = "<?php echo $fileName; ?>";
        var tiledir= "<?php echo $tiledir; ?>";
		GLO_MainFileDir = psfile + '_Dir';    
        
        
        var params="file="+psfile;
        params+="&tiledir="+tiledir;
    
        xhr.open("POST","ps2jpg&ps2png.php?"+params);
        xhr.onreadystatechange = function ()
        {
            if (xhr.readyState == 4 && xhr.status == 200)
            {
				var jpgList=new Array();
							         
				jpgList=eval('(' + xhr.responseText + ')');
            	
				var tempDocViewer = document.getElementById("docviewer");

            	for(var i=0;i<jpgList.length;i++)
            	{
					var imageNumber = i + 1; 


					var tempAnchor = document.createElement('a');
					tempAnchor.setAttribute('id', imageNumber);
					tempAnchor.setAttribute('href', '#');
					tempAnchor.setAttribute('onclick', 'displayInViewer(this.id);');
					tempDocViewer.appendChild(tempAnchor);
					
					var tempImg = document.createElement('img');
					tempImg.setAttribute('id', imageNumber);
					tempImg.setAttribute('name', 'docviewerthumbnails');
					tempImg.setAttribute('class', 'docviewerthumbnails');
					tempImg.setAttribute('style', 'height:200px;margin:20px;');//todo
					tempImg.setAttribute('src','<?php echo $tiledir; ?>/'+imageNumber+'.jpg');
					tempAnchor.appendChild(tempImg);						
				}
				
				
				displayInViewer('1');
			}
            else if (xhr.readyState == 4 && xhr.status != 200) 
            {
				alert("xhr status :" + xhr.status);//TODO There should be error page
            }
		}
        
        xhr.send(null);
	}


	function displayInViewer(imgNumber) 
    {
        GLO_ImgNumber=imgNumber;
		var imagePath = GLO_MainFileDir + '/' + imgNumber + ".png"; 
		GLO_TileFileDir = '<?php echo $tiledir; ?>';
  
        var params="file=<?php echo $tiledir; ?>"+imgNumber+".png";
        params+="&zoom=0";
        params+="&left=0";
        params+="&top=0";
        params+="&bottom=256";
        params+="&right=256";
        params+="&height=256";
        params+="&width=256";
        params+="&output=<?php echo $tiledir; ?>/" + imgNumber + "/tile-" 
        params+="&imgNumber="+imgNumber;
        params+="&tiledir=<?php echo $tiledir; ?>";

        xhr.open("POST","tileGenerator.php");
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.setRequestHeader("Content-length", params.length);

        xhr.onreadystatechange = function ()
        {
			if (xhr.readyState == 4 && xhr.status == 200)
            {
				URL = "<?php echo $tiledir; ?>/"+imgNumber+"/";
				var x=xhr.responseText;
				initViewers();
			}
            else if (xhr.readyState == 4 && xhr.status != 200) 
            {
                alert(xhr.status);//TODO There should be error page
            }
        }
        
        xhr.send(params);
	} 


	function createViewer(url,width,height) 
	{
		init("<?php echo $tiledir; ?>",url,PREFIX,width,height,TILESIZE,EXTENSION);
	}
	
	function initViewers() 
	{
		createViewer(URL,WIDTH,HEIGHT);
	}
  
	</script>
</head>


<body>   
	
	<input type="hidden" id="opFile" name="opFile" value="<?php echo $fileName?>">	
	
	
	<?php
	
		echo '<script type="text/javascript">ps2jpg();</script>';

	?>
	
	
	<div id="docviewer" style="width: 20%; height: 100%;" align="center">
    </div>
    
    
	<div id="main">
		<div id="viewer" class="viewer" style="width:77%;height:100%">
		</div>
	</div>	
</body>
</html>
