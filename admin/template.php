<?php
require_once 'mysql.php';

$query = "select * from template";
$res = mysql_query($query);

if (!$res) {
    die('Error: Failed to fetch parameters.' . mysql_error());
}

function getparameters($id) {

    $query_parameters = "select * from parameters where template_id='$id'";
    $res1 = mysql_query($query_parameters);

    if (!$res1) {
        die('Error: Failed to fetch parameters.' . mysql_error());
        //echo mysql_error();
    }
    ob_flush();
    ob_start();
    ?>
    <table class="parameters">
        <?php
        while ($row1 = mysql_fetch_assoc($res1)) {
            echo '<tr>
                    <td>' . $row1['name'] . '</td>
                    <td>' . $row1['type'] . '</td>
                  </tr>';
        }
        ?>
    </table>
    <?php
    //echo $str;
    $str = ob_get_contents();
    ob_clean();
    return $str;
}

//end of function getparameters
?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <Title>Admin</Title>

        <script language="javascript" type="text/javascript" src="js/template.js" ></script>

    </head>
    <body>
        <form action='deleteTemplate.php' method='post' onsubmit="show_confirm();">
            <table class="templates">
                <th>Templates</th><th>Parameters</th>
                <?php while ($row = mysql_fetch_assoc($res)) { ?>
                    <tr class="template"><td><a href='modifyTemplate.php?id=<?php echo $row['template_id']; ?>'> <?php echo $row['name']; ?></td></a>
                        <td> <?php echo getparameters($row['template_id']); ?>  </td>
                        <td><input type="image" src="images/delete.png" width="25" height="25"  name="id" title="Delete" alt="Delete" value="<?php echo $row['template_id'] ?>" /> </td>
                    </tr>
                <?php } ?>

            </table>
            
        </form>	
        <form action='addTemplate.php' method='post'>
            <p><input type="submit" value="Add" /></p>
        </form>	
    </body>
</html>


