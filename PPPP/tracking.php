<?php
$PID =  $_GET["PID"];
//echo "Magic";

?>
<script src="jquery-2.1.4.js"></script>
<script>
function transaction(comment){
  $.get("transact.php?PID=<?=$PID?>&string=<?=$PID?>,<?=$PageName?>," + comment);
}


</script>
