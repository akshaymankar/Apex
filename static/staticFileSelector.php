<html>
<head>
    <title></title>


	<meta http-equiv="Content-Type" content="text/html;">

	 <script language="javaScript" type="text/javascript" src="Script/jquery.js"></script>
        <link href="Style/static.css" type="text/css" rel="stylesheet" />

        <script type="text/javascript" src="Script/static.js" >  
        </script>
	
</head>


<body style="text-align:center;">
 <div id="currentDiv" align="center">
            <div id="currentData" align="center">
            </div>
        </div>


        <br/><br/>


        <div id="wrapper">
            <h1 class="content-head">GRAPES-3 DATA Monitoring Plots</h1>
            <h2 align="center">(Please, Select one Main Type of File from below to Display or Download GRAPHS)</h2>


            <br/>

            <div id="content-wrapper">
                <div id="sidebar" >
                    <div id="mainType" align="center">

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
                                        $temp = "<img id='" . $lineNo . "' name='" . $data[1] . "' class='thumbnails' src='./Configure/CFG_Images/" . $name . ".jpg' title='" . $title . "'alt='" . $data[0] . "'  onclick='changeMainType(this);' />";
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
                </div>
                <div id="main-area" >
                    <div id="subType">
                    </div>
                    <div id="fileSelector" align="center" style="overflow:auto;">
                        <div id="lists" ></div>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
