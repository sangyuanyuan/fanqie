﻿<?php  
	require_once('../../frame.php');
	$fcontent=$_POST['num'];
	$filename = $_POST['id'].".txt";
	echo $filename;
	$handle=fopen($filename,"wt");
	fwrite($handle,$fcontent);
	fclose($handle);
?>