<?php
	require_once('../frame.php');
	$rq=aweek($_POST['rq'],1);
	if($_POST['rq']!=$rq[5]&&$_POST['rq']!=$rq[6])
	{
		echo $rq[0]."-".$rq[4];
	}
	else
	{
		echo $_POST['rq'];	
	}
?>