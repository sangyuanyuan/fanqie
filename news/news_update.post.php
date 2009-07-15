<?php
	require_once('../frame.php');
    $newsid=$_REQUEST['newsid'];
	$sql="update smg_news set click_count=click_count+1 where id=".$newsid;
	$db = get_db();
	if($db->execute($sql))
	{
		
	}
	else
	{
		echo 'error';
	}
?>