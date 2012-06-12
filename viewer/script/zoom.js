var MAX_ZOOM = "";
var TILEDIR="";
var DIR = "";
var PREFIX = "";
var CUR_ZOOM = "";
var EXTENSION = "";
var tempSurface = "";
var tempWell = "";
var tileRow = "";
var tileCol	= "";		
var fileName = "";
var offWidth = "";
var offHeight = "";
var midWidth = "";
var midHeight = "";
var topTile = "";
var leftTile = "";
var iDiffX = 0;
var iDiffY = 0;
var previousValueX = "";
var previousValueY = "";
var previousTopOfFirst = "";
var previousLeftOfFirst = "";
var previousBottomOfLast = "";
var previousRightOfLast = "";
var PREV_ZOOM = "";
var firstFile = "";//to make function to compute no of tiles along width



function getMaxZoomLevel(width,height,tilesize)
{
    var zoomLevels = 0;
	
    var min = tilesize;
	
    while(width > min || height > min)
    {
        width = width/2;
        height = height/2;
		
        zoomLevels++;
    }

    return zoomLevels;
}


function init(tiledir,dir,prefix,width,height,tilesize,extension)
{
    MAX_ZOOM=getMaxZoomLevel(width,height,tilesize);
	
    if(!flagForFirstTime)
        CUR_ZOOM--; 
//    flagForFirstTime = false
    tempWell = null;
    
    tileRow = null;
    tileCol = null;
        
    var arrayLimit = Math.pow(2,0);//to do
    tileRow = arrayLimit;
    tileCol	= arrayLimit;
    
    
    fileName = null;
    topTile = null;
    leftTile = null;
    
    fileName = new Array(arrayLimit);
    fileName[0] = new Array(arrayLimit);
    topTile = new Array(arrayLimit);
    topTile[0] = new Array(arrayLimit);
    leftTile = new Array(arrayLimit);
    leftTile[0] = new Array(arrayLimit);
    
    TILEDIR=tiledir;
    DIR = dir;
    PREFIX = prefix;
    EXTENSION = extension;

    fileName[0][0] = DIR + "/" + PREFIX + "0-0-0" + EXTENSION;
    firstFile = fileName[0][0];

    
    var mainviewer = document.getElementById("main");
    
    var tempViewer=document.getElementById('viewer');
    mainviewer.removeChild(tempViewer);
    
    tempViewer = document.createElement('div');
    tempViewer.setAttribute('id', 'viewer');
    tempViewer.setAttribute('class', 'viewer');
    tempViewer.setAttribute('style', 'height:100%');
    mainviewer.appendChild(tempViewer);
    
    tempLoader = document.createElement('img');
   
    tempLoader.setAttribute('class', 'ajax-loader');
    tempLoader.setAttribute('style', 'position:absolute;left:150px;width:100px;height:100px;top:5px;z-index:100;');
    tempLoader.setAttribute('src', 'resource/ajax-loader.gif');

    tempSurface = document.createElement('div');
    tempSurface.setAttribute('id', 'surface');
    tempSurface.setAttribute('class', 'surface');
    tempSurface.setAttribute('style', 'width:100%;height:100%');
    tempSurface.setAttribute('onmousedown', 'mouseDownHandler(event)');
    tempSurface.setAttribute('ondblclick', 'mouseDoubleClickHandler(event)');
    tempSurface.setAttribute('onselectstart', 'return false');
    tempSurface.setAttribute('onmousewheel', 'mouseWheelHandler(event)');
    if(!('onmousewheel' in document.documentElement))
        EventUtil.addEventHandler(tempSurface,"DOMMouseScroll", mouseWheelHandler);
    tempSurface.setAttribute('onmouseout', 'mouseUpHandler()');
    tempViewer.appendChild(tempSurface);
        
    tempWell = document.createElement('div');
    tempWell.setAttribute('id', 'well');
    tempWell.setAttribute('class', 'well printable');
    tempWell.setAttribute('style', 'width:100%;height:100%');
    tempViewer.appendChild(tempWell);

    offWidth = document.getElementById('well').offsetWidth;
    offHeight = document.getElementById('well').offsetHeight;
    midWidth = offWidth/2;
    midHeight = offHeight/2;
    
    if(flagForFirstTime)
    {
        topTile[0][0] = midHeight - (Math.pow(2,CUR_ZOOM) * 128);
    leftTile[0][0] = midWidth - (Math.pow(2,CUR_ZOOM) * 128);

    previousTopOfFirst = topTile[0][0];
    previousLeftOfFirst = leftTile[0][0];
    
    previousBottomOfLast = (midHeight + (Math.pow(2,CUR_ZOOM) * 128)) + 256;
    previousRightOfLast = (midWidth + (Math.pow(2,CUR_ZOOM) * 128)) + 256;

    PREV_ZOOM = CUR_ZOOM;
    }

    initButtonControls();
	
    initPan();
    initCreatePanRectangleFrame();
    advanceZoomUp();
}

