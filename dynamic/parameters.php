<?php
    require_once 'mysql.php';
    if(!isset($_POST['template'])) {
        die('Error Occured !!<br/>Please press "Back" button of your browser and submit the form again.<br>Inconvinience is regeretted.');
    }
    
    $template_id = $_POST['template'];
    
    //echo "template id=$template_id";
    $query="select * from parameters where template_id='$template_id'";
    $res=mysql_query($query);
    
    if (!$res) {
        die('Error: Failed to fetch parameters.'.mysql_error());
    }

    function getFormInputs_Parameters($res) {
        ?>
        <input type="hidden" name="template" value="<?php echo $_POST['template']; ?>" />
        <table border="0">
        <?php
        while($row=mysql_fetch_assoc($res)) {
            $to_validate[$row['type']][]=$row['name'];

            switch ($row['type']) {
                case 'INT':
                case 'FLOAT':
                case 'STRING':
                case 'CHAR':
                    ?>
                        <tr>
                            <td><?php echo $row['name'];?></td>
                            <td><input type="text" name="<?php echo $row['parameter_id']; ?>" required />
                        </tr>
                    <?php
                    break;
                case 'DATE':
                    ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><input type="text" id="param<?php echo $row['parameter_id'];?>" value="11th April 2012" /></td>
                            <script>
                                AnyTime.picker( "<?php echo $row['parameter_id'];?>",{ format: "%D %M %z", firstDOW: 1 });
                            </script>
                        </tr>
                    <?php
                    break;
                case 'DATE_TIME':
                case 'TIME':
                    break;
                case 'BOOLEAN':
                    ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td>
                                <select name="<?php echo $row['parameter_id']; ?> " id="<?php echo $row['parameter_id']; ?> ">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>   
                           </td>
                        </tr>
                    <?php
                    break;
                default:
                    // code...
                    break;
            }
        }
        ?>
        </table>
        <?php
    }

?>
<h1>Enter Values for Parameters</h1>
<form action="parameters_submit.php" method="post" accept-charset="utf-8">
    <?php
        getFormInputs_Parameters($res);
    ?>
<p><input type="submit" value="Continue &rarr;" /></p>
</form>