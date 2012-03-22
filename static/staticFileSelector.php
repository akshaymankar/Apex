<html>
    <head>
        <title>Static</title>

        <meta http-equiv="Content-Type" content="text/html;">
        <link href="Style/static.css" type="text/css" rel="stylesheet" />
        <script language="javaScript" type="text/javascript" src="Script/jquery.js"></script>
        <script type="text/javascript" src="Script/static.js" ></script>
    </head>


    <body style="text-align:center;">
        <div id="wrapper">
            <h1 class="content-head">GRAPES-3 DATA Monitoring Plots</h1>

            <br/><br/>

            <div id="content-wrapper">
                <div id="sidebar" >
                    <?php
                    $handleForFileTypes = fopen("./Configure/filetypes.csv", "r");

                    if ($handleForFileTypes !== FALSE) {
                        $row = 1;
                        $countToBreak = 0;

                        while (($data = fgetcsv($handleForFileTypes, 80, ',', '"')) !== FALSE) {
                            $lineNo = $row;
                            $name = $data[0];
                            $title = $data[0];
                            $alt = $data[0];


                            $row++;
                            $countToBreak++;


                            $i = 1;
                            $countToSkip = $data[1];
                            while (($i <= $countToSkip) && (($data = fgetcsv($handleForFileTypes, 80, ',', '"')) !== FALSE)) {
                                if ($i == 1) {
                                    $temp = "<img id='" . $lineNo . "' name='" . $data[1] . "' class='thumbnails' src='./Configure/CFG_Images/" . $name . ".jpg' title='" . $title . "'alt='" . $data[0] . "'  onclick='changeMainContent(this);' />";
                                    echo "$temp";

                                    $break = "<br/>";
                                    echo "$break";

                                   $temp = "<h1 class='thumbnailName' id='" . $name . "'/>"."$name"."</h1>";
                                   echo "$temp";
                                }

                                $i++;
                                $row++;
                            }


                            if (($countToBreak % 3) == 0) {
                                $break = "<br/>";
                                echo "$break";
                            }
                        }

                        fclose($handleForFileTypes);
                    } else {
                        die("Couldn't open Config File (Configure/filetypes.csv)");
                    }
                    ?>


                </div>

                <div id="main-area" >
                    <div id="sT">
                        <div id="subType"></div>
                    </div>

                    <br/>

                    <div id="fileSelector" align="center" style="overflow:auto;">
                        <div id="yearMonth"></div>
                        <div id="fileNameList"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
