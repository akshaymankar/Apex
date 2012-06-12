var panSize = 256 / 2;
var hgthRF = 0;
var wdthRF = 0;
var diffY = 0;
var diffX = 0;
var topRectangleFrame = 0;
var leftRectangleFrame = 0;
var panPreviousValueY = 0;
var panPreviousValueX = 0;
var previousTopRectangleFrame = 0;
var previousLeftRectangleFrame = 0;
var midPanHeight = 0;
var midPanWidth = 0;
	

//Initializes Pan on 'surface'.
function initPan()
{	
    var tempViewer = document.getElementById('viewer');
	
	
    var tempPanViewer = document.createElement('div');
    tempPanViewer.setAttribute('id', 'panviewer');
    tempPanViewer.setAttribute('class', 'panviewer');
    tempPanViewer.setAttribute('style', 'width:'+panSize+'px; height:'+panSize+'px;');
    tempViewer.appendChild(tempPanViewer);
    
    var tempPanSurface = document.createElement('div');
    tempPanSurface.setAttribute('id', 'pansurface');
    tempPanSurface.setAttribute('class', 'pansurface');
    tempPanSurface.setAttribute('style', 'width:'+panSize+'px; height:'+panSize+'px;');
    tempPanSurface.setAttribute('onmousedown', 'panMouseDownHandler(event)');
    tempPanSurface.setAttribute('onmouseout', 'panMouseUpHandler()');
    tempPanViewer.appendChild(tempPanSurface);
        
    var tempPanWell = document.createElement('div');
    tempPanWell.setAttribute('id', 'panwell');
    tempPanWell.setAttribute('class', 'panwell');
    tempPanWell.setAttribute('style', 'width:'+panSize+'px; height:'+panSize+'px;');
    tempPanViewer.appendChild(tempPanWell);

    var tempPanImg = document.createElement('img');
    tempPanImg.setAttribute('id', 'panimg');
    tempPanImg.setAttribute('class', 'panimg');
    tempPanImg.setAttribute('style', 'width:'+panSize+'px; height:'+panSize+'px;');
    tempPanImg.setAttribute('src',firstFile);
    tempPanWell.appendChild(tempPanImg);	

	
    try
    {
        var borderWdth1 = parseInt(getComputedStyle(tempPanViewer,null).getPropertyValue('border-top-width'));
    } 
    catch(e)
    {
        var borderWdth1 = parseInt(tempPanViewer.currentStyle.borderWidth);
    }
	
    midPanHeight = (tempPanViewer.offsetHeight - (2 * borderWdth1)) / 2;
    midPanWidth = (tempPanViewer.offsetWidth - (2 * borderWdth1)) / 2;	
}


function initCreatePanRectangleFrame()
{
    var tempPanViewer = document.getElementById('panviewer');
	
	
    var hgthRF = panSize;
    var wdthRF = panSize;


    var tempPanRectangleFrame = document.createElement('div');
    tempPanRectangleFrame.setAttribute('id', 'panrectangleframe');
    tempPanRectangleFrame.setAttribute('class', 'panrectangleframe');
    tempPanRectangleFrame.setAttribute('style', 'width:'+(wdthRF - 4)+'px; height:'+(hgthRF - 4)+'px;');
    tempPanViewer.appendChild(tempPanRectangleFrame);		
}


//panMouseDownHandler(oEvent), panMouseMoveHandler(oEvent), panMouseUpHandler() functions
//are combinely used in moving image inside Viewer on moving RectangleFrame inside Pan.


