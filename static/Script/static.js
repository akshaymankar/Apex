var GLO_MainType = "";
var GLO_SubType = "summary";
var changedPrefix = "";
var curDate = new Date();
var day = "";
var month = curDate.getMonth();
var year = curDate.getFullYear();
		
if(month < 10)
{
    month = "0" + month;
}
	
	
xhr = false;
    
if (window.XMLHttpRequest)
    xhr = new XMLHttpRequest();	//For every browser other than IE
else if (window.ActiveXObject)
    xhr = new ActiveXObject("Microsoft.XMLHTTP");	//For IE 7+
	
	
function changeMainContent(thumbnail)
{   
    GLO_MainType = thumbnail.value;		
  
    var tempST = document.getElementById("sT");
    var tempSubType = document.getElementById("subType");
    
    tempST.removeChild(tempSubType);
    
    tempSubType = document.createElement('div');
    tempSubType.setAttribute('id', 'subType');
    tempST.appendChild(tempSubType);   	
    
   	
    var tempHeading = document.createElement('h1');
    tempHeading.setAttribute('class', 'headingForType');
    tempHeading.setAttribute('align', 'center');
    tempHeading.innerHTML = thumbnail.value;
    tempSubType.appendChild(tempHeading);
	
    var brk = document.createElement('br');
    tempSubType.appendChild(brk);
		
                
    var params="id="+thumbnail.id;
      
    xhr.open("POST","readSubType.php?"+params);
		
    xhr.onreadystatechange = function ()
    {
        if (xhr.readyState == 4 && xhr.status == 200)
        {
            var tempDiv = document.createElement('div');
            tempDiv.setAttribute('align', 'center');
            tempDiv.innerHTML = xhr.response;
            tempSubType.appendChild(tempDiv);
			
					
            changedPrefix = thumbnail.name;
            GLO_SubType = thumbnail.title;		
				
				
            changeYear(document.getElementById(year));
            changeMonth(document.getElementById('Id'+parseInt(month,10)));
            //changePrefix(document.getElementById('SubType'+parseInt(month,10)));
            
//alert(GLO_MainType+"_"+thumbnail.id+"_"+changedPrefix+"_"+GLO_SubType);
            changeFileList();
        }
        else if (xhr.readyState == 4 && xhr.status != 200) 
        {
            alert(xhr.status);//TODO There should be error page
        }
    }
        
    xhr.send(null);		
}
	
	
function displayYearMonth()
{
    var tempFileSelector = document.getElementById('fileSelector');
    var tempYearMonth = document.getElementById("yearMonth");


    var tempYearList = document.createElement('div');
    tempYearList.setAttribute('id', 'year');
    tempYearList.setAttribute('style', 'float:left; margin-left:25px; margin-right:25px; height:390px; overflow:auto;');
    tempYearMonth.appendChild(tempYearList);

    for(var i=(new Date()).getFullYear(); i>=2001; i--)
    {
        var tempYear = document.createElement('input');
        tempYear.setAttribute('type', 'button');
        tempYear.setAttribute('id', i);
        tempYear.setAttribute('class', 'years');
        tempYear.setAttribute('value', i);
        tempYear.setAttribute('onclick', 'preChangeYear(this)');
        tempYearList.appendChild(tempYear);
		
        var brk = document.createElement('br');
        tempYearList.appendChild(brk);
    }
	
		
    var tempMonthList = document.createElement('div');
    tempMonthList.setAttribute('id', 'month');
    tempMonthList.setAttribute('style', 'float:left;margin-left:25px;margin-right:25px;');
    tempYearMonth.appendChild(tempMonthList);
		
    var months = new Array(12);
    months[0] = "Jan";
    months[1] = "Feb";
    months[2] = "Mar";
    months[3] = "Apr";
    months[4] = "May";
    months[5] = "Jun";
    months[6] = "Jul";
    months[7] = "Aug";
    months[8] = "Sept";
    months[9] = "Oct";
    months[10] = "Nov";
    months[11] = "Dec";
		
    for(i=0; i<12; i++)
    {
        var tempMonth = document.createElement('input');
        tempMonth.setAttribute('type', 'button');
        tempMonth.setAttribute('id', 'Id'+(i+1));
        tempMonth.setAttribute('name', i+1);
        tempMonth.setAttribute('class', 'months');
        tempMonth.setAttribute('value', months[i]);
        tempMonth.setAttribute('onclick', 'preChangeMonth(this)');
        tempMonthList.appendChild(tempMonth);
		
        brk = document.createElement('br');
        tempMonthList.appendChild(brk);
    }  
    
    
    changeYear(document.getElementById(year));
    changeMonth(document.getElementById('Id'+parseInt(month,10)));
}


