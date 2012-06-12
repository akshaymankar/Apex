function initButtonControls()
{
	var tempViewer = document.getElementById('viewer');
	
	var tempZoomInControl = document.createElement('div');
	tempZoomInControl.setAttribute('id', 'zoomincontrol');
	tempZoomInControl.setAttribute('class', 'zoomincontrol');
    tempViewer.appendChild(tempZoomInControl);
    
	var tempPlusImg = document.createElement('img');
	tempPlusImg.setAttribute('id', 'plus');
	tempPlusImg.setAttribute('class', 'plus');
	tempPlusImg.setAttribute('title', 'ZOOM IN');
	tempPlusImg.setAttribute('src','Images/zoomin.png');
	tempPlusImg.setAttribute('onclick', 'advanceZoomUp()');
	tempZoomInControl.appendChild(tempPlusImg);
    
    
    var tempZoomOutControl = document.createElement('div');
	tempZoomOutControl.setAttribute('id', 'zoomoutcontrol');
	tempZoomOutControl.setAttribute('class', 'zoomoutcontrol');
    tempViewer.appendChild(tempZoomOutControl);
    
	var tempMinusImg = document.createElement('img');
	tempMinusImg.setAttribute('id', 'minus');
	tempMinusImg.setAttribute('class', 'minus');
	tempMinusImg.setAttribute('title', 'ZOOM OUT');
	tempMinusImg.setAttribute('src','Images/zoomout.png');
	tempMinusImg.setAttribute('onclick', 'advanceZoomDown()');
	tempZoomOutControl.appendChild(tempMinusImg);

    var goLeft = document.createElement('a');
    goLeft.setAttribute('id','goLeftId');
    goLeft.setAttribute('href', 'javascript:void(0);');
    goLeft.setAttribute('onclick', 'goLeft();');
    goLeft.innerHTML = '<img src="Images/left.png">';
    tempZoomOutControl.appendChild(goLeft);
                        
    var goRight = document.createElement('a');
    goRight.setAttribute('id', 'goRightId');
    goRight.setAttribute('href', 'javascript:void(0);');
    goRight.setAttribute('onclick', 'goRight();');
    goRight.innerHTML = '<img src="Images/right.png">';
    tempZoomOutControl.appendChild(goRight);

}