function defaultZoomUp()
{	
    if(CUR_ZOOM < MAX_ZOOM)
    {
        CUR_ZOOM++;
		
		
        tempWell = null;
        defaultPositions();
		
		
        loadImage();
    }    
}


function defaultZoomDown()
{	
    if(CUR_ZOOM > 0)
    {		
        CUR_ZOOM--;
	
	
        tempWell = null;
        defaultPositions();
		
		
        loadImage();
    }       
}

function defaultPositions()
{	
    var mainviewer = document.getElementById("main");
	
    var tempViewer=document.getElementById('viewer');
    mainviewer.removeChild(tempViewer);
			
    var tempViewer = document.createElement('div');
    tempViewer.setAttribute('id', 'viewer');
    tempViewer.setAttribute('class', 'viewer');
    tempViewer.setAttribute('style', 'height:100%');
    mainviewer.appendChild(tempViewer);
    
    tempSurface = document.createElement('div');
    tempSurface.setAttribute('id', 'surface');
    tempSurface.setAttribute('class', 'surface');
    tempSurface.setAttribute('style', 'width:100%;height:100%');
    tempSurface.setAttribute('onmousedown', 'mouseDownHandler(event)');
    tempSurface.setAttribute('ondblclick', 'mouseDoubleClickHandler(event)');
    tempSurface.setAttribute('onselectstart', 'return false');
    tempSurface.setAttribute('onmousewheel', 'mouseWheelHandler(event)');
    if(!('onmousewheel' in document.documentElement))
        EventUtil.addEventHandler(tempSurface,"DOMMouseScroll", mouseWheelHandler);
    tempSurface.setAttribute('onmouseout', 'mouseUpHandler()');
    tempViewer.appendChild(tempSurface);
   
   

    tempWell = document.createElement('div');
    tempWell.setAttribute('id', 'well');
    tempWell.setAttribute('class', 'well printable');
    tempWell.setAttribute('style', 'width:100%;height:100%');
    tempViewer.appendChild(tempWell);
    
    tileRow = null;
    tileCol = null;
		
    var arrayLimit = Math.pow(2,CUR_ZOOM);//to do
    tileRow = arrayLimit;
    tileCol	= arrayLimit;
				
		
    fileName = null;
    topTile = null;
    leftTile = null;
	
    fileName = new Array(arrayLimit);
    topTile = new Array(arrayLimit);
    leftTile = new Array(arrayLimit);
		
    for(var i=0; i<arrayLimit; i++)
    {
        fileName[i] = new Array(arrayLimit);
        topTile[i] = new Array(arrayLimit);
        leftTile[i] = new Array(arrayLimit);	
    }

    		
		
    var temp = Math.pow(2,CUR_ZOOM)/2;//if odd no of tiles along width, then add 1 to it
    var topMultiplier = temp;
    var leftMultiplier = temp;
		
		
    for(i=0; i<tileRow; i++)
    {
        for(var j=0; j<tileCol; j++)
        {
            fileName[i][j] = DIR + "/" + PREFIX + CUR_ZOOM + "-" + j + "-" + i + EXTENSION;
				
				
            if(i <= temp)
            {
                topTile[i][j] = midHeight - (topMultiplier * 256);
            }
				
            if(i > temp)
            {
                topTile[i][j] = midHeight + (topMultiplier * 256);
            }
				
            if(j <= temp)
            {
                leftTile[i][j] = midWidth - (leftMultiplier * 256);
					
                if(leftMultiplier == 0)
                    leftMultiplier++;
                else
                    leftMultiplier--;
            }
				
            if(j > temp)
            {
                leftTile[i][j] = midWidth + (leftMultiplier * 256);
					
                leftMultiplier++;
            }
        }
			
			
        leftMultiplier = temp;
		
        if(i <= temp)
            if(topMultiplier == 0)
                topMultiplier++;
            else
                topMultiplier--;
		
        if(i > temp)
            topMultiplier++;		
    }//if odd no of tiles along width, then add 128 to each left n top
	
	
    initButtonControls();
	
	
    initPan();
}
var xhr=false;

