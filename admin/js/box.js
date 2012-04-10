function showBox()
{
    var width = document.documentElement.clientWidth + document.documentElement.scrollLeft;

    var layer = document.createElement('div');
    layer.style.zIndex = 2;
    layer.id = 'layer';
    layer.style.position = 'absolute';
    layer.style.top = '0px';
    layer.style.left = '0px';
    layer.style.height = document.documentElement.scrollHeight + 'px';
    layer.style.width = width + 'px';
    layer.style.backgroundColor = 'black';
    layer.style.opacity = '.6';
    layer.style.filter += ("progid:DXImageTransform.Microsoft.Alpha(opacity=60)");
    document.body.appendChild(layer);

    var div = document.createElement('div');
    div.style.zIndex = 3;
    div.id = 'box';
    div.style.position = (navigator.userAgent.indexOf('MSIE 6') > -1) ? 'absolute' : 'fixed';
    div.style.top = '200px';
    div.style.left = (width / 2) - (400 / 2) + 'px';
    div.style.height = '100px';
    div.style.width = '400px';
    div.style.backgroundColor = 'white';
    div.style.border = '2px solid silver';
    div.style.padding = '20px';
    document.body.appendChild(div);
    
    var ul=document.createElement('ul');
    ul.className="jobs";
    ul.id="jobs";
    div.appendChild(ul);
} 

function showpromptBox()
{
    var width = document.documentElement.clientWidth + document.documentElement.scrollLeft;
    var height=document.documentElement.clientHeight;
        
    /*var layer = document.createElement('div');
    layer.style.zIndex = 2;
    layer.id = 'layer';
    layer.style.position = 'absolute';
    layer.style.top = '0px';
    layer.style.left ='300px';
    layer.style.height = (height * 1.5) + 'px';
    layer.style.width = (width/2) + 'px';
    layer.style.backgroundColor = 'black';
    layer.style.opacity = '.6';
    layer.style.filter += ("progid:DXImageTransform.Microsoft.Alpha(opacity=60)");
    document.body.appendChild(layer);*/


    var div = document.createElement('div');
    div.style.zIndex = 3;
    div.id = 'box';
    div.style.position = (navigator.userAgent.indexOf('MSIE 6') > -1) ? 'absolute' : 'fixed';
    div.style.top = '100px';
    div.style.left = (width / 2.5) - (height / 2) + 'px';
    div.style.height = (height/3.5) + 'px';
    div.style.width = (width/3.5) + 'px';
    div.style.backgroundColor = 'GRAY';
    div.style.border = '2px solid silver';
    div.style.padding = '20px';
    document.body.appendChild(div);
    
    
    var label=document.createElement('label');
    label.className="firstdate";
    label.id="firstdate";
    label.name='Start Date';
        
    label.style.zIndex=4;
    label.style.left= div.style.left+'50 px';
    label.style.top=div.style.top+'100 px';
    label.style.backgroundColor='YELLOW';
    //label.style.border='2px solid silver';
    div.appendChild(label);
    label.textContent='Start Date';
    //document.body.appendchild(label);
    
       
    var text=document.createElement('input');
    
    text.type='text';
    text.className='date_Text';
    text.id='date_Text';
    text.name='date_Text';
    
        
    text.style.zIndex=4;
    text.size='10';
    //text.style.left='400 px';
    //text.style.top='240 px';
    text.style.backgroungcolor='blue';
    div.appendChild(text);
    
    $(function() {
                    
                     $("#date_Text").datepicker({dateFormat: $.datepicker.W3C,showOn: 'button', buttonImage: 'calendar.gif', buttonImageOnly: true});
                     $( "#date_Text" ).datepicker({ changeMonth: true });
                     
                     //getter
                        var changeYear = $( "#date_Text" ).datepicker( "option", "changeYear" );
                        //setter
                        $( "#date_Text" ).datepicker( "option", "changeYear", true );
                        
                    
                    $( "#date_Text" ).datepicker({ minDate: new Date(2001, 1 - 1, 1) });
                    //getter
                    var minDate = $( "#date_Text" ).datepicker( "option", "minDate" );
                    //setter
                    $( "#date_Text" ).datepicker( "option", "minDate", new Date(2001, 1 - 1, 1) );
                                     }); 
} // end of showpromptBox


