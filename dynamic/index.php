<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""
"http://www.w3.org/TR/html4/loose.dtd">
<?php
    require_once 'mysql.php';
    function getTemplates()
    {
        $query='select * from template';
        $res=mysql_query($query);
        if(!res)
        {
            echo "Error Occured while fetching data !";
            return;
        }
        while($row=mysql_fetch_assoc($res))
        {
            echo "<option value='".$row['template_id']."' >".$row['name']."</option>";
        }
    }
?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <script type="text/javascript">
            xhr=false;
            if (window.XMLHttpRequest)
                xhr = new XMLHttpRequest();	//For every browser other than IE
            else if (window.ActiveXObject)
                xhr = new ActiveXObject("Microsoft.XMLHTTP");	//For IE 7+
            
            function selectTemplate()
            {
                var template=document.forms["template"]["template"].value;
                var params="template="+template;
                xhr.open("POST", "parameters.php");
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange=function(){
                    if(xhr.readyState==4 && xhr.status==200){
                        var params_div=document.getElementById('params');
                        params_div.innerHTML=xhr.responseText;
                    }
                }
                xhr.send(params);
            }
        </script>
        <title>Apex : Route 2 Root</title> 
    </head>
    <body>
        <div id="template">
            <form action="parameters.php" name="template" method="post" accept-charset="utf-8">
                Select Template: <select name="template" id="template" onclick="selectTemplate()">
                <?php
                    getTemplates();
                ?>
                </select>
            <!--
            <p><input type="submit" value="Continue" /></p>
            -->
            </form>
        </div>
        <div id="params">
        </div>
    </body>
</html>