if(window.XMLHttpRequest) {
    xhr=new XMLHttpRequest();
}
else{
    xhr=new ActiveXObject("Microsoft.XMLHTTP");
}

var firstTileY;
var firstTileX;
var lastTileY;
var lastTileX;

function loadImage()
{
    firstTileY= Math.floor(Math.max((-topTile[0][0])/256,0));
    firstTileX=Math.floor(Math.max((-leftTile[0][0])/256,0));
    lastTileY=Math.floor(Math.max((-topTile[0][0]+offHeight+256)/256,0));
    lastTileX=Math.floor(Math.max((-leftTile[0][0]+offWidth)+256/256,0));


        
    var tileNo=0;
    for(var i=firstTileY; i<tileRow && i<lastTileY; i++)
    {
        for(var j=firstTileX; j<tileCol && j<lastTileX; j++)
        {                                
            var tempImg = document.createElement('img');
            var x=xhr.responseText;
            tempImg.setAttribute('id', tileNo);
            tempImg.setAttribute('class', 'tile');
            //tempImg.setAttribute('name', '');
            tempImg.setAttribute('style', 'height:256px; width:256px; top:'+topTile[i][j]+'px; left:'+leftTile[i][j]+'px;');
            tempImg.setAttribute('src',fileName[i][j]);
            tempWell.appendChild(tempImg);
        
            tileNo++;
        }
    }	
        		
    $(".ajax-loader").hide();

}


function advanceZoomUp()
{

    if(CUR_ZOOM < MAX_ZOOM)
    {
        $(".ajax-loader").show();    


        CUR_ZOOM++;
		
        tempWell = null;
        defaultPositions();
    
        var newTopOfFirst = topTile[0][0];
        var newLeftOfFirst = leftTile[0][0];
        
        var diffToAdjustTop = previousTopOfFirst - newTopOfFirst;
        var diffToAdjustLeft = previousLeftOfFirst - newLeftOfFirst;
        
        for(var i=0; i<tileRow; i++)
        {
            for(var j=0; j<tileCol; j++)
            {
                topTile[i][j] = topTile[i][j] + diffToAdjustTop;
                leftTile[i][j] = leftTile[i][j] + diffToAdjustLeft;
            }
        }
		
        if(flagForFirstTime==true || !switchToPage)
        {
         var temp = 256 * Math.pow(2,CUR_ZOOM);// to do
        var maxConstY = temp;
        var maxConstX = temp;
        var minConstY = temp / 4;
        var minConstX = temp / 4;
        
        
        var flagY = 0;
        var flagX = 0;
        
        
        if((previousTopOfFirst < midHeight) && (previousBottomOfLast > midHeight))
        {
            for(var i=0; i<tileRow; i++)
                for(var j=0; j<tileCol; j++)
                    topTile[i][j] = topTile[i][j] - minConstY;
                    
            flagY = 1;
        }
        
        if((previousTopOfFirst < midHeight) && (previousBottomOfLast < midHeight))
        {			
            for(var i=0; i<tileRow; i++)
                for(var j=0; j<tileCol; j++)
                    topTile[i][j] = topTile[i][j] - (maxConstY - minConstY);
                    
            flagY = 2;
        }
        
        if((previousTopOfFirst > midHeight) && (previousBottomOfLast > midHeight))
        {
            for(var i=0; i<tileRow; i++)
                for(var j=0; j<tileCol; j++)
                    topTile[i][j] = topTile[i][j] + minConstY;
                    
            flagY = 3;
        }
        
        if(previousBottomOfLast == midHeight)
        {
            for(var i=0; i<tileRow; i++)
                for(var j=0; j<tileCol; j++)
                    topTile[i][j] = topTile[i][j] - (maxConstY - minConstY);
                    
            flagY = 4;
        }
        
        if((previousLeftOfFirst < midWidth) && (previousRightOfLast > midWidth))
        {
            for(var i=0; i<tileRow; i++)
                for(var j=0; j<tileCol; j++)
                    leftTile[i][j] = leftTile[i][j] - minConstX;
                    
            flagX = 1;
        }
        
        if((previousLeftOfFirst < midWidth) && (previousRightOfLast < midWidth))
        {
            for(var i=0; i<tileRow; i++)
                for(var j=0; j<tileCol; j++)
                    leftTile[i][j] = leftTile[i][j] - (maxConstX - minConstX);
                    
            flagX = 2;
        }
        
        if((previousLeftOfFirst > midWidth) && (previousRightOfLast > midWidth))
        {
            for(var i=0; i<tileRow; i++)
                for(var j=0; j<tileCol; j++)
                    leftTile[i][j] = leftTile[i][j] + minConstX;
                    
            flagX = 3;
        }
        
        if(previousRightOfLast == midWidth)
        {
            for(var i=0; i<tileRow; i++)
                for(var j=0; j<tileCol; j++)
                    leftTile[i][j] = leftTile[i][j] - (maxConstX - minConstX);
                    
            flagX = 4;
        }
        flagForFirstTime=false;
        
        }
        
        switchToPage=false;
        
        var params="file="+TILEDIR+GLO_ImgNumber+".png";
        params+="&zoom="+CUR_ZOOM;
        params+="&left=0";
        params+="&top=0";
        params+="&bottom="+Math.pow(2,CUR_ZOOM)*256;
        params+="&right="+Math.pow(2,CUR_ZOOM)*256;
        params+="&height=256";
        params+="&width=256";
        params+="&output="+DIR+PREFIX;
        
        xhr.open("POST","tileGenerator.php");
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //xhr.setRequestHeader("Content-length", params.length);

        xhr.onreadystatechange = function ()
        {
            if (xhr.readyState == 4 && xhr.status == 200)
            { 
                loadImage();
                        
                previousTopOfFirst = topTile[0][0];
                previousLeftOfFirst = leftTile[0][0];
                
                var lastIndexY = (Math.pow(2,CUR_ZOOM)) - 1;//to do
                var lastIndexX = (Math.pow(2,CUR_ZOOM)) - 1;
                
                previousBottomOfLast = topTile[lastIndexY][lastIndexX] + 256;
                previousRightOfLast = leftTile[lastIndexY][lastIndexX] + 256;
                
                PREV_ZOOM = CUR_ZOOM;

	
                viewerToPanOnZoom(); 
	 
                $(".ajax-loader").hide();

            }
            else if (xhr.readyState == 4 && xhr.status != 200) 
            {
                console.log(xhr.status);//TODO There should be error page
            }
        }
        xhr.send(params);
    }
    firstPage=false;

}


