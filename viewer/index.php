<?php
session_start();

include '../conf/mysql.php';
include '../conf/dir.php';

$FILENAME = 0;

if (!isset($_SESSION['opid'])) {

    if (isset($_GET['filetype']) && isset($_GET['filename'])) {
        $fileType = $_GET['filetype'];
        
$FILENAME = $_GET['filename'];

        $tiledir = $TILE_DIR_STATIC . $_GET['filename'] . "/";
        $fileName = $TILE_DIR_STATIC . $_GET['filename'] . "/" . $_GET['filename'];
        
    } else {
        print_r($_GET);
        die('Died');
    }
} else {
    $opid = $_SESSION['opid'];

    $query = "select op_filename from template,output where output.template_id=template.template_id and output_id='$opid'";

    $res = mysql_query($query);
    if (!$res) {
        die('Error Occured while getting output file' . mysql_error());
    }

    $row = mysql_fetch_row($res);
    if (!$row) {
        die('Error Occured while getting output file name' . $query);
    }
    /**
     * TODO: Read opdir from config
     * */
    $opdir = $OP_DIR;
    $_SESSION['file'] = $row[0];
    $fileName = "$opdir/$opid/" . $row[0];
    $tiledir = $TILE_DIR_DYNAMIC.$opid."/";
}
?>
<html>
    <head>


        <title>Apex - Viewer</title>


<?php
/////////////////////////////////////////////////////////////////////
require_once('./viewer_generic_page/generic_page/page_head.php');
/////////////////////////////////////////////////////////////////////
?>



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
                background-color:#668CFF;
                float:left;
                overflow:auto;
                border:5px;
                border-color:black;
                border-style:solid;

                margin:0; 
                display:inline;
                border-radius:20px;

            }

            .docviewerthumbnails
            {
                display:block;
                margin-right:25px;
                height: 300px;

            }


            #docviewer span
            {
                color:black !important;
                font-weight:bolder;
                font-family:sans-serif;
            }




            div#main 
            {
                font-family: sans-serif;
                margin: 0;

                color: #000000;
                background-color: #FFFFFF;
                font-size: 0.7em;
                border: 5px;
                border-color:black;
                border-style:solid;

                float:right;
                width:88%;
                border-radius:20px;

            }


            #docviewer a
            {
                text-decoration:none;
            }

            .caption
            {
                display:block;
                color:#FFF;
                margin-top:0px;
                border-width:0px;
                border-bottom-width:1px;
                border-style:solid;
                padding-top:5px;
                padding-bottom:5px;
            }

            .selectedcaption
            {
                display:block;
                color:#FFF;
                background-color:yellow;
                margin-top:0px;

                border-width:2px;
                border-style:solid;

                font-weight:bolder;
            }

