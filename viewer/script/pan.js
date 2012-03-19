var panSize = 256 / 2;//to do
var hgthRF = panSize;
var wdthRF = panSize;
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
	//tempImg.setAttribute('name', '');
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
	
	
	var tempPanRectangleFrame = document.createElement('div');
	tempPanRectangleFrame.setAttribute('id', 'panrectangleframe');
	tempPanRectangleFrame.setAttribute('class', 'panrectangleframe');
    tempPanRectangleFrame.setAttribute('style', 'width:'+(wdthRF - 4)+'px; height:'+(hgthRF - 4)+'px;');
    tempPanViewer.appendChild(tempPanRectangleFrame);		
}


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
	
	diffY = tempPanViewer.offsetTop + tempViewer.offsetTop + borderWdth1;//bug in 99,100 - rarest one
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
		
	var currentViewerImgHeight = 256 * Math.pow(2,CUR_ZOOM); //to do
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
	
	
	var currentViewerImgHeight = 256 * Math.pow(2,CUR_ZOOM); //to do
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


function panMouseUpHandler()
{
	EventUtil.removeEventHandler(document.body, "mousemove", panMouseMoveHandler);
	EventUtil.removeEventHandler(document.body, "mouseup", panMouseUpHandler);
	
	
	previousTopOfFirst = topTile[0][0];
	previousLeftOfFirst = leftTile[0][0];
		
	var lastIndexY = (Math.pow(2,CUR_ZOOM)) - 1;//to do
	var lastIndexX = (Math.pow(2,CUR_ZOOM)) - 1;
		
	previousBottomOfLast = topTile[lastIndexY][lastIndexX] + 256;
	previousRightOfLast = leftTile[lastIndexY][lastIndexX] + 256;
		
	PREV_ZOOM = CUR_ZOOM;
	
	
	previousTopRectangleFrame = topRectangleFrame;
	previousLeftRectangleFrame = leftRectangleFrame;
}


function viewerToPanOnMouseMove(offsetToAddY,offsetToAddX)
{
	var tempPanRectangleFrame = document.getElementById("panrectangleframe");
	var tempPanViewer = document.getElementById('panviewer');
	

	var currentViewerImgHeight = 256 * Math.pow(2,CUR_ZOOM); //to do
	var currentViewerImgWidth = 256 * Math.pow(2,CUR_ZOOM); 
	var currentPanImgHeight = panSize; 
	var currentPanImgWidth = panSize; 
	
	var diffVTPY2 = (offsetToAddY * currentPanImgHeight) / currentViewerImgHeight;
	var diffVTPX2 = (offsetToAddX * currentPanImgWidth) / currentViewerImgWidth;
	
	topRectangleFrame = topRectangleFrame - diffVTPY2;
	leftRectangleFrame = leftRectangleFrame - diffVTPX2;
	
	
	tempPanViewer.removeChild(tempPanRectangleFrame);
	
	tempPanRectangleFrame = document.createElement('div');
	tempPanRectangleFrame.setAttribute('id', 'panrectangleframe');
	tempPanRectangleFrame.setAttribute('class', 'panrectangleframe');
	tempPanRectangleFrame.setAttribute('style', 'width:'+wdthRF+'px; height:'+hgthRF+'px; top:'+topRectangleFrame+'px; left:'+leftRectangleFrame+'px;');
	tempPanViewer.appendChild(tempPanRectangleFrame); 
	
	
	previousTopRectangleFrame = topRectangleFrame;
	previousLeftRectangleFrame = leftRectangleFrame;
}


