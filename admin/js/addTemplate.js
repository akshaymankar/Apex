var largestId=0;
//document.getElementById('largestId').valueOf().value= largestId;
//document.forms.largestId.valueOf().value=largestId;

//Ajax
xhr=false;
if(window.XMLHttpRequest){
    xhr=new XMLHttpRequest();
}
else{
    xhr=new ActiveXObject("Microsoft.XMLHTTP");
}

function validatefield()
{
    var template_name = document.getElementById('template_name');
    var file_name = document.getElementById('file');
    
    
    if(template_name.value!=''){
        
        if(file_name.value==''){
            
            alert ('Please Select file');
            file_name.style.borderColor='RED';
            file_name.focus();
            return false;
        }else{
                var i=0;
                var param_name = document.getElementById('param_name'+i);
            
               for(var i=0; i<param_name.length || i==0 ;i++)
                {   
                    var param_name = document.getElementById('param_name'+i);
                    if(param_name.value=='')
                    {
                        alert ('Please Enter Parameter name');
                        param_name.style.borderColor='RED';
                        param_name.focus();
                        return false;
                    }
                }
               return true;
            }
    }else{
            alert('Please Give The Template Name');
            document.getElementById('template_name').style.borderColor='RED'
            document.getElementById('template_name').focus();
            return false;
    }
}//end of function validatefield


function addNewFields(currentId){
    
    if(currentId <= largestId)
    {
       
    largestId++;
    document.getElementById("largestId").setAttribute("value", largestId);
    tempId = largestId-1;
    
   var previousParameterfield = document.getElementById("param_type"+currentId); 
    //var tempname;
    //tempname = 'param_type'+tempId;
    //alert(document.forms.addTemplate.tempname);
    //alert(previousParameterfield.id);  
    
    var inputParamName=document.createElement('input');
    inputParamName.setAttribute('name', 'param_name[]');
    inputParamName.setAttribute('id', 'param_name'+largestId);
    //inputParamName.setAttribute('onchange', 'addNewFields('+largestId+')');
    inputParamName.setAttribute('type', 'text');
    
    var selectType=document.createElement('select');
    selectType.setAttribute('name', 'param_type[]');
    selectType.setAttribute('class', 'param_type');
    selectType.setAttribute('id', 'param_type'+largestId);
    selectType.setAttribute('onchange','addNewFields('+largestId+');');
    
    var optNone=document.createElement('option');
    optNone.setAttribute('value', 'NONE');
    optNone.innerHTML='Select Type';
    
    
    
    var optInt=document.createElement('option');
    optInt.setAttribute('value', 'INT');
    optInt.innerHTML='Integer Number';
    
    var optStr=document.createElement('option');
    optStr.setAttribute('value', 'String');
    optStr.innerHTML='Text';
    
  var optFloat=document.createElement('option');
   
    optFloat.setAttribute('value', 'FLOAT');
    optFloat.innerHTML='Decimal Number';
    
    selectType.appendChild(optNone);
    selectType.appendChild(optInt);
    selectType.appendChild(optStr);
    selectType.appendChild(optFloat);
     
     
        var blankLine=document.createElement('br');
        previousParameterfield.parentNode.appendChild(blankLine);
         
        previousParameterfield.parentNode.appendChild(inputParamName);
        inputParamName.parentNode.appendChild(selectType);
  
   var currentParameterfield = document.getElementById("param_name"+largestId); 
  currentParameterfield.focus();
  
    }
}

function uploadFile(){
    if(!xhr){
        document.getElementById('box').innerHTML="Error Occurred: AJAX Not Supported !!<br>Please Consider Upgrading your browser !";
    }
}

function show_confirm()
{			
    var r=confirm("Press a button!");
    if (r==true)
    {
        return true;
    }
    else
    {
        return false;  
    }
}