.span_fname
{   border-color:black;
    border-size:1px;
    border-style:solid;
    padding:2px;
    padding-bottom:2px;
    border-bottom-style:none;
    border-radius:20px;
    color:green;
    font-size:1.0em;
    font-weight: bolder;              
}



        </style>




        <script type="text/javascript">
	
            var URL = "";
            var PREFIX = 'tile-';
            var WIDTH = 3250;
            var HEIGHT = 3750;
            var TILESIZE = 256;
            var EXTENSION = '.jpg';

            var PREVIOUS_DETECTOR=1;	
            var TOTAL_DETECTORS=0;	
            var GLO_MainFileDir = "";
            var GLO_TileFileDir = "";

            var GLO_ImgNumber=1;
	
            var flagForFirstTime = false;
            var switchToPage=true;
            
            xhr = false;
    
            if (window.XMLHttpRequest)
                xhr = new XMLHttpRequest();	//For every browser other than IE
            else if (window.ActiveXObject)
                xhr = new ActiveXObject("Microsoft.XMLHTTP");	//For IE 7+
      


            function downloadCurrentPage()
            {
                var dir = document.getElementById("tiledir").getAttribute('value');
               var pageNo = document.getElementById("hiddenDetectorNumber").getAttribute('value');
               var suffix="";
               
               if(pageNo<10)
                   suffix="000";
               else if(pageNo<100)
                   suffix="00";
               else if(pageNo<1000)
                   suffix="0";
               
               var currentPageToDownload = pageNo + "_" + suffix + pageNo + ".ps";
               var pageTitle=document.getElementsByClassName('selectedCaption')[0].innerHTML;

                window.location.href = "download.php?file="+dir + currentPageToDownload+"&pageTitle="+pageTitle;
             }
            
            
            function toHighlight(obj)
            {

                if(PREVIOUS_DETECTOR == obj.id)
                {
                    return true;
                }

                var currDetectorNumber = document.getElementById('hiddenDetectorNumber');
                currDetectorNumber.value = obj.id;

                var newchildren = obj.getElementsByTagName('span');
                newSpanObj = newchildren[0];
                $(newSpanObj).addClass('selectedcaption');

                prevObj=document.getElementById(PREVIOUS_DETECTOR);
                var children = prevObj.getElementsByTagName('span'); 

                spanObj = children[0];
	



                $(spanObj).removeClass('selectedcaption');

                $(spanObj).addClass('caption');
    
    
                PREVIOUS_DETECTOR = obj.id;

                return true;
            }

            function goLeft()
            {

                var currDetectorNumber = document.getElementById('hiddenDetectorNumber');


                if(currDetectorNumber.value < 2)
                {
                    return false;
                }
                currDetectorNumber.value -= 1;
                var tmp = currDetectorNumber.value;

                $('#'+tmp).click();
            }

            function goRight()
            {
                var currDetectorNumber = document.getElementById('hiddenDetectorNumber');

                if(currDetectorNumber.value >= TOTAL_DETECTORS)
                {
                    return false;
                }
                var tmp=parseInt(currDetectorNumber.value);
                tmp += 1;


                $('#'+tmp).click();
            }


      
            function ps2jpg()
            {
                //var filename =  document.getElementById("opFile").value;
                var psfile = "<?php echo $fileName; ?>";
                var tiledir= "<?php echo $tiledir; ?>";
                GLO_MainFileDir = psfile + '_Dir';    
        
                var params="file="+psfile;
                params+="&tiledir="+tiledir;
    
                xhr.open("POST","ps2jpg.php?"+params);
                xhr.onreadystatechange = function ()
                {
                    if (xhr.readyState == 4 && xhr.status == 200)
                    {
                        var pageNameList=new Array();
							         
                        pageNameList=eval('(' + xhr.responseText + ')');
            	
                        var tempDocViewer = document.getElementById("docviewer");

                        TOTAL_DETECTORS=pageNameList.length;
                        for(var i=0;i<pageNameList.length;i++)
                        {
                            var imageNumber = i + 1; 


                            var tempAnchor = document.createElement('a');
                            tempAnchor.setAttribute('id', imageNumber);
                            tempAnchor.setAttribute('href', 'javascript:void(0);');
                            tempAnchor.setAttribute('onclick', 'toHighlight(this);psToPng(this.id);');
                            tempDocViewer.appendChild(tempAnchor);
					
											
				

                            var tempCaption = document.createElement('span');

                            tempCaption.innerHTML = pageNameList[i];
                            tempCaption.setAttribute('class','caption');
                            tempAnchor.appendChild(tempCaption);

                        }
				
				
                        psToPng('1');

                        flagForFirstTime = true;

                        var tempspanparent = document.getElementById('1').getElementsByTagName('span');
                        var tempspan = tempspanparent[0];
                        $(tempspan).addClass('selectedcaption');


                    }
                    else if (xhr.readyState == 4 && xhr.status != 200) 
                    {
                        console.log("xhr status :" + xhr.status);
                        //TODO There should be error page
                    }
                }
        
                xhr.send(null);
            }


            function psToPng(imgNumber)
            {

                $(".ajax-loader").show();
	
                var psfile = "<?php echo $fileName; ?>";
                var tiledir= "<?php echo $tiledir; ?>";
        
                var params="file="+psfile;
                params+="&tiledir="+tiledir;
                params+="&pageNo="+imgNumber;
    
                xhr.open("POST","ps2png.php?"+params);
                xhr.onreadystatechange = function ()
                {
                    if (xhr.readyState == 4 && xhr.status == 200)
                    {
                        displayInViewer(imgNumber);
                        
                        switchToPage=true;
                    }
                    else if (xhr.readyState == 4 && xhr.status != 200) 
                    {
                        console.log("xhr status :" + xhr.status);//TODO There should be error page
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
                        console.log(xhr.status);//TODO There should be error page
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


</script>
        <div style="height:20px;">
<?php

echo "<span class='span_fname'>".$_GET['filename']."</span>";


////////////////////////////////////////////////////////////////////
require_once('./viewer_generic_page/generic_page/page_body.php');
////////////////////////////////////////////////////////////////////
?>
   
        </div>



        <input type="hidden" id="opFile" name="opFile" value="<?php echo $fileName ?>">	


<?php

echo '<script type="text/javascript">$(".ajax-loader").show();ps2jpg();</script>';
?>

        <input type="hidden" id='hiddenDetectorNumber' value="1"></input>
        <input type="hidden" id='tiledir' value='<?php echo $tiledir;?>'></input>
        
        <div id="docviewer" style="width: 10%; height: 100%;" align="center"></div>


        <div id="main">
            <img src="resource/ajax-loader.gif" style="position:absolute;left:50%;width:100px;height:100px;top:50%;z-index:100;" class="ajax-loader" />
            <div id="viewer" class="viewer" style="height:100%"></div>
        </div>	


    </body>
</html>