//This function gets called on 'mousedown' event on Pan.
function panMouseDownHandler(oEvent)
{
    oEvent = EventUtil.getEvent();
	
	
    preventDefaultAction(oEvent);


    var tempPanRectangleFrame = document.getElementById("panrectangleframe");
    var tempPanViewer = document.getElementById('panviewer');
    var tempViewer = document.getElementById('viewer');
	
	
    try
    {
        var borderWdth1 = parseInt(getComputedStyle(tempPanViewer,null).getPropertyValue('border-top-width'));
    } 
    catch(e)
    {
        var borderWdth1 = parseInt(tempPanViewer.currentStyle.borderWidth);
    }
	
    diffY = tempPanViewer.offsetTop + tempViewer.offsetTop + borderWdth1;
    diffX = tempPanViewer.offsetLeft + tempViewer.offsetLeft + borderWdth1;
	
	
    topRectangleFrame = oEvent.clientY - diffY - (hgthRF / 2);
    leftRectangleFrame = oEvent.clientX - diffX - (wdthRF / 2);

	
    tempPanViewer.removeChild(tempPanRectangleFrame);
	
    tempPanRectangleFrame = document.createElement('div');
    tempPanRectangleFrame.setAttribute('id', 'panrectangleframe');
    tempPanRectangleFrame.setAttribute('class', 'panrectangleframe');
    tempPanRectangleFrame.setAttribute('style', 'width:'+wdthRF+'px; height:'+hgthRF+'px; top:'+topRectangleFrame+'px; left:'+leftRectangleFrame+'px;');
    tempPanViewer.appendChild(tempPanRectangleFrame);
	
	
    var panDiffY = oEvent.clientY - diffY;
    var panDiffX = oEvent.clientX - diffX;
		
    var currentViewerImgHeight = 256 * Math.pow(2,CUR_ZOOM); 
    var currentViewerImgWidth = 256 * Math.pow(2,CUR_ZOOM); 
    var currentPanImgHeight = panSize; 
    var currentPanImgWidth = panSize; 
	
    var viewerDiffY = (panDiffY * currentViewerImgHeight) / currentPanImgHeight;
    var viewerDiffX = (panDiffX * currentViewerImgWidth) / currentPanImgWidth;
	
    var tempTop = midHeight - viewerDiffY; 
    var tempLeft = midWidth - viewerDiffX; 
	
    var offsetToAddY = tempTop - previousTopOfFirst;
    var offsetToAddX = tempLeft - previousLeftOfFirst;
	
	
    for(var i=0; i<tileRow; i++)
    {
        for(var j=0; j<tileCol; j++)
        {
            topTile[i][j] = topTile[i][j] + offsetToAddY;
            leftTile[i][j] = leftTile[i][j] + offsetToAddX;
        }
    }
	
	
    tempViewer.removeChild(tempWell);
		
    tempWell = document.createElement('div');
    tempWell.setAttribute('id', 'well');
    tempWell.setAttribute('class', 'well');
    tempWell.setAttribute('style', 'width:100%;height:100%');
    tempViewer.appendChild(tempWell);
	
	
    loadImage();
	
	
    panPreviousValueY = topRectangleFrame;
    panPreviousValueX = leftRectangleFrame;
	
	
    EventUtil.addEventHandler(document.body, "mousemove", panMouseMoveHandler);
    EventUtil.addEventHandler(document.body, "mouseup", panMouseUpHandler);
}


