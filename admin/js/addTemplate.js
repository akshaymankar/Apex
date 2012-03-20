var largestId=0;

function addNewFields(currentId){
    if(currentId<largestId)
        return;
    largestId++;
    var tbl=document.getElementById('addTemplateTable');
    
    var row=document.createElement('tr');
    row.setAttribute('class', 'template');
    
    var tdName=document.createElement('td');
    
    var inputParamName=document.createElement('input');
    inputParamName.setAttribute('name', 'param_name[]');
    inputParamName.setAttribute('id', 'param_name'+largestId);
    inputParamName.setAttribute('onchange', 'addNewFields('+largestId+')');
    inputParamName.setAttribute('type', 'text');
    
    var tdType=document.createElement('td');
    
    var selectType=document.createElement('select');
    selectType.setAttribute('name', 'param_type[]');
    selectType.setAttribute('class', 'param_type');
    selectType.setAttribute('id', 'param_type'+largestId);
    
    var optInt=document.createElement('option');
    optInt.setAttribute('value', 'INT');
    optInt.innerHTML='Integer Number';
    
    var optStr=document.createElement('option');
    optStr.setAttribute('value', 'String');
    optStr.innerHTML='Text';
    
    var optFloat=document.createElement('option');
    optFloat.setAttribute('value', 'FLOAT');
    optFloat.innerHTML='Decimal Number';
    
    selectType.appendChild(optInt);
    selectType.appendChild(optStr);
    selectType.appendChild(optFloat);
    tdName.appendChild(inputParamName);
    tdType.appendChild(selectType);
    row.appendChild(tdName);
    row.appendChild(tdType);
    tbl.appendChild(row);  
}