function preChangePrefix(obj)
{
    changePrefix(obj);

    changeFileList();
}


function changePrefix(obj)
{
    changedPrefix = obj.name;
    GLO_SubType = obj.value;
		
     
    /*for(i=1;i<=(document.getElementById('subType')).childNodes.length;i++)
        document.getElementById('SubType'+i).style.backgroundColor='#33FFFF';
   
    obj.style.backgroundColor='#f00'; */
}
	
	
function preChangeYear(obj)
{
    changeYear(obj);
    
    changeFileList();
}


function changeYear(obj)
{
    year = obj.id;
    
    for(i=(new Date()).getFullYear();i>=2001;i--)
        document.getElementById(i).style.backgroundColor='#9F9';
   
    obj.style.backgroundColor='#f00';
}
	
	
function preChangeMonth(obj)
{
    changeMonth(obj);
    
    changeFileList();
}


function changeMonth(obj)
{
    month = obj.name;

    for(i=1;i<=12;i++)
        document.getElementById('Id'+i).style.backgroundColor='#9F9';
    
    obj.style.backgroundColor='#f00';


    if(month < 10)
    {
        month = "0" + month;
    }
}
	
	
function changeFileList()
{
    var tempFileSelector = document.getElementById('fileSelector');
    var tempFileNameList = document.getElementById('fileNameList');
    
    tempFileSelector.removeChild(tempFileNameList);
	
	
    var params="mainType="+GLO_MainType+"&subType="+GLO_SubType+"&changedPrefix="+changedPrefix+"&year="+year+"&month="+month;
      
    xhr.open("POST","isFile.php?"+params);
			
    xhr.onreadystatechange = function ()
    {
        if (xhr.readyState == 4 && xhr.status == 200)
        {
            tempFileNameList = document.createElement('div');
            tempFileNameList.setAttribute('id', 'fileNameList');
            tempFileNameList.setAttribute('style', 'float:left; margin-left:25px; margin-right:25px; height:390px; overflow:scroll;');
            tempFileNameList.innerHTML = xhr.response;
            tempFileSelector.appendChild(tempFileNameList);

            
            if((tempFileNameList.childNodes.length / 2) == 0)
            {
                tempFileNameList.innerHTML="No files";
            }
        }
        else if (xhr.readyState == 4 && xhr.status != 200) 
        {
            alert(xhr.status);//TODO There should be error page
        }
    }
      
    xhr.send(null);		
}
	
	
/*function wayToDisDown(file)
{
    var psFile = file.value;
    var compressedPsFile = psFile + ".gz";
    var inputImagePath = file.name;
    var outputFileName = psFile;
			
			
    var params="dir="+inputImagePath+"&file1="+compressedPsFile+"&file2="+psFile;
      
    xhr.open("POST","extract.php?"+params);
			
    xhr.onreadystatechange = function ()
    {
        if (xhr.readyState == 4 && xhr.status == 200)
        {
            var choice = confirm("Press 'Ok' for 'Display' and 'Cancel' for 'Download' CHOICE.");

            if(choice == true)
            {
                window.location.href = "../viewer/index.php?filetype=" + GLO_MainType + "&filename=" + outputFileName;
            }
            else
            {
                window.location.href = "../tile/static/" + outputFileName + "/" + outputFileName;;
            }
        }
        else if (xhr.readyState == 4 && xhr.status != 200) 
        {
            alert(xhr.status);//TODO There should be error page
        }
    }
        
    xhr.send(null);			
}
*/	
	
function wayToDisplay(file)
{ 
    var psFile = file.id;
    var compressedPsFile = psFile + ".gz";
    var inputImagePath = file.name;
    var outputFileName = psFile;
			
			
    var params="dir="+inputImagePath+"&file1="+compressedPsFile+"&file2="+psFile;
      
    xhr.open("POST","extract.php?"+params);
			
    xhr.onreadystatechange = function ()
    {
        if (xhr.readyState == 4 && xhr.status == 200)
        {
            window.location.href = "../viewer/index.php?filetype=" + GLO_MainType + "&filename=" + outputFileName;
        }
        else if (xhr.readyState == 4 && xhr.status != 200) 
        {
            alert(xhr.status);//TODO There should be error page
        }
    }
        
    xhr.send(null);			
}


function wayToDownload(file)
{ 
    var psFile = file.id;
    var compressedPsFile = psFile + ".gz";
    var outputFileName = compressedPsFile;
    var inputImagePath = file.name;
  
  
    window.location.href = inputImagePath + "/" + outputFileName;
}


$(document).ready(function(){	
    // TODO
    changeMainContent(document.getElementById("1"));
    displayYearMonth();
});
