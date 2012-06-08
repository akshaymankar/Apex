<html>
    <head>
        <script src="js/addTemplate.js" type="text/javascript" ></script>
    </head>
    <body>
        <form>
            <table id ="addTemplateTable" class="addTemplate">
                <tr class="name">
                    <td>Name</td>
                    <td><input type="text" name="template_name" /></td>
                </tr>
                <tr class="header">
                    <td>Parameter Name</td>
                    <td>Parameter Type</td>
                </tr>
                <tr class="values">
                    <td><input type="text" name="param_name[]" id="param_name0" class="param_name" onchange="addNewFields(0)" /></td>
                    <td>
                        <select name="param_type[]" class="param_type" id="param_type0" >
                            <option value='INT'>Integer Number</option>
                            <option value="STRING">Text</option>
                            <option value="FLOAT">Decimal Number</option>
                        </select>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td><input type="submit" name="Submit" value="Add Template" /></td>
                </tr>
            </table>
        </form>
    </body>
</html>
