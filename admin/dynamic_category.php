<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<style>
    .button_class
    {
        width:auto;
        height: 50px;
        color: #E70;
        font-family:  sans-serif;
        font-size:  x-large;
    }
    .button_div
    {
        width:500px;
        height:auto;
        color: blue;
        position: relative;
    }
    
</style>


<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Dynamic Categories</title>
        
        <link type="text/css" rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.18.custom.css"/>
        <script language ="javascript" type="text/javascript" src="js/box.js"></script>
        <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
        
    </head>
    <body>
        <div id="types" class="button_div">
            <table>
                <th><h2>Parameter</h2></th><th>Values</th>
                <tr><td><input type="button" id="tempin" value="TempIn"  class="button_class" onclick="showpromptBox()" /></td><td><input type="text" id="temin_text" /></tr>
                <tr></tr>
                <tr><td><input type="button" id="tempout" value="TempOut"  class="button_class" onclick="showpromptBox()"/></td> <td><input type="text" id="temout_text" /></td></tr>
            </input>
            </table>
        </div>
        
        <?php
        // put your code here
        
        
        ?>
    </body>
</html>
