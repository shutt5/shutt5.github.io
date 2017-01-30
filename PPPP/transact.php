<?php


$Participant = "Test";

$Participant = $_GET["PID"];

$StringToWrite = $_GET["string"];
$StringToWrite =  $StringToWrite ."," . date("Y-m-d h:i:sa") . "\n";
$filePath = "";

$file = $filePath . $Participant . "-Transaction.txt";

if(file_exists($file)){
  $fh = fopen($file, 'a') or die("can't open file");
}else{
$fh = fopen($file, 'a') or die("can't open file");
fwrite($fh, "Participant,Action,Data,Time\n");
}
$stringData = "Session Finished\n";
fwrite($fh, $StringToWrite);

//echo "over";


 ?>