function advanceZoomDown()
{


    if(CUR_ZOOM > 0)
    {		
        CUR_ZOOM--;	

        
        
        $(".ajax-loader").show();
		
		
        tempWell = null;
        defaultPositions();
		
		
        var newTopOfFirst = topTile[0][0];
        var newLeftOfFirst = leftTile[0][0];
		
        var diffToAdjustTop = previousTopOfFirst - newTopOfFirst;
        var diffToAdjustLeft = previousLeftOfFirst - newLeftOfFirst;
		
        for(var i=0; i<tileRow; i++)
        {
            for(var j=0; j<tileCol; j++)
            {
                topTile[i][j] = topTile[i][j] + diffToAdjustTop;
                leftTile[i][j] = leftTile[i][j] + diffToAdjustLeft;
            }
        }
		
		
        var temp = 256 * Math.pow(2,PREV_ZOOM);
        var maxConstY = temp;
        var maxConstX = temp;
        var minConstY = temp / 4;
        var minConstX = temp / 4;
		
		
        var flagY = 0;
        var flagX = 0;
		
		
        if((previousTopOfFirst < midHeight) && (previousBottomOfLast > midHeight))
        {
            for(var i=0; i<tileRow; i++)
                for(var j=0; j<tileCol; j++)
                    topTile[i][j] = topTile[i][j] + minConstY;
					
            flagY = 1;
        }
		
        if((previousTopOfFirst < midHeight) && (previousBottomOfLast < midHeight))
        {
            for(var i=0; i<tileRow; i++)
                for(var j=0; j<tileCol; j++)
                    topTile[i][j] = topTile[i][j] + (maxConstY - minConstY);
					
            flagY = 2;
        }
		
        if((previousTopOfFirst > midHeight) && (previousBottomOfLast > midHeight))
        {
            for(var i=0; i<tileRow; i++)
                for(var j=0; j<tileCol; j++)
                    topTile[i][j] = topTile[i][j] - minConstY;
					
            flagY = 3;
        }
		
        if(previousBottomOfLast == midHeight)
        {
            for(var i=0; i<tileRow; i++)
                for(var j=0; j<tileCol; j++)
                    topTile[i][j] = topTile[i][j] + (maxConstY - minConstY);
					
            flagY = 4;
        }
		
		
        if((previousLeftOfFirst < midWidth) && (previousRightOfLast > midWidth))
        {
            for(var i=0; i<tileRow; i++)
                for(var j=0; j<tileCol; j++)
                    leftTile[i][j] = leftTile[i][j] + minConstX;
					
            flagX = 1;
        }
		
        if((previousLeftOfFirst < midWidth) && (previousRightOfLast < midWidth))
        {
            for(var i=0; i<tileRow; i++)
                for(var j=0; j<tileCol; j++)
                    leftTile[i][j] = leftTile[i][j] + (maxConstX - minConstX);
					
            flagX = 2;
        }
		
        if((previousLeftOfFirst > midWidth) && (previousRightOfLast > midWidth))
        {
            for(var i=0; i<tileRow; i++)
                for(var j=0; j<tileCol; j++)
                    leftTile[i][j] = leftTile[i][j] - minConstX;
					
            flagX = 3;
        }
		
        if(previousRightOfLast == midWidth)
        {
            for(var i=0; i<tileRow; i++)
                for(var j=0; j<tileCol; j++)
                    leftTile[i][j] = leftTile[i][j] + (maxConstX - minConstX);
					
            flagX = 4;
        }
		
		/*
        loadImage();
				
		
        previousTopOfFirst = topTile[0][0];
        previousLeftOfFirst = leftTile[0][0];
		
        var lastIndexY = (Math.pow(2,CUR_ZOOM)) - 1;//to do
        var lastIndexX = (Math.pow(2,CUR_ZOOM)) - 1;
		
        previousBottomOfLast = topTile[lastIndexY][lastIndexX] + 256;
        previousRightOfLast = leftTile[lastIndexY][lastIndexX] + 256;
		
        PREV_ZOOM = CUR_ZOOM;
		
		
        viewerToPanOnZoom(); 
	
	
        $(".ajax-loader").hide();*/
	
var params="file="+TILEDIR+GLO_ImgNumber+".png";
        params+="&zoom="+CUR_ZOOM;
        params+="&left=0";
        params+="&top=0";
        params+="&bottom="+Math.pow(2,CUR_ZOOM)*256;
        params+="&right="+Math.pow(2,CUR_ZOOM)*256;
        params+="&height=256";
        params+="&width=256";
        params+="&output="+DIR+PREFIX;
        
        xhr.open("POST","tileGenerator.php");
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //xhr.setRequestHeader("Content-length", params.length);

        xhr.onreadystatechange = function ()
        {
            if (xhr.readyState == 4 && xhr.status == 200)
            { 
                 loadImage();
				
		
        previousTopOfFirst = topTile[0][0];
        previousLeftOfFirst = leftTile[0][0];
		
        var lastIndexY = (Math.pow(2,CUR_ZOOM)) - 1;//to do
        var lastIndexX = (Math.pow(2,CUR_ZOOM)) - 1;
		
        previousBottomOfLast = topTile[lastIndexY][lastIndexX] + 256;
        previousRightOfLast = leftTile[lastIndexY][lastIndexX] + 256;
		
        PREV_ZOOM = CUR_ZOOM;
		
		
        viewerToPanOnZoom(); 
	
	
        $(".ajax-loader").hide();
	
            }
            else if (xhr.readyState == 4 && xhr.status != 200) 
            {
                console.log(xhr.status);//TODO There should be error page
            }
        }
        xhr.send(params);
    } 	
}