function panOnZoomUp(flagY,flagX)
{
	var tempPanViewer = document.getElementById('panviewer');

	
    hgthRF = hgthRF / 2;
	wdthRF = wdthRF / 2;
	
	topRectangleFrame = midPanHeight - (hgthRF / 2);
	leftRectangleFrame = midPanWidth - (wdthRF / 2);
		
	
	var tempDiffY = topRectangleFrame - previousTopRectangleFrame;
	var tempDiffX = leftRectangleFrame - previousLeftRectangleFrame;
	
	topRectangleFrame = topRectangleFrame - tempDiffY;
	leftRectangleFrame = leftRectangleFrame - tempDiffX;

	
	var maxConstY = hgthRF + (hgthRF / 2);
	var maxConstX = wdthRF + (wdthRF / 2);
	var minConstY = hgthRF / 2;
	var minConstX = wdthRF / 2;

	
	if(flagY == 1)
		topRectangleFrame = topRectangleFrame + minConstY;
	
	if(flagY == 2)
		topRectangleFrame = topRectangleFrame + maxConstY;
		
	if(flagY == 3)
		topRectangleFrame = topRectangleFrame - minConstY;
		
	if(flagY == 4)
		topRectangleFrame = topRectangleFrame + maxConstY;
	
	
	if(flagX == 1)
		leftRectangleFrame = leftRectangleFrame + minConstX;
	
	if(flagX == 2)
		leftRectangleFrame = leftRectangleFrame + maxConstX;
		
	if(flagX == 3)
		leftRectangleFrame = leftRectangleFrame - minConstX;
		
	if(flagX == 4)
		leftRectangleFrame = leftRectangleFrame + maxConstX;
	
	
	var tempPanRectangleFrame = document.createElement('div');
	tempPanRectangleFrame.setAttribute('id', 'panrectangleframe');
	tempPanRectangleFrame.setAttribute('class', 'panrectangleframe');
	tempPanRectangleFrame.setAttribute('style', 'width:'+wdthRF+'px; height:'+hgthRF+'px; top:'+topRectangleFrame+'px; left:'+leftRectangleFrame+'px;');
	tempPanViewer.appendChild(tempPanRectangleFrame); 
	

	previousTopRectangleFrame = topRectangleFrame;
	previousLeftRectangleFrame = leftRectangleFrame;
}


function panOnZoomDown(flagY,flagX)
{	
	var tempPanViewer = document.getElementById('panviewer');
	
		
	hgthRF = hgthRF * 2;
	wdthRF = wdthRF * 2;
	
	topRectangleFrame = midPanHeight - (hgthRF / 2);
	leftRectangleFrame = midPanWidth - (wdthRF / 2);
	
	
	var tempDiffY = topRectangleFrame - previousTopRectangleFrame;
	var tempDiffX = leftRectangleFrame - previousLeftRectangleFrame;
	
	topRectangleFrame = topRectangleFrame - tempDiffY;
	leftRectangleFrame = leftRectangleFrame - tempDiffX;

	
	var maxConstY = (3 * hgthRF) / 4;
	var maxConstX = (3 * wdthRF) / 4;
	var minConstY = hgthRF / 4;
	var minConstX = wdthRF / 4;

	
	if(flagY == 1)
		topRectangleFrame = topRectangleFrame - minConstY;
	
	if(flagY == 2)
		topRectangleFrame = topRectangleFrame - maxConstY;
		
	if(flagY == 3)
		topRectangleFrame = topRectangleFrame + minConstY;
		
	if(flagY == 4)
		topRectangleFrame = topRectangleFrame - maxConstY;
	
	
	if(flagX == 1)
		leftRectangleFrame = leftRectangleFrame - minConstX;
	
	if(flagX == 2)
		leftRectangleFrame = leftRectangleFrame - maxConstX;
		
	if(flagX == 3)
		leftRectangleFrame = leftRectangleFrame + minConstX;
		
	if(flagX == 4)
		leftRectangleFrame = leftRectangleFrame - maxConstX;
	
	
	var tempPanRectangleFrame = document.createElement('div');
	tempPanRectangleFrame.setAttribute('id', 'panrectangleframe');
	tempPanRectangleFrame.setAttribute('class', 'panrectangleframe');
	tempPanRectangleFrame.setAttribute('style', 'width:'+wdthRF+'px; height:'+hgthRF+'px; top:'+topRectangleFrame+'px; left:'+leftRectangleFrame+'px;');
	tempPanViewer.appendChild(tempPanRectangleFrame); 
	

	previousTopRectangleFrame = topRectangleFrame;
	previousLeftRectangleFrame = leftRectangleFrame;
}


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