//This function gets called on 'mousemove' event on Pan.
function panMouseMoveHandler(oEvent)
{
    oEvent = EventUtil.getEvent();

	
    var tempPanRectangleFrame = document.getElementById("panrectangleframe");
    var tempPanViewer = document.getElementById('panviewer');
    var tempViewer = document.getElementById('viewer');


    var intermediateValueY = oEvent.clientY - diffY - (hgthRF / 2);
    var intermediateValueX = oEvent.clientX - diffX - (wdthRF / 2);
	
    var panOffsetToAddY = intermediateValueY - panPreviousValueY;
    var panOffsetToAddX = intermediateValueX - panPreviousValueX;
	
    topRectangleFrame = topRectangleFrame + panOffsetToAddY;
    leftRectangleFrame = leftRectangleFrame + panOffsetToAddX;

	
    tempPanViewer.removeChild(tempPanRectangleFrame);
	
    tempPanRectangleFrame = document.createElement('div');
    tempPanRectangleFrame.setAttribute('id', 'panrectangleframe');
    tempPanRectangleFrame.setAttribute('class', 'panrectangleframe');
    tempPanRectangleFrame.setAttribute('style', 'width:'+wdthRF+'px; height:'+hgthRF+'px; top:'+topRectangleFrame+'px; left:'+leftRectangleFrame+'px;');
    tempPanViewer.appendChild(tempPanRectangleFrame);
	
	
    var currentViewerImgHeight = 256 * Math.pow(2,CUR_ZOOM); 
    var currentViewerImgWidth = 256 * Math.pow(2,CUR_ZOOM); 
    var currentPanImgHeight = panSize; 
    var currentPanImgWidth = panSize; 
	
    var viewerOffsetToAddY = (panOffsetToAddY * currentViewerImgHeight) / currentPanImgHeight;
    var viewerOffsetToAddX = (panOffsetToAddX * currentViewerImgWidth) / currentPanImgWidth;
	
		
    for(var i=0; i<tileRow; i++)
    {
        for(var j=0; j<tileCol; j++)
        {
            topTile[i][j] = topTile[i][j] - viewerOffsetToAddY;
            leftTile[i][j] = leftTile[i][j] - viewerOffsetToAddX;
        }
    }
	
	
    tempViewer.removeChild(tempWell);
	
    tempWell = document.createElement('div');
    tempWell.setAttribute('id', 'well');
    tempWell.setAttribute('class', 'well');
    tempWell.setAttribute('style', 'width:100%;height:100%');
    tempViewer.appendChild(tempWell);
	
	
    loadImage();
	
	
    panPreviousValueY = intermediateValueY;
    panPreviousValueX = intermediateValueX;
}


//This function gets called on 'mouseup' event on Pan.
function panMouseUpHandler()
{
    EventUtil.removeEventHandler(document.body, "mousemove", panMouseMoveHandler);
    EventUtil.removeEventHandler(document.body, "mouseup", panMouseUpHandler);
	
	
    previousTopOfFirst = topTile[0][0];
    previousLeftOfFirst = leftTile[0][0];
		
    var lastIndexY = (Math.pow(2,CUR_ZOOM)) - 1;
    var lastIndexX = (Math.pow(2,CUR_ZOOM)) - 1;
		
    previousBottomOfLast = topTile[lastIndexY][lastIndexX] + 256;
    previousRightOfLast = leftTile[lastIndexY][lastIndexX] + 256;
		
    PREV_ZOOM = CUR_ZOOM;
	
	
    previousTopRectangleFrame = topRectangleFrame;
    previousLeftRectangleFrame = leftRectangleFrame;
}


//Dragging image inside Viewer gets reflected into Pan.
function viewerToPanOnMove()
{
    viewerToPan();
	
	
    var tempPanRectangleFrame = document.getElementById("panrectangleframe");
    var tempPanViewer = document.getElementById('panviewer');

    tempPanViewer.removeChild(tempPanRectangleFrame);	
	
    tempPanRectangleFrame = document.createElement('div');
    tempPanRectangleFrame.setAttribute('id', 'panrectangleframe');
    tempPanRectangleFrame.setAttribute('class', 'panrectangleframe');
    tempPanRectangleFrame.setAttribute('style', 'width:'+wdthRF+'px; height:'+hgthRF+'px; top:'+topRectangleFrame+'px; left:'+leftRectangleFrame+'px;');
    tempPanViewer.appendChild(tempPanRectangleFrame); 
	

    previousTopRectangleFrame = topRectangleFrame;
    previousLeftRectangleFrame = leftRectangleFrame;
}


//Zooming image up or down inside Viewer gets reflected into Pan.
function viewerToPanOnZoom()
{
    viewerToPan();
	
	
    var tempPanViewer = document.getElementById('panviewer');

    var tempPanRectangleFrame = document.createElement('div');
    tempPanRectangleFrame.setAttribute('id', 'panrectangleframe');
    tempPanRectangleFrame.setAttribute('class', 'panrectangleframe');
    tempPanRectangleFrame.setAttribute('style', 'width:'+wdthRF+'px; height:'+hgthRF+'px; top:'+topRectangleFrame+'px; left:'+leftRectangleFrame+'px;');
    tempPanViewer.appendChild(tempPanRectangleFrame); 
	

    previousTopRectangleFrame = topRectangleFrame;
    previousLeftRectangleFrame = leftRectangleFrame;
}


