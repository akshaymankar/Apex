var GLO_MainType = "";
var GLO_SubType = "summary";
var changedPrefix = "";
var curDate = new Date();
var day = "";
var month = curDate.getMonth();
var YEAR = curDate.getFullYear();
var filedata;		

month = month + 1;

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
    GLO_MainType = thumbnail.title;		
  
    var tempST = document.getElementById("subCategoryWrapper");
    var tempSubType = document.getElementById("subCategory");
    var tempremoveHeading = document.getElementById('headingForTypeid');
    if(tempremoveHeading)
    {
        $(tempremoveHeading).remove();
    }
    
    tempST.removeChild(tempSubType);
        
    var tempHeading = document.createElement('span');
    tempHeading.setAttribute('class', 'headingForType');
    tempHeading.setAttribute('id', 'headingForTypeid');
    tempHeading.innerHTML = thumbnail.title;
    tempST.appendChild(tempHeading);
	
    tempSubType = document.createElement('div');
    tempSubType.setAttribute('id', 'subCategory');
    tempST.appendChild(tempSubType);   	
    
   		        
    var params="id="+thumbnail.id;
      
    xhr.open("POST","readSubType.php?"+params);
		
    xhr.onreadystatechange = function ()
    {
        if (xhr.readyState == 4 && xhr.status == 200)
        {
            tempSubType.innerHTML += xhr.responseText;
            
					
            changedPrefix = thumbnail.name;
            GLO_SubType = thumbnail.alt;		


            if(thumbnail.id==1)
            {
                $(thumbnail).addClass('highlightedthumbnail');
            }


            if(document.getElementById('SubType+1')!=null)
            {				
                document.getElementById('SubType+1').style.backgroundColor="black";
                document.getElementById('SubType+1').style.color="white";
            }


            changeYear(document.getElementById('year'+YEAR));
            changeMonth(document.getElementById('Id'+parseInt(month,10)));
            

            changeFileList();
        }
        else if (xhr.readyState == 4 && xhr.status != 200) 
        {
            console.log(xhr.status);//TODO There should be error page
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
    tempYearList.setAttribute('style', 'float:left; overflow:auto;');
    tempYearMonth.appendChild(tempYearList);

    for(var i=(new Date()).getFullYear(); i>=2001; i--)
    {
        var tempYear = document.createElement('input');
        tempYear.setAttribute('type', 'button');
        tempYear.setAttribute('id', 'year'+i);
        tempYear.setAttribute('class', 'years');
        tempYear.setAttribute('value', i);
        tempYear.setAttribute('onclick', 'preChangeYear(this)');
        tempYearList.appendChild(tempYear);
		
        var brk = document.createElement('br');
        tempYearList.appendChild(brk);
    }
	
		
    var tempMonthList = document.createElement('div');
    tempMonthList.setAttribute('id', 'month');
    tempMonthList.setAttribute('style', 'float:left;');
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
    
    
    changeYear(document.getElementById('year'+YEAR));
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


    for(i=1;i<=(document.getElementById('subCategory')).childNodes.length;i++)
    { 
        document.getElementById('SubType+'+i).style.backgroundColor='#33CCFF';
        document.getElementById('SubType+'+i).style.color='black';
    }
    obj.style.backgroundColor='black'; 
    obj.style.color='white'; 

}
	
	
function preChangeYear(obj)
{
    changeYear(obj);
    
    changeFileList();
}


function changeYear(obj)
{
    var temp = obj.id;
    YEAR = temp.substring(4);
    for(i=(new Date()).getFullYear();i>=2001;i--)
    { 
        document.getElementById('year'+i).style.backgroundColor='#33CCFF';
        document.getElementById('year'+i).style.color='black';
    }  
    obj.style.backgroundColor='black';
    obj.style.color='white';
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
    {
        document.getElementById('Id'+i).style.backgroundColor='#33CCFF';
        document.getElementById('Id'+i).style.color='black'; 
    }   
    obj.style.backgroundColor='black';
    obj.style.color='white';


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
	
    var params="mainType="+GLO_MainType+"&subType="+GLO_SubType+"&changedPrefix="+changedPrefix+"&year="+YEAR+"&month="+month;
 
    xhr.open("POST","isFile.php?"+params);
			
    xhr.onreadystatechange = function ()
    {
        if (xhr.readyState == 4 && xhr.status == 200)
        {
            tempFileNameList = document.createElement('div');
            tempFileNameList.setAttribute('id', 'fileNameList');
            
            tempFileNameList.innerHTML = xhr.responseText;

            tempFileSelector.insertBefore(tempFileNameList,tempFileSelector.firstChild);

            $('.filenamebutton').mouseenter(function() {
                $('.toolTip').remove();
                tempthis=(this).getElementsByTagName("span")[0];

                filedata=new Object();
                filedata.buttonName=this.getElementsByTagName("form")[0]["buttonName"].value;
                filedata.fileDir=this.getElementsByTagName("form")[0]["fileDir"].value;
                filedata.filename=this.getElementsByTagName("form")[0]["fileName"].value;
                $(tempthis).append('<span class="toolTip"><span href="javascript:void(0);" onclick="wayToDisplay(filedata);">View</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span href="#" onclick="wayToDownload(filedata);">Download</span></span>');
                $('.toolTip').attr('title',this.id);

            });

            $('.filenamebutton').mouseleave(function() {
                tempTimer = setTimeout("$('.toolTip').remove();",10000);
            });


            $('#fileNameList').mouseleave(function() {
                $('.toolTip').remove();
            });
          
            if((tempFileNameList.childNodes.length / 2) == 0)
            {
                tempFileNameList.innerHTML="No files";
            }
        }
        else if (xhr.readyState == 4 && xhr.status != 200) 
        {
            console.log(xhr.status);//TODO There should be error page
        }
    }
      
    xhr.send(null);		
}
	
	
function wayToDisplay(fileData)
{ 
    var psFile = fileData.filename.replace(/.gz/,"");
    var compressedPsFile = psFile + ".gz";
    var inputImagePath = fileData.fileDir;
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
            console.log(xhr.status);//TODO There should be error page
        }
    }
        
    xhr.send(null);			
}


function wayToDownload(fileData)
{ 
    window.location.href = fileData.fileDir + "/" + fileData.filename;
}


$(document).ready(function(){	
    
    displayYearMonth();
    
    changeMainContent(document.getElementById("1"));

   
    $("#sidebar > img").bind("click",function(){

        $("#sidebar > img[class~='highlightedthumbnail']").removeClass('highlightedthumbnail');
        $(this).addClass('highlightedthumbnail');
    });
 
});
