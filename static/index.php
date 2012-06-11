<html>
    <head>
<title>Apex - Static Plots</title>
        
<?php
/////////////////////////////////////////////////////////////////////
require_once('./static_generic_page/generic_page/page_head.php');
/////////////////////////////////////////////////////////////////////
?>

        <title>Static</title>

        <meta http-equiv="Content-Type" content="text/html;">
        <link href="Style/static.css" type="text/css" rel="stylesheet" />

        <script language="javaScript" type="text/javascript" src="Script/jquery.js"></script>

        <script type="text/javascript" src="Script/static.js" ></script>

    </head>


    <body>

<div style="height:20px;">
<?php
////////////////////////////////////////////////////////////////////
require_once('./static_generic_page/generic_page/page_body.php');
////////////////////////////////////////////////////////////////////
?>
</div>

        <h1 id="banner">GRAPES-3 DATA Monitoring Plots</h1>


        <div id="content-wrapper">
            <div id="sidebar" >
                <?php
                $handleForFileTypes = fopen("./Configure/filetypes.csv", "r");

                if ($handleForFileTypes !== FALSE) {
                    $row = 1;

                    while (($data = fgetcsv($handleForFileTypes, 80, ',', '"')) !== FALSE) {
                        $lineNo = $row;
                        $name = $data[0];
                        $title = $data[0];
                        $alt = $data[0];


                        $row++;


                        $i = 1;
                        $countToSkip = $data[1];
                        while (($i <= $countToSkip) && (($data = fgetcsv($handleForFileTypes, 80, ',', '"')) !== FALSE)) {
                            if ($i == 1) {
                                $temp = "<img id='" . $lineNo . "' name='" . $data[1] . "' class='thumbnails' src='./Configure/CFG_Images/" . $name . ".jpg' title='" . $title . "'alt='" . $data[0] . "'  onclick='changeMainContent(this);' />";
                                echo "$temp";

                                $temp = "<span class='thumbnailName'>" . $name . "</span>";
                                echo "$temp";
                            }

                            $i++;
                            $row++;
                        }
                    }

                    fclose($handleForFileTypes);
                } else {
                    die("Couldn't open Config File (Configure/filetypes.csv)");
                }
                ?>


            </div>

            <div id="main-area" >


                <div id="subCategoryWrapper">
                    <div id="subCategory"></div>
                </div>



                <div id="fileSelector">
                    <div id="yearMonth"></div>
                    <div id="fileNameList"></div>
                </div>


            </div> <!-- end of main area-->

        </div> <!-- end of content wrapper-->

    </body>
</html>
