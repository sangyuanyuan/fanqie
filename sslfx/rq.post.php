<?php
	require_once('../frame.php');
	$rq=aweek($_POST['rq'],1);
	echo $rq[0]."-".$rq[6];
?>