//Script for handling various Mouse Events in Java-Script.
//It also involves Browser Detection Script.



var EventUtil =new Object;


EventUtil.formatEvent = function(oEvent)
{
    var isIE = getInternetExplorerVersion();
    var isWin = getWinOsArchitecture();


    if(isIE!= -1 && isWin!= -1)
    {
        oEvent.charCode = (oEvent.type == "keypress") ? oEvent.keyCode : 0;
        oEvent.eventPhase = 2;
        oEvent.isChar = (oEvent.charCode > 0);
        oEvent.pageX = oEvent.clientX + document.body.scrollLeft;
        oEvent.pageY = oEvent.clientY + document.body.scrollTop;

        oEvent.preventDefault = function ()
        {
            this.returnValue = false;
        };
		
        if(oEvent.type == "mouseout")
        {
            oEvent.relatedTarget = oEvent.toElement;
        }
        else if(oEvent.type == "mouseover")
        {
            oEvent.relatedTarget = oEvent.fromElement;
        }
		
        oEvent.stopPropagation = function ()
        {
            this.cancelBubble = true;
        };
		
        oEvent.target = oEvent.srcElement;
        oEvent.time = (new Date).getTime();
    }
	
	
    return oEvent;
};


EventUtil.getEvent = function()
{
    if(window.event)
    {
        return this.formatEvent(window.event);
    }
    else
    {	
        return EventUtil.getEvent.caller.arguments[0];
    }
};


EventUtil.addEventHandler = function(oTarget,sEventType,fnHandler)
{
    if(oTarget.addEventListener)
    {		
        oTarget.addEventListener(sEventType,fnHandler,false);
    }
    else if(oTarget.attachEvent)
    {
        oTarget.attachEvent("on" + sEventType, fnHandler);
    }
    else
    {
        oTarget["on" + sEventType] = fnHandler;
    }
};


EventUtil.removeEventHandler = function(oTarget,sEventType,fnHandler)
{
    if(oTarget.removeEventListener)
    {		
        oTarget.removeEventListener(sEventType,fnHandler,false);
    }
    else if(oTarget.detachEvent)
    {
        oTarget.detachEvent("on" + sEventType, fnHandler);
    }
    else
    {
        oTarget["on" + sEventType] = null;
    }
};


function getInternetExplorerVersion()
{
    var rv = -1;	


    if (navigator.appName == 'Microsoft Internet Explorer')
    {
        var ua = navigator.userAgent;
		
        var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
		
		
        if (re.exec(ua) != null)
            rv = parseFloat( RegExp.$1 );
    }
  
  
    return rv;		//Returns the version of Internet Explorer or -1 indicating the use of another browser.
}


function getWinOsArchitecture()
{
    var rv = -1;

    var platform = window.navigator.platform;

	
    if(platform == 'Win32')
    {
        rv = 'Windows 32 bit';
    }
    else if(platform == 'Win64') 
    {
        rv = 'Windows 64 bit';
    }
    else if(rv==-1 && /Linux/.test(platform)) 
    {
        rv = -1;
    }
    else if(rv==-1 && /Windows/.test(ua)) 
    {
        rv = 'Windows';
    }	
    
    
    return rv;		//Returns Windows Architecture or -1 indicating the use of another platform.
}


function preventDefaultAction(e) 
{
    e.cancelBubble = true;
	 

    if(e.preventDefault)
        e.preventDefault();
 
    e.returnValue = false;

	
    if(e.stopPropagation)
    {
        e.stopPropagation();
    }
}