function mouseDownHandler(oEvent)
{
    oEvent = EventUtil.getEvent();

    var oDiv = document.getElementById("viewer");


    preventDefaultAction(oEvent);
	
	
    iDiffX = oEvent.clientX - oDiv.offsetLeft;
    iDiffY = oEvent.clientY - oDiv.offsetTop;


    previousValueX = oDiv.offsetLeft;
    previousValueY = oDiv.offsetTop;
	
	
    EventUtil.addEventHandler(document.body, "mousemove", mouseMoveHandler);
    EventUtil.addEventHandler(document.body, "mouseup", mouseUpHandler);
}


function mouseMoveHandler(oEvent)
{
    oEvent = EventUtil.getEvent();

	
    var oDiv1 = document.getElementById("viewer");
    var oDiv2 = document.getElementById("main");

    if((oEvent.clientX < oDiv1.offsetLeft) || (oEvent.clientX > oDiv2.offsetWidth) || (oEvent.clientY < oDiv1.offsetTop) || (oEvent.clientY > oDiv2.offsetHeight))
    {
        mouseUpHandler();
    }
	
	
    var intermediateValueX = oEvent.clientX - iDiffX;
    var intermediateValueY = oEvent.clientY - iDiffY;
	
    var offsetToAddX = intermediateValueX - previousValueX;
    var offsetToAddY = intermediateValueY - previousValueY;
	
	
    for(var i=0; i<tileRow; i++)
    {
        for(var j=0; j<tileCol; j++)
        {
            topTile[i][j] = topTile[i][j] + offsetToAddY;
            leftTile[i][j] = leftTile[i][j] + offsetToAddX;
        }
    }
	
	
    viewerToPanOnMove();
	
	
    var tempViewer = document.getElementById('viewer');
	
    tempViewer.removeChild(tempWell);
	
	
    tempWell = document.createElement('div');
    tempWell.setAttribute('id', 'well');
    tempWell.setAttribute('class', 'well printable');
    tempWell.setAttribute('style', 'width:100%;height:100%');
    tempViewer.appendChild(tempWell);
	
	
    loadImage();
	
	
    previousValueX = intermediateValueX;
    previousValueY = intermediateValueY;
}


