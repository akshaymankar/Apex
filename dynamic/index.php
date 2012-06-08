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
    
        <title>Apex : Route 2 Root</title> 
    </head>
    <body>
        <form action="parameters.php" method="post" accept-charset="utf-8">
        Template: <select name="template" id="template">
            <?php
                getTemplates();
            ?>
        </select>
        <p><input type="submit" value="Continue" /></p>
        </form>
    </body>
</html>
