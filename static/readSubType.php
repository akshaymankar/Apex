<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    print_r($_GET);
    die('Died');
}


$handleForFileTypes = fopen("./Configure/filetypes.csv", "r");

if ($handleForFileTypes !== FALSE) {
    $row = 1;
    $countToStart = $id;

    while (($row <= $countToStart) && (($data = fgetcsv($handleForFileTypes, 80, ',', '"')) !== FALSE)) {
        $row++;

        if (($row - 1) == $countToStart) {
            $i = 1;
            $countToEnd = $data[1];

            while (($i <= $countToEnd) && (($data = fgetcsv($handleForFileTypes, 80, ',', '"')) !== FALSE)) {
                $i++;

                if (($i - 1) == 1) {
                    $firstSubType = $data[1];
                }

                $temp = "<input type='button' class='subtype' id='" . $data[1] . "' name='" . $data[0] . "' value='" . $data[0] . "' onclick='changePrefix(this);'/>";
                echo "$temp";
            }
        }
    }

    fclose($handleForFileTypes);
}
else {
    die("Couldn't open Config File (Configure/filetypes.csv)");
}
?>
