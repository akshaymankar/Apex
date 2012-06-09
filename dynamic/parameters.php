<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/anytime.js"></script>
<?php
    require_once 'mysql.php';
    if(!isset($_POST['template'])) {
        $_POST['template']="4";
    }
    
    $template_id = $_POST['template'];
    $paramId = $_POST['paramId'];
    
    /* Param Id is required to make sure that every input element gets 
     * a different id, so that no exceptions in HTML DOM are raised 
     * while processing them.
     */

    $query="select * from parameters where template_id='$template_id'";
    $res=mysql_query($query);
    
    if (!$res) {
        die('Error: Failed to fetch parameters.'.mysql_error());
    }

    function getFormInputs_Parameters($res) {
        ?>
        <input type="hidden" name="template" 
            value="<?php echo $_POST['template']; ?>" />
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
                            <td><input type="text" id="param<?php echo nextId(); ?>" name="<?php echo $row['parameter_id']; ?>" value="11th April 2012" /></td>
                            <script>
                                AnyTime.picker( "param<?php echo lastId();?>",{ format: "%D %M %z", firstDOW: 1 });
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
        <input type="hidden" name="paramId" value="<?php echo lastId(); ?>">
        </table>
        <?php
    }
    function nextId(){
        global $paramId;
        $paramId++;
        return $paramId;
    }
    function lastId(){
        global $paramId;
        return $paramId;
    }

?>
<h1>Enter Values for Parameters</h1>
<form action="parameters_submit.php" method="post" name="parameters" accept-charset="utf-8">
    <?php
        getFormInputs_Parameters($res);
    ?>
<p><input type="submit" value="Continue &rarr;" /></p>
</form>
