<?php

if (isset($_GET['mainType']) && isset($_GET['subType']) && isset($_GET['changedPrefix']) && isset($_GET['year']) && isset($_GET['month'])) {
    $mainType = $_GET['mainType'];
    $subType = $_GET['subType'];
    $changedPrefix = $_GET['changedPrefix'];
    $year = $_GET['year'];
    $month = $_GET['month'];
} else {
    print_r($_GET);
    die('Died');
}


$fileDir = "../output/static/" . "$mainType" . "/" . "$subType";

ob_start();
passthru("ls \"$fileDir\"|grep ".$changedPrefix."$year"."$month");
$files = ob_get_contents();
ob_end_clean();

//$fileArr = explode('\n',$files);
$fileArr = str_word_count($files,1,'0123456789_.');
sort($fileArr);
$count =1 ;
foreach ( $fileArr as $file){
    ?>
    <div class="filenamebutton file">
        <span><?php echo $file; ?></span>
        <form action="" method="get" accept-charset="utf-8">
    		<input type='hidden' name="buttonName" value='filenamebutton<?php echo $count; ?>' />
        	<input type="hidden" name="fileDir" value="<?php echo $fileDir; ?>" />
        	<input type='hidden' name='fileName' value='<?php echo $file; ?>' />
        </form>
       
    </div>
    <?php
}
/*
for ($i = 1; $i <= 31; $i++) {
    if ($i < 10)
        $day = "0" . "$i";
    else
        $day = $i;


    if ($subType == "MuAng" || $subType == "WtPlot") {
        $compressedFilename = "$changedPrefix" . "$year" . "$month" . "$day" . "_" . "$year" . "$month" . "$day" . ".ps.gz";
        $psFilename = "$changedPrefix" . "$year" . "$month" . "$day" . "_" . "$year" . "$month" . "$day" . ".ps";
    } else if ($subType == "ScPlot") {
        $compressedFilename = "$changedPrefix" . "$year" . "$month" . "$day" . "-" . "$year" . "$month" . "$day" . ".ps.gz";
        $psFilename = "$changedPrefix" . "$year" . "$month" . "$day" . "-" . "$year" . "$month" . "$day" . ".ps";
    } else {
        $compressedFilename = "$changedPrefix" . "$year" . "$month" . "$day" . ".ps.gz";
        $psFilename = "$changedPrefix" . "$year" . "$month" . "$day" . ".ps";
    }

    $filename = "$fileDir" . "/" . "$compressedFilename";


    if (is_file($filename)) {
        
        $temp = "<div class='filenamebutton file'><span>$psFilename</span><input type='hidden' value='filenamebutton$i' /><input type='hidden' value='$fileDir' /><input type='hidden' value='$psFilename'/></div>";
        echo "$temp";
     
    }
}
*/
?>
