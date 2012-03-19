
var GLO_MainType = "";
var GLO_SubType = "summary";
var changedPrefix = "";
//var changedFileType = "";
//var flag = 0;
var curDate = new Date();
var day = "";
var month = curDate.getMonth();
;
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
	
function currentText()
{
    var tempCurrentDiv = document.getElementById('currentDiv');
    var tempCurrentData = document.getElementById('currentData');
		GLO_MainType
    tempCurrentDiv.removeChild(tempCurrentData);
		
    tempCurrentData = document.createElement('div');
    tempCurrentData.setAttribute('id', 'currentData');
    tempCurrentData.setAttribute('align', 'center');
    tempCurrentData.innerHTML = "You Selected Main-Type="+GLO_MainType+", Sub-Type="+GLO_SubType+", Year="+year+", Month="+month+", File="+".";
    tempCurrentDiv.appendChild(tempCurrentData);
}
	
	
function changeMainType(thumbnail)
{
//    currentText();
    
    GLO_MainType = thumbnail.title;		
  
    var tempMain = document.getElementById('main-area');
    var tempSubType = document.getElementById("subType");
    var tempLists = document.getElementById("lists");
    var tempFileSelector = document.getElementById('fileSelector')
    
    //tempMain.removeChild(tempSubType);
    tempFileSelector.removeChild(tempLists);
	
	
    /*
    tempSubType = document.createElement('div');
    tempSubType.setAttribute('id', 'subType');
    tempMain.appendChild(tempSubType);
    */
    while(tempSubType.childNodes.length >= 1)
        tempSubType.removeChild(tempSubType.firstChild);
    
    tempLists = document.createElement('div');
    tempLists.setAttribute('id', 'lists');
    tempMain.appendChild(tempLists);
	
	
    var tempHeading1 = document.createElement('h1');
    tempHeading1.setAttribute('class', 'heading2');
    tempHeading1.setAttribute('align', 'center');
    tempHeading1.innerHTML = thumbnail.title;
    tempSubType.appendChild(tempHeading1);
			
    var tempHeading2 = document.createElement('h2');
    tempHeading2.setAttribute('align', 'center');
    tempHeading2.innerHTML = "(Please, Select one Sub Type of File, Year, Month from below to Display or Download GRAPHS)";
    tempSubType.appendChild(tempHeading2);
		
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
				
            var brk = document.createElement('br');
            tempMain.appendChild(brk);
			
					
            changedPrefix = thumbnail.name;
            GLO_SubType = thumbnail.alt;		
				
				
           // currentText();
            changeSubType();
        }
        else if (xhr.readyState == 4 && xhr.status != 200) 
        {
            alert(xhr.status);//TODO There should be error page
        }
    }
        
    xhr.send(null);		
}
	
	
function changePrefix(obj)
{
    changedPrefix = obj.id;
    GLO_SubType = obj.name;
	
		
  //  currentText();
    changeSubType();
}
	
	
function changeSubType()
{
    var tempMain = document.getElementById('fileSelector');
    var tempLists = document.getElementById("lists");
	
    try{
        tempMain.removeChild(tempLists);
    }
    catch(err){            
    }

    tempLists = document.createElement('div');
    tempLists.setAttribute('id', 'lists');
    tempMain.appendChild(tempLists);
	
    var tempList1 = document.createElement('div');
    tempList1.setAttribute('id', 'list1');
    tempList1.setAttribute('style', 'float:left;margin-left:25px;margin-right:25px;');
    tempLists.appendChild(tempList1);
		
    var curDate = new Date();
    var curDay = curDate.getDate();
    var curMonth = curDate.getMonth();
    var curYear = curDate.getFullYear();

	
    for(var i=2001; i<=curYear; i++)
    {
        var tempYear = document.createElement('input');
        tempYear.setAttribute('type', 'button');
        tempYear.setAttribute('id', i);
        tempYear.setAttribute('class', 'years');
        tempYear.setAttribute('value', i);
        tempYear.setAttribute('onclick', 'changeYear(this)');
        tempList1.appendChild(tempYear);
		
        var brk = document.createElement('br');
        tempList1.appendChild(brk);
    }
	
		
    var tempList2 = document.createElement('div');
    tempList2.setAttribute('id', 'list2');
    tempList2.setAttribute('style', 'float:left;margin-left:25px;margin-right:25px;');
    tempLists.appendChild(tempList2);
		
		
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
		
		
    for(var i=0; i<12; i++)
    {
        var tempMonth = document.createElement('input');
        tempMonth.setAttribute('type', 'button');
        tempMonth.setAttribute('id', 'Mon'+(i+1));
	tempMonth.setAttribute('name', i+1);
        tempMonth.setAttribute('class', 'months');
        tempMonth.setAttribute('value', months[i]);
        tempMonth.setAttribute('onclick', 'changeMonth(this)');
        tempList2.appendChild(tempMonth);
		
        var brk = document.createElement('br');
        tempList2.appendChild(brk);
    }
	
	
    var tempList3 = document.createElement('div');
    tempList3.setAttribute('id', 'list3');
    tempList3.setAttribute('style', 'float:left;margin-left:25px;margin-right:25px;');
    tempLists.appendChild(tempList3);
	
	changeYear(document.getElementById(year));
	changeMonth(document.getElementById('Mon'+parseInt(month,10)));

    changeFile();
}
	
	
function changeYear(obj)
{
    year = obj.id;
//TODO Change this shit
	for(i=2001;i<=2012;i++)
		document.getElementById(i).style.backgroundColor='#9F9';
    obj.style.backgroundColor='#f00';
		
    //currentText();
    changeFile();
}
	
	
function changeMonth(obj)
{
    month = obj.name;

	for(i=1;i<=12;i++)
		document.getElementById('Mon'+i).style.backgroundColor='#9F9';
    obj.style.backgroundColor='#f00';
	
    if(month < 10)
    {
        month = "0" + month;
    }
	
	
    //currentText();
    changeFile();
}
	
	
function changeFile()
{
    var tempLists = document.getElementById("lists");
    var tempList3 = document.getElementById("list3");

	
    tempLists.removeChild(tempList3);
	
		
    var params="mainType="+GLO_MainType+"&subType="+GLO_SubType+"&changedPrefix="+changedPrefix+"&year="+year+"&month="+month;
      
    xhr.open("POST","isFile.php?"+params);
			
    xhr.onreadystatechange = function ()
    {
        if (xhr.readyState == 4 && xhr.status == 200)
        {
            tempList3 = document.createElement('div');
            tempList3.setAttribute('id', 'list3');
            tempList3.setAttribute('style', 'float:left;margin-left:25px;margin-right:25px;');
            tempList3.innerHTML = xhr.response;
            tempLists.appendChild(tempList3);
            
          
           if((tempList3.childNodes.length / 2) == 0)
            {
				
				//alert("No Files For Type=" +  GLO_MainType + "-" + GLO_SubType + " Year=" + year + " Month=" + month);
				tempList3.innerHTML="No files";
			}
        }
        else if (xhr.readyState == 4 && xhr.status != 200) 
        {
            alert(xhr.status);//TODO There should be error page
        }
    }
      
    xhr.send(null);		
}
	
	
function wayToDisDown(file)
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
	
	
$(document).ready(function(){	
    // TODO
    changeMainType(document.getElementById("1"));
});


