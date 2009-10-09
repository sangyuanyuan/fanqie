<?php
require_once('frame.php');
$today=date("Y-m-d",time())." 00:00:00";
$thirdday=date("Y-m-d",strtotime("+2 day"))." 23:59:59";
echo $today."<br>";
echo $thirdday;
?>
