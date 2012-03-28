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