function mouseUpHandler()
{
    EventUtil.removeEventHandler(document.body, "mousemove", mouseMoveHandler);
    EventUtil.removeEventHandler(document.body, "mouseup", mouseUpHandler);
	
	
    previousTopOfFirst = topTile[0][0];
    previousLeftOfFirst = leftTile[0][0];
		
    var lastIndexY = (Math.pow(2,CUR_ZOOM)) - 1;//to do
    var lastIndexX = (Math.pow(2,CUR_ZOOM)) - 1;
		
    previousBottomOfLast = topTile[lastIndexY][lastIndexX] + 256;
    previousRightOfLast = leftTile[lastIndexY][lastIndexX] + 256;
		
    PREV_ZOOM = CUR_ZOOM;
}


function mouseDoubleClickHandler(oEvent)
{
    if(CUR_ZOOM < MAX_ZOOM)
    {
        oEvent = EventUtil.getEvent();

        var oDiv = document.getElementById("viewer");


        preventDefaultAction(oEvent);

	
        iDiffX = oEvent.clientX - oDiv.offsetLeft;
        iDiffY = oEvent.clientY - oDiv.offsetTop;
	
        var diffLeft = midWidth - iDiffX;
        var diffTop = midHeight - iDiffY;
	
	
        for(var i=0; i<tileRow; i++)
        {
            for(var j=0; j<tileCol; j++)
            {
                topTile[i][j] = topTile[i][j] + diffTop;
                leftTile[i][j] = leftTile[i][j] + diffLeft;
            }
        }
	
	
        panOnDoubleClick(diffTop,diffLeft);
		
		
        previousTopOfFirst = topTile[0][0];
        previousLeftOfFirst = leftTile[0][0];
		
        var lastIndexY = (Math.pow(2,CUR_ZOOM)) - 1;//to do
        var lastIndexX = (Math.pow(2,CUR_ZOOM)) - 1;
		
        previousBottomOfLast = topTile[lastIndexY][lastIndexX] + 256;
        previousRightOfLast = leftTile[lastIndexY][lastIndexX] + 256;
		
        PREV_ZOOM = CUR_ZOOM;
	
	
        advanceZoomUp();
    }
}


function mouseWheelHandler(oEvent)
{
    oEvent = EventUtil.getEvent();
	

    var afterNormalization = oEvent.detail ? oEvent.detail * -1 : oEvent.wheelDelta / 40;
	
	
    if(afterNormalization >= 0)
        advanceZoomUp();
    else if(afterNormalization < 0)
        advanceZoomDown();
	
		
    //EventUtil.addEventHandler(document.body, "mousewheel", mouseWheelHandler);


    preventDefaultAction(oEvent);
}
