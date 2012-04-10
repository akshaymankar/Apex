<html>
    <head>
        <script src="js/addTemplate.js" type="text/javascript" ></script>
        <style>
            .parameterHeaders
            {
                font-family: sans-serif;
                font-size: 110%;
                font-weight: bolder;
                
            }
            input
            {
            font-size: 110%;
            }
            span
            {
                 font-family: sans-serif;
                 font-weight: bold;
            font-size: 110%;
            }
            .param_type
            {
                font-size: 110%;
            }
        </style>
    </head>
    <body>
        <form enctype="multipart/form-data" name="addTemplate" id="addTemplate" method='POST' action="uploadCode.php" onsubmit="return validatefield();" >
            
                
                    <span>Name</span>
                    <input type="text" name="template_name" id="template_name" placeholder="Enter Template Name"/>
                    
                    <br />
                    <br />
                    
                    <span>Template File:</span>
                    <input type="file" name="file" style="position: relative" id="file"/>
                    <br /><br />
              
                    <div id ="parameterlist">   
                    
                    <span class="parameterHeaders">Parameter List</span>
                    <br /><br />
                
                 <input type="text" name="param_name[]" id="param_name0" class="param_name" placeholder="Enter Parameter Name"/>                   
                        <select name="param_type[]" class="param_type" id="param_type0"  onchange="addNewFields(0); ">
                            <option value='NONE'>Select Type</option>
                            <option value='INT'>Integer Number</option>
                            <option value="STRING">Text</option>
                            <option value="FLOAT">Decimal Number</option>
                        </select>
                    
                <input type="hidden" id="largestId" name="largestId" value="" />
                    
            


        </div>
                    
            <br />
<br />
            <input type="submit" name="Submit" value="Add Template" />
                    
        </form>
    </body>
</html>