function viewerToPan()
{
    var currentViewerImgHeight = 256 * Math.pow(2,CUR_ZOOM); 
    var currentViewerImgWidth = 256 * Math.pow(2,CUR_ZOOM); 
    var currentPanImgHeight = panSize; 
    var currentPanImgWidth = panSize; 
	
    var right = leftTile[0][0] + currentViewerImgWidth;
    var bottom = topTile[0][0] + currentViewerImgHeight;
    
    var ratioWidth =  currentViewerImgWidth / offWidth;
    var ratioHeight = currentViewerImgHeight / offHeight;
 
 
    if(ratioWidth > 1) 
    {
        var resizedRatioWidth = 1 / ratioWidth;
        wdthRF = panSize * resizedRatioWidth;
    }
    else
    {
        wdthRF = panSize;
    }
	
    if(ratioHeight > 1) 
    {
        var resizedRatioHeight = 1 / ratioHeight;
        hgthRF = panSize * resizedRatioHeight;
    }
    else
    {
        hgthRF = panSize;
    }
	
	
    if(((ratioWidth<=1) || (ratioHeight<=1)) && (leftTile[0][0]>=0 && right<=offWidth))
    {
        leftRectangleFrame = 0;
    }
	
    if(((ratioWidth<=1) || (ratioHeight<=1)) && (topTile[0][0]>=0 && bottom<=offHeight))
    {
        topRectangleFrame = 0;
    }
	
    if(((ratioWidth<=1) || (ratioHeight<=1)) && (right>offWidth))
    {
        var diffRight = offWidth - leftTile[0][0];
	
        var diffXOnPan = (diffRight * currentPanImgWidth) / currentViewerImgWidth;
		
        leftRectangleFrame = diffXOnPan - panSize;
    }
	
    if(((ratioWidth<=1) || (ratioHeight<=1)) && (bottom>offHeight))
    {
        var diffBottom = offHeight - topTile[0][0];
	
        var diffYOnPan = (diffBottom * currentPanImgHeight) / currentViewerImgHeight;
		
        topRectangleFrame = diffYOnPan - panSize;
    }
	
    if(((ratioWidth<=1) || (ratioHeight<=1)) && (leftTile[0][0]<0))
    {
        var diffLeft = - leftTile[0][0];
	
        var diffXOnPan = (diffLeft * currentPanImgWidth) / currentViewerImgWidth;
		
        leftRectangleFrame = diffXOnPan;
	
    }
	
    if(((ratioWidth<=1) || (ratioHeight<=1)) && (topTile[0][0]<0))
    {
        var diffTop = - topTile[0][0];
	
        var diffYOnPan = (diffTop * currentPanImgHeight) / currentViewerImgHeight;
		
        topRectangleFrame = diffYOnPan;	
    }
	
    if((ratioWidth>1) || (ratioHeight>1)) 
    {		
        var diffTop = - topTile[0][0];
        var diffLeft = - leftTile[0][0];
	
        var diffYOnPan = (diffTop * currentPanImgHeight) / currentViewerImgHeight;
        var diffXOnPan = (diffLeft * currentPanImgWidth) / currentViewerImgWidth;
		
        topRectangleFrame = diffYOnPan;
        leftRectangleFrame = diffXOnPan;
    }
}


//Zooming image up or down inside Viewer on mouse's double click gets reflected into Pan.
function panOnDoubleClick(diffTop,diffLeft)
{
    var currentViewerImgHeight = 256 * Math.pow(2,CUR_ZOOM); 
    var currentViewerImgWidth = 256 * Math.pow(2,CUR_ZOOM); 
    var currentPanImgHeight = panSize; 
    var currentPanImgWidth = panSize; 
	
    var diffVTPY2 = (diffTop * currentPanImgHeight) / currentViewerImgHeight;
    var diffVTPX2 = (diffLeft * currentPanImgWidth) / currentViewerImgWidth;
	
    topRectangleFrame = topRectangleFrame - diffVTPY2;
    leftRectangleFrame = leftRectangleFrame - diffVTPX2;

	
    previousTopRectangleFrame = topRectangleFrame;
    previousLeftRectangleFrame = leftRectangleFrame;
}
